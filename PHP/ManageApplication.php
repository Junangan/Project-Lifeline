<?php 
//declaration and initialization
$ApplicationID = $_POST['applicationID'];
$status = $_POST['status'];
$remark = $_POST['remark'];


$SERVERNAME = "localhost";
$dbUsername = "root";
$dbPassword = "";

$conn = new mysqli ($SERVERNAME ,$dbUsername ,$dbPassword);

//checking the sql
if($conn->connect_error){
	die("Some thing error <br>".$connect->connect_error);
}

//using try to select the database, if the dbms is no exist then create the database and select again
if($conn->select_db("CRS") == false){
	$CreateDatabase = "CREATE DATABASE CRS";
	$conn->query($CreateDatabase);
	$conn->select_db("CRS");
}
else{
	$conn->select_db("CRS");
}

$UpdateApplicationQuery = "UPDATE Application SET status='$status',remarks='$remark' WHERE applicationID='$ApplicationID'";
$result = $conn->query($UpdateApplicationQuery);
echo "<script>
		alert('Manage Successfully');
		window.location.href='../Staff/staffmenu.php';
		</script>";

$conn->close();
?>