<?php 
//declaration and initialization
$UserName = $_POST['username'];
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


//to check the username is dublicate or no, if no then will add the user
$GetUserQuery = "SELECT * from User where username='$UserName'";
$result = $conn->query($GetUserQuery);
if($result->num_rows > 0){
	echo "<script>
	alert('The user name is duplicate , please select another user name');
	window.location.href='../Record_CRS_Staff.html';
	</script>";
}
else{
	$AddUserQuery = "INSERT INTO User values('$UserName','$Password','$Name','$PhoneNum')";
	$conn->query($AddUserQuery);
	$AddStaffQuery = "INSERT INTO Staff values(NULL,'$Position','$JoinDate','$UserName')";
	$conn->query($AddStaffQuery);
	echo "<script>
		alert('Record Staff Successfully');
		window.location.href='../Record_CRS_Staff.html';
		</script>";
}

$conn->close();
?>