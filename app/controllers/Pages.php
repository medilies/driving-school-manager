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
            'stylesheets_array' => ['about'],
            'scripts_array' => [],
        ];
        $this->view('pages/about', $data);
    }

    public function code()
    {
        $data = [
            'title' => 'Codes',
            'stylesheets_array' => [],
            'scripts_array' => ["code"],
        ];
        $this->view('pages/code', $data);
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
        if (!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === 0) {
            Utility::redirect('/');
        }

        $exams = $this->page->exams();

        $data = [
            'title' => 'Examens',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'data' => $exams,
        ];

        $this->view('pages/agenda', $data);
    }

    public function dash()
    {
        if (!isset($_SESSION['id']) || $_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $clients = $this->page->clients();

        $data = [
            'title' => 'Examens',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'data' => $clients,
        ];

        $this->view('pages/dash', $data);
    }

    public function clients_list()
    {
        if (!isset($_SESSION['id']) || $_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $clients = $this->page->clients_list();

        $data = [
            'title' => 'Dossiers',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'clients' => $clients,
        ];

        $this->view('pages/clients_list', $data);
    }

    public function versements($client_id){
        if (!isset($_SESSION['id']) || $_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $client = $this->page->client($client_id);
        $versements = $this->page->versements($client_id);

        $data = [
            'title' => 'Dossiers',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'client' => $client,
            'versements' => $versements[0],
            'versements_sum' => $versements[1],
        ];

        $this->view('pages/versements', $data);
    }

    public function forum()
    {
        if (!isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $posts = $this->page->posts();

        $data = [
            'title' => 'forum',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'posts' => $posts,
        ];

        $this->view('pages/forum', $data);
    }

    public function post($post_id)
    {
        if (!isset($_SESSION['id'])) {
            Utility::redirect('/');
        }

        $post = $this->page->post($post_id);

        $data = [
            'title' => 'post',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'post' => $post,
        ];

        $this->view('pages/post', $data);
    }

    public function validation_dossier($client_id){
        if (!isset($_SESSION['id']) || $_SESSION['id'] !== 0) {
            Utility::redirect('/');
        }

        $client = $this->page->client($client_id);
        $dossier = $this->page->dossier($client_id);

        $data = [
            'title' => 'Dossiers',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'client' => $client,
            'dossier' => $dossier,
        ];

        $this->view('pages/dossier', $data);
    }

    public function my_dossier(){
        if (!isset($_SESSION['id']) || $_SESSION['id'] === 0) {
            Utility::redirect('/');
        }

        $client = $this->page->client($_SESSION['id']);
        $dossier = $this->page->dossier($_SESSION['id']);

        $data = [
            'title' => 'Dossiers',
            'stylesheets_array' => [],
            'scripts_array' => [],
            'client' => $client,
            'dossier' => $dossier,
        ];

        $this->view('pages/dossier', $data);
    }

}
