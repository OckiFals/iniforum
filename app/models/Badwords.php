<?php namespace app\models;

use Ngaji\Database\ActiveRecord;
use Ngaji\Database\QueryBuilder;

class Badwords extends ActiveRecord {

    public function __construct($className=__CLASS__) {
        class_parents($className);
    }

    public function tableName() {
        return 'badwords';
    }

    public function attributes() {
        return array(
            # example attributes
            'id' => [
                'integer',
                'auto_increment',
                'primary_key'
            ],
            'word' => 'varchar_80',
            'type' => 'integer',
        );
    }

    public static function all() {
        $sql = (new QueryBuilder)->select('word')->from(static::tableName());

        return self::query($sql);
    }

    public static function create($word ) {

        $sql = sprintf("INSERT INTO `badwords`(`id`, `word`, `type`)
            VALUES (null, :word, 2)"
        );

        $bindArray = [
            ':word' => $word
        ];

        self::query($sql, $bindArray);
    }

    public static function update($id, $word) {
        $sql = "UPDATE badwords SET word=:word WHERE id=:id";

        $bindArray = [
            ':id' => $id,
            'word' => $word
        ];

        self::query($sql, $bindArray);
    }

    public static function delete($id) {
        $sql = "DELETE FROM badwords WHERE id=:id";

        $bindArray = [
            ':id' => $id
        ];

        self::query($sql, $bindArray);
    }
}