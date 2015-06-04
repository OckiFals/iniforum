<?php namespace Ngaji\Routing;
/**
 * Author: Ocki Bagus Pratama
 * Date: 03/04/15
 * Time: 20:54
 */

use app\contollers\BadWordsController;
use app\contollers\CategoriesController;
use app\contollers\CommentsController;
use app\contollers\MailsController;
use App\contollers\MemberController;
use App\contollers\PostsController;
use App\contollers\ApplicationController;
use app\models\Comments;


class Route {
    private $router;

    public function __construct($config = []) {
        $this->router = new AltoRouter();
        $this->router->setBasePath($config['hostname']);

        # Main routes
        $this->router->map('GET', '/', 'App\contollers\ApplicationController::index', 'home');
        $this->router->map('GET', '/index.php', 'App\contollers\ApplicationController::index', 'home-home');
        $this->router->map('GET|POST', '/login', function () {
            ApplicationController::login();
        }, 'login');
        $this->router->map('GET', '/logout', function() {
            ApplicationController::logout();
        }, 'logout');
        $this->router->map('GET|POST', '/register', function() {
            MemberController::register();
        }, 'register');
        # FIXME
        $this->router->map('GET|POST', '/search/', function ()  {
            ApplicationController::search_request($_GET['query']);
        });

        ############################# CATEGORIES ROUTES ###################################
        $this->router->map('GET', '/categories', function() {
            CategoriesController::index();
        }, 'categories');

        $this->router->map('GET|POST', '/categories/add', function() {
            CategoriesController::add();
        }, 'categories_add');

        $this->router->map('GET', '/categories/[i:id]', function($id) {
            CategoriesController::index($id);
        }, 'categories_display');

        $this->router->map('GET', '/categories/delete/[i:id]', function($id) {
            CategoriesController::delete($id);
        });
        ############################# /CATEGORIES ROUTES ###################################

        ############################# MEMBER ROUTES ###################################
        $this->router->map('GET', '/profile/[a:member]', function($member) {
            MemberController::profile($member);
        });
        $this->router->map('GET|POST', '/profile/edit', function() {
            MemberController::edit();
        });
        ############################# /MEMBER ROUTES ###################################

        ############################# POST ROUTES #####################################
        $this->router->map('GET', '/post/read/[i:id]', function($id) {
            PostsController::read($id);
        });

        $this->router->map('GET|POST', '/post/add', function() {
            PostsController::add();
        });

        $this->router->map('GET|POST', '/post/edit/[i:id]', function($id) {
            PostsController::edit($id);
        });

        $this->router->map('GET', '/post/delete/[i:id]', function($id) {
            PostsController::delete($id);
        });

        $this->router->map('GET|POST', '/comments/add', function() {
            CommentsController::add();
        });

        $this->router->map('GET', '/comments/delete/[i:id]', function($id) {
            CommentsController::delete($id);
        });

        ############################# /POST ROUTES ###################################

        ############################ MAIL ROUTES #####################################
        $this->router->map('GET', '/mail', function() {
            MailsController::index();
        });
        $this->router->map('GET|POST', '/mail/sent', function() {
            MailsController::outbox();
        });
        $this->router->map('GET|POST', '/mail/compose', function() {
            MailsController::compose();
        });
        $this->router->map('GET', '/mail/read/[i:id]', function($id) {
            MailsController::read($id);
        });
        ############################ /MAIL ROUTES ####################################

        ############################# BADWORD ROUTES ###################################
        $this->router->map('GET', '/badwords', function() {
            BadWordsController::index();
        }, 'BADWORD');

        $this->router->map('GET|POST', '/badwords/add', function() {
            BadWordsController::add();
        }, 'BADWORD_add');

        $this->router->map('GET', '/badwords/delete/[i:id]', function($id) {
            BadWordsController::delete($id);
        });
        ############################# /BADWORD ROUTES ###################################
    }

    public function getRoute() {
        return $this->router;
    }
}
