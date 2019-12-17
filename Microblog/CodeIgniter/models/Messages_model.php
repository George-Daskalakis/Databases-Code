<?php 
class Messages_model extends CI_Model {
    public function __construct(){
    $this->load->database();
}

  public function getMessagesByPoster($name){//Gets all the messages by the user from the database
      $sql = 'Select user_username, text, posted_at from Messages where user_username = ? order by posted_at DESC';
 $query = $this->db->query($sql, array($name));
      return $query->result_array();
  }
    public function searchMessages($string){ //Gets all the messages from all the users that contains the string
        $string = '%'.$string.'%';
    $sql='Select user_username, text, posted_at from Messages where text LIKE ? order by posted_at DESC';
    $query = $this->db->query($sql, array($string));
    return $query->result_array();
    }
    
    public function insertMessage($poster, $string){ //Inserts a new message to the database
        $sql = 'INSERT INTO Messages(user_username, text, posted_at, id) VALUES (?, ?, NOW(), null)';
        $query = $this->db->query($sql, array($poster, $string));
    }
    
    public function getFollowedMessages($name){ //gets all the messages of the people the user follows
        $sql = 'select user_username, text, posted_at from Messages JOIN User_Follows on Messages.user_username = User_Follows.followed_username where follower_username = ? order by posted_at DESC';
        $query = $this->db->query($sql, array($name));
        return $query->result_array();
        
    }
    }
    
   