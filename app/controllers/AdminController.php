<?php namespace app\contollers;

use app\models\Categories;
use app\models\Comments;
use app\models\Posts;
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

    public static function membersAll() {

    }

    public static function members($id) {

    }

    public static function deleteMember($id) {

    }

    public static function editMember($id) {

    }

}
