<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp{width: 400px;}.content{margin-left: 10px;}.col-sm-6{display: flex;}.prev{margin-left: 40%;margin-top: 0.5%}.label_question{font-size: 18px}.label_answer{font-size: 18px}.add_question{margin-left: 10px;margin-right: auto;}.add_answer{width: 150px;margin-right: auto;margin-left: 10px;margin-bottom: 20px;}.flex_answer{display: flex;}.flex_answer button{margin-left: 20px;} </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавить домен</h1>
                        <a href="<?php echo e(route('admin.hosts')); ?>"><button class="btn btn-default prev">Назад</button></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div style="display: none" id="alert_success" class="alert alert-success" role="alert">
                Успешно!
            </div>
            <div style="display: none" id="alert-danger" class="alert alert-danger error_emails_host" role="alert"></div>
            <div style="display: none" id="alert-danger" class="alert alert-danger error_domen_host" role="alert"></div>
            <div class="form-group">
                <form id="addForm" class="form-group hostAdd" method="POST">
                    <label>Домен</label>
                    <input type="text" name="domen" class="form-control inp">
                    <br>
                    <label>Статус</label>
                    <select name="status" class="form-control inp">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                    <br>
                    <label>Контроль заявок</label>
                    <textarea class="form-control inp" name="emails" id="" cols="30" rows="10"></textarea>
                    <br>
                    <button type="submit" id="hostAdd" class="btn btn-primary">Добавить</button>
                </form>
            </div>

        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/host/addHost.blade.php ENDPATH**/ ?>