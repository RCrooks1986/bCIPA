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

//Default to do not display names as names are generated automatically
if (isset($displaynames) == false)
  $displaynames = false;

//Default to display sequences, this may be turned off if only names are wanted
if (isset($displaysequences) == false)
  $displaysequences = true;

//Default to display sequences if no output is specified
if (($displaysequences == false) AND ($displaysequences == false))
  $displaysequences = true;

//Default to displaying all sequences, can limit output to best n if preferred
if (isset($displaylimit) == false)
  $displaylimit = INF();

//Table parameters are defaulted to blank
if (isset($tableparameters) == false)
  $tableparameters = "";

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

//The HTML table to populate
$tablehtml = '<table' . $tableparameters . '>'
if

//Loop through interaction array for number of interactions to display
$endloop = count($interactions)
if ($endloop > $displaylimit)
  $endloop = $displaylimit;
$interactionno = 0
while ($interactionno < $endloop)
  {

  $interactionno++;
  }

//Print interactions to test script
if ($testing == true)
  print_r($interactions);
?>
