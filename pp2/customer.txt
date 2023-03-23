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

$query1 = "SELECT fname,lname,People_ssn,number_of_purchase,join_date
FROM Customer c JOIN People p on p.ssn=c.People_ssn
WHERE CAST(";
$query2 =" AS DATE)<c.join_date
ORDER BY number_of_purchase DESC";
$query = $query1."'".$thedate."'".$query2;

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
    print "Firstname: $row[fname]  Last name: $row[lname] Number of Purchase:$row[number_of_purchase]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>
<br>
<p>
<a href="customer.txt" >Contents</a>
of the PHP page that gets called.
 
</body>
</html>
	  