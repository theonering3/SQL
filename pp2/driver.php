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

$query1 = "SELECT fname,lname,d.People_ssn,SUM(dy.overtime)/COUNT(d.People_ssn) as number_of_overtime
FROM Driver d JOIN People p ON p.ssn=d.People_ssn
JOIN Delivery dy ON dy.Driver_People_ssn=d.People_ssn
WHERE CAST(";

$query2 = " AS DATE)<d.join_date
GROUP BY d.People_ssn
ORDER BY 3 DESC";
$query = $query1."'".$thedate."'";

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
    print "Firstname: $row[fname]  Last name: $row[lname] SSN:$row[People_ssn]";
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
	  