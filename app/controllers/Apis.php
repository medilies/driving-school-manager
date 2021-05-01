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

            $_SESSION['id'] = "admin";
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
        if ($_SESSION['id'] === "admin") {
            $next_exam = $this->Api->next_exam($_POST);
            if ($next_exam === true) {
                $msg = "Vous aurez un éxamen le {$_POST['date']}";
                $mail_sent = $this->send_mail($_POST['client_mail'], $msg);
                echo "nouveau exam enregistré";
                echo "<br>";
                echo "email: $mail_sent";
            } else if ($next_exam === false) {
                echo "le client a dejé un exament en attente";
            }
        } else {
            Utility::redirect('/');
        }
    }

    public function exam_result()
    {
        if ($_SESSION['id'] === "admin") {
            $result = $this->Api->exam_result($_POST);
            if ($result === true) {
                echo "Résultat enregistré";
            } else if ($result === false) {
                echo "erreur";
            }
        } else {
            Utility::redirect('/');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        Utility::redirect('/');
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
}