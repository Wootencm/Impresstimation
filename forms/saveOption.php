<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_serviceType = $_POST[service1];
$_category = $_POST[category1];
$_price = $_POST[price1];
$_remove = $_POST[remove];
$_alter = $_POST[submitBtn];
$_press = $_POST[press];


if($_alter == 'Save New Option') {
	$query = mysql_query("INSERT INTO services (service_type, offered, category, price) VALUES ('$_serviceType', 'No', '$_category', '$_price')");
	$query = mysql_query("INSERT INTO services (service_type, offered, category, price, pp) VALUES ('$_serviceType', 'Yes', '$_category', '$_price', '$_press')");
	echo '<center><a href="start_setup.php"></a></center>';
	echo "Entered new options successfully\n";
}
if($_alter == 'Remove Selected Option') {
	$query2 = mysql_query("DELETE FROM services WHERE service_type = '$_remove'");
}



mysql_close($con);

header('Location: ../start_setup.php');   

?>