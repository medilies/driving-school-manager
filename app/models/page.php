<?php
// writte requests with heredoc ?
class Page extends Database
{
    public function __construct()
    {
        $this->set_db_users();
    }

    public function exams()
    {
        $client_id = $_SESSION['id'];

        $query1 = "SELECT * FROM exam_code WHERE client_id='$client_id'";
        $query2 = "SELECT * FROM exam_creno WHERE client_id='$client_id'";
        $query3 = "SELECT * FROM exam_circuit WHERE client_id='$client_id'";

        try {
            $code = $this->Root->prepare($query1);
            $creno = $this->Root->prepare($query2);
            $circuit = $this->Root->prepare($query3);

            $code->execute();
            $creno->execute();
            $circuit->execute();

            $code = $code->fetchAll();
            $creno = $creno->fetchAll();
            $circuit = $circuit->fetchAll();

            return [
                'code' => $code,
                'creno' => $creno,
                'circuit' => $circuit,
            ];

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function clients()
    {
        $query1 = "SELECT * FROM exam_code";
        $query2 = "SELECT * FROM exam_creno";
        $query3 = "SELECT * FROM exam_circuit";
        $query4 = "SELECT * FROM clients WHERE client_id != 0";

        try {
            $code = $this->Root->prepare($query1);
            $creno = $this->Root->prepare($query2);
            $circuit = $this->Root->prepare($query3);
            $clients = $this->Root->prepare($query4);

            $code->execute();
            $creno->execute();
            $circuit->execute();
            $clients->execute();

            $code = $code->fetchAll();
            $creno = $creno->fetchAll();
            $circuit = $circuit->fetchAll();
            $clients = $clients->fetchAll();

            return [
                'code' => $code,
                'creno' => $creno,
                'circuit' => $circuit,
                'clients' => $clients,
            ];

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function posts()
    {
        $query1 = "SELECT * FROM posts
            JOIN clients ON posts.client_id = clients.client_id
            ORDER BY posts.post_id DESC
        ";

        try {
            $posts = $this->Root->prepare($query1);

            $posts->execute();

            $posts = $posts->fetchAll();

            return $posts;

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function post($post_id)
    {
        $post_id = intval($post_id);

        $query1 = "SELECT * FROM posts
            JOIN clients ON posts.client_id = clients.client_id
            WHERE post_id = $post_id
        ";

        $query2 = "SELECT * FROM comments
            JOIN clients ON comments.client_id = clients.client_id
            WHERE post_id = $post_id
            ORDER BY comments.comment_id ASC
        ";

        try {
            $post = $this->Root->prepare($query1);
            $comments = $this->Root->prepare($query2);

            $post->execute();
            $comments->execute();

            $post = $post->fetch();
            $comments = $comments->fetchAll();

            return [
                'post' => $post,
                'comments' => $comments,
            ];

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }
}
