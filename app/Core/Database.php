<?php

namespace App\Core;

abstract class Database
{
    protected $db;

    abstract protected function connect();

    public function __construct()
    {
        //$config = require '../app/config/db.php';
        //$this->db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);
        $this->db = mysqli_connect('mysql','root','root','oop');
    }

    abstract protected function findOne();

    abstract protected function findAll();

    abstract protected function where($key, $value);

    abstract protected function andWhere($column, $value, $where_column, $where_value);

    abstract protected function email($email);

    abstract protected function create($columns, $values);
}