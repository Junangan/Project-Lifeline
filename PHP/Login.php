<?php 
//declaration and initialization
session_start();
$UserName = $_POST['name'];
$Password = $_POST['password'];

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
$GetUserQuery = "SELECT * from User";
$result = $conn->query($GetUserQuery);
if(!$result){
	$CreateUserTableQuery = "CREATE TABLE User(username VARCHAR(255) PRIMARY KEY,password VARCHAR(255) NOT NULL,name VARCHAR(255) NOT NULL,phone integer(11) NOT NULL)";
	$conn->query($CreateUserTableQuery);
}

//to check the username is dublicate or no, if no then will add the user
$GetUserQuery = "SELECT * from User where username='$UserName' AND password='$Password'";
$result = $conn->query($GetUserQuery);
if(!$result){
	echo "<script>
			alert('The User is not exist , please enter again');
			window.location.href='../Login.html';
			</script>";
}
else{
	$findVolunteer = $conn->query("SELECT * from Volunteer where username='$UserName'");
	$findStaff = $conn->query("SELECT * from Staff where username='$UserName'");
	if(!$findVolunteer && !$findStaff){
		echo "<script>
			window.location.href='../CRSManagerPage.html';
			</script>";
	}
	else if(!$findVolunteer){

	}
	else{
		$_SESSION['Volunteer'] = $UserName;
		echo "<script>
			window.location.href='../VolunteerPage.html';
			</script>";
	}
}

$conn->close();
?>