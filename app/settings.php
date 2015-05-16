<?php

return [
    'hostname' => HOSTNAME,
    'class' => [
        'Ngaji/Routing/Route.php',
        'Ngaji/Routing/Router.php',
        # TODO test regex match
        'Ngaji/Routing/Router2.php',

        'Ngaji/Routing/Controller.php',
        'Ngaji/Http/Request.php',
        'Ngaji/Http/Response.php',
        'Ngaji/Http/Session.php',
        'Ngaji/View/View.php',
        'Ngaji/FileHandler/File.php',
        # PDO
        'Ngaji/Database/Connection.php',
        'Ngaji/Database/ActiveRecord.php',
        'Ngaji/Database/QueryBuilder.php',
        # helpers
        'app/helpers/DateFormat.php',
        'app/helpers/Html.php',
        'app/helpers/Post.php',
        # controller
        'app/controllers/ApplicationController.php',
        'app/controllers/AdminController.php',
        'app/controllers/MemberController.php',
        'app/controllers/PostsController.php',
        'app/controllers/CommentsController.php',
        'app/controllers/MailsController.php',

        # register your class in here, with full directory path
        ''
    ],
    # database configuration
    'db' => [
        'driver' => 'mysql',
        'name' => 'iniforum',
        'host' => 'localhost',
        'user' => 'ockifals',
        'pass' => 'admin'
    ],
    # register your model class in here
    'models' => [
        'Accounts',
        'Posts',
        'Comments',
        'Messages',
        'Categories'
    ],
    # path for template(s)
    'template_path' => [
        'template'
    ],
    # path for static files (JS, CSS, font, etc.)
    'static' => [
        'assets'
    ],
    # templates name 
    'template_tags' => [
        'head' => 'head.php',
        'header' => 'header.php',
        'footer' => 'footer.php'
    ],
];