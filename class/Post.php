<?php

namespace App;

class Post
{

    use FormatDate; // trait

    private $id;
    private $title;
    private $content;
    private $author;
    private $online;
    private $postedAt;

    public function __construct (array $data)
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

    public function getPostedAtFormated ()
    {
        return $this->format_date($this->postedAt);
    }

    public function getId () { return $this->id; }
    public function getTitle () { return $this->title; }
    public function getAuthor () { return $this->author; }
    public function getContent () { return $this->content; }
    public function getPostedAt () { return $this->postedAt; }
    public function getOnline () { return $this->online; }

    public function setOnline ($value)
    {
        if (!is_numeric ($value)) {
            trigger_error("The value must be a number.", E_USER_WARNING);
            return;
        }
        
        $this->online = $value;
    }

    public function setId ($value)
    {
        if (!is_numeric ($value)) {
            trigger_error("The value must be a number.", E_USER_WARNING);
            return;
        }

        $this->id = $value;
    }

    public function setTitle ($value)
    {
        if (!is_string($value)) {
            trigger_error("The value must be a string.", E_USER_WARNING);
            return;
        }

        $this->title = $value;
    }

    public function setAuthor ($value)
    {
        if (!is_string($value)) {
            trigger_error("The value must be a string.", E_USER_WARNING);
            return;
        }

        $this->author = $value;
    }

    public function setContent ($value)
    {
        if (!is_string($value)) {
            trigger_error("The value must be a string.", E_USER_WARNING);
            return;
        }

        $this->content = $value;
    }

    public function setPostedAt ($value)
    {
        $this->postedAt = $value;
    }

    public function getResumeContent ()
    {
        if (strlen($this->content) >= 100) {
            return substr($this->content, 0, 400).'...';
        }

        return $this->content;
    }
}