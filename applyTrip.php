<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Apply Trip</title>
		<link rel="stylesheet" href="CSS/style.css">
	    <script type="text/javascript" src="JavaScript/script.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body id="ApplyTripBody" class="text-black">
		<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
			<a class="navTitle" href="VolunteerPage.html">CRS</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="navbar-nav mr-auto w-100 justify-content-end">
					<li class="nav-item"><a class="nav-link" href="ManageProfile.php">Manage Profile</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Apply Trip</a></li>
					<li class="nav-item"><a class="nav-link" href="#">View Application</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php">Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div id="ApplyTripForm" class="offset-lg-4 offset-md-3 offset-2 col-8 col-md-6 col-lg-4">
			<div class="header">
				<h1>Apply Trip</h1>
			</div>
			<form action="PHP/AddApplication.php" method="Post" onsubmit="return apply_Validation()">
				<div class="m-4 form-group">
					<label for="TripID">Trip ID:</label>
					<input class="form-control" type="number" name="tripID" id="TripID" placeholder="Enter trip ID to apply" required>
				</div>
				<div class="button form-row">
					<div class="col-md-6 offset-md-3">
						<input type="submit" class="btn btn-block btn-primary"  name="submit" value="Enter">
					</div>
				</div>
			</form>
		</div>
		<div class="mb-5 back">
			<input type="button" class="btn btn-block col-lg-2 col-md-4 offset-md-4 offset-2 col-8 offset-lg-5" value="Back" onclick="document.location='VolunteerPage.html'">
		</div>
		<div class="m-3">
			<div class="header">
				<h2>All Trip</h1>
			</div>
			<div style="height:295px; padding-left:40px; padding-right:40px; overflow: auto;">
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

					$getAllTrips = "SELECT * FROM Trip";
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
							echo "<div class=''>
									<div class='vertical-space'></div>
									<div class='row g-3 border border-dark mb-3'>";
									if($row['crisisType']=='Flood'){
										echo"<div class='col-lg-3 col-md-4'><img src='image/flood.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px;'></div>";
									}
									else if($row['crisisType']=='EarthQuake'){
										echo"<div class='col-lg-3 col-md-4'><img src='image/earthquake.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px;'></div>";
									}
									else{
										echo"<div class='col-lg-3 col-md-4'><img src='image/wildfire.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px;'></div>";
									}
									echo"<div class='col-lg-9 col-md-8'>
											<div class='row'>
												<p class='col-6' id='tripId'>Trip ID: " . $row["tripID"] . "</p>
												<p class='col-6' id='tripIdDate'>Trip Date: " . $row["tripDate"] . "</p>
												<p class='col-6' id='tripStatus'>Type: " . $row["crisisType"] . "</p>
												<p class='col-6' id='tripDestination'>Destination: ". $row["location"] ."</p>
												<p class='col-6' id='tripParticipants'>Participant needed: " . $row["numVolunteer"] . "</p>
												<p class='col-6' id='tripDuration'>Duration: " . $row["minDuration"] . "</p>	
											</div>							
										</div>
									</div>
								</div>";
						}
					}

					
				?>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>