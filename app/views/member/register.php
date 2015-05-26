<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IniFORUM | Registration Page</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <?= Html::load('css', 'bootstrap.min.css') ?>
    <?= Html::load('css', 'font-awesome.min.css') ?>
    <!-- Font Awesome Icons -->
    <!-- Theme style -->
    <?= Html::load('css', 'dist/AdminLTE.min.css') ?>
    <!-- iCheck -->
    <?= Html::load('css', 'plugins/iCheck/square/blue.css') ?>
</head>
<body class="register-page">
<div class="register-box">
    <div class="register-logo">
        <?= Html::anchor('',
            '<b>Ini</b>FORUM'
        )
        ?>
    </div>

    <? if (Ngaji\Http\Session::flash()->has('flash-message')) : ?>
        <div class="alert alert-danger alert-dismissable" id="flash-message">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?= Ngaji\Http\Session::flash()->pop('flash-message') ?>
        </div>
        <script>
            window.setTimeout( hideFlashMessage, 8000);

            function hideFlashMessage(){
                $('#flash-message').fadeOut('normal');
            }
        </script>
    <? endif ?>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <?= Html::form_begin('', 'POST', [
            'enctype' => "multipart/form-data",
            'id' => "register-form",
            'novalidate' => "novalidate"
        ])
        ?>
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
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" id="agree"> I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
        <?= Html::form_end() ?>

        <?= Html::anchor('login', 'I already have a membership', [
            'class' => 'text-center'
        ]) ?>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.1.3 -->
<?= Html::load('js', 'plugins/jQuery/jQuery-2.1.3.min.js') ?>
<!-- Bootstrap 3.3.2 JS -->
<?= Html::load('js', 'bootstrap.min.js') ?>
<!-- iCheck -->
<?= Html::load('js', 'plugins/iCheck/icheck.min.js') ?>


<?= Html::load('js', 'plugins/validate/jquery.validate.min.js') ?>

<?= Html::load('js', 'dist/app.min.js') ?>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

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