<!DOCTYPE html>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<?php
//*************
//THIS PAGE IS NOT MEANT TO BE USED BY USERS...IT IS FOR EMAILING USERS THAT FORGOT TO CLOCKOUT
//THIS PAGE RUNS BY WINDOWS TASK SCHEDULER AT PREDETERMINED TIMES AND RUNS THIS SCRIPT
//*************
require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';
			$emailAddress = 'seilermr@dukes.jmu.edu';
			$id = '22134';
			$clockIn = '4/2/2017 3:00 PM';
			$hyperlink = "52.43.142.237/484phpWork1/updateClockOutLogIn.php";
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
			$mail->addAddress($emailAddress, 'Applicant');     // recipient
			//$mail->addAddress('ellen@example.com');               //Add team lead

			$mail->Subject = 'Wildlife Center of VA Clock Out Update';
			$mail->Body    = '<p>It seems you forgot to Clock Out from the Wildlife Center of Virginia on the following date and time:<b> '. $clockIn 
			. ' </b>. Please copy the link below and paste in the browser to log in. After logging in, enter the Unique ID '. $id . ' and enter the correct Clock Out date and time. Thank you! <br>
			<br>' . $hyperlink . '</p>'; //CHANGE IP ADDRESS TO THE CORRECT AWS INSTACE
			
			$mail->AltBody = 'It seems you forgot to Clock Out from the Wildlife Center of Virginia on the following date and time: '. $clockIn 
			. ' . Please copy the link below and paste in the browser to log in. After logging in, enter the Unique ID '. $id . ' and enter the correct Clock Out date and time. Thank you!'
			. $hyperlink; //CHANGE IP ADDRESS TO THE CORRECT AWS INSTACE

			
			$mail->isHTML(true);                                  // Set email format to HTML
			
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}

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

//SQL Statement to gather Email, Clock In datetime and ID for people who forgot to clockout
	$sql = "SELECT Person_Email";//WRITE JOIN STATEMENT TO GET EMAIL, CLOCKIN TIME, AND LOGHOURS ID WHERE LOGHOURS_FORGOT = "Y"
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$emailAddress = $row['Person_Email'];
			$clockIn = $row['LogHours_BeginTime'];
			$id = $row['LogHours_ID'];
			// Send email to each person that forgot to Clock Out with link to edit the time. Send them unique id and the date
			
			require 'C:\inetpub\wwwroot\PHPMailer\PHPMailerAutoload.php';

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
			$mail->addAddress($emailAddress, 'Applicant');     // recipient
			//$mail->addAddress('ellen@example.com');               //Add team lead
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'It seems you forgot to Clock Out from the Wildlife Center of Virginia on the following date and time:<b> '. $clockIn 
			. ' </b>. Please go to the link below and enter the Unique ID '. $id . ' and enter the correct Clock Out date and time. Thank you! <br>
			52.43.142.237/484phpWork1/updateClockOutLogIn.php'; //CHANGE IP ADDRESS TO THE CORRECT AWS INSTACE
			
			$mail->AltBody = 'It seems you forgot to Clock Out from the Wildlife Center of Virginia on the following date and time:<b> '. $clockIn 
			. ' </b>. Please go to the link below and enter the Unique ID '. $id . ' and enter the correct Clock Out date and time. Thank you!'; //CHANGE IP ADDRESS TO THE CORRECT AWS INSTACE

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
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
<body class="login">
    <div class="login-box main-content panel panel-default">
      <header class="panel-heading"><img src="../484phpWork1/images/logo_small.png" alt="Wildlife Logo"></header>
    	<section class="panel-body">
		
		<div id="warning">
		<img src="../484phpWork1/images/owl.jpg" alt="Warning">
		</div>
<ul><li>&nbsp;Oops! You caught us off guard. Owl you need to do is fly back to the login screen.</li></ul>

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