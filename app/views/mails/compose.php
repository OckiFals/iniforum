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
                    Mailbox
                    <small>13 new messages</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Mailbox</li>
                </ol>
            </section>

            <div class="content body">
                <div class="row">
                    <div class="col-md-3">
                        <?= Html::anchor('mail', 'Back to Inbox', [
                                'class' => 'btn btn-primary btn-block margin-bottom'
                            ]
                        )?>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Folders</h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox <span
                                                class="label label-primary pull-right">12</span></a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
                            <div class="box-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="To:"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject:"/>
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                                        <h1><u>Heading Of Message</u></h1>
                                        <h4>Subheading</h4>
                                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain
                                            was born and I will give you a complete account of the system, and expound
                                            the actual
                                        </p>
                                        <ul>
                                            <li>List item one</li>
                                            <li>List item two</li>
                                            <li>List item three</li>
                                            <li>List item four</li>
                                        </ul>
                                        <p>Thank you,</p>
                                        <p>John Doe</p>
                                    </textarea>
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
                                <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                            </div>
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