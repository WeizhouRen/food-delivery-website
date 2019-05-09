<?php
class Restaurants_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_restaurant($rid = null) {
        if ($rid === null) { // fetch all restaurants
            
            $query = $this->db->get('restaurant');
            return $query->result_array();
            
        } else {
            $result = $this->db->query("SELECT * FROM restaurants WHERE `rid` = $rid");

            return $result->row_array(); 
        }
    }

    public function get_comment($rid) {
        $comment = $this->db->query("SELECT * FROM comments WHERE rid = '$rid'")->result_array();
        return $comment;
    }
}
