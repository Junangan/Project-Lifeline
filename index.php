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
		<div class="collapse  navbar-collapse" id="myNavbar">
			<ul class="navbar-nav  w-100 justify-content-end">
				<li class="nav-item nav"><a class="navItem1" href="Login.html">Login</a></li>
				<li class="nav-item nav"><a class="navItem2" href="SignUp.html">Sign Up</a></li>
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
				<table class="table table-hover table-light table-bordered">
				<thead class="thead-light" style="background-color:#23415c;">
					<tr>
						<th class="text-center text-truncate" scope="col" >Trip ID</th>
						<th class="text-center text-truncate" scope="col" >Date</th>
						<th class="text-center text-truncate" scope="col" >Duration</th>
						<th class="text-center text-truncate" scope="col" >Description</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$conn = new mysqli ('localhost', 'root', '',"CTIS");

						if($conn->select_db("CRS") == false){
							$CreateDatabase = "CREATE DATABASE CRS";
							$conn->query($CreateDatabase);
							$conn->select_db("CRS");
						}
						else{
							$conn->select_db("CRS");
						}

						$GetAllTripQuery = "SELECT tripID,description,tripDate,minDuration from Trip";
						$result = $conn->query($GetAllTripQuery);
						if(!$result){
						}
						else if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								echo "<tr>";
								echo '<td>'.$row['tripID'].'</td>';
								echo '<td>'.$row['tripDate'].'</td>';
								echo '<td>'.$row['minDuration'].'</td>';
								echo '<td>'.$row['description'].'</td>';
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>