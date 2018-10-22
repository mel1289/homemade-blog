<?php

namespace App;

use \PDO;

class CommentManager
{
    private $db;

    public function __construct ($db)
    {
        $this->db = $db;
    }

    public function create (array $comment)
    {
        $query = $this->db->prepare('INSERT INTO comments (user_id, post_id, content, posted) VALUES (:user_id, :post_id, :content, NOW())');
        return $query->execute($comment);
    }

    public function delete ($id)
    {
        $query = $this->db->query("DELETE FROM posts WHERE id = {$id}");
    }

    public function get ($id)
    {
        $query = $this->db->query("SELECT c.*, u.login as author FROM comments c INNER JOIN users u ON u.id = c.user_id WHERE c.post_id = {$id} ORDER BY id DESC");
        $comments = [];

        // to review <!>
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $k)
        {
            $comments[] = new Comment($k);
        }

        return $comments;
    }
}