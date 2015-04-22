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
  <li class="active"><a href = "clientDefault.php">Home</a></li>
  <li><a href="request.php">Request New Job</a></li>
  <li><a href="activeJobsClient.php">Active Jobs</a></li>
  <li><a href="inactiveClientJobs.php">Inactive Jobs</a></li>
  <li><a href = "clientSettings.php">Settings</a></li>

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