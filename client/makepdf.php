<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$job_data = json_encode($_POST);
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);


date_default_timezone_set('America/New_York');
require('fpdf.php');
$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Times', '', 12);


        // Logo
        $pdf->Image('logo.jpg',10,6,30);

        // Arial bold 15
        $pdf->SetFont('Arial','B',15);

        // Move to the right
        $pdf->Cell(80);

        // Title
        $pdf->Cell(30,10,'Columbia Printing and Graphics', 'C');

        // Line break
        $pdf->Ln(30);

        $pdf->Write(5, "Name: $row[first_name] $row[last_name]");
        $pdf->Ln(10);
        $pdf->Write(5, "Company: $row[company]");
        $pdf->Ln(10);
        $pdf->Write(5, "Email: $row[email]");
        $pdf->Ln(10);
        $pdf->Write(5, "Phone Number: $row[phone_number]");
        $pdf->Ln(10);
        $pdf->Write(5, "Address: $row[address] $row[city] $row[state], $row[zip_code]");
        $pdf->Ln(10);

foreach ($_POST as $key => $value) {
    $pdf->Write(5, "$key : $value");
    $pdf->Ln(10);
}
$job_enter = mysql_query("INSERT into jobs (first_name_client, last_name_client, first_name_sales_rep, last_name_sales_rep, location, status, pdf, job_info) VALUES ('".$row[first_name]."', '".$row[last_name]."', 0, 0, 0, 'inactive', '".'orders/'.$row[last_name].'_'.date("DMd").'.pdf'."', '".serialize($_POST)."')");
$pdf->Output('orders/'.$row[last_name].'_'.date("DMd").'.pdf', 'F');

mysql_close($con);
header('Location: inactiveClientJobs.php');   


?>