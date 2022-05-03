@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;} </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавить ветку</h1>
                        <a href="{{route('admin.hosts.questions')}}/{{$hostID}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
                    <div class="accordion" id="accordion" data-target="#collapse" aria-expanded="true" aria-controls="collapse" >
                        <div class="card">
                            <div class="card-header" id="heading"  data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                <h5 class="mb-0">
                                    <label>Вопрос</label>
                                    <button class="btn btn-link js-add-branch_question" type="button">
                                        <input type="text" class="form-control inp" data-name="title" data-id="" value="">
                                    </button>
                                </h5>
                            </div>

                                    <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
                                        <div class="card-body js-add-branch_answer"  data-toggle="collapse">
                                            <label>Ответ</label><div class="flex_answer"><input type="text" value="" class="form-control inp"></div>
                                        </div>
                                    </div>
                        </div>
                    </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
