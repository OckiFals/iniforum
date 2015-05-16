<!DOCTYPE html>
<html>
<head>
    <?php
    /**
     * @var PDOStatement $categories
     * @var array $account
     * @var array $users
     * @var PDOStatement $posts
     */
    ?>
    <meta charset="UTF-8">
    <title>Profile <?= $account['name'] ?></title>
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
            <section class="content-header">
                <h1>
                    Web System
                    <small> 1.0</small>
                </h1>

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a><i class="fa fa-user"></i> Profile</a></li>
                    <li class="active"><?= $account['name'] ?></li>
                </ol>


            </section>

            <div class="content body">
                <!-- Main content -->
                <div class="row">
                    <!-- left column -->

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
                                        <th style="width: 10px">#</th>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">55%</span></td>
                                    </tr>
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
                                <? if (1 > $posts->rowCount()): ?>
                                    <h3 class="box-title">This Member has no post</h3>
                                <? else: ?>
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
                                                    <a href="<?= HOSTNAME . '/profile/' . $post['username'] ?>"
                                                       class="name">
                                                        <small class="text-muted pull-right">
                                                            #<?= $post['id'] ?>
                                                        </small>
                                                        <small class="text-muted pull-right">
                                                            <i class="fa fa-bookmark-o"></i> <?= $post['category_name'] . "&nbsp" ?>
                                                        </small>
                                                        <small class="text-muted pull-right">
                                                            <i class="fa fa-clock-o"></i> 2:15 <?= "&nbsp" ?>
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
                                                        <?= $post['post'] ?>
                                                    </article>
                                                </div>
                                                <div class="attachment">
                                                    <h4>Comments</h4>

                                                    <p>
                                                        Theme-thumbnail-image.jpg
                                                    </p>

                                                    <div class="pull-right">
                                                        <button class="btn btn-primary btn-sm btn-flat">Open</button>
                                                    </div>
                                                </div>
                                                <!-- /.attachment -->
                                            </div>
                                            <!-- /.item -->
                                        <? endforeach; ?>
                                    </div>
                                <? endif; ?>
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
            <<?= Ngaji\view\View::makeFooter() ?>
        </footer>
    </div>
    <!-- ./wrapper -->
</body>
</html>