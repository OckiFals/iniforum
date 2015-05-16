<?php namespace app\contollers;

use app\models\Accounts;
use app\models\Categories;
use app\models\Posts;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Routing\Controller;
use Ngaji\view\View;

# use Response::render() func. to include template without passing array data
class MemberController extends Controller {

    public static function index() {
        $posts = Posts::all();
        $hotposts = Posts::all('ORDER BY viewers DESC');
        $users = Accounts::find([
            'type' => 2 # cause type 1 is admin
        ]);

        $categories = Categories::all();

        # /app/views/waitress/order.php
        View::render('home', [
            'hotposts' => $hotposts,
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

        View::render('member/profile', [
            'account' => $account,
            'posts' => $posts,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public static function register() {
        # if user was login before
        if (Request::is_authenticated())
            # redirect to main page
            Response::redirect('');

        if ("POST" == Request::method()) {

        } else {
            View::render('member/register');
        }
    }
}
