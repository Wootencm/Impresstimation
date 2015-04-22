<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$job_data = base64_encode(serialize($_POST));
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);
$job_enter = mysql_query("INSERT into jobs (first_name_client, last_name_client, first_name_sales_rep, last_name_sales_rep, location, status, job_info) VALUES ('".$row[first_name]."', '".$row[last_name]."', 0, 0, 0, 'inactive', '".$job_data."')");

mysql_close($con);

header('Refresh:2; url=inactiveClientJobs.php');
echo 'Your estimate will be ready in 24 hours.';

?>