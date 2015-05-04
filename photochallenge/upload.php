<?php
$target_dir = "uploads/";
$target_file = null;
$uploadOk = 1;
$response = "";
// Check if image file is a actual image or fake image
if(isset($_POST["pic"])) {
    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $response = "File is not an image.";
        $uploadOk = 0;
    }


	// Check file size
	if ($uploadOk == 1 && $_FILES["pic"]["size"] > 500000) {
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
		
		if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
			$response = "Thank you for your submission!";
			shell_exec("python log.py ".$_POST["firstname"]." ".$_POST["lastname"]." ".$target_file);
		} else {
			$response = "Sorry, there was an error uploading your file.";
		}
	}
}
?>