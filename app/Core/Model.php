<?php

namespace App\Core;

class Model
{
    private $where;
    private $andWhere;
    private $orderBy;
    private $join;
    private $joinTable;
    private $on;
    private $and;
    private $or;

    private $limit;
    private $offset;

    public function connect()
    {
        $config = require '../app/config/db.php';
        return mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);
    }

    public function where($key, $value)
    {
        $this->where = "WHERE $key=$value";
        return $this;
    }

    public function andWhere($key, $value, $where_key, $where_value)
    {
        $this->andWhere = "WHERE $key='$value' and $where_key='$where_value'";
        return $this;
    }

    public function orderBy($title, $sort = null)
    {
        $this->orderBy = "ORDER BY $title $sort";
        return $this;
    }


    public function join($join)
    {
        $this->join = $join;
        return $this;
    }

    public function joinTable($table)
    {
        $this->joinTable = $table;
        return $this;
    }

    public function on($key, $value)
    {
        $this->on = "ON $key=$value";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = "OFFSET $offset";
        return $this;
    }

    public function findAll()
    {
        $result = mysqli_query($this->connect(), "SELECT * FROM $this->table $this->join $this->joinTable $this->on $this->where $this->andWhere $this->orderBy $this->limit $this->offset");
        return mysqli_fetch_all($result);
    }

    public function findOne()
    {
        $result = mysqli_query($this->connect(), "SELECT * FROM $this->table $this->join $this->joinTable $this->on $this->where $this->andWhere");
        return mysqli_fetch_row($result);
    }

    public function countRow()
    {
        $result = mysqli_query($this->connect(), "SELECT COUNT(*) FROM $this->table $this->where $this->andWhere");
        return mysqli_fetch_column($result);
    }

    public function insert($array = [])
    {
        $columns = '';
        $values = '';

        foreach ($array as $key => $value) {
            $columns .= $key . ',';
            $values .= "'$value',";
        }

        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');

        $result = mysqli_query($this->connect(), "INSERT INTO $this->table ($columns) VALUES ($values)");

        return $result;
    }

    public function update($array = [])
    {
        $result = '';
        foreach ($array as $key => $value) {
            $result = mysqli_query($this->connect(), "UPDATE $this->table SET $key='$value' $this->where $this->andWhere");
        }

        return $result;
    }

    public function delete()
    {
        $result = mysqli_query($this->connect(), "DELETE FROM $this->table $this->where");
        return $result;
    }
}