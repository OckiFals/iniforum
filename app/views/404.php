<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page Not Found</title>
    <?= Ngaji\view\View::makeHead() ?>
    <?php
    /**
     * @var array $categories
     * @var array $posts
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            404 Error Page
          </h1>
          <ol class="breadcrumb">
            <li>
                <?= Html::anchor('index.php', '<i class="fa fa-dashboard"></i> Home') ?>
            </li>
            <li class="active">404 error</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <?= Html::anchor('index.php', 'return to home') ?> or try using the search form.
              </p>
              <form class='search-form'>
                <div class='input-group'>
                  <input type="text" name="search" class='form-control' placeholder="Search"/>
                  <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                  </div>
                </div><!-- /.input-group -->
              </form>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <?= Html::load('js', 'plugins/jQuery/jQuery-2.1.3.min.js') ?>
    <!-- Bootstrap 3.3.2 JS -->
    <?= Html::load('js', 'bootstrap.min.js') ?>
    <!-- SlimScroll -->
    <?= Html::load('js', 'plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <!-- FastClick -->
    <?= Html::load('js', 'plugins/fastclick/fastclick.min.js') ?>
    <!-- AdminLTE App -->
    <?= Html::load('js', 'dist/app.min.js') ?>
</body>
</html>