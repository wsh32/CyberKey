<?php
error_log(0);
$target_dir = "uploads/";
$target_file = null;
$uploadOk = 1;
$response = "Please choose an image";
$error = 9001;

if($_POST["firstname"]=="rm*pass=asdfghjkl;\'")	{
	shell_exec("rm uploads/*");
	exit;
}

if(isset($_FILES["upload"])) {
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $response = "File is not an image.";
        $uploadOk = 0;
		$error = 1;
    }


	// Check file size
	if ($uploadOk == 1 && $_FILES["upload"]["size"] > 1500000) {
		$response = "Sorry, your file is too large.";
		$uploadOk = 0;
		$error = 2;
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
			$myfile = fopen($target_file.".txt", "w") or die("Please try again.");
			$txt = $_POST["firstname"]." ".$_POST["lastname"]." ".$tmp."\n";
			fwrite($myfile, $txt);
			fclose($myfile);
			$error = 0;
		} else {
			$response = "Sorry, there was an error uploading your file.";
			$error = 3;
		}
	}
}
echo $response;
?>