<?php namespace app\contollers;

use app\models\Accounts;
use app\models\Categories;
use app\models\Comments;
use app\models\Posts;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\Routing\Controller;
use Ngaji\view\View;

# use Response::render() func. to include template without passing array data
class CommentsController extends Controller {

    public static function index() {
        $users = Accounts::find([
            'type' => 2 # cause type 1 is admin
        ]);

        # /app/views/waitress/order.php
        View::render('home', [
            'users' => $users,
            'posts' => Posts::all(),
            'categories' => Categories::all()
        ]);
    }

    /**
     * Add member post
     *
     */
    public static function add() {
        if (!Request::is_authenticated()) {
            Session::push('flash-message', 'You must login before!');
            Response::redirect('login');
        }

        if ("POST" == Request::method()) {
            $id_member = Request::POST()->member_id;
            $id_post = Request::POST()->post_id;
            $comment = Request::POST()->comment;

            Comments::create($id_post, $id_member, $comment);
            Response::redirect(
                (isset($_GET['next']) ? Request::GET()->next . '#comment' : '')
            );
        } else {
            Response::redirect('');
        }
    }

    /**
     * @param $id
     */
    public static function edit($id) {
        $post = Posts::findByPK($id);

        if (!Request::is_authenticated()) {
            Session::push('flash-message', 'You must login before!');
            Response::redirect('login?next=post/edit/'.$id);
        } else if (Request::user()->id !== $post['id_account']) {
            Session::push('flash-message', 'You does not have permission to edit the other Member\'s post!');
            Response::redirect('');
        }

        if ("POST" == Request::method()) {
            $id_member = Request::user()->id;
            $data = Request::POST()->post;
            $title = Request::POST()->title;
            $cat = Request::POST()->category;

            Posts::edit($id, $id_member, $title, $data, $cat);
        } else {
            $users = Accounts::find([
                'type' => 2 # cause type 1 is admin
            ]);

            $categories = Categories::all();

            View::render('member/edit-post', [
                'post' => $post,
                'users' => $users,
                'categories' => $categories
            ]);
        }
    }

    /**
     * @param $id
     */
    public static function delete($id) {
        $comment = Comments::findByPK($id);

        if (!Request::is_authenticated()) {
            Response::redirect('');
        } else if (Request::user()->id !== $comment['id_account'] and !Request::is_admin()) {
            Session::push('flash-message', 'You does not have permission to delete the other Member\'s post!');
            Response::redirect('');
        }

        # perform the post deletion
        Comments::delete($id);
        # redirect to main page
        Response::redirect('');
    }
}