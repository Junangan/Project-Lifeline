<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Apply Trip</title>
		<link rel="stylesheet" href="CSS/style.css">
		<style type="text/css">
			#applyTripBody{
			  background-color: #B8FF99;
			  background-image: linear-gradient(to right, #B8FF99,white,#B8FF99);
			}
		</style>
	    <script type="text/javascript" src="JavaScript/script.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body id="applyTripBody">
		<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
			<a class="navTitle" href="VolunteerPage.html">CRS</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="navbar-nav mr-auto w-100 justify-content-end">
					<li class="nav-item"><a class="nav-link" href="ManageProfile.php">Manage Profile</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Apply Trip</a></li>
					<li class="nav-item"><a class="nav-link" href="Volunteer/viewapplicationstatus.php">View Application</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php">Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div>
			<div class="header">
				<h2>All Trip</h1>
			</div>
			<div>
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
							echo "<form class='container' action='PHP/AddApplication.php' method='Post'>
									<div class='vertical-space'></div>
									<div class='row g-3 border border-dark mb-3' style='background-color: rgb(226, 220, 205);'>";
									if($row['crisisType']=='Flood'){
										echo"<div class='col-xl-2 col-md-4'><img src='image/flood.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; 
											width:150px; 
										 	height:100px;'></div>";
									}
									else if($row['crisisType']=='EarthQuake'){
										echo"<div class='col-xl-2 col-md-4'><img src='image/earthquake.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px;'></div>";
									}
									else{
										echo"<div class='col-xl-2 col-md-4'><img src='image/wildfire.jpg' alt='tripImage' style='margin-top:5px; padding-right:10px; width:150px; height:100px;'></div>";
									}
									echo"<div class='col-xl-10 col-md-8'>
											<div class='row'>
												<p class='col-4' id='tripID'>Trip ID: " . $row["tripID"] . "</p>
												<input type='hidden' value=". $row["tripID"] ." name='tripID' id='tripID' />
												<p class='col-4' id='tripIdDate'>Trip Date: " . $row["tripDate"] . "</p>
												<p class='col-4' id='description'>Description: ". $row["description"]."
												</p>
												<p class='col-4' id='tripStatus'>Type: " . $row["crisisType"] . "
												</p>
												<p class='col-4' id='tripDestination'>Destination: ". $row["location"] ."</p>
												<p class='col-4' id='Requirement'>Requirement: ". $row["requirements"] ."</p>
												<p class='col-4' id='tripParticipants'>Participant needed: " . $row["numVolunteer"] . "</p>
												<p class='col-4' id='tripDuration'>Duration: " . $row["minDuration"] . "</p>
												<input class='col-3 btn btn-primary ' type='submit' id='apply trip' value='Apply this trip' style='height:35px; margin-top:-5px;'>	
											</div>							
										</div>
									</div>
								</form>";
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