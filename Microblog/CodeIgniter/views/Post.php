<!DOCTYPE html>
<html>
<body>
<style> 
        body{
            border: 1px solid black;
            width: 60%;
            margin: auto;
            padding-bottom: 5px;
            padding-left:5px;  
            padding-right:10px;
             padding-top:0px;
            text-align: center;
            font-size:20px
        }
        #container1{
         border: 1px solid black;   
            text-align: center;
            margin: auto;
            margin-top:20px;
            width: 30%;
            border: 1px solid black;
            padding: 10px;
        }
        h1
        {
            display: inline;
            font-size:70px;
            height:50px;}
        #Logout, #Search, #My, #Post, #Followed{
            text-align: right;
            
        }
    </style>
 <header>          
<h1><u>messager</u></h1>
</header>
    <?php 
    if(isset($_SESSION["username"])){
    echo "<div id='Logout'>";
    echo "<a href='".base_url()."index.php/user/logout'><p1>Logout</p1></a>"; //creates a link that lets the user logout
    echo "</div>";
   

    echo "<div id='Search'>";
    echo "<a href='".base_url()."index.php/search'><p2>Search</p2></a>"; //creates a link that lets the user search
    echo "</div>";
        

     echo "<div id='My'>";
    echo "<a href='".base_url()."index.php/user/view/".$_SESSION["username"]."'><p3>My Messages</p3></a>"; //creates a link that lets the user see his messages
    echo "</div>";

 
     echo "<div id='Post'>";
    echo "<a href='".base_url()."index.php/message'><p4>Post a Message</p4></a>"; //creates a link that lets the user post
    echo "</div>";
        
    echo "<div id='Followed'>";
    echo "<a href='".base_url()."index.php/user/feed/".$_SESSION["username"]."'><p5>Followed Messages</p5></a>"; //creates a link that lets the user see the messages of the people he follows
    echo "</div>";
    }
     ?>
    
<div id="container1">     
<h2>Post Something</h2>

<form action="message/doPost" method="POST">
  <input type="text" name="post">
  <input type="submit" value="Post">
</form> 
    </div>


</body>
</html>
