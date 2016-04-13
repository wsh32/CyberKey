<?php
	$event_name = $_GET["name"];
	$contact_name = $_GET["firstname"]." ".$_GET["lastname"];
	$contact_email = $_GET["email"];
	$description = $_GET["message"];
	
	$message = "New Event\nFrom: ".$contact_name."\nEvent Name: ".$event_name."\nContact Email: ".$contact_email."Event Description: \n".$description;
	$subject = "New Event: ".$event_name;
	
	$success = mail("christophersoohoo28@gmail.com", $subject, $message);
	
	if($success)	{
		echo "Thank you very much! We will contact you soon.";
	}	else	{
		echo "There was an unexpected error. Please try again at a later time";
	}
?>