<?php
//Include all required files
include 'required-files.php';

//Set frame and offset if not otherwise set
if (isset($frame) == false)
  $frame = "a";
if (isset($offset) == false)
  $offset = 0;

//Example sequences to use if they are not set elsewhere
if (isset($sequences) == false)
  {
  $sequences = array();
  $sequences[0] = array("Name"=>"Peptide 1","Sequence"=>"ALEDLDLCEVEEMP");
  $sequences[1] = array("Name"=>"Peptide 2","Sequence"=>"ALEKFSMDEVEEMP");
  $sequences[2] = array("Name"=>"Peptide 3","Sequence"=>"ALEDLDWEDFKHCV");
  $sequences[3] = array("Name"=>"Peptide 4","Sequence"=>"APPDEDLCEVEASP");
  }

//Assign Williams scores to sequences
include 'assign-williams.php';

//Create the interactions between all sequences
include 'create-interactome.php';

//Calculate bCIPA score
include 'bcipa-calculator.php';

print_r($interactions);
?>
