<?php namespace Ngaji\Database;
/**
 * @package Ngaji/Database
 * @author  Ocki Bagus Pratama
 * @date    26/05/15
 * @time    23:16
 * @since   2.0.1
 */

class DbCriteria {
    private $sql = '';

    /**
     * Make the instance of the object
     */
    public function __construct() {

    }

    public function order_by($field) {
        $this->sql .= ' ORDER BY ' . $field;

        return $this;
    }

    public function DESC() {
        $this->sql .= ' DESC ';

        return $this;
    }

    public function ASC() {
        $this->sql .= ' ASC ';

        return $this;
    }

    public function LIMIT($ofset, $to='') {
        if (!empty($to))
            $this->sql .= " LIMIT $ofset , $to ";
        else
            $this->sql .= ' LIMIT ' . $ofset;

        return $this;
    }

    public function like($like) {
        $this->sql .= ' like ' . "'{$like}'";

        return $this;
    }

    public function __toString() {
        return $this->sql;
    }
}