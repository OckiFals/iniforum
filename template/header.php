<?php use Ngaji\Http\Request; ?>
<? if (Request::is_authenticated() and Request::is_admin()): ?>
    <!-- Logo -->
    <?= Html::anchor('', '<b>IniForum</b>LTE', [
            'class' => 'logo'
        ]
    ) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::loadIMG('user2-160x160.jpg', [
                                'class' => 'user-image',
                                'alt' => 'User Image'
                            ]
                        )
                        ?>
                        <span class="hidden-xs"><?= Request::get_user('name') ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= Html::loadIMG('user2-160x160.jpg', [
                                'class' => 'img-circle',
                                'alt' => 'User Image'
                            ]) ?>
                            <p>
                                <?= Request::get_user('username') ?> -
                                <?= Request::get_user('type-display') ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-5 text-center">
                                <a href="#">Ganti Paspor</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= HOSTNAME . '/profile' ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= HOSTNAME . '/logout' ?>"
                                   class="btn btn-default btn-flat">Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Header Navbar: style can be found in header.less -->

<? else: ?>
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <?= Html::anchor('', '<b>IniForum</b>', [
                        'class' => 'navbar-brand'
                    ]
                )
                ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <?= Html::anchor('post/add', Html::italic('', [
                                'class' => 'glyphicon glyphicon-edit'
                            ]) . ' Add Post', [
                                'class' => 'btn bg-olive btn-flat'
                            ]
                        )
                        ?>
                    </li>
                    <? if (Request::is_authenticated()): ?>
                    <li>
                        <?= Html::anchor('mail', Html::italic('', [
                                'class' => 'fa fa-envelope'
                            ]) . ' Mail', [
                                'class' => 'btn bg-purple btn-flat'
                            ]
                        )
                        ?>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle bg-navy" data-toggle="dropdown">
                            <?=
                            # same as <img src="/manajemen_rersto/assets/img/avatar.png" class="user-image" alt="User Image"/>
                            Html::load('img', 'avatar.png', [
                                'class' => 'user-image',
                                'alt' => 'User Image'
                            ])
                            ?>
                            <span class=""><?= Request::get_user('name') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-navy hidden-xs">
                                <?= Html::load('img', 'avatar.png', [
                                    'class' => 'img-circle',
                                    'alt' => 'User Image'
                                ])
                                ?>

                                <p>
                                    <?= Request::get_user('username') ?>
                                    <small><?= Request::get_user('type-display') ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body hidden-xs">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer hidden-xs">
                                <div class="pull-left">
                                    <?= Html::anchor('/profile/' . Request::get_user('username'), 'Profile', [
                                        'class' => [
                                            'btn',
                                            'btn-default',
                                            'btn-flat'
                                        ]
                                    ])
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::anchor('/logout', 'Sign out', [
                                        'class' => [
                                            'btn',
                                            'btn-default',
                                            'btn-flat'
                                        ]
                                    ])
                                    ?>
                                </div>
                            </li>

                            <li class="hidden-lg hidden-md hidden-sm">
                                <?= Html::anchor('/profile', 'Profile') ?>
                            </li>
                            <li class="hidden-lg hidden-md hidden-sm">
                                <?= Html::anchor('/logout', 'Logout') ?>
                            </li>
                            <? else: ?>
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle btn bg-navy btn-flat" data-toggle="dropdown">
                                        <?= Html::span('', ['class' => 'glyphicon glyphicon-user']) . ' Sign in | Sign up'
                                        ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- Menu Body -->
                                        <li class="user-body hidden-xs">
                                            <p class="login-box-msg">Sign in to start your session</p>
                                            <?= Html::form_begin('login') ?>
                                            <div class="form-group has-feedback">
                                                <input id="id_username" name="username" type="text" class="form-control"
                                                       placeholder="Username"
                                                       required="true"/>
                                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <input id="id_password" name="password" type="password"
                                                       class="form-control"
                                                       placeholder="Password" required="true"/>
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-xs-6">
                                                    <div class="pull-left">
                                                        <button class="btn btn-default btn-flat"> Login</button>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="pull-right">
                                                        <?= Html::anchor('/register', 'Register', ['class' => ['btn',
                                                            'btn-default',
                                                            'btn-flat']])
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <?= Html::form_end() ?>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer hidden-xs">

                                        </li>

                                        <li class="hidden-lg hidden-md hidden-sm">
                                            <?= Html::anchor('/profile', 'Profile') ?>
                                        </li>
                                        <li class="hidden-lg hidden-md hidden-sm">
                                            <?= Html::anchor('/logout', 'Logout') ?>
                                        </li>
                                    </ul>
                                </li>
                            <? endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<? endif; ?>

    <!-- Button trigger modal -->
<?php
/*
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login">
    Launch demo modal
</button>
<script type="text/javascript">
        $("#modal-open").click(function(){
            alert('cok');
        });
</script>
<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
*/
?>