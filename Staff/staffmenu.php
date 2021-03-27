<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style>
		body {
			background-color: #B8FF99;
  			background-image: linear-gradient(to right, #B8FF99,white,#B8FF99);
		}
		.vertical-space {height: 25px;}
		.button-rounded {border-radius: 5px;}
		.appSection {
			border-style: black 1px;
			background-color: #E2DCCD;
		}
		.appSection:hover {
			background-color: #ede9de;
		}
		.tripLink {background-color: rgb(226, 220, 205);}
		.tripLink:hover {
			box-shadow: 5px 5px grey;
		}
		.tripLink:focus {
			background-color: #a5d1af;
		}
		a#appLink {
			text-decoration: none;
			color: black;
		}
	</style>
	<title>Staff Menu</title>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
		<a class="navTitle" href="../CRSStaffPage.html">CRS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse  navbar-collapse" id="myNavbar">
			<ul class="navbar-nav  w-100 justify-content-end">
				<li class="nav-item nav"><a class="nav-link" href="organizetrip.html">Organize Trip</a></li>
				<li class="nav-item nav"><a class="nav-link" href="#">Manage Application</a></li>
				<li class="nav-item nav"><a class="nav-link" href="../index.php">Log Out</a></li>
			</ul>
		</div>
	</nav>

	<div class="mb-3">
		<div class="row g-3">
			<div class="offset-1 col-md-5">
				<?php
					session_start();

					$SERVERNAME = "localhost";
					$dbUsername = "root";
					$dbPassword = "";

					$conn = new mysqli ($SERVERNAME ,$dbUsername ,$dbPassword);

					//checking the sql
					if($conn->connect_error){
						die("Some thing error <br>".$connect->connect_error);
					}

					$conn->select_db("CRS");

					$StaffUname = $_SESSION['Staff'];

					echo"<h2 class='container text-center mb-3 py-4'>Trips handled by Staff <span id='staffName' value='xx'>".$StaffUname."</span></h2>";

					/*Not good practice for replacing $staffID with every statement, trying to convert from object to array to string type data...*/
					$getStaffIDByStaffUnameQ = "SELECT StaffID FROM Staff WHERE Username='$StaffUname'";
					$staffID =  $conn->query($getStaffIDByStaffUnameQ);
					$staffID = $staffID->fetch_assoc();
					$staffID = $staffID['StaffID'];


					$getTripsByStaffIDQ = "SELECT * FROM Trip WHERE StaffID='$staffID'";
					$result = $conn->query($getTripsByStaffIDQ);
						if(!$result){
							echo "<div class='container'>
										<div class='vertical-space'></div>
										<p class='text-center'>No any Trip</p>
									</div>";
							//echo "<script>alert('No trips found managed by this staff! ".$result->error."')</script>";
						}
						else if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								echo "<div>
										<div class='vertical-space'></div>
										<button class='tripLink row g-3 border border-dark mb-3' onclick='changeVolunteerApplication(" . $row["tripID"] . ")'>";
										if($row['crisisType']=='Flood'){
											echo"<div class='col-xl-2 col-md-4'><img src='../image/flood.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; padding-bottom:5px; width:150px; height:100px;'></div>";
										}
										else if($row['crisisType']=='EarthQuake'){
											echo"<div class='col-xl-2 col-md-4'><img src='../image/earthquake.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px; padding-bottom:5px;'></div>";
										}
										else{
											echo"<div class='col-xl-2 col-md-4'><img src='../image/wildfire.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px; padding-bottom:5px;'></div>";
										}
										echo"<div class='offset-1 col-xl-9 col-md-8'>
												<div class='row'>
													<p class='col-3' id='tripID'>Trip ID: " . $row["tripID"] . "</p>
													<p class='col-6' id='tripIdDate'>Trip Date: " . $row["tripDate"] . "</p>
													<p class='col-3' id='tripDuration'>Duration: " . $row["minDuration"] . "</p>
													<p class='col-12' id='description'>Description: ". $row["description"]."</p>
												</div>							
											</div>
										</button>
									</div>";
							}
						}

					
				?>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<h2 class="container text-center mb-3 py-4">Applications from the Trip</h2>
				<div class="container" id="applicationList">
					<?php

						$getAppAndVolFromTripIDQ = "SELECT * FROM Application INNER JOIN Volunteer ON Application.VolunteerID=Volunteer.VolunteerID";
						$result = $conn->query($getAppAndVolFromTripIDQ);
						if($result->num_rows <= 0){
							echo"<div class='appSection container'>
									<div class='vertical-space'></div>
									<p class='text-center'>No any Application</p>
								</div>";
						}
						else if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$tripID=$row['tripID'];
								$getApp= "SELECT * FROM Application WHERE tripID='$tripID'";
								$Appresult = $conn->query($getApp);
								if(!$result){
								}
								else{
									echo '<div class="appSection"  style="display:none;">
											<input type="hidden" class="applicationTripID" value="'. $row["tripID"] .'">
												<form method="post" action="manageapplications.php" id="'.$row["applicationID"].'">
												<a id="appLink"  href="#" onclick="manage('.$row["applicationID"].')">
													<input type="hidden" value='.$row["applicationID"].' name="applicationID" id="applicationID" />
													<input id="manageapplication" type="submit" style="display:none;">
													<table class="table table-borderless">
														<tr>
															<td>Apply Name:</td>
															<td id="name">'.$row["username"].'</td>
															<td>Date of Birth:</td>';
															if($row["dateOfBirth"]==0000-00-00){
																echo'<td id="dateOfBirth">Hidden</td>';
															}
															else{
																echo'<td id="dateOfBirth">'.$row["dateOfBirth"].'</td>';
															}
														echo'</tr>
														<tr>
															<td>Date:</td>
															<td id="applicationDate">'.$row["applicationDate"].'</td>
															<td>Gender:</td>';
															if($row["gender"]==null){
																echo'<td id="gender">Hidden</td>';
															}else{
																echo'<td id="gender">'.$row["gender"].'</td>';
															}
														echo'</tr>
														<tr>
															<td colspan="4" class="text-end fw-bold">Status: '.$row["status"].'</td>
														</tr>
													</table>
													</a>
												</form>
										</div>';
									}
							}
						}

						$conn->close();
						
					?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function changeVolunteerApplication(tripID){
			var status = document.getElementsByClassName("appSection");
			var TripID = document.getElementsByClassName("applicationTripID");
			for (i = 0; i < status.length; i++) {
				if(TripID[i].value==tripID){
					status[i].style.display = "block";
				}
				else {
			   	 	status[i].style.display = "none";
			  	}
			}
		}

		function manage(applicationID){
			document.getElementById(applicationID).submit();
		}

	</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>