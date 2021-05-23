<?php
class Apis extends Controller
{

    public function __construct()
    {
        $this->Api = $this->model('Api');
        header('content-type: text/json');
    }

    public function index()
    {
        echo 'apis';
        die;
    }

    public function join()
    {
        if ((empty($_FILES['client_img']['name']))) {
            echo "il manque des fichers";
            die;
        }

        $email = $_POST['mail'];
        $this->store_file('client_cni', $email);
        $this->store_file('client_blood', $email);
        $this->store_file('client_residence', $email);
        $this->store_file('client_health_cert', $email);
        $this->store_file('client_img', $email);

        $result = $this->Api->join($_POST);
        echo json_encode($result);
        die;
    }

    public function login()
    {
        $client = $this->Api->login($_POST);

        if ($client === "Cet émail n'est pas inscrit") {
            echo json_encode("Email ou mot de passe invalide");
            die;
        }

        if (password_verify($_POST['pass'], $client['pass'])) {
            $_SESSION['id'] = $client['client_id'];
            $_SESSION['fname'] = $client['fname'];
            $_SESSION['lname'] = $client['lname'];
            $_SESSION['mail'] = $client['mail'];
            $_SESSION['phone'] = $client['phone'];

            echo json_encode("authentification réussite");
            die;
        } else {
            echo json_encode("Email ou mot de passe invalide");
            die;
        }

    }

    public function admin()
    {
        if ($_POST['username'] === "admin" && $_POST['pass'] === "admin") {

            $_SESSION['id'] = 0;
            $_SESSION['lname'] = "admin";

            echo json_encode("authentification réussite");
            die;
        } else {
            echo json_encode("Email ou mot de passe invalide");
            die;
        }

    }

    public function next_exam()
    {
        if ($_SESSION['id'] === 0) {
            $next_exam = $this->Api->next_exam($_POST);
            if ($next_exam === true) {

                $to = $_POST['client_mail'];
                $msg = "Vous aurez un éxamen le {$_POST['date']}";

                $mail_sent = $this->send_mail($to, $msg);

                echo "<br>";
                echo "nouveau exam enregistré";
                echo "<br>";
                echo "email: $mail_sent";

                Utility::redirect('/pages/dash');
            } else if ($next_exam === false) {
                echo "le client a dejé un exament en attente";
            }
        } else {
            Utility::redirect('/');
        }
    }

    public function exam_result()
    {
        if ($_SESSION['id'] === 0) {
            Utility::redirect('/');
        }

        $result = $this->Api->exam_result($_POST);
        if ($result === true) {
            echo "Résultat enregistré";
            Utility::redirect('/pages/dash');
        } else if ($result === false) {
            echo "erreur";
        }

    }

    public function delete_exam()
    {
        if ($_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $result = $this->Api->delete_exam($_POST);
        if ($result === true) {
            echo "Résultat enregistré";
            Utility::redirect('/pages/dash');
        } else if ($result === false) {
            echo "erreur";
        }

    }

    public function client_agreement()
    {
        if (!isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $result = $this->Api->client_agreement($_POST);
        if ($result === true) {
            echo "Résultat enregistré";
            if($_SESSION['id'] === 0){
                Utility::redirect('/pages/dash');
                die;
            }
            Utility::redirect('/pages/agenda');
        } else if ($result === false) {
            echo "erreur";
        }

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        Utility::redirect('/');
    }

    public function delete_client($client_id)
    {
        if ($_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $result = $this->Api->delete_client($client_id);
        if ($result === true) {
            echo "client supprimé";
            Utility::redirect('/pages/clients_list');
            die;
        } else {
            echo "erreur";
            die;
        }

    }

    public function add_post()
    {
        if (!isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $result = $this->Api->add_post($_POST);
        if ($result === true) {
            echo "post ajouté";
            Utility::redirect('/pages/forum');
            die;
        } else {
            echo "erreur";
            die;
        }
    }

    public function add_comment()
    {
        if (!isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $post_id = $_POST['post_id'];

        $result = $this->Api->add_comment($_POST);
        if ($result === true) {
            echo "commentaire ajouté";
            Utility::redirect("/pages/post/$post_id");
            die;
        } else {
            echo "erreur";
            die;
        }
    }

    private function send_mail($to, $msg)
    {
        $mail_user = "autoecole634";
        $pass = "Autoecole634+";
        $from = "Autoecole634@gmail.com";

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        //Enable SMTP debugging.
        // $mail->SMTPDebug = 3;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = $mail_user;
        $mail->Password = $pass;
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->From = $from;
        $mail->FromName = "Auto ecole";

        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = "Date d'éxamen";
        $mail->Body = $msg;
        $mail->AltBody = "Vous aurez un examen prochainement";

        try {
            $mail->send();
            echo "Message has been sent successfully";
        } catch (PHPMailer\PHPMailer\Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            die;
        }
    }

    private function store_file($name, $email)
    {
        // Where the file is going to be stored
        $target_dir = PROJECT_ROOT . "/public/assets/uploads/$email/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir);
        }

        $file = $_FILES[$name]['name'];
        $path = pathinfo($file);

        $ext = $path['extension'];
        $temp_name = $_FILES[$name]['tmp_name'];
        $path_filename_ext = "$target_dir" . "$name.$ext";

        // Check if file already exists
        if (file_exists($path_filename_ext)) {
            echo json_encode("$name éxiste déja dans le serveur!");
            die;
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
            // echo "Congratulations! File Uploaded Successfully.";
        }
    }
}
