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
  <li class="active"><a href="ij.php">Inactive Jobs</a></li>
  <li><a href="client.php">Clients</a></li>
  <li><a href="salesreps.php">Sales Reps</a></li>
  <li><a href="settings.php">Settings</a></li>
</ul>
<div class="row">
<center>
<div class="well">
<h3>Inactive Jobs</h3>
</div>
</center>
<div class="center-block">
<table class="table table-condensed table-striped table-hover">
<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Client</p></td>
<td><p class="text-center">Location</p></td>
<td><p class="text-center">Assign to Sales Rep</p></td>
</tr>';

$table_query = mysql_query("SELECT * FROM jobs where status='inactive'");

$i = 0;
while ($row = mysql_fetch_array($table_query)) {
$rep_query = mysql_query("SELECT DISTINCT first_name, last_name FROM userTable where type='sales_rep'");
echo '<form role="form" method="POST" action="forms/assign.php">';
echo '<tr>';
echo '<td><p class="text-center"><small><a href="j.php?id='.$row[id].'">'.$row[id].'</a></small></p><input name="id" type="hidden" value="'.$row[id].'"></td>';
echo '<td><p class="text-center"><small><a href="c.php?id='.$rowid[id].'">'.$row[first_name_client].' '.$row[last_name_client].'</a></small></p></td>';
echo '<td><p class="text-center"><small>'.$row[location].'</small></p></td>';
echo '<td><p class="text-center"><small><select name="sales_rep"">';
while ($rep = mysql_fetch_array($rep_query)) {
		    echo "<option value='" . $rep['first_name'] .' '. $rep['last_name'] . "'>" . $rep['first_name'] . ' '.$rep['last_name'] ."</option>";
		}

echo '</select>';
echo '<input type="submit"></small></p></td>';
echo '</form>';
echo '</tr>';
$i = $i + 1;
}
echo '
</table>
</div>
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