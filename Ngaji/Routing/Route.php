<?php namespace Ngaji\Routing;
/**
 * Author: Ocki Bagus Pratama
 * Date: 03/04/15
 * Time: 20:54
 */

use App\contollers\MemberController;
use App\contollers\PostsController;
use App\contollers\ApplicationController;


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

        # category
        $this->router->map('GET', '/categories', function() {
            ApplicationController::categories();
        }, 'categorie');

        $this->router->map('GET', '/categories/[i:id]', function($id) {
            ApplicationController::categories($id);
        }, 'categorie_display');

        ############################# POST #####################################
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
        ############################# /POST ####################################
        # Member routes
        $this->router->map('GET', '/profile/[a:member]', function($member) {
            MemberController::profile($member);
        });
//        $this->router->map('GET', '/ustadz/[a:ustadz]', function ($ustadz) {
//            MemberController::ustadzDetail($ustadz);
//        });
//        $this->router->map('GET', '/jadwal-ustadz/[a:ustadz]', function ($ustadz) {
//            MemberController::ustadzSchedule($ustadz);
//        });

        # API routes



    }

    public function getRoute() {
        return $this->router;
    }
}
