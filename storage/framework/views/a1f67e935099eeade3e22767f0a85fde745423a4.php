<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}</style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать домен</h1>
                        <a href="<?php echo e(route('admin.hosts')); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="form-group js-edit-host">
                <label>Название</label>
                <input type="text" class="form-control inp" data-name="domen" data-id="<?php echo e($host['id']); ?>" value="<?php echo e($host['domen']); ?>">
                <br>
                <label>Статус</label>
                <select data-name="status" data-id="<?php echo e($host['id']); ?>" class="form-control inp" >
                    <option <?php echo e($host['status'] === 1 ? 'selected' : ''); ?>>1</option>
                    <option <?php echo e($host['status'] === 0 ? 'selected' : ''); ?>>0</option>
                </select>
                <br>
                <label>Контроль заявок</label>
                <textarea class="form-control inp" data-name="control_emails" data-id="<?php echo e($host['id']); ?>" value="<?php echo e($host['control_emails']); ?>" cols="30" rows="10"><?php echo e($host['control_emails']); ?></textarea>
                <?php if(Auth::user()->super_admin): ?>
                    <br>
                    <label>Скрипты</label>
                    <textarea class="form-control inp" data-name="scripts" data-id="<?php echo e($host['id']); ?>" value="<?php echo e($host['scripts']); ?>" cols="30" rows="10"><?php echo e($host['scripts']); ?></textarea>
                    <br>
                <?php endif; ?>

            </div>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/host/editHost.blade.php ENDPATH**/ ?>