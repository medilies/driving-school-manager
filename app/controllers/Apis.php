<?php
/**
 * Kinda loads HTML pages ith its related assets
 * Directly related with layout page
 */

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

        // if (password_verify($pass, $_POST['pass'])) {
        if ($client['pass'] === $_POST['pass']) {
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
                $msg = "Vous aurez un éxamen le {$_POST['date']}";
                $mail_sent = $this->send_mail($_POST['client_mail'], $msg);
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

    private function send_mail($to, $msg)
    {
        require_once PROJECT_ROOT . '/app/PHPMailer/src/Exception.php';
        require_once PROJECT_ROOT . '/app/PHPMailer/src/PHPMailer.php';
        require_once PROJECT_ROOT . '/app/PHPMailer/src/SMTP.php';
        require_once PROJECT_ROOT . '/app/PHPMailer/language/phpmailer.lang-fr.php';

        try {

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $mail->FromName = "Auto ecole";
            $mail->From = "admin@autoecole.com";
            $mail->AddAddress($to, 'client');
            $mail->Subject = "Examen de conduite";
            $mail->Body = wordwrap($msg);

            // $subject = "Examen de conduite";
            // $msg = wordwrap($msg);
            // $from = "Auto ecole <admin@autoecole.com>";
            // $header = "From: {$from}";
            // mail($to, $subject, $msg, $header);

            return $mail->Send();
        } catch (PHPMailer\PHPMailer\Exception$e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
