<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style>
		html {scroll-behavior: smooth;}
		.vertical-space {height: 25px;}
		.button-rounded {border-radius: 5px;}

		body {
			background-color: #B8FF99;
  			background-image: linear-gradient(to right, #B8FF99,white,#B8FF99);
		}
		a.tripLink {
			text-decoration: none;
			color: black;
		}
		#tripDisplay {
			background-color: rgb(226, 220, 205);
		}
		.applicationDetails {

			background-color: #E2DCCD;
			position: sticky;
			position: -webkit-sticky;
			top: 0;
		}
		#remarks {
			background-color: white;
			margin: 0px 20px 5px 20px;
		}

		@media screen and (max-width: 540px) {
			div.tripSection {
				height: 500px;
				width: 100%;
				overflow-x: hidden;
				overflow-y: auto;
			}
		}
		@media screen and (min-width: 540px) and (max-width: 780px) {
			div.tripSection {
				height: 700px;
				width: 100%;
				overflow-x: hidden;
				overflow-y: auto;
			}
		}
	</style>
	<title>View Application Status</title>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
		<a class="navTitle" href="../VolunteerPage.html">CRS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse  navbar-collapse" id="myNavbar">
			<ul class="navbar-nav mr-auto w-100 justify-content-end">
				<li class="nav-item nav"><a class="nav-link" href="../ManageProfile.php">Manage Profile</a></li>
				<li class="nav-item nav"><a class="nav-link" href="../applyTrip.php">Apply Trip</a></li>
				<li class="nav-item nav"><a class="nav-link" href="#">View Application</a></li>
				<li class="nav-item nav"><a class="nav-link" href="../index.php">Log Out</a></li>
			</ul>
		</div>
	</nav>

	<div class="vertical-space"></div>

	<div class="mb-3">
		<div class="row  g-3">
			<div class="offset-1 col-md-4">
				<h2 class="container text-center mb-3 py-4">Trips Applied by Volunteer</h2>
				<div class="tripSection">

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
						$VolunteerName = $_SESSION['Volunteer'];
						$GetVolunteerQuery = "SELECT * from Volunteer WHERE username='$VolunteerName'";
						$result = $conn->query($GetVolunteerQuery);
						$row = $result->fetch_assoc();
						$VolunteerID = $row['VolunteerID'];

						$getAllTrips = "SELECT * FROM Trip INNER JOIN application ON Trip.tripID=application.tripID WHERE application.VolunteerID='$VolunteerID'";
						$result = $conn->query($getAllTrips);
						if(!$result){
							echo "<div class='container'>
										<div class='vertical-space'></div>
										<p class='text-center'>No any Trip</p>
									</div>";
							//echo "<script>alert('No trips found managed by this staff! ".$result->error."')</script>";
						}
						else if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								echo "<div class='tripLink'>
										<div class='vertical-space'></div>
										<button class='row g-3 border border-dark mb-3' style='background-color: rgb(226, 220, 205);' onclick='changeApplicationView(". $row["tripID"] .")'>";
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
			</div>	
			<div class="col-md-2"></div>
			<div class="col-md-4">
				<h2 class="text-center mb-3 py-4">View Application Status</h2>
				<?php
					$getAllApplication = "SELECT * FROM Application INNER JOIN trip ON application.tripID=Trip.tripID";
					$result = $conn->query($getAllApplication);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<div class='applicationDetails' style='display:none;'>
									<input type='hidden' class='applicationTripID' value='". $row["tripID"] ."'>
									<div class='row'>
										<div class='col-4'>
											<p>Application ID:</p>
											<p>Application Date:</p>
											<p>Trip Name:</p>
											<p>Destination:</p>
											<p>Trip Date:</p>
											<p>Duration:</p>
											<p>Status:</p>
										</div>
										<div class='col-8' id='applicationDetailsOutput'>
											<p id='appID'>".$row["applicationID"]."</p>
											<p id='appDate'>".$row["applicationDate"]."</p>
											<p id='tripIDRight'>". $row["tripID"] ."</p>
											<p id='locationRight'>". $row["location"] ."</p>
											<p id='tripDateRight'>". $row["tripDate"] . "</p>
											<p id='minDurationRight'>". $row["minDuration"] ." days</p>
											<p id='statusRight'>". $row["status"] ."</p>
										</div>
										<div class='col-12'>
											<p>Remarks:</p>";
											if($row['remarks']!=null){
												echo"<p id='remarks'>".$row["remarks"]."</p>";
											}
											else{
												echo"<p id='remarks'>No Remarks</p>";
											}
										echo"</div>
									</div>
								</div>";
						}
					}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function changeApplicationView(tripID){
			var status = document.getElementsByClassName("applicationDetails");
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
	</script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$("#tripDisplay").click(function(){
			$("#locationRight").val($("#tripDestination").val());
		});
	</script>

</body>
</html>