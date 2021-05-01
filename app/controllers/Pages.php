<?php
/**
 * Kinda loads HTML pages ith its related assets
 * Directly related with layout page
 */
class Pages extends Controller
{
    public function __construct()
    {
        $this->page = $this->model('page');
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'stylesheets_array' => ["home"],
            'scripts_array' => [],
        ];
        $this->view('pages/home', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'stylesheets_array' => ['contact'],
            'scripts_array' => [],
        ];
        $this->view('pages/contact', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Apropos',
            'stylesheets_array' => [],
            'scripts_array' => [],
        ];
        $this->view('pages/about', $data);
    }

    public function join()
    {
        if (isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $data = [
            'title' => 'Rejoindre',
            'stylesheets_array' => [],
            'scripts_array' => ["join"],
        ];
        $this->view('pages/join', $data);
    }

    public function login()
    {
        if (isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $data = [
            'title' => 'Connecter',
            'stylesheets_array' => [],
            'scripts_array' => ["login"],
        ];
        $this->view('pages/login', $data);
    }

    public function admin()
    {
        if (isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $data = [
            'title' => 'Connecter',
            'stylesheets_array' => [],
            'scripts_array' => ["admin"],
        ];
        $this->view('pages/admin', $data);
    }

    public function agenda()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === 'admin') {
            Utility::redirect('/');
        }

        $exams = $this->page->exams();

        $data = [
            'title' => 'Agenda',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'data' => $exams,
        ];

        $this->view('pages/agenda', $data);
    }

    public function dash()
    {
        if (!isset($_SESSION['id']) || $_SESSION['id'] !== "admin") {
            Utility::redirect('/');
        }

        $clients = $this->page->clients();

        $data = [
            'title' => 'Agenda',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'data' => $clients,
        ];

        $this->view('pages/dash', $data);
    }

}
