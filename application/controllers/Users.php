<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['status'] = "";
        $this->data['identity'] = "";
        $this->load->model('users_model');
        $this->load->model('restaurants_model');
        
        // $config['image_library'] = 'gd2';
        // $config['quality'] = '60%';
        // $this->load->library('img_lib', $config);
    }

    public function index() {
        $this->load->view('header');
        $this->data['popular'] = $this->restaurants_model->most_popular();
        $this->load->view('home', $this->data);
        $this->load->view('footer');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('psw');
        $remember = $this->input->post('remember');

        if ($remember) {
            setcookie("username", $_POST["username"], time() + 60*60*24, "/");            
        } else {
            delete_cookie('username');
        }

        if ($this->users_model->authenticate($username, $password)) {
            $_SESSION['username'] = $username;
            $identity = $this->users_model->get_identity($username);
            if ($identity == 'staff') {
                $this->data["identity"] = 'staff';
            } else {
                $this->data["identity"] = 'customer';
            }
            $this->index();
        } else {
            $this->index();
            // redirect(base_url() . "home/");
        }
    }

    public function logout() {
        session_destroy();
        // delete_cookie();
        redirect(base_url() . "home/");
    }
    
    public function signup() {
        $username = $this->input->post('username');
        $password = $this->input->post('psw');
        
        $phone = $this->input->post('phone');
        $email = $this->input->post("email");
        $identity = $this->input->post("identity");
        $address = $this->input->post("address");
        $avatar_name = $username.$_FILES["avatar"]["name"]; 

        if(isset($_POST['g-recaptcha-response'])) {
            $captcha=$_POST['g-recaptcha-response'];
        }
        /**
         * Source of the tutorial of verify recaptcha
         * https://codeforgeek.com/google-recaptcha-tutorial/
         */
        $secretKey = "6Lc44aMUAAAAAOXscOTpy2zFYTHJNil6MOGoKim_";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
            /**
             * source of tutorial hashing the password
             * https://www.php.net/manual/en/function.password-hash.php
             */
            $password = password_hash($password, PASSWORD_DEFAULT);
            if ($this->users_model->unique_name($username) 
                && $this->users_model->unique_email($email)) {

                if ($this->users_model->upload_avatar($avatar_name)) {
                    $path = base_url().'img/avatar/'.$avatar_name;
                } else {
                    $path = base_url().'img/avatar.jpg';
                }

                
                if($this->users_model->insert_user($username, $password, 
                    $email, $phone, $address, $identity, $path)) {
                        $_SESSION["username"] = $username;
                        $this->index();
                }
            } else {
                redirect(base_url() . "home/");
            }
        } else {
            echo '<script>alert("Are you a robot?");</script>';
            $this->index();
        }
    }

    public function jQuery_Ajax_username() {
        if (!empty($_POST["username"]) && $this->users_model->unique_name($_POST["username"])) {
            echo "<div class='status-available'> Username Available.</div>";
        } else {
            echo "<div class='status-not-available'> Username Not Available.</div>";
        }
    }

    public function jQuery_Ajax_email() {
        if (!empty($_POST["email"]) && $this->users_model->unique_email($_POST["email"])) {
            echo "<div class='status-available'> Email Available.</div>";
        } else {
            echo "<div class='status-not-available'> Email Not Available.</div>";
        }
    }

    public function send_email() {
        $config = array (
          'protocol' => 'smtp',
          'smtp_host' => 'mailhub.eait.uq.edu.au',
          'smtp_port' => 25,
          'smtp_crypto' => 'tls',
          'mailtype' => 'html',
          'validate' => FALSE,
          'charset' => 'utf-8',
          'wordwrap' => TRUE,
          'newline' => '\r\n'  
        );
        $this->load->library("email", $config);
        $this->email->from('weizhou.ren@uqconnect.edu.au', 'Lets EAT');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }
}
