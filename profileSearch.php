<!DOCTYPE html>
<?php
//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType'];
$profileID = $_SESSION['profileID']; 


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Team Lead"){
	header("Location: restrictedAccess.php");
	exit();
}

*/

if(isset($_POST['emailSelected']))
{
	
	//Create email array
	$emailArray = array();
	//Add values to array
	foreach($_POST['check'] as $value) 
	{
		$emailArray[] = $value;
	}
	
	//Put the array in a session variable
	$_SESSION['profileEmail']= $emailArray;
		
	if( count($emailArray) > 0 ){
		header("Location: emailSelected.php");
		exit();
	}
	else{
		$message = 'Please select at least one checkbox to send email';
		echo "<SCRIPT>
		alert('$message');
		</SCRIPT>";
	}
}


?>
<!-- Select all checkboxes -->
<script type="text/javascript">

    function do_this(){

        var checkboxes = document.getElementsByName('check[]');
        var button = document.getElementById('toggle');

        if(button.value == 'Select All'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'Deselect All'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'Select All';
        }
    }
</script>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }
            .wrapper {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -120px;
            }
            .footer, .push {
                height: 120px;
            }
        </style>

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
<style>
table, th, td {
    border: 1px solid black;
	padding: .8em;
}

</style>
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

    <div class="container">
    <div class="row">
        <div id="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form"> <!-- action="Datebase.php" -->
						View current building occupants: <button type="occupants" name="occupants" value="Search" class="btn btn-default filter-col">
                                Occupants
                            </button>
							<br>	
								<h4>Search Profiles</h4>
					   <div class="form-group">
                            <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Search:</label>
                            <input type="text" class="form-control input-sm" name="pref-search" placeholder="First or Last Name" id="pref-search">
                        </div><!-- form group [search] -->                               
                        </div> <!-- form group [rows] -->
                        
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;"  for="pref-selectteam">Filter Team:</label>
                            <select name="pref-selectteam" id="pref-selectteam" class="form-control">
                                <option value="null">Select Team</option>
                                <option value="Animal Care">Animal Care</option>
                                <option value="Front Desk">Front Desk</option>
                                <option value="Outreach">Outreach</option>
                                <option value="Transporter">Transporter</option>
                                <option value="Vet Team">Vet Team</option>
                            </select>                                
                        </div> <!-- form group [Select Team] --> 
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-namefilter">Sort By:</label>
                            <select name="pref-namefilter" id="pref-namefilter" class="form-control">
                                <option value="lastName">Last Name</option>
                                <option value="firstName">First Name</option>
                            </select> 
						</div>
						<!-- form group [Select Team] -->   
						<div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-namefilter">Filter By:</label>
                            <select name="pref-roleFilter" id="pref-roleFilter" class="form-control">
                                <option value="volunteer">Volunteer</option>
                                <option value="applicant">Applicant</option>
								<option value="volApp">Volunteer & Applicant</option>
								<option value="rejected">Rejected</option>
                            </select> 
						</div>						
                        
						
						
						
						
                            <button type="submit" name="submit" value="Search" class="btn btn-default filter-col">
                                Submit
                            </button>  
							
							<section id="displayInfo">

			<fieldset id="displayField">
				<table>
					<thead>
						<tr>
							<th><input type="button" id="toggle" value="Select All" onClick="do_this()" /></th>
							<th>Profile</th>
							<th>First Name</th> 
							<th>Last Name</th>
							<th>Type</th>
							<th>Department</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>
					</thead>
					<tbody> 
						<!--Use a while loop to make a table row for every Database row-->
						<?php 
						$tableType = null;
						//For occupancy
						if (isset($_POST['occupants'])){
							$tableType = "Occupants";
							
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
							
							$sql = "SELECT Person.Person_FirstName, Person.Person_LastName, Person.Person_PhonePrimary
									FROM Person
									INNER JOIN LogHours ON Person.Person_ID=LogHours.LogHours_PersonID WHERE (LogHours_EndTime IS NULL) 
									AND (DATEDIFF(CURDATE(), LogHours_BeginTime)<=1)";
									
						}
						//For search
						if (isset($_POST['submit'])){
							$tableType="Search";
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
						// Variables
						$search = $_POST['pref-search'];
						$filter = $_POST['pref-selectteam'];
						$sorts = $_POST['pref-namefilter'];
						
						$position = $_POST['pref-roleFilter'];
						
						
					
					// Statments for team / Position
					
					// null/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "null" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "null" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// null/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "null" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "null" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// null/ Both
						if($search != null && $sorts == "firstName" && $filter == "null" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "null" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// null/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "null" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "null" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
						
						//////
					
					
					
					
					
						// Animal Care/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "Animal Care" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Animal Care" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Animal Care/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "Animal Care" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCareApp ON Person.Person_ID=AnimalCareApp.AnimalCareApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Animal Care" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCareApp ON Person.Person_ID=AnimalCareApp.AnimalCareApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Animal Care/ Both
						if($search != null && $sorts == "firstName" && $filter == "Animal Care" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Animal Care" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Animal Care/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "Animal Care" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Animal Care" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
						
						/////////////////////////////////////////////////////////////////////////////
						// Front Desk/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "Front Desk" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Front Desk" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Front Desk/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "Front Desk" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteersApp ON Person.Person_ID=OtherVolunteersApp.OtherVolunteersApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Front Desk" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteersApp ON Person.Person_ID=OtherVolunteersApp.OtherVolunteersApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Front Desk/ Both
						if($search != null && $sorts == "firstName" && $filter == "Front Desk" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Front Desk" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Front Desk/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "Front Desk" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Front Desk" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
						////////////////////////////////////////////////////////////////////////
						
					
					// Outreach/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "Outreach" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Outreach" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Outreach/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "Outreach" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OutreachApp ON Person.Person_ID=OutreachApp.OutreachApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Outreach" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN OutreachApp ON Person.Person_ID=OutreachApp.OutreachApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Outreach/ Both
						if($search != null && $sorts == "firstName" && $filter == "Outreach" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Outreach" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Outreach/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "Outreach" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Outreach" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
					
							////////11////////////////////////////////////////////////////////////////////////
						
					
					// Transporter/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "Transporter" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Transporter" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "Transporter" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN TransporterApp ON Person.Person_ID=TransporterApp.TransporterApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Transporter" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN TransporterApp ON Person.Person_ID=TransporterApp.TransporterApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Both
						if($search != null && $sorts == "firstName" && $filter == "Transporter" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Transporter" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "Transporter" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Transporter" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
					
					/////////////1234////
					
						////////11////////////////////////////////////////////////////////////////////////
						
					
					// Vet Team/Volunteer
						
						if($search != null && $sorts == "firstName" && $filter == "Vet Team" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Vet Team" && $position == "volunteer"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Applicant
						if($search != null && $sorts == "firstName" && $filter == "Vet Team" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeamApp ON Person.Person_ID=VetTeamApp.VetTeamApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'applicant' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Vet Team" && $position == "applicant"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeamApp ON Person.Person_ID=VetTeamApp.VetTeamApp_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'applicant' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'applicant'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Both
						if($search != null && $sorts == "firstName" && $filter == "Vet Team" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'Volunteer'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'Volunteer' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Vet Team" && $position == "volApp"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Volunteer' || Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'Applicant' ||Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Volunteer'
								|| Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'Applicant'
								||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Volunteer' ||concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'Applicant' ORDER BY Person.Person_LastName ASC";	
						}
						
						// Transporter/ Rejected
						if($search != null && $sorts == "firstName" && $filter == "Vet Team" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%'  and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%'  and Person.Person_UserType = 'rejected' ORDER BY Person.Person_FirstName ASC";	
						}
						
						if($search != null && $sorts == "lastName" && $filter == "Vet Team" && $position == "rejected"){
						
						
						$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person.Person_FirstName like '%{$search}%' and Person.Person_UserType = 'rejected' || Person.Person_LastName like '%{$search}%' and Person.Person_UserType = 'rejected'
								|| concat_ws(' ',Person.Person_FirstName,Person.Person_LastName) like '%{$search}%' and Person.Person_UserType = 'rejected' ORDER BY Person.Person_LastName ASC";	
						}
						
					
					
					
					
					
					
					// Default Statments ///////////////////////////////
				
						if($search == null && $sorts == "lastName" && $filter == "null" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "null" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "null" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "null" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "null" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "null" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "null" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "null" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						/////////////////////////
						
						
						
						
						if($search == null && $sorts == "lastName" && $filter == "Animal Care" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Animal Care" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Animal Care" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCareApp ON Person.Person_ID=AnimalCareApp.AnimalCareApp_PersonID where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Animal Care" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCareApp ON Person.Person_ID=AnimalCareApp.AnimalCareApp_PersonID where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Animal Care" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Animal Care" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "Animal Care" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Animal Care" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN AnimalCare ON Person.Person_ID=AnimalCare.AnimalCare_PersonID where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						//////////////////////
						
						
						
						if($search == null && $sorts == "lastName" && $filter == "Front Desk" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Front Desk" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Front Desk" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteersApp ON Person.Person_ID=OtherVolunteersApp.OtherVolunteersApp_PersonID where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Front Desk" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteersApp ON Person.Person_ID=OtherVolunteersApp.OtherVolunteersApp_PersonID where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Front Desk" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Front Desk" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "Front Desk" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Front Desk" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OtherVolunteers ON Person.Person_ID=OtherVolunteers.OtherVolunteers_PersonID where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						//////////////////////
						
						
						
						if($search == null && $sorts == "lastName" && $filter == "Outreach" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='Volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Outreach" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='Volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Outreach" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OutreachApp ON Person.Person_ID=OutreachApp.OutreachApp_PersonID where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Outreach" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN OutreachApp ON Person.Person_ID=OutreachApp.OutreachApp_PersonID where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Outreach" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Outreach" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "Outreach" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Outreach" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Outreach ON Person.Person_ID=Outreach.Outreach_PersonID where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						//////////////////////
						
						
						
						
						
						if($search == null && $sorts == "lastName" && $filter == "Transporter" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Transporter" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Transporter" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN TransporterApp ON Person.Person_ID=TransporterApp.TransporterApp_PersonID where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Transporter" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN TransporterApp ON Person.Person_ID=TransporterApp.TransporterApp_PersonID where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Transporter" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Transporter" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "Transporter" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Transporter" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN Transporter ON Person.Person_ID=Transporter.Transporter_PersonID where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						//////////////////////
						
						
						
						
						if($search == null && $sorts == "lastName" && $filter == "Vet Team" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Vet Team" && $position=="volunteer"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='volunteer' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Vet Team" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeamApp ON Person.Person_ID=VetTeamApp.VetTeamApp_PersonID where Person_Usertype='applicant' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Vet Team" && $position=="applicant"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeamApp ON Person.Person_ID=VetTeamApp.VetTeamApp_PersonID where Person_Usertype='applicant' ORDER BY Person_FirstName ASC";
						}
						
						if($search == null && $sorts == "lastName" && $filter == "Vet Team" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='applicant' || Person_UserType='volunteer' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Vet Team" && $position=="volApp"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='applicant'  || Person_UserType='volunteer' ORDER BY Person_FirstName ASC";
						}
						if($search == null && $sorts == "lastName" && $filter == "Vet Team" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='rejected' ORDER BY Person_LastName ASC";
						}
						
						if($search == null && $sorts == "firstName" && $filter == "Vet Team" && $position=="rejected"){
							// Select statement for default
							$sql = "SELECT * FROM Person INNER JOIN VetTeam ON Person.Person_ID=VetTeam.VetTeam_PersonID where Person_Usertype='rejected' ORDER BY Person_FirstName ASC";
						}
						//////////////////////





						
						
						// Statements for filter ///////////////////////////////
						
											

						
						// Statments for team
															
						}
						if(($tableType=="Search") || ($tableType=="Occupants")){
		
		
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {?>
								<tr>
									<!--Each table column is echoed in to a td cell-->
									<?php
									if ($row['Person_DepartmentID'] == 1)
									{
										$dept = 'Outreach';
									}
									elseif ($row['Person_DepartmentID'] == 2) {
										$dept = 'Animal Care';
									}
									elseif ($row['Person_DepartmentID'] == 3) {
										$dept = 'Vet Team';
									}
									elseif ($row['Person_DepartmentID'] == 4) {
										$dept = 'Transporter';
									}

									?>


									<td><input type="checkbox" name="check[]" value="<?php echo $row['Person_Email'] ?>"></td>
									<td><?php if($tableType == 'Search'){echo '<a href="profile2.php?profileID='.$row['Person_ID'].'">View</a>';} ?></td>
									<td><?php echo $row['Person_FirstName']; ?></td>
									<td><?php echo $row['Person_LastName']; ?></td>
									<td><?php if($tableType == 'Search'){echo $row['Person_UserType'];} ?></td>
									<td><?php echo $dept; ?></td>
									<td><?php if($tableType == 'Search'){echo $row['Person_Email'];} ?></td>
									<td><?php echo $row['Person_PhonePrimary']; ?></td>
									
									
								</tr>
							<?php }
								}
								$conn->close();
							}?>
					</tbody> 
				</table>
			
				</fieldset>
		</section>
		<div class="form-group">
<label>Send email to selected: </label>
	<button type="submit" name="emailSelected"  class="btn btn-default filter-col">Send Email </button>
</div>	

                        </div>
                    </form>
                </div>
            </div>
        </div> 
	
    </div>

</div><!--end container search bar-->


<div class="container">
    <div class="row">
        <div class="navbar navbar-default visible-xs">
  <div class="container-fluid">
    <button class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#filter-sidebar">
      <i class="fa fa-tasks"></i> Toggle Sidebar
    </button>
  </div>
</div>

<div class="container-fluid">

  <div class="row">

    
    </div><!--end class row-->
</div><!--end container search bar-->
    
                    <!-- Main Section -->

   </div>
</div>
</div>
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
