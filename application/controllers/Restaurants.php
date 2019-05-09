<?php
class Restaurants extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('restaurants_model');
        $this->load->helper('array');
        // Retrieve all restaurant at first
        $this->data['restaurant'] = $this->restaurants_model->get_restaurant();
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('restaurants', $this->data);
        $this->load->view('footer');
    }

    public function get_category() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpassword = 'panweibo8635';
        $db = 'INFS3202';
        $conn = new mysqli($dbhost, $dbuser, $dbpassword, $db);
        
        if ($_GET['q'] == '?') {
            $category = "SELECT ?, rname, raddress, rcover, category, suburb FROM restaurant";
        } else {
            $category = "SELECT rid, rname, raddress, rcover, category, suburb FROM restaurant WHERE category = ?";
        }
        
        $stmt = $conn->prepare($category);
        $stmt->bind_param("s", $_GET['q']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($rid, $rname, $raddress, $rcover, $category, $suburb);
        while ($stmt->fetch()) :
            
            $data['rest_info'] = array(
                'rid' => $rid,
                'rname' => $rname,
                'raddress' => $raddress,
                'rcover' => $rcover,
                'rcategory' => $category,
                'suburb' => $suburb
            );

            $this->load->view('showRest', $data);
        endwhile;
        $stmt->close();
    }

    public function get_search() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpassword = 'panweibo8635';
        $db = 'INFS3202';
        $conn = new mysqli($dbhost, $dbuser, $dbpassword, $db);

        $rname = $_GET['rname'];
        
        $like = '%' . strtolower($rname) . '%';
        $sql = "SELECT rid, rname, suburb FROM restaurant WHERE rname LIKE ?";
        
        $statement = $conn->prepare($sql);
        if (
            $statement &&
            $statement -> bind_param('s', $like) &&
            $statement -> execute() &&
            $statement -> store_result() &&
            $statement -> bind_result($rid, $rname, $suburb)
        ) {
            while ($statement -> fetch()) {
                $data['search_info'] = array(
                    'rid' => $rid,
                    'rname' => $rname,
                    'suburb' => $suburb
                );
    
                $this->load->view('showSearch', $data);
            }
            $statement->close();
        }
    }
}
