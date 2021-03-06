<?php namespace app\contollers;

use app\models\Badwords;
use app\models\Categories;
use Ngaji\Database\QueryBuilder;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\view\View;
use Ngaji\Routing\Controller;

# use Response::render() func. to include template without passing array data
class BadWordsController extends Controller {

    public static function index() {

        $categories = Categories::all()
            ->fetchAll(\PDO::FETCH_CLASS);

        $badwords =  Badwords::query(
            (new QueryBuilder)
                ->select('id, word')
                ->from('badwords')
        );
        View::render('badwords/home', [
            'badwords' => $badwords
                ->fetchAll(\PDO::FETCH_CLASS),
            'categories' => $categories
        ]);
    }

    public static function add() {
        if (!Request::is_admin()) {
            Response::redirect('');
        }

        if ("POST" == Request::method()) {
            $word = Request::POST()->word;

            Badwords::create($word);
            # push a flash message
            Session::push('flash-message', 'One badwords sensor has added successfully!');
            Response::redirect('badwords');
        } else {
            $categories = Categories::all()
                ->fetchAll(\PDO::FETCH_CLASS);
            View::render('badwords/add', [
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
            $word = Request::POST()->word;

            Badwords::update($id, $word);
            # push a flash message
            Session::push('flash-message', 'That badwords sensor has changed successfully!');
            Response::redirect('badwords');
        } else {
            $badword = Badwords::findByPK($id);
            $categories = Categories::all()
                ->fetchAll(\PDO::FETCH_CLASS);
            View::render('badwords/add', [
                'badword' => $badword,
                'categories' => $categories
            ]);
        }
    }

    public static function delete($id) {
        if (!Request::is_admin()) {
            Response::redirect('');
        }

        # perform the categories deletion
        Badwords::delete($id);
        # push a flash message
        Session::push('flash-message', 'That badwords sensor has deleted successfully!');
        # redirect to main page
        Response::redirect('badwords');
    }
}
