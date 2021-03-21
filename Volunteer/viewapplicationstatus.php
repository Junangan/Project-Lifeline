<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		html {scroll-behavior: smooth;}
		.vertical-space {height: 25px;}
		.button-rounded {border-radius: 5px;}

		a.tripLink {
			text-decoration: none;
			color: black;
		}
		#tripDisplay {
			background-color: rgb(226, 220, 205);
			width: 100%;
		}
		#applicationDetails {
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
	<nav class="navbar navbar-expand bg-light primary">
		<a class="navbar-brand px-3" href="../index.php">CRSIS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end px-3" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">About</a>
					</li>
					<!-- TEMP NAV DIRECTORY -->
					<li class="nav-item">
						<a class="nav-link" href="applytrip.html">Apply Trip</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="managevolunteerprofile.html">Manage Profile</a>
					</li>
					<!-- TEMP NAV DIRECTORY END -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
						<div class="dropdown-menu bg-light" aria-labelledby="navbarDropdownLogin" id="dropdownLogin">
						<input class="form-control dropdown-item black-50" type="" name="" placeholder="Username">
						<input class="form-control dropdown-item black-50" type="" name="" placeholder="Password">
							<a class="dropdown-item" href="#" for="dropdownLogin" type="submit" method="POST">Login</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../signup.html">Sign Up</a>
					</li>
				</ul>
			</div>
	</nav>

	<div class="vertical-space"></div>

	<div class="container mb-3">
		<div class="row g-3">
			<div class="col-md-5">
				<h2 class="container text-center mb-3 py-4">Trips Applied by Volunteer</h2>
				<div class="tripSection">

					<?php
						$tripArray = array(
										$trip[] = ["tripID" => "Trip1", "crisisType" => "FLOOD", "tripDate" => "12-6-2020", "location" => "Selangor", "minDuration" => 5, "numVolunteers" => 4, "description" => "flood in town", "requirements" => "swimming certs"],
										$trip[] = ["tripID" => "Trip2", "crisisType" => "WILDFIRE", "tripDate" => "12-8-2020", "location" => "Melaka", "minDuration" => 16, "numVolunteers" => 8, "description" => "wildfire in rainforest", "requirements" => "fire rescue certs"],
										$trip[] = ["tripID" => "dummyTrip", "crisisType" => "dummyType", "tripDate" => "dummyDate", "location" => "dummyLocation", "minDuration" => 0, "numVolunteers" => 0, "description" => "dummyDescription", "requirements" => "dummyRequirements"],
										$trip[] = ["tripID" => "dummyTrip", "crisisType" => "dummyType", "tripDate" => "dummyDate", "location" => "dummyLocation", "minDuration" => 0, "numVolunteers" => 0, "description" => "dummyDescription", "requirements" => "dummyRequirements"],
										$trip[] = ["tripID" => "dummyTrip", "crisisType" => "dummyType", "tripDate" => "dummyDate", "location" => "dummyLocation", "minDuration" => 0, "numVolunteers" => 0, "description" => "dummyDescription", "requirements" => "dummyRequirements"],
										$trip[] = ["tripID" => "dummyTrip", "crisisType" => "dummyType", "tripDate" => "dummyDate", "location" => "dummyLocation", "minDuration" => 0, "numVolunteers" => 0, "description" => "dummyDescription", "requirements" => "dummyRequirements"],
										$trip[] = ["tripID" => "dummyTrip", "crisisType" => "dummyType", "tripDate" => "dummyDate", "location" => "dummyLocation", "minDuration" => 0, "numVolunteers" => 0, "description" => "dummyDescription", "requirements" => "dummyRequirements"]
									);


						foreach ($tripArray as $trip) {
							echo "<div class='container' id='tripDisplay'>
									<div class='vertical-space'></div>
									<a class='tripLink' href=''>
										<div class='row g-3 border border-dark mb-3'>
											<div class='col-md-3 text-center'><img src='' alt='tripImage'></div>
											<div class='col-md-9'>
												<div class='row'>
													<p class='col-12' id='tripIdDate'>Crisis Trip Title - " . $trip["tripDate"] . "</p>
													<p class='col-5' id='tripStatus'>Status: " . $trip["crisisType"] . "</p>
													<p class='col-7' id='tripDestination'>Destination: ". $trip["location"] ."</p>
													<p class='col-12' id='tripParticipants'>Number of participants: " . $trip["numVolunteers"] . "</p>	
												</div>							
											</div>
										</div>
									</a>
								</div>";
						}
					?>
				</div>		
			</div>	
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<h2 class="container text-center mb-3 py-4">View Application Status</h2>
				<?php
					$volunteer = ["name" => "Adam", "dateOfBirth" => "14/6/1993", "gender" => "male"];
					$application =["applicationID" => "app1", "applicationDate" => "6/4/2020", "status" => "REJECTED", "remarks" => "Upload passport picture again"];
					/*$selectedTrip = ["tripID" => "Trip1", "crisisType" => "FLOOD", "tripDate" => "12-6-2020", "location" => "Selangor", "minDuration" => 5, "numVolunteers" => 4, "description" => "flood in town", "requirements" => "swimming certs"];*/

					/*<p id='tripIDRight'>".$selectedTrip["tripID"]."</p>
					<p id='locationRight'>".$selectedTrip["location"]."</p>
					<p id='tripDateRight'>".$selectedTrip["tripDate"]."</p>
					<p id='minDurationRight'>".$selectedTrip["minDuration"]." days</p>
					<p id='statusRight'>".$selectedTrip["crisisType"]."</p>*/

					echo "<div id='applicationDetails'>
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
										<p id='appID'>".$application["applicationID"]."</p>
										<p id='appDate'>".$application["applicationDate"]."</p>
										<p id='tripIDRight'></p>
										<p id='locationRight'></p>
										<p id='tripDateRight'></p>
										<p id='minDurationRight'> days</p>
										<p id='statusRight'></p>
									</div>
									<div class='col-12'>
										<p>Remarks:</p>
										<p id='remarks'>".$application["remarks"]."</p>
									</div>
								</div>
							</div>";
				?>
			</div>
		</div>
	</div>
	

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