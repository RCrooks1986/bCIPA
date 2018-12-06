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
  }

//Iteratively create interactome
$interactions = array();
$interactionskey1 = 0;
$interactionsend1 = count($sequences['A']);
$interactionsend2 = count($sequences['B']);
while ($interactionskey1 < $interactionsend1)
  {
  //Key2 always returns to the first element
  $interactionskey2 = 0;
  while ($interactionskey2 < $interactionsend2)
    {
    //Create interaction and add it to interactome array
    $interaction = array("Name1"=>$sequences1[$interactionskey1]['Name'],"Name2"=>$sequences2[$interactionskey2]['Name'],"Sequence1"=>$sequences1[$interactionskey1]['Sequence'],"Sequence2"=>$sequences2[$interactionskey2]['Sequence']);
    array_push($interactions,$interaction);

    $interactionskey2++;
    }

  $interactionskey1++;
  }

print_r($interactions);
?>
