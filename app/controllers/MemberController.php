<?php namespace app\contollers;

use app\models\Accounts;
use app\models\Categories;
use app\models\Posts;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\Routing\Controller;
use Ngaji\view\View;

# use Response::render() func. to include template without passing array data
class MemberController extends Controller {

    public static function index() {
        $posts = Posts::all();
        $categories = Categories::all();
        $users = Accounts::find([
            'type' => 2 # cause type 1 is admin
        ]);

        # /app/views/waitress/order.php
        View::render('home', [
            'posts' => $posts,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Render the profile page
     * @param $username
     */
    public static function profile($username) {
        # fetch user data account
        $account = Accounts::findByUsername($username);
        $categories = Categories::all();
        $posts = Posts::find([
            'id_account' => $account['id'],
        ]);

        $users = Accounts::find([
            'type' => 2 # cause type 1 is admin
        ]);

        # /app/views/waitress/order.php
        View::render('member/profile', [
            'account' => $account,
            'posts' => $posts,
            'users' => $users,
            'categories' => $categories
        ]);
    }
}
