<!doctype html>
<html>
<head><title>task4</title></head>
    
<body>
    
<!-- Creates the PDO handle.
If the PDO constructor fails, it throws an exception which is handled here.
Given the script can’t continue if the database connection failed, we use die() to terminate the script with an error message. -->

    <?php
  try {
    $dbhandle = new PDO("mysql:host=dragon.kent.ac.uk;dbname=co323", "co323", "pa33word");
  } catch (PDOException $e) { die("Connection error: " . $e->getMessage()); }
/* the sql query.*/
  $sql ="SELECT   name, weighting
FROM     Assessment a JOIN Course c ON a.cid = c.cid 
WHERE    title = 'Web technologies'
ORDER BY name";
  $query = $dbhandle->prepare($sql);
  if ($query->execute() == FALSE)
    { die("Query error: " . implode($query->errorInfo(), ' ')); }
?>

<!-- creates an ordered list of the name, weighting of each Assessment -->  
<ol>
  <?php while ($row = $query->fetch()) { ?>
      <li><?php echo $row['name'] ?>: <?php echo $row['weighting'] ?></li>  
  <?php } ?>
</ol>
    
</body>
</html>
