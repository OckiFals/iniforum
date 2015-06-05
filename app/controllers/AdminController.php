<?php namespace app\contollers;

use app\models\Accounts;
use app\models\Categories;
use app\models\Comments;
use app\models\Posts;
use Ngaji\FileHandler\File;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\view\View;
use Ngaji\Routing\Controller;

# use Response::render() func. to include template without passing array data
class AdminController extends Controller {

    public static function index() {
        $posts = Posts::all()
            ->fetchAll(\PDO::FETCH_CLASS);
        $categories = Categories::all()
            ->fetchAll(\PDO::FETCH_CLASS);
        $comments = Comments::all()
            ->fetchAll(\PDO::FETCH_CLASS);

        View::render('admin/home', [
            'posts' => $posts,
            'categories' => $categories,
            'comments' => $comments
        ]);
    }

    public static function profile() {

    }

    public static function accounts($id=null) {
        if (isset($id)) {
            $account = Accounts::find(['id' => $id])
                ->fetch(\PDO::FETCH_CLASS);
            $categories = Categories::all()
                ->fetchAll(\PDO::FETCH_CLASS);

            View::render('admin/account-all', [
                'account' => $account,
                'categories' => $categories
            ]);
        } else {
            $type = Request::GET()->type;

            $accounts = Accounts::find(['type' => $type], true)
                ->fetchAll(\PDO::FETCH_CLASS);
            $categories = Categories::all()
                ->fetchAll(\PDO::FETCH_CLASS);

            View::render('admin/account-all', [
                'accounts' => $accounts,
                'categories' => $categories
            ]);
        }
    }

    public static function deleteMember($id) {
        Accounts::delete($id);
        # push flash-message
        Session::push('flash-message', 'That members has daleted successfuly!');
        # redirect to main page
        Response::redirect('accounts');
    }

    public static function addMember() {
        if ("POST" == Request::method()) {
                $username = Request::POST()->username;
                $email = Request::POST()->email;
                $pass = Request::POST()->password;
                $name = Request::POST()->name;
                $type = Request::POST()->type;

                $photo = File::upload('img', 'photo');

                # if username has used by another member
                if (Accounts::find(['username' => $username])) {
                    Session::push('flash-message', 'That username has used by other member, please use another!');
                    Response::redirect('accounts/add');
                }

                Accounts::create($username, $pass, $name, $email, $photo, $type);

                # push flash-message
                Session::push('flash-message', 'That members has successfuly added!');
                Response::redirect('accounts');
        } else {
            $categories = Categories::all()
                ->fetchAll(\PDO::FETCH_CLASS);

            View::render('admin/account-add', [
                'categories' => $categories
            ]);
        }
    }

}
