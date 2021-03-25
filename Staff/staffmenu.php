<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		.vertical-space {height: 25px;}
		.button-rounded {border-radius: 5px;}
		#tripDisplay {background-color: rgb(226, 220, 205);}
		#applicationList {
			background-color: #E2DCCD;
			padding: 4px 10px;
		}
		.appSection {
			border-style: black 1px;
			background-color: grey;
		}
		a.tripLink {
			text-decoration: none;
			color: black;
		}
		a.tripLink:hover {
			/*either glow/darken/brighten or slightly pop up*/
		}
		a.appLink {
			text-decoration: none;
			color: black;
		}
		a.appLink:hover {
			/*either glow/darken/brighten or slightly pop up*/
		}
	</style>
	<title>Staff Menu</title>
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
						<a class="nav-link" href="#">Manage Applications</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="organizetrip.html">Organize Trip</a>
					</li>
					<!-- TEMP NAV DIRECTORY END -->
					<li class="nav-item">
						<a class="nav-link" href="../PHP/signOut.php">Sign Out</a>
					</li>
				</ul>
			</div>
	</nav>

	<div class="container mb-3">
		<div class="row g-3">
			<div class="col-md-5">
				<h2 class="container text-center mb-3 py-4">Trips handled by Staff <span id="staffName" value="xx"></span></h2>
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

					/*Not good practice for replacing $staffID with every statement, trying to convert from object to array to string type data...*/
					$getStaffIDByStaffUnameQ = "SELECT StaffID FROM Staff WHERE Username='$StaffUname'";
					$staffID =  $conn->query($getStaffIDByStaffUnameQ);
					$staffID = $staffID->fetch_assoc();
					$staffID = $staffID['StaffID'];


					$getTripsByStaffIDQ = "SELECT * FROM Trip WHERE StaffID='$staffID'";
					$result = $conn->query($getTripsByStaffIDQ);
					if(!$result){
						echo "<script>alert('No trips found managed by this staff! ".$conn->error."')</script>";
					}
					else if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<div class='container' id='tripDisplay'>
									<div class='vertical-space'></div>
									<a class='tripLink' href='#' id='".$row["tripID"]."'>
										<div class='row g-3 border border-dark mb-3'>
											<div class='col-md-3 text-center'><img src='' alt='tripImage'></div>
											<div class='col-md-9'>
												<div class='row'>
													<p class='col-12' id='tripIdDate'>Crisis Trip Title - " . $row["tripDate"] . "</p>
													<p class='col-5' id='tripStatus'>Status: " . $row["crisisType"] . "</p>
													<p class='col-7' id='tripDestination'>Destination: ". $row["location"] ."</p>
													<p class='col-12' id='tripParticipants'>Number of participants: " . $row["numVolunteer"] . "</p>	
												</div>							
											</div>
										</div>
									</a>
								</div>";
						}
					}

					
				?>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<h2 class="container text-center mb-3 py-4">Applications from the Trip</h2>
				<div class="container" id="applicationList">
					<?php
/*						$volArray = array(
										$volunteer[] = ["name" => "Adam", "dateOfBirth" => "14/6/1993", "gender" => "male"],
										$volunteer[] = ["name" => "Joseph", "dateOfBirth" => "14/1/1989", "gender" => "male"]
									);

						$appArray = array(
										$application[] =["applicationID" => "app1", "applicationDate" => "6/4/2020", "status" => "REJECTED", "remarks" => "Upload passport picture again"],
										$application[] =["applicationID" => "app2", "applicationDate" => "14/5/2020", "status" => "ACCEPTED", "remarks" => "All documents accepted"]
									);

						$i=0;
						foreach ($appArray as $application) {
							echo '<div class="appSection my-2">
									<table class="table table-borderless">
										<tr>
											<td>Name:</td>
											<td id="name">'.$volunteer[$i]["name"].'</td>
											<td>Date of Birth:</td>
											<td id="dateOfBirth">'.$volunteer[$i]["dateOfBirth"].'</td>
										</tr>
										<tr>
											<td>Date:</td>
											<td id="applicationDate">'.$application["applicationDate"].'</td>
											<td>Gender:</td>
											<td id="gender">'.$volunteer[$i]["gender"].'</td>
										</tr>
										<tr>
											<td colspan="4" class="text-end fw-bold">Status: '.$application["status"].'</td>
										</tr>
									</table>
								</div>';
							$i++;
						}
*/
						/*header("Content-Type: application/json; charset=UTF-8");
						$tripID = $_POST["tripID"];
						$tripID = json_decode($tripID, false);*/


						$getAppAndVolFromTripIDQ = "SELECT * FROM Application JOIN Volunteer ON Application.VolunteerID=Volunteer.VolunteerID WHERE Application.tripID = '$tripID'";
						$result = $conn->query($getAppAndVolFromTripIDQ);
						if (!$result) {
							echo $conn->error;
						} else if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo '<div class="appSection my-2">
									<a class="appLink" href="#" value="'.$row["applicationID"].'">
										<table class="table table-borderless">
											<tr>
												<td>Name:</td>
												<td id="name">'.$row["name"].'</td>
												<td>Date of Birth:</td>
												<td id="dateOfBirth">'.$row["dateOfBirth"].'</td>
											</tr>
											<tr>
												<td>Date:</td>
												<td id="applicationDate">'.$row["applicationDate"].'</td>
												<td>Gender:</td>
												<td id="gender">'.$row["gender"].'</td>
											</tr>
											<tr>
												<td colspan="4" class="text-end fw-bold">Status: '.$row["status"].'</td>
											</tr>
										</table>
									</a>
								</div>';
							}
						}

						$conn->close();
						
					?>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script>
		/*create cookie with value tripID*/
/*		$(".tripLink").click(function(){
			var tripID = $(this).val();	// current value on the link (tripID)
			document.cookie = "tripID: "+tripID;
			location.reload();
		});*/
		/*create JSON with value tripID*/
		$(".tripLink").click(function(){
			var tripID = $(this).attr("id");	// current id on the link (tripID)
			alert("tripID: "+tripID);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200) {
    				// console.log(xhttp.responseText);
    			}
    		};
			xhttp.open('POST','viewapplicationstatus.php', {tripID : tripID});
			xhttp.send();
			// location.reload();
		});

		$(".appLink").click(function(){
			var appID = $(this).attr("id");
			alert("appID: "+appID);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200) {
    				// console.log(xhttp.responseText);
    			}
    		};
			xhttp.open('POST','viewapplicationstatus.php', {appID : appID}, true);
			xhttp.send();
		}

	</script>
</body>
</html>