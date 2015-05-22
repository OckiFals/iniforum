<?php namespace app\contollers;

use app\models\Accounts;
use app\models\Categories;
use app\models\Posts;
use app\models\Messages;
use Ngaji\Http\Request;
use Ngaji\Http\Response;
use Ngaji\Http\Session;
use Ngaji\Routing\Controller;
use Ngaji\view\View;

# use Response::render() func. to include template without passing array data
class MailsController extends Controller {

    public static function index() {
        self::login_required();

        $inboxes_count = Messages::countMsg('to');
        $outboxes_count = Messages::countMsg('from');

        $messages = Messages::all('to');

        View::render('mails/inbox', [
            'inboxes_count' => $inboxes_count,
            'outboxes_count' => $outboxes_count,
            'messages' => $messages
        ]);
    }

    public static function outbox() {
        self::login_required();

        $inboxes_count = Messages::countMsg('to');
        $outboxes_count = Messages::countMsg('from');
        $messages = Messages::all('from');

        View::render('mails/outbox', [
            'inboxes_count' => $inboxes_count,
            'outboxes_count' => $outboxes_count,
            'messages' => $messages
        ]);
    }

    public static function read($id) {
        self::login_required();

        $inboxes_count = Messages::countMsg('to');
        $outboxes_count = Messages::countMsg('from');
        $message = Messages::getOrFail($id);

        View::render('mails/read', [
            'inboxes_count' => $inboxes_count,
            'outboxes_count' => $outboxes_count,
            'message' => $message
        ]);
    }


    public static function compose() {
        self::login_required();

        if ("POST" == Request::method()) {
            $from = Request::user()->id;
            $to =  Request::POST()->to_account;
            $subject = (isset(Request::POST()->subject)) ? Request::POST()->subject : '';
            $text = Request::POST()->text;

            Messages::create($from, $to, $subject, $text);

            Response::redirect('mail/sent');
        } else {
            $inboxes_count = Messages::countMsg('to');
            $outboxes_count = Messages::countMsg('from');
            $users = Accounts::all();

            View::render('mails/compose', [
                'inboxes_count' => $inboxes_count,
                'outboxes_count' => $outboxes_count,
                'users' => $users
            ]);
        }
    }

    /**
     * @param $id
     */
    public static function delete($id) {
        $post = Posts::findByPK($id);

        if (!Request::is_authenticated()) {
            Response::redirect('');
        } else if (Request::user()->id !== $post['id_account']) {
            Session::push('flash-message', 'You does not have permission to delete the other Member\'s post!');
            Response::redirect('');
        }

        # perform the post deletion
        Posts::delete($id);
        # redirect to main page
        Response::redirect('');
    }
}