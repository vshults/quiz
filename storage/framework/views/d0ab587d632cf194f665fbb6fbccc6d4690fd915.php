<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.form-control{width: 320px;margin-left: 0.5%}.content{margin-bottom: 50px}.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;} .image_answer{font-size: 22px;color: #007bff;cursor: pointer}
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
                margin-left: -0.5%;
            }
            .js-edit-answer{
                margin-left: -0.5%;
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
                        <h1>Редактировать Вопросы</h1>
                        <a href="<?php echo e(route('admin.hosts')); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            <br>
            <select data-host-id="<?php echo e($hostID); ?>" class="form-control js-react-save-select">
                <option data-host-id="<?php echo e($hostID); ?>" data-selection-id="" <?php echo e(empty($host['selection_id']) ? 'selected' : ''); ?>>Произвольный</option>
                <?php if(!empty($selections)): ?>
                    <?php $__currentLoopData = $selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(!empty($host) ? ($selection['id'] === $host['selection_id'] ? 'selected' : '') : ''); ?> data-selection-id="<?php echo e($selection['id']); ?>"><?php echo e($selection['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
            <br>
            <button type="button" data-selection-id="<?php echo e(!empty($host['selection_id']) ? $host['selection_id'] : ''); ?>" data-host-id="<?php echo e($hostID); ?>" class="btn btn-primary add_question">Добавить вопрос</button>
        </section>
        <!-- Main content -->
        <section class="content">
            <?php if(!empty($questions)): ?>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion connectedSortable ui-sortable" id="accordion<?php echo e($question['id']); ?>" data-target="#collapse<?php echo e($question['id']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($question['id']); ?>" >
                        <div class="card" id='<?php echo e($index); ?>-<?php echo e($question['id']); ?>' >
                            <div class="card-header" id="heading<?php echo e($question['id']); ?>"  data-toggle="collapse" data-target="#collapse<?php echo e($question['id']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($question['id']); ?>">
                                <h5 class="mb-0 js-edit-question_title">
                                    <label>Вопрос</label>
                                    <button class="btn btn-link" type="button">
                                        <input type="text" data-id="<?php echo e($question['id']); ?>" data-name="title" class="form-control inp"  value="<?php echo e($question['title']); ?>"> <a href="<?php echo e($edit . $question['id'] . '/edit'); ?>"><button type="button" class="btn btn-secondary edit_qiestion">Редактировать</button></a> <button data-id="<?php echo e($question['id']); ?>" type="button" class="btn btn-danger delete_question">Удалить вопрос</button>
                                    </button>
                                </h5>
                            </div>
                            <?php if(!empty($question['answers'])): ?>
                                <?php $__currentLoopData = $question['answers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div id="collapse<?php echo e($question['id']); ?>" class="collapse show" aria-labelledby="heading<?php echo e($question['id']); ?>" data-parent="#accordion<?php echo e($question['id']); ?>">
                                        <div style="margin-bottom: -2%" class="card-body"  data-toggle="collapse">
                                            <label>Ответ</label>
                                            <div class="flex_answer js-edit-answer">
                                                <input data-answer="true" data-id="<?php echo e($answer['id']); ?>" data-name="answer" type="text" value="<?php echo e($answer['answer']); ?>" class="form-control inp"> <?php if(!empty($answer['branch_id'])): ?>  <a href="<?php echo e(SITE . '/admin/host/' . $question['host_id'] . '/question/' . $answer['branch_id']); ?>"><button type="button" class="btn btn-secondary show_branch">Посмотреть ветку</button></a> <button type="button" data-id="<?php echo e($answer['id']); ?>" class="btn btn-danger delete_branch">Удалить ветку</button> <?php else: ?>  <?php if(trim(strtolower($question['type'] === 'radio'))): ?>  <a><button data-id="<?php echo e($answer['id']); ?>" data-selection-id="<?php echo e(!empty($host['selection_id']) ? $host['selection_id'] : ''); ?>" data-hostID="<?php echo e($hostID); ?>" type="button" class="btn btn-secondary add_branch">Добавить ветку</button></a> <?php endif; ?> <?php endif; ?> <a><button type="button" data-id="<?php echo e($answer['id']); ?>" class="btn btn-danger delete_answer">Удалить ответ</button></a>
                                            </div>
                                            <br>
                                            <div class="image_block_answer">
                                                <form id="imageAnswer" class="form-group imageAnswerUpload" data-id="<?php echo e($answer['id']); ?>" method="POST" enctype="multipart/form-data" data-name="image_answer" >
                                                    <button type="button"
                                                            class="product-photos__item product-photos__item--add fas image_answer fa-plus"
                                                            title="Крестик крутится, картинка грузится">
                                                        <input type="file" class="button__input"
                                                               data-answer="true"
                                                               data-id="<?php echo e($answer['id']); ?>"
                                                               id="imageAnswer"
                                                               name="image_answer"
                                                               accept=".jpg, .jpeg, .png, .webp, .heif"
                                                               multiple>
                                                    </button>
                                                </form>
                                                <?php if(!empty($answer['img'])): ?>
                                                   <div class="image_answer">
                                                       <a href="<?php echo e($answer['img']); ?>" data-fancybox data-caption="<?php echo e($answer['answer']); ?>"><img style="width: 75px;height: 75px;" src="<?php echo e($answer['img']); ?>" class=""></a>
                                                       <i class="fa fa-times deleteAnswerImage" onclick=" deleteAnswerImage('<?php echo e(SITE . '/admin/host/answer/deleteAnswerImage'); ?>')" data-id="<?php echo e($answer['id']); ?>" aria-hidden="true"></i>
                                                   </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                    <?php if(!empty($question['answers'])): ?>
                                            <button type="button" class="btn btn-secondary add_branch">Добавить ветку</button>
                                    <?php endif; ?>
                            <?php endif; ?>
                                        <br>
                            <button type="button" data-id="<?php echo e($question['id']); ?>" class="btn btn-primary add_answer">Добавить ответ</button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/question/editQuestions.blade.php ENDPATH**/ ?>