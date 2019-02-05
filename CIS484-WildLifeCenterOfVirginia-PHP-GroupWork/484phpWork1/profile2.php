<!DOCTYPE html>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<?php
//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType']; 
$profileID = $_GET['profileID'];
//If null it's from returning from confirmation page 
if ($profileID == null) {
	$profileID = $_SESSION['profileEdit'];
}
$_SESSION['profileEdit'] = $profileID;


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Team Lead"){
	header("Location: restrictedAccess.php");
	exit();
}

*/


//THIS IS THE TEAM LEAD VIEW, SO MAKE SURE YOU ARE GETTING THE VOLUNTEER'S INFO AND NOT TEAM LEAD. DO NOT USE THE $userID variable




//$profileID = whoever the profile is about that the team lead is looking at
//Gather information to populate profile
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
$sql = "SELECT Person_UserType, Person_FirstName, Person_LastName, Person_PhonePrimary, Person_Email, Person_StreetAddress, Person_City,
Person_State, Person_Zipcode, Person_AllergiesYN, Person_Allergies, Person_WorkOutside, Person_OutsideLimitations, Person_RabiesYN, 
Person_RehabilitateYN, Person_TeamLeadNotes, Person_Status, Person_DepartmentID, Person_Days, Person_AvailabilityType FROM Person WHERE Person_ID =" .$profileID;
$result = $conn->query($sql);
if ($result->num_rows > 0){
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$userType = $row['Person_UserType'];
		$first = $row['Person_FirstName'];
		$last = $row['Person_LastName'];
		$phone = $row['Person_PhonePrimary'];
		$email = $row['Person_Email'];
		$street = $row['Person_StreetAddress'];
		$city = $row['Person_City'];
		$state = $row['Person_State'];
		$zipcode = $row['Person_Zipcode'];
		$allergiesYN =$row['Person_AllergiesYN'] . " - ";
		$allergies =$row['Person_Allergies'];
		$outsideYN = $row['Person_WorkOutside'] . " - ";
		$outside = $row['Person_OutsideLimitations'];
		$rabiesYN = $row['Person_RabiesYN'];
		$permitYN = $row['Person_RehabilitateYN'];
		$teamLeadNotes = $row['Person_TeamLeadNotes'];
		$status = $row['Person_Status'];
		$departmentID = $row['Person_DepartmentID'];
		$daysAvailable = $row['Person_Days'];
		$availabilityType = $row['Person_AvailabilityType'];
		
	}
}


	$sql = "SELECT OutreachApp_WhyInterested, OutreachApp_PassionateWildlifeIssue,
					OutreachApp_ExperiencePublicSpeaking, OutreachApp_BelongToAnimalRightsGroup,
					OutreachApp_BringToTeam FROM OutreachApp 
				WHERE OutreachApp_PersonID = '" . $profileID . "'";


$result = $conn->query($sql);
$whyInterested = "";
$wildlifeIssue = "";
$publicSpeaking = "";
$wildlifeGroup = "";
$bringToTeam = "";
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$whyInterested = $row['OutreachApp_WhyInterested'];
		$wildlifeIssue = $row['OutreachApp_PassionateWildlifeIssue'];
		$publicSpeaking = $row['OutreachApp_ExperiencePublicSpeaking'];
		$wildlifeGroup = $row['OutreachApp_BelongToAnimalRightsGroup'];
		$bringToTeam = $row['OutreachApp_BringToTeam'];
	}
	
}



$sql = "SELECT AnimalCareApp_HandsOnExperience, AnimalCareApp_HandleDeadAnimals,
					AnimalCareApp_OpinionLivePrey, AnimalCareApp_WorkOutside, AnimalCareApp_BelongToAnimalRightsGroup,
					AnimalCareApp_HopeToLearnAccomplish, AnimalCareApp_PassionateWildlifeIssue,
					AnimalCareApp_MoreAboutExperience FROM AnimalCareApp 
				WHERE AnimalCareApp_PersonID = '" . $profileID . "'";


$result = $conn->query($sql);
$handsOnExperience = "";
$deadAnimals = "";
$livePrey = "";
$workOutside= "";
$animalRightsGroup = "";
$learn = "";
$wildlifeIssueA = "";
$additionalExperience = "";
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$handsOnExperience = $row['AnimalCareApp_HandsOnExperience'];
		$deadAnimals = $row['AnimalCareApp_HandleDeadAnimals'];
		$livePrey = $row['AnimalCareApp_OpinionLivePrey'];
		$workOutside= $row['AnimalCareApp_WorkOutside'];
		$animalRightsGroup = $row['AnimalCareApp_BelongToAnimalRightsGroup'];
		$learn = $row['AnimalCareApp_HopeToLearnAccomplish'];
		$wildlifeIssueA = $row['AnimalCareApp_PassionateWildlifeIssue'];
		$additionalExperience = $row['AnimalCareApp_MoreAboutExperience'];
	}
	

}

$sql = "SELECT VetTeamApp_PreviousTraining, VetTeamApp_WorkEnvironment,
					VetTeamApp_Euthansia, VetTeamApp_Messy FROM VetTeamApp 
				WHERE VetTeamApp_PersonID = '" . $profileID . "'";

				$result = $conn->query($sql);
$training = "";
$workEnvironment = "";
$euthansia = "";
$messy = "";
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$training = $row['VetTeamApp_PreviousTraining'];
		$workEnvironment = $row['VetTeamApp_WorkEnvironment'];
		$euthansia = $row['VetTeamApp_Euthansia'];
		$messy = $row['VetTeamApp_Messy'];
		
	}
	

}

$sql = "SELECT TransporterApp_DistanceWillingToTravel, TransporterApp_CaptureAnimals
				FROM TransporterApp 
				WHERE TransporterApp_PersonID = '" . $profileID . "'";

				$result = $conn->query($sql);
$distance = "";
$capture = "";
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$distance = $row['TransporterApp_DistanceWillingToTravel'];
		$capture = $row['TransporterApp_CaptureAnimals'];
		
	}
	

}


//Get Hours/Miles data
$ytdHours = '0';
$totalHours = '0';
$ytdHoursTrans = '0';
$totalHoursTrans = '0';
$ytdMiles = '0';
$totalMiles = '0';
//Gather YTD and Total hours
$sql = "SELECT LogHours_YTDHours, LogHours_TotalHours FROM LogHours WHERE LogHours_PersonID = ".$profileID;
$result = $conn->query($sql);
if ($result->num_rows > 0){
	// output data of each row
	while($row = $result->fetch_assoc()) {
		
	  $ytdHours = $row['LogHours_YTDHours'];
	  $totalHours = $row['LogHours_TotalHours']; 
	}
}

//Get transporterID
$transID = null;
$sql = "SELECT Transporter_ID FROM Transporter WHERE Transporter_PersonID = " . $profileID;
$result = $conn->query($sql);
if ($result->num_rows > 0){
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$transID = $row['Transporter_ID'];
	}
}
else{
	$transID = null;
}
 //Gather YTD and Total Miles if exists
 if($transID != null){
	$sql = "SELECT LogTransport_YTDHours, LogTransport_TotalHours, LogTransport_YTDMiles, LogTransport_TotalMiles FROM LogTransport WHERE LogTransport_TransportID = ".$transID;
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
		  $ytdHoursTrans = $row['LogTransport_YTDHours'];
		  $totalHoursTrans = $row['LogTransport_TotalHours'];
		  $ytdMiles = $row['LogTransport_YTDMiles'];
		  $totalMiles = $row['LogTransport_TotalMiles']; 		  
		}
	}
 }
 //Get profile pic
 $pic = false;
 $sql = "SELECT * FROM Documentation WHERE (Documentation_PersonID = ".$profileID.") AND (Documentation_TypeOfDocument = 'picture')";
	$sth = $conn->query($sql);
	$result=mysqli_fetch_array($sth);
	if ($result != null){
		$pic = true;
	}
$conn->close();

if(isset($_POST['btnResume']))
	{
		$connection =  mysqli_connect("localhost","root","Twspike1994?","wildlife")
                             or die('Database Connection Failed');
             mysqli_set_charset($connection,'utf-8');

          // Change to whatever necessary Person_ID
		  $id = $profileID;
		  $whichDoc = "Resume"; //Change to the docType (Resume, Picture, LetterOfReccomendation1, LetterOfReccomendation2, etc.)
          $query = "SELECT Documentation_PersonID, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent
		  FROM Documentation WHERE Documentation_PersonID = '$id' AND Documentation_TypeOfDocument = '$whichDoc'"; 
          $result = mysqli_query($connection,$query) 
                     or die('Error, query failed');
         list($id, $file, $type, $size,$content) =   mysqli_fetch_array($result);
           //echo $id . $file . $type . $size;
         header("Content-length: $size");
         header("Content-type: $type");
         header("Content-Disposition: attachment; filename=$file");
         ob_clean();
         flush();
         echo $content;
         mysqli_close($connection);
         exit;
	}
if(isset($_POST['btnRehabilitation_Permit']))
{
	$connection =  mysqli_connect("localhost","root","Twspike1994?","wildlife")
						 or die('Database Connection Failed');
		 mysqli_set_charset($connection,'utf-8');

	  // Change to whatever necessary Person_ID
	  $id = $profileID;
	  $whichDoc = "Rehabilitation_Permit"; //Change to the docType (Resume, Picture, LetterOfReccomendation1, LetterOfReccomendation2, etc.)
	  $query = "SELECT Documentation_PersonID, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent
	  FROM Documentation WHERE Documentation_PersonID = '$id' AND Documentation_TypeOfDocument = '$whichDoc'"; 
	  $result = mysqli_query($connection,$query) 
				 or die('Error, query failed');
	 list($id, $file, $type, $size,$content) =   mysqli_fetch_array($result);
	   //echo $id . $file . $type . $size;
	 header("Content-length: $size");
	 header("Content-type: $type");
	 header("Content-Disposition: attachment; filename=$file");
	 ob_clean();
	 flush();
	 echo $content;
	 mysqli_close($connection);
	 exit; 
}
if(isset($_POST['btnRabies_Documentation']))
{
	$connection =  mysqli_connect("localhost","root","Twspike1994?","wildlife")
						 or die('Database Connection Failed');
		 mysqli_set_charset($connection,'utf-8');

	  // Change to whatever necessary Person_ID
	  $id = $profileID;
	  $whichDoc = "Rabies_Documentation"; //Change to the docType (Resume, Picture, LetterOfReccomendation1, LetterOfReccomendation2, etc.)
	  $query = "SELECT Documentation_PersonID, Documentation_FileName, Documentation_FileType, Documentation_FileSize, Documentation_FileContent
	  FROM Documentation WHERE Documentation_PersonID = '$id' AND Documentation_TypeOfDocument = '$whichDoc'";
	  $result = mysqli_query($connection,$query) 
				 or die('Error, query failed');
	 list($id, $file, $type, $size,$content) =   mysqli_fetch_array($result);
	   //echo $id . $file . $type . $size;
	 header("Content-length: $size");
	 header("Content-type: $type");
	 header("Content-Disposition: attachment; filename=$file");
	 ob_clean();
	 flush();
	 echo $content;
	 mysqli_close($connection);
	 exit;
}
if(isset($_POST['btnAccept'])){
	$servername = "localhost";
	$username = "root";
	$dbpassword = "Twspike1994?";
	$dbname = "wildlife";

	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$query = "UPDATE Person SET Person_UserType = 'Volunteer' WHERE Person_ID = " .$profileID; 
	
	if(!mysqli_query($conn,$query))

	{
		echo("Error description: " . mysqli_error($conn));
	}

	else
	{
	require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';
	$emailAddress = $_POST['email'];
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

	$mail->addAddress('seilermr@dukes.jmu.edu');     // recipient... change to $emailAddress

	$mail->Subject = 'Wildlife Center of Virginia Application Update';
	$mail->Body    = 'Thank you for your interest in the Wildlife Center!<br>
                  We are pleased to inform you of your new volunteer role at the Wildlife Center. We will be in touch with more information soon!
                  ';
	$mail->AltBody = 'Thank you for your interest in the Wildlife Center!<br>
	  We are pleased to inform you of your new volunteer role at the Wildlife Center. We will be in touch with more information soon!
	  ';

	
	$mail->AltBody = $_POST['emailBody'];

	
	$mail->isHTML(true);                                  // Set email format to HTML

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	 else {
		$conn->close();
		header("Location: accepted.php");
		exit();

  
	}
	}
}
if(isset($_POST['btnReject'])){
	$servername = "localhost";
	$username = "root";
	$dbpassword = "Twspike1994?";
	$dbname = "wildlife";

	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$query = "UPDATE Person SET Person_UserType = 'Rejected' WHERE Person_ID = " .$profileID; 
	
	if(!mysqli_query($conn,$query))

	{
		echo("Error description: " . mysqli_error($conn));
	}
	
	else
	{
		require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';
	$emailAddress = $_POST['email'];
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

	$mail->addAddress('seilermr@dukes.jmu.edu');     // recipient... change to $emailAddress

	$mail->Subject = 'Wildlife Center of Virginia Application Update';
	$mail->Body    = 'Thank you for your interest in the Wildlife Center!<br>
                  However, at this time we have decided not to move forward with your application.
                  ';
	$mail->AltBody = 'Thank you for your interest in the Wildlife Center!<br>
	  However, at this time we have decided not to move forward with your application.
	  ';

	
	$mail->AltBody = $_POST['emailBody'];

	
	$mail->isHTML(true);                                  // Set email format to HTML

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	 else {
		$conn->close();
		header("Location: rejected.php");
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
                    </div>
    
                  <a class="navbar-brand" href="profile2.php"><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">
							<li><a href="calendar2.php">Calendar</a></li>
							<li class="active"><a href="profilesearch.php">Search</a></li>
							<li><a href="excel.php">Excel</a></li>							
                            <li><a href="accountProfile.php">Account</a></li>                          
                            <li><a href="index.php">Sign Out</a></li>                     
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



                    <section class="col-md-9 no-padding">
                        <div class="main-section">
                        
                            <div class="container-fluid no-padding">
                                <div class="col-md-7 no-padding">
                                    <div class="main-content panel panel-default no-margin">
                                        <header class="panel-heading clearfix">

                                             <?php
										if($pic == true){
											echo '<img class="img-responsive col-sm-4" src="data:image/jpeg;base64,'.base64_encode( $result['Documentation_FileContent'] ).'"/>';
										}
										else{
											echo '<img src="images/johndoe.png" class="img-responsive col-sm-4"></span>';
										}
										?>
                                             <hgroup>
                                                 <a href="editprofile2.php" class="btn btn-default pull-right" rel="#overlay">Edit Profile<i class="fa fa-question-circle"></i></a>
                                                 <h2>
                                                     <?php echo $first . " " . $last?>
                                                 </h2>
                                                 <h4><?php echo $userType ?> </h4>
												 <h5><?php if ($userType == 'Volunteer') echo "Status: " . $status; ?> </h5>
                                             </hgroup>
                                            
                                        </header>
<div class="content">
                                        <h3>Contact Information</h3>
<div class="panel panel-default">
  <div class="panel-body">
    <strong>Email - </strong> <?php echo $email ?>
  </div>
</div>                                        
<div class="panel panel-default">
  <div class="panel-body">
    <strong>Phone - </strong> <?php echo $phone ?>
  </div>
</div>    
<div class="panel panel-default">
  <div class="panel-body">
    <strong>Address - </strong> <?php echo $street. ', '. $city.', '. $state . ' ' .$zipcode ?>
  </div>
</div>  
<div class="row">
<div class="col-sm-6">
<h4>Volunteer Hours</h4>
<ul>
	<li>YTD Hours: <?php echo $ytdHours + $ytdHoursTrans ?></li>
	<li>Total Hours: <?php echo $totalHours + $totalHoursTrans ?></li>
</ul>  </div>                                        
<div class="col-sm-6">
<h4>Transport Miles</h4>
<ul>
	<li>YTD Miles: <?php echo $ytdMiles ?></li>
	<li>Total Miles: <?php echo $totalMiles ?></li>
</ul>
</div></div>

                                      
                                        <h3>Outreach</h3>
                                        <div class="row">
                                        <div class="col-sm-6">
                                        <h4>Tours</h4>
                                        <ul>
                                            <li>Shadow: 1</li>
                                            <li>Intro Portion: Yes</li>
                                            <li>Lead Alone: No</li>
                                        </ul>  </div>                                        <div class="col-sm-6"><h4>Off-Site Displays</h4>
               <p>Yes</p></div></div>
<div class="row col-sm-12">
<h4>Animal Handling</h4>
</div>
<div class="row">
<div class="col-sm-6">
<p>Reptile Handling Overview:</p>
<ul>      <li>Alligator</li>
            <li>Iguana</li>
                  <li>Chameleon</li></ul>
<p>No additional notes</p></div>

<div class="col-sm-6">
<p>Raptor Handling Overview:</p>
                                        <ul>
                                            <li>Falconers Knot: No</li>
                                            <li>Parrot</li>
                                            <li>Flamingo</li>
                                            <li>Raven</li> 
                                            <li>Penguin</li>
                                                                                    </ul>
                                            <p>No additional notes</p>

                                    </div> <div>

                                    
                                    <h3>Application Responses</h3>
                                    
											<div class="panel panel-default">
												<div >

												<?php if ($departmentID == 1) { ?> 
												<?= ' <h4>Outreach Questions <?= $departmentID ?></h4>
													<h4>Why Interested</h4>
													<ul>
														<strong>Why are you interested in volunteering as an outreach docent? </strong> ' .$whyInterested. '

													</ul>

													<h4>Wildlife Issues</h4>
													<ul>
														<strong>What’s an environmental or wildlife issue you feel passionately about, and why? </strong> ' .$wildlifeIssue. '
													</ul>
													<h4>Public Speaking</h4>
													<ul>
														<strong>Do you have prior experience speaking to the public? Please describe. </strong> ' .$publicSpeaking. '
													</ul>
													<h4>Wildlife Groups</h4>
													<ul>
														<strong>Do you belong to any animal rights groups (PETA, The Humane Society, etc.)? If so, which ones? </strong> ' .$wildlifeGroup. '
													</ul>
													<h4>Contributions</h4>
													<ul>
														<strong>What do you think you’d bring to the outreach volunteer team?
														</strong> ' .$bringToTeam. '
													</ul>';}?>
													</div>


													<?php if ($departmentID == 2) { ?> 
												<?= ' <h4>Animal Care Questions </h4>
													<h4>Hands On Experience</h4>
													<ul>
														<strong>Please briefly describe your relevant hands-on experience with animals, if any. What did you enjoy about the experience? What did you dislike? </strong> ' .$handsOnExperience. '
													</ul>

													<h4>Wildlife Issues</h4>
													<ul>
														<strong>Carnivorous patients are sometimes unable to eat food items whole due to their injuries; you may be required to cut and divide dead rodents, chicks, and fishes into smaller portions. Are you comfortable handling dead animals for this purpose? 
														</strong> ' .$deadAnimals. '
													</ul>
													<h4>Public Speaking</h4>
													<ul>
														<strong>Prior to release from the Wildlife Center, many predatory birds are presented with live mice in order to evaluate their ability to capture prey in a controlled and measurable environment. What is your opinion on using live-prey for this purpose? 
														</strong> ' .$livePrey. '
													</ul>
													<h4>Limitations</h4>
													<ul>
														<strong>Wildlife rehabilitation requires daily outdoor work -- year-round and regardless of weather conditions. Are you able to work outside during all seasons? If not, what are your limitations? </strong> ' .$workOutside. '
													</ul>
													<h4>Animal Rights Groups</h4>
													<ul>
														<strong>Do you belong to any animal rights groups (PETA, The Humane Society, etc.)? If so, which ones? </strong> ' .$animalRightsGroup. '
													</ul>
													<h4>Accomplishment</h4>
													<ul>
														<strong>What do you hope to learn or accomplish by volunteering at the Wildlife Center of Virginia? </strong> ' .$learn. '
													</ul>
													<h4>Wildlife-Based Issue</h4>
													<ul>
														<strong>Please describe an environmental or wildlife-based issue you feel passionately about, and why. </strong> ' .$wildlifeIssueA. '
													</ul>
													<h4>Additional Information</h4>
													<ul>
														<strong>Is there anything else that you’d like us to know about yourself or your experience?
														</strong> ' .$additionalExperience.'
													</ul>';}?>
													
                               </div>
                               

                               
                               <div class="col-sm-6">
                           

												<?php if ($departmentID == 3) {  ?>
												<?= '<h4>Vet Team Questions</h4>
													<h4>Previous Training</h4>
													<ul>
														<strong>Please describe any previous medical or veterinary training you have completed.
														</strong> ' .$training. ' 
													</ul>

													<h4>Animal Handling</h4>
													<ul>
														<strong>The case load at the Center can be unpredictable and vary greatly depending on the time of year. Please describe the work environment that you work best in including how you best retain information that is taught to you.
														</strong> ' .$workEnvironment. '
													</ul>
													<h4>Euthanasia Experience</h4>
													<ul>
														<strong>The Center admits many trauma cases. In order for a patient to be released back into the wild it must be able to successfully survive on its own free of chronic pain. Due to this, the Center does humanely euthanize patients that do not meet this standard. Do you have experience with euthanasia and how does it affect you? 
														</strong> ' .$euthansia. '
													</ul>
													<h4>Maintenance</h4>
													<ul>
														<strong>Taking care of animals is a messy job that requires all team members to clean out dirty crates, chop rats or mice for feeding to patients, and collect fecal samples for analysis for example. Is this something that you foresee struggling with?
														</strong> ' .$messy. '
													</ul>';}
													 ?>

													
													</div>

													<?php if ($departmentID == 4) {  ?>
													<?= '<h4>Transporter Questions</h4>
													<h4>Travel Distance</h4>
													<ul>
														<strong>How far are you willing to travel for transport (i.e., 30-45 miles from your location, to a specific location, etc)?
														</strong> ' .$distance. ' 
													</ul>

													<h4>Animal Handling</h4>
													<ul>
														<strong>Sometimes rescuers need assistance with capturing and containing a wild animal in need. For those who are interested in capturing injured animals. With that in mind, would you be willing to assist with capturing animals, if needed?
														</strong> ' .$capture. '
													</ul>';} ?>
													
                               </div></div></div>
                               </div>
                                   
                               
							   
<?php

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
//SQL Statement to gather Documents to display download buttons
$sql = "SELECT Documentation_TypeOfDocument FROM Documentation WHERE Documentation_PersonID =" .$profileID;
$result = $conn->query($sql);
if ($result->num_rows > 0){
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$docType = $row['Documentation_TypeOfDocument'];
		
		
		echo '
		<form method="post"><p>Download ' .$docType . ':</p>
		<button  name="btn'.$docType.'" class="btn btn-default" type="submit">Download</button></form>';
							   
	}
}
?>

							   </div>
							   
                                <div class="preview-pane col-md-5">
        <div class="panel panel-default"><div class="panel-body"><h4>Team Lead Notes:</h4>  </ul>
		<?php echo ($teamLeadNotes);?>
                                    </div></div>
                                         <ul class="additionalinfo" class="fa-ul pull-right">
                                            <h2>Additional info</h2>
                                            <h4>Allergies</h4> <?php echo $allergiesYN . $allergies?>
                                            <h4>Outside/Physical Limitations</h4> <?php echo $outsideYN . $outside ?>
                                            <h4>Rabies Vaccinated</h4> <?php echo $rabiesYN ?>
                                            <h4>Permit</h4> <?php echo $permitYN ?>
                                            <h4>Emergency Contact</h4> Sean Young (540)555-8202

                                       
    <h4>Weekly Availability</h4> 
    <i><?php echo $availabilityType ?></i> <br>
    <?php echo $daysAvailable ?> </ul>
    <!-- <img src="images/joecalendar.png" alt="calendar" class="img-responsive"> -->

	<div class="form-group">
	<form method="post">
		<button name="btnAccept"  class="btn btn-default" <?php if(($userType != "Applicant") && ($userType != "Rejected")) echo 'style="display:none;"'?> type="submit">Accept Applicant</button>
		<button name="btnReject"class="btn btn-default" <?php if($userType != "Applicant") echo 'style="display:none;"'?> type="submit">Reject Applicant</button>
	</form>
	</div>
	  </div>
                                    
                                    </div>
                                    <div class="preview">
                                    </div>
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
			    
                <span class="pull-right"> &copy; 2017. All rights reserved. Owl Team
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
