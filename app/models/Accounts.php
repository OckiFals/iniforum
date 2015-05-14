<?php namespace app\models;

use Ngaji\Database\ActiveRecord;

class Accounts extends ActiveRecord {

    public function __construct($className=__CLASS__) {
        /* FIXME passing class name ke constructor parent */
        class_parents($className);
    }

    public function tableName() {
        return 'accounts';
    }

    public function attributes() {
        return array(
            'id' => [
                'integer',
                'auto_increment',
                'primary_key'
            ],
            'username' => 'varchar_80',
            'password' => 'varchar_32'
        );
    }

    public function rules() {
        return array(
            'primary_key' => 'id'
        );
    }

    public static function findByUsername($username) {
        return self::getOrFail([
            'username' => $username
        ]);
    }
}