<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>News Feeds</title>
    <?= Ngaji\view\View::makeHead() ?>
    <?php
    /**
     * @var array $users
     * @var Integer $outboxes_count
     * @var Integer $inboxes_count
     * @var PDOStatement $users
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
    <div class="content-wrapper"
    ">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mailbox
                <small>13 new messages</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <?= Html::anchor('', Html::italic('', [
                            'class' => 'fa fa-dashboard'
                        ]) . 'Home')
                    ?>
                </li>
                <li>
                    <?= Html::anchor('mail', 'Mail') ?>
                </li>
                <li class="active">Compose</li>
            </ol>
        </section>

        <div class="content body">
            <div class="row">
                <div class="col-md-3">
                    <?= Html::anchor('mail', 'Back to Inbox', [
                            'class' => 'btn btn-primary btn-block margin-bottom'
                        ]
                    ) ?>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Folders</h3>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="<?= HOSTNAME . '/mail' ?>"><i class="fa fa-inbox"></i> Inbox <span
                                            class="label label-primary pull-right"><?= $inboxes_count ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= HOSTNAME . '/mail/sent' ?>">
                                        <i class="fa fa-envelope-o"></i> Sent <span
                                            class="label label-primary pull-right"><?= $outboxes_count ?></span>
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
                        <!-- /.box-header -->
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
                            <h3 class="box-title">Compose New Message</h3>
                        </div>
                        <!-- /.box-header -->
                        <?= Html::form_begin('mail/compose') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="compose-textarea">TO:</label>
                                <select class="form-control" name="to_account">
                                    <option value="">---</option>
                                    <? foreach ($users as $user):?>
                                        <? if ($user['id'] == Ngaji\Http\Request::user()->id or
                                            '1' == $user['type']
                                        )
                                        continue ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="subject" placeholder="Subject:"/>
                            </div>
                            <div class="form-group">
                                    <textarea id="compose-textarea" name="text" class="form-control" style="height: 300px" placeholder="Write here..."></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment"/>
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send
                                </button>
                            </div>
                            <?= Html::anchor('mail', Html::italic('', [
                                    'class' => 'fa fa-times'
                                ]) . ' Discard', [
                                    'class' => 'btn btn-default'
                                ]
                            ) ?>
                        </div>
                        <?= Html::form_end() ?>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?= Ngaji\view\View::makeFooter() ?>
        <?= Html::load('js', 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>
        <script>
            $(function () {
                //Add text editor
                $("#compose-textarea").wysihtml5();
            });
        </script>
    </footer>
</div>
</body>
</html>