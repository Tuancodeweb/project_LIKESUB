<?php
function recursive_dir($dir) {
foreach(scandir($dir) as $file) {
if ('.' === $file || '..' === $file) continue;
if (is_dir("$dir/$file")) recursive_dir("$dir/$file");
else unlink("$dir/$file");
}
rmdir($dir);
}
 
if($_FILES["zip_file"]["name"]) {
$filename = $_FILES["zip_file"]["name"];
$source = $_FILES["zip_file"]["tmp_name"];
$type = $_FILES["zip_file"]["type"];
 
$name = explode(".", $filename);
$accepted_types = array('application/zip', 'application/x-zip-compressed',
'multipart/x-zip', 'application/x-compressed');
foreach($accepted_types as $mime_type) {
if($mime_type == $type) {
$okay = true;
break;
}
}

$continue = strtolower($name[1]) == 'zip' ? true : false;
if(!$continue) {
$myMsg = "Please upload a valid .zip file.";
}
 

$path = dirname(__FILE__).'/';
$filenoext = basename ($filename, '.zip');
$filenoext = basename ($filenoext, '.ZIP');
 
$myDir = $path . $filenoext; 
$myFile = $path . $filename; 
 
if (is_dir($myDir)) recursive_dir ( $myDir);
mkdir($myDir, 0777);
 
if(move_uploaded_file($source, $myFile)) {
$zip = new ZipArchive();
$x = $zip->open($myFile); 
if ($x === true) {
$zip->extractTo($myDir); 
$zip->close();
unlink($myFile);
}
echo $myMsg = ".";
} else {
echo $myMsg = ".";
}
}
?>