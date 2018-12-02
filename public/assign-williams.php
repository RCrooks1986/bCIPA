<?php
//Assign Williams score to each sequence in sequences array
foreach ($sequences as $sequencekey=>$sequence)
  {
  if (isset($sequence['WilliamsHP']) == false)
    $sequences[$sequencekey]['WilliamsHP'] = williamshp($sequence['Sequence']);
  }

//Echo sequences to check that they're working
//print_r($sequences);
?>
