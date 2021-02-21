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
	<body class="p-3 mb-2 bg-white text-black">
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
			<div class="container">

				  <a class="navbar-brand" href="#">CRS</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="myNavbar">
				     <ul class="navbar-nav mr-auto w-100 justify-content-end">
					<li class="nav-item"><a class="nav-link text-white" href="MainPage.html">Log Out</a></li>
				</ul>
				  </div>
		  </div>
		</nav>
		<div class="container">
			<form class="row justify-content-md-center" action="PHP/ManageVolunteerProfit.php" method="Post" onsubmit="return Volunteer_Validate()">
				<div class="col">
					<h1>Manage Profit</h1>
					<?php
						session_start();
						$conn = new mysqli ('localhost', 'root', '',"CRS");
						$VolunteerName = $_SESSION['Volunteer'];
						$GetUserQuery = "SELECT * from User WHERE username='$VolunteerName'";
						$result = $conn->query($GetUserQuery);
							$row = $result->fetch_assoc();
							echo '<div class="form-row">
									<div class="form-group col-md-6">
									<label for="NewVolunteername">Username:</label>
									<input class="form-control" type="text" name="username" id="NewVolunteername" placeholder="Username" value="'.$row["username"].'" disabled="true">
								</div>
								<div class="form-group col-md-6">
									<label for="NewVolunteerpassword">Password:</label>
									<input class="form-control" type="password" name="password" id="NewVolunteerpassword" placeholder="Password" value="'.$row["password"].'" required>
								    <div class="custom-control">
									   	<input type="checkbox" id="showPassword" class="form-check-input" onclick="ManageProfitshowPassword()">
										<label class="form-check-label" for="showPassword">Show Password</label>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="NewVolunteerFullname">Full name:</label>
									<input class="form-control" type="text" name="realName" id="NewVolunteerFullname" placeholder="full name" value="'.$row["name"].'" required>
								</div>
								<div class="form-group col-md-6">
									<label for="NewVolunteerPhoneNumber">Phone:</label>
									<input class="form-control" type="text" name="phoneNumber" id="NewVolunteerPhoneNumber" placeholder="phone number" value="'.$row["phone"].'" required>
								</div>
							</div>';
					?>
					<div class="custom-control">
						<input type="checkbox" class="form-check-input" onclick="showUploadDocument()">
						<label class="form-check-label" for="showUploadDocument">Upload the Document</label>
					</div>
					<fieldset id="DocumentUpload" class="fieldset" disabled="true">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="DocumentType">document Type:</label>
								<select class="custom-select" name="DocumentType" id="DocumentType" required>
									<option value="">Select</option>
							    	<option value="Passport">Passport</option>
							    	<option value="Certificate">Certificate</option>
							    	<option value="Visa">Visa</option>
							    </select>
							</div>
							<div class="form-group col-md-6">
								<label for="ExpiryDate">expiry Date:</label>
								<input class="form-control" type="date" name="ExpiryDate" id="ExpiryDate" placeholder="expiry date" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="image">Document:</label>
								<input class="form-control" type="file" name="image" id="image" accept="iamge/*" required>
							</div>
						</div>
					</fieldset>
					<div class="button">
						<input type="submit" name="submit" value="Submit">
						<input type="reset" name="reset" value="Reset">
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-sm-12">
					<input type="button" name="backToManager" value="Back To Manager Page" onclick="document.location='CRSManagerPage.html'">
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>