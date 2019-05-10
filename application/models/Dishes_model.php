<?php
class Dishes_model extends CI_Model {

	public function __construct() {
		$this->load->database();
    }
    
    public function get_info($rid) {
        $query = $this->db->query("SELECT * FROM restaurant WHERE rid = '" . $rid . "'");
        $row = $query->row_array();
        if (isset($row)) {
            return $row;
        } else return null;
    }

    public function get_dishes($rid) {
        $query = "SELECT * FROM dishes WHERE rid= '$rid'";
        $dishes = $this->db->query($query);
        return $dishes->result_array();
    }

    public function add_dishes($name, $rid, $price, $path, $description) {
        $query = "INSERT INTO `dishes`(`name`, `rid`, `price`, `photo`, `description`) 
        VALUES ('$name', $rid, $price, '$path', '$description')";
        $this->db->query($query);
    }

    public function get_dish_info($did) {
        $query = "SELECT * FROM dishes WHERE did= '$did'";
        $dishes = $this->db->query($query);
        return $dishes->row_array();
    }
}