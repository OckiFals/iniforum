<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>News Feeds</title>
    <?= Ngaji\view\View::makeHead() ?>
    <?php
    /**
     * @var PDOStatement $categories
     * @var array $users
     * @var PDOStatement $posts
     */
    $posts = $posts->fetchAll();
    ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <?= Ngaji\view\View::makeHeader() ?>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper" style="padding-top: 50px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Web System
                    <small> 1.0</small>
                </h1>

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>


            </section>

            <div class="content body">
                <!-- Main content -->
                <div class="row">
                    <!-- left column -->
                    <? if (Ngaji\Http\Session::flash()->has('flash-message')): ?>
                        <div class="col-md-12" id="flash-message">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
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
                    <!-- /.box-body -->

                    <div class="col-md-8">
                        <!-- general form elements disabled -->
                        <div class="box">
                            <div class="box-header">
                                <i class="fa fa-comments-o"></i>

                                <h3 class="box-title"> Hot Treads</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th style="width: 40px">Viewers</th>
                                    </tr>
                                    <? foreach ($posts as $post) : ?>
                                    <tr>
                                        <td>
                                            <?= Html::anchor('post/read/' . $post['id'] , $post['title']); ?>
                                        </td>
                                        <td>
                                            <?= $post['category_name'] ?>
                                        </td>
                                        <td><span class="badge bg-red"><?= $post['viewers'] ?></span></td>
                                    </tr>
                                    <? endforeach; ?>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a href="#">&laquo;</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.box -->
                        <div class="box box-warning">

                            <div class="box-header">
                                <i class="fa fa-comments-o"></i>

                                <h3 class="box-title">Timeline</h3>
                            </div>
                            <div class="box-body chat" id="chat-box">
                                <? foreach ($posts as $post) : ?>
                                    <!-- chat item -->
                                    <div class="item">
                                        <?= Html::loadIMG('user4-128x128.jpg', [
                                            'alt' => 'user image',
                                            'class' => 'online'
                                        ])
                                        ?>

                                        <p class="message">
                                            <a href="<?= HOSTNAME . '/profile/' . $post['name']?>" class="name">
                                                <small class="text-muted pull-right">
                                                    <i class="fa fa-bookmark-o"></i> <?= $post['category_name'] ?>
                                                </small>
                                                <small class="text-muted pull-right">
                                                    <i class="fa fa-clock-o"></i> 2:15 <?= "&nbsp" ?>
                                                </small>
                                                <?= $post['name'] ?>
                                            </a>
                                            <?= $post['title']; ?>
                                        </p>
                                        <div class="attachment">
                                            <h4>Attachments:</h4>

                                            <p class="filename">
                                                Theme-thumbnail-image.jpg
                                            </p>
                                            <article>
                                                <?= $post['post'] ?>
                                            </article>
                                            <div class="pull-right">
                                                <button class="btn btn-primary btn-sm btn-flat">Open</button>
                                            </div>
                                        </div>
                                        <!-- /.attachment -->
                                    </div>
                                    <!-- /.item -->
                                <? endforeach; ?>
                                <!-- chat item -->
                                <div class="item">
                                    <?= Html::loadIMG('user3-128x128.jpg', ['alt' => 'user image', 'class' => 'offline']) ?>

                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15
                                            </small>
                                            Alexander Pierce
                                        </a>
                                        I would like to meet you to discuss the latest news about
                                        the arrival of the new theme. They say it is going to be one the
                                        best themes on the market
                                    </p>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.chat -->
                            <div class="box-footer">
                                <div class="input-group">

                                </div>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!--/.col (right) -->

                    <?= Html::render('template/sidebar-right.php', [
                        'users' => $users,
                        'categories' => $categories->fetchAll()
                    ])
                    ?>
                    <!-- /.row -->
                </div>
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
    <!-- AdminLTE App -->
    <?= Html::load('js', 'dist/app.min.js') ?>


    <!--modal-->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-pink">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title">Bantuan</h4>
                </div>
                <div class="modal-body">
                    <p>Untuk pertanyaan seputar <strong>BELAJAR DISINI</strong> bisa langsung menghubungi admin via
                        email <a
                            href="mailto:belajardisini2014@gmail.com">belajardisini2014[at]gmail[dot]com</a>. </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--akhir modal-->
    <script type="text/javascript">$('#login').modal(options)</script>
</body>
</html>