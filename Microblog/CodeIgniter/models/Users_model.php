<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Users_model extends CI_Model {
    public function __construct(){ //constructor for model
    $this->load->database();}
    
 public function checkLogin($username, $pass){ //checks if the login details are correct
     $pass = sha1($pass);
     $sql = 'select username, password from Users WHERE username = ? and password = ?';
     $query = $this->db->query($sql, array($username, $pass));
     if ($query->num_rows() >= 1){return true;} //returns true if there is a row returned, so if the login details are correct
     else {return false;}
    }
    
    public function isFollowing($follower, $followed){ //checks if the user follows the other person 
     $sql = 'select follower_username, followed_username from User_Follows where follower_username= ? and followed_username= ?';
        $query = $this->db->query($sql, array($follower, $followed));
        if ($query->num_rows()>= 1){return true;} //returns true if there is a row returned, so if the user followes the other person
        else {return false;}
    }
    public function follow($followed) //follows the person
    {
     $sql = 'INSERT INTO User_Follows(follower_username, followed_username) VALUES (?, ?)';
        $query = $this->db->query($sql, array($_SESSION["username"], $followed));
    }
}
        