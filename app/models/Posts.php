<?php namespace app\models;

use Ngaji\Database\ActiveRecord;

class Posts extends ActiveRecord {

    public function __construct($dataModel = [], $className=__CLASS__) {
        class_parents($className);
        parent::__construct($dataModel);
    }

    public function tableName() {
        return 'posts';
    }

    public function attributes() {
        return array(
            # `id`, `id_account`, `post`, `created_at`, `modified_at`
            'id' => [
                'integer',
                'auto_increment'
            ],
            'id_account' => 'integer',
            'post' => 'text',
            'created_at' => 'time',
            'modified_at' => 'time'
        );
    }

    public function rules() {
        return array(
            'primary_key' => 'id',
            'many_to_many' => [
                'accounts' => 'id'
            ]
        );
    }

    /**
     * Get all data!
     * @return \PDOStatement: fetchAll query
     */
    public static function all() {
        $sql = sprintf("SELECT A.*, B.username, B.name, B.id as account_id, B.photo as account_photo,
            C.name as category_name, C.id as category_id
            FROM posts A LEFT JOIN accounts B
                ON A.id_account = B.id
                LEFT JOIN categories C ON
                A.id_category = C.id"
        );

        return self::query($sql);
    }

    /**
     * @param $param
     * @param bool $action
     * @return mixed|void
     */
    public static function find($param, $action=true) {
        $command = sprintf("SELECT A.*, B.username, B.name, B.id as account_id,
            C.name as category_name, C.id as category_id
            FROM posts A LEFT JOIN accounts B
                ON A.id_account = B.id
                LEFT JOIN categories C ON
                A.id_category = C.id"
        );

        $list = Array();
        $parameter = null;
        foreach ($param as $key => $value) {
            $list[] = "$key = :$key";
            $parameter .= ', ":' . $key . '":"' . $value . '"';
        }

        $command .= ' WHERE ' . implode(' AND ', $list);

        $json = "{" . substr($parameter, 1) . "}";
        $param = json_decode($json, true);

        $prepareStatement = self::query($command, $param);

        if ($action)
            return $prepareStatement;

        # if row columns more than 1
        if (1 < $prepareStatement->rowCount())
            return $prepareStatement->fetchAll();

        return $prepareStatement->fetch();
    }

    /**
     * @param $id
     *
     * @return \PDOStatement
     */
    public static function read($id) {
        $sql = sprintf("SELECT A.*, B.username, B.name, B.id as account_id,
            C.name as category_name, C.id as category_id
            FROM posts A LEFT JOIN accounts B
                ON A.id_account = B.id
                LEFT JOIN categories C ON
                A.id_category = C.id
                WHERE A.id = :id"
        );

        $bindArray = [
            ':id' => $id,
        ];

        return self::query($sql, $bindArray)->fetch();
    }

    /**
     * @param $id
     * @param $title
     * @param $post
     * @param int $category
     */
    public static function create($id, $title, $post, $category=2) {

        $cleanPost = \Post::sensor($post, false);

        $sql = sprintf("INSERT INTO `iniforum`.`posts` (
            `id`, `id_account`, `title`, `id_category`, `post`, `created_at`, `modified_at`
            ) VALUES (NULL, :id, :title, :category, :post, now(), CURRENT_TIMESTAMP)"
        );

        $bindArray = [
            ':id' => $id,
            ':title' => $title,
            ':post' => $cleanPost,
            ':category' => $category
        ];

        self::query($sql, $bindArray);
    }

    /**
     * @param $id
     * @param $id_acc
     * @param $title
     * @param $post
     * @param int $category
     */
    public static function edit($id, $id_acc, $title, $post, $category=2) {

        $cleanPost = \Post::sensor($post, false);

        $sql = sprintf("UPDATE `iniforum`.`posts`
            SET `post` = :post, `title` = :title, `id_category` = :category, `modified_at`=now()
            WHERE `posts`.`id` = :id AND `posts`.`id_account` = :id_acc"
        );

        $bindArray = [
            ':id' => $id,
            ':id_acc' => $id_acc,
            ':title' => $title,
            ':post' => $cleanPost,
            ':category' => $category
        ];

        self::query($sql, $bindArray);
    }

    /**
     *
     * @param $id: primary key
     */
    public static function delete($id) {
        $sql = sprintf(
            "DELETE FROM `iniforum`.`posts` WHERE `posts`.`id` = :id"
        );

        $bindArray = [
            ':id' => $id
        ];

        self::query($sql, $bindArray);
    }

    public static function incrementView($id) {
        $post = Posts::findByPK($id);

        $sql = sprintf("UPDATE `iniforum`.`posts`
            SET `viewers` = :view WHERE `posts`.`id` = :id"
        );

        $bindArray = [
            ':id' => $id,
            ':view' => $post['viewers'] + 1
        ];

        self::query($sql, $bindArray);
    }
}