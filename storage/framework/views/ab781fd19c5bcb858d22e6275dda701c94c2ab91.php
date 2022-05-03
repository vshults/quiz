<?php
$editHost                 = SITE . '/admin/host/edit/host';
$editSetting              = SITE . '/admin/host/edit/setting';
$editQuestions            = SITE . '/admin/host/edit/questions';
$addHost                  = SITE . '/admin/host/addHost';
$addSettingItem           = SITE . '/admin/host/addSettingItem';
$deleteHost               = SITE . '/admin/host/deleteHost';
$addBranch                = SITE . '/admin/host/question/add/branch';
$addQuestion              = SITE . '/admin/host/question/add';
$deleteQuestion           = SITE . '/admin/host/question/delete';
$addAnswer                = SITE . '/admin/host/answer/add';
$deleteAnswer             = SITE . '/admin/host/answer/delete';
$deleteBranch             = SITE . '/admin/host/branch/delete';
$uploadImage              = SITE . '/admin/host/edit/question/uploadImage';
$tickets                  = SITE . '/admin/tickets';
$addUser                  = SITE . '/admin/user/add';
$editUser                 = SITE . '/admin/user/edit';
$deleteUser               = SITE . '/admin/user/delete';
$sortQuestions            = SITE . '/admin/sortQuestions';
$addSelection             = SITE . '/admin/selection/addSelection';
$deleteSelection          = SITE . '/admin/selection/deleteSelection';
$addQuestionSelection     = SITE . '/admin/selection/addQuestionSelection';
$deleteQuestionSelection  = SITE . '/admin/selection/deleteQuestionSelection';
$addAnswerSelection       = SITE . '/admin/selection/answer/add';
$deleteAnswerSelection    = SITE . '/admin/selection/answer/delete';
$addBranchSelection       = SITE . '/admin/selection/add/branch';
$editSelection            = SITE . '/admin/selection/edit';
$saveSelection            = SITE . '/admin/host/saveSelection';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/admin.css')); ?>">
</head>
<style> element.style {min-height: auto;} .user-panel img{width: 3.1rem;}  .user-panel .info{padding: 2px 5px 5px 10px;}</style>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php if(!empty(Auth::user()->img)): ?>
                        <img src="<?php echo e(Storage::disk('s3')->url(Auth::user()->img)); ?>" class="img-circle elevation-2" alt="User Image">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/admin/img/AdminLTELogo.png')); ?>" class="img-circle elevation-2" alt="User Image">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <a class="d-block"><?php echo e(Auth::user()->name); ?></a><a href="/logout" class="d-block">выйти</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <!--<li class="nav-item">
                        <a href="<?php echo e(route('admin.index')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Главная
                            </p>
                        </a>
                    </li>-->
                    <?php if(Auth::user()->super_admin): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Пользователи
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.hosts')); ?>" class="nav-link">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                Домены
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.questionsSelections')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Подборки вопросов
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.graphs')); ?>" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Статистика
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.tickets')); ?>" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Заявки
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Разработано LEGOCAR <?= date('Y'); ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<script src="<?php echo e(asset('assets/admin/js/admin.js')); ?>" ></script>
<script src="<?php echo e(asset('assets/admin/js/main.js')); ?>" ></script>
<script src="<?php echo e(asset('assets/admin/js/ajax.js')); ?>" ></script>

<script>

    editHost('<?php echo e($editHost); ?>');
    addHost('<?php echo e($addHost); ?>');
    deleteHost('<?php echo e($deleteHost); ?>');

    editSelection('<?php echo e($editSelection); ?>');
    addSelection('<?php echo e($addSelection); ?>');
    deleteSelection('<?php echo e($deleteSelection); ?>');
    addQuestionSelection('<?php echo e($addQuestionSelection); ?>');
    deleteQuestionSelection('<?php echo e($deleteQuestionSelection); ?>');
    addAnswerSelection('<?php echo e($addAnswerSelection); ?>');
    deleteAnswerSelection('<?php echo e($deleteAnswerSelection); ?>');
    addBranchSelection('<?php echo e($addBranchSelection); ?>');
    saveSelection('<?php echo e($saveSelection); ?>');

    questionTitle('<?php echo e($editQuestions); ?>');
    editAnswer('<?php echo e($editQuestions); ?>');
    editQuestionsSetting('<?php echo e($editQuestions); ?>');

    addQuestion('<?php echo e($addQuestion); ?>');
    deleteQuestion('<?php echo e($deleteQuestion); ?>');
    addAnswer('<?php echo e($addAnswer); ?>');
    deleteAnswer('<?php echo e($deleteAnswer); ?>');
    addBranch('<?php echo e($addBranch); ?>');
    deleteBranch('<?php echo e($deleteBranch); ?>');

    uploadImageQuestion('<?php echo e($editQuestions); ?>');
    uploadImageAnswer('<?php echo e($editQuestions); ?>');
    uploadImageUser('<?php echo e($editUser); ?>');


    editSetting('<?php echo e($editSetting); ?>');

    addUser('<?php echo e($addUser); ?>');
    editUser('<?php echo e($editUser); ?>');
    deleteUser('<?php echo e($deleteUser); ?>');

    function getJson() {
        return JSON.parse($('#json-input').val());
    }

    var editor = new JsonEditor('#json-display', getJson());
    editor.load(getJson());

</script>

</html>
<?php /**PATH C:\OpenServer\domains\quiz-servise\resources\views/admin/layouts/layout.blade.php ENDPATH**/ ?>