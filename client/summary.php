<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
  <li><a href = "clientDefault.php">Home</a></li>
  <li class="active"><a href="request.php">Request New Job</a></li>
  <li><a href="activeJobsClient.php">Active Jobs</a></li>
  <li><a href="inactiveClientJobs.php">Inactive Jobs</a></li>
  <li><a href = "clientSettings.php">Settings</a></li>

</ul>
<center>
<div class="well">
<h3>Job Request Summary</h3>
</div>
</center>'; 
 echo '<center><form action="new_job.php" method="post"><table class="table table-condensed table-striped table-hover">';
  foreach ($_POST as $key => $value) {
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
<input type="submit" value="Submit Request"></form></center>';



mysql_close($con);

?>