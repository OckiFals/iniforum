<!DOCTYPE html>
<html>
<head>
    <?php
    /**
     * @var PDOStatement $post
     * @var array $users
     */
    ?>
    <meta charset="UTF-8">
    <title><?= $post['title'] ?></title>
    <?= Ngaji\view\View::makeHead() ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <?= Ngaji\view\View::makeHeader() ?>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <div class="content body">
                <!-- Main content -->
                <div class="row">
                    <!-- left column -->

                    <div class="col-md-8">
                        <div class='box box-info'>
                            <div class='box-header'>
                                <h3 class='box-title'><?= $post['title'] ?>
                                    <small>
                                        <span class="badge bg-red">
                                            <i class="fa fa-eye"></i> <?= $post['viewers'] ?>
                                        </span>
                                    </small>
                                </h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <?
                                    # menampilkan aksi edit dan hapus untuk artikel milik member login
                                    if (\Ngaji\Http\Request::is_authenticated() and
                                        $post['account_id'] == \Ngaji\Http\Request::user()->id
                                    ): ?>
                                        <?= Html::anchor("post/edit/" . $post['id'],
                                            '<i class="fa fa-edit"></i> Edit', [
                                                'class' => 'btn btn-info btn-sm btn-flat'
                                            ]
                                        ) ?>
                                        <?= Html::anchor("post/delete/" . $post['id'],
                                            '<i class="fa fa-trash-o"></i> Delete', [
                                                'class' => 'btn btn-info btn-sm btn-flat'
                                            ]
                                        ) ?>
                                    <? endif; ?>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class='box-body pad'>
                                <article style="padding: 10px">
                                    <?= $post['post'] ?>
                                </article>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!--/.col (right) -->
                    <?= Html::render('template/sidebar-right.php', [
                        'users' => $users,
                        'categories' => $categories
                    ])
                    ?>
                </div>

                <!-- /.row -->
            </div>

            <section class="content-header">
                <h1>
                    Web System
                    <small> 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Add Post</li>
                </ol>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container-fluid">
            <div class="pull-right hidden-xs">
                <a>Made By <i>Ngaji 2.0, AngularJS</i> and <i class="fa fa-heart"></i></a>
            </div>
            <strong>Copyright &copy;<a>OckiFals</a>.</strong> All
            rights reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<?= Html::load('js', 'plugins/jQuery/jQuery-2.1.3.min.js') ?>
<!-- Bootstrap 3.3.2 JS -->
<?= Html::load('js', 'bootstrap.min.js') ?>
<!-- SlimScroll -->
<?= Html::load('js', 'plugins/slimScroll/jquery.slimscroll.min.js') ?>
<!-- FastClick -->
<?= Html::load('js', 'plugins/fastclick/fastclick.min.js') ?>
<!-- CkEditor -->
<?= Html::load('js', 'plugins/ckeditor/ckeditor.js') ?>
<!-- WSGYeditor -->
<?= Html::load('js', 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>
<!-- AdminLTE App -->
<?= Html::load('js', 'dist/app.min.js') ?>

<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    });
</script>
</body>
</html>