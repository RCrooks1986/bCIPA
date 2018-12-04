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
  $spaceperletter = 9;
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

include_once 'required-files.php';

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
//Colourscheme to use
$heatcolourscheme = "Default";

//The name of the heat chart is specified here if it's not specified elsewhere
if (isset($canvasname) == false)
  $canvasname = "Heatchart";

//Get the columns and rows and their sizes for building the diagram
$rows = uniquefield($interactions,"Name1");
$rowsize = fieldsize($rows);
$columns = uniquefield($interactions,"Name2");
$columnsize = fieldsize($columns);
$boxsize = 24;
$midbox = $boxsize/2;
$singleboxback = 0-$boxsize;
$heatcolumnsreturn = 0-($boxsize*(count($columns)-1));
$heatrowsreturn = 0-($boxsize*(count($rows)-1));
$canvaswidth = ($boxsize*count($columns))+$rowsize+2;
$canvasheight = ($boxsize*count($rows))+$rowsize+2;
$outlineheight = $canvasheight-2;
$outlinewidth = $canvaswidth-2;

//Canvas HTML with name of canvas
$canvashtml = '<canvas id="' . $canvasname . '" width="' . $canvaswidth . '" height="' . $canvasheight . '"></canvas>';

$javascript = 'var canvas = document.getElementById("' . $canvasname . '");';
$javascript = $javascript . 'var ctx = canvas.getContext("2d");';

foreach ($columns as $columnkey=>$column)
  {
  //Add columns to javascript
  $javascript = $javascript . 'ctx.beginPath();';
  if ($columnkey == 0)
    {
    //Add rotation if it is the first element
    $translatedown = $columnsize+1;
    $javascript = $javascript . 'ctx.translate(1,' . $translatedown . ');';
    $javascript = $javascript . 'ctx.rotate(-90*Math.PI/180);';
    }
  else
    {
    //Translate to the new position for column on subsequent rows
    $javascript = $javascript . 'ctx.translate(0,' . $boxsize . ');';
    }
  $javascript = $javascript . 'ctx.rect(0,0,' . $columnsize . ',' . $boxsize . ');';
  $javascript = $javascript . 'ctx.stroke();';
  $javascript = $javascript . 'ctx.font="15px Arial";';
  $javascript = $javascript . 'ctx.textAlign="start";';
  $javascript = $javascript . 'ctx.textBaseline="middle";';
  $javascript = $javascript . 'ctx.fillStyle = "#000000";';
  $javascript = $javascript . 'ctx.fillText("' . $column . '",4,' . $midbox . ');';
  }

//Rotate back to standard orientation
$javascript = $javascript . 'ctx.rotate(90*Math.PI/180);';

//Draw top right black box
$javascript = $javascript . 'ctx.beginPath();';
$javascript = $javascript . 'ctx.translate(' . $boxsize . ',0);';
$javascript = $javascript . 'ctx.fillStyle="rgb(0,0,0)";';
$negativecolumnsize = 0-$columnsize;
$javascript = $javascript . 'ctx.fillRect(0,0,' . $rowsize . ',' . $negativecolumnsize . ');';

foreach ($rows as $rowkey=>$row)
  {
  //Add columns to javascript
  $javascript = $javascript . 'ctx.beginPath();';
  if ($rowkey > 0)
    {
    //Translate down by box size if not the first element
    $javascript = $javascript . 'ctx.translate(0,' . $boxsize . ');';
    }
  $javascript = $javascript . 'ctx.rect(0,0,' . $rowsize . ',' . $boxsize . ');';
  $javascript = $javascript . 'ctx.stroke();';
  $javascript = $javascript . 'ctx.font="15px Arial";';
  $javascript = $javascript . 'ctx.textAlign="start";';
  $javascript = $javascript . 'ctx.textBaseline="middle";';
  $javascript = $javascript . 'ctx.fillStyle = "rgb(0,0,0)";';
  $javascript = $javascript . 'ctx.fillText("' . $row . '",4,' . $midbox . ');';
  }

//Translate to top left corner of heat chart
$javascript = $javascript . 'ctx.translate(' . $heatcolumnsreturn . ',' . $heatrowsreturn . ');';
$javascript = $javascript . 'ctx.translate(' . $singleboxback . ',0);';

//Loop through columns and rows to manage the translation correctly
$interactionkey = 0;
foreach ($rows as $row)
  {
  foreach ($columns as $columnskey=>$column)
    {
    if ($columnskey > 0)
      $javascript = $javascript . 'ctx.translate(' . $boxsize . ',0);';

    //Check that the columns and rows match the Name2 and Name1 columns respectively
    if (($interactions[$interactionkey]['Name2'] == $column) AND ($interactions[$interactionkey]['Name1'] == $row))
      {
      //Define the heat colour within a range of 0 - 60 degrees
      $heatcolour = valuetocolour($interactions[$interactionkey][$heattomap],0,60,$heatcolourscheme);

      //Echo a heat box if there is a match
      $javascript = $javascript . 'ctx.beginPath();';
      $javascript = $javascript . 'ctx.fillStyle="' . $heatcolour . '";';
      $javascript = $javascript . 'ctx.fillRect(0,0,' . $boxsize . ',' . $boxsize . ');';
      $javascript = $javascript . 'ctx.rect(0,0,' . $boxsize . ',' . $boxsize . ');';
      $javascript = $javascript . 'ctx.stroke();';
      $javascript = $javascript . 'ctx.font="15px Arial";';
      $javascript = $javascript . 'ctx.textAlign="center";';
      $javascript = $javascript . 'ctx.textBaseline="middle";';
      $javascript = $javascript . 'ctx.fillStyle = "rgb(0,0,0)";';
      $javascript = $javascript . 'ctx.fillText(' . $interactions[$interactionkey][$heattomap] . ',' . $midbox . ',' . $midbox . ');';
      $interactionkey++;
      }
    else
      {
      //Echo a black box if there is no match, this happens until the columns/rows catch up with the interactions
      $javascript = $javascript . 'ctx.beginPath();';
      $javascript = $javascript . 'ctx.fillStyle="rgb(0,0,0)";';
      $javascript = $javascript . 'ctx.fillRect(0,0,' . $boxsize . ',' . $boxsize . ');';
      $javascript = $javascript . 'ctx.rect(0,0,' . $boxsize . ',' . $boxsize . ');';
      $javascript = $javascript . 'ctx.stroke();';
      }
    }
  //At the end of the columns move to new row
  $javascript = $javascript . 'ctx.translate(' . $heatcolumnsreturn . ',' . $boxsize . ');';
  }

//Translate back to top left corner
$backtotop = 0-$outlineheight;
$javascript = $javascript . 'ctx.translate(0,' . $backtotop . ');';

$javascript = $javascript . 'ctx.beginPath();';
$javascript = $javascript . 'ctx.rect(0,0,' . $outlineheight . ',' . $outlinewidth . ');';
$javascript = $javascript . 'ctx.stroke();';
?>
