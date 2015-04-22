<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
	
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

if ($row['email']) {
	echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<center>
  <h1>Add New Service Option</h1>
</center>
<div class="content-main">
<center>
<form role="form" method="POST" action="forms/saveOption.php">
  <div class="form-group">
    <label for="service1">Option:</label>
    <input type="text" class="form-control" name="service1" placeholder="Enter New Service Option">
  </div>
  <div class="form-group">
    <label for="category1">Category:</label>
    <input type="text" class="form-control" name="category1" placeholder="Enter New Service Category">
  </div>
  <div class="form-group">
    <label for="price1">Price:</label>
    <input type="text" class="form-control" name="price1" placeholder="Enter Cost of Service">
  </div>
  <div class="dropdown">
    <label for="press">Pre-Press or Post-Press?:</label><br>
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
      Select an options
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Pre-Press</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Post-Press</a></li>
    </ul>
  </div><br>
  <input name="submitBtn" type="submit" value="Save New Option">
  <center>
    <h1>Remove Service Option</h1>
  </center>
  ';
  $query2 = mysql_query("SELECT DISTINCT service_type FROM services ORDER BY service_type;") or die(mysql_error());
  echo "<select id='remove' name='remove'>";
    echo "<option value=''>Select Option to Remove</option>";
    while ($row = mysql_fetch_array($query2)) {
        echo "<option value='" . $row['service_type'] . "'>" . $row['service_type'] . "</option>";
    }
  echo "</select>";
  echo '
  <p>
  <p>
  <input name="submitBtn" type="submit" value="Remove Selected Option">
</form>
</div>
</div>
</div>
</body>
</html>';
	
}
else {
	echo 'DENIED';
}
	
?>