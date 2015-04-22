<?php
include "database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
<style type="text/css">
      .col1 {
          width:50%;
          float:left;
          padding:10px;
      }
      .col2 {
          width:50%;
          float:right;
          padding:10px;
      }
    </style>
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="admin.php">Home</a></li>
  <li><a href="aj.php">Active Jobs</a></li>
  <li><a href="ij.php">Inactive Jobs</a></li>
  <li class="active"><a href="client.php">Clients</a></li>
  <li><a href="salesreps.php">Sales Reps</a></li>
  <li><a href="settings.php">Settings</a></li>
</ul>
<center>
<div class="well">
<h3>Job Request Summary</h3>
</div>
</center>'; 
$t_query = mysql_query("SELECT * FROM jobs where id='".$_POST['id']."'");
$trow = mysql_fetch_array($t_query);
$data = unserialize(base64_decode($trow[job_info]));
 echo '<center><table class="table table-condensed table-striped table-hover">';
  foreach ($data as $key => $value) {
        echo "<tr>";
        echo "<td><input type='hidden' value=".$value.' name='.$key.'>';
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
echo '</table>
</center><br><br><a href="admin.php">Back</a>';



mysql_close($con);

?>