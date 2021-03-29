<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../CSS/style.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style>
		.vertical-space {height: 25px;}
		.button-rounded {border-radius: 5px;}

    body {
      background-color: #B8FF99;
        background-image: linear-gradient(to right, #B8FF99,white,#B8FF99);
    }

    .Expand{
      cursor: pointer;
    }

    .Expand:hover{
      background-color: #d1ccbe;
    }
	</style>
	<title>Manage Application</title>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
    <a class="navTitle" href="../CRSStaffPage.html">CRS</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
     <div class="collapse  navbar-collapse" id="myNavbar">
       <ul class="navbar-nav  w-100 justify-content-end">
        <li class="nav-item"><a class="nav-link" href="organizetrip.html">Organize Trip</a></li>
        <li class="nav-item"><a class="nav-link" href="staffmenu.php">Manage Application</a></li>
        <li class="nav-item"><a class="nav-link" href="../index.php">Log Out</a></li>
       </ul>
    </div>
  </nav>
  <h1 class="container text-center mb-3 py-4">Manage Application</h1>
  <div class="vertical-space"></div>
  <div class="container mb-3">
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

    $applicationID = $_POST['applicationID'];

    $getApplication = "SELECT * FROM Application INNER JOIN Volunteer ON Application.VolunteerID=Volunteer.VolunteerID WHERE applicationID='$applicationID'";
    $result = $conn->query($getApplication);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      echo'<form action="../PHP/ManageApplication.php" method="Post">
          <div class="row">
            <div class="col-6">
              <input type="hidden" name="tripID" value="'.$row["tripID"].'">
              <p class="pb-5">Application ID: '.$row["applicationID"].'</p>
              <input type="hidden" value="'.$row["applicationID"].'" name="applicationID" id="applicationID">
              <p class="pb-5">Application Date: '.$row["applicationDate"].'</p>
              <div class="pt-4 row g-3 align-items-center" style="margin-top:25px;">
                <div class="col-2">
                  <label for="status" class="col-form-label">Status:</label>
                </div>
                <div class="col-10">
                <select class="form-control col-8" name="status" id="status" style="border: 1px solid black" required>';
                  if($row["status"] == 'REJECTED'){
                    echo '<option value="">Pending</option>
                          <option value="ACCEPTED">Accepted</option>
                          <option value="REJECTED" selected>Rejected</option>';
                  }
                  else if($row["status"] == 'ACCEPTED'){
                    echo '<option value="">Pending</option>
                          <option value="ACCEPTED" selected>Accepted</option>
                          <option value="REJECTED">Rejected</option>';
                  }
                  else{
                    echo '<option value="">Pending</option>
                          <option value="ACCEPTED">Accepted</option>
                          <option value="REJECTED">Rejected</option>';
                  }
                echo'</select>
                </div>
              </div>
            </div>
            <div class="col-6">';
                $volunteerID=$row["VolunteerID"];
                $getDocument = "SELECT * FROM Document INNER JOIN Volunteer ON Document.VolunteerID=Volunteer.VolunteerID WHERE Document.VolunteerID='$volunteerID'";
                $result = $conn->query($getDocument);
                if(!$result || $result->num_rows <= 0){
                    echo' <div class="row p-3" style="background-color: white; border:1px solid black">
                     <div class="col-7">
                      <p class="p-3 pr-2">Document ID: None</p>
                      <p class="p-3 pr-2">Document Type: None</p>
                      <p class="p-3 pr-2">Expiry Date: None</p>
                    </div>
                    <div class="col-3">
                      <div class="pt-5" style="text-align: center; border:1px solid black; margin-top:50px; padding-right:px; width:150px; height:120px;"><p>No image</p></div>
                    </div>
                    </div>';
                }
                else if($result->num_rows > 0){
                  while($Documentrow = $result->fetch_assoc()){
                    echo'<div class="row p-3" style="background-color: white; border:1px solid black">
                      <div class="col-7">
                        <p class="p-3 pr-2">Document ID: '.$Documentrow["documentID"].'</p>
                        <p class="p-3 pr-2">Document Type: '.$Documentrow["documentType"].'</p>
                        <p class="p-3 pr-2">Expiry Date: '.$Documentrow["expiryDate"].'</p>
                      </div>
                      <div class="col-5">
                        <div class="pt-5"><a href="../image/'.$Documentrow["username"].'/'.$Documentrow["image"].'" target="_blank"><img src="../image/'.$Documentrow["username"].'/'.$Documentrow["image"].'" alt="tripImage" style="border:1px solid black; margin-top:5px; padding-right:10px; width:150px; height:100px;""></a></div>
                      </div>
                      </div>
                      <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                      </div>
                      ';

                    }
                }
                // <div class="col-2">
                //         <div class="pt-5 pl-3"><p class="Expand border border-dark" style="width:60px; margin-top:25px; onclick="">Expand image</p></div>
                //       </div>
              echo'<div class="mt-5 mb-3">
                    <label for="remark" class="form-label">Remark:</label>
                    <textarea class="form-control" name="remark" id="remarks" style="height: 125px; border: 1px solid black">'.$row["remarks"].'</textarea>
                  </div>
              </div>
          </div>
          <div class="button row">
            <input type="submit" class="btn offset-md-3 offset-lg-4 col-lg-4 col-md-6 col-12 btn-primary" name="submit" value="Submit Review">
          </div>
      </form>';
    }
    ?>
  </div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>