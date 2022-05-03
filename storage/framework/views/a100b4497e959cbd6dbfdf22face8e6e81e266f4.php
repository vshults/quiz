<?php $__env->startSection('content'); ?>

    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Заявки</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="info-box-content">
                <span class="info-box-text">Количество заявок</span>
                <span class="info-box-number"><?php echo e($count); ?></span>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Домены</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <?php if($hosts): ?>
                                        <?php $__currentLoopData = $hosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $host): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($k === $host['domen']): ?>
                                                    <li class="nav-item active">
                                                        <a href="?host=<?php echo e($host['id']); ?>" class="nav-link" style="cursor: pointer">
                                                            <i class="fas fa fa-laptop"></i><?php echo e($host['domen']); ?>

                                                            <span class="badge bg-primary float-right"><?php echo e($value); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Сортировка</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a  href="?sort=all" class="nav-link">
                                            <i class="far fa-circle text-secondary"></i>
                                            Все
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?sort=completed" class="nav-link">
                                            <i class="far fa-circle text-success"></i>
                                            Завершенные до конца
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?sort=unfinished" class="nav-link">
                                            <i class="far fa-circle text-danger"></i> Брошенные
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Заявки</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <?php echo e($tickets->appends(['sort' => request()->sort,'host' =>request()->host ])->links('vendor.pagination.bootstrap-4')); ?>

                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <?php if($tickets): ?>
                                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="mailbox-star">№<?php echo e($ticket->id); ?></td>
                                                    <td class="mailbox-star"><a href="#"><i class="fas fa-star <?php echo e(!empty($ticket->name) ? 'text-success' : 'text-danger'); ?>"></i></a></td>
                                                    <td class="mailbox-name"><a href="ticket/<?php echo e($ticket['id']); ?>"><?php echo e(!empty($ticket->name) ? $ticket->name : 'Без имени'); ?></a></td>
                                                    <td class="mailbox-subject"><b><?php echo e($ticket->phone); ?></b>
                                                    </td>
                                                    <td class="mailbox-date"><?php echo e(!empty($ticket->updated_at) ? $ticket->updated_at : $ticket->created_at); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/ticket/tickets.blade.php ENDPATH**/ ?>