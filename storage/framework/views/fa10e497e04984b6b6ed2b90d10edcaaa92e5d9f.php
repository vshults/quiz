

<?php $__env->startSection('content'); ?>
    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Пользователи</h1>
                        <br>
                        <a href="users/add"><button type="button" class="btn btn-primary">Добавить</button></a>
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
                    <th scope="col">Пользователь</th>
                    <th scope="col">Email</th>
                    <th scope="col">роль</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="js-add">
                <?php if(!empty($users)): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row_index foo">
                            <th scope="row"><?php echo e($loop->index + 1); ?></th>
                            <td><?php echo e($user['name']); ?></td>
                            <td><?php echo e($user['email']); ?></td>
                            <td><?php echo e($user['super_admin'] ? 'SuperAdmin' : 'Admin'); ?></td>
                            <td><a href="users/edit/<?php echo e($user['id']); ?>"><button type="button" class="btn btn-secondary edit_user">Редактировать</button></a></td>
                            <?php if(Auth::user()->id !== $user['id']): ?><td><button data-id="<?php echo e($user['id']); ?>" type="button" class="btn btn-danger delete_user">Удалить</button></td><?php endif; ?>
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

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/users.blade.php ENDPATH**/ ?>