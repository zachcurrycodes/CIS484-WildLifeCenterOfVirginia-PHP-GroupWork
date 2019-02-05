<!DOCTYPE html>


<?php
//DO NOT MOVE. KEEP AT TOP
// destroy the session
session_start(); 
session_destroy();
//start new session
session_start();
/****************************************
	START ClockIn CODE 
****************************************/

//Clockin validation and action
 if(isset($_POST['btnClockIn']) && ($_POST['usernameClockIn'] != "")){
	$servername = "localhost";
	$username = "root";
	$dbpassword = "Twspike1994?";
	$dbname = "wildlife";

	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//SQL Statement to gather info
	$sql = "SELECT Person_ID, Person_Email, Person_UserType FROM Person WHERE Person_Email = '" . $_POST['usernameClockIn'] . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$personID = $row['Person_ID'];
			$user = $row['Person_Email'];
			$userType = $row['Person_UserType'];
		}
		
		if($userType == "Volunteer" ){														
			$query = "INSERT INTO LogHours(LogHours_PersonID,LogHours_BeginTime, LastModifiedBy, LastModifiedDate) VALUES(" . $personID . ",NOW(),".$personID.",NOW())";
			mysqli_query($conn, $query) or die(mysqli_error($conn));
								
			
			header("Location: clockin.php");
			exit();
		}
		else {
		// Not a volunteer, show an error
		$message = 'Error. Please try again. Volunteer use only';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
		}
	}
	else {
	 // passwords didn't match, show an error
		$message = 'Username incorrect. Please use your email address for your Username.';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
	}
	$conn->close();
 }
 /****************************************
	END ClockIn CODE 
****************************************/
/****************************************
	START ClockOut CODE 
****************************************/

//Clockout validation and action
 if(isset($_POST['btnClockOut']) && ($_POST['usernameClockIn'] != "")){
	$servername = "localhost";
	$username = "root";
	$dbpassword = "Twspike1994?";
	$dbname = "wildlife";

	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//SQL Statement to gather info
	$sql = "SELECT Person_ID, Person_Email, Person_UserType FROM Person WHERE Person_Email = '" . $_POST['usernameClockIn'] . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$personID = $row['Person_ID'];
			$user = $row['Person_Email'];
			$userType = $row['Person_UserType'];
		}
		
		if($userType == "Volunteer" ){											
			
			
			$sql = "SELECT MAX(LogHours_ID) FROM LogHours WHERE LogHours_PersonID = " . $personID;
			$result = $conn->query($sql);
			if ($result->num_rows > 0){
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$logID = $row['MAX(LogHours_ID)'];
					
				}
				$query = "UPDATE LogHours SET LogHours_EndTime = NOW(), LastModifiedBy = ".$personID.", LastModifiedDate = NOW() WHERE LogHours_ID =" . $logID;
				mysqli_query($conn, $query) or die(mysqli_error($conn));
				//Set total hours for the day
				$query = "UPDATE LogHours SET LogHours_DayHours = ROUND((TIMESTAMPDIFF(MINUTE, LogHours_BeginTime, LogHours_EndTime)/60),2) WHERE LogHours_ID =" .$logID;
				mysqli_query($conn, $query) or die(mysqli_error($conn));
				//Set total hours for lifetime
				$sql = "SELECT SUM(LogHours_DayHours) FROM LogHours WHERE LogHours_PersonID = " . $personID;
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$hours = $row['SUM(LogHours_DayHours)'];
						
					}
					$query = "UPDATE LogHours SET LogHours_TotalHours = '$hours' WHERE LogHours_PersonID =" .$personID;
					mysqli_query($conn, $query) or die(mysqli_error($conn));
				}
				//Set YTD Hours
				$sql = "SELECT SUM(LogHours_DayHours) FROM LogHours WHERE (LogHours_PersonID = " . $personID.") AND (YEAR(LogHours_BeginTime) = YEAR(CURDATE()))";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$ytdHours = $row['SUM(LogHours_DayHours)'];
						
					}
					$query = "UPDATE LogHours SET LogHours_YTDHours = '$ytdHours' WHERE LogHours_PersonID =" .$personID;
					mysqli_query($conn, $query) or die(mysqli_error($conn));
				}
				
				header("Location: clockin.php");
				exit();
			}
			
		}
		else {
		// Not a volunteer, show an error
		$message = 'Error. If you are a transporter, please use the Transporter form.';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
		}
	}
	else {
	 // passwords didn't match, show an error
		$message = 'Username incorrect. Please use your email address for your Username.';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
	}
	$conn->close();
 }
 /****************************************
	END ClockOut CODE 
****************************************/
 /****************************************
	START Transporter CODE 
****************************************/
//Clockin validation and action
 if(isset($_POST['btnTransporter']) && ($_POST['usernameTransporter'] != "")){
	$servername = "localhost";
	$username = "root";
	$dbpassword = "Twspike1994?";
	$dbname = "wildlife";

	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//SQL Statement to gather hash
	$sql = "SELECT Person_ID, Person_Email, Person_UserType FROM Person WHERE Person_Email = '" . $_POST['usernameTransporter'] . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$personID = $row['Person_ID'];
			$user = $row['Person_Email'];
			$userType = $row['Person_UserType'];
		}
		$sql = "SELECT Transporter_ID FROM Transporter WHERE Transporter_PersonID = " . $personID;
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$transporterID = $row['Transporter_ID'];
			}
			if($userType == "Volunteer" ){									
				
				
				$query = "INSERT INTO LogTransport(LogTransport_TransportID,LogTransport_Date, LogTransport_PickUpAddress, LogTransport_Species,
				LogTransport_Hours,LogTransport_Miles, LastModifiedBy, LastModifiedDate) VALUES (" . $transporterID . ",'" . $_POST['date'] . "','" 
				. $_POST['address'] . "','" . $_POST['species'] . "'," . $_POST['hours'] . "," . $_POST['mileage'] . ",".$personID.",NOW())";

				mysqli_query($conn, $query) or die(mysqli_error($conn));
				
				//Calculate total hours and mile
				$sql = "SELECT SUM(LogTransport_Hours), SUM(LogTransport_Miles) FROM LogTransport WHERE LogTransport_TransportID = " . $transporterID;
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$totalHours = $row['SUM(LogTransport_Hours)'];
						$totalMiles = $row['SUM(LogTransport_Miles)'];
					}
					$query = "UPDATE LogTransport SET LogTransport_TotalHours = '$totalHours', LogTransport_TotalMiles = '$totalMiles' WHERE LogTransport_TransportID = " .$transporterID;

					mysqli_query($conn, $query) or die(mysqli_error($conn));
					
					$query = "CALL lastVolunteered2(".$personID.",'".$_POST['date']."')";					

					mysqli_query($conn, $query) or die(mysqli_error($conn));
				}
				//Calculate YTD hours and mile
				$sql = "SELECT SUM(LogTransport_Hours), SUM(LogTransport_Miles) FROM LogTransport WHERE (LogTransport_TransportID = " . $transporterID .") AND (YEAR(LogTransport_Date) = YEAR(CURDATE()))";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$ytdHours = $row['SUM(LogTransport_Hours)'];
						$ytdMiles = $row['SUM(LogTransport_Miles)'];
					}
					$query = "UPDATE LogTransport SET LogTransport_YTDHours = '$ytdHours', LogTransport_YTDMiles = '$ytdMiles' WHERE LogTransport_TransportID = " .$transporterID;

					mysqli_query($conn, $query) or die(mysqli_error($conn));
				}
				$conn->close();
				header("Location: transporter.php");
				exit();
			}
			
		}
		else {
		// Not a volunteer, show an error
		$message = 'Error. For Transporter use only.';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
		}
	}
	else {
	 // passwords didn't match, show an error
		$message = 'Username incorrect. Please use your email address for your Username.';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
	}
	$conn->close();
 }

 /****************************************
	END Transporter CODE 
****************************************/
 /****************************************
	START Login CODE 
****************************************/

if(isset($_POST['btnLogIn'])){
	// Help with password hashing from https://sunnysingh.io/blog/secure-passwords
		//Get PasswordHash file
		require("PasswordHash.php");
		//Construct the class
		$hasher = new PasswordHash(8, false);
		// Password from form input
		$password = $_POST["password"];
		
		if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
		// Just in case the hash isn't found
		$stored_hash = "*";
		// Retrieve the stored hash
		$servername = "localhost";
		$username = "root";
		$dbpassword = "Twspike1994?";
		$dbname = "wildlife";
 
		// Create connection
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		//SQL Statement to gather hash
		$sql = "SELECT Person_ID, Person_PasswordHash, Person_UserType FROM Person WHERE Person_Email = '" . $_POST['usernameLogIn'] . "'";
		
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$userID = $row['Person_ID'];
				$stored_hash = $row['Person_PasswordHash'];
				$userType = $row['Person_UserType'];
			}
		}
		
		$conn->close();
		// Check that the password is correct, returns a boolean
		$check = $hasher->CheckPassword($password, $stored_hash);
		
		if ($check) {
			
			//Save session variable to be used on the next page
			$_SESSION['userID'] = $userID;
			$_SESSION['userType'] = $userType;
		
		  // passwords matched! Go to the User Type specific page (Depends if they are applicant, volunteer, team leads, staff)
			if ($userType == "Applicant"){
				header("Location: applicantprofile.php");
			exit();
			}
			if ($userType == "Volunteer"){
				header("Location: profile.php");
			exit();
			}
			if ($userType == "Team Lead"){
				header("Location: calendar2.php");
			exit();
			}
			if ($userType == "Staff"){
				header("Location: staffprofile.php");
			exit();
			}
			
			
		} else {

		 // passwords didn't match, show an error
			
		$message = 'Username and/or Password is incorrect. Please use your email address for your Username.';

		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
		}
	} 
/****************************************
	END Login CODE 
****************************************/
/****************************************
	START Apply CODE 
****************************************/
if(isset($_POST['apply']))
{
	require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';
	$emailAddress = $_POST['username'];
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'wcvtestemail@gmail.com';                 // SMTP username
	$mail->Password = '1wildcva';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('wcvtestemail@gmail', 'Wildlife Center of Virginia');

	$mail->addAddress($emailAddress);     // recipient

	$mail->Subject = 'Wildlife Center of Virginia Volunteer Opportunity';
	$mail->Body    = 'Thank you for your interest in the Wildlife Center!<br>
                  Please follow the link provided to fill out an application.
					<br><br>
					http://52.42.132.241/484phpWork1/forms.php';
					
	$mail->AltBody = 'Thank you for your interest in the Wildlife Center!<br>
	  Please follow the link provided to fill out an application.
	  <br><br>
					http://52.42.132.241/484phpWork1/forms.php';

	
	$mail->AltBody = $_POST['emailBody'];

	
	$mail->isHTML(true);                                  // Set email format to HTML

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	 else {
		header("Location: apply_confirmation.php");
		exit(); 

  
}

}
/****************************************
	END Apply CODE 
****************************************/
?>

<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Wildlife Center of Virginia Volunteers</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!--Add Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>





<link rel="stylesheet" media="screen" href="css/style.css" />

</head>

<!--clock in form-->
<body class="login">
    <div class="login-box main-content panel panel-default">
      <header class="panel-heading"><img src="../484phpWork1/images/logo_small.png" alt="Wildlife Logo"></header>
    	<section class="panel-body">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" id="usernameClockIn"  class="form-control" value="" name="usernameClockIn" required="required" placeholder="Username" />
            </div>
          </div>
          <div class="form-group">
            <div class="form-inline">
              <button  ID="btnClockIn" name="btnClockIn" class="btn btn-default col-sm-3 col-sm-offset-3" type="submit">Clock In</button>
              <button  ID="btnClockOut" name="btnClockOut" class="btn btn-default" type="submit">Clock Out</button>
            </div>
          </div>
</form>
<!--end clock in form-->

<!--Accordion Start-->
<div class="bs-example">
    <div class="panel-group" id="accordion">

       <!--Transporter Form-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Transporter</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <form id="form" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" id="usernameTransporter"  class="form-control" value="" name="usernameTransporter" required="required" placeholder="Username" />
            </div>
          </div>
		  <div class="form-group">
            <div class="col-sm-12">
              <input type="date" id="date"  class="form-control" value="" name="date" required="required" placeholder="Date of Pickup" />
            </div>
          </div>
		  <div class="form-group">
            <div class="col-sm-12">
              <input type="text" id="address"  class="form-control" value="" name="address" required="required" placeholder="Pick Up Address" />
            </div>
          </div>
		  <div class="form-group">
            <div class="col-sm-12">
              <input type="text" id="species"  class="form-control" value="" name="species" required="required" placeholder="Animal Species" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="number" id="hours" class="form-control" value="" name="hours" required="required" placeholder="Hours" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="number" id="mileage" class="form-control" value="" name="mileage" required="required" placeholder="Mileage" />
            </div>
          </div>
          <div><a target="_blank" href="https://www.google.com/maps/dir///Wildlife+Center+of+VA,+South+Delphine+Avenue,+Waynesboro,+VA//@38.0808252,-78.9864842,13z/data=!4m11!4m10!1m0!1m0!1m5!1m1!1s0x89b3640efe4889c9:0xf47416d422aa90a9!2m2!1d-78.9137609!2d38.0392567!1m0!3e0">Click here to check how far you drove.</a></div>
          <br>
          <div class="form-group">
            <div class="col-sm-2 col-sm-offset-4">
              <button name="btnTransporter" class="btn btn-default" type="submit">Submit</button>
            </div>
          </div>
</form>
  <!--end transporter form-->
                    
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
<!--Log in Form-->
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Log in</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
  <form id="form" method="post" class="form-horizontal">
    			<div class="form-group">
    			  <div class="col-sm-12">
      				<input type="text" id="usernameLogIn"  class="form-control" value="" name="usernameLogIn" required="required" placeholder="Username" />
    				</div>
    			</div>
    			<div class="form-group">
    			  <div class="col-sm-12">
      				<input type="password" id="password" class="form-control" value="" name="password" required="required" placeholder="Password" />
      			</div>
    			</div>
				<div><a target="_blank" href="createProfileCode.php">Click here to create an account</a></div>
				<br>
    			<div class="form-group">
    			  <div class="col-sm-2 col-sm-offset-4">
      				<button ID="btnLogIn" name="btnLogIn" class="btn btn-default" type="submit">Login</button>
      			</div>
      		</div>
</form>
<!--end log in form-->
                    
                    
                </div>
            </div>
        </div>

       
    <!--Apply Form-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Apply</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                <form id="form" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" id="username"  class="form-control" value="" name="username" required="required" placeholder="Email Address" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2 col-sm-offset-4">
              <button class="btn btn-default" name = 'apply' type="submit">Apply</button>
            </div>
          </div>


</form>    
<!--end apply form-->




                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


    		
    		
    	</section>
    </div>






</body>
</html>