<?php $__env->startSection('content'); ?>

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
                <button type="button" data-user-id="<?php echo e(Auth::user()->id); ?>" class="btn btn-primary add_selection">Добавить</button>
                <br>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php if(!empty($questions_selections)): ?>
                <?php $__currentLoopData = $questions_selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e($selection['name']); ?></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                               <div class="card-body">
                                   <a href="<?php echo e('selection/editSelection/' . $selection['id']); ?>"><button type="button" data-id="" class="btn btn-secondary edit_selection">Редактировать подборку</button></a>
                                   <button type="button" data-id="<?php echo e($selection['id']); ?>" class="btn btn-danger delete_selection">Удалить подборку</button>
                               </div>
                           </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </section>
        <!-- /.content -->
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/selection/questionsSelections.blade.php ENDPATH**/ ?>