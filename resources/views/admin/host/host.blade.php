@extends('admin.layouts.layout')

@section('content')
    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Домены</h1>
                        <br>
                        <a href="{{route('hostAddForm')}}"><button type="button" class="btn btn-primary">Добавить</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Домен</th>
                    @if(Auth::user()->super_admin)<th scope="col">Пользователь</th>@endif
                    <th scope="col">Статус</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="js-add">
                @if (!empty($hosts))
                    @foreach($hosts as $host)
                    <tr class="row_index foo">
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$host['domen']}}</td>
                        @if(Auth::user()->super_admin)<td>{{$host['email']}}</td>@endif
                        <td>{{$host['status']}}</td>
                        <td>
                            <ul class = "nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Редактировать <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="js-edit-host"><a class="js-edit-host" role="menuitem" tabindex="-1" href="host/edit/host/{{$host['id']}}">Домен</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="host/edit/setting/{{$host['setting_id']}}">Фронт</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="host/edit/questions/{{$host['id']}}">Вопросы</a></li>
                                    </ul>
                                </li>
                                <li class="btn_delete">
                                    <button type="button" data-id="{{$host['id']}}" class="btn btn-secondary delete_host">Удалить</button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </section>
        <!-- /.content -->
    </div>
    </div>
@endsection
