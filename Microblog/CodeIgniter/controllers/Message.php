<?php 

session_start();
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Message extends CI_Controller {
    function __construct() {//Constructor of Message
         parent::__construct();
         $this->load->helper('url');
    }
    
    
    public function index(){ //loads the view post if the user is logged in or if not redirect to the login page
        if(isset($_SESSION["username"])){
   $this->load->view('Post');
        }
        else{
        redirect('/user/login');
        }
    }
    public function doPost() //post the message and load the users view if logged in, if not it redirects to login
    {
        if(isset($_SESSION["username"])){
            
        $this->load->model('Messages_model');
        $user = $_SESSION["username"];
        $text = $_POST["post"];
        $this->Messages_model->insertMessage($user, $text);
        redirect("/user/view/$user");
            
        }
        else{ 
        redirect('/user/login'); 
        }   
        }   
    }
   