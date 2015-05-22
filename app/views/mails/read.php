<!DOCTYPE html>
<html>
<?php
/**
 * @var array $users
 * @var array $outboxes_count
 * @var array $inboxes_count
 * @var PDOStatement $message
 */
?>
<head>
    <meta charset="UTF-8">
    <title>Message: <?= $message['subject'] ?></title>
    <?= Ngaji\view\View::makeHead() ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <?= Ngaji\view\View::makeHeader() ?>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper"">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Mailbox
                    <small>13 new messages</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Mailbox</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <?= Html::anchor('mail/compose', 'Compose', [
                                'class' => 'btn btn-primary btn-block margin-bottom'
                            ]
                        ) ?>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Folders</h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="<?= HOSTNAME . '/mail' ?>"><i class="fa fa-inbox"></i>
                                            Inbox <span
                                                class="label label-primary pull-right"><?= $inboxes_count ?></span></a>
                                    </li>
                                    <li>
                                        <a href="<?= HOSTNAME . '/mail/sent' ?>"><i class="fa fa-envelope-o"></i> Sent
                                            <span class="label label-primary pull-right">
                                                <?= $outboxes_count ?>
                                            </span>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span
                                                class="label label-waring pull-right">65</span></a></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /. box -->
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Labels</h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $message['subject'] ?></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button class="btn btn-default btn-sm checkbox-toggle"><i
                                            class="fa fa-square-o"></i></button>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                                            </button>
                                            <a href="#reply" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></a>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
                                <? if (80 > $message['text']) : ?>
                                    <blockquote>
                                        <?= $message['text'] ?>
                                        <small><?= $message['from_account_display'] ?>,
                                            <cite
                                                title="Source Title"><?= date_format_en($message['created_at']) ?></cite>
                                        </small>
                                    </blockquote>
                                <? else : ?>
                                    <article>
                                        <?= $message['text'] ?>
                                    </article>
                                <? endif; ?>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" id="reply">
                                <? if (Ngaji\Http\Request::user()->id != $message['from_account']): ?>
                                <?= Html::form_begin('mail/compose') ?>

                                <input name="to_account" value="<?= $message['from_account'] ?>" hidden/>
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" placeholder="Write a reply..." name="text" style="height: 120px"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat">Send</button>

                                <?= Html::form_end() ?>
                                <? endif; ?>
                            </div>
                        </div>
                        <!-- /. box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <?= Ngaji\view\View::makeFooter() ?>
        </footer>
    </div>
</body>
</html>