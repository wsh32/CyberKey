<?php

error_reporting(0);

// Allow direct file download (hotlinking)?
// Empty - allow hotlinking
// If set to nonempty value (Example: example.com) will only allow downloads when referrer contains this text
define('ALLOWED_REFERRER', '');

// Download folder, i.e. folder where you keep all files for download.
// MUST end with slash (i.e. "/" )
define('BASE_DIR','/home3/camscsco/public_html/ctf1/files');

// log downloads?  true/false
define('LOG_DOWNLOADS',true);

// log file name
define('LOG_FILE','downloads.log');

if (ALLOWED_REFERRER !== ''
&& (!isset($_SERVER['HTTP_REFERER']) || strpos(strtoupper($_SERVER['HTTP_REFERER']),strtoupper(ALLOWED_REFERRER)) === false)) {
	die("Internal server error. Please contact system administrator.");
}

// Make sure program execution doesn't time out
// Set maximum script execution time in seconds (0 means no limit)
set_time_limit(0);

if (!isset($_GET['f']) || empty($_GET['f'])) {
	die("Please specify file name for download.");
}

// Nullbyte hack fix
if (strpos($_GET['f'], "\0") !== FALSE) die('');

// Get real file name.
// Remove any path info to avoid hacking by adding relative path, etc.
$fname = basename($_GET['f']);

// Check if the file exists
// Check in subfolders too
function find_file ($dirname, $fname, &$file_path) {

	$dir = opendir($dirname);

	while ($file = readdir($dir)) {
		if (empty($file_path) && $file != '.' && $file != '..') {
			if (is_dir($dirname.'/'.$file)) {
				find_file($dirname.'/'.$file, $fname, $file_path);
			}
		else {
			if (file_exists($dirname.'/'.$fname)) {
				$file_path = $dirname.'/'.$fname;
				return;
				}
			}
		}
	}

} // find_file

// get full file path (including subfolders)
$file_path = '';
find_file(BASE_DIR, $fname, $file_path);

if (!is_file($file_path)) {
	die("File does not exist. Make sure you specified correct file name."); 
}

// file size in bytes
$fsize = filesize($file_path); 

// file extension
$fext = strtolower(substr(strrchr($fname,"."),1));

$mtype = finfo_open(FILEINFO_MIME_TYPE, $file_path);


// Browser will try to save file with this filename, regardless original filename.
// You can override it if needed.

if (!isset($_GET['fc']) || empty($_GET['fc'])) {
	$asfname = $fname;
}
else {
  // remove some bad chars
	$asfname = str_replace(array('"',"'",'\\','/'), '', $_GET['fc']);
	if ($asfname === '') $asfname = 'NoName';
}

// set headers
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: $mtype");
header("Content-Disposition: attachment; filename=\"$asfname\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

// download
// @readfile($file_path);
$file = @fopen($file_path,"rb");
if ($file) {
	while(!feof($file)) {
		print(fread($file, 1024*8));
		flush();
		if (connection_status()!=0) {
			@fclose($file);
			die();
		}
	}
	@fclose($file);
}

// log downloads
if (!LOG_DOWNLOADS) die();

$f = @fopen(LOG_FILE, 'a+');
if ($f) {
	@fputs($f, date("m.d.Y g:ia")."  ".$_SERVER['REMOTE_ADDR']."  ".$fname."\n");
	@fclose($f);
}

?>