<?php

namespace App;

use \PDO;

class UserManager
{
    private $db;

    const ERR_USER_EXIST = 1;
    const ERR_USER_LOGIN_FAILED = 2;

    public function __construct ($db)
    {
        $this->db = $db;
    }

    public function exist ($data)
    {
        if (is_string($data)) {
            $query = $this->db->prepare('SELECT id FROM users WHERE login = ?');
            $query->execute(array($data));

            if ($query->rowCount()) return self::ERR_USER_EXIST;
        }
    }

    public function register ($credentials)
    {
        $credentials['password'] = password_hash($credentials['password'], PASSWORD_BCRYPT);
        $query = $this->db->prepare('INSERT INTO users (login, password) VALUES (:login, :password)');
        return $query->execute($credentials);
    }

    public function tryConnect ($credentials)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE login = ?');
        $query->execute(array($credentials['login']));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) return self::ERR_USER_LOGIN_FAILED;
        
        if (!password_verify($credentials['password'], $data['password'])) return self::ERR_USER_LOGIN_FAILED;

        return $data;
    }

    public function find ($id)
    {
        dd ('UserManager::find('.$id.') called');
        $id = (int) $id;
        
        $query = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}