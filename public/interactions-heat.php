<?php
function uniquefield($array,$field)
  {
  //Get every element in that named field on each line
  $output = array();
  foreach ($array as $line)
    {
    array_push($output,$line[$field]);
    }

  $output = array_unique($output);
  sort($output);
  Return $output;
  }

function fieldsize($array)
  {
  $spaceperletter = 7;
  //Work out the size of the cell needed
  $size = 0;
  foreach ($array as $element)
    {
    $elementsize = strlen($element)*$spaceperletter;

    if ($elementsize > $size)
      $size = $elementsize;
    }

  Return $size;
  }

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
  }

//The field to chart the Tm of
$heattomap = "bCIPATm";

//Get the columns and rows and their sizes for building the diagram
$rows = uniquefield($interactions,"Name1");
$rowsize = fieldsize($rows);
$columns = uniquefield($interactions,"Name2");
$columnsize = fieldsize($columns);
$boxsize = 24;
$midbox = $boxsize/2;
$heatcolumnsreturn = 0-($boxsize*(count($columns)-1));
$heatrowsreturn = 0-($boxsize*(count($rows)-1));

echo $rowsize . "<br>";
echo $columnsize . "<br>";
echo $boxsize . "<br>";
echo $midbox . "<br>";
echo $heatcolumnsreturn . "<br>";
echo $heatrowsreturn . "<br>";
?>
