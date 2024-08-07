<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($username, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $data = array(
            'username' => $username,
            'password' => $hashed_password,
            'role' => $role
        );

        return $this->db->insert('users', $data);
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
        return FALSE;
    }

    public function get_user_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row();
    }
}
