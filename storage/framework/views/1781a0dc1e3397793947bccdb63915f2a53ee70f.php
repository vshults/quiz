<?php $__env->startSection('content'); ?>
    <style>.btn_delete{margin-left: 30%;margin-right: auto}

        @media (max-width:991.98px) {
            .padding {
                padding: 1.5rem
            }
        }

        @media (max-width:767.98px) {
            .padding {
                padding: 1rem
            }
        }

        .padding {
            padding: 5rem
        }

        .card {
            background: #fff;
            border-width: 0;
            border-radius: .25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            margin-bottom: 1.5rem
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(19, 24, 44, .125);
            border-radius: .25rem
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(19, 24, 44, .03);
            border-bottom: 1px solid rgba(19, 24, 44, .125)
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
        }

        card-footer,
        .card-header {
            background-color: transparent;
            border-color: rgba(160, 175, 185, .15);
            background-clip: padding-box
        }
        .MostPopularAnswers{
            margin-left: -37%;
            margin-top: -5%;
        }
        .QuestionsOftenLeft{
            margin-top: -10%;
            margin-left: -37%;
        }
    </style>

    <div hidden id="MostPopularAnswersLabels"><?php echo e(!empty($MostPopularAnswersLabels) ? $MostPopularAnswersLabels : ''); ?></div>
    <div hidden id="MostPopularAnswersValues"><?php echo e(!empty($MostPopularAnswersValues) ? $MostPopularAnswersValues : ''); ?></div>
    <div hidden id="QuestionsOftenLeftLabels"><?php echo e(!empty($QuestionsOftenLeftLabels) ? $QuestionsOftenLeftLabels : ''); ?></div>
    <div hidden id="QuestionsOftenLeftValues"><?php echo e(!empty($QuestionsOftenLeftValues) ? $QuestionsOftenLeftValues : ''); ?></div>
    <div hidden id="MostPopularAnswersColorsData"><?php echo e(!empty($MostPopularAnswersColorsData) ? $MostPopularAnswersColorsData : ''); ?></div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Статистика</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <div class="padding MostPopularAnswers">
                    <div class="row">
                        <div class="container-fluid d-flex justify-content-center">
                            <div class="col-sm-8 col-md-6">
                                <div class="card">
                                    <div class="card-header">Самые популярные ответы</div>
                                    <div class="card-body" style="height: 720px">
                                        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                            </div>
                                        </div> <canvas id="MostPopularAnswers" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="padding QuestionsOftenLeft">
                <div class="row">
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="col-sm-8 col-md-6">
                            <div class="card">
                                <div class="card-header">Вопросы на которых чаще всего бросают отвечать</div>
                                <div class="card-body" style="height: 720px">
                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                        </div>
                                    </div> <canvas id="QuestionsOftenLeft" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\quiz-service\resources\views/admin/graphs/graphs.blade.php ENDPATH**/ ?>