@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question_selection{margin-left: 10px;margin-right: auto;}.add_answer_selection{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;}  .image_answer{font-size: 22px;color: #007bff;cursor: pointer}
            .product-photos__item--add {
                border: none;
                width: 50px!important;
                min-width: 50px!important;
                background-color: transparent;
            }
            .product-photos__item {
                height: 25px;
                background: #fff;
                border-radius: 5px;
                margin: 5px 5px 5px 0;
                overflow: hidden;
                display: inline-block;
                position: relative;
            }
            .product-photos__item--add input[type=file] {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
            }
            .image_block_answer{
                display: flex;
                margin-left: 0.5%;
            }
            .js-edit-answer{
                margin-right: auto;
            }
            .deleteAnswerImage{
                color: red;
                position: relative;
                cursor: pointer;
                bottom: 40%;
                font-size: 14px;
                top: auto;
            }
        </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать Ветку</h1>
                        <a href="{{$question['prev']}}"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @if(!empty($question))
                    <div class="accordion connectedSortable ui-sortable" id="accordion{{$question['id']}}" data-target="#collapse{{$question['id']}}" aria-expanded="true" aria-controls="collapse{{$question['id']}}" >
                        <div class="card" id='{{$question['index']}}"-{{$question['id']}}' >
                            <div class="card-header" id="heading{{$question['id']}}"  data-toggle="collapse" data-target="#collapse{{$question['id']}}" aria-expanded="true" aria-controls="collapse{{$question['id']}}">
                                <h5 class="mb-0 js-edit-question_title">
                                    <label>Вопрос</label>
                                    <button class="btn btn-link" type="button">
                                        <input type="text" data-id="{{$question['id']}}" data-name="title" class="form-control inp"  value="{{$question['title']}}"> <a href="{{$edit . $question['id'] . '/edit'}}"><button type="button" class="btn btn-secondary edit_question_selection">Редактировать</button></a>@if(!empty($question['branch_id']))  <a href="{{SITE . '/admin/selection/' . $question['selection_id'] . '/question/' . $question['branch_id']}}"><button type="button" class="btn btn-secondary show_branch">Посмотреть ветку</button></a> <button type="button" data-id="{{$question['branch_id']}}" data-type="question" class="btn btn-danger delete_branch_question">Удалить ветку</button> @else   @if(trim(strtolower($question['type'] !== 'radio'))) <a><button data-id="{{$question['id']}}" data-selectionID="{{$selectionID}}" type="button" data-type="question" class="btn btn-secondary add_branch_selection">Добавить ветку</button></a> @endif @endif
                                    </button>
                                </h5>
                            </div>
                            @if(!empty($question['answers']))
                                @foreach($question['answers'] as $answer)
                                    <div id="collapse{{$question['id']}}" class="collapse show" aria-labelledby="heading{{$question['id']}}" data-parent="#accordion{{$question['id']}}">
                                        <div class="card-body"  data-toggle="collapse">
                                            <label>Ответ</label><div class="flex_answer js-edit-answer"><input data-answer="true" data-id="{{$answer['id']}}" data-name="answer" type="text" value="{{$answer['answer']}}" class="form-control inp"> @if(!empty($answer['branch_id']))  <a href="{{SITE .  '/admin/selection/' . $question['selection_id'] . '/question/' . $answer['branch_id']}}"><button type="button" class="btn btn-secondary show_branch">Посмотреть ветку</button></a> <button type="button" data-id="{{$answer['id']}}" data-type="answer" class="btn btn-danger delete_branch">Удалить ветку</button> @else  @if(trim(strtolower($question['type'] === 'radio'))) <a><button data-id="{{$answer['id']}}" data-selectionID="{{$selectionID}}" type="button" data-type="answer" class="btn btn-secondary add_branch_selection">Добавить ветку</button></a> @endif @endif <a><button type="button" data-id="{{$answer['id']}}" class="btn btn-danger delete_answer">Удалить ответ</button></a></div>
                                        </div>
                                        <br>
                                        <div class="image_block_answer">
                                            <form id="imageAnswer" class="form-group imageAnswerUpload" data-id="{{$answer['id']}}" method="POST" enctype="multipart/form-data" data-name="image_answer">
                                                <button type="button"
                                                        class="product-photos__item product-photos__item--add fas image_answer fa-plus"
                                                        title="Крестик крутится, картинка грузится">
                                                    <input type="file" class="button__input"
                                                           data-answer="true"
                                                           data-id="{{$answer['id']}}"
                                                           id="imageAnswer"
                                                           name="image_answer"
                                                           accept=".jpg, .jpeg, .png, .webp, .heif"
                                                           multiple>
                                                </button>
                                            </form>
                                            @if(!empty($answer['img']))
                                                <div class="image_anwer">
                                                    <a href="{{$answer['img']}}" data-fancybox data-caption="{{$answer['answer']}}"><img style="width: 100px;height: 75px;" src="{{$answer['img']}}" class=""></a>
                                                    <i class="fa fa-times deleteAnswerImage" onclick=" deleteAnswerImage('{{SITE . '/admin/host/answer/deleteAnswerImage'}}')" data-id="{{$answer['id']}}" aria-hidden="true"></i>
                                                </div>
                                            @endif
                                        </div>

                                        @endforeach
                                        @else
                                            @if(!empty($question['answers']))
                                                <button type="button" class="btn btn-secondary add_branch_selection">Добавить ветку</button>
                                    </div>
                                    @endif
                                    @endif
                                    <br>
                                    <button type="button" data-id="{{$question['id']}}" class="btn btn-primary add_answer_selection">Добавить ответ</button>
                        </div>
                    </div>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
