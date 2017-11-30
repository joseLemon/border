@extends('layouts.cms.master')
@section('head')
@stop
@section('scripts')
    @include('cms.common.js.functionality')
    <script>
        $(document).ready(function () {
            $('#add-directory').click(function () {
                var accordion = $('#accordion-directories'),
                    panel_number = ($('#accordion-directories .panel').length)+1,
                    panel_id = 'panel-'+panel_number;

                accordion.append(
                    '<div class="col-sm-4" style="margin-bottom: 5px;">' +
                    '<div class="panel panel-default" id="' + panel_id + '" my_id="new" type="directory" style="margin: 0;">' +
                    '<div class="panel-heading" data-toggle="collapse" data-parent="#accordion-directories" href="#collapse' + panel_number + '">' +
                    '<h4 class="panel-title">Directorio ' + panel_number +
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
                    '<div class="text-center">' +
                    '<label for="directory_' + panel_number + '_img" class="img_upload_container">' +
                    '<div class="img-preview img-container preview">' +
                    '<button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>' +
                    '<img src="" id="preview" class="center-block img-responsive">' +
                    '</div>' +
                    'Imagen del directorio' +
                    '<label for="directory_' + panel_number + '_img" class="input-file-cms">' +
                    'Elegir imagen' +
                    '<input type="file" name="directory_' + panel_number + '_img" id="directory_' + panel_number + '_img" accept="image/*" class="input-file-img">' +
                    '<input type="hidden" name="directory_' + panel_number + '_img_check" id="directory_' + panel_number + '_img_check">' +
                    '</label>' +
                    '</label>' +
                    '</div>' +
                    '<div class="panel-group text-left" id="accordion-directory-info-' + panel_number + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                /*if((panel_number%3) === 0) {
                    accordion.append('<div class="clearfix"></div>')
                }*/

                deletePanel();
                initReadFiles();
            });
            $('#add-hexagon').click(function () {
                var accordion = $('#accordion-hexagons'),
                    panel_number = ($('#accordion-hexagons .panel').length)+1,
                    panel_id = 'panel-'+panel_number;

                accordion.append(
                    '<div class="col-sm-4" style="margin-bottom: 5px;">' +
                    '<div class="panel panel-default" id="' + panel_id + '" my_id="new" type="hexagon" style="margin: 0;">' +
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
                    '<div class="text-center">' +
                    '<input type="text" name="hexagon_' + panel_number + '_title" class="input-cms hexagon-title" placeholder="Título del hexágono">' +
                    '<label for="hexagon_' + panel_number + '_img" class="img_upload_container">' +
                    '<div class="img-preview img-container preview">' +
                    '<button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>' +
                    '<img src="" id="preview" class="center-block img-responsive">' +
                    '</div>' +
                    'Imagen del hexágono' +
                    '<label for="hexagon_' + panel_number + '_img" class="input-file-cms">' +
                    'Elegir imagen' +
                    '<input type="file" name="hexagon_' + panel_number + '_img" id="hexagon_' + panel_number + '_img" accept="image/*" class="input-file-img">' +
                    '<input type="hidden" name="hexagon_' + panel_number + '_img_check" id="hexagon_' + panel_number + '_img_check">' +
                    '</label>' +
                    '</label>' +
                    '</div>' +
                    '<div class="panel-group text-left" id="accordion-hexagon-info-' + panel_number + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                /*if((panel_number%3) === 0) {
                    accordion.append('<div class="clearfix"></div>')
                }*/

                deletePanel();
                initReadFiles();
            });

            $('form').submit(function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var form = $(this);

                var inputList = $('#directoryInputList'),
                    panels = $('#accordion-directories > .col-sm-4 > .panel');
                inputList.empty();

                var inputList2 = $('#hexagonInputList'),
                    panels2 = $('#accordion-hexagons> .col-sm-4 > .panel');
                inputList2.empty();

                var validation = true;

                if(panels.length > 0) {
                    panels.each(function () {
                        var panel = $(this),
                            metaList = '';

                        panel.find('input[type=file]').each(function () {
                            var input = $(this),
                                directory_id = input.closest('.panel').attr('my_id');

                            if(directory_id === 'new') {
                                metaList = 'directory_@@_new';
                            } else {
                                metaList = 'directory_@@_' + directory_id;
                            }
                        });
                        if(metaList == '') {
                            directoriesValidation();
                        } else {
                            inputList.append('<input type="hidden" name="directories[]" id="directories" value="' + metaList + '">');
                        }

                    });
                }

                if(panels2.length > 0) {
                    panels2.each(function () {
                        var panel = $(this),
                            title = panel.find('.hexagon-title').val(),
                            metaList = '';

                        if(title == '') {
                            validation = hexagonsValidation();
                        } else {
                            panel.find('input[type=file]').each(function () {
                                var input = $(this),
                                    hexagon_id = input.closest('.panel').attr('my_id');

                                if(hexagon_id === 'new') {
                                    metaList = title + '_@@_new';
                                } else {
                                    metaList = title + '_@@_' + hexagon_id;
                                }
                            });
                            if(metaList == '') {
                                hexagonsValidation();
                            } else {
                                inputList2.append('<input type="hidden" name="hexagons[]" id="hexagons" value="' + metaList + '">');
                            }
                        }

                    });
                }

                if(validation) {
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
                        type = '';

                    if(button.hasClass('directory-panel')) {
                        type = 'directory';
                    }

                    if(button.hasClass('hexagon-panel')) {
                        type = 'hexagon';
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/cms') }}/' + id + '/' + type + '/delete',
                        success: function () {
                            location.reload();
                        },
                        fail: function () {
                            $.alert({
                                title: 'Error al borrar el elemento.',
                                content: 'No se pudo completar la operación, intentalo nuevamente más tarde.',
                                backgroundDismiss: 'cancel'
                            })
                        }
                    });
                }
            });
        }

        function directoriesValidation() {
            $.alert({
                title: 'Error en los directorios',
                content: 'Asegurate de llenar toda la información de los directorios antes de continuar.',
                backgroundDismiss: 'cancel'
            });
            return false;
        }

        function hexagonsValidation() {
            $.alert({
                title: 'Error en los hexágonos',
                content: 'Asegurate de llenar toda la información de los hexágonos antes de continuar.',
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
            {!! Form::open(['route' => 'cms.update', 'id' => 'formCms', 'enctype' => 'multipart/form-data']) !!}
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Banner</h3>
                </div>
                <div class="col-sm-6 text-center">
                    <label for="banner_img" class="img_upload_container">
                        <div class="img-preview img-container preview @isset($cms->banner_img){{ 'active' }}@endisset">
                            <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                            <img src="@isset($cms->banner_img){{ asset('uploads/cms/banner_img'. strchr($cms->banner_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                        </div>
                        Imagen del banner
                        <label for="banner_img" class="input-file-cms">
                            Elegir imagen
                            <input type="file" name="banner_img" id="banner_img" accept="image/*" class="input-file-img">
                            <input type="hidden" name="state_check_banner_img" id="state_check_banner_img">
                        </label>
                    </label>
                </div>
                <div class="col-sm-6 text-center">
                    <label for="banner_top_img" class="img_upload_container">
                        <div class="img-preview img-container preview @isset($cms->banner_top_img){{ 'active' }}@endisset">
                            <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                            <img src="@isset($cms->banner_top_img){{ asset('uploads/cms/banner_top_img'. strchr($cms->banner_top_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                        </div>
                        Imagen frontal del banner
                        <label for="banner_top_img" class="input-file-cms">
                            Elegir imagen
                            <input type="file" name="banner_top_img" id="banner_top_img" accept="image/*" class="input-file-img">
                            <input type="hidden" name="state_check_banner_top_img" id="state_check_banner_top_img">
                        </label>
                    </label>
                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Acerca de</h3>
                    <label for="about_title">Título de la sección</label>
                    {!! Form::text('about_title',isset($cms) ? $cms->about_title : old('about_title'),['class'=>'input-cms','id'=>'about_title','placeholder'=>'Título de la sección']) !!}
                    <label for="about_text">Texto de la sección</label>
                    {!! Form::textarea('about_text',isset($cms) ? $cms->about_text : old('about_text'),['class'=>'input-cms','id'=>'about_text','placeholder'=>'Texto de las sección','cols'=>30,'rows'=>5]) !!}
                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-6 col-md-4">
                    <label for="about_item_1_title">Columna 1</label>
                    {!! Form::text('about_item_1_title',isset($cms) ? $cms->about_item_1_title : old('about_item_1_title'),['class'=>'input-cms','id'=>'about_item_1_title','placeholder'=>'Título de la sección']) !!}
                    {!! Form::textarea('about_item_1_text',isset($cms) ? $cms->about_item_1_text : old('about_item_1_text'),['class'=>'input-cms','id'=>'about_item_1_text','placeholder'=>'Texto de las sección','cols'=>30,'rows'=>5]) !!}

                    <div class="text-center">
                        <label for="about_item_1_img" class="img_upload_container">
                            <div class="img-preview img-container preview @isset($cms->about_item_1_img){{ 'active' }}@endisset">
                                <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                <img src="@isset($cms->about_item_1_img){{ asset('uploads/cms/about_item_1_img'. strchr($cms->about_item_1_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                            </div>
                            Imagen de la sección
                            <label for="about_item_1_img" class="input-file-cms">
                                Elegir imagen
                                <input type="file" name="about_item_1_img" id="about_item_1_img" accept="image/*" class="input-file-img">
                                <input type="hidden" name="state_check_about_item_1_img" id="state_check_about_item_1_img">
                            </label>
                        </label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <label for="about_item_2_title">Columna 2</label>
                    {!! Form::text('about_item_2_title',isset($cms) ? $cms->about_item_2_title : old('about_item_2_title'),['class'=>'input-cms','id'=>'about_item_2_title','placeholder'=>'Título de la sección']) !!}
                    {!! Form::textarea('about_item_2_text',isset($cms) ? $cms->about_item_2_text : old('about_item_2_text'),['class'=>'input-cms','id'=>'about_item_2_text','placeholder'=>'Texto de las sección','cols'=>30,'rows'=>5]) !!}

                    <div class="text-center">
                        <label for="about_item_2_img" class="img_upload_container">
                            <div class="img-preview img-container preview @isset($cms->about_item_2_img){{ 'active' }}@endisset">
                                <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                <img src="@isset($cms->about_item_2_img){{ asset('uploads/cms/about_item_2_img'. strchr($cms->about_item_2_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                            </div>
                            Imagen de la sección
                            <label for="about_item_2_img" class="input-file-cms">
                                Elegir imagen
                                <input type="file" name="about_item_2_img" id="about_item_2_img" accept="image/*" class="input-file-img">
                                <input type="hidden" name="state_check_about_item_2_img" id="state_check_about_item_2_img">
                            </label>
                        </label>
                    </div>
                </div>
                <div class="clearfix hidden-lg hidden-md"></div>
                <div class="col-sm-6 col-md-4">
                    <label for="about_item_3_title">Columna 3</label>
                    {!! Form::text('about_item_3_title',isset($cms) ? $cms->about_item_3_title : old('about_item_3_title'),['class'=>'input-cms','id'=>'about_item_3_title','placeholder'=>'Título de la sección']) !!}
                    {!! Form::textarea('about_item_3_text',isset($cms) ? $cms->about_item_3_text : old('about_item_3_text'),['class'=>'input-cms','id'=>'about_item_3_text','placeholder'=>'Texto de las sección','cols'=>30,'rows'=>5]) !!}

                    <div class="text-center">
                        <label for="about_item_3_img" class="img_upload_container">
                            <div class="img-preview img-container preview @isset($cms->about_item_3_img){{ 'active' }}@endisset">
                                <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                <img src="@isset($cms->about_item_3_img){{ asset('uploads/cms/about_item_3_img'. strchr($cms->about_item_3_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                            </div>
                            Imagen de la sección
                            <label for="about_item_3_img" class="input-file-cms">
                                Elegir imagen
                                <input type="file" name="about_item_3_img" id="about_item_3_img" accept="image/*" class="input-file-img">
                                <input type="hidden" name="state_check_about_item_3_img" id="state_check_about_item_3_img">
                            </label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Hexágonos</h3>

                    <div class="panel-group row" id="accordion-hexagons">
                        @if(isset($hexagons))
                            @foreach($hexagons as $count => $hexagon)
                                <div class="col-sm-4" style="margin-bottom: 5px;">
                                    <div class="panel panel-default" id="{{ $count+1 }}" my_id="{{ $hexagon->hexagon_id }}" type="hexagon" style="margin: 0;">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion-hexagons" href="#hexagonCollapse{{ $count+1 }}">
                                            <h4 class="panel-title">Hexágono {{ $count+1 }}
                                                <button type="button" class="expand-accordion">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="deletePanel hexagon-panel">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </h4>
                                        </div>
                                        <div id="hexagonCollapse{{ $count+1 }}" class="panel-collapse collapse">
                                            <div class="panel-body text-right">
                                                <div class="text-center">
                                                    <input type="text" name="hexagon_{{ $count+1 }}_title" class="input-cms hexagon-title" placeholder="Título del hexágono" value="{{ $hexagon->hexagon_title }}">
                                                    <label for="hexagon_{{ $count+1 }}_img" class="img_upload_container">
                                                        <div class="img-preview img-container preview active">
                                                            <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                                            <img src="{{  asset('/uploads/cms/hexagons/'.$hexagon->hexagon_img . '?=' . rand(1,99999999)) }}" id="preview" class="center-block img-responsive">
                                                        </div>
                                                        Imagen del hexágono
                                                        <label for="hexagon_{{ $count+1 }}_img" class="input-file-cms">
                                                            Elegir imagen
                                                            <input type="file" name="hexagon_{{ $count+1 }}_img" id="hexagon_{{ $count+1 }}_img" accept="image/*" class="input-file-img">
                                                            <input type="hidden" name="hexagon_{{ $count+1 }}'_img_check" id="hexagon_{{ $count+1 }}_img_check">
                                                        </label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(($count+1)%3 == 0)
                                <!--<div class="clearfix"></div>-->
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <div class="text-right">
                        <button type="button" id="add-hexagon">Agregar hexágono</button>
                    </div>

                    <div id="hexagonInputList" class="hidden"></div>
                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Directorio</h3>
                    {!! Form::text('directory_title',isset($cms) ? $cms->directory_title : old('directory_title'),['class'=>'input-cms','id'=>'directory_title','placeholder'=>'Título de la sección']) !!}

                    <div class="panel-group row" id="accordion-directories">
                        @if(isset($directories))
                            @foreach($directories as $count => $directory)
                                <div class="col-sm-4" style="margin-bottom: 5px;">
                                    <div class="panel panel-default" id="{{ $count+1 }}" my_id="{{ $directory->directory_id }}" type="directory" style="margin: 0;">
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion-directories" href="#directoryCollapse{{ $count+1 }}">
                                            <h4 class="panel-title">Directorio {{ $count+1 }}
                                                <button type="button" class="expand-accordion">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="deletePanel directory-panel">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </h4>
                                        </div>
                                        <div id="directoryCollapse{{ $count+1 }}" class="panel-collapse collapse">
                                            <div class="panel-body text-right">
                                                <div class="text-center">
                                                    <label for="directory_{{ $count+1 }}_img" class="img_upload_container">
                                                        <div class="img-preview img-container preview active">
                                                            <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                                            <img src="{{  asset('/uploads/cms/directories/'.$directory->directory_img . '?=' . rand(1,99999999)) }}" id="preview" class="center-block img-responsive">
                                                        </div>
                                                        Imagen del directorio
                                                        <label for="directory_{{ $count+1 }}_img" class="input-file-cms">
                                                            Elegir imagen
                                                            <input type="file" name="directory_{{ $count+1 }}_img" id="directory_{{ $count+1 }}_img" accept="image/*" class="input-file-img">
                                                            <input type="hidden" name="directory_{{ $count+1 }}'_img_check" id="directory_{{ $count+1 }}_img_check">
                                                        </label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(($count+1)%3 == 0)
                                    <!--<div class="clearfix"></div>-->
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <div class="text-right">
                        <button type="button" id="add-directory">Agregar directorio</button>
                    </div>

                    <div id="directoryInputList" class="hidden"></div>

                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Contacto</h3>
                    <label for="about_title">Título de la sección</label>
                    {!! Form::text('contact_title',isset($cms) ? $cms->contact_title : old('contact_title'),['class'=>'input-cms','id'=>'contact_title','placeholder'=>'Título de la sección']) !!}
                </div>
                <div class="col-sm-6">
                    <label for="contact_text">Texto de la sección</label>
                    {!! Form::textarea('contact_text',isset($cms) ? $cms->contact_text : old('contact_text'),['class'=>'input-cms','id'=>'contact_text','placeholder'=>'Texto de las sección','cols'=>30,'rows'=>5]) !!}
                </div>
                <div class="col-sm-6">
                    <label for="contact_address">Información de contacto</label>
                    {!! Form::textarea('contact_address',isset($cms) ? $cms->contact_address : old('contact_address'),['class'=>'input-cms','id'=>'contact_address','placeholder'=>'Texto de contacto','cols'=>30,'rows'=>5]) !!}
                </div>
            </div>
            <div class="row no-margin">
                <div class="col-sm-12">
                    <h3>Pie de página</h3>
                </div>
                <div class="col-sm-4">
                    <label for="footer_address">Información de contacto</label>
                    {!! Form::textarea('footer_address',isset($cms) ? $cms->footer_address : old('footer_address'),['class'=>'input-cms','id'=>'footer_address','placeholder'=>'Texto de contacto','cols'=>30,'rows'=>5]) !!}
                </div>
                <div class="col-sm-4">
                    <div class="text-center">
                        <label for="footer_img" class="img_upload_container">
                            <div class="img-preview img-container preview @isset($cms->footer_img){{ 'active' }}@endisset">
                                <button type="button" class="remove-img"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
                                <img src="@isset($cms->footer_img){{ asset('uploads/cms/footer_img'. strchr($cms->footer_img,'.') . '?=' . rand(1,99999999)) }}@endisset" id="preview" class="center-block img-responsive">
                            </div>
                            Imagen de la sección
                            <label for="footer_img" class="input-file-cms">
                                Elegir imagen
                                <input type="file" name="footer_img" id="footer_img" accept="image/*" class="input-file-img">
                                <input type="hidden" name="state_check_footer_img" id="state_check_footer_img">
                            </label>
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="footer_fb">Redes sociales</label>
                    {!! Form::text('footer_fb',isset($cms) ? $cms->footer_fb : old('footer_fb'),['class'=>'input-cms','id'=>'footer_fb','placeholder'=>'Liga a facebook']) !!}
                    {!! Form::text('footer_twitter',isset($cms) ? $cms->footer_twitter : old('footer_twitter'),['class'=>'input-cms','id'=>'footer_twitter','placeholder'=>'Liga a twitter']) !!}
                    <label for="footer_bottom">Parte inferior</label>
                    {!! Form::text('footer_bottom',isset($cms) ? $cms->footer_bottom : old('footer_bottom'),['class'=>'input-cms','id'=>'footer_bottom','placeholder'=>'Parte inferior']) !!}
                </div>
            </div>
            <div class="text-center">
                {!! Form::submit('Guardar',['class'=>'submit-cms big-btn']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop