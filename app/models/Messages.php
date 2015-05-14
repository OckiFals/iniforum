<?php namespace app\models;

use Ngaji\Database\ActiveRecord;

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

    public static function create($from, $to, $msg) {

        $cleanMsg= \Post::sensor($msg);

        $sql = sprintf("INSERT INTO `iniforum`.`messages` 
            (`id`, `from_account`, `to_account`, `text`, `created_at`) 
            VALUES (NULL, :from_member, :to_member, :msg, CURRENT_TIMESTAMP)"
        );

        $bindArray = [
            ':from_member' => $from,
            ':to_member' => $to,
            ':msg' => $cleanMsg
        ];

        self::query($sql, $bindArray);
    }
}