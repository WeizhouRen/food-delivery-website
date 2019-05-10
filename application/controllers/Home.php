<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('restaurants_model');
        $this->data['popular'] = $this->restaurants_model->most_popular();
    }

    public function index() {
        $this->load->database();
        $this->load->view('header');
        $this->load->view('home', $this->data);
        $this->load->view('footer');
    }
}