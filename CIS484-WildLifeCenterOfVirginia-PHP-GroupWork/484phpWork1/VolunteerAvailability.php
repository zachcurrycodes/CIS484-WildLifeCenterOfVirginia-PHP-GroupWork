<!DOCTYPE html>

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

                            <li class="active"><a href="profile.php">Profile</a></li>
                            <li><a href="calendar.php">Calendar</a></li>
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
                    <section class="col-md-12">
					
						<!-- Main Section -->
					
                        <div class="main-section">
                            <div class="main-content panel panel-default">
                                <header class="panel-heading clearfix">
                                    <h2 class="panel-title">
                                        Edit Volunteer Availability
                                    </h2>
                                </header>
							
						
						
								<div class="container">
									<hr>
									<div class="row">
									  <!-- left column -->

										<!-- edit form column -->
										<div class="col-md-7 col-md-offset-1 personal-info">

											<h3>Days of the Week</h3>

											<form class="form-horizontal" method="post" role="form">
												<div class="form-group">
													<label class="col-lg-3 control-label">Sunday:</label>
													<div class="col-lg-4">
														<select name="vSunAvailability" required="required">
															<option <?php if ($vSunAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vSunAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vSunAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="SunBegin" required="required">
															<option <?php if ($SunBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($SunBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($SunBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($SunBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="SunEnd" required="required">
															<option <?php if ($SunEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($SunEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($SunEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($SunEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>
														
												<div class="form-group">
													<label class="col-lg-3 control-label">Monday:</label>
													<div class="col-lg-4">
														<select name="vMonAvailability" required="required">
															<option <?php if ($vMonAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vMonAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vMonAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="MonBegin" required="required">
															<option <?php if ($MonBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($MonBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($MonBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($MonBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="MonEnd" required="required">
															<option <?php if ($MonEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($MonEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($MonEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($MonEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Tuesday:</label>
													<div class="col-lg-4">
														<select name="vTueAvailability" required="required">
															<option <?php if ($vTueAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vTueAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vTueAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="TueBegin" required="required">
															<option <?php if ($TueBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($TueBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($TueBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($TueBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="TueEnd" required="required">
															<option <?php if ($TueEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($TueEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($TueEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($TueEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>												
													
												<div class="form-group">
													<label class="col-lg-3 control-label">Wednesday:</label>
													<div class="col-lg-4">
														<select name="vWedAvailability" required="required">
															<option <?php if ($vWedAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vWedAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vWedAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="WedBegin" required="required">
															<option <?php if ($WedBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($WedBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($WedBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($WedBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="WedEnd" required="required">
															<option <?php if ($WedEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($WedEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($WedEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($WedEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>	

												<div class="form-group">
													<label class="col-lg-3 control-label">Thursday:</label>
													<div class="col-lg-4">
														<select name="vThuAvailability" required="required">
															<option <?php if ($vThuAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vThuAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vThuAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="ThuBegin" required="required">
															<option <?php if ($ThuBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($ThuBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($ThuBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($ThuBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="ThuEnd" required="required">
															<option <?php if ($ThuEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($ThuEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($ThuEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($ThuEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>	
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Friday:</label>
													<div class="col-lg-4">
														<select name="vFriAvailability" required="required">
															<option <?php if ($vFriAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vFriAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vFriAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="FriBegin" required="required">
															<option <?php if ($FriBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($FriBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($FriBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($FriBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="FriEnd" required="required">
															<option <?php if ($FriEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($FriEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($FriEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($FriEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
												</div>	
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Saturday:</label>
													<div class="col-lg-4">
														<select name="vSatAvailability" required="required">
															<option <?php if ($vSatAvailability == 'Available' ) echo 'selected' ; ?> value="Available">Available all day</option>
															<option <?php if ($vSatAvailability == 'AvailableBetween' ) echo 'selected' ; ?> value="AvailableBetween">Available Between</option>
															<option <?php if ($vSatAvailability == 'NotAvailable' ) echo 'selected' ; ?> value="NotAvailable">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group">	
													<label class="col-lg-3 control-label">-</label>
													<div class="col-lg-3">
														<select name="SatBegin" required="required">
															<option <?php if ($SatBegin == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($SatBegin == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($SatBegin == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($SatBegin == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
													</div>
													<div class="col-lg-1">and</div>
													<div class="col-lg-3">
														<select name="SatEnd" required="required">
															<option <?php if ($SatEnd == 'Morning' ) echo 'selected' ; ?> value="Morning">Morning</option>
															<option <?php if ($SatEnd == 'EarlyAfternoon' ) echo 'selected' ; ?> value="EarlyAfternoon">Early Afternoon</option>
															<option <?php if ($SatEnd == 'LateAfternoon' ) echo 'selected' ; ?> value="LateAfternoon">Late Afternoon</option>
															<option <?php if ($SatEnd == 'Evening' ) echo 'selected' ; ?> value="Evening">Evening</option>
														</select>
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
												<?php
													ini_set('display_errors', 'On');
													error_reporting(E_ALL);
												?>
											</form>
									  </div>
									</div>
								</div>
							</div>
						</div>
					</section>
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
	
</body>
</html>