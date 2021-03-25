<?php 
session_start();
//declaration and initialization
$TripID = $_POST['tripID'];


$date = date('Y-m-d');

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
$GetApplicationQuery = "SELECT * from Application";
$result = $conn->query($GetApplicationQuery);
if(!$result){
	$CreateApplicationTableQuery = "CREATE TABLE Application(applicationID integer(10) AUTO_INCREMENT PRIMARY KEY,applicationDate date NOT NULL,status VARCHAR(255) NOT NULL,remarks VARCHAR(255),VolunteerID integer(10) NOT NULL, tripID integer(10) NOT NULL,foreign key(tripID) references Trip(tripID),foreign key(VolunteerID) references Volunteer(VolunteerID))";
	$conn->query($CreateApplicationTableQuery);
}

$findTripQuery = "SELECT * from Trip WHERE tripID ='$TripID' AND numVolunteer!=0";
$result = $conn->query($findTripQuery);
if($result->num_rows <=0){
	echo "<script>
		alert('Trip ID no found');
		window.location.href='../applyTrip.php';
		</script>";
}
else{
	//to get the volunteer id
	$VolunteerName = $_SESSION['Volunteer'];
	$GetVolunteerQuery = "SELECT * from Volunteer WHERE username='$VolunteerName'";
	$result = $conn->query($GetVolunteerQuery);
	$row = $result->fetch_assoc();
	$VolunteerID = $row['VolunteerID'];
	$AddApplicationQuery = "INSERT INTO Application values(NULL,'$date','NEW',NULL,'$VolunteerID','$TripID')";
	$conn->query($AddApplicationQuery);
	echo "<script>
		alert('Apply Trip Successfully');
		window.location.href='../applyTrip.php';
		</script>";
	
}

$conn->close();
?>