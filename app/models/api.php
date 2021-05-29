<?php
class Api extends Database
{
    public function __construct()
    {
        $this->set_db_users();
    }

    public function join(array $client_data)
    {
        foreach ($client_data as $key => $value) {
            $$key = $value;
        }

        $query1 = 'INSERT INTO clients(lname, fname, bday, mail, phone, pass)
            VALUES(:lname, :fname, :bday, :mail, :phone, :pass)';

        $fname = ucwords(strtolower($fname));
        $lname = ucwords(strtolower($lname));
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        try {
            $client = $this->Root->prepare($query1);
            $client->bindParam(':lname', $lname, PDO::PARAM_STR);
            $client->bindParam(':fname', $fname, PDO::PARAM_STR);
            $client->bindParam(':bday', $bday, PDO::PARAM_STR);
            $client->bindParam(':mail', $mail, PDO::PARAM_STR);
            $client->bindParam(':phone', $phone, PDO::PARAM_STR);
            $client->bindParam(':pass', $pass, PDO::PARAM_STR);

            if ($client->execute()) {
                return "Inscription réusite";
            }
        } catch (PDOException $e) {
            if (preg_match("/SQLSTATE\[23000]: Integrity constraint violation: 1062 Duplicate entry '$mail' for key 'clients\.mail'/", $e->getMessage())) {
                return "l'émail $mail est déja utilisé";
            } else if (preg_match("/SQLSTATE\[23000]: Integrity constraint violation: 1062 Duplicate entry '$phone' for key 'clients\.phone'/", $e->getMessage())) {
                return "Le numéro $phone est déja utilisé";
            }
            return $e->getMessage();
        }
    }

    public function login(array $client_data)
    {
        foreach ($client_data as $key => $value) {
            $$key = $value;
        }

        $query1 = "SELECT * FROM clients WHERE mail=:mail";

        try {
            $client = $this->Root->prepare($query1);
            $client->bindParam(':mail', $mail, PDO::PARAM_STR);

            if ($client->execute()) {
                if ($client->rowCount() === 1) {
                    return $client->fetch();
                } else if ($client->rowCount() === 0) {
                    return "Cet émail n'est pas inscrit";
                }
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
            die;
        }
    }

    public function next_exam(array $exam)
    {
        foreach ($exam as $key => $value) {
            $$key = $value;
        }

        $table = 'exam_' . $exam_type;

        $query1 = "INSERT into $table (client_id, planned_on, result)
        VALUE(:client_id, :planned_on, 'En attente')";

        $query2 = "SELECT * FROM $table WHERE client_id = $client_id AND result = 'En attente'";

        try {
            $check = $this->Root->prepare($query2);
            $check->execute();
            if ($check->rowCount() > 0) {
                return false;
            }

            $exam = $this->Root->prepare($query1);
            $exam->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $exam->bindParam(':planned_on', $date, PDO::PARAM_STR);

            if ($exam->execute()) {
                return true;
            }

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function exam_result(array $exam)
    {
        foreach ($exam as $key => $value) {
            $$key = $value;
        }

        $table = 'exam_' . $exam_type;

        $query1 = "UPDATE $table
        SET  result = :result
        WHERE exam_id = :exam_id";

        try {

            $exam = $this->Root->prepare($query1);
            $exam->bindParam(':result', $result, PDO::PARAM_INT);
            $exam->bindParam(':exam_id', $exam_id, PDO::PARAM_STR);

            if ($exam->execute()) {
                return true;
            }

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function delete_exam(array $exam)
    {
        foreach ($exam as $key => $value) {
            $$key = $value;
        }

        $table = 'exam_' . $exam_type;

        $query1 = "DELETE FROM $table
        WHERE exam_id = :exam_id";

        try {

            $exam = $this->Root->prepare($query1);
            $exam->bindParam(':exam_id', $exam_id, PDO::PARAM_STR);

            if ($exam->execute()) {
                return true;
            }

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function client_agreement(array $exam)
    {
        foreach ($exam as $key => $value) {
            $$key = $value;
        }

        $table = 'exam_' . $exam_type;

        $query1 = "UPDATE $table
        SET  client_agreement = :client_agreement
        WHERE exam_id = :exam_id";

        try {

            $exam = $this->Root->prepare($query1);
            $exam->bindParam(':client_agreement', $client_agreement, PDO::PARAM_INT);
            $exam->bindParam(':exam_id', $exam_id, PDO::PARAM_STR);

            if ($exam->execute()) {
                return true;
            }

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function delete_client($client_id)
    {
        $query1 = "DELETE FROM clients WHERE client_id = :client_id";

        try {

            $exam = $this->Root->prepare($query1);
            $exam->bindParam(':client_id', $client_id, PDO::PARAM_STR);

            if ($exam->execute()) {
                return true;
            }

        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function add_post($post)
    {

        $post_title = $post['post_title'];
        $post_content = $post['post_content'];
        $client_id = $_SESSION['id'];

        $query1 = 'INSERT INTO posts(post_title, post_content, client_id)
            VALUES(:post_title, :post_content, :client_id)';

        try {
            $client = $this->Root->prepare($query1);
            $client->bindParam(':post_title', $post_title, PDO::PARAM_STR);
            $client->bindParam(':post_content', $post_content, PDO::PARAM_STR);
            $client->bindParam(':client_id', $client_id, PDO::PARAM_INT);

            if ($client->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function add_comment($comment)
    {
        $comment_content = $comment['comment_content'];
        $post_id = $comment['post_id'];
        $client_id = $_SESSION['id'];

        $query1 = 'INSERT INTO comments(comment_content, post_id, client_id)
            VALUES(:comment_content, :post_id, :client_id)';

        try {
            $client = $this->Root->prepare($query1);
            $client->bindParam(':comment_content', $comment_content, PDO::PARAM_STR);
            $client->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $client->bindParam(':post_id', $post_id, PDO::PARAM_INT);

            if ($client->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function validation_dossier(){

        foreach ($_POST as $key => $value) {
            $$key = $value;
        }

        $query = "UPDATE dossier
        SET  $element = :validation_action
        WHERE client_id = :client_id";

        try{
            $dossier = $this->Root->prepare($query);
            $dossier->bindParam(':validation_action', $validation_action, PDO::PARAM_INT);
            $dossier->bindParam(':client_id', $client_id, PDO::PARAM_STR);
            $dossier->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function edit_dossier($file_name){
        $query = "UPDATE dossier
        SET  $file_name = NULL
        WHERE client_id = :client_id";

        try{
            $dossier = $this->Root->prepare($query);
            $dossier->bindParam(':client_id', $_SESSION['id'], PDO::PARAM_STR);
            $dossier->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
