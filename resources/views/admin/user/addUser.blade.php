@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;} </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавить пользователя</h1>
                        <a href="{{route('admin.users')}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div style="display: none" id="alert_success" class="alert alert-success" role="alert">
                Успешно!
            </div>
            <div style="display: none" id="alert-danger" class="alert alert-danger error_email" role="alert"></div>
            <div style="display: none" id="alert-danger" class="alert alert-danger error_password" role="alert"></div>
            <div class="form-group userAdd">
                <form id="addForm" class="form-group userAdd" method="POST">
                    <label>Имя</label>
                    <input type="text" name="name" class="form-control inp">
                    <br>
                    <label>Email</label>
                    <input type="text" name="email" class="form-control inp">
                    <br>
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control inp">
                    <br>
                    <label>Роль</label>
                    <select type="text" name="super_admin" class="form-control inp select_user">
                        <option value="0">Админ</option>
                        <option value="1">Супер админ</option>
                    </select>
                    <br>
                    <button type="submit" id="userAdd" class="btn btn-primary userAdd">Отправить</button>
                </form>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
