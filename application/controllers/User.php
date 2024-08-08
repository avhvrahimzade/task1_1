<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('employee/index');
        }
        $this->load->view('user/login');
    }

    public function register() {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        $data['register'] = $this->session->userdata('role') === 'admin';
        $this->load->view('user/register', $data);
    }

    public function login_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata(array(
                'logged_in' => TRUE,
                'username' => $user->username,
                'mail' => $user->mail,
                'role' => $user->role
            ));
            redirect('employee/index');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('user/login');
        }
    }

    public function register_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $mail = $this->input->post('mail');
        $role = $this->input->post('role') ?: 'user';

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email format'
            ]);
            return;
        }

        $result = $this->User_model->register($username, $password, $mail, $role);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Registration successful'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username or Email already exists or fields are empty'
            ]);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('user/login');
    }
}
