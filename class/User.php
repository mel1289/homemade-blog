<?php

namespace App;

class User
{
    private $id;
    private $login;
    private $admin;

    public function __construct (array $data = array())
    {
        foreach ($data as $k => $v)
        {
            $method = 'set'.ucfirst($k);

            if (method_exists($this, $method))
            {
                $this->$method($v);
            }
        }
    }

    public function isAdmin ()
    {
        return $this->getAdmin();
    }

    public function getId () { return $this->id; }
    public function getLogin () { return $this->login; }
    public function getAdmin () { return $this->admin; }

    public function setId ($value)
    {
        if (!is_numeric ($value)) {
            trigger_error("The value must be a number.", E_USER_WARNING);
            return;
        }

        $this->id = $value;
    }

    public function setLogin ($value)
    {
        if (!is_string($value)) {
            trigger_error("The value must be a string.", E_USER_WARNING);
            return;
        }

        $this->login = $value;
    }

    public function setAdmin ($value)
    {
        if (!is_numeric ($value)) {
            trigger_error("The value must be a number", E_USER_WARNING);
            return;
        }

        $this->admin = $value;
    }
}