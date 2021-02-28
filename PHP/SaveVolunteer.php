<?php 
//declaration and initialization
$UserName = $_POST['name'];
$Password = $_POST['password'];
$Name = $_POST['realName'];
$PhoneNum = $_POST['phoneNumber'];
$credentialType = $_POST['CredentialType'];
$credentials = $_POST['Credential'];
$Birthday = $_POST['Birthday'];
$Gender = $_POST['Gender'];

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
$GetVolunteerQuery = "SELECT * from Volunteer";
$result = $conn->query($GetVolunteerQuery);
if(!$result){
	$GetUserQuery = "SELECT * from User";
	$result = $conn->query($GetUserQuery);
	if(!$result){
		$CreateUserTableQuery = "CREATE TABLE User(username VARCHAR(255) PRIMARY KEY,password VARCHAR(255) NOT NULL,name VARCHAR(255) NOT NULL,phone integer(11) NOT NULL)";
		$conn->query($CreateUserTableQuery);
	}
	$CreateVolunteerTableQuery = "CREATE TABLE Volunteer(VolunteerID integer(10) AUTO_INCREMENT PRIMARY KEY,credentialType VARCHAR(20),credentials integer(25), dateOfBirth date,gender VARCHAR(10), username VARCHAR(255) NOT NULL,foreign key(username) references User(username))";
	$conn->query($CreateVolunteerTableQuery);
	$CreateDocumentTableQuery = "CREATE TABLE Document(documentID integer(10) AUTO_INCREMENT PRIMARY KEY,image MEDIUMBLOB NOT NULL,documentType VARCHAR(255) NOT NULL,expiryDate DATE NOT NULL,VolunteerID integer(10) NOT NULL,foreign key(VolunteerID) references Volunteer(VolunteerID))";
	$conn->query($CreateDocumentTableQuery);
}

//to check the username is dublicate or no, if no then will add the user
$GetUserQuery = "SELECT * from User where username='$UserName'";
$result = $conn->query($GetUserQuery);
if($result->num_rows > 0){
	echo "<script>
	alert('The user name is duplicate , please select another user name');
	window.location.href='../SignUp.html';
	</script>";
}
else{
	$AddUserQuery = "INSERT INTO User values('$UserName','$Password','$Name','$PhoneNum')";
	$conn->query($AddUserQuery);
	$AddVolunteerQuery = "INSERT INTO Volunteer values(NULL,'$credentialType','$credentials','$Birthday','$Gender','$UserName')";
	$conn->query($AddVolunteerQuery);
	echo "<script>
		alert('Record Volunteer Successfully');
		window.location.href='../Login.html';
		</script>";
}

$conn->close();
?>