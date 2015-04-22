<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]' AND type='admin'") or die(mysql_error());
$row = mysql_fetch_array($query);

if ($row['email']) {
echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="admin.php">Home</a></li>
  <li><a href="aj.php">Active Jobs</a></li>
  <li><a href="ij.php">Inactive Jobs</a></li>
  <li><a href="client.php">Clients</a></li>
  <li><a href="salesreps.php">Sales Reps</a></li>
  <li><a href="settings.php">Settings</a></li>

</ul>
<div class="row">
<center>
<div class="well">
<h3>Overview</h3>
<h6>Welcome, '.$row['first_name'].'</h6>
</center>
</div>


<table class="table table-condensed table-striped table-hover">

<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Client</p></td>
<td><p class="text-center">Sales Rep</p></td>
<td><p class="text-center">Status</p></td>
<td><p class="text-center">Location</p></td>
</tr>
';
$table_query = mysql_query("SELECT * FROM jobs");
while ($row = mysql_fetch_array($table_query)) {
  $id_query = mysql_query("SELECT * FROM userTable where first_name='".$row[first_name_client]."' and last_name='".$row[last_name_client]."'");
  $rowid = mysql_fetch_array($id_query);
  
  echo '<tr>';
  echo '<td><p class="text-center"><small><a href="j.php?id='.$row[id].'">'.$row[id].'</a></small></p></td>';
  echo '<td><p class="text-center"><small><a href="c.php?id='.$rowid[id].'">'.$row[first_name_client].' '.$row[last_name_client].'</a></small></p></td>';
  echo '<td><p class="text-center"><small><a href="s.php?f='.$row[first_name_sales_rep].'&l='.$row[last_name_sales_rep].'">'.$row[first_name_sales_rep].' '.$row[last_name_sales_rep].'</a></small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[status].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[location].'</small></p></td>';
  //echo $row[client];
  echo '</tr>';
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
</body>
</html>';
}
?>