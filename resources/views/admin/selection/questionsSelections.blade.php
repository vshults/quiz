@extends('admin.layouts.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}</style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Подборки вопросов</h1>
                    </div>
                </div>
                <br>
                <button type="button" data-user-id="{{Auth::user()->id}}" class="btn btn-primary add_selection">Добавить</button>
                <br>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @if(!empty($questions_selections))
                @foreach($questions_selections as $selection)
                    <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$selection['name']}}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                               <div class="card-body">
                                   <a href="{{'selection/editSelection/' . $selection['id']}}"><button type="button" data-id="" class="btn btn-secondary edit_selection">Редактировать подборку</button></a>
                                   <button type="button" data-id="{{$selection['id']}}" class="btn btn-danger delete_selection">Удалить подборку</button>
                               </div>
                           </div>
                @endforeach
            @endif
        </section>
        <!-- /.content -->
    </div>


@endsection
