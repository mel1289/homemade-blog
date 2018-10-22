<?php

namespace App;

use \PDO;

class PostManager
{
    private $db;

    public function __construct ($db)
    {
        $this->db = $db;
    }

    public function create (array $post)
    {
        $query = $this->db->prepare('INSERT INTO posts (title, content, author, postedAt, online) VALUES (:title, :content, :author, NOW(), :online)');
        return $query->execute($post);
    }

    public function delete ($id)
    {
        $query = $this->db->query("DELETE FROM posts WHERE id = {$id}");
    }

    public function findAll ()
    {
        $query = $this->db->query('SELECT * FROM posts ORDER BY id DESC');
        $posts = [];

        // to review <!>
        foreach ($query->fetchAll() as $k)
        {
            $posts[] = new Post($k);
        }

        return $posts;
    }

    public function findAllOnline ()
    {
        $query = $this->db->query('SELECT * FROM posts WHERE online = 1 ORDER BY id DESC');
        $posts = [];

        // to review <!>
        foreach ($query->fetchAll() as $k)
        {
            $posts[] = new Post($k);
        }

        return $posts;
    }

    public function update (Post $post)
    {
        $query = $this->db->prepare('UPDATE posts SET title = :title, content = :content, online = :online WHERE id = :id');
        return $query->execute([
            'title'     => $post->getTitle(),
            'content'   => $post->getContent(),
            'online'    => $post->getOnline(),
            'id'        => $post->getId()
        ]);
    }

    public function findOnline ($id)
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE online = 1 AND id = ?');
        $query->execute(array($id));

        return $query->fetch();
    }

    public function find ($id)
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute(array($id));

        $post = $query->fetch();

        if (!empty($post)) return new Post($post);
        return $post;
    }

    public function add (Post $post)
    {
        //
    }
}