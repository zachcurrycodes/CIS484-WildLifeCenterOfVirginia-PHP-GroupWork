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

if(isset($_POST['btnCode'])){
	if(($_POST['code']) == "wcvcreate"){ //CHANGE THIS TO WHATEVER IS SENT IN EMAIL
		$_SESSION['codeCorrect'] = "Yes";
		header("Location: createProfile.php");
		exit();
	}
	else{
		$message = "Code is incorrect. Please try again or contact your Team Lead.";
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
						<p>To create an account, enter code sent to your email or ask a Team Lead.</p>
						<input type="text" class="form-control" value="" name="code" required="required" placeholder="Code" />
					</div>
    			</div>
    			<div class="form-group">
					<div class="col-sm-2 col-sm-offset-4">
						<button ID="btnCode" name="btnCode" class="btn btn-default" type="submit">Create Account</button>
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
						
	</div>
</body>
</html>