<?php

namespace App;

use \PDO;

class DB
{
    private $host;
    private $login;
    private $pass;
    private $db;

    private $query;
    private $count;
    private $error;
    private $results;

    private $pdo;

    const OPERATORS = array('<', '>', '=', '!=', '>=', '<=');

    public function __construct ($db, $host = 'localhost', $login = 'root', $password = '')
    {
        $this->db = $db;
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
    }

    public function getPDO ()
    {
        if ($this->pdo === null) {
            dd ('DB::getPDO called');
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->login, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function action ($table, $sql, $where = array())
    {
        if  (count($where) === 3) {

            $field = $where[0];
            $operator = $where[1];
            $param = $where[2];

            if (in_array($operator, self::OPERATORS)) {
                $sql .= " FROM {$table} WHERE {$field} {$operator} ?";

                $query = $this->query($sql, array($param));
                return $this;
            } else {
                echo 'non';
            }
        }
    }

    public function all ($table, $class = null, $where = array())
    {
        if (count($where) === 3) {
            
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, self::OPERATORS)) {
                $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$field} {$operator} '{$value}'");
                $query->execute();

                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }

        else {
            $query = $this->pdo->query("SELECT * FROM {$table}");

            if ($class != null)
            {
                $query->setFetchMode(PDO::FETCH_CLASS, $class);

            }            
            return $query->fetchAll();
            
        }
    }

    public function delete ($table, $id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$table} WHERE id = ?");
        
        return $query->execute(array($id));
    }

}