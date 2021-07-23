<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core;

use \PDO;
class DB
{
    private static $_instance = NULL;

    private $_con,
        $_query,
        $_error = false,
        $_results = NULL,
        $_lastid = NULL,
        $_count = NULL;

    private function __construct()
    {
        try {
            $this->_con = new PDO("mysql:host=" .DB_HOST. ";dbname=" .DB_NAME. ";charset=utf8",
                DB_USER, DB_PASS);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params=[], $ignore = true)
    {
        $this->_error = false;
        $this->_results = null;
        if ($this->_query = $this->_con->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                switch ($ignore) {
                    case false:
                        foreach ($params as $param) {
                            if (filter_var($param, FILTER_VALIDATE_INT)) {
                                $this->_query->bindValue($x, (int)$param, PDO::PARAM_INT);
                            }else {
                                $this->_query->bindValue($x, $param);
                            }
                            $x++;
                        }
                        break;

                    default:
                        foreach ($params as $param) {
                            $this->_query->bindValue($x, $param);
                            $x++;
                        }
                        break;
                }
            }

            try {
                $this->_query->execute();
                if (substr($sql, 0, 6)== 'INSERT') {
                    $this->_lastid = $this->_con->lastInsertId();
                }

                if (substr($sql, 0, 6)== 'SELECT') {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }

                $this->_count = $this->_query->rowCount();
            }catch (\PDOException $e){
                $this->_error = $e->getMessage();;
            }
        }
        return $this;
    }

    public function error()
    {
        return $this->_error;
    }

    public function action($action, $table, $where = [])
    {
        if (count($where)===3) {
            $use = 1;
        }elseif (count($where)===6) {
            $use = 2;
        }
        $operators = array('=', '!=', '>', '<', 'LIKE', '<=', '>=');

        switch ($use) {
            case 1:
                $field      = $where[0];
                $operator   = $where[1];
                $value      = $where[2];

                if (in_array($operator, $operators)) {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                    if (!$this->query($sql, array($value))->error()) {
                        return $this;
                    }
                }
                break;

            case 2:
                $field1     = $where[0];
                $operator1  = $where[1];
                $value1     = $where[2];
                $field2     = $where[3];
                $operator2  = $where[4];
                $value2     = $where[5];

                if (in_array($operator1, $operators) && in_array($operator2, $operators)) {
                    $sql = "{$action} FROM {$table} WHERE {$field1} {$operator1} ? AND {$field2} {$operator2} ?";

                    if (!$this->query($sql, array($value1, $value2))->error()) {
                        return $this;
                    }
                }
                break;
        }
        return false;
    }

    public function select($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE FROM', $table, $where);
    }

    public function count()
    {
        return $this->_count;
    }

    public function fetch()
    {
        return $this->_results;
    }

    public function fetchOne()
    {
        return $this->_results[0];
    }

    public function lastID()
    {
        return $this->_lastid;
    }

    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields);
            $data = array_values($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) {
                $values .= "?";

                if ($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO " .$table. " (`" .implode('`, `', $keys). "`) VALUES ({$values})";

            if (!$this->query($sql, $data)->error()) {
                return true;
            }
        }
        return false;
    }

    public function update($table,  $fields = array(), $w = array())
    {
        if (count($fields)) {
            $set = '';
            $x = 1;
            $y = 1;
            $where = '';
            $data = array_merge((array_values($fields)), (array_values($w)));

            foreach ($fields as $key => $value) {
                $set .= "{$key} = ?";

                if ($x < count($fields)) {
                    $set .= ', ';
                }
                $x++;
            }

            foreach ($w as $key => $value) {
                $where .= "{$key} = ? ";

                if ($y < count($w)) {
                    $where .= 'AND ';
                }
                $y++;
            }

            $sql = "UPDATE {$table} SET {$set} WHERE {$where}";

            if (!$this->query($sql, $data)->error()) {
                return true;
            }
        }
        return false;
    }
}