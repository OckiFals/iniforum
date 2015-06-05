<?php namespace app\contollers;

use app\models\Categories;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\view\View;
use Ngaji\Routing\Controller;

# use Response::render() func. to include template without passing array data
class CategoriesController extends Controller {

    /**
     * @param null $id
     */
    public static function index($id=null) {

        if (empty($id)) {
            $categories = Categories::all()->fetchAll(\PDO::FETCH_CLASS);

            View::render('categories/home', [
               'categories' => $categories
            ]);
        }
        else {
            $categories = Categories::getOrFail(['id' => $id]);
            print_r($categories);
        }
    }

    public static function add() {
        if (!Request::is_admin()) {
            Response::redirect('');
        }

        if ("POST" == Request::method()) {
            $id_acc = Request::user()->id;
            $name = Request::POST()->name;
            $decsription = Request::POST()->description;

            Categories::create($id_acc, $name, $decsription);
            # push flash-message
            Session::push('flash-message', 'That category has successfuly added!');
            Response::redirect('categories');
        } else {
            $categories = Categories::all()->fetchAll(\PDO::FETCH_CLASS);
            View::render('categories/add', [
                'categories' => $categories
            ]);
        }
    }

    public static function edit($id) {
        if (!Request::is_admin()) {
            Response::redirect('');
        }

        if ("POST" == Request::method()) {
            $id = Request::POST()->id;
            $name = Request::POST()->name;
            $decsription = Request::POST()->description;

            Categories::update($id, $name, $decsription);
            # push flash-message
            Session::push('flash-message', 'That category has changed successfuly!');
            Response::redirect('categories');
        } else {
            $category = Categories::findByPK($id);
            $categories = Categories::all()->fetchAll(\PDO::FETCH_CLASS);
            View::render('categories/add', [
                'category' => $category,
                'categories' => $categories
            ]);
        }
    }

    public static function delete($id) {
        if (!Request::is_admin()) {
            Response::redirect('');
        }

        # perform the categories deletion
        Categories::delete($id);
        # push flash-message
        Session::push('flash-message', 'That category has deleted successfuly!');
        # redirect to main page
        Response::redirect('categories');
    }
}
