<?php namespace app\contollers;

use Ngaji\view\View;
use app\models\Menus;
use Ngaji\Routing\Controller;

# use Response::render() func. to include template without passing array data
class AdminController extends Controller {

    public static function index() {
        View::render('manager/home');
        # Response::render('Hello manager <a href="logout">Logout</a>', false);
    }

    public static function manage_menus() {
        self::login_required()->middleware('manager');
        # fetch all menus
        $foods = Menus::all();
        View::render(
            'manager/manage-menus',
            ['foods' => $foods]
        );
    }
}
