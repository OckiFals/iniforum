<?php namespace Ngaji\Routing;

use App\models\Accounts;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;

/**
 * Controller(Base)
 *
 * This is a simple controller class
 *
 * @package App/Ngaji/Routing
 * @author  Ocki Bagus Pratama
 * @since   1.0.0
 */
class Controller {

    /**
     * Use this function for authenticated member and ustadz
     * if the authenticated is failure, the user will be redirect to
     * warning page that they can input username and pass again
     *
     * @param $username : username user
     * @param $password : password user
     * @return bool
     */
    public static function auth($username, $password) {
        $data = Accounts::find([
            'username' => $username,
            'password' => md5($password)
        ]);

        if ($data) { # validate was successed

            # Set a session ID
            $account = array(
                $data['id'],
                $data['username'],
                $data['name'],
                $data['type']
            );

            $session = new Session();
            $session->set('id_account', implode('|', $account));
            return TRUE;
        }

        # validate was failure
        return FALSE;

    }

    public static function login_required($role = null) {
        if (!Request::is_authenticated())
            Response::redirect('');

        $type = strtolower(Request::get_user('type-display'));
        if ($role and !($role === $type))
            Response::redirect('');

        return new static;
    }
}