<?php
foreach ($interactions as $interactionskey=>$interaction)
  {
  //Apply bCIPA to each interaction
  $interaction = bcipa($interaction,$frame);

  //Remove detailed interaction information unless specified that it should be retained
  if (isset($interactiondetails) == false)
    {
    unset($interaction['WilliamsHP1']);
    unset($interaction['WilliamsHP2']);
    unset($interaction['TotalHP']);
    unset($interaction['Core']);
    unset($interaction['Electrostatics']);
    }
  $interactions[$interactionskey] = $interaction;
  }

usort($interactions,'interactomesort');
?>
