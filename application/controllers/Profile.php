<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('restaurants_model');
        $this->load->model('dishes_model');
        $this->load->model('users_model');
        $this->data['info'] = $this->profile_model->get_info($_SESSION["username"]);
        $this->data['dishes'] = null;
    }

    public function index() {
        $this->data['dishes'] = $this->dishes_model->get_dishes($this->get_rid());
        $this->data['rname'] = $this->get_rname();
        $this->data['rid'] = $this->get_rid();
        $this->load->view('header');
        $this->load->view('profile', $this->data);
        $this->load->view('footer');
    }

    public function update() {
        $username = $this->input->post('username');
        $password = $this->input->post('psw');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        
        $avatar_name = $username.$_FILES["avatar"]["name"];
        $this->users_model->upload_avatar($avatar_name);
        $new_path = base_url()."img/avatar/".basename($avatar_name);
        $this->profile_model->update($username, $password, $email, $phone, $address, $new_path);
        redirect(base_url(). "profile/");
    }

    public function get_rid() {
        $userid = $this->users_model->get_userid($_SESSION["username"]);
        $restaurant = $this->db->query("SELECT * FROM restaurant WHERE managerid = $userid")->row_array();
        return $restaurant["rid"];
    }

    public function get_rname() {
        $userid = $this->users_model->get_userid($_SESSION["username"]);
        $restaurant = $this->db->query("SELECT * FROM restaurant WHERE managerid = $userid")->row_array();
        return $restaurant["rname"];
    }
}
