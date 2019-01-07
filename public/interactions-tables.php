<?php
//Test interactions to use if they are not already specified
if (isset($interactions) == false)
  {
  $interactions = array();
  $interactions[0] = array("Name1"=>"Test1","Name2"=>"Test1","bCIPATm"=>47);
  $interactions[1] = array("Name1"=>"Test1","Name2"=>"Test2","bCIPATm"=>84);
  $interactions[2] = array("Name1"=>"Test1","Name2"=>"Test3","bCIPATm"=>-23);
  $interactions[3] = array("Name1"=>"Test1","Name2"=>"Test4","bCIPATm"=>0);
  $interactions[4] = array("Name1"=>"Test1","Name2"=>"Test5","bCIPATm"=>60);
  $interactions[5] = array("Name1"=>"Test2","Name2"=>"Test2","bCIPATm"=>23);
  $interactions[6] = array("Name1"=>"Test2","Name2"=>"Test3","bCIPATm"=>30);
  $interactions[7] = array("Name1"=>"Test2","Name2"=>"Test4","bCIPATm"=>15);
  $interactions[8] = array("Name1"=>"Test2","Name2"=>"Test5","bCIPATm"=>45);
  $interactions[9] = array("Name1"=>"Test3","Name2"=>"Test3","bCIPATm"=>54);
  $interactions[10] = array("Name1"=>"Test3","Name2"=>"Test4","bCIPATm"=>5);
  $interactions[11] = array("Name1"=>"Test3","Name2"=>"Test5","bCIPATm"=>23);
  $interactions[12] = array("Name1"=>"Test4","Name2"=>"Test4","bCIPATm"=>32);
  $interactions[13] = array("Name1"=>"Test4","Name2"=>"Test5","bCIPATm"=>51);
  $interactions[14] = array("Name1"=>"Test5","Name2"=>"Test5","bCIPATm"=>59);

  $testing = true;
  }
else
  $testing = false;

usort($interactions,'interactomesort');

//Output containers
$htmlinteractionstable = array();
$htmlinteractionstable[0] = '<th>Peptide 1</th><th>Peptide 2</th><th>T<sub>M</sub></th>';
$textinteractionstable = array();
$textinteractionstable[0] = 'Peptide 1\tPeptide 2\tTm';

//Output each interaction onto new line of both text and HTML
foreach ($interactions as $interaction)
  {
  $htmlinteractionsline = '<td>' . $interaction['Name1'] . '</td><td>' . $interaction['Name2'] . '</td><td>' . $interaction['bCIPATm'] . '</td>';
  $textinteractionsline = $interaction['Name1'] . '\t' . $interaction['Name2'] . '\t' . $interaction['bCIPATm'];
  array_push($htmlinteractionstable,$htmlinteractionsline);
  array_push($textinteractionstable,$textinteractionsline);
  }

$htmlinteractionstable = '<table class="scientific"><tr>' . implode('</tr><tr>',$htmlinteractionstable) . '</tr></table>';
$textinteractionstable = '<textarea cols="30" rows="10">' . implode('\r\n',$textinteractionstable) . '</textarea>';
?>
