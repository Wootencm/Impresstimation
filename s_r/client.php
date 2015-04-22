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
<style type="text/css">
.linkButton { 
     background: none;
     border: none;
     color: #0066ff;
     text-decoration: underline;
     cursor: pointer; 
}
}
    </style>
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
<div class="row">
<div class="center-block">
<center>
<div class="well">
<h3>Clients</h3>
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
$table_query = mysql_query("SELECT * FROM jobs where first_name_sales_rep = '".$row[first_name]."'"." and last_name_sales_rep ='"."".$row[last_name]."'");
while ($row = mysql_fetch_array($table_query)) {
$id_query = mysql_query("SELECT * FROM userTable where first_name='".$row[first_name_client]."' and last_name='".$row[last_name_client]."'");
$rowid = mysql_fetch_array($id_query);
echo '<tr>';

echo '<td><p class="text-center"><small><a href="c.php?id='.$rowid[id].'">'.$rowid[id].'</a></small></p></td>';
echo '<td><p class="text-center"><small>'.$row[first_name_client].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$row[last_name_client].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$rowid[email].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$rowid[company].'</small></p></td>';
echo '<td><p class="text-center"><small>'.$rowid[phone_number].'</small></p>
</td>';
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