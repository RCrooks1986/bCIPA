<?php
//Directory where functions are stored
$directory = "../functions/";

$functions = array("williams","bcipa","fasta","userinput","maths","heat","sort");

foreach($functions as $file)
  {
  include_once $directory . $file . '-functions.php';
  }
?>
