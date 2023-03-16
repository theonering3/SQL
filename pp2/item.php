<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>PHP-MySQL Program</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$date = $_POST['date'];

$thedate = mysqli_real_escape_string($conn, $date);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT s.store_name AS sn,sum(di.quantity) AS quan
FROM Delivery d JOIN Store s ON s.store_id=d.Store_store_id
JOIN Delivery_has_Items di ON di.Delivery_instance_id=d.instance_id
JOIN Items i ON i.item_id=di.Items_item_id
GROUP BY s.store_id
ORDER BY 2 DESC";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "Storename: $row[sn] Quantity:$row[quan]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
 
 
</body>
</html>
	  