<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($username, $password, $mail, $role) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if ($this->is_username_exists($username) || $this->is_email_exists($mail)) {
            return false;
        }
        if (empty($username) || empty($password) || empty($mail)) {
            return false;
        }

        $data = [
            'username' => $username,
            'password' => $hashed_password,
            'mail' => $mail,
            'role' => $role
        ];

        return $this->db->insert('users', $data);
    }

    public function is_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function is_email_exists($mail) {
        $this->db->where('mail', $mail);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
}
