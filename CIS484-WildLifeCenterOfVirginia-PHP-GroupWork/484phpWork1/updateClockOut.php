<!DOCTYPE html>

<?php
//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType']; 

//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Volunteer"){
	header("Location: restrictedAccess.php");
	exit();
}

*/




if(isset($_POST['btnUpdate'])){
	
	$newTime = $_POST["clockout"];
	$idEntered = $_POST["uniqueid"];
	
	//Update Clockout time based on the Id entered and new time entered
	$server = "localhost";
	$user = "root";
	$password = "Twspike1994?";
	$database = "wildlife";
	$conn = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) 
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if(!mysqli_select_db($conn, 'wildlife'))
	{
	   echo "Database Not Selected";
	}

	//SQL Statement to update Clock Out time
	$query = "UPDATE LogHours SET LogHours_EndTime = '" . $newTime ."' WHERE LogHours_ID = " . $idEntered;

	if(!mysqli_query($conn,$query))

	{
		echo("Error description: " . mysqli_error($conn));
	}

	else
	{
		$query = "UPDATE LogHours SET LogHours_DayHours = ROUND((TIMESTAMPDIFF(HOUR, LogHours_BeginTime, LogHours_EndTime)/60),2) WHERE LogHours_ID =" .$idEntered;
		mysqli_query($conn, $query) or die(mysqli_error($conn)); 
				
		header("Location: updateConfirmation.php");
		exit();
	}
	
}
 
?>





<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Wildlife Center of Virginia Volunteers</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" media="screen" href="css/style.css" />

</head>
<body class="login">
    <div class="login-box main-content panel panel-default">
      <header class="panel-heading"><img src="../484phpWork1/images/logo_small.png" alt="Wildlife Logo"></header>
    	  <form id="form" method="post" class="form-horizontal">
    			<div class="form-group">
    			  <div class="col-sm-12">
				  <p>Enter the Unique ID
      				<input type="text" id="uniqueid"  class="form-control" value="" name="uniqueid" required="required" placeholder="Unique ID" />
    				</div>
    			</div>
    			<div class="form-group">
    			  <div class="col-sm-12">
				  <p> Enter correct date &amp time

      				<input type="datetime-local" id="date" class="form-control" value="" name="clockout" required="required" />
      			</div>
    			</div>
    			<div class="form-group">
    			  <div class="col-sm-2 col-sm-offset-4">
      				<button ID="btnLogIn" name="btnUpdate" class="btn btn-default" type="submit">Update</button>
      			</div>
      		</div>
</form>

<!--clock out form-->
<form id="form" action="index.php" method="post" class="form-horizontal">

          <div class="form-group">
            <div class="col-sm-2 col-sm-offset-3">
              <button class="btn btn-default" type="submit">Return to Login Screen</button>
            </div>
          </div>
</form>
    		
    	</section>
    </div>
</body>
</html>