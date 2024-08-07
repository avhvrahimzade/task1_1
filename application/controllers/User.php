<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function login() {
        $this->load->view('user/login');
    }

    public function register() {
        $this->load->view('user/register');
    }

    public function login_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata(array(
                'logged_in' => TRUE,
                'username' => $user->username,
                'role' => $user->role
            ));

            if ($user->role === 'admin') {
                redirect('employee/index');
            } else {
                redirect('welcome');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('user/login');
        }
    }

    public function register_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role'); // Changed to 'role' for consistency

        if ($this->User_model->register($username, $password, $role)) {
            $this->session->set_flashdata('success', 'Registration successful');
            redirect('user/login');
        } else {
            $this->session->set_flashdata('error', 'Registration failed');
            redirect('user/register');
        }
    }
}
