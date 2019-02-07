<!DOCTYPE html>
<?php
//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType'];
//Array of emails that were selected
$profileEmail = $_SESSION['profileEmail']; 


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Team Lead"){
	header("Location: restrictedAccess.php");
	exit();
}

*/

if(isset($_POST['btnSend'])){
	require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';
	
	//DO A LOOP TO POPULATE EMAIL ADDRESS AND SEND EMAIL FOR EACH ITERATION
	
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
	
	foreach($_SESSION['profileEmail'] as $key=>$value)
    {
		$mail->addBCC($value);     // recipient
    }
		

	$mail->Subject = $_POST['emailSubject'];
	$mail->Body    = $_POST['emailBody']; 
	
	$mail->AltBody = $_POST['emailBody'];

	
	$mail->isHTML(true);                                  // Set email format to HTML
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		header("Location: emailConfirmation.php");
		exit();
		
	}
	
	
}

if(isset($_POST['btnCancel'])){
	header("Location: profileSearch.php");
	exit();
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
                            <li><a href="accountProfile.php">Account</a></li>                          
                            <li><a href="index.php">Sign Out</a></li>                     
                            </li>
							</ul>
                      
                    </div>
                </div>
            </nav>
        </header>
		<div class="content">
         
<div class="container">
  	<hr>
	<div class="row">
      <!-- left column -->

      
      <!-- edit form column -->
      <div class="col-md-7 col-md-offset-1 personal-info">

        <h3>Send Email to Selected Volunteers</h3>
        
        <form class="form-horizontal" method="post" role="form">
			<div class="form-group">
					<label class="col-lg-3 control-label">Sending To: </label>
					<div class="col-lg-8">
						<textarea class="form-control" id="emailTo" readonly name="emailTo" type="text" required="required" rows="2" cols="90" ><?php foreach($_SESSION['profileEmail'] as $key=>$value){ echo $value . '; ';}?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Email Subject: </label>
					<div class="col-lg-8">
						<input class="form-control" id="emailSubject" name ="emailSubject" placeholder="Enter email subject here" type="text" required="required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Email Body: </label>
					<div class="col-lg-8">
						<textarea class="form-control" id="emailBody" name="emailBody" placeholder="Enter email body here" rows="5" cols="90" required="required"></textarea>
					</div>
				</div>
			<div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" name="btnSend" class="btn btn-primary" value="Send Email">
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
                               </div></div>

  
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
