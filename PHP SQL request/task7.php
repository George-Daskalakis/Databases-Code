<!doctype html>
<html>
<head><title>task6</title></head>
<style>
table, th, td {
  border: 1px solid black;
    border-collapse: collapse;
}
</style>
<body>
    
<!-- Creates the PDO handle.
If the PDO constructor fails, it throws an exception which is handled here.
Given the script can’t continue if the database connection failed, we use die() to terminate the script with an error message. -->
    
    <?php
  try {
    $dbhandle = new PDO("mysql:host=dragon.kent.ac.uk;dbname=co323", "co323", "pa33word");
  } catch (PDOException $e) { die("Connection error: " . $e->getMessage()); }
/* the sql query.*/
  $sql = "SELECT c.cid, title, name, weighting, mark FROM   Grade g JOIN Assessment a ON g.aid = a.aid JOIN Course c on a.cid = c.cid WHERE  sid =:sid";
  $query = $dbhandle->prepare($sql);
  $query->bindParam(':sid', $_GET["sid"]);
    
  if ($query->execute() == FALSE)
    { die("Query error: " . implode($query->errorInfo(), ' ')); }
?>
    
<!-- creates a table containing the cid, title, name, weighting, mark of the chosen student -->
<table>
  <tr> <th>CID</th><th>TITLE</th><th>NAME</th><th>WEIGHTING</th><th>MARK</th> </tr>
  <?php while ($row = $query->fetch()) { ?>
    <tr>
      <td><?php echo $row['cid']; ?></td>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['weighting']; ?></td>
      <td><?php echo $row['mark']; ?></td>
    </tr>
  <?php } ?>
    
    <!-- Creates the PDO handle.
If the PDO constructor fails, it throws an exception which is handled here.
Given the script can’t continue if the database connection failed, we use die() to terminate the script with an error message. -->
    
    <?php
  try {
    $dbhandle = new PDO("mysql:host=dragon.kent.ac.uk;dbname=co323", "co323", "pa33word");
  } catch (PDOException $e) { die("Connection error: " . $e->getMessage()); }
    
  /* the sql query.*/  
  $sql = "SELECT cid, SUM(mark*weighting)/100 AS Final FROM Grade g JOIN Assessment a ON g.aid = a.aid WHERE  sid = :sid GROUP BY cid";
  $query = $dbhandle->prepare($sql);
  $query->bindParam(':sid', $_GET["sid"]); 
  if ($query->execute() == FALSE)
    { die("Query error: " . implode($query->errorInfo(), ' ')); }
?>
    
    <!-- creates a table containing the cid,final grade of the chosen student fro all his assessments -->  
    <table>
  <tr> <th>CID</th><th>FINAL</th></tr>
  <?php while ($row = $query->fetch()) { ?>
    <tr>
      <td><?php echo $row['cid']; ?></td>
      <td><?php echo $row['Final']; ?></td>
    </tr>
  <?php } ?>
    
</table>
</body>
</html>