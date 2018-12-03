<?php
//---FunctionBreak---
/*Normalises a value against minumum and maximum values in a range

$value is the value to normalise
$min is the minimum value
$max is the maximum value

Output is a colour for a particular heat on a heat chart*/
//---DocumentationBreak---
function normalisevalue($value,$min,$max)
  {
  $numerator = $value-$min;
  $denominator = $max-$min;
  $normalised = $numerator/$denominator;
  Return $normalised;
  }
//---FunctionBreak---
?>
