<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    function index() {
        $this->checksession();
    }

    function checksession() {
        $check = $this->session->userdata('logged_in');
        if (empty($check)) {
            $this->load->view('admin/login/viewlogin');
        } else {
            $this->template->load('backend', 'admin/login/welcome');
        }
    }

    function logout() {
        if (isset($_POST['submit'])) {
            $this->session->sess_destroy();
            $this->load->view('admin/login/viewlogin');
        } else {
            $this->checksession();
        }
    }

    function post() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messageusername' => form_error('username'),
                'messagepassword' => form_error('password')
            );
            echo json_encode($data);
        } else {
            $this->LoginModel->post();
        }
    }

}
