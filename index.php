<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="CSS/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>Crisis Relief Services Information System</title>
</head>
<body >
	<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top" style="border-bottom: 1px solid black;">
		<a class="navTitle" href="#">CRS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse  navbar-collapse" id="myNavbar">
			<ul class="navbar-nav  w-100 justify-content-end">
				<li class="nav-item nav"><a class="nav-link" href="Login.html">Login</a></li>
				<li class="nav-item nav"><a class="nav-link" href="SignUp.html">Sign Up</a></li>
			</ul>
		</div>
	</nav>
	<div class="vertical-space"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div>
					<h2>About Us</h2>
					<div class="vertical-space"></div>
					<p> Crisis Relief Services (CRS) is an NGO (Non Government Organization) that aims to help people who are facing crises arising  from natural disasters such as flood and earthquakes.When a natural disaster occurs, we will organize a trip to the disaster area to provide relief services.  </p>
				</div>
				<div class="vertical-space"></div>
				<div>
					<h2>Our Services</h2>
					<div class="vertical-space"></div>
					<h4>Rescue & Relief</h4>
					<p>Dispatch of organized group to victims of a disastrous event.</p>
					<h4>Human Resource Management</h4>
					<p>Gather and distribute skilled volunteers baesd on demand of a specific crisis event.</p>
					<h4>Volunteer Support</h4>
					<p>Contact for further information and guide in applying trips.</p>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-7 table-responsive">
				<h2 class="text-center">All Trip</h2>
				<div style="height:800px; padding-left:40px; padding-right:40px; overflow: auto;">
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
							echo "<div>
									<div class='vertical-space'></div>
									<div class='row g-3 border border-dark mb-3' style='background-color: rgb(226, 220, 205);'>";
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
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>