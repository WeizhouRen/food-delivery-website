<?php
class Users_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function authenticate($username, $password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE username = ?", array($username));
		$row = $query->row_array();

		$hash = $row["password"];

		if (isset($row)) {
			/**
			 * make sure the input psw can be verified by the hashed psw which stored in db
			 * https://www.php.net/manual/en/function.password-verify.php */
			if (password_verify($password, $hash)) {
				echo '<script>alert("Login Successfully");</script>';
				return TRUE;
			} else {
				echo '<script>alert("Your username or password is incorrect!");</script>';
				return FALSE;
			}
		} else {
			echo '<script>alert("You have not sign up!");</script>';
			return FALSE;
		}
	}

	public function unique_name($username)
	{
		$query = $this->db->query("SELECT * FROM user WHERE username = '" . $username . "'");
		$row = $query->row_array();
		if ($row["username"]) { // username existed
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function unique_email($email)
	{
		$query = $this->db->query("SELECT * FROM user WHERE email = '" . $email . "'");
		$row = $query->row_array();
		if ($row['email']) { // email existed
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function upload_avatar($avatar_name)
	{
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/avatar/";
		$target_file = $target_dir . basename($avatar_name);

		if ((($_FILES["avatar"]["type"] == "image/jpg")
			|| ($_FILES["avatar"]["type"] == "image/jpeg")
			|| ($_FILES["avatar"]["type"] == "image/png"))) {
			if ($_FILES["avatar"]["error"] > 0) {
				echo "Error: " . $_FILES["avatar"]["error"] . "<br />";
			} else { // save the file 
				move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
			}
			return true;
		} else {
			echo '<script>alert("You did not upload valid avatar! Please upload .jpg, .png or .jpeg image as avatar.");</script>';
			return false;
		}
	}

	public function update_avatar($avatar_name)
	{
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/avatar/";
		$target_file = $target_dir . basename($avatar_name);

		if ((($_FILES["update-avatar"]["type"] == "image/jpg")
			|| ($_FILES["update-avatar"]["type"] == "image/jpeg")
			|| ($_FILES["avatar"]["type"] == "image/png"))) {
			if ($_FILES["update-avatar"]["error"] > 0) {
				echo "Error: " . $_FILES["update-avatar"]["error"] . "<br />";
			} else { // save the file 
				move_uploaded_file($_FILES["update-avatar"]["tmp_name"], $target_file);
			}
			return true;
		} else {
			echo '<script>alert("Update unsuccessful! Please upload .jpg, .png or .jpeg image as avatar.");</script>';
			return false;
		}
	}

	public function insert_user($username, $password, $email, $phone, $address, $identity, $path)
	{

		$insert_query = "INSERT INTO user (`username`, `password`, `email`, `phone`, `address`, `identity`, `avatar`) 
		VALUES (?,?,?,?,?,?,?)";
		$this->db->query($insert_query, array($username, $password, $email, $phone, $address, $identity, $path));
		$query = $this->db->query("SELECT * FROM user WHERE username = ?", array($username));
		$row = $query->row_array();

		if (isset($row)) {
			return ($username == $row['username']);
		} else {
			return FALSE;
		}
	}

	public function get_address($username)
	{
		$result = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
		return $result["address"];
	}

	public function get_status($username)
	{
		$result = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
		return $result["status"];
	}

	public function get_identity($username)
	{
		$result = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
		return $result["identity"];
	}

	public function get_userid($username)
	{
		$result = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
		return $result["userid"];
	}

	public function get_avatar($username)
	{
		$result = $this->db->query("SELECT * FROM user WHERE `username` = '$username'")->row_array();
		return $result["avatar"];
	}
}
