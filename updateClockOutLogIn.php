<!DOCTYPE html>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<?php
//DO NOT MOVE. KEEP AT TOP
// destroy the session
session_start(); 
session_destroy();
//start new session
session_start();

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
				
			}
			if ($userType == "Volunteer"){
				header("Location: updateClockOut.php");
				exit();
			}
			if ($userType == "Team Lead"){
				
			}
			if ($userType == "Staff"){
				
			}
			
			
		} else {

		 // passwords didn't match, show an error
			
		$message = 'Username and/or Password is incorrect. Please use your email address for your Username.';

		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
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
				  <p>Log in to update Clock Out time</p>
      				<input type="text" id="usernameLogIn"  class="form-control" value="" name="usernameLogIn" required="required" placeholder="Username" />
    				</div>
    			</div>
    			<div class="form-group">
    			  <div class="col-sm-12">
      				<input type="password" id="password" class="form-control" value="" name="password" required="required" placeholder="Password" />
      			</div>
    			</div>
    			<div class="form-group">
    			  <div class="col-sm-2 col-sm-offset-4">
      				<button ID="btnLogIn" name="btnLogIn" class="btn btn-default" type="submit">Login</button>
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