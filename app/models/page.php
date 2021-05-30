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

        if(isset($_POST['client_search']) && !empty($_POST['client_search'])){

            $client_search = $_POST['client_search'];

            if (strtotime($client_search) !== false) {
                
                $exam_date = date('Y-m-d',strtotime($client_search));
                
                $query4 = "SELECT * FROM clients WHERE client_id 
                    IN(
                        SELECT client_id FROM exam_code WHERE planned_on = '$exam_date'
                        UNION 
                        SELECT client_id FROM exam_creno WHERE planned_on = '$exam_date'
                        UNION 
                        SELECT client_id FROM exam_circuit WHERE planned_on = '$exam_date'
                    )
                ";

            }
            else{

                $client_search = $client_search;
                $query4.= " AND CONCAT(lname, ' ', fname) LIKE '%$client_search%'";

            }
        }

        $query4.=" ORDER BY client_id DESC";
        
        
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

    public function clients_list(){
        $query = "SELECT clients.client_id, clients.fname, clients.lname, clients.bday, clients.mail, clients.phone, SUM(versements.amount) AS versements_sum FROM clients
        LEFT JOIN versements ON clients.client_id = versements.client_id
        WHERE clients.client_id != 0
        GROUP BY clients.client_id
        ORDER BY clients.client_id DESC";

        try{
            $clients = $this->Root->prepare($query);
            $clients->execute();
            $clients = $clients->fetchAll();

            return $clients;
        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function client($client_id){
        $query = "SELECT * FROM clients WHERE client_id = :client_id";

        try{
            $client = $this->Root->prepare($query);
            $client->bindParam('client_id', $client_id, PDO::PARAM_STR);
            $client->execute();
            $client = $client->fetch();

            return $client;
        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function dossier($client_id){
        $query = "SELECT * FROM dossier WHERE client_id = :client_id";

        try{
            $dossier = $this->Root->prepare($query);
            $dossier->bindParam('client_id', $client_id, PDO::PARAM_STR);
            $dossier->execute();
            $dossier = $dossier->fetch();

            return $dossier;
        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    public function versements($client_id){
        $query1 = "SELECT * FROM versements 
        WHERE client_id = :client_id";

        $query2 = "SELECT SUM(amount) AS versements_sum FROM versements 
        WHERE client_id = :client_id";

        try{
            $versements = $this->Root->prepare($query1);
            $versements->bindParam('client_id', $client_id, PDO::PARAM_STR);
            $versements->execute();
            $versements = $versements->fetchAll();

            $sum = $this->Root->prepare($query2);
            $sum->bindParam('client_id', $client_id, PDO::PARAM_STR);
            $sum->execute();
            $sum = $sum->fetch();

            return [$versements, $sum["versements_sum"]];
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
