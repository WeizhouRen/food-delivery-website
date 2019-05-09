<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('dishes_model');
        $this->data['popular'] = null;
    }

    public function index() {
        $this->data['popular'] = $this->dishes_model->most_popular();
        $this->load->database();
        $this->load->view('header');
        $this->load->view('home', $this->data);
        $this->load->view('footer');
    }
}