@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}</style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать домен</h1>
                        <a href="{{route('admin.hosts')}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="form-group js-edit-host">
                <label>Название</label>
                <input type="text" class="form-control inp" data-name="domen" data-id="{{$host['id']}}" value="{{$host['domen']}}">
                <br>
                <label>Статус</label>
                <select data-name="status" data-id="{{$host['id']}}" class="form-control inp" >
                    <option {{$host['status'] === 1 ? 'selected' : ''}}>1</option>
                    <option {{$host['status'] === 0 ? 'selected' : ''}}>0</option>
                </select>
                <br>
                <label>Контроль заявок</label>
                <textarea class="form-control inp" data-name="control_emails" data-id="{{$host['id']}}" value="{{$host['control_emails']}}" cols="30" rows="10">{{$host['control_emails']}}</textarea>
                @if(Auth::user()->super_admin)
                    <br>
                    <label>Скрипты</label>
                    <textarea class="form-control inp" data-name="scripts" data-id="{{$host['id']}}" value="{{$host['scripts']}}" cols="30" rows="10">{{$host['scripts']}}</textarea>
                    <br>
                @endif

            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
