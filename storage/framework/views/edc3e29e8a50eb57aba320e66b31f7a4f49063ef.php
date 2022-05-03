

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}</style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать пользователя</h1>
                        <a href="<?php echo e(route('admin.users')); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="form-group js-edit-user">
                <label>Имя</label>
                <input type="text" name="name" data-name="name" data-id="<?php echo e($user['id']); ?>" value="<?php echo e($user['name']); ?>" class="form-control inp">
                <br>
                <label>Email</label>
                <input type="text" name="email" data-name="email" data-id="<?php echo e($user['id']); ?>" value="<?php echo e($user['email']); ?>" class="form-control inp">
                <br>
                <label>Пароль</label>
                <input type="password" name="password" data-name="password" data-id="<?php echo e($user['id']); ?>" value="<?php echo e($user['password']); ?>" class="form-control inp">
                <br>
                <label>Супер Админ</label>
                <select type="text" name="super_admin" data-name="super_admin" data-id="<?php echo e($user['id']); ?>" value="<?php echo e($user['super_admin']); ?>" class="form-control inp">
                    <option <?php echo e($user['super_admin'] ? 'selected' : ''); ?> value="0">Админ</option>
                    <option <?php echo e($user['super_admin'] ? 'selected' : ''); ?> value="1">Супер админ</option>
                </select>
            </div>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/editUser.blade.php ENDPATH**/ ?>