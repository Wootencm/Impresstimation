<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);
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
    <li><a href="pendingEstimates.php">Pending Estimates</a></li>
  <li class="active"><a href="client.php">Clients</a></li>
  <li><a href="salesRepSettings.php">Settings</a></li>
</ul>
';
$table_query = mysql_query("SELECT * FROM userTable where type='client' and id='".$_GET['id']."'");
$row = mysql_fetch_array($table_query);
echo '
<div class="row">
<div class="center-block">
<center>
<div class="well">
<h3>Client Info</h3>
</div>
</center>
<table class="table table-condensed table-striped table-hover">
<tr>
<td><p class="text-center">Client #</p></td>
<td><p class="text-center">First Name</p></td>
<td><p class="text-center">Last Name</p></td>
<td><p class="text-center">Email</p></td>
<td><p class="text-center">Company</p></td>
<td><p class="text-center">Phone Number</p></td>
</tr>';
echo '<tr>
<td><p class="text-center">'.$row['id'].'</p></td>
<td><p class="text-center">'.$row['first_name'].'</p></td>
<td><p class="text-center">'.$row['last_name'].'</p></td>
<td><p class="text-center">'.$row['email'].'</p></td>
<td><p class="text-center">'.$row['company'].'</p></td>
<td><p class="text-center">'.$row['phone_number'].'</p></td>
</tr>';
echo '
</table>
<center>
<div class="well">
<h3>Client Jobs</h3>
</div>
</center>
</div>';
echo '<table class="table table-condensed table-striped table-hover">

<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Sales Rep</p></td>
<td><p class="text-center">Status</p></td>
<td><p class="text-center">Location</p></td>
</tr>
';
$t_query = mysql_query("SELECT * FROM jobs where first_name_client='".$row['first_name']."' and last_name_client='".$row['last_name']."'");
while ($row = mysql_fetch_array($t_query)) {
  echo '<tr>';
  echo '<td><p class="text-center"><small><a href="j.php?id='.$row[id].'">'.$row[id].'</a></small></p></td>';
  echo '<td><p class="text-center"><small><a href="s.php?f='.$row[first_name_sales_rep].'&l='.$row[last_name_sales_rep].'">'.$row[first_name_sales_rep].' '.$row[last_name_sales_rep].'</a></small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[status].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[location].'</small></p></td>';
  //echo $row[client];
  echo '</tr>';
}
echo '
</table>';
echo '
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