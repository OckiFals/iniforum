<!DOCTYPE html>
<html lang="ID">
<?php
/**
 * @var Array $badword
 * @var PDOStatement $categories
 */
?>
<head>
    <title>Badwords Add</title>
    <?= Ngaji\view\View::makeHead() ?>
    <!-- Morris chart -->
    <?= Html::load('css', 'plugins/morris/morris.css') ?>
    <!-- jvectormap -->
    <?= Html::load('css', 'plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>
    <!-- Daterange picker -->
    <?= Html::load('css', 'plugins/daterangepicker/daterangepicker-bs3.css') ?>
</head>

<body class="skin-blue">
<div class="wrapper">

    <header class="main-header">
        <?= Ngaji\view\View::makeHeader() ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <? Ngaji\view\View::render('admin/left-sidebar') ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <?= Html::anchor('', Html::fa('fa-dashboard', 'Home')) ?>
                </li>
                <li>
                    <?= Html::anchor('badwords', Html::fa('fa-exclamation-triangle', 'Badwords')) ?>
                </li>
                <li class="active">Add</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Content -->
            <div id="content" class="colM">
                <!--                <h1>Dashboard</h1>-->

                <br class="clear"/>
            </div>
            <!-- END Content -->

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class='box box-info'>
                    <div class='box-header'>
                        <h3 class='box-title'>Make a sensor</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip"
                                    title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip"
                                    title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class='box-body pad'>
                        <form action="" method="POST">

                            <div class="form-group">
                                <span class=select-group-addon">BadWord</span>
                                <? if (isset($badword)): ?>
                                    <input type="text" class="form-control" name="word" placeholder="Text..."
                                       <?= "value={$badword['word']}" ?> required="">
                                    <input type="text" name="id" value="<?= $badword['id'] ?>" hidden="hidden">
                                <? else: ?>
                                    <input type="text" class="form-control" name="word" placeholder="Text..." required="">
                                <? endif; ?>
                            </div>

                            <div class="box-footer text-right">
                                <?= Html::anchor('badwords',
                                        Html::fa('fa-times', 'Cancel'), [
                                            'class' => 'btn btn-app'
                                    ]
                                )
                                ?>
                                <button class="btn btn-app">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box -->

                <!-- /.col -->
                </div>
                    <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Categories</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <? foreach ($categories as $category) : ?>
                                <ul class="products-list product-list-in-box">
                                    <li class="item">
                                        <div class="product-img">
                                            <?= Html::loadIMG(
                                                $category->photo, [
                                                'alt' => 'Category Photo',
                                                'width' => 50,
                                                'height' => 50
                                            ]);
                                            ?>
                                        </div>
                                        <div class="product-info">
                                            <?= Html::anchor("categories/{$category->id}", $category->name .
                                                '<span class="label bg-olive pull-right"><i class="fa fa-file-text">
                                        </i>  ' . $category->post_count . '</span>', [
                                                    'class' => 'product-title'
                                                ]
                                            )
                                            ?>
                                            <span class="product-description">
                                <?= $category->description ?>
                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                </ul>
                            <? endforeach; ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript:" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recently Actions</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">

                                <? #side bar ?>

                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript:" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <?= Ngaji\view\View::makeFooter() ?>
    </footer>

</div>
<!-- ./wrapper -->
</body>
</html>