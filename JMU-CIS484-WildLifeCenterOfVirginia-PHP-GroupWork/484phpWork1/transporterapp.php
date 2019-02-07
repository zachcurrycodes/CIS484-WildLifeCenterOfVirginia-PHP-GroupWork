<!DOCTYPE html>

<?php

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

		
	  if(isset($_POST['upload']))
	{
		if($_POST['password'] == $_POST['check']){
	
	
		/****************************************
			START PASWWORD CODE 
		****************************************/

		require("PasswordHash.php");
		$hasher = new PasswordHash(8, false);
		// Retrieve password
		$password = $_POST["password"];
		// Limit passwords to 72 characters to help prevent DoS attacks
		if (strlen($password) > 72)
		{ die("Password must be 72 characters or less"); }
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
			//Insert Statemnts passed boolean
			$insertsPassed = "true";
 

			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$userName = $_POST['email'];
			$passwordHash = $passwordHashPassed;
			$userType = "Applicant";
			$email = $_POST['email'];
			$middleInitial = NULL;
			$primaryPhone = $_POST['phone'];
			$secondaryPhone = NULL;
			$city = $_POST['city'];
			$county = NULL;
			$state = $_POST['state'];;
			$zip = $_POST['zipcode'];
			$dob1 = $_POST['DOBYear'] . '-' . $_POST['DOBMonth'] . '-' . $_POST['DOBDay'];
			$dob2 = DateTime::createFromFormat('Y-m-d' , $dob1);
			$dob = $dob2->format('Y-m-d');
			$street = $_POST['address'];
			$status = 'Applicant';
			/* $rabiesVac1 = $_POST['VACYear'] . '-' . $_POST['VACMonth'] . '-' . $_POST['VACDay'];
			$rabiesVac2 = DateTime::createFromFormat('Y-m-d' , $rabiesVac1);
			$rabiesVac = $rabiesVac2->format('Y-m-d'); */
			$lastVolunteered = NULL;
			$departmentID = 4;
			$allergies = NULL;
			$workOutside = NULL;
			$totalHours = NULL;
			$workOutsideLimitations = NULL;
			$lift40 = NULL;
			$permitRehab = NULL;
			$travel = $_POST['travel'];
			$capture = $_POST['capture'];
			$acknowledge = $_POST['acknowledge'];


			if ($_POST['transport1'] == 'Weekdays'){
				$cbDays .= ' |Weedkdays|';
			}
			if ($_POST['transport2'] == 'Weekends'){
				$cbDays .= ' |Weekends|';
			}
			if ($_POST['transport3'] == 'Anytime'){
				$cbDays .= ' |Any Time|';
			}

			
			
			if ($permitRehab < 1)
			{
				$permitRehab = NULL;
			}
$query = "INSERT INTO person (Person_UserName, Person_PasswordHash, Person_UserType, Person_FirstName, Person_MiddleName, Person_LastName, Person_Email, Person_PhonePrimary, Person_PhoneAlternate, Person_StreetAddress, Person_City, Person_County, Person_State, Person_Country, Person_ZipCode, Person_DateOfBirth, Person_Status, Person_RabbiesVaccinationDate, Person_RehabilitatePermitCategory, Person_Allergies, Person_WorkOutside, Person_OutsideLimitations, Person_Lift40Lbs, Person_TotalVolunteeredHours, Person_LastVolunteered, Person_DepartmentID, Person_Days)
			  VALUES ('$userName', '$passwordHash', '$userType', '$firstName', NULL, '$lastName', '$email', '$primaryPhone', NULL, '$street', '$city', NULL, '$state', NULL, '$zip', '$dob', '$status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$departmentID', '$cbDays')";



		if(!mysqli_query($conn,$query))

			{
				echo("Error description: " . mysqli_error($conn));
				$insertsPassed = "false";
			}
			
			$depNum = 4;
			$sql = "SELECT MAX(Person_ID) FROM Person";
			$result = $conn->query($sql);
			$personID = null;
			if($result->num_rows > 0) {
				//output data of each row
				while($row = $result->fetch_assoc()) {
					$personID = $row['MAX(Person_ID)'];
				}
			}
			
			$transporterQuery = "INSERT INTO Transporterapp (TransporterApp_PersonID, TransporterApp_DistanceWillingToTravel, TransporterApp_CaptureAnimals, TransporterApp_Acknowledgement)
			  VALUES ('$personID', '$travel', '$capture', '$acknowledge')";



			  if(!mysqli_query($conn,$transporterQuery))

			{
				echo("Error description: " . mysqli_error($conn));
				$insertsPassed = "false";
			}

			if($_FILES['rabbiesDocumentation']['size'] > 0){	
				$fileName = $_FILES['rabbiesDocumentation']['name'];
				$tmpName  = $_FILES['rabbiesDocumentation']['tmp_name'];
				$fileSize = $_FILES['rabbiesDocumentation']['size'];
				$fileType = $_FILES['rabbiesDocumentation']['type'];
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp); 
				
				$documentQuery = "INSERT INTO Documentation (Documentation_PersonID, Documentation_TypeOfDocument, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent, Documentation_DocumentNotes)
				  VALUES ('$personID', 'Rabbies_Documentation', '$fileName', '$fileType', '$fileSize', '$content', NULL)";



				if(!mysqli_query($conn,$documentQuery))

				{
					echo("Error description: " . mysqli_error($conn));
					$insertsPassed = "false";
				}
			}
		}
		if($insertsPassed == "true"){
			$conn->close();
			header("Location: confirmation.php");
			exit();
			}
	else{
		$message = 'Password values do not match. Please try again.';

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

	<title>Wildlife Center of Virginia Application</title>

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
                       <a class="navbar-brand" href=""><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                    </div>
                  
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">

                            <li class="active"><a href="forms.php">Application</a></li>
							<li><a href="forms.php">Back</a></li>
                                </ul>
                            </li>
                        </ul>
                      
                    </div>
                </div>
            </nav>
        </header>
        
        
        <section>
            <div class="container">
                <div class="row">
    
                    <!-- Main Section -->
    
                    <section class="col-md-12">
                        <div class="main-section">
                            <div class="main-content panel panel-default">
                                <header class="panel-heading clearfix">
                                    <h2 class="panel-title">
                                        Wildlife Center of Virginia - Transporter Application
                                    </h2>
                                </header>
                                <section class="panel-body container-fluid">
                                    <div class="leading">
										<form id="form" method ="post" enctype = "multipart/form-data" class="form-horizontal panel panel-default">
                                            <header class="panel-heading"><h2 class="panel-title">Basic Information</h2></header>
            
                                            <fieldset class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2">First Name *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id = 'firstName' name = 'firstName' value="<?php if (isset($_POST['upload'])) echo ($_POST['firstName']);?>" type="text" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">Last Name *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id = 'lastName' name = 'lastName' value="<?php if (isset($_POST['upload'])) echo ($_POST['lastName']);?>" type="text" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">Create Password *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id = 'password'type="password" name="password" required="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">Confirm Password *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" type="password" name="check" data-equals="password" required="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">Email *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id = 'email' name = 'email' value="<?php if (isset($_POST['upload'])) echo ($_POST['email']);?>" type="email" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">Phone *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id = 'phone' name="phone" value="<?php if (isset($_POST['upload'])) echo ($_POST['phone']);?>" type='tel' pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number Format: 555-555-5555' required="required" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-sm-2">Address *</label>
                                                    <div class="col-sm-10">
														<input class="form-control" id= 'address' name="address" type="text" value="<?php if (isset($_POST['upload'])) echo ($_POST['address']);?>" placeholder="street" name="street" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2">City *</label>
                                                    <div class="col-sm-2">
														<input class="form-control" type="text" id="city" name="city" value="<?php if (isset($_POST['upload'])) echo ($_POST['city']);?>" placeholder="City" name="city" />
                                                    </div>
                                                    <label class="col-sm-1">State *</label>
													<div class="col-sm-3">
													
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
															<option value="Vermont">Vermont</option>
															<option value="Washington">Washington</option>
															<option value="West Virginia">West Virginia</option>
															<option value="Wisconsin">Wisconsin</option>
															<option value="Wyoming">Wyoming</option>
														</select>
															
													</div>
													<label class="col-sm-2">Zip Code *</label>
													<div class="col-sm-2">
														<input class="form-control" type="text" id="zipcode" name="zipcode" value="<?php if (isset($_POST['upload'])) echo ($_POST['zipcode']);?>" placeholder="Zip" name="zip" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2">Date of Birth *</label>
													<div class="col-sm-10">
														<select name="DOBMonth">
															<option>- Month -</option> 				<!-- Make required -->
															<option value="01">January</option>
															<option value="02">February</option>
															<option value="03">March</option>
															<option value="04">April</option>
															<option value="05">May</option>
															<option value="06">June</option>
															<option value="07">July</option>
															<option value="08">August</option>
															<option value="09">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
														</select>
														<select name="DOBDay">
															<option>- Day -</option> 				<!-- Make required -->
															<option value="01">1</option>
															<option value="02">2</option>
															<option value="03">3</option>
															<option value="04">4</option>
															<option value="05">5</option>
															<option value="06">6</option>
															<option value="07">7</option>
															<option value="08">8</option>
															<option value="09">9</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
															<option value="25">25</option>
															<option value="26">26</option>
															<option value="27">27</option>
															<option value="28">28</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
														</select>
														<select name="DOBYear">
															<option> - Year - </option>										<!-- Make required -->
															<option value="1999">1999</option>
															<option value="1998">1998</option>
															<option value="1997">1997</option>
															<option value="1996">1996</option>
															<option value="1995">1995</option>
															<option value="1994">1994</option>
															<option value="1993">1993</option>
															<option value="1992">1992</option>
															<option value="1991">1991</option>
															<option value="1990">1990</option>
															<option value="1989">1989</option>
															<option value="1988">1988</option>
															<option value="1987">1987</option>
															<option value="1986">1986</option>
															<option value="1985">1985</option>
															<option value="1984">1984</option>
															<option value="1983">1983</option>
															<option value="1982">1982</option>
															<option value="1981">1981</option>
															<option value="1980">1980</option>
															<option value="1979">1979</option>
															<option value="1978">1978</option>
															<option value="1977">1977</option>
															<option value="1976">1976</option>
															<option value="1975">1975</option>
															<option value="1974">1974</option>
															<option value="1973">1973</option>
															<option value="1972">1972</option>
															<option value="1971">1971</option>
															<option value="1970">1970</option>
															<option value="1969">1969</option>
															<option value="1968">1968</option>
															<option value="1967">1967</option>
															<option value="1966">1966</option>
															<option value="1965">1965</option>
															<option value="1964">1964</option>
															<option value="1963">1963</option>
															<option value="1962">1962</option>
															<option value="1961">1961</option>
															<option value="1960">1960</option>
															<option value="1959">1959</option>
															<option value="1958">1958</option>
															<option value="1957">1957</option>
															<option value="1956">1956</option>
															<option value="1955">1955</option>
															<option value="1954">1954</option>
															<option value="1953">1953</option>
															<option value="1952">1952</option>
															<option value="1951">1951</option>
															<option value="1950">1950</option>
															<option value="1949">1949</option>
															<option value="1948">1948</option>
															<option value="1947">1947</option>
														</select>								<!-- Wanna have a date picker instead? or have it populate the drop downs? -->
													</div>								
												</div>

												<h4>Please answer the following questions.</h4>
																		
												<div class="form-group">
                                                    <label class="col-sm-5">When are you able to transport animals?</label>
                                                    <div class="col-sm-7">
                                                        <div class="checkbox">
                                                            <p><input type="checkbox" name="transport1" value="Weekdays">Weekdays</p>
															<p><input type="checkbox" name="transport2" value="Weekends">Weekends</p>
                                                            <p><input type="checkbox" name="transport3" value="Anytime">Anytime</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
													<label class="col-sm-3">Are you rabies vaccinated?</label>
													<div class="col-sm-7">
														<div class="checkbox">
															<input type="radio" name="rabies" value="Yes" <?php if (isset($_POST['rabies']) && $_POST['rabies'] == 'Yes') echo ' checked="checked"';?>> Yes
															<input type="radio" name="rabies" value="No" <?php if (isset($_POST['rabies']) && $_POST['rabies'] == 'No') echo ' checked="checked"';?>> No
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3">If so, how recently? Please provide proof of vaccination. Upload an attachment.</label>
													<div>
														<select name="VACMonth">
															<option>- Month -</option>
															<option value="01">January</option>
															<option value="02">February</option>
															<option value="03">March</option>
															<option value="04">April</option>
															<option value="05">May</option>
															<option value="06">June</option>
															<option value="07">July</option>
															<option value="08">August</option>
															<option value="09">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
														</select>
														<select name="VACDay">
															<option>- Day -</option>
															<option value="01">1</option>
															<option value="02">2</option>
															<option value="03">3</option>
															<option value="04">4</option>
															<option value="05">5</option>
															<option value="06">6</option>
															<option value="07">7</option>
															<option value="08">8</option>
															<option value="09">9</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
															<option value="25">25</option>
															<option value="26">26</option>
															<option value="27">27</option>
															<option value="28">28</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
														</select>
														<select name="VACYear">
															<option> - Year - </option>
															<option value="2017">2017</option>
															<option value="2016">2016</option>
															<option value="2015">2015</option>
															<option value="2014">2014</option>
															<option value="2013">2013</option>
															<option value="2012">2012</option>
															<option value="2011">2011</option>
															<option value="2010">2010</option>
															<option value="2009">2009</option>
															<option value="2008">2008</option>
															<option value="2007">2007</option>
															<option value="2006">2006</option>
															<option value="2005">2005</option>
															<option value="2004">2004</option>
															<option value="2003">2003</option>
															<option value="2002">2002</option>
															<option value="2001">2001</option>
															<option value="2000">2000</option>
															<option value="1999">1999</option>
															<option value="1998">1998</option>
															<option value="1997">1997</option>
															<option value="1996">1996</option>
															<option value="1995">1995</option>
															<option value="1994">1994</option>
															<option value="1993">1993</option>
															<option value="1992">1992</option>
															<option value="1991">1991</option>
														</select>								<!-- Wanna have a date picker instead? or have it populate the drop downs? -->
													</div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="btn btn-default btn-file">
															<input name="rabbiesDocumentation" id = "rabbiesDocumentation" type="file" multiple /></span>
														<span class="fileinput-filename"></span>
														<span class="fileinput-new"></span>
													</div>
												</div>
												<label class="col-sm-6">How far are you willing to travel for transport (i.e., 30-45 miles from your location, to a specific location, etc)?</label>
												<div class="col-sm-6">
													<textarea class="form-control" name = "travel" rows="5" cols="90"></textarea>
												</div>
												<div class="form-group">
													<label class="col-sm-12"><center><h3>Capturing Wildlife</h3></center></label>
														</br>
																	
													<label class="col-sm-12"><h4>Sometimes rescuers need assistance with capturing and containing a wild animal in need.  For those who are interested in capturing injured animals: </h4>
													</label>                          
													<p class="col-sm-6">Know that we do not ask transporters to attempt risky captures of dangerous animals. Also, as a volunteer, you can always say “no” if you are uncomfortable with a situation.</p>
													<p class="col-sm-6">
														If you are considering attempting a capture/rescue, we are available by phone to give advice on the best way to go about attempting a rescue safely.
													</p>
													<p class="col-sm-6">We can advise you on any particularly helpful items or equipment to take with you.</p>
													<p class="col-sm-6">
													   We have humane live traps available to assist you, if needed.
													</p>
													<label class="col-sm-12"><h4>Sometimes rescuers need assistance with capturing and containing a wild animal in need.  For those who are interested in capturing injured animals: </h4>
													<div class="form-group">
														<label class="col-sm-5">With that in mind, would you be willing to assist with capturing animals, if needed?</label>
														<div class="col-sm-7">
															<div class="checkbox">
																<p><input type="radio" name="capture" value="Yes"> Yes, I am willing to capture animals.</p>
																<p><input type="radio" name="capture" value="No"> No, I'd prefer to strictly transport.</p>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-5">Transporter Guidelines</label>
														<div class="col-sm-7">
															<div class="checkbox">
																<input type="radio" name="acknowledge" required = "required"value="x"> I am acknowledging that I have read the transporter guidelines and I promise to abide by these guidelines when I transport for the Wildlife Center of Virginia.
															</div>
														</div>
													</div>
												</div>
											</fieldset>
											<footer class="panel-footer">
												<button class="btn btn-primary" type="submit" name = 'upload' id = 'upload'>Submit form</button>
												<button class="btn btn-default" type="reset">Reset</button>
											</footer>
										</form>
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
							<span class="pull-right" class="footer" > &copy; 2017. All rights reserved. Owl Team
						</div>
					</div>
				</footer>
			</div>
		</section>



		
<!-- IS ANY OF THIS NEEDED??





		
    <!-- simple dialog --
    <div class="modal fade" id="simpledialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content --
      </div><!-- /.modal-dialog --
    </div><!-- /.modal --

    <!-- yes/no dialog --
    <div class="modal fade" id="yesno" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div><!-- /.modal-content --
      </div><!-- /.modal-dialog --
    </div><!-- /.modal --

    <!-- user input dialog --
    <div class="modal fade" id="prompt" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">This is a modal dialog</h4>
          </div>
          <div class="modal-body">
              <p>
                  You can only interact with elements that are inside this dialog.
                  To close it click a button or use the ESC key.
              </p>
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Recipient:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Message:</label>
                  <textarea class="form-control" id="message-text"></textarea>
                </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div><!-- /.modal-content --
      </div><!-- /.modal-dialog --
    </div><!-- /.modal --


    <!-- render blocking scripts --

    <!-- jQuery JS --
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap JS --
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Main Script --
    <script src="js/global.js"></script>
	
	
	
	IS ANY OF THIS NEEDED??
	
-->	
	
</body>
</html>
