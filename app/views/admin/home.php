<!DOCTYPE html>
<html lang="ID">
<?php
/**
 * @var stdClass $posts
 * @var stdClass $comments
 * @var PDOStatement $categories
 */
?>
<head>
    <title>IniForum Admin</title>
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
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
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
                <? if (Ngaji\Http\Session::flash()->has('flash-message')): ?>
                    <div class="col-md-12" id="flash-message">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check-square-o"></i> Info!</h4>
                            <?= Ngaji\Http\Session::flash()->pop('flash-message') ?>
                        </div>
                    </div>
                    <script>
                        window.setTimeout(hideFlashMessage, 8000);

                        function hideFlashMessage() {
                            $('#flash-message').fadeOut('normal');
                        }
                    </script>
                <? endif; ?>
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Latest Threads</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th style="width: 40px">Viewers</th>
                                        <th style="width: 40px">Comments</th>
                                        <th>Action</th>
                                    </tr>
                                    <? foreach ($posts as $post) : ?>
                                        <tr>
                                            <td>
                                                <?= Html::anchor('post/read/' . $post->id, $post->title); ?>
                                            </td>
                                            <td>
                                                <?= $post->category_name ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><i class="fa fa-eye">
                                                    </i> <?= $post->viewers ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-olive"><i class="fa fa-comment">
                                                    </i> <?= $post->comment_count ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= Html::anchor("#",
                                                    '<i class="fa fa-trash-o"></i> Delete', [
                                                        'class' => 'btn btn-xs btn-flat btn-danger',
                                                        'data-post-id' => $post->id,
                                                        'data-type-modal' => 'comment',
                                                        'data-post-title' => $post->title,
                                                        'data-href' => sprintf(
                                                            "%s/post/delete/%d",
                                                            HOSTNAME, $post->id
                                                        ),
                                                        'data-toggle' => "modal",
                                                        'data-target' => "#confirm-delete"
                                                    ]
                                                ) ?>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    <!-- TABLE: LATEST COMMENTS -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Latest Comments</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tr>
                                        <th>Comments</th>
                                        <th>Member</th>
                                        <th>On Post</th>
                                        <th>Action</th>
                                    </tr>
                                    <? foreach ($comments as $comment) : ?>
                                        <tr>
                                            <td>
                                                <?= $comment->text ?>
                                            </td>
                                            <td>
                                                <?= $comment->name ?>
                                            </td>
                                            <td>
                                                <?= $comment->title ?>
                                            </td>
                                            <td>
                                                <?= Html::anchor("#",
                                                    '<i class="fa fa-trash-o"></i> Delete', [
                                                        'class' => 'btn btn-xs btn-flat btn-danger',
                                                        'data-post-id' => $comment->id,
                                                        'data-type-modal' => 'comment',
                                                        'data-post-title' => $comment->text,
                                                        'data-href' => sprintf(
                                                            "%s/comments/delete/%d",
                                                            HOSTNAME, $comment->id
                                                        ),
                                                        'data-toggle' => "modal",
                                                        'data-target' => "#confirm-delete"
                                                    ]
                                                ) ?>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
                <!-- /.col -->
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