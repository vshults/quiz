@extends('admin.layouts.layout')

@section('content')
    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Пользователи</h1>
                        <br>
                        <a href="users/add"><button type="button" class="btn btn-primary">Добавить</button></a>
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
                    <th scope="col">Пользователь</th>
                    <th scope="col">Email</th>
                    <th scope="col">роль</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="js-add">
                @if (!empty($users))
                    @foreach($users as $user)
                        <tr class="row_index foo">
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['super_admin'] ? 'SuperAdmin' : 'Admin'}}</td>
                            <td><a href="users/edit/{{$user['id']}}"><button type="button" class="btn btn-secondary edit_user">Редактировать</button></a></td>
                            @if(Auth::user()->id !== $user['id'])<td><button data-id="{{$user['id']}}" type="button" class="btn btn-danger delete_user">Удалить</button></td>@endif
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
