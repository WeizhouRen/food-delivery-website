<?php
class Cart_model extends CI_Model {

	public function __construct() {
		$this->load->database();
    }

    public function get_dishes_in_cart($username) {
        $query = ("SELECT * FROM dishes WHERE did IN (SELECT did FROM cart WHERE cart.userid IN (SELECT userid FROM `user` WHERE `user`.username = '$username'))");
        $dishes = $this->db->query($query);
        return $dishes->result_array();
    }

    private function get_userid($username) {
        $user = $this->db->query("SELECT * FROM user WHERE username = '$username'");
        $result = $user->row_array();
        $userid = $result["userid"];
        return $userid;
    }

    public function get_rid($did) {
        $dishes = $this->db->query("SELECT * FROM dishes WHERE did = $did");
        $dishes_result = mysqli_fetch_array($dishes);
        $rid = $dishes_result[2]; 
        return $rid;
    }

    public function get_cid($userid, $did) {
        $query = "SELECT * FROM cart WHERE did = $did AND userid = $userid";
        $cart = $this->db->query($query);
        $result = $cart->row_array();
        $cid = $result["cid"];
        return $cid;
    }

    public function add_dishes($did, $username) {
        $userid = $this->get_userid($username);
        // check unique
        $cart_record = $this->db->query("SELECT did FROM cart WHERE userid = $userid"); // select all dishes that has been add by current user
        
        $dish_unique = TRUE;
        foreach ($cart_record->result_array() as $row) {
            if ($row["did"] == $did) {// the user has added this dish
                $dish_unique = FALSE;
            }
        }

        if ($dish_unique) {
            // insert new dishes to cart
            $add_dishes = "INSERT INTO `cart`(`userid`, `did`, `qty`) VALUES ($userid, $did, 1)";
            $this->db->query($add_dishes);
        } else {
            $dish = $this->db->query("SELECT qty FROM cart WHERE `did` = $did and `userid` = $userid");
            $result = $dish->row_array();
            $qty = $result["qty"];
            $this->db->query("UPDATE cart SET `qty` = $qty + 1 WHERE `did` = $did and `userid` = $userid");
        }
    }
    public function remove_dishes($qty, $did, $username) {
        $userid = $this->get_userid($username);
        $dishes = $this->cart_model->get_dishes_in_cart($_SESSION["username"]);
        foreach ($dishes as $row) {
            $this->db->query("DELETE FROM `cart` WHERE `did` = $did AND `userid` = $userid");
        }
    }

    public function get_qty($cid) {
        $result = $this->db->query("SELECT * FROM cart WHERE `cid` = $cid;")->row_array();
        $qty = $result["qty"];
        return $qty;
    }
}

?>