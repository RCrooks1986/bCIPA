<?php
//Example sequences to use if they are not set elsewhere
if (isset($sequences) == false)
  {
  $sequences = array();
  $sequences[0] = array("Name"=>"Peptide 1","Sequence"=>"ALEDLDLCEVEEMP");
  $sequences[1] = array("Name"=>"Peptide 2","Sequence"=>"ALEKFSMDEVEEMP");
  $sequences[2] = array("Name"=>"Peptide 3","Sequence"=>"ALEDLDWEDFKHCV");
  $sequences[3] = array("Name"=>"Peptide 4","Sequence"=>"APPDEDLCEVEASP");

  $testing = true;
  }
else
  $testing = false;

//Format sequences for display
$displaysequences = array();
foreach ($sequences as $sequence)
  {
  $sequence['Sequence'] = str_split($sequence['Sequence'],60);
  $sequence['Sequence'] = implode("<br>",$sequence['Sequence']);
  $displaysequence = $sequence['Name'] . "<br>" . $sequence['Sequence'];
  array_push($displaysequences,$displaysequence);
  }

//Wrap in paragraph tag
$displaysequences = '<p class="sequences">' . implode("<br>",$displaysequences) . '</p>';

if ($testing == true)
  echo $displaysequences;
?>
