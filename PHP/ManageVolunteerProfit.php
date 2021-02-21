<?php 
session_start();
//declaration and initialization
$Password = $_POST['password'];
$Name = $_POST['realName'];
$PhoneNum = $_POST['phoneNumber'];

$SERVERNAME = "localhost";
$dbUsername = "root";
$dbPassword = "";

$conn = new mysqli ($SERVERNAME ,$dbUsername ,$dbPassword);

//checking the sql
if($conn->connect_error){
	die("Some thing error <br>".$connect->connect_error);
}

$conn->select_db("CRS");


$VolunteerName = $_SESSION['Volunteer'];
$GetUserQuery = "SELECT * from User WHERE username='$VolunteerName'";
$result = $conn->query($GetUserQuery);
$row = $result->fetch_assoc();
if($Password!= $row['password'] || $Name!= $row['name'] || $PhoneNum!= $row['phone'] ){
	$UpdateProfitQuery = "UPDATE User SET password='$Password' , name='$Name' , phone='$PhoneNum' WHERE username='$VolunteerName'";
	$conn->query($UpdateProfitQuery);
	$isEnable = isset($_POST['DocumentType']);
	if($isEnable !=false){
		$DocumentType = $_POST['DocumentType'];
		$ExpiryDate = $_POST['ExpiryDate'];
		$image = $_POST['image'];
		$GetVolunteerQuery = "SELECT * from Volunteer WHERE username='$VolunteerName'";
		$result = $conn->query($GetVolunteerQuery);
		$row = $result->fetch_assoc();
		$VolunteerID = $row['VolunteerID'];
		$AddDocumentQuery = "INSERT INTO Document values(Null,'$image','$DocumentType','$ExpiryDate','$VolunteerID')";
		$conn->query($AddDocumentQuery);
	}
	echo "<script>
	alert('Change Successfully');
	</script>";
}

$conn->close();
?>