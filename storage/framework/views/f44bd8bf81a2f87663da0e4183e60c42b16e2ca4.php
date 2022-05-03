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
                <input type="text" name="name" data-name="name" data-id="<?php echo e($id); ?>" value="<?php echo e($name); ?>" class="form-control inp">
                <br>
                <label>Email</label>
                <input type="text" name="email" data-name="email" data-id="<?php echo e($id); ?>" value="<?php echo e($email); ?>" class="form-control inp">
                <br>
                <label>Пароль</label>
                <input type="password" name="password" data-name="password" data-id="<?php echo e($id); ?>" value="<?php echo e($password); ?>" class="form-control inp">
                <br>
                <label>Супер Админ</label>
                <select type="text" name="super_admin" data-name="super_admin" data-id="<?php echo e($id); ?>" value="<?php echo e($super_admin); ?>" class="form-control inp">
                    <option <?php echo e($super_admin ? 'selected' : ''); ?> value="0">Админ</option>
                    <option <?php echo e($super_admin ? 'selected' : ''); ?> value="1">Супер админ</option>
                </select>
                <br>
                <!--<label for="exampleInputFile">Картинка</label>
                <div class="form-group">
                    <form data-name="img" id="image" class="form-group uploadImageUser uploadImagePost" data-id="<?php echo e($id); ?>" method="POST" enctype="multipart/form-data">
                        <input data-id="<?php echo e($id); ?>" class="upload"
                               id="image"
                               type="file"
                               name="image_user"
                               accept=".jpg, .jpeg, .png, .webp, .heif"
                               multiple>
                    </form>
                </div>
                <?php if(!empty($img)): ?>
                    <a href="<?php echo e($img); ?>" data-fancybox data-caption="<?php echo e($name); ?>"><img style="width: 400px" src="<?php echo e($img); ?>" class="img-thumbnail"></a>
                <?php endif; ?>-->
            </div>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/user/editUser.blade.php ENDPATH**/ ?>