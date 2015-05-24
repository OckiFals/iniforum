<?php namespace app\models;

use Ngaji\Database\ActiveRecord;

class Categories extends ActiveRecord {

    public function __construct($dataModel = [], $className=__CLASS__) {
        class_parents($className);
        parent::__construct($dataModel);
    }

    public function tableName() {
        return 'categories';
    }

    public function attributes() {
        return array(
            # `id`, `id_account`, `post`, `created_at`, `modified_at`
            'id' => [
                'integer',
                'auto_increment'
            ],
            'name' => 'varchar_80',
            'photo' => 'varchar_120',
            'modified_at' => 'time'
        );
    }

    public function rules() {
        return array(
            'primary_key' => 'id'
        );
    }

    public static function all() {
        $sql = "SELECT A.*, (
                    SELECT 
                        count(id) 
                    FROM posts 
                        WHERE id_category = A.id) as post_count 
            FROM `categories` A";

        return self::query($sql);
    }

    public static function create($id_acc, $name, $photo=null ) {

        $sql = sprintf("INSERT INTO `iniforum`.`categories` (
            `id`, `name`, `photo`, `created_by`, `post_count`, `created_at`) 
            VALUES (NULL, :name, :photo, :id_acc, 0, CURRENT_TIMESTAMP);"
        );

        $bindArray = [
            ':id_acc' => $id_acc,
            ':name' => $name,
            ':photo' => $photo
        ];

        self::query($sql, $bindArray);
    }
}