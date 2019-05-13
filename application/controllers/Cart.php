<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->model('users_model');
        $this->load->model('dishes_model');
        $this->data["dishes"] = null;
        $this->data['total'] = 0;
        $this->data['user'] = null;
        $this->data['hasConfirmed'] = false;
        $this->data['ordernumber'] = 0;
        $this->data['orderphone'] = 0;
        $this->data['orderaddress'] = null;
        $this->data['orderinfo'] = null;
    }

    public function index() {
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $user = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
            $this->data['dishes'] = $this->cart_model->get_dishes_in_cart($_SESSION["username"]);
            $this->data['total'] = $this->total();
            $this->data['user'] = $user;
        }
        $this->load->view('header');
            
        $this->load->view('cart', $this->data);
        
        $this->load->view('footer');
    }

    public function add() {
        $did = $_GET["did"];
        $this->cart_model->add_dishes($did, $_SESSION["username"]);
        $this->index();
    }

    public function remove() {
        if ($this->input->post('qty') !== null && $this->input->post('did') != null) {
            $qty = $this->input->post('qty');
            $did = $this->input->post('did');
            $this->cart_model->remove_dishes($qty, $did, $_SESSION["username"]);
        }

        $this->index();
    }

    public function total() {
        $total = 0.0;
        $dishes = $this->cart_model->get_dishes_in_cart($_SESSION["username"]);
        foreach ($dishes as $dish) :
            $cid = $this->cart_model->get_cid($this->users_model->get_userid($_SESSION["username"]), $dish["did"]);
            $qty = $this->db->query("SELECT qty FROM cart WHERE cid = $cid");
            $total = $total + $dish["price"] * (int)$qty->result();
        endforeach;
        return $total;
    }

    public function qty($userid, $did) {
        $cid = $this->cart_model->get_cid($userid, $did);
        $qty = $this->db->query("SELECT qty FROM cart WHERE cid = $cid;")->result();
        return $qty;
    }

    public function checkout () {
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        // get userid from username
        $username = $_SESSION["username"];
        $userid = $this->users_model->get_userid($username);
        // get dishes id from cart table 
        $dishes = $this->cart_model->get_dishes_in_cart($username);
        $order_number = mt_rand();
        foreach ($dishes as $dish) :
            $did = $dish["did"];
            $sql = "INSERT INTO `orders`(`userid`, `did`, `phone`, `address`, `ordernumber`) 
        VALUES ($userid, $did, $phone, '$address', $order_number);";
            $this->db->query($sql);
        endforeach;
        $this->data['hasConfirmed'] = true;
        $this->data['ordernumber'] = $order_number;
        $this->data['orderphone'] = $this->get_order_info($order_number)[0]["phone"];
        $this->data['orderaddress'] = $this->get_order_info($order_number)[0]["address"];
        $this->data['ordered_dishes'] = $this->get_ordered_dishes_info();
        $this->index();
    }

    public function get_order_info($order_number) {
        // $order_number = $this->data['ordernumber'];
        $order_info = $this->db->query("SELECT * FROM orders WHERE ordernumber = $order_number")->result_array();
        return $order_info;
    }

    public function get_ordered_dishes_info() {
        $order_info = $this->get_order_info($this->data['ordernumber']);
        $dishes = [];
        foreach ($order_info as $row) :
            $did = $row["did"];
            $row = $this->dishes_model->get_dish_info($did);
            $dishes[] = $row;
        endforeach;
        return $dishes;
    }

    /**
    * Get Download PDF File
    *
    * @return Response */
    public function pdf() {
        $this->load->helper('pdf_helper');
        $this->data['ordernumber'] = $_GET['ordernumber'];
        $this->data['orderphone'] = $this->get_order_info($this->data['ordernumber'])[0]["phone"];
        $this->data['orderaddress'] = $this->get_order_info($this->data['ordernumber'])[0]["address"];
        $this->data['ordered_dishes'] = $this->get_ordered_dishes_info();
        
        $this->load->view('pdf', $this->data);
    }
}
