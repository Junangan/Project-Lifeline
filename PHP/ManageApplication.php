<?php 
//declaration and initialization
$ApplicationID = $_POST['applicationID'];
$status = $_POST['status'];
$remark = $_POST['remark'];
$TripID = $_POST['tripID'];


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
if($status=='REJECTED'){
	$findTripQuery = "SELECT * from Trip WHERE tripID ='$TripID'";
	$result = $conn->query($findTripQuery);
	if($result->num_rows >0){
		$row = $result->fetch_assoc();
		$numVolunteer=$row['numVolunteer'];
		$UpdateTripQuery = "UPDATE Trip SET numVolunteer='$numVolunteer'+1 WHERE tripID='$TripID'";
		$result = $conn->query($UpdateTripQuery);
	}
}
else if($status=='ACCEPTED'){
	$findTripQuery = "SELECT * from Trip WHERE tripID ='$TripID' AND numVolunteer!=0";
	$result = $conn->query($findTripQuery);
	if($result->num_rows >0){
		$row = $result->fetch_assoc();
		$numVolunteer=$row['numVolunteer'];
		$UpdateTripQuery = "UPDATE Trip SET numVolunteer='$numVolunteer'-1 WHERE tripID='$TripID'";
		$result = $conn->query($UpdateTripQuery);
	}
}
echo "<script>
		alert('Manage Successfully');
		window.location.href='../Staff/staffmenu.php';
		</script>";

$conn->close();
?>