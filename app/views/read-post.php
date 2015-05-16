<!DOCTYPE html>
<html>
<?php
/**
 * @var PDOStatement $categories
 * @var array $users
 * @var PDOStatement $hotposts
 * @var PDOStatement $posts
 * @var PDOStatement $post['comments']
 */
?>
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
                    <li>
                        <?= Html::anchor('',
                            Html::italic('', [
                                'class' => 'fa fa-dashboard'
                            ]) . ' Home'
                        ) ?>
                    </li>
                    <li><i class="fa fa-eye"></i> Read</li>
                    <li class="active"><?= $post['title'] ?></li>
                </ol>
            </section>
            <!-- /.content -->
            <div class="content body">
                <!-- Main content -->

                <div class="row">
                    <!-- left column -->

                    <div class="col-md-8">
                        <div class='box box-info'>
                            <div class='box-header with-border'>
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
                                        <?= Html::anchor("#",
                                            '<i class="fa fa-trash-o"></i> Delete', [
                                                'class' => 'btn btn-info btn-sm btn-flat',
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
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="chat-box">
                                <div class="item">
                                    <?= $post['post'] ?>
                                </div>
                                <label>Comments</label>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <? if (1 > $post['comments']->rowCount()): ?>
                                        <h3>No comment on this post</h3>
                                    <? endif; ?>
                                    <? foreach ($post['comments'] as $comment): ?>
                                    <div class="item">
                                        <?= Html::loadIMG($comment['account_photo'], [
                                            'alt' => 'user image',
                                            'class' => 'online'
                                        ])
                                        ?>
                                        <p class="message">
                                            <a href="<?= HOSTNAME . '/profile/' . $comment['username'] ?>" class="name">
                                                <small class="text-muted pull-right">
                                                    <i class="fa fa-clock-o"></i> 2:15 <?= "&nbsp" ?>
                                                </small>
                                                <?= $comment['name'] ?>
                                            </a>
                                            <?
                                            # menampilkan aksi edit dan hapus untuk artikel milik member login
                                            if (\Ngaji\Http\Request::is_authenticated() and
                                                $comment['id_account'] == \Ngaji\Http\Request::user()->id): ?>
                                                <?= Html::anchor("comments/edit/" . $comment['comments_id'],
                                                    '<i class="fa fa-edit"></i> Edit', [
                                                        'class' => 'btn btn-sm btn-flat'
                                                    ]
                                                ) ?>
                                                <?= Html::anchor("#",
                                                    '<i class="fa fa-trash-o"></i> Delete', [
                                                        'class' => 'btn btn-sm btn-flat',
                                                        'data-post-id' => $comment['comments_id'],
                                                        'data-type-modal' => 'comment',
                                                        'data-post-title' => $comment['text'],
                                                        'data-href' => sprintf(
                                                            "%s/comments/delete/%d",
                                                            HOSTNAME, $comment['comments_id']
                                                        ),
                                                        'data-toggle' => "modal",
                                                        'data-target' => "#confirm-delete"
                                                    ]
                                                ) ?>
                                            <? endif; ?>
                                        </p>
                                        <div class="attachment">
                                            <article>
                                                <?= $comment['text']?>
                                            </article>

                                        </div>
                                        <!-- /.attachment -->
                                    </div>
                                    <!-- /.item -->
                                    <? endforeach ?>
                            </div>
                            <div class="box-footer" id="comment">

                                </div>
                                <?= Html::form_begin('comments/add') ?>
                                <? if (Ngaji\Http\Request::is_authenticated()) : ?>
                                <input type="text" name="post_id" value="<?= $post['id'] ?>" hidden="hidden">
                                <input type="text" name="member_id" value="<?= Ngaji\Http\Request::user()->id ?>" hidden="hidden">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Write a comment ..." required></textarea>
                                <br/>
                                <button type="submit" class="btn btn-primary btn-flat">Post</button>
                                <? else: ?>
                                <textarea class="form-control" name="comment" rows="3" placeholder="Write a comment ..." required disabled></textarea>
                                <br/>
                                <button type="submit" class="btn btn-primary btn-flat" disabled>Post</button>
                                    <?= Html::anchor('login?next=post/read/' . $post['id'] . '#comment' , 'You must login to post a comment!') ?>
                                <? endif; ?>
                                <!-- /.col -->
                                <?= Html::form_end() ?>
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
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?= Ngaji\view\View::makeFooter() ?>
        <!-- CkEditor -->
        <?= Html::load('js', 'plugins/ckeditor/ckeditor.js') ?>
        <!-- WSGYeditor -->
        <?= Html::load('js', 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>

    </footer>
</div>
<!-- ./wrapper -->


<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    });
</script>
</body>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
</html>