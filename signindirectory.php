<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$query = mysql_query("SELECT * FROM userTable where email = '".$_POST['user']."' AND password = '".$_POST['pass']."' ") or die(mysql_error());
$row = mysql_fetch_array($query);
$type = $row['type'];
if ($row['email']) {

$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
  if($type == "admin")
  {
    header('Location: admin.php'); 
  }
  else if($type == "client")
  {
    header('Location: client/clientDefault.php'); 
  }
  else if($type == "sales_rep")
  {
    header('Location: s_r/salesRepDefault.php'); 
  }
}
else {

  header('Refresh:2; url=login.php');
  echo 'Invalid Password. You are now being redirected to the login page.';
  //echo "SELECT * FROM userTable where email = '".$_POST['user']."' AND password = '".$_POST['pass']."' ";
  //header('Location: login.php'); 
  session_destroy();
}
  
?>