<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>News Feeds</title>
    <?= Ngaji\view\View::makeHead() ?>
    <?php
    /**
     * @var PDOStatement $categories
     * @var array $post
     * @var array $users
     */

    $categories = $categories->fetchAll();
    ?>
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
                                <h3 class='box-title'>Edit post
                                    <small>no sara</small>
                                </h3>
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
                                        <span class=select-group-addon">Title</span>
                                        <input type="text" class="form-control" name="title" value="<?= $post['title'] ?>">
                                        <span class="select-group-addon">Category</span>
                                        <select name="category" class="form-control">
                                            <? foreach ($categories as $category) : ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <? endforeach; ?>
                                        </select>
                                        <label for="editor1">

                                        </label>
                                        <textarea id="editor1" name="post" rows="10" cols="80">
                                            <?= $post['post'] ?>
                                        </textarea>
                                    </div>

                                    <div class="box-footer text-right">
                                        <?= Html::anchor('/',
                                            Html::italic('', ([
                                                'class' => "fa fa-save"
                                            ])
                                            ) . ' Cancel', [
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