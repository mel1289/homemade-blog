<?php

namespace App;

class Comment
{
    
    use FormatDate; // trait

    private $id;
    private $author;
    private $content;
    private $posted;


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

    public function getPostedFormat ()
    {
        return $this->format_date($this->posted);
    }

    public function setId ($value)
    {
        $this->id = $value;
    }

    public function setAuthor ($value)
    {
        $this->author = $value;
    }

    public function setContent ($value)
    {
        $this->content = $value;
    }

    public function setPosted ($value)
    {
        $this->posted = $value;
    }

    public function getId () { return $this->id; }
    public function getAuthor () { return $this->author; }
    public function getContent () { return $this->content; }
    public function getPosted () { return $this->posted; }

}