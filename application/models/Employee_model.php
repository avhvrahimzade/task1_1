<?php
class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
      $query = $this->db->get("employee");
      return $query->result_array();
    }

    public function add_employee($data)
  {
      return $this->db->insert('employee', $data);
  }

  public function search($params)
  {
      if ($params['min_salary'] !== '' && $params['max_salary'] !== '') {
          $this->db->where('salary >=', $params['min_salary']);
          $this->db->where('salary <=', $params['max_salary']);
      } elseif ($params['min_salary'] !== '') {
          $this->db->where('salary >=', $params['min_salary']);
      } elseif ($params['max_salary'] !== '') {
          $this->db->where('salary <=', $params['max_salary']);
      }

      if ($params['name_surname'] !== '') {
          $this->db->group_start();
          $this->db->like('name', $params['name_surname']);
          $this->db->or_like('surname', $params['name_surname']);
          $this->db->group_end();
      }

      if ($params['position'] !== '') {
          $this->db->where('position', $params['position']);
      }

      $query = $this->db->get('employee');
      return $query->result_array();
  }



   public function get_positions()
 {
     $this->db->distinct();
     $this->db->select('position');
     $query = $this->db->get('employee');
     return $query->result_array();
 }
  }
