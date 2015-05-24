<?php namespace app\models;

use Ngaji\Database\ActiveRecord;
use Ngaji\Http\Request;
use Ngaji\Http\Response;

class Messages extends ActiveRecord {

    public function __construct($dataModel = [], $className=__CLASS__) {
        class_parents($className);
        parent::__construct($dataModel);
    }

    public function tableName() {
        return 'messages';
    }

    public function attributes() {
        return array(
            'id' => [
                'integer',
                'auto_increment'
            ],
            'from_account' => 'integer',
            'to_account' => 'integer',
            'text' => 'text',
            'created_at' => 'time',
        );
    }

    public function rules() {
        return array(
            'primary_key' => 'id',
            'many_to_one' => [
                'accounts' => 'id'
            ]
        );
    }

    /**
     * Get all data!
     * @param string $criteria
     * @return \PDOStatement : fetchAll query
     */
    public static function all($criteria = 'from') {

        if ('to' === $criteria)
            $criteria = 'WHERE A.to_account=' . Request::user()->id;
        else
            $criteria = 'WHERE A.from_account=' . Request::user()->id;

        $sql = sprintf("SELECT A.*, (
                    SELECT name FROM accounts WHERE id=A.from_account
                 ) as from_account_display, B.name as to_account_display, B.id as account_id, B.photo as account_photo
                FROM messages A LEFT JOIN accounts B
                    ON A.to_account = B.id %s",
            $criteria
        );

        return self::query($sql);
    }

    public static function create($from, $to, $subject, $msg) {

        $cleanMsg= \Post::sensor($msg, false);

        $sql = sprintf("INSERT INTO `iniforum`.`messages` 
            (`id`, `from_account`, `to_account`, `subject`, `text`, `created_at`)
            VALUES (NULL, :from_member, :to_member, :subject, :msg, CURRENT_TIMESTAMP)"
        );

        $bindArray = [
            ':from_member' => $from,
            ':to_member' => $to,
            ':subject' => $subject,
            ':msg' => $cleanMsg
        ];

        self::query($sql, $bindArray);
    }

    public static function countMsg($criteria='from') {

        return self::all($criteria)->rowCount();
    }

    public static function getOrFail($id) {
        $sql = sprintf("SELECT A.*, (
                    SELECT name FROM accounts WHERE id=A.from_account
                 ) as from_account_display, B.name as to_account_display, B.id as account_id, B.photo as account_photo
                FROM messages A LEFT JOIN accounts B
                    ON A.to_account = B.id WHERE A.id=%d",
            $id
        );

        $data = self::query($sql)->fetch();

        # if no data are return
        if (empty($data))
            Response::render('app/views/404.php');

        return $data;
    }

    public static function getSQLQuery() {
        return "SELECT A.*, (
                    SELECT name FROM accounts WHERE id=A.from_account
                 ) as from_account_display, B.name as to_account_display, B.id as account_id, B.photo as account_photo
                FROM messages A LEFT JOIN accounts B
                    ON A.to_account = B.id WHERE A.id";
    }

}