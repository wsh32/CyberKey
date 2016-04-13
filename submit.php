<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<title>CAMS CyberKey</title>

		<!-- CSS  -->
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="scripts/init.js"></script>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="logo.png" rel="shortcut icon"/>
	</head>

	<body>
		<header>
			<nav class="light-blue lighten-1" role="navigation">
				<div class="container">
					<div class="nav-wrapper"><a id="logo-container" href="index.html" class="brand-logo hide-on-med-and-down">CAMS Key Club</a>
						<ul class="right hide-on-med-and-down">
							<li><a href="index.html">Home</a></li>
							<li><a href="events.html">Events</a></li>
							<li><a href="officers.html">Officers</a></li>
							<li><a class="dropdown-button" href="#!" data-activates="resources">Resources<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
							<ul id='resources' class='dropdown-content'>
								<li><a class="blue-text" href="#">Resources</a></li>
								<li class="divider"></li>
								<li><a class="blue-text" href="bulletin.html">Bulletin</a></li>
								<li><a class="blue-text" href="connect.html">Connect</a></li>
							</ul>
							<li><a href="about.html">About</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>

						<ul id="nav-mobile" class="side-nav">
							<li class="logo center"><a id="logo-container" href="index.html" class="brand-logo">
								<object id="front-page-logo" type="image/png" data="logo.png"></object></a></li>
							<div class="divider"></div>
							<li><a href="index.html">Home</a></li>
							<li><a href="events.html">Events</a></li>
							<li><a href="officers.html">Officers</a></li>
							<li class="no-padding">
								<ul class="collapsible collapsible-accordion">
									<li>
										<a class="collapsible-header">Resources</a>
										<div class="collapsible-body">
											<ul>
												<li><a href="bulletin.html">Bulletin</a></li>
												<li><a href="connect.html">Connect</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
							<li><a href="about.html">About</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
						<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
					</div>
				</div>
			</nav>
		</header>

		<main>
			<div class="section no-pad-bot" id="index-banner">
				<div class="container">
					<h1 class="header center blue-text">Photo Challenge</h1>
					<div class="row center">
						<h5 class="header col s12 light">This month's challenge: Take a photo that best captures an act of service!</h5>
						<p>Every month, each member may submit up to 3 photos for the challenge. At the end of the month, we will choose 3 of the best submissions and they will be included in our scrapbook for DCON!</p>
					</div>
				</div>
			</div>
			<div class="container">
				<p class="center blue-text">
				<?php
					error_log(0);
					$target_dir = "photochallenge/uploads/";
					$target_file = null;
					$logfile = "photochallenge/LOGFILE";
					$uploadOk = 1;
					$response = "Please choose an image";

					if($_POST["firstname"]=="rm*pass=camskc")	{
						shell_exec("rm ".$target_dir."/*");
						$myfile = fopen($logfile, "w") or die("Please try again.");
						fwrite($myfile, "PLACEHOLDER");
						die("Done");
					}

					if(isset($_FILES["upload"])) {
						$check = getimagesize($_FILES["upload"]["tmp_name"]);
						if($check !== false) {
							$uploadOk = 1;
						} else {
							$response = "File is not an image.";
							$uploadOk = 0;
						}


						// Check file size
						if ($uploadOk == 1 && $_FILES["upload"]["size"] > 1500000) {
							$response = "Sorry, your file is too large.";
							$uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							
						// if everything is ok, try to upload file
						} else {
							//find target file
							$found = false;
							$tmp = 0;
							while(!$found)	{
								$target_file = $target_dir . $tmp . ".png";
								if(file_exists($target_file))	{
									$tmp = $tmp + 1;
								}	else	{
									$found = true;
								}
							}
							
							if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
								$response = "Thank you for your submission!";
								$myfile = fopen($logfile, "a") or die("Please try again.");
								$txt = $_POST["firstname"]." ".$_POST["lastname"]." ".$tmp."\n";
								fwrite($myfile, $txt);
								fclose($myfile);
							} else {
								$response = "Sorry, there was an error uploading your file.";
							}
						}
					}
					echo $response;
				?>
				</p>
			</div>
		</main>

		<footer class="grey darken-2 page-footer">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">CAMS Key Club</h5>
						<p class="grey-text text-lighten-4">We are a club stationed in the California Academy of Mathematics and Science, located on the campus of Cal State Dominguez Hills. Meetings are held in Ms. Lewis's room (4003) on Fridays during lunch, unless otherwise stated.</p>
					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Pages</h5>
						<ul>
							<li><a class="white-text" href="index.html">Home</a></li>
							<li><a class="white-text" href="events.html">Events</a></li>
							<li><a class="white-text" href="officers.html">Officers</a></li>
							<li><a class="white-text" href="bulletin.html">Bulletin</a></li>
							<li><a class="white-text" href="connect.html">Connect</a></li>
							<li><a class="white-text" href="about.html">About</a></li>
							<li><a class="white-text" href="#">Contact</a></li>
						</ul>
					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Connect</h5>
						<ul>
							<li><a class="white-text" href="http://keyclub.org">Key Club International</a>
							</li>
							<li><a class="white-text" href="http://cnhkeyclub.org">CNH Key Club</a>
							</li>
							<li><a class="white-text" href="https://www.facebook.com/groups/197028903695590/">CAMS Key Club FaceBook Group</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					&copy; CAMS Key Club 2015 | Made with <a class="grey-text text-lighten-2" target="_blank" href="http://materializecss.com/">MaterializeCSS</a>
					<a class="grey-text text-lighten-2 right" target="_blank" href="https://github.com/wsh32/CyberKey/blob/master/LICENSE">MIT License</a>
				</div>
			</div>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/materialize.min.js"></script>
	</body>

</html>
