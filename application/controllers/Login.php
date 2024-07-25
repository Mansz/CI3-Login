<?php
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); // Memuat model User_model
        $this->load->library('session');  // Memuat library session
    }

    public function index() {
        $this->load->view('login_view'); // Memuat view login_view.php
    }

    public function authenticate() {
        $username = $this->input->post('username'); // Mendapatkan input username dari form
        $password = $this->input->post('password'); // Mendapatkan input password dari form

        // Debugging statements
        if (empty($username) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Username or Password is empty']);
            return;
        }

        $user = $this->user_model->login($username, $password); // Memanggil fungsi login dari model User_model

        if ($user) {
            $this->session->set_userdata('user_id', $user['id']); // Menyimpan user_id ke session
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
        }
    }
}
?>
