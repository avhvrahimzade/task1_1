<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $data["employees"] = $this->Employee_model->get_all();
        $data["positions"] = $this->Employee_model->get_positions();
        $this->load->view('employee/index', $data);
    }

    public function create() {
        if ($this->input->is_ajax_request()) {

            $this->Employee_model->add_employee();
            echo json_encode(['success' => true]);
        } else {
            $this->load->view('employee/create');
        }
    }

    public function search() {
        $params = [
            "min_salary" => $this->input->get('min_salary'),
            "max_salary" =>  $this->input->get('max_salary'),
            "name_surname" => $this->input->get('query'),
            "position" => $this->input->get('position'),
        ];
        $employees = $this->Employee_model->search($params);

        echo json_encode(['employees' => $employees]);
    }

    public function autocomplete() {
        $query = $this->input->get('query');
        $results = $this->Employee_model->autocomplete($query);
        echo json_encode($results);
    }
}
