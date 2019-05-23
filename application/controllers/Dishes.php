<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dishes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('dishes_model');
        $this->load->model('users_model');
        $this->load->model('cart_model');
        $this->load->model('restaurants_model');
        $this->load->helper('form');
    }

    public function index() {
        // $rid = $_GET["rid"];
        $data['rid'] = $_GET["rid"];
        $data['dishes'] = $this->dishes_model->get_dishes($data['rid']);
        $data['info'] = $this->dishes_model->get_info($data['rid']);

        $data['comment'] = $this->restaurants_model->get_comment($data['rid']);
        $this->load->view('header');
        $this->load->view('dishes', $data);
        $this->load->view('footer');
    }

    public function add_comment() {
        $username = $_SESSION["username"];
        $userid = $this->users_model->get_userid($username);
        $text = $_POST["comment"];
        $rate = $_POST["rating"];
        $rid = $_POST["rid"];
        // $date = $this->db->query("SELECT CURRENT_TIMESTAMP() as `dtime`;")->row()->dtime;
        $date = date("Y-m-d", time());
        print_r($date);
        $sql = "INSERT INTO `comments`(`username`, `userid`, `text`, `rate`,`date`,`rid`) 
        VALUES ('$username', $userid, '$text', $rate, '$date', $rid)";
        $this->db->query($sql);
        redirect(base_url(). "dishes/index?rid=".$rid);
    }

    /**
     * Add dishes in your restaurant
     * if the identity is staff
     */
    public function add() {
        $name = $_POST["dish-name"];
        $price = $_POST["dish-price"];
        $desc = $_POST["dish-desc"];
        $rid = $_POST["rid"];
        $rname = $_POST["rname"];

        $rname = preg_replace('/[^\p{L}\p{N}\s]/u', '', $rname);
        $dish_name = $rname.$_FILES["photo"]["name"];
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/img/dishes/";
		$target_file = $target_dir . basename($dish_name);

        $path = base_url().'img/dishes/'.$dish_name;
        

        if ((($_FILES["photo"]["type"] == "image/jpg")
                || ($_FILES["photo"]["type"] == "image/jpeg")
                || ($_FILES["photo"]["type"] == "image/png"))) {
            if ($_FILES["photo"]["error"] > 0) {
                echo "Error: " . $_FILES["photo"]["error"] . "<br />";
            } else { // save the file 
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
            }
        } else {
            echo "Invalid file";
        }

        $this->dishes_model->add_dishes($name, $rid, $price, $path, $desc);
        redirect(base_url(). "profile/");
    }

    /**
     * Update dishes in your restaurant
     * if the identity is staff
     */
    public function update() {
        $did = $this->input->post('dish-id');
        $name = $this->input->post('dish-name');
        $price = (int)substr($this->input->post('dish-price'), 1);
        $desc = $this->input->post('dish-desc');
        $sql = "UPDATE dishes SET `name` = '$name', price = $price, `description` = '$desc' WHERE did = $did;";
        $this->db->query($sql);
        redirect(base_url(). "profile/");
    }

    /**
     * Delete dishes in your restaurant
     * if the identity is staff
     */
    public function delete() {
        $did = $_GET["did"];
        $sql = "DELETE FROM dishes WHERE did = $did;";
        $this->db->query($sql);
        redirect(base_url(). "profile/");
    }
}
