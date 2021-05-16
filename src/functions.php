<?php


//check file extention if it is suitable
 function checkExt($file){
	  $allowed = array('csv', 'txt');
      $ext = end((explode(".", $file)));
      return(in_array($ext, $allowed));     
}

//check  file size is under 500 KB
function checkSize($file){
	if (filesize($file) > 500000) false ; true;
}


function filterData($str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}


function clearFiles(){ 
$files = glob('path/to/temp/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
 }
}

?>