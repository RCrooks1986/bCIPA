<?php
//Include all required files
include 'required-files.php';

//Set frame and offset if not otherwise set
if (isset($frame) == false)
  $frame = "a";
if (isset($offset) == false)
  $offset = 0;

//Library vs target uses the same process as the A vs B calculator, only with a different output
//Example sequences for set 1 to use if they are not set elsewhere
if (isset($library) == false)
  {
  $library = array();
  $library[0] = array("Name"=>"Peptide A-1","Sequence"=>"ALEDLDLCEVEEMP");
  $library[1] = array("Name"=>"Peptide A-2","Sequence"=>"ALEKFSMDEVEEMP");
  $library[2] = array("Name"=>"Peptide A-3","Sequence"=>"ALEDLDWEDFKHCV");
  $library[3] = array("Name"=>"Peptide A-4","Sequence"=>"APPDEDLCEVEASP");

  $testing = true;
  }
else
  $testing = false;

//Example sequences for set 2 to use if they are not set elsewhere
if (isset($target) == false)
  {
  $target = array("Name"=>"Peptide B-1","Sequence"=>"ALEDLDLCEVEEMP");

  $testing = true;
  }
else
  $testing = false;

//Default to displaying all sequences, can limit output to best n if preferred
if (isset($displaylimit) == false)
  $displaylimit = INF();

//Assign Williams scores to both sets of sequences
$sequences = $library;
include 'assign-williams.php';
$library = $sequences;
$sequences = array(0=>$target);
include 'assign-williams.php';
$target = $sequences[0];
unset($sequences);

//Create the interactions between all library members and the target
include 'create-targetvslibrary.php';

//Calculate bCIPA score
include 'bcipa-calculator.php';

//Print interactions to test script
if ($testing == true)
  print_r($interactions);
?>
