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


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Team Lead"){
	header("Location: restrictedAccess.php");
	exit();
}
*/

if(isset($_POST['btnExport'])){
	
//EXPORT TO EXCEL USING PHPExcel
date_default_timezone_set('America/New_York');

require_once('PHPExcel.php');

$sheet = array();
    $sheet[] = array(
      'First Name',
      'Last Name',
      'Email',
      'YTD Hours',
	  'Total Hours',
      'YTD Miles',
      'Total Miles');
	  
	
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
	$sql = "SELECT MAX(Person_ID) FROM Person";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$total = $row['MAX(Person_ID)'];
		}
	} 
for($i = 1; $i <= $total; $i++){
	$id = $i;
	$transID = null;
	$ytdHours = '0';
	$totalHours = '0';
	$ytdHoursTrans = '0';
	$totalHoursTrans = '0';
	$ytdMiles = '0';
	$totalMiles = '0';
	$first = null;
	//SQL Statement to gather Person info
	$sql = "SELECT Person_FirstName, Person_LastName, Person_Email FROM Person WHERE (Person_ID = " .$id.") AND (Person_UserType = 'Volunteer')";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
		  $first = $row['Person_FirstName'];
		  $last = $row['Person_LastName'];
		  $email = $row['Person_Email'];
		}
	} 
	else {
		$id = null;
	}
	 //Gather YTD and Total hours
	 if($id != null){
		$sql = "SELECT MAX(LogHours_YTDHours), MAX(LogHours_TotalHours) FROM LogHours WHERE LogHours_PersonID = ".$id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			// output data of each row
			while($row = $result->fetch_assoc()) {
				
			  $ytdHours = $row['MAX(LogHours_YTDHours)'];
			  $totalHours = $row['MAX(LogHours_TotalHours)']; 
			  
			}
		}
		else{
			$id = null;
		}
	}
	//Get transporterID
	if($id !=null){
		$sql = "SELECT Transporter_ID FROM Transporter WHERE Transporter_PersonID = " . $id;
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
	
	if($first != null){
		$sheet[] = array(
			$first,
			$last,
			$email,
			$ytdHours + $ytdHoursTrans,
			$totalHours + $totalHoursTrans,
			$ytdMiles,
			$totalMiles);
	}


}
$conn->close();


  $doc = new PHPExcel();
  $doc->setActiveSheetIndex(0);

  $doc->getActiveSheet()->fromArray($sheet, null, 'A1');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="your_name.xls"');
header('Cache-Control: max-age=0');
ob_end_clean();

  // Do your stuff here
  $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');

$writer->save('php://output');
}
//Go to tableau page
if(isset($_POST['btnTableau'])){
	header("Location: tableauChart.php");
	exit();
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
    
                  <a class="navbar-brand" href="calendar2.php"><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">
							<li><a href="calendar2.php">Calendar</a></li>
							<li><a href="profilesearch.php">Search</a></li>	
							<li class="active"><a href="excel.php">Excel</a></li>								
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
                            <div id="centered">
                                <div class="col-md-7 no-padding">
                                    <div class="main-content panel panel-default no-margin">
									<form method="post">
									<h4>Export Hours/Miles to Excel</h4>
                                        <input type="submit" name="btnExport" class="btn btn-primary" value="Export to Excel">
									</form>
									<form method="post">
									<h4>View Transporter data in Tableau</h4>
                                        <input type="submit" name="btnTableau" class="btn btn-primary" value="View Tableau">
									</form>
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
