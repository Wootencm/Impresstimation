<?php

session_start();
include "database.php";
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
';
$t_query = mysql_query("SELECT * FROM userTable where first_name='".$_GET['f']."' and last_name='".$_GET['l']."'");
$trow = mysql_fetch_array($t_query);
echo '
<div class="row">
<div class="center-block">
<center>
<div class="well">
<h3>Sales Rep</h3>
</div>
</center>
<table class="table table-condensed table-striped table-hover">
<tr>
<td><p class="text-center">Rep #</p></td>
<td><p class="text-center">First Name</p></td>
<td><p class="text-center">Last Name</p></td>
<td><p class="text-center">Email</p></td>
<td><p class="text-center">Phone Number</p></td>
</tr>';
echo '<tr>
<td><p class="text-center">'.$trow['id'].'</p></td>
<td><p class="text-center">'.$trow['first_name'].'</p></td>
<td><p class="text-center">'.$trow['last_name'].'</p></td>
<td><p class="text-center">'.$trow['email'].'</p></td>
<td><p class="text-center">'.$trow['phone_number'].'</p></td>
</tr>';
echo '
</table>
';
echo '
<center>
<div class="well">
<h3>Jobs</h3>
</div>
</center>
</div>';
echo '<table class="table table-condensed table-striped table-hover">

<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Client</p></td>
<td><p class="text-center">Status</p></td>
<td><p class="text-center">Location</p></td>
</tr>
';
$t_query = mysql_query("SELECT * FROM jobs where first_name_sales_rep='".$trow['first_name']."' and last_name_sales_rep='".$trow['last_name']."'");
while ($row = mysql_fetch_array($t_query)) {
    $id_query = mysql_query("SELECT * FROM userTable where first_name='".$row[first_name_client]."' and last_name='".$row[last_name_client]."'");
  $rowid = mysql_fetch_array($id_query);
  echo '<tr>';
  echo '<td><p class="text-center"><small><a href="j.php?id='.$row[id].'">'.$row[id].'</a></small></p></td>';
  echo '<td><p class="text-center"><small><a href="c.php?id='.$rowid[id].'">'.$row[first_name_client].' '.$row[last_name_client].'</a></small></p></td>';
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