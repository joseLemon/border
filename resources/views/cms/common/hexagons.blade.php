@extends('layouts.cms.master')
@section('head')
@stop
@section('scripts')
    @include('cms.common.js.functionality')
    <script>
        $(document).ready(function () {
            $('#add-hexagon').click(function () {
                var accordion = $('#accordion-hexagons'),
                    panel_number = (accordion.children().length)+1,
                    panel_id = 'panel-'+panel_number;

                accordion.append(
                    '<div class="panel panel-default" id="' + panel_id + '" my_id="new" type="hexagon">' +
                    '<div class="panel-heading" data-toggle="collapse" data-parent="#accordion-hexagons" href="#collapse' + panel_number + '">' +
                    '<h4 class="panel-title">Hexágono ' + panel_number +
                    '<button type="button" class="expand-accordion">' +
                    '<i class="fa fa-plus" aria-hidden="true"></i>' +
                    '</button>' +
                    '<button type="button" class="deletePanel new">' +
                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                    '</button>' +
                    '</h4>' +
                    '</div>' +
                    '<div id="collapse' + panel_number + '" class="panel-collapse collapse">' +
                    '<div class="panel-body text-right">' +
                    '<div class="col-lg-8 col-md-7 col-sm-6">' +
                    '<input type="text" name="hexagon_title_' + panel_number + '" id="hexagon_title_' + panel_number + '" placeholder="Título del hexágono" class="input-cms hexagon-title">' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-5 col-sm-6 text-center">' +
                    '<label for="hexagon_' + panel_number + '_img" class="img_upload_container">' +
                    '<div class="img-preview img-container preview">' +
                    '<button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>' +
                    '<img src="" id="preview" class="center-block img-responsive">' +
                    '</div>' +
                    'Imagen del hexagono' +
                    '<label for="hexagon_' + panel_number + '_img" class="input-file-cms">' +
                    'Elegir imagen' +
                    '<input type="file" name="hexagon_' + panel_number + '_img" id="hexagon_' + panel_number + '_img" accept="image/*" class="input-file-img">' +
                    '<input type="hidden" name="hexagon_' + panel_number + '_img_check" id="hexagon_' + panel_number + '_img_check">' +
                    '</label>' +
                    '</label>' +
                    '</div>' +
                    '<div class="panel-group text-left" id="accordion-hexagon-info-' + panel_number + '"></div>' +
                    '</div>' +
                    '</div>'
                );

                deletePanel();
                initReadFiles();
            });

            $('form').submit(function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var form = $(this);
                var inputList = $('#hexagonInputList'),
                    panels = $('#accordion-hexagons > .panel');
                inputList.empty();

                if(($('#page_type').prop('disabled' == true) || $('#page_type').val() == 4) && panels.length > 0) {
                    console.log('enter');
                    panels.each(function () {
                        var panel = $(this),
                            title = panel.find('.hexagon-title').val(),
                            metaList = '',
                            hexagon_id = panel.attr('my_id'),
                            validation = true;
                        if(hexagon_id === 'new') {
                            metaList = title + '_@@_new';
                        } else {
                            metaList = title + '_@@_' + hexagon_id;
                        }

                        if(title == '') {
                            validation = hexagonsValidation();
                        } else {
                            panel.find('.hexagon-title').each(function () {
                                var input_title = $(this),
                                    title = input_title.val(),
                                    text = input_title.next().val(),
                                    hexagon_id = input_title.closest('.panel').attr('my_id');

                                if(title == '' || text == '') {
                                    metaList = '';
                                } else {
                                    if(hexagon_id === 'new') {
                                        metaList += '_@@_' + title + '_%%_' + text + '_%%_new';
                                    } else {
                                        metaList += '_@@_' + title + '_%%_' + text + '_%%_' + hexagon_id;
                                    }
                                }
                            });
                            if(metaList == '') {
                                hexagonsValidation();
                            } else {
                                inputList.append('<input type="hidden" name="hexagons[]" id="hexagons" value="' + metaList + '">');
                            }
                        }

                        if(validation) {
                            form[0].submit();
                        }
                    });
                } else {
                    form[0].submit();
                }
            });
        });

        function deletePanel() {
            $('.deletePanel').click(function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var button = $(this),
                    panel = button.closest('.panel');

                if(button.hasClass('new')) {
                    panel.remove();
                } else {
                    var id = panel.attr('my_id'),
                        type = panel.attr('type');

                    $.ajax({
                        type: 'GET',
                        //url: '{ route('hexagon.delete') }}',
                        data: {
                            'id': id,
                            'type': type
                        }
                    }).success(function () {
                        location.reload();
                    }).fail(function () {
                        $.alert({
                            title: 'Error al borrar el Carrusel o hexagono.',
                            content: 'No se pudo completar la operación, intentalo nuevamente más tarde.',
                            backgroundDismiss: 'cancel'
                        })
                    });

                }
            });
        }

        function hexagonsValidation() {
            $.alert({
                title: 'Error en los hexagonos',
                content: 'Asegurate de llenar toda la información de los hexagonos antes de continuar.',
                backgroundDismiss: 'cancel'
            });
            return false;
        }

        $(document).ready(function () {
            deletePanel();
        });
    </script>
@stop
@section('content')
    <div class="big-container">
        <div class="dash-object page-section">

            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Directorio</h3>
                    {!! Form::text('directory_title',isset($cms) ? $cms->directory_title : old('directory_title'),['class'=>'input-cms','id'=>'directory_title','placeholder'=>'Título de la sección']) !!}

                    <div class="panel-group" id="accordion-hexagons">
                        @if(isset($hexagons))
                            @foreach($hexagons as $count => $hexagon)
                                <div class="panel panel-default" id="{{ $count+1 }}" my_id="{{ $hexagon->hexagon_id }}" type="hexagon">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion-hexagons" href="#collapse{{ $count+1 }}">
                                        <h4 class="panel-title">Hexágono {{ $count+1 }}
                                            <button type="button" class="expand-accordion">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="deletePanel">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $count+1 }}" class="panel-collapse collapse">
                                        <div class="panel-body text-right">
                                            <input type="text" name="hexagon_title_{{ $count+1 }}" id="hexagon_title_{{ $count+1 }}" placeholder="Título del hexágono" class="input-cms hexagon-title" value="{{ $hexagon->hexagon_title }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-right">
                        <button type="button" id="add-hexagon">Agregar Hexágono</button>
                    </div>

                    <div id="hexagonInputList" class="hidden"></div>

                </div>
            </div>

        </div>
    </div>
@stop