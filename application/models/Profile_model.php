<?php
class Profile_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
    
    public function get_info($username) {
        $query = $this->db->query("SELECT * FROM user WHERE username = ?", array($username));
        $row = $query->row_array();
        if (isset($row)) {
            return $row;
        } else return null;
    }
    
    public function update($username, $password, $email, $phone, $address, $path) {
        $query = "UPDATE `user` SET `password`= ?,`email`= ?,
        `phone`= ?,`address`= ?, `avatar`= ? WHERE `username` = ?";
        $this->db->query($query, array($password, $email, $phone, $address, $path, $username));
    }

}