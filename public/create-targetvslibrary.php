<?php
//Sequences to use if sequences not already set
if ((isset($sequences1) == false) OR (isset($sequences2) == false))
  {
  $target = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
  $library = array();
  $library[0] = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
  $library[1] = array("Name"=>"Protein 2","Sequence"=>"AEDLMNFHFDWED");
  $library[2] = array("Name"=>"Protein 3","Sequence"=>"AEDLMNFRGASWE");
  $library[3] = array("Name"=>"Protein 4","Sequence"=>"AEDLMSDWRDSWE");

  $testing = true;
  }
else
  $testing = false;

//Iteratively create interactome
$interactions = array();
foreach ($library as $member)
  {
  //Create interaction and add it to interactome array
  $interaction = array("Name1"=>$target['Name'],"Name2"=>$member['Name'],"Sequence1"=>$target['Sequence'],"Sequence2"=>$member['Sequence']);
  array_push($interactions,$interaction);
  }

//Print this to test script
if ($testing == true)
  print_r($interactions);
?>
