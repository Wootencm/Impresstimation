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
  <li><a href="pendingEstimates.php">Pending Estimates</a></li>
  <li><a href="client.php">Clients</a></li>
  <li class="active" ><a href = "salesRepSettings.php">Settings</a></li>

</ul>
<div class="row">
<center>
<div class="well">
<h3>Settings</h3>
</div>
</center>

<div class="center-block">
	<center>
		<li><a href="../updatePassword.php">Update Password</a></li>
	</center>
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