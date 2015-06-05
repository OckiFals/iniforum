<!DOCTYPE html>
<html lang="ID">
<?php
/**
 * @var stdClass $accounts
 * @var PDOStatement $categories
 */
?>
<head>
    <title>IniForum Admin::accounts-add</title>
    <?= Ngaji\view\View::makeHead() ?>
</head>

<body class="skin-blue">
<div class="wrapper">

    <header class="main-header">
        <?= Ngaji\view\View::makeHeader() ?>
    </header>
    <? if (Ngaji\Http\Request::is_admin()): ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <? Ngaji\view\View::render('admin/left-sidebar') ?>
        </aside>
    <? endif; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <?= Html::anchor('',
                            Html::fa('fa-dashboard', 'Home')
                        )
                    ?>
                </li>
                <li>
                    <?= Html::anchor('accounts',
                        Html::fa('fa-user', 'Accounts')
                    )
                    ?>
                </li>
                <li class="active">Add</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Content -->
            <div id="content" class="colM">
                <!--                <h1>Dashboard</h1>-->

                <br class="clear"/>
            </div>
            <!-- END Content -->

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Accounts</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="register-box-body">
                                <p class="login-box-msg">Register a new membership</p>

                                <?= Html::form_begin('', 'POST', [
                                    'enctype' => "multipart/form-data",
                                    'id' => "register-form",
                                    'novalidate' => "novalidate"
                                ])
                                ?>
                                <input type="text" name="type" value="<?= Ngaji\Http\Request::GET()->type?>" hidden=""/>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full name"/>
                                </div>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username"/>
                                </div>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>
                                </div>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <input type="password" id="password" class="form-control" placeholder="Password" name="password"/>
                                </div>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    <input type="password" id="password2" class="form-control" placeholder="Retype password" name="password2"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Uploads foto:</label>
                                    <input type="file" id="profile_picture" name="photo">
                                    <p class="help-block">Max 700KB</p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Add</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <?= Html::form_end() ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Categories</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <? foreach ($categories as $category) : ?>
                                <ul class="products-list product-list-in-box">
                                    <li class="item">
                                        <div class="product-img">
                                            <?= Html::loadIMG(
                                                $category->photo, [
                                                'alt' => 'Category Photo',
                                                'width' => 50,
                                                'height' => 50
                                            ]);
                                            ?>
                                        </div>
                                        <div class="product-info">
                                            <?= Html::anchor("categories/{$category->id}", $category->name .
                                                '<span class="label bg-olive pull-right"><i class="fa fa-file-text">
                                        </i>  ' . $category->post_count . '</span>', [
                                                    'class' => 'product-title'
                                                ]
                                            )
                                            ?>
                                            <span class="product-description">
                                <?= $category->description ?>
                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                </ul>
                            <? endforeach; ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript:" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recently Actions</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">

                                <? #side bar ?>

                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript:" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <?= Ngaji\view\View::makeFooter() ?>
    </footer>

</div>
<!-- ./wrapper -->
<?= Html::load('js', 'plugins/validate/jquery.validate.min.js') ?>
<script>
    $(function () {
        $("#register-form").validate({

            // Specify the validation rules
            rules: {
                name: "required",
                username: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5
                },
                agree: "required"
            },

            // Specify the validation error messages
            messages: {
                name: "Please enter your name",
                username: "Please enter your username",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password2: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
</body>
</html>