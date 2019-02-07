<!DOCTYPE html>

<?php

//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType']; 


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Team Lead"){
	header("Location: restrictedAccess.php");
	exit();
}
*/

//If Cancel button clicked, go back to profile
if(isset($_POST['btnCancel']))
{
	header("Location: accountProfile.php");
	exit();
}

//Populate fields code
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
$sql = "SELECT Person_FirstName, Person_LastName, Person_PhonePrimary, Person_Email FROM Person WHERE Person_ID = " .$userID;
$result = $conn->query($sql);
if ($result->num_rows > 0){
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$first = $row['Person_FirstName'];
		$last = $row['Person_LastName'];
		$phone = $row['Person_PhonePrimary'];
		$email = $row['Person_Email'];
	}
}
else {
 
}
$conn->close();
if(isset($_POST['btnSave']))
{
	//Set run query to false
	$runQuery= false;
	//Set variable values
	$first = $_POST['firstName'];
	$last = $_POST['lastName'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	//If passwords null, don't uppdate password
	if(($_POST['password'] == null) || ($_POST['check'] == null)){
		$runQuery = true;
		$passwordQuery = " ";
	}
	//Else, update passwords if password and check match
	else if($_POST['password'] == $_POST['check']){
		/****************************************
			START PASWWORD CODE 
		****************************************/
		require("PasswordHash.php");
		$hasher = new PasswordHash(8, false);
		// Retrieve password
		$password = $_POST["password"];
		// Limit passwords to 72 characters to help prevent DoS attacks
		if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
		// The $hash variable will contain the hash of the password
		$hash = $hasher->HashPassword($password);
		if (strlen($hash) >= 20) {
			$runQuery = true;
			$passwordQuery = " Person_PasswordHash = '" . $hash . "',";
		} else {
			
		 // something went wrong

		}
		/****************************************
			END PASWWORD CODE 
		****************************************/
	}
	if ($runQuery == true){
		$servername = "localhost";
		$username = "root";
		$dbpassword = "Twspike1994?";
		$dbname = "wildlife";

		// Create connection
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$query = "UPDATE Person SET" . $passwordQuery . "Person_FirstName = '" . $first . "', Person_LastName ='" 
		. $last . "', Person_PhonePrimary = '" . $phone . "', Person_Email ='" . $email . "' WHERE Person_ID = " .$userID; 
		
		if(!mysqli_query($conn,$query))

		{
			echo("Error description: " . mysqli_error($conn));
		}

		else
		{
			$conn->close();
			header("Location: updateConfirmation2.php");
			exit();
		}
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
<body>
    <div id="wrapper">
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="calendar2.php"><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">
							<li><a href="calendar2.php">Calendar</a></li>
							<li><a href="profilesearch.php">Search</a></li>	
							<li><a href="excel.php">Excel</a></li>
                            <li class="active"><a href="accountProfile.php">Account</a></li>                          
                            <li><a href="index.php">Sign Out</a></li>                     
                            </li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
					
		<section>
			<div class="container">
				<div class="row">

					<!-- Main Section -->

					<section class="col-md-9 no-padding">
						<div class="main-section">
							<div class="container-fluid no-padding">
								<div class="col-md-12 no-padding">
									<div class="main-content panel panel-default no-margin">
										<header class="panel-heading clearfix"></header>
										<div class="content">
											<h3 class="col-md-6">Edit Account Information</h3>
											<div class="container">
												<hr>
												<div class="row">
												
													<!-- left column -->
													
													<!-- edit form column -->
													
													<div class="col-md-7 col-md-offset-1 personal-info">
														<form class="form-horizontal" method="post" role="form">
															<div class="form-group">
																<label class="col-lg-3 control-label">First Name:</label>
																<div class="col-lg-8">
																	<input class="form-control" name="firstName" value="<?php echo ($first);?>" maxlength="20" type="text" required="required">
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-3 control-label">Last Name:</label>
																<div class="col-lg-8">
																	<input class="form-control" name="lastName" value="<?php echo ($last);?>" maxlength="20" type="text" required="required" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-3 control-label">Email:</label>
																<div class="col-lg-8">
																	<input class="form-control" name="email" value="<?php echo ($email);?>" maxlength="254" type="email" required="required" >
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-3 control-label">Phone:</label>
																<div class="col-lg-8">
																	<input class="form-control" name="phone" value="<?php echo ($phone);?>" type='tel' pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number Format: 555-555-5555' required="required"> 
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Change Password?</label>
																<div class="col-md-8"></div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Password:</label>
																<div class="col-md-8">
																	<input class="form-control" name="password" type="password">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label">Confirm password:</label>
																<div class="col-md-8">
																	<input class="form-control" name="check" type="password">
																</div>
															</div>
															<div class="form-group">
																<label class="col-md-3 control-label"></label>
																<div class="col-md-8">
																	<input type="submit" name="btnSave" class="btn btn-primary" value="Save Changes">
																	<span></span>
																	<input type="submit" name="btnCancel" class="btn btn-default" formnovalidate value="Cancel">
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<hr>
										</div>
								   </div>
								</div>
							</div>
							<div class="preview"></div>
						</div>
					</section>
				</div>
			</div>

				<!-- Main Section End -->
	
		<div id="push"></div>
        </section>
    </div>
    
    <footer>
        <div id="footer-inner" class="container">
            <div>
                <span class="pull-right" class="footer" > &copy; 2017. All rights reserved. Owl Team</span>
            </div>
        </div>
    </footer>


    <!-- render blocking scripts -->

    <!-- jQuery JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- markitup! -->
    <script type="text/javascript" src="markitup/jquery.markitup.js"></script>
    <!-- markItUp! toolbar settings -->
    <script type="text/javascript" src="markitup/sets/default/set.js"></script>

    <!-- Main Script -->
    <script src="js/global.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        // Add markItUp! to your textarea in one line
        $('.markItUpTextarea').markItUp(mySettings, { root:'markitup/skins/simple/' });
    });
    </script>
</body>
</html>
