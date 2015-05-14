<?php namespace app\contollers;

/**
 * ApplicationController
 *
 * Is a basic contoller for the app.
 * This perform basic actions that can be performed by all users
 * like access the index and login page.
 *
 * @package app/controllers
 * @author  Ocki Bagus Pratama
 * @date    14/02/15
 * @time    14:09
 * @since   1.0.0
 */

use app\models\Posts;
use app\models\Categories;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\Routing\Controller;
use Ngaji\view\View;

use app\models\Accounts;

# use Response::render() func. to include template without passing array data
class ApplicationController extends Controller {

    public static function index() {
        # if user was login before and the session is still valid
        if (Request::is_authenticated()) {
            if (Request::is_admin()) {
                AdminController::index();
            } else {
                MemberController::index();
            }
        } else {
            $posts = Posts::all();
            $users = Accounts::find([
                'type' => 2 # cause type 1 is admin
            ]);

            $categories = Categories::all();

            # /app/views/waitress/order.php
            View::render('home', [
                'posts' => $posts,
                'users' => $users,
                'categories' => $categories
            ]);
        }
    }

    /**
     * @param null $id
     */
    public static function categories($id=null) {

        if (empty($id))
            $categories = Categories::all()->fetchAll();
        else
            $categories = Categories::getOrFail(['id' => $id]);

        print_r($categories);
    }

    /**
     * Action Login
     *
     */
    public static function login() {
        # if user was login before
        if (Request::is_authenticated())
            # redirect to main page
            Response::redirect('');

        # if request path contain ?next=page
        if (isset($_GET['next'])) {

            if (Session::flash()->has('next'))
                Session::pop('next');

            # push next request page in the session
            Session::push('next', $_GET['next']);
        }

        if ("POST" == Request::method()) {
            $username = Request::POST()->username;
            $password = Request::POST()->password;

            # auth by base controller
            $auth = self::auth($username, $password);

            if ($auth) {
                # if session path contain next request page
                if (Session::flash()->has('next'))
                    # redirect to that request page
                    Response::redirect(
                        Session::pop('next')
                    );
                else #
                    Response::redirect('');
            } else { # if authenticated failure
                # pust a flash message
                Session::push('flash-message', 'Authenticated failure!');
                View::render('login');
            }
        } else {
            View::render('login');
        }
    }

    public static function logout() {
        $session = new Session();

        if ($session->has('id_account'))
            $session->delete('id_account');

        $session->destroy();

        Response::redirect('');
    }
}
