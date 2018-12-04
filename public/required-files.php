<?php
//Directory where functions are stored
$directory = "../functions/";

$functions = array("williams","bcipa","fasta","userinput","maths","heat");

foreach($functions as $file)
  {
  include_once $directory . $file . '-functions.php';
  }

//include_once $directory . 'williams-functions.php';
//include_once $directory . 'bcipa-functions.php';
?>
