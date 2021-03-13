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
	$GetStaffQuery = "SELECT * from Staff";
	$result = $conn->query($GetStaffQuery);
	if(!$result){
		$CreateStaffTableQuery = "CREATE TABLE Staff(StaffID integer(10) AUTO_INCREMENT PRIMARY KEY,position VARCHAR(255) NOT NULL,joinDate DATE NOT NULL,username VARCHAR(255) NOT NULL,foreign key(username) references User(username))";
		$conn->query($CreateStaffTableQuery);
	}
	$GetVolunteerQuery = "SELECT * from Volunteer";
	$result = $conn->query($GetVolunteerQuery);
	if(!$result){
		$CreateVolunteerTableQuery = "CREATE TABLE Volunteer(VolunteerID integer(10) AUTO_INCREMENT PRIMARY KEY,credentialType VARCHAR(20),credentials integer(25), dateOfBirth date,gender VARCHAR(10), username VARCHAR(255) NOT NULL,foreign key(username) references User(username))";
		$conn->query($CreateVolunteerTableQuery);
		$CreateDocumentTableQuery = "CREATE TABLE Document(documentID integer(10) AUTO_INCREMENT PRIMARY KEY,image MEDIUMBLOB NOT NULL,documentType VARCHAR(255) NOT NULL,expiryDate DATE NOT NULL,VolunteerID integer(10) NOT NULL,foreign key(VolunteerID) references Volunteer(VolunteerID))";
		$conn->query($CreateDocumentTableQuery);
	}
}

$findFirstManager = "SELECT * from Staff where username='Manager1'";
$result = $conn->query($findFirstManager);
if($result->num_rows <= 0){
	$date = date("Y-m-d");
	$AddUserQuery = "INSERT INTO User values('Manager1','Manager1','Manager1','1234567890')";
	$conn->query($AddUserQuery);
	$AddManagerQuery = "INSERT INTO Staff values(NUll,'Manager','$date','Manager1')";
	$conn->query($AddManagerQuery);
}

//to check the username is dublicate or no, if no then will add the user
$GetLoginUserQuery = "SELECT * from User where username='$UserName' AND password='$Password'";
$result = $conn->query($GetLoginUserQuery);
if($result->num_rows <= 0){
	echo "<script>
		alert('The User is not exist , please enter again');
		window.location.href='../Login.html';
		</script>";
}
else{
	$findVolunteer = $conn->query("SELECT * from Volunteer where username='$UserName'");
	if($findVolunteer->num_rows <= 0){
		$findManager = $conn->query("SELECT * from Staff where username='$UserName' AND position='Manager'");
		if($findManager->num_rows <= 0){
			$_SESSION['Staff'] = $UserName;
			echo "<script>
			window.location.href='../CRSStaffPage.html';
			</script>";
		}
		else{
			echo "<script>
			window.location.href='../CRSManagerPage.html';
			</script>";
		}
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