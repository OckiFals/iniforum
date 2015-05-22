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
                    <div class="col-md-4">
                    <!-- PROFILE -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title text-center">Profile</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-center-block">
                                    <?= Html::loadIMG($account['photo'], [
                                            'alt' => 'account image',
                                            'class' => 'img-responsive img-circle center-block',
                                            'width' => '140',
                                            'height' => '140'
                                        ]) 
                                    ?>
                                    
                                    <?= Html::anchor("profile/{$account['username']}",
                                            $account['name'], [
                                                'class' => 'users-list-name text-center',
                                            ]
                                        )
                                    ?>
                                    <span class="users-list-date text-center">@<?= $account['username'] ?></span>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Starfox221's Bio</div>
                                    <div class="panel-body"> 
                                        A long description about me.
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <!-- <div class="box-footer text-center">
                                <a href="#" class="uppercase">View All Categories</a>
                            </div> -->
                            <!-- /.box-footer -->
                        </div>
                    </div>
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
    <!-- ./wrapper -->
</body>
</html>