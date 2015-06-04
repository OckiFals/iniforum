<?php namespace app\models;

use Ngaji\Database\ActiveRecord;

class Comments extends ActiveRecord {

    public function __construct($dataModel = [], $className=__CLASS__) {
        class_parents($className);
        parent::__construct($dataModel);
    }

    public function tableName() {
        return 'comments';
    }

    public function attributes() {
        return array(
            # `id`, `id_account`, `post`, `created_at`, `modified_at`
            'id' => [
                'integer',
                'auto_increment'
            ],
            'id_account' => 'integer',
            'id_post' => 'integer',
            'text' => 'text',
            'created_at' => 'time'
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
     * @param string $criteria
     * @return \PDOStatement : fetchAll query
     */
    public static function all($criteria = '') {
        $sql = sprintf("SELECT A.id, A.text, B.name, C.title FROM `comments`
	        A INNER JOIN `accounts` B
    	        on A.id_account=B.id
            INNER JOIN `posts` C on A.id_post=C.id %s",
            $criteria
        );

        return self::query($sql);
    }

    public static function findByPost($id) {
        # SELECT A.id as comments_id, A.id_account, A.text, A.created_at, B.id, B.username, B.name, B.photo FROM `comments` A INNER JOIN `accounts` B ON A.id_account = B.id
        $sql = sprintf("SELECT
            A.id as comments_id, A.id_account, A.text, A.created_at,
            B.id, B.username, B.name, B.photo as account_photo,
            C.id as post_id
                FROM `comments` A INNER JOIN `accounts` B
                    ON A.id_account = B.id
                INNER JOIN posts C
                    ON A.id_post=C.id
                    WHERE C.id=:id ORDER BY A.id"
        );

        $bindArray = [
            ':id' => $id,
        ];

        return self::query($sql, $bindArray);
    }

    /**
     * @param $post_id
     * @param $account_id
     * @param $text
     */
    public static function create($post_id, $account_id, $text) {

        $cleanComment = \Post::sensor($text, false);

        $sql = sprintf("INSERT INTO `iniforum`.`comments` (
            `id`, `id_post`, `id_account`, `text`, `created_at`)
            VALUES (NULL, :post_id, :account_id, :comment, now())"
        );

        $bindArray = [
            ':post_id' => $post_id,
            ':account_id' => $account_id,
            ':comment' => $cleanComment
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
            "DELETE FROM `iniforum`.`comments` WHERE `comments`.`id` = :id"
        );

        $bindArray = [
            ':id' => $id
        ];

        self::query($sql, $bindArray);
    }

}