<?php
//Sequences to use if sequences not already set
if ((isset($sequences1) == false) OR (isset($sequences2) == false))
  {
  $sequences1 = array();
  $sequences1[0] = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
  $sequences1[1] = array("Name"=>"Protein 2","Sequence"=>"AEDLMNFHFDWED");
  $sequences1[2] = array("Name"=>"Protein 3","Sequence"=>"AEDLMNFRGASWE");
  $sequences1[3] = array("Name"=>"Protein 4","Sequence"=>"AEDLMSDWRDSWE");
  $sequences2 = array();
  $sequences2[0] = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
  $sequences2[1] = array("Name"=>"Protein 2","Sequence"=>"AEDLMNFHFDWED");
  $sequences2[2] = array("Name"=>"Protein 3","Sequence"=>"AEDLMNFRGASWE");
  $sequences2[3] = array("Name"=>"Protein 4","Sequence"=>"AEDLMSDWRDSWE");

  $testing = true;
  }
else
  $testing = false;

//Iteratively create interactome
$interactions = array();
foreach ($sequences1 as $protein1)
  {
  foreach ($sequences2 as $protein2)
    {
    //Create interaction and add it to interactome array
    $interaction = array("Name1"=>$protein1['Name'],"Name2"=>$protein2['Name'],"Sequence1"=>$protein1['Sequence'],"Sequence2"=>$protein2['Sequence']);
    array_push($interactions,$interaction);
    }
  }

//Print this to test script
if ($testing == true)
  print_r($interactions);
?>
