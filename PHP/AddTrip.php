<?php 
session_start();
//declaration and initialization
$Destination = $_POST['destinationTrip'];
$Description = $_POST['description'];
$Requirements = $_POST['requirements'];
$TripDate = $_POST['tripDatePicker'];
$Duration = $_POST['tripDuration'];
$NumVolunteer = $_POST['numVolunteer'];
$Type = $_POST['TripType'];

$time = strtotime($TripDate);

$date = date('Y-m-d',$time);

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

//using try to check the table is create or no,if no then will create the relate table
$GetTriprQuery = "SELECT * from Trip";
$result = $conn->query($GetTriprQuery);
if(!$result){
	$CreateTripTableQuery = "CREATE TABLE Trip(tripID integer(10) AUTO_INCREMENT PRIMARY KEY,description VARCHAR(255) NOT NULL,tripDate date NOT NULL,location VARCHAR(255) NOT NULL,numVolunteer integer(10) NOT NULL,minDuration integer(10) NOT NULL,crisisType VARCHAR(50) NOT NULL, requirements VARCHAR(255), StaffID integer(10) NOT NULL,foreign key(StaffID) references Staff(StaffID))";
	$conn->query($CreateTripTableQuery);
}

//to get the staff id
$StaffName = $_SESSION['Staff'];
$GetStaffQuery = "SELECT * from Staff WHERE username='$StaffName'";
$result = $conn->query($GetStaffQuery);
$row = $result->fetch_assoc();
$StaffID = $row['StaffID'];
//to check the username is dublicate or no, if no then will add the user
$AddTripQuery = "INSERT INTO Trip values(NULL,'$Description','$date','$Destination','$NumVolunteer','$Duration','$Type','$Requirements','$StaffID')";
$conn->query($AddTripQuery);
echo "<script>
	alert('Organize Trip Successfully');
	window.location.href='../Staff/organizetrip.html';
	</script>";


$conn->close();
?>
