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
    
    /**
     * Get the restaurant which has the highest rate score (average rate)
     */
    public function most_popular() {
        $sql = "SELECT `comments`.rid, AVG(rate) AS `rate`, rname, rcover FROM `comments`, `restaurant` WHERE `comments`.rid = `restaurant`.rid GROUP BY rid ORDER BY rate DESC LIMIT 1;";
        $result = $this->db->query($sql);
        return $result->row_array();
    }
}
