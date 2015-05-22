<?php
/**
 * @var array $categories
 * @var array $users
 */
?>

<div class="col-md-4">
    <!-- Form Element sizes -->
    <? if (Ngaji\Http\Request::is_authenticated()) : ?>

        <!-- /.box -->
    <? else : ?>
        <!-- Input addon -->
        <div class="box box-success hidden-lg hidden-md">
            <div class="box-header">
                <h3 class="box-title">
                    <b>Ini</b>FORUM
                </h3>
            </div>
            <div class="box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?= Html::form_begin('login') ?>
                <div class="form-group has-feedback">
                    <input id="id_username" name="username" type="text" class="form-control"
                           placeholder="Username"
                           required="true"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="id_password" name="password" type="password" class="form-control"
                           placeholder="Password" required="true"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= Html::form_end() ?>
            </div>
        </div>
    <? endif; ?>
    <!-- PRODUCT LIST -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Forum Category</h3>

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
                                $category['photo'], [
                                'alt' => 'Category Photo',
                                'width' => 50,
                                'height' => 50
                            ]);
                            ?>
                        </div>
                        <div class="product-info">
                            <?= Html::anchor("categories/{$category['id']}", $category['name'] .
                                '<span class="label label-warning pull-right">$1800</span>', [
                                    'class' => 'product-title'
                                ]
                            )
                            ?>
                            <span class="product-description">
                                <?= $category['description'] ?>
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                </ul>
            <? endforeach; ?>
        </div>
        <div class="box-footer text-center">
            <a href="#" class="uppercase">View All Categories</a>
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer text-center">
            <a href="#" class="uppercase">View All Categories</a>
        </div> -->
        <!-- /.box-footer -->
    </div>

    <!-- USERS LIST -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Top Members</h3>

            <div class="box-tools pull-right">
                <span class="label label-danger"><?= count($users) ?> Top Members</span>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                <? foreach ($users as $user): ?>
                    <li>
                        <?= Html::loadIMG($user['photo'], ['alt' => 'user image']) ?>
                        <?= Html::anchor("profile/{$user['username']}",
                            $user['name'], [
                                'class' => 'users-list-name'
                            ]
                        )
                        ?>
                        <span class="users-list-date">@<?= $user['username'] ?></span>
                    </li>
                <? endforeach; ?>
            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">

        </div>
        <!-- /.box-footer -->
    </div>
    <!--/.box -->
</div>
<!-- /Form Element sizes -->