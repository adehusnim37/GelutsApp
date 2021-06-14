<?php

// to download the attached file wihtout revealing the location of atached folder to the users.
$path = ''; 
$path = 'attachment/'.$_GET['id']; 	
	
 
$mime_type=mime_content_type($path); 
 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: " . $mime_type);
header("Content-Length: " .(string)(filesize($path)) );
header('Content-Disposition: attachment; filename="'.basename($path).'"');
header("Content-Transfer-Encoding: binary\n");
 
readfile($path); 
exit();
?>