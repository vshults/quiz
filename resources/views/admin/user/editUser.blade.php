@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}</style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать пользователя</h1>
                        <a href="{{route('admin.users')}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="form-group js-edit-user">
                <label>Имя</label>
                <input type="text" name="name" data-name="name" data-id="{{$id}}" value="{{$name}}" class="form-control inp">
                <br>
                <label>Email</label>
                <input type="text" name="email" data-name="email" data-id="{{$id}}" value="{{$email}}" class="form-control inp">
                <br>
                <label>Пароль</label>
                <input type="password" name="password" data-name="password" data-id="{{$id}}" value="{{$password}}" class="form-control inp">
                <br>
                <label>Супер Админ</label>
                <select type="text" name="super_admin" data-name="super_admin" data-id="{{$id}}" value="{{$super_admin}}" class="form-control inp">
                    <option {{$super_admin ? 'selected' : ''}} value="0">Админ</option>
                    <option {{$super_admin ? 'selected' : ''}} value="1">Супер админ</option>
                </select>
                <br>
                <!--<label for="exampleInputFile">Картинка</label>
                <div class="form-group">
                    <form data-name="img" id="image" class="form-group uploadImageUser uploadImagePost" data-id="{{$id}}" method="POST" enctype="multipart/form-data">
                        <input data-id="{{$id}}" class="upload"
                               id="image"
                               type="file"
                               name="image_user"
                               accept=".jpg, .jpeg, .png, .webp, .heif"
                               multiple>
                    </form>
                </div>
                @if(!empty($img))
                    <a href="{{$img}}" data-fancybox data-caption="{{$name}}"><img style="width: 400px" src="{{$img}}" class="img-thumbnail"></a>
                @endif-->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
