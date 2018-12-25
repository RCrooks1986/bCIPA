<?php
//Include all required files
include 'required-files.php';

//Set frame and offset if not otherwise set
if (isset($frame) == false)
  $frame = "a";
if (isset($offset) == false)
  $offset = 0;

//Example sequences for set 1 to use if they are not set elsewhere
if (isset($sequences1) == false)
  {
  $sequences1 = array();
  $sequences1[0] = array("Name"=>"Peptide A-1","Sequence"=>"ALEDLDLCEVEEMP");
  $sequences1[1] = array("Name"=>"Peptide A-2","Sequence"=>"ALEKFSMDEVEEMP");
  $sequences1[2] = array("Name"=>"Peptide A-3","Sequence"=>"ALEDLDWEDFKHCV");
  $sequences1[3] = array("Name"=>"Peptide A-4","Sequence"=>"APPDEDLCEVEASP");

  $testing = true;
  }
else
  $testing = false;

//Example sequences for set 2 to use if they are not set elsewhere
if (isset($sequences2) == false)
  {
  $sequences2 = array();
  $sequences2[0] = array("Name"=>"Peptide B-1","Sequence"=>"ALEDLDLCEVEEMP");
  $sequences2[1] = array("Name"=>"Peptide B-2","Sequence"=>"ALEKFSMDEVEEMP");
  $sequences2[2] = array("Name"=>"Peptide B-3","Sequence"=>"ALEDLDWEDFKHCV");
  $sequences2[3] = array("Name"=>"Peptide B-4","Sequence"=>"APPDEDLCEVEASP");

  $testing = true;
  }
else
  $testing = false;

//Assign Williams scores to both sets of sequences
$sequences = $sequences1;
include 'assign-williams.php';
$sequences1 = $sequences;
$sequences = $sequences2;
include 'assign-williams.php';
$sequences2 = $sequences;
unset($sequences);

//Create the interactions between all sequences
include 'create-avsbset.php';

//Calculate bCIPA score
include 'bcipa-calculator.php';

//Produce heat map
include 'interactions-heat.php';

//Print interactions to test script
if ($testing == true)
  print_r($interactions);
?>
