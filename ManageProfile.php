<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Manage Profit</title>
		<link rel="stylesheet" href="CSS/style.css">
	    <script type="text/javascript" src="JavaScript/script.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body class="text-black">
		<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
			<a class="navTitle" href="VolunteerPage.html">CRS</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="navbar-nav mr-auto w-100 justify-content-end">
					<li class="nav-item"><a class="nav-link" href="#">Manage Profile</a></li>
					<li class="nav-item"><a class="nav-link" href="applyTrip.php">Apply Trip</a></li>
					<li class="nav-item"><a class="nav-link" href="#">View Application</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php">Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="body">
			<div class="container">
				<div class="header">
					<h1>Manage Profile</h1>
				</div>
				<div id="manageProfileForm">
					<form action="PHP/ManageVolunteerProfile.php" method="Post" onsubmit="return Volunteer_Validate()">
						<div class="form-row">
							<?php
								session_start();
								$conn = new mysqli ('localhost', 'root', '',"CRS");
								$VolunteerName = $_SESSION['Volunteer'];
								$GetUserQuery = "SELECT * from User WHERE username='$VolunteerName'";
								$result = $conn->query($GetUserQuery);
								$row = $result->fetch_assoc();
								$GetVolunteerQuery = "SELECT * from Volunteer WHERE username='$VolunteerName'";
								$volunteerresult = $conn->query($GetVolunteerQuery);
								$volunteerrow = $volunteerresult->fetch_assoc();
									echo'<div class="col-xl-6">
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="NewVolunteername">Username:</label>
													<input class="form-control" type="text" name="username" id="NewVolunteername" placeholder="Enter username" value="'.$row["username"].'" disabled="true">
												</div>
												<div class="form-group col-md-6">
													<label for="NewVolunteerpassword">Password:</label>
													<input class="form-control" type="password" name="password" id="NewVolunteerpassword" placeholder="Enter password" value="'.$row["password"].'" required>
												    <div class="custom-control">
													   	<input type="checkbox" id="showPassword" class="form-check-input" onclick="ManageProfitshowPassword()">
														<label class="form-check-label" for="showPassword">Show Password</label>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="NewVolunteerFullname">Full name:</label>
													<input class="form-control" type="text" name="realName" id="NewVolunteerFullname" placeholder="Enter real name" value="'.$row["name"].'" required>
												</div>
												<div class="form-group col-md-6">
													<label for="NewVolunteerPhoneNumber">Phone:</label>
													<input class="form-control" type="text" name="phoneNumber" id="NewVolunteerPhoneNumber" placeholder="Enter phone number" value="'.$row["phone"].'" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="VolunteerCredential">Credentials (optional):</label>
													<div class="input-group-prepend">
														<select class="form-control col-3" name="CredentialType" id="CredentialType">';
														if($volunteerrow["credentialType"] == 'Passport'){
															echo '<option value="">Type</option>
															<option value="Passport" selected>Passport</option>
															<option value="IC">IC</option>';
														}
														else if($volunteerrow["credentialType"] == 'IC'){
															echo '<option value="">Type</option>
															<option value="Passport">Passport</option>
															<option value="IC" selected>IC</option>';
														}
														else{
															echo '<option value="">Type</option>
															<option value="Passport">Passport</option>
															<option value="IC">IC</option>';
														}
														echo '</select>
														<input class="form-control col-9" type="text" name="Credential" id="VolunteerCredential" value="'.$volunteerrow["credentials"].'" placeholder="Enter number">
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="VolunteerBirthday">Date of birth (optional):</label>
													<input class="form-control" type="date" name="Birthday" value="'.$volunteerrow["dateOfBirth"].'" id="VolunteerBirthday">
												</div>
												<div class="form-group col-md-6">
													<label for="Volunteergender">Gender (optional):</label>
													<select class="form-control" name="Gender" id="Volunteergender">';
													if($volunteerrow["gender"] == 'Male'){
															echo '<option value="">Select Gender</option>
														<option value="Male" selected>Male</option>
														<option value="Female">Female</option>';
														}
														else if($volunteerrow["gender"] == 'Female'){
															echo '<option value="">Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female" selected>Female</option>';
														}
														else{
															echo '<option value="">Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>';
														}
													echo '</select>
												</div>
											</div>
										</div>';
							?>
							<div class="col-xl-6">
								<div class="custom-control">
									<input type="checkbox" class="form-check-input" onclick="showUploadDocument()">
									<label class="form-check-label" for="showUploadDocument">Upload Document</label>
								</div>
								<fieldset id="DocumentUpload" class="fieldset" disabled="true">
									<div class="form-row">
										<div class="form-group col-xl-12 col-md-6">
											<label for="DocumentType">Document Type:</label>
											<select class="custom-select" name="DocumentType" id="DocumentType" required>
												<option value="">Select Document Type</option>
										    	<option value="Passport">Passport</option>
										    	<option value="Certificate">Certificate</option>
										    	<option value="Visa">Visa</option>
										    </select>
										</div>
										<div class="form-group col-xl-12 col-md-6">
											<label for="ExpiryDate">Expiry Date:</label>
											<input class="form-control" type="date" name="ExpiryDate" id="ExpiryDate" placeholder="expiry date" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="image">File:</label>
											<input class="form-control" type="file" name="image" id="image" accept="iamge/*" required>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="button form-row">
							<div class="col-xl-4 col-md-6 offset-xl-2">
								<input type="submit" class="btn btn-block btn-primary"  name="submit" value="Save Change">
							</div>
							<div class="col-xl-4 col-md-6">
								<input type="reset" class="btn btn-block btn-danger" name="reset" value="Reset">
							</div>
						</div>
					</form>
				</div>
				<div class="back row">
					<input type="button" class="btn btn-block col-4 offset-md-4" value="Back To Volunteer Page" onclick="document.location='VolunteerPage.html'">
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>