<!DOCTYPE html>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<?php
//Session variables: KEEP AT TOP
session_start();
$codeCorrect = $_SESSION['codeCorrect']; 


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($codeCorrect != "Yes"){
	header("Location: restrictedAccess.php");
	exit();
}

*/

if(isset($_POST['upload']))
{
	//Insert Statemnts passed boolean
	$insertsPassed = "true";
	
	$userType = "Volunteer";
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['phone'];
	$phoneAlt = $_POST['phoneAlt'];
	$email = $_POST['email'];
	$street= $_POST['street'];
	$city = $_POST['city'];
	$county = null;
	$state = $_POST['state'];
	$zip = $_POST['zipcode'];
	$limitationsASN = $_POST['limitationsASN'];
	$allergies = $_POST['allergies'];
	$limitationsWO = $_POST['limitationsWO'];
	$outside = $_POST['outside'];
	$fortyLBS = $_POST['fortyLBS'];
	$rabies = $_POST['rabies'];
	$vacDate = null;
	$permit = $_POST['permit'];
	$permitCategory = $_POST['permitCategory'];
	 
	//Make certain passwords match
	if($_POST['password'] == $_POST['check']){
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
			$passwordHashPassed = $hash;
				
		} else {
			
		 // something went wrong

		}
		/****************************************
			END PASWWORD CODE 
		****************************************/
		$servername = "localhost";
		$username = "root";
		$dbpassword = "Twspike1994?";
		$dbname = "wildlife";

		// Create connection
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			
		}
		$query = "INSERT INTO Person (Person_UserName, Person_PasswordHash,Person_UserType, Person_FirstName, Person_LastName, Person_Email, Person_PhonePrimary, Person_PhoneAlternate, Person_StreetAddress, Person_City, Person_County,
			Person_State, Person_Zipcode, Person_AllergiesYN, Person_Allergies, Person_WorkOutside, Person_OutsideLimitations,Person_Lift40Lbs, Person_RabiesYN, Person_RabbiesVaccinationDate, Person_RehabilitateYN, Person_RehabilitatePermitCategory)
					VALUES ('$email', '$passwordHashPassed', '$userType', '$firstName', '$lastName', '$email', '$phone', $phoneAlt, '$street', '$city',
					NULL, '$state', '$zip', '$limitationsASN', '$allergies', '$limitationsWO', '$outside', '$fortyLBS', '$rabies', NULL , '$permit', '$permitCategory')"; 
		
		if(!mysqli_query($conn,$query))

		{
			echo("Error description: " . mysqli_error($conn));
			$insertsPassed = "false";
		}
		
		//Get personID for this person
		$sql = "SELECT MAX(Person_ID) FROM Person";
		$result = $conn->query($sql);
		$personID = null;
		if($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
				$personID = $row['MAX(Person_ID)'];
			}
		}
			
		//Insert rehabilitation permit document	
       if($_FILES['permitRehabVA']['size'] > 0){		   
        $fileName  = $_FILES['permitRehabVA']['name'];
        $tmpName  = $_FILES['permitRehabVA']['tmp_name'];
        $fileType = $_FILES['permitRehabVA']['type'];
        $fileSize = $_FILES['permitRehabVA']['size'];
        $fp      = fopen($tmpName, 'r');
        $permitRehabVA = fread($fp, filesize($tmpName));
        $permitRehabVA = addslashes($permitRehabVA);
        fclose($fp);

        $documentQuery = "INSERT INTO documentation (Documentation_PersonID, Documentation_TypeOfDocument, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent, Documentation_DocumentNotes) 
            VALUES ('$personID', 'Rehabilitation_Permit', '$fileName', '$fileType', '$fileSize', '$permitRehabVA', NULL)";
        

            if(!mysqli_query($conn,$documentQuery))

            {
                echo("Error description: " . mysqli_error($conn));
				$insertsPassed = "false";
            }

	   }
	   //Insert rabies document
	   if($_FILES['rabbiesDocumentation']['size'] > 0){	
        $fileName  = $_FILES['rabbiesDocumentation']['name'];
        $tmpName  = $_FILES['rabbiesDocumentation']['tmp_name'];
        $fileType = $_FILES['rabbiesDocumentation']['type'];
        $fileSize = $_FILES['rabbiesDocumentation']['size'];
        $fp      = fopen($tmpName, 'r');
        $rabbiesDocumentation = fread($fp, filesize($tmpName));
        $rabbiesDocumentation = addslashes($rabbiesDocumentation);
        fclose($fp);



        $documentQuery = "INSERT INTO documentation (Documentation_PersonID, Documentation_TypeOfDocument, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent, Documentation_DocumentNotes) 
            VALUES ('$personID', 'Rabies_Documentation', '$fileName', '$fileType', '$fileSize', '$rabbiesDocumentation', NULL)";
        

            if(!mysqli_query($conn,$documentQuery))

            {
                echo("Error description: " . mysqli_error($conn));
				$insertsPassed = "false";
            }
            
	   }	   //Insert profile picture
		 if($_FILES['picture']['size'] > 0){	
			$fileName  = $_FILES['picture']['name'];
			$tmpName  = $_FILES['picture']['tmp_name'];
			$fileType = $_FILES['picture']['type'];
			$fileSize = $_FILES['picture']['size'];
			$fp      = fopen($tmpName, 'r');
			$picture = fread($fp, filesize($tmpName));
			$picture = addslashes($picture);
			fclose($fp);



			$documentQuery = "INSERT INTO documentation (Documentation_PersonID, Documentation_TypeOfDocument, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent, Documentation_DocumentNotes) 
				VALUES ('$personID', 'picture', '$fileName', '$fileType', '$fileSize', '$picture', NULL)";
        

            if(!mysqli_query($conn,$documentQuery))

            {
                echo("Error description: " . mysqli_error($conn));
				$insertsPassed = "false";
            }    
	   } 
		
		
		if($insertsPassed == "true"){
			$conn->close();
			header("Location: createConfirmation.php");
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
						<a class="navbar-brand" href="profile.php"><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">
                            <li class="active"><a href="createProfile.php">Create Profile</a></li>
                            <li><a href="index.php">Back</a></li>
						</ul>
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
											<h3 class="col-md-6">Enter Profile Information</h3>
											<div class="col-md-3">
												<div class="text-center">
													<img src="images/johndoe.png" class="avatar img-circle img-responsive" alt="avatar">
													
													
												</div>
											</div>
											<div class="container">
												<hr>
												<div class="row">
												
													<!-- left column -->
											  
													<!-- edit form column -->
											  
													<div class="col-md-7 col-md-offset-1 personal-info">
													<form class="form-horizontal" enctype = "multipart/form-data" method="post" role="form">
													<h6>Upload a photo...</h6>
													<div class="fileinput fileinput-new" data-provides="fileinput">
															<span class="btn btn-default btn-file">
																<input name="picture" id = "picture" type="file" multiple /></span>
															<span class="fileinput-filename"></span>
															<span class="fileinput-new"></span>
														</div> 
													<h3>Personal Info</h3>
													
														<div class="form-group">
															<label class="col-lg-3 control-label">First Name:</label>
															<div class="col-lg-8">
																<input class="form-control" maxlength="20" name="firstName" value="<?php if (isset($_POST['upload'])) echo ($_POST['firstName']);?>" name="first" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Last Name:</label>
															<div class="col-lg-8">
																<input class="form-control" maxlength="20" name="lastName" value="<?php if (isset($_POST['upload'])) echo ($_POST['lastName']);?>" type="text" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Email:</label>
															<div class="col-lg-8">
																<input class="form-control" maxlength="254" name="email" value="<?php if (isset($_POST['upload'])) echo ($_POST['email']);?>" type="text" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Phone:</label>
															<div class="col-lg-8">
																<input class="form-control" name="phone" value="<?php if (isset($_POST['upload'])) echo ($_POST['phone']);?>" type='tel' pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number Format: 555-555-5555' required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Alternate Phone:</label>
															<div class="col-lg-8">
																<input class="form-control" name="phoneAlt" value="<?php if (isset($_POST['upload'])) echo ($_POST['phoneAlt']);?>" type='tel' pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number Format: 555-555-5555'>
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Address:</label>
															<div class="col-lg-8">
																<input class="form-control" maxlength="50" name="street" value="<?php if (isset($_POST['upload'])) echo ($_POST['street']);?>" type="text" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">City:</label>
															<div class="col-lg-8">
																<input class="form-control" maxlength="40" name="city" value="<?php if (isset($_POST['upload'])) echo ($_POST['city']);?>" type="text" required="required" />
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">State:</label>
															<div class="col-lg-8">
																
																<select name="state">
																	<option value="Virginia">Virginia</option>
																	<option value="Alabama">Alabama</option>
																	<option value="Alaska">Alaska</option>
																	<option value="Arizona">Arizona</option>
																	<option value="Arkansas">Arkansas</option>
																	<option value="California">California</option>
																	<option value="Colorado">Colorado</option>
																	<option value="Connecticut">Connecticut</option>
																	<option value="Delaware">Delaware</option>
																	<option value="Florida">Florida</option>
																	<option value="Georgia">Georgia</option>
																	<option value="Hawaii">Hawaii</option>
																	<option value="Idaho">Idaho</option>
																	<option value="Illinois">Illinois</option>
																	<option value="Indiana">Indiana</option>
																	<option value="Iowa">Iowa</option>
																	<option value="Kansas">Kansas</option>
																	<option value="Kentucky">Kentucky</option>
																	<option value="Louisiana">Louisiana</option>
																	<option value="Maine">Maine</option>
																	<option value="Maryland">Maryland</option>
																	<option value="Massachusetts">Massachusetts</option>
																	<option value="Michigan">Michigan</option>
																	<option value="Minnesota">Minnesota</option>
																	<option value="Mississippi">Mississippi</option>
																	<option value="Missouri">Missouri</option>
																	<option value="Montana">Montana</option>
																	<option value="Nebraska">Nebraska</option>
																	<option value="Nevada">Nevada</option>
																	<option value="New Hampshire">New Hampshire</option>
																	<option value="New Jersey">New Jersey</option>
																	<option value="New Mexico">New Mexico</option>
																	<option value="New York">New York</option>
																	<option value="North Carolina">North Carolina</option>
																	<option value="North Dakota">North Dakota</option>
																	<option value="Ohio">Ohio</option>
																	<option value="Oklahoma">Oklahoma</option>
																	<option value="Oregon">Oregon</option>
																	<option value="Pennsylvania">Pennsylvania</option>
																	<option value="Rhode Island">Rhode Island</option>
																	<option value="South Carolina">South Carolina</option>
																	<option value="South Dakota">South Dakota</option>
																	<option value="Tennessee">Tennessee</option>
																	<option value="Texas">Texas</option>
																	<option value="Utah">Utah</option>
																	<option value="Virginia">Virginia</option>
																	<option value="Vermont">Vermont</option>
																	<option value="Washington">Washington</option>
																	<option value="West Virginia">West Virginia</option>
																	<option value="Wisconsin">Wisconsin</option>
																	<option value="Wyoming">Wyoming</option>
																</select> 
																	
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Zip Code:</label>
															<div class="col-lg-8">
																<input class="form-control" pattern=".{5}" title="Enter 5 digit zipcode" name="zipcode" value="<?php if (isset($_POST['upload'])) echo ($_POST['zipcode']);?>" type="text" required="required" />
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Allergies?:</label>
															<div class="col-lg-8">
																<input type="radio" name="limitationsASN" value="Yes" <?php if (isset($_POST['limitationsASN']) && $_POST['limitationsASN'] == 'Yes') echo ' checked="checked"';?>> Yes
																<input type="radio" name="limitationsASN" value="No" <?php if (isset($_POST['limitationsASN']) && $_POST['limitationsASN'] == 'No') echo ' checked="checked"';?>> No
																<input class="form-control" name="allergies" type="text">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Physical Limitations / Such as Working Outside:</label>
															<div class="col-lg-8">
																<input type="radio" name="limitationsWO" value="Yes" <?php if (isset($_POST['limitationsWO']) && $_POST['limitationsWO'] == 'Yes') echo ' checked="checked"';?>> Yes
																<input type="radio" name="limitationsWO" value="No" <?php if (isset($_POST['limitationsWO']) && $_POST['limitationsWO'] == 'No') echo ' checked="checked"';?>> No
																<input class="form-control" name="outside" type="text">
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Rabies Vaccinated?</label>
															<div class="col-lg-8">
																<div class="checkbox">
																	<input type="radio" name="rabies" value="Yes" <?php if (isset($_POST['rabies']) && $_POST['rabies'] == 'Yes') echo ' checked="checked"';?>> Yes
																	<input type="radio" name="rabies" value="No" <?php if (isset($_POST['rabies']) && $_POST['rabies'] == 'No') echo ' checked="checked"';?>> No
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3">If so, how recently? Please provide proof of vaccination. Upload an attachment.</label>
															<div class="col-lg-8">
																<input type="date" id="vacDate" name="vacDate" class="form-control" name="VacDate"/>								
															
															<div class="fileinput fileinput-new" data-provides="fileinput">
															<span class="btn btn-default btn-file">
																<input name="rabbiesDocumentation" id = "rabbiesDocumentation" type="file" multiple /></span>
															<span class="fileinput-filename"></span>
															<span class="fileinput-new"></span>
														</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-lg-3 control-label">Do you have a permit to rehabilitate wildlife in the state of Virginia?</label>
															<div class="col-lg-8">
																<div class="checkbox" >
																	<input type="radio" name="permit" value="Yes" <?php if (isset($_POST['permit']) && $_POST['permit'] == 'Yes') echo ' checked="checked"';?>> Yes
																	<input type="radio" name="permit" value="No" <?php if (isset($_POST['permit']) && $_POST['permit'] == 'No') echo ' checked="checked"';?>> No
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3">If so, what category? Please upload a copy of your permit.</label>
																<div>
																	<select name="permitCategory">
																		<option value="">--</option>
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="4">4</option>
																	</select>
																</div>
																<div class="fileinput fileinput-new" data-provides="fileinput">
															<span class="btn btn-default btn-file">
																<input name="permitRehabVA" id = "permitRehabVA" type="file" multiple /></span>
															<span class="fileinput-filename"></span>
															<span class="fileinput-new"></span>
														</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3">Are you able to lift 40 lbs?</label>
															<div class="col-sm-7">
																<div class="checkbox">
																	<input type="radio" name="fortyLBS" value="Yes" <?php if (isset($_POST['fortyLBS']) && $_POST['fortyLBS'] == 'Yes') echo ' checked="checked"';?>> Yes
																	<input type="radio" name="fortyLBS" value="No" <?php if (isset($_POST['fortyLBS']) && $_POST['fortyLBS'] == 'No') echo ' checked="checked"';?>> No
																</div>
															</div>
														</div>
														<div class="form-group">
<!-- I DON'T HAVE AN ATTRIBUTE IN THE -->				<label class="col-lg-3 control-label">Additional Notes:</label> 
<!--PERSON ENTITY FOR NOTES, WILL ADD FOR SPRINT 3--> 
															<div class="col-lg-8">
																<input class="form-control" type="text" value="">
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label">Password:</label>
															<div class="col-md-8">
																<input class="form-control" name="password" type="password" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label">Confirm password:</label>
															<div class="col-md-8">
																<input class="form-control" name="check" type="password" required="required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label"></label>
															<div class="col-md-8">
																<input type="submit" name="upload" class="btn btn-primary" value="Submit Profile">
																<span></span>
																<input type="reset" class="btn btn-default" value="Cancel">
															</div>
														</div>
													</form>
												</div>
												</div>
												<hr>
											</div>
										</div>
									</div>
								</div>
								<div class="preview">
								</div>
							</div>
						</div>
                    </section>

                    <!-- Main Section End -->
					
                </div>
            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer>
        <div id="footer-inner" class="container">
            <div>
                <span class="pull-right" class="footer" > &copy; 2017. All rights reserved. Owl Team
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
