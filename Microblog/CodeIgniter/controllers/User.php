<?php 
session_start(); //starts a session
defined('BASEPATH') OR exit('No direct script access allowed'); 

class User extends CI_Controller {
    //constructor for this controller
    function __construct() {
         parent::__construct();
         $this->load->helper('url');
    }
    
   public function view($name = null){
       $this->load->model('Messages_model'); //loads the model
       if($name == null){
       $data = $this->Messages_model->getMessagesByPoster(); //checks if name is null and if it is, it calls the method with no parameter
       }
       else {
           $data = $this->Messages_model->getMessagesByPoster($name); //call to the method with parameter
       }
        if(count($data) == 0) { echo "No rows found"; return; } // checks if the query returned any rows
        $var = true; 
       if(isset($_SESSION["username"]) && $_SESSION["username"] != $name ){ //checks if the session username is set and checks if the logged in user is the same as the viewed user
           $this->load->model('Users_model'); //loads the model

            $var = $this->Users_model->isFollowing($_SESSION["username"], $name); //assigns to the variable true or false depending on whether the logged in user follows the viewed user
           } 
        $viewData = array("results" => $data, "var"=>$var, "name"=>$name ); //Creates an array 
        $this->load->view('ViewMessages', $viewData); //passes the values in the array to the view
        }
       

    
    public function login(){
        $this->load->view('Login'); //loads the login view
    }
    
    public function doLogin(){
        $this->load->model('Users_model'); //loads the model
        $user = $_POST["username"]; //gets the username from get parameters
        $pass = $_POST["password"]; //gets the password from get parameters
        $data = $this->Users_model->checkLogin($user, $pass); //checks if the login details are correct and stores true or false to the variable
        if ($data == true) {  
        $_SESSION["username"] = $user; //if login details are correct then make a session variable that stores the logged in name
        $this->view($user); //calls view user function passing the logged in user
        }
        else {
            $this->login(); //calls the login function
        }
    }
    public function logout(){
        session_unset(); //unsets the variable of the session
        $this->login(); //calls login function
    }
    
    public function follow($followed){ 
        $this->load->model('Users_model'); //loads model
        $this->Users_model->follow($followed); //follows the person
        redirect("/user/view/$followed"); //redirects to the followed persons messages
    }
    public function feed($name){
        $var = true; 
        $this->load->model('Messages_model'); //loads the model
        $data = $this->Messages_model->getFollowedMessages($name); //gets the messages of all the people this user is following
        $viewData = array("results" => $data, "var"=>$var, "name"=>$name); //creates an array with the values
       $this->load->view('ViewMessages', $viewData); //passes the array values to the view
    }
   }
   