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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>

<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="admin.php">Home</a></li>
  <li><a href="aj.php">Active Jobs</a></li>
  <li><a href="ij.php">Inactive Jobs</a></li>
  <li><a href="client.php">Clients</a></li>
  <li><a href="salesreps.php">Sales Reps</a></li>
  <li class="active"><a href="settings.php">Settings</a></li>
</ul>
<div class="row">
<center>
<center>
<div class="well">
<h3>Settings</h3>
</div>
</center>
<a href="start_setup.php">Edit Offered Services</a>
</center>
<center>
<a href="updatePassword.php">Update Password</a>
</center>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</body>
</html>';
}
?>