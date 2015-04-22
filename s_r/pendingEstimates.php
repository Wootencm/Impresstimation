<?php
include "../database.php";
session_start();


$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);


$firstname = $row['first_name'];
$lastname = $row['last_name'];

if ($row['email']) {
echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="salesRepDefault.php">Home</a></li>
  <li><a href="activeJobsSalesRep.php">Active Jobs</a></li>
    <li class="active"><a href="pendingEstimates.php">Pending Estimates</a></li>
    <li><a href="client.php">Clients</a></li>
  <li><a href = "salesRepSettings.php">Settings</a></li>
</ul>
<div class="row">
<center>
<div class="well">
<h3>Pending Estimates</h3>
</div>
</center>
<div class="center-block">
<table class="table table-condensed">
<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Client</p></td>
<td><p class="text-center">Status</p></td>
<td><p class="text-center">Location</p></td>
<td><p class="text-center">Estimate</p></td>
</tr>';

$table_query = mysql_query("SELECT * FROM jobs where first_name_sales_rep= '$firstname' and last_name_sales_rep = '$lastname' and status='active' and pdf IS NULL");
  while ($row = mysql_fetch_array($table_query)) {
    echo '<tr>';
    echo '<td><p class="text-center"><small><form action="../forms/change_estimate.php" method="POST"><a href="j.php?id='.$row[id].'">'.$row[id].'</a></small></p></td>';
    echo '<td><p class="text-center"><small><a href="c.php?id='.$rowid[id].'">'.$row[first_name_client].' '.$row[last_name_client].'</a></small></p></td>';
    echo '<td><p class="text-center"><small>'.$row[status].'</small></p></td>';
    echo '<td><p class="text-center"><small>'.$row[location].'</small></p></td>';
    echo '<td><p class="text-center"><small><input name="estimate" type="text" size=3><input type="hidden" value="'.$row[id].'" name="jobid"><input type="submit"></small></form></p></td>';
    //echo $row[client];
    echo '</tr>';
  
}

echo '
</table>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="../logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</div>
</body>
</html>';
}
?>