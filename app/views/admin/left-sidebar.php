<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?= Html::loadIMG('user2-160x160.jpg', [
                'class' => 'img-circle',
                'alt' => 'User Image'
            ])
            ?>
        </div>
        <div class="pull-left info">
            <p><?= Ngaji\Http\Request::get_user('name') ?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
            <a href="<?= HOSTNAME ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>Accounts</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Admins <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-sitemap"></i> Manage Admins</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i> Add Admins</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Members <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-sitemap"></i> Manage Members</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i> Add Members</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-archive"></i> <span>Categories</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="<?= HOSTNAME . '/categories' ?>">
                        <i class="fa fa-sitemap"></i> Manage Categories
                    </a>
                </li>
                <li>
                    <a href="<?= HOSTNAME . '/categories/add' ?>">
                        <i class="fa fa-plus-square"></i> Add Categories
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-exclamation-triangle"></i> <span>BadWords</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="<?= HOSTNAME . '/badwords' ?>">
                        <i class="fa fa-sitemap"></i> Manage BadWords
                    </a>
                </li>
                <li>
                    <a href="<?= HOSTNAME . '/badwords/add' ?>">
                        <i class="fa fa-plus-square"></i> Add BadWords
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->