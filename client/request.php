<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
  
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

$firstname = $row['first_name'];
$lastname = $row['last_name'];

//print "$firstname" ;
//print  "$lastname" ;

if ($row['email']) {
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
<h3>Request New Job</h3>
</center>
</div>
<div class="col1">';
echo '<center>
  <h3>Pre-Press Options</h3>
<form role="form" method="POST" action="summary.php">
  <div class="form-group">
    <label for="service1"># of pages per unit:</label>
    <input type="text" class="form-control" onChange="firstEstimate(this.value);" name="Pages Per Units" placeholder="#">
    <label for="service1"># of units per project:</label>
    <input type="text" class="form-control" onChange="secondEstimate(this.value);" name="Units Per Project" placeholder="#">
  </div>
  <div class="form-group">
    <label for="service2">Paper Size:</label>
    <br>Width: <input type="text" name="Paper Width" size="4"> Height: <input type="text" name="Paper Height" size=4> 
    <br>
    <small>
    Minimum size: 0.25" x 0.25" Maximum size: 18.5" x 12.5"
    <br> Larger paper sizes are available so call (804) 878-2782
    </small>
  </div>
';
$table_query = mysql_query("SELECT DISTINCT category FROM services where pp='Pre'");

while ($row = mysql_fetch_array($table_query)) {

echo '
      <label for="category1">';
      echo $row[0];
      echo ':</label><select name="'.$row[0].'"';
      echo'>
      ';

  $box_query = mysql_query("SELECT service_type FROM services where category='".$row[0]."' and offered='Yes' and pp='Pre'");
  while ($row2 = mysql_fetch_array($box_query)) {
echo '<option>'.$row2[0].'</option>';
  }
  echo '</select>
  <br>';
}
echo '</div>
</center>

<div class="col2"><center>
  <h3>Post-Press Options</h3>
';
$table_query = mysql_query("SELECT DISTINCT category FROM services where pp='Post'");

while ($row = mysql_fetch_array($table_query)) {

echo '
      <label for="category1">';
      echo $row[0];
      echo ':</label><select name="'.$row[0].'"';
      echo '>
      ';

  $box_query = mysql_query("SELECT service_type FROM services where category='".$row[0]."' and offered='Yes' and pp='Post'");
  while ($row2 = mysql_fetch_array($box_query)) {
  echo '<option>'.$row2[0].'</option>';
  }
  echo '</select>
  <br>';
}

echo '
<div class="form-group">
  <label for="Due_Date">Desired completion date:</label><br>
  <input type="Date" name="Due_Date"></input><br>
</div>
<br>
Estimate: <input type="text" name="requested_estimate"</input>

<br><br><br>

<br>  
<button type="submit" class="btn btn-default">View Order Summary</button>
</center>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="../logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</body>
</html>';
  
}
else {
  echo 'DENIED';
}
  
?>