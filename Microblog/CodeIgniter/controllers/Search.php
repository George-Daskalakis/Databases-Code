<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Search extends CI_Controller {
    function __construct() {//constructor for the controller
         parent::__construct();
         $this->load->helper('url');
    }
    
  
   public function index(){ //loads the search view
       $this->load->view('Search');
   }
    public function dosearch(){ //gets all the messages that contain the string and then it posts them in the view
        $var = true;
        $this->load->model('Messages_model');
        $string = $_GET['word'];
        $data['string'] = $string;
        $data = $this->Messages_model->searchMessages($string);
        $viewData = array("results" => $data, "var" => $var, "name" => $_SESSION['username']);
        $this->load->view('ViewMessages', $viewData);
    }
   
   }