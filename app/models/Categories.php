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

    public static function create($acc_id, $name, $description, $photo=null ) {

        $sql = sprintf("INSERT INTO `categories`(`id`, `name`, `created_by`, `description`, `created_at`)
            VALUES (null, :name, :acc_id, :description, CURRENT_TIMESTAMP)"
        );

        $bindArray = [
            ':acc_id' => $acc_id,
            ':name' => $name,
            ':description' => $description
        ];

        self::query($sql, $bindArray);
    }

    public static function delete($id) {
        $sql = sprintf("DELETE FROM categories WHERE id=:id"
        );

        $bindArray = [
            ':id' => $id
        ];

        self::query($sql, $bindArray);
    }
}