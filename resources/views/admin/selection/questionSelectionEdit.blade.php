@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;}
            .deleteAnswerImage{
                color: red;
                position: relative;
                cursor: pointer;
                font-size: 24px;
                bottom: 111px;
                top: auto;
            }
        </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать Вопрос</h1>
                        <a href="{{$prev}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="form-group js-edit-questions-setting">
                <label>Короткое название</label>
                <input type="text" data-id="{{$id}}" data-name="stage" class="form-control inp"  value="{{$stage}}">
                <br>
                <label>Тип</label>
                <select data-id="{{$id}}" class="form-control inp" data-name="type">
                    <option {{$type === 'radio' ? 'selected' : ''}}>radio</option>
                    <option {{$type === 'checkbox' ? 'selected' : ''}}>checkbox</option>
                    <option {{$type === 'range' ? 'selected' : ''}}>range</option>
                    <option {{$type === 'image' ? 'selected' : ''}}>checkbox</option>
                    <option {{$type === 'file' ? 'selected' : ''}}>file</option>
                    <option {{$type === 'textarea' ? 'selected' : ''}}>textarea</option>
                    <option {{$type === 'select' ? 'selected' : ''}}>select</option>
                </select>
                <br>
                <label>Статус</label>
                <select data-id="{{$id}}" class="form-control inp" data-name="required">
                    <option {{$required === 1 ? 'selected' : ''}}>Обязательный</option>
                    <option {{$required === 0 ? 'selected' : ''}}>Необязательный</option>
                </select>
                <br>
                <label for="exampleInputFile">Картинка</label>
                <div class="form-group">
                    <form data-name="img" id="image" class="form-group uploadImage uploadImagePost" data-id="{{$id}}" method="POST" enctype="multipart/form-data">
                        <input data-id="{{$id}}" class="upload"
                               id="image"
                               type="file"
                               name="image_question"
                               accept=".jpg, .jpeg, .png, .webp, .heif"
                               multiple>
                    </form>
                </div>
                @if(!empty($img))
                    <a href="{{$img}}" data-fancybox data-caption="{{$title}}"><img style="width: 400px" src="{{$img}}" class="img-thumbnail"></a>
                    <i class="fa fa-times deleteAnswerImage" onclick=" deleteQuestionImage('{{SITE . '/admin/host/question/deleteQuestionImage'}}')" data-id="{{$id}}" aria-hidden="true"></i>
                @endif
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
