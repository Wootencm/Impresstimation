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
  <li class="active"> <a href="activeJobsSalesRep.php">Active Jobs</a></li>
    <li><a href="pendingEstimates.php">Pending Estimates</a></li>
      <li><a href="client.php">Clients</a></li>
  <li><a href = "salesRepSettings.php">Settings</a></li>

</ul>
';
$t_query = mysql_query("SELECT * FROM jobs where id='".$_GET['id']."'");
$trow = mysql_fetch_array($t_query);
echo '
<div class="row">
<div class="center-block">
<center>
<div class="well">
<h3>Job Info</h3>
</div>
</center>
<table class="table table-condensed table-striped table-hover">
<tr>
<td><p class="text-center">Job #</p></td>

<td><p class="text-center">Client First Name</p></td>
<td><p class="text-center">Client Last Name</p></td>
<td><p class="text-center">Summary';
echo '</p></td>
<td><p class="text-center">PDF</p></td>
</tr>';
echo '<tr>
<td><p class="text-center">'.$trow['id'].'</p></td>
<td><p class="text-center">'.$trow['first_name_client'].'</p></td>
<td><p class="text-center">'.$trow['last_name_client'].'</p></td>
<td align="center"><p class="text-center"><form method="POST" action="summary.php"><div style="display:none"><input type=hidden size=0 name="id" value="'.$trow['id'];
echo '"></div><input type="submit" value="view" style="height:25px; width:45px"></form></p></td>
<td><p class="text-center">'; 
 if ($trow[pdf] == 'Yes') {
    echo '<a href="../forms/orders/'.$trow[id].'.pdf'.'">PDF</a>';
  }
echo '</p></td>
</tr>';
echo '
</table>
';
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