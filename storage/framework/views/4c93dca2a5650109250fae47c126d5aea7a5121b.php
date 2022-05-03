

<?php $__env->startSection('content'); ?>
    <style>.table_ticket td{width: 500px} </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="info-box-content">
                <span class="info-box-number"></span>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <a href="<?php echo e(route('admin.tickets')); ?>"><button class="btn btn-default prev">Назад</button></a>
                    <br><br>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Заявка <?php echo e($id); ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="mailbox-read-info">
                                        <h5><?php echo e($name); ?></h5>
                                        <h6><?php echo e($phone); ?>

                                            <span class="mailbox-read-time float-right"><?php echo e($date); ?></span></h6>
                                    </div>
                                    <div class="mailbox-read-message">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box">
                                                    <div class="box-body table-responsive no-padding">
                                                        <table class="table table-hover">
                                                            <tbody class="table_ticket"><tr>
                                                                <th>№</th>
                                                                <th>Вопрос</th>
                                                                <th>Ответ</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <?php if(!empty($data)): ?>
                                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                    <td><?php echo e($loop->index + 1); ?></td>
                                                                    <td><?php echo e($question); ?></td>
                                                                    <td><?php echo e($answer); ?></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            </tbody></table>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.mailbox-read-message -->
                                </div>
                                <!-- /.card-body -->

                                <!-- /.card-footer -->
                                <div class="card-footer">
                                    <div class="float-right">
                                    </div>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/ticket/ticketShow.blade.php ENDPATH**/ ?>