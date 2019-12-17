<!doctype html>
<html>
<head><title>task6</title></head>
    
<body>
    
<!-- Creates the PDO handle.
If the PDO constructor fails, it throws an exception which is handled here.
Given the script can’t continue if the database connection failed, we use die() to terminate the script with an error message. -->
    
    <?php
  try {
    $dbhandle = new PDO("mysql:host=dragon.kent.ac.uk;dbname=co323", "co323", "pa33word");
  } catch (PDOException $e) { die("Connection error: " . $e->getMessage()); }
/* the sql query.*/
  $sql = "select * from Student";
  $query = $dbhandle->prepare($sql);
 
  if ($query->execute() == FALSE)
    { die("Query error: " . implode($query->errorInfo(), ' ')); }
?>
    
<!-- creates a form which has a drop-down list containing the sid, full-name, gender of every student -->    
<form action="task7.php" method = "GET">
<select name="sid">
<?php 
while ($row = $query->fetch()){
echo "<option value=".$row["sid"].">".$row['sid'] .": ".$row['forename'] ." ". $row['surname']." ".$row['gender']."". "</option>";
}  
?> 
    
 <!-- creates a submit button -->       
<input type="submit" value="Submit">
</select>
</form> 
    
</body>
</html>