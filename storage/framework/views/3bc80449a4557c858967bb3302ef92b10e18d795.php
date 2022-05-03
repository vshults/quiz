<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;}
            .deleteAnswerImage{
                color: red;
                position: relative;
                cursor: pointer;
                font-size: 24px;
                bottom: 225px;
                top: auto;
            }
        </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать Вопрос</h1>
                        <a href="<?php echo e($prev); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="form-group js-edit-questions-setting">
                <label>Короткое название</label>
                <input type="text" data-id="<?php echo e($id); ?>" data-name="stage" class="form-control inp"  value="<?php echo e($stage); ?>">
                <br>
                <label>Тип</label>
                <select data-id="<?php echo e($id); ?>" class="form-control inp" data-name="type">
                    <option <?php echo e($type === 'radio' ? 'selected' : ''); ?>>radio</option>
                    <option <?php echo e($type === 'checkbox' ? 'selected' : ''); ?>>checkbox</option>
                </select>
                <br>
                <label>Статус</label>
                <select data-id="<?php echo e($id); ?>" class="form-control inp" data-name="required">
                    <option <?php echo e($required === 1 ? 'selected' : ''); ?>>Обязательный</option>
                    <option <?php echo e($required === 0 ? 'selected' : ''); ?>>Необязательный</option>
                </select>
                <br>
                <label for="exampleInputFile">Картинка</label>
                <div class="form-group">
                    <form data-name="img" id="image" class="form-group uploadImage uploadImagePost" data-id="<?php echo e($id); ?>" method="POST" enctype="multipart/form-data">
                        <input data-id="<?php echo e($id); ?>" class="upload"
                               id="image"
                               type="file"
                               name="image_question"
                               accept=".jpg, .jpeg, .png, .webp, .heif"
                               multiple>
                    </form>
                </div>
                <?php if(!empty($img)): ?>
                    <a href="<?php echo e($img); ?>" data-fancybox data-caption="<?php echo e($title); ?>"><img style="width: 400px" src="<?php echo e($img); ?>" class="img-thumbnail"></a>
                    <i class="fa fa-times deleteAnswerImage" onclick=" deleteQuestionImage('<?php echo e(SITE . '/admin/host/question/deleteQuestionImage'); ?>')" data-id="<?php echo e($id); ?>" aria-hidden="true"></i>
                <?php endif; ?>
            </div>

        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/question/editQuestion.blade.php ENDPATH**/ ?>