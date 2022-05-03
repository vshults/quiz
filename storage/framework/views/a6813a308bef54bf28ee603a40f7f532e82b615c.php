

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question_selection{margin-left: 10px;margin-right: auto;}.add_answer_selection{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;} </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать Ветку</h1>
                        <a href="<?php echo e($prev); ?><?php echo e($selectionID); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php if(!empty($questions)): ?>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion connectedSortable ui-sortable" id="accordion<?php echo e($question['id']); ?>" data-target="#collapse<?php echo e($question['id']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($question['id']); ?>" >
                        <div class="card" id='<?php echo e($question['index']); ?>"-<?php echo e($question['id']); ?>' >
                            <div class="card-header" id="heading<?php echo e($question['id']); ?>"  data-toggle="collapse" data-target="#collapse<?php echo e($question['id']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($question['id']); ?>">
                                <h5 class="mb-0 js-edit-question_title">
                                    <label>Вопрос</label>
                                    <button class="btn btn-link" type="button">
                                        <input type="text" data-id="<?php echo e($question['id']); ?>" data-name="title" class="form-control inp"  value="<?php echo e($question['title']); ?>"> <a href="<?php echo e($edit . $question['id'] . '/edit'); ?>"><button type="button" class="btn btn-secondary edit_question_selection">Редактировать</button></a> <button data-id="<?php echo e($question['id']); ?>" type="button" class="btn btn-danger delete_question_selection">Удалить вопрос</button>
                                    </button>
                                </h5>
                            </div>
                            <?php if(!empty($question['answers'])): ?>
                                <?php $__currentLoopData = $question['answers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div id="collapse<?php echo e($question['id']); ?>" class="collapse show" aria-labelledby="heading<?php echo e($question['id']); ?>" data-parent="#accordion<?php echo e($question['id']); ?>">
                                        <div class="card-body"  data-toggle="collapse">
                                            <label>Ответ</label><div class="flex_answer js-edit-answer"><input data-answer="true" data-id="<?php echo e($answer['id']); ?>" data-name="answer" type="text" value="<?php echo e($answer['answer']); ?>" class="form-control inp"> <?php if(!empty($answer['branch_id'])): ?>  <a href="<?php echo e($showBranch . $question['selection_id'] . '/branch/' . $answer['branch_id']); ?>"><button type="button" class="btn btn-secondary show_branch">Посмотреть ветку</button></a> <button type="button" data-id="<?php echo e($answer['id']); ?>" class="btn btn-danger delete_branch">Удалить ветку</button> <?php else: ?>  <?php if(trim(strtolower($question['type'] === 'radio'))): ?> <a><button data-id="<?php echo e($answer['id']); ?>" data-selectionID="<?php echo e($selectionID); ?>" type="button" class="btn btn-secondary add_branch_selection">Добавить ветку</button></a> <?php endif; ?> <?php endif; ?> <a><button type="button" data-id="<?php echo e($answer['id']); ?>" class="btn btn-danger delete_answer">Удалить ответ</button></a></div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php if(!empty($question['answers'])): ?>
                                                <button type="button" class="btn btn-secondary add_branch_selection">Добавить ветку</button>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <br>
                                    <button type="button" data-id="<?php echo e($question['id']); ?>" class="btn btn-primary add_answer_selection">Добавить ответ</button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/selection/showBranchSelection.blade.php ENDPATH**/ ?>