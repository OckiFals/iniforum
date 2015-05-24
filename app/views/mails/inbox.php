<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inbox</title>
    <?= Ngaji\view\View::makeHead() ?>
    <?php
    /**
     * @var PDOStatement $categories
     * @var array $users
     * @var Integer $outboxes_count
     * @var Integer $inboxes_count
     * @var PDOStatement $messages
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
                        )?>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Folders</h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="<?= HOSTNAME . '/mail' ?>"><i class="fa fa-inbox"></i> Inbox <span
                                                class="label label-primary pull-right"><?= $inboxes_count ?></span></a></li>
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
                                <h3 class="box-title">Inbox</h3>

                                <div class="box-tools pull-right">
                                    <div class="has-feedback">
                                        <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button class="btn btn-default btn-sm checkbox-toggle"><i
                                            class="fa fa-square-o"></i></button>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                    <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i>
                                            </button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
                                <div class="table-responsive mailbox-messages" style="min-height:360px">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <? if (1 > $messages->rowCount()) : ?>
                                        <tr style="height: 240px">
                                            <td>
                                                <h3>No messages for you</h3>
                                            </td>
                                        </tr>
                                        <? else : ?>
                                        <? foreach($messages as $message): ?>
                                        <tr>
                                            <td style="width: 20px"><input type="checkbox"/></td>
                                            <td style="width: 40px" class="mailbox-star">
                                                <a href="#"><i class="fa fa-star text-yellow"></i></a>
                                            </td>
                                            <td class="mailbox-name">
                                                <?= Html::anchor('mail/read/' . $message['id'], $message['from_account_display']) ?>
                                            </td>
                                            <td class="mailbox-subject">
                                                <?= $message['text'] ?>
                                            </td>
                                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                            <td class="mailbox-date"><?= date_format_en($message['created_at']) ?></td>
                                        </tr>
                                        <? endforeach; ?>
                                        <? endif; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer no-padding">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button class="btn btn-default btn-sm checkbox-toggle"><i
                                            class="fa fa-square-o"></i></button>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                        <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                    <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i>
                                            </button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
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