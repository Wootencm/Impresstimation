<?php
include "database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
	
$query = mysql_query("SELECT DISTINCT category FROM services") or die(mysql_error());

	echo '<html>
	<head>


	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	 <script type="text/javascript" src="js/bootstrap.min.js"></script>
	 <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
	 <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css"/>
	</head>
	<body>

	<div class="container-fluid">
	<div class="content-main">
	<ul class="nav nav-tabs" role="tablist">
	  <li><a href="admin.php">Home</a></li>
	  <li><a href="aj.php">Active Jobs</a></li>
	  <li><a href="ij.php">Inactive Jobs</a></li>
	  <li><a href="client.php">Clients</a></li>
	  <li><a href="salesreps.php">Sales Reps</a></li>
	  <li class="active"><a href="settings.php">Settings</a></li>
	</ul>
	<div class="row">
	<center>
<div class="well">
<h3>Edit Options</h3>
</div>
</center>
	<center>
	<form method="POST" action="forms/post.php">
	';
	echo "<h6>Select Category: </h6><select id='category' name='category' onchange='sData(this.value)'>";
	
		while ($row = mysql_fetch_array($query)) {
		    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
		}
	echo "</select>";
	echo '
	<p>
	<script>
		var e = document.getElementById("category");
		var cate = e.options[e.selectedIndex].text;
	</script>
	';
	
	    echo"<h6>Select Options: </h6><div id='off'><select name='choices[]' id='example-multiple-selected' multiple='multiple'><option value='Select Category'>Select Category</option></select>";

		echo "</div><br><br>";
	
	echo '
	<input type="submit">
	</form>
	<div>
	<br>
	<a href="addNewOption.php">Add/Remove options</a>
	</div>
	</center>
	<script>
$("#example-multiple-selected").multiselect({
		enableCaseInsensitiveFiltering: true
	});
		function change_tbl(dhi) {
		    if(dhi == ""){
		    	return;
		    }
		    $("#tbl_div > div").css("display", "none");
		    $("#" + dhi).css("display", "block");
		}
	</script>
		<script>
	function sData(str) { 

$.ajax({
    type: "GET",
    dataType: "html",
    url: "forms/getuser.php",
    data: "q="+str,
    success: function(data){

        document.getElementById("off").innerHTML=data;
        $("#example-multiple-selected").multiselect({

		enableCaseInsensitiveFiltering: true



	});
    }
});

}
</script>

	<style>
		#tbl_div div {
		    display:none;
		}
	</style>

	</div>
	</div>
	</div>
	</div>
	</body>
	</html>';
?>