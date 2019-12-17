<!doctype html>
<html>
<head><title>task5</title></head>
    
<body>
    
<!-- Creates the PDO handle.
If the PDO constructor fails, it throws an exception which is handled here.
Given the script can’t continue if the database connection failed, we use die() to terminate the script with an error message. --> 
    
    <?php
  try {
    $dbhandle = new PDO("mysql:host=dragon.kent.ac.uk;dbname=co323", "co323", "pa33word");
  } catch (PDOException $e) { die("Connection error: " . $e->getMessage()); }
/* the sql query.*/
  $sql ="SELECT cid, name, AVG(mark) AS avg_mark
FROM Grade g JOIN Assessment a ON g.aid = a.aid      
GROUP BY cid, name
ORDER BY cid, name";
  $query = $dbhandle->prepare($sql);
 
  if ($query->execute() == FALSE)
    { die("Query error: " . implode($query->errorInfo(), ' ')); }
?>

<!-- creates a table with the cid, name and avg_mark of each Assessment -->    
<table>
  <tr> <th>CID</th><th>NAME</th><th>AVERAGE MARK</th> </tr>
  <?php while ($row = $query->fetch()) { ?>
    <tr>
      <td><?php echo $row['cid']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['avg_mark']; ?></td>
    </tr>
  <?php } ?>
</table>
    
</body>
</html>