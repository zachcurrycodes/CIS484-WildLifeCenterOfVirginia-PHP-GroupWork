<?php


//Session variables: KEEP AT TOP
session_start();
$userID = $_SESSION['userID'];
$userTypeSession = $_SESSION['userType']; 


//UNCOMMENT THIS OUT WHEN READY TO RUN PROGRAM FOR PRESENTATION OR TURN IN
/*
//If Session is empty, redirect user to restricted access notification
if ($userTypeSession != "Volunteer"){
	header("Location: restrictedAccess.php");
	exit();
}

*/






require_once('bdd.php');


$sql = "SELECT id, title, start, end, color FROM events UNION SELECT id, title, start, end, color FROM events2";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();





?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Wildlife Center of Virginia Volunteers</title>

<!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<link rel="stylesheet" media="screen" href="css/style.css" />




<style>

	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
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
						<a class="navbar-brand" href="profile.php"><img src="../484phpWork1/images/logo_short.png" alt="Wildlife Small Logo"></a>
                    </div>
    
                  
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">

                            <li><a href="profile.php">Profile</a></li>
                            <li class="active"><a href="calendar.php">Calendar</a></li>
                            <li><a href="index.php">Sign Out</a></li>
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
    
                    <section class="col-md-9 no-padding">
                        <div class="main-section">
                            <div class="main-content panel panel-default">
                                <header class="panel-heading clearfix">
                                    <h2 class="panel-title col-sm-3">Calendar</h2>
									<button id="btnPress" class="btn btn-default pull-right col-sm-3" rel="#overlay">Reserve Shift<i class="fa fa-question-circle"></i></button>
                                </header>
                                <section class="panel-body">
                                   <div id="calendar" class="col-centered"></div> 
                                </section>
                            </div>
						</div>
					</section>

					<!-- Main Section End -->

				</div>
				<div id="push"></div>
			
				<!-- Modal -->
				
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form class="form-horizontal" method="POST" action="addEvent2.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Add Event</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="title" class="col-sm-2 control-label">Name:</label>
										<div class="col-sm-10">
											<input type="text" name="title" class="form-control" id="title" placeholder="Full Name" required>
										</div>
									</div>
									<div class="form-group">
										<label for="color" class="col-sm-2 control-label">Program:</label>
										<div class="col-sm-10">
											<select name="color" class="form-control" id="color" required>
												<option value="">Choose</option>						  
												<option style="color: #0099cc;" value="#0099cc">&#9724; Outreach Volunteer</option>
												<option style="color:#009966;" value="#009966">&#9724; Vet Team Volunteer</option>
												<option style="color:#cc6600;" value="#cc6600">&#9724; Animal Care Volunteer</option>
										  
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="start" class="col-sm-2 control-label">Start Date:</label>
										<div class="col-sm-10">
											<input pattern=".{19,19}" min="2017-02-01T00:00:00" type="datetime-local" name="start" class="form-control" id="start" required>
										</div>
									</div>
									<div class="form-group">
										<label for="end" class="col-sm-2 control-label">End Date:</label>
										<div class="col-sm-10">
											<input pattern=".{19,19}" min="2017-02-01T00:00:00" type="datetime-local" name="end" class="form-control" id="end" required>
										</div>
									</div>
								
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		
				<!-- Modal -->

				<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form class="form-horizontal" method="POST" action="editEventTitle2.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="title" class="col-sm-2 control-label">Name:</label>
										<div class="col-sm-10">
											<input type="text" name="title" class="form-control" id="title" placeholder="Full Name">
										</div>
									</div>
									<div class="form-group">
										<label for="color" class="col-sm-2 control-label">Program:</label>
										<div class="col-sm-10">
											<select name="color" class="form-control" id="color">
												<option value="">Choose</option>						  
												<option style="color: #0099cc;" value="#0099cc">&#9724; Outreach Volunteer</option>
												<option style="color:#009966;" value="#009966">&#9724; Vet Team Volunteer</option>
												<option style="color:#cc6600;" value="#cc6600">&#9724; Animal Care Volunteer</option>
											</select>
										</div>
									</div>
									<div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
										  <div class="checkbox">
											<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
										  </div>
										</div>
									</div>
									<input type="hidden" name="id" class="form-control" id="id">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<!-- jQuery Version 1.11.1 -->
			<script src="js/jquery.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="js/bootstrap.min.js"></script>
			
			<!-- FullCalendar -->
			<link href='fullcalendar.min.css' rel='stylesheet' />
		<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
		<script src='lib/moment.min.js'></script>
		<script src='fullcalendar.min.js'></script>
		<script src='gcal.min.js'></script>

		<script>
		// Get the modal
		var modal = document.getElementById('ModalAdd');

		// Get the button that opens the modal
		var btn = document.getElementById("btnPress");

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
		}

		</script>
			
		<script>

			$(document).ready(function() {

				
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					
					editable: false,
					eventLimit: true,
					selectable: false,
					selectHelper: true,
					
					googleCalendarApiKey: 'AIzaSyCOO_AYRid39dFTyP82uqIsbDvQjn571ks',
				
					// US Holidays
					


					
					select: function(start, end) {
						
						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD' + ' HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function(event, element) {

						element.bind('dblclick', function() {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit').modal('show');
						});
					},

					eventDrop: function(event, delta, revertFunc) { 

						edit(event);

					},
					eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 

						edit(event);

					},
					
					
					
					
					
					loading: function(bool) {
						$('#loading').toggle(bool);
					},
					eventSources: [
				'wcvtest@gmail.com'
			],
			eventClick: function(event) {
			if (event.url) {
				window.open(event.url, 'gcalevent', 'width=1000, height=600');
				return false;
			}
			},
					
					
					
					events: [
					
					<?php foreach($events as $event): 
					
						$start = explode(" ", $event['start']);
						$end = explode(" ", $event['end']);
						if($start[1] == '00:00:00'){
							$start = $start[0];
						}else{
							$start = $event['start'];
						}
						if($end[1] == '00:00:00'){
							$end = $end[0];
						}else{
							$end = $event['end'];
						}
					?>
						{
							id: '<?php echo $event['id']; ?>',
							title: '<?php echo $event['title']; ?>',
							start: '<?php echo $start; ?>',
							end: '<?php echo $end; ?>',
							color: '<?php echo $event['color']; ?>',
						},
					<?php endforeach; ?>
					]
					
				});
				
				
				function edit(event){
					start = event.start.format('YYYY-MM-DD HH:mm:ss');
					if(event.end){
						end = event.end.format('YYYY-MM-DD HH:mm:ss');
					}else{
						end = start;
					}
					
					id =  event.id;
					
					Event = [];
					Event[0] = id;
					Event[1] = start;
					Event[2] = end;
					
					$.ajax({
					 url: 'editEventDate2.php',
					 type: "POST",
					 data: {Event:Event},
					 success: function(rep) {
							if(rep == 'OK'){
								alert('Saved');
							}else{
								alert('Could not be saved. Try again.'); 
							}
						}
					});
				}
				
				
			});

		</script>

				

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
	<script src="js/jquery-ui.min.js"></script>


    <!-- Main Script -->
    <script src="js/global.js"></script>





 

  
</body>
</html>
