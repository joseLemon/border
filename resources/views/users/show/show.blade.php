@extends('layouts.cms.master')
@section('head')
    <style>
        table tbody tr {
            cursor: pointer;
        }
        table .delete {
            display: block;
            width: 100%;
            text-align: center;
        }
    </style>
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            fillPostsTable('all',1);

            $('.search-bar button').click(function () {
                fillPostsTable('search',1,$('#search-input').val());
            });

            $('#search-input').keypress(function(e) {
                if(e.which == 13) {
                    fillPostsTable('search',1,$(this).val());
                }
            });
        });

        function fillPostsTable($get_users_by,$page,$search) {
            if(!$search) {
                $search = '';
            }
            var table = $('#usersTable');
            var tbody = table.find('tbody');
            var url = '{{ url('user') }}';
            $.ajax({
                url: '{{ route('users.get') }}',
                type: 'GET',
                data: {
                    'page' : $page,
                    'search' : $search,
                    'get_users_by' : $get_users_by
                },
                success: function (users) {
                    tbody.empty();
                    $(users.data).each(function (i, user) {
                        tbody.append(
                            '<tr data-anchor="' + url + '/' + user.user_id + '/edit' + '" data-userid="' + user.user_id + '">' +
                            '<td>' + (i+1) + '</td>' +
                            '<td>' + user.user_full_name + '</td>' +
                            '<td>' + user.user_email + '</td>' +
                            '<td>' +
                            '<a href="#" class="delete preventDef"><i class="fa fa-times" aria-hidden="true"></i></a>' +
                            '</td>' +
                            '</tr>'
                        );
                    });

                    var paginator = $('#pagination');
                    paginator.empty();
                    paginator.append(
                        '<li>' +
                        '<a href="#" class="preventDef" onclick="fillPostsTable(\''+$get_users_by+'\',1)" aria-label="Previous">' +
                        '<span aria-hidden="true">&laquo;</span>' +
                        '</a>' +
                        '</li>'
                    );

                    var start = users.current_page - 1;
                    if(start < 1) {
                        start = 1;
                    }

                    var end = users.current_page + 1;
                    if(end > users.last_page) {
                        end = users.last_page
                    }

                    for(i = start; i <= end; i++) {
                        paginator.append('<li><a href="#" class="preventDef" onclick="fillPostsTable(\''+$get_users_by+'\','+i+')">' + i + '</a></li>')
                    }
                    paginator.append(
                        '<li>' +
                        '<a href="#" class="preventDef" onclick="fillPostsTable(\''+$get_users_by+'\','+users.last_page+')" aria-label="Previous">' +
                        '<span aria-hidden="true">&raquo;</span>' +
                        '</a>' +
                        '</li>'
                    );

                    tableInitialize();
                }
            });
        }

        function tableInitialize() {
            $('table tbody tr').click(function (e) {
                var anchor = $(this).data('anchor');
                window.location.href = anchor;
            });

            $('.preventDef').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
            });

            $('table .delete').click(function () {
                var tr = $(this).closest('tr');
                var id = tr.data('userid');
                $.confirm({
                    title: '¿Seguro que deseas eliminar este usuario?',
                    content: 'Este contenido será eliminado en caso de que desees continuar',
                    backgroundDismiss: 'cancel',
                    buttons: {
                        confirm: {
                            text: 'Continuar',
                            btnClass: 'btn-danger',
                            action: function () {
                                deletePost(id,tr);
                            }
                        },
                        cancel: {
                            text: 'Cancelar'
                        }
                    }
                });
            });
        }

        function deletePost($id,$tr) {
            $.ajax({
                url: '{{ route('user.delete') }}',
                type: 'GET',
                data: {
                    'user_id': $id
                },
                success: function (data) {
                    $tr.remove();
                }
            });
        }
    </script>
@stop
@section('content')
    <div class="big-container">
        <div class="dash-object">

            <div class="dash-head">
                <div class="search-bar">
                    <div class="input-group">
                        {!! Form::text('search',null,['class'=>'form-control','id'=>'search-input']) !!}
                        <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
                    </div>
                </div>
            </div>

            <div class="dash-body">
                <div class="table-responsive">
                    <table class="table table-hover table-cms" id="usersTable">
                        <colgroup>
                            <col style="width: 5%">
                            <col style="width: 45%">
                            <col style="width: 45%">
                            <col style="width: 5%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="dash-footer">
                <nav aria-label="Page navigation" class="text-right">
                    <ul class="pagination" id="pagination">
                    </ul>
                </nav>
            </div>

        </div>

    </div>
@stop