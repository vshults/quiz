<?php $__env->startSection('content'); ?>
    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Домены</h1>
                        <br>
                        <a href="<?php echo e(route('hostAddForm')); ?>"><button type="button" class="btn btn-primary">Добавить</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Домен</th>
                    <?php if(Auth::user()->super_admin): ?><th scope="col">Пользователь</th><?php endif; ?>
                    <th scope="col">Статус</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="js-add">
                <?php if(!empty($hosts)): ?>
                    <?php $__currentLoopData = $hosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $host): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="row_index foo">
                        <th scope="row"><?php echo e($loop->index + 1); ?></th>
                        <td><?php echo e($host['domen']); ?></td>
                        <?php if(Auth::user()->super_admin): ?><td><?php echo e($host['email']); ?></td><?php endif; ?>
                        <td><?php echo e($host['status']); ?></td>
                        <td>
                            <ul class = "nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Редактировать <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="js-edit-host"><a class="js-edit-host" role="menuitem" tabindex="-1" href="host/edit/host/<?php echo e($host['id']); ?>">Домен</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="host/edit/setting/<?php echo e($host['setting_id']); ?>">Фронт</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="host/edit/questions/<?php echo e($host['id']); ?>">Вопросы</a></li>
                                    </ul>
                                </li>
                                <li class="btn_delete">
                                    <button type="button" data-id="<?php echo e($host['id']); ?>" class="btn btn-secondary delete_host">Удалить</button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>
            </table>

        </section>
        <!-- /.content -->
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-service\resources\views/admin/host/host.blade.php ENDPATH**/ ?>