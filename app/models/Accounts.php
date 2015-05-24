<?php namespace app\models;

use Ngaji\Database\ActiveRecord;
use Ngaji\Http\Request;

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

    public static function edit($id, $name, $username, $bio, $photo='') {

        if (!empty($photo)) {
            $sql = sprintf("UPDATE accounts SET `name` = :name, `username` = :username,
                `bio` = :bio, `photo` = :photo WHERE `accounts`.`id` = :id;"
            );

            $bindArray = [
                ':id' => $id,
                ':name' => $name,
                ':username' => $username,
                ':bio' => $bio,
                ':photo' => 'members/' . $photo
            ];
        } else {
            $sql = sprintf("UPDATE accounts SET `name` = :name, `username` = :username,
                `bio` = :bio WHERE `accounts`.`id` = :id;"
            );

            $bindArray = [
                ':id' => $id,
                ':name' => $name,
                ':username' => $username,
                ':bio' => $bio,
            ];
        }

        self::query($sql, $bindArray);
    }
}