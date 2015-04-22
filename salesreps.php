<?php
include "database.php";
session_start();

$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

if ($row['email']) {
echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="admin.php">Home</a></li>
  <li><a href="aj.php">Active Jobs</a></li>
  <li><a href="ij.php">Inactive Jobs</a></li>
  <li><a href="client.php">Clients</a></li>
  <li class="active"><a href="salesreps.php">Sales Reps</a></li>
  <li><a href="settings.php">Settings</a></li>
</ul>
<div class="row">
<center>
<div class="well"><h3>Sales Reps</h3></div>
<div class="center-block">
<table class="table table-condensed table-striped table-hover">
<tr>
<td><p class="text-center">Sales Rep #</p></td>
<td><p class="text-center">First Name</p></td>
<td><p class="text-center">Last Name</p></td>
<td><p class="text-center">Location</p></td>
<td><p class="text-center">Phone Number</p></td>
</tr>';
$table_query = mysql_query("SELECT * FROM userTable where type='sales_rep'");
while ($row = mysql_fetch_array($table_query)) {
echo '<tr>';
echo '<td><p class="text-center"><small><a href="s.php?f='.$row[first_name].'&l='.$row[last_name].'">'.$row[id].'</a></small></p></td>';
echo '<td><p class="text-center"><small>'.$row[first_name].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$row[last_name].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$row[city].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$row[phone_number].'</small></p></td>';
echo '</tr>';
}
echo '
</table>
</div>
<center>
	 <a href="addSalesRepPage.php">Add Sales Rep</a>
</center>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</div>
</body>
</html>';
}
?>

