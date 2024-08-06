<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('Employee_model');
      $this->load->helper('url_helper');
  }

  public function index()
  {
    $data["employees"] = $this->Employee_model->get_all();
    $this->load->view('employee/index', $data);
  }

  public function create()
  {
    if ($this->input->post())
    {
      $data = array(
        'name' => $this->input->post('name'),
        'surname' => $this->input->post('surname'),
        'position' => $this->input->post('position'),
        'salary' => $this->input->post('salary')
      );

      $this->Employee_model->add_employee($data);
      redirect('employee');
    }
    else
    {
      $this->load->view('employee/create');
    }
  }

  public function search()
  {$params = [
    "min_salary" => $this->input->get('min_salary'),
    "max_salary" =>  $this->input->get('max_salary'),
    "name_surname"=>$this->input->get('query'),
    "position" =>$this->input->get('position'),
  ];






      $data['positions'] = $this->Employee_model->get_positions();


      $data['employees'] = $this->Employee_model->search($params);

      $this->load->view('employee/index', $data);
  }



}
