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
     * @var PDOStatement $hotposts
     * @var PDOStatement $posts
     */
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
                    <? if (Ngaji\Http\Session::flash()->has('flash-message-info')): ?>
                        <div class="col-md-12" id="flash-message-info">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check-square-o"></i> Info!</h4>
                                <?= Ngaji\Http\Session::flash()->pop('flash-message-info') ?>
                            </div>
                        </div>
                        <script>
                            window.setTimeout(hideFlashMessage, 8000);

                            function hideFlashMessage() {
                                $('#flash-message-info').fadeOut('normal');
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
                                        <th style="width: 40px">Comments</th>
                                    </tr>
                                    <? foreach ($hotposts as $post) : ?>
                                        <tr>
                                            <td>
                                                <?= Html::anchor('post/read/' . $post['id'], $post['title']); ?>
                                            </td>
                                            <td>
                                                <?= $post['category_name'] ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><i class="fa fa-eye">
                                                    </i> <?= $post['viewers'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-olive"><i class="fa fa-comment">
                                                    </i> <?= $post['comment_count'] ?>
                                                </span>
                                            </td>
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
                                        <?= Html::loadIMG($post['account_photo'], [
                                            'alt' => 'user image',
                                            'class' => 'online'
                                        ])
                                        ?>
                                        <p class="message">
                                            <a href="<?= HOSTNAME . '/profile/' . $post['username'] ?>" class="name">
                                                <small class="text-muted pull-right">
                                                    #<?= $post['id'] ?>
                                                </small>
                                                <small class="text-muted pull-right">
                                                    <i class="fa fa-bookmark-o"></i> <?= $post['category_name'] . "&nbsp" ?>
                                                </small>
                                                <small class="text-muted pull-right">
                                                    <i class="fa fa-clock-o"></i> <?= date_format_en($post['created_at']) . "&nbsp" ?>
                                                </small>
                                                <?= $post['name'] ?>
                                            </a>

                                            <?= Html::anchor(
                                                'post/read/' . $post['id'],
                                                $post['title']
                                            ) ?>
                                            <?
                                            # menampilkan aksi edit dan hapus untuk artikel milik member login
                                            if (\Ngaji\Http\Request::is_authenticated() and
                                                $post['account_id'] == \Ngaji\Http\Request::user()->id
                                            ): ?>
                                                <?= Html::anchor("post/edit/" . $post['id'],
                                                    '<i class="fa fa-edit"></i> Edit', [
                                                        'class' => 'btn btn-sm btn-flat'
                                                    ]
                                                ) ?>
                                                <?= Html::anchor("#",
                                                    '<i class="fa fa-trash-o"></i> Delete', [
                                                        'class' => 'btn btn-sm btn-flat',
                                                        'data-post-id' => $post['id'],
                                                        'data-post-title' => $post['title'],
                                                        'data-href' => sprintf(
                                                            "%s/post/delete/%d",
                                                            HOSTNAME, $post['id']
                                                        ),
                                                        'data-toggle' => "modal",
                                                        'data-target' => "#confirm-delete"
                                                    ]
                                                ) ?>
                                            <? endif; ?>
                                        </p>
                                        <div class="attachment">
                                            <article>
                                                <?= Post::limit($post['post']) ?>
                                            </article>
                                        </div>
                                        <div class="attachment">
                                            <span class="badge bg-primary"><i class="fa fa-eye">
                                                </i> <?= $post['viewers'] ?>
                                            </span>
                                            <span class="badge bg-olive">
                                                <i class="fa fa-comment"></i> <?= $post['comment_count'] ?>
                                            </span>

                                            <?= Html::anchor('post/read/' . $post['id'] . '#comment',
                                                'Write a comment'
                                            ) ?>
                                        </div>
                                        <!-- /.attachment -->
                                    </div>
                                    <!-- /.item -->
                                <? endforeach; ?>
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
            <?= Ngaji\view\View::makeFooter() ?>
        </footer>
    </div>
</body>
</html>