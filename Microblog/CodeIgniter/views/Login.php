<!DOCTYPE html>
<html>
<body>
    <style>
        body{
            border: 1px solid black;
            width: 30%;
            margin: auto;
            padding-bottom: 5px;
            padding-left:5px;  
            padding-right:5px;
             padding-top:0px;
            text-align: center;
            font-size:20px
        }
        #Container{
            text-align: center;
            margin: auto;
            margin-top:20px;
            width:  50%;
            border: 1px solid black;
            padding: 10px;
        }
    input[type=submit]
        {    padding: 1px 1px;
             width: 20%;}
    h1
        {
            font-size:90px;
            height:50px;}
        
    input [type=text][type=password]
        {   width: 20%;
            padding: 5px 5px;
            margin: 5px 0;}
    </style>
<header>
<h1 align ="center">messager</h1>
    <div id="Login">
    
    </div>
</header>
    <div id="Container">
        <form action="dologin" method="POST">
  Username: <input type="text" id="fname" name="username"><br>
  Password: <input type="password" id="lname" name="password"><br>
  <input type="submit" value="Login">
</form> 
    </div>
    
    



</body>
</html>
