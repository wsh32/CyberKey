<?php
	$event_name = $_GET["event"];
	$contact_name = $_GET["firstname"]." ".$_GET["lastname"];
	$contact_email = $_GET["email"];
	
	$message = "Event Signup!\nFrom: ".$contact_name."\nEvent Name: ".$event_name."\nContact Email: ".$contact_email;
	$subject = "CAMSKC Event Signup: ".$contact_name;
	
	$success = mail("christophersoohoo28@gmail.com", $subject, $message);
	
	if($success)	{
		echo "Thank you very much! We will contact you soon.";
	}	else	{
		echo "There was an unexpected error. Please try again at a later time";
	}
?>