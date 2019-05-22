<?php
class Order_model extends CI_Model {

	public function __construct() {
		$this->load->database();
    }

    /**
     * Fetch dishes info by did in order table
     * Save dishes info into a new array
     */
    public function get_dishes_in_order($ordernumber) {
        $dishes_in_order = $this->db->query("SELECT * FROM orders WHERE ordernumber = $ordernumber")->result_array();
        $ordered_dishes = array();
        foreach ($dishes_in_order as $d) :
            $did = $d["did"];
            $dish = $this->db->query("SELECT * FROM dishes WHERE did = $did")->row_array();
            array_push($ordered_dishes, $dish); 
        endforeach;
        return $ordered_dishes;
    }

    /**
     * Get info of all dishes that in the cart including the price and its id
     * Fetch the quantity of ordered 
     */
    public function total_in_order($ordernumber) {
        $total = 0.0;
        $ordered_dishes = $this->get_dishes_in_order($ordernumber);
        foreach ($ordered_dishes as $dish) :
            $price = $dish["price"];
            $did = $dish["did"];
            $qty = $this->db->query("SELECT * FROM orders WHERE did = $did AND ordernumber = $ordernumber")->row_array()["qty"];
            print_r($price);
            print_r($qty);
            $total = $total + $price * $qty;
        endforeach;
        echo '<script>alert('.$total.');</script>';
        return $total;
    }
}

?>