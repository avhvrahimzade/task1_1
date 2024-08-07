<?php
class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $query = $this->db->query("SELECT * FROM employee");
        return $query->result_array();
    }

    public function add_employee() {

      $data = [
      'name' => $this->input->post('name'),
      'surname' => $this->input->post('surname'),
      'position' => $this->input->post('position'),
      'salary' => $this->input->post('salary')
              ];

        return $this->db->insert('employee', $data);
    }

    public function search($params) {

        if (!empty($params['min_salary']) && is_numeric($params['min_salary'])) {
            $this->db->where('salary >=', $params['min_salary']);
        }
        if (!empty($params['max_salary']) && is_numeric($params['max_salary'])) {
            $this->db->where('salary <=', $params['max_salary']);
        }
        if (!empty($params['name_surname'])) {
            $this->db->group_start();
            $this->db->like('name', $params['name_surname']);
            $this->db->or_like('surname', $params['name_surname']);
            $this->db->group_end();
        }
        if (!empty($params['position'])) {
            $this->db->where('position', $params['position']);
        }

        $query = $this->db->get('employee');
        return $query->result_array();
    }

    public function get_positions() {
        $query = $this->db->query("SELECT DISTINCT position FROM employee");
        return $query->result_array();
    }

    public function autocomplete($query) {
        $this->db->select('CONCAT(name, " ", surname) as full_name');
        $this->db->like('name', $query);
        $this->db->or_like('surname', $query);
        $query = $this->db->get('employee');

        $result = array();
        foreach ($query->result() as $row) {
            $result[] = $row->full_name;
        }
        return $result;
    }
}
