<?php
//Sequences to asssign Williams scores to
$sequences = array();
$sequences['A'][0] = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
$sequences['A'][1] = array("Name"=>"Protein 2","Sequence"=>"AEDLMNFHFDWED");
$sequences['A'][2] = array("Name"=>"Protein 3","Sequence"=>"AEDLMNFRGASWE");
$sequences['A'][3] = array("Name"=>"Protein 4","Sequence"=>"AEDLMSDWRDSWE");
$sequences['B'][0] = array("Name"=>"Protein 1","Sequence"=>"AEDSDFGDDSSWE");
$sequences['B'][1] = array("Name"=>"Protein 2","Sequence"=>"AEDLMNFHFDWED");
$sequences['B'][2] = array("Name"=>"Protein 3","Sequence"=>"AEDLMNFRGASWE");
$sequences['B'][3] = array("Name"=>"Protein 4","Sequence"=>"AEDLMSDWRDSWE");

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
    $interaction = array("Name1"=>$sequences['A'][$interactionskey1]['Name'],"Name2"=>$sequences['A'][$interactionskey2]['Name'],"Sequence1"=>$sequences['B'][$interactionskey1]['Sequence'],"Sequence2"=>$sequences['B'][$interactionskey2]['Sequence']);
    array_push($interactions,$interaction);

    $interactionskey2++;
    }

  $interactionskey1++;
  }

print_r($interactions);
?>
