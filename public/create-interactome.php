<?php
//Iteratively create interactome
$interactions = array();
$interactionskey1 = 0;
$interactionsend = count($sequences);
while ($interactionskey1 < $interactionsend)
  {
  //Key2 is the same as key1 for homodimer
  $interactionskey2 = $interactionskey1;
  while ($interactionskey2 < $interactionsend)
    {
    //Create interaction and add it to interactome array
    $interaction = array("Name1"=>$sequences[$interactionskey1]['Name'],"Name2"=>$sequences[$interactionskey2]['Name'],"Sequence1"=>$sequences[$interactionskey1]['Sequence'],"Sequence2"=>$sequences[$interactionskey2]['Sequence']);

    //Add Williams HP to interaction if specified
    if (isset($sequences[$interactionskey1]['WilliamsHP']) == true)
      $interaction['WilliamsHP1'] = $sequences[$interactionskey1]['WilliamsHP'];
    if (isset($sequences[$interactionskey2]['WilliamsHP']) == true)
      $interaction['WilliamsHP2'] = $sequences[$interactionskey2]['WilliamsHP'];

    array_push($interactions,$interaction);

    $interactionskey2++;
    }

  $interactionskey1++;
  }

//Echo interactome to check that it is working
//print_r($interactions);
?>
