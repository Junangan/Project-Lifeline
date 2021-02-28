<?php 
//declaration and initialization
$UserName = $_POST['name'];
$Password = $_POST['password'];
$Name = $_POST['realName'];
$PhoneNum = $_POST['phoneNumber'];
$Position = $_POST['position'];
$JoinDate = $_POST['joinDate'];

$SERVERNAME = "localhost";
$dbUsername = "root";
$dbPassword = "";

$conn = new mysqli ($SERVERNAME ,$dbUsername ,$dbPassword);

//checking the sql
if($conn->connect_error){
	die("Some thing error <br>".$connect->connect_error);
}

$conn->select_db("CRS");

//using try to check the table is create or no,if no then will create the relate table
$GetStaffQuery = "SELECT * from Staff";
$result = $conn->query($GetUserQuery);
if(!$result){
	$GetUserQuery = "SELECT * from User";
	$result = $conn->query($GetUserQuery);
	if(!$result){
		$CreateUserTableQuery = "CREATE TABLE User(username VARCHAR(255) PRIMARY KEY,password VARCHAR(255) NOT NULL,name VARCHAR(255) NOT NULL,phone integer(11) NOT NULL)";
		$conn->query($CreateUserTableQuery);
	}
	$CreateStaffTableQuery = "CREATE TABLE Volunteer(StaffID integer(10) AUTO_INCREMENT PRIMARY KEY,position VARCHAR(255) NOT NULL,joinDate DATE NOT NULL,username VARCHAR(255) NOT NULL,foreign key(username) references User(username))";
	$conn->query($CreateStaffTableQuery);
}

//to check the username is dublicate or no, if no then will add the user
$GetUserQuery = "SELECT * from User where username='$UserName'";
$result = $conn->query($GetUserQuery);
if(!$result){
	echo "<script>
	alert('The user name is duplicate , please select another user name');
	window.location.href='../Record_Test_Centre_Officer.php';
	</script>";
}
else{
	$AddUserQuery = "INSERT INTO User values('$UserName','$Password','$Name','$PhoneNum')";
	$conn->query($AddUserQuery);
	$AddVolunteerQuery = "INSERT INTO Volunteer values(NULL,'$Position','$JoinDate','$UserName')";
	$conn->query($AddVolunteerQuery);
	echo "<script>
		alert('Record Tester Successfully');
		</script>";
}

$conn->close();
?>