<?php
//---FunctionBreak---
/*This converts a fraction into a colour for a particular colour scheme of heatmap

$fraction is the 0 to 1 fraction to convert. Fractions outside of this range are made maximum and minimum
$type is the type of colour scheme to use

Output is a colour for a particular heat on a heat chart*/
//---DocumentationBreak---
function heatcolour($fraction,$type="Default")
	{
	/*
	Colours schemes available
	Default - Blue through cyan, green, yellow, orange, red
	BlueRed - Blue to red
	Greyscale - Greyscale
	Reds/Blues/Greens/Yellows/Cyans/Magentas - Shades of these colours
	Consistent - Version of default with consistent brightness
	Light - Lighter version of default
	Dark - Darker version of default
	*/
	//Ceiling and floor fractions to prevent bugs caused by too high and low numbers
	if ($fraction > 1)
		$fraction = 1;
	if ($fraction < 0)
		$fraction = 0;

	//Check that the specified colour scheme is allowed, otherwise set to Default
	$colourschemes = ("Default","BlueRed","Greyscale","Reds","Blues","Greens","Yellows","Cyans","Magentas","Consistent","Light","Dark");
	if (in_array($type,$colourschemes) == false)
	 	$type = "Default";

	if ($type == "Default")
		{
		if ($fraction == 0)
			{
			$r = 0;
			$g = 0;
			$b = 255;
			}
		elseif ($fraction == 0.25)
			{
			$r = 0;
			$g = 255;
			$b = 255;
			}
		elseif ($fraction == 0.5)
			{
			$r = 0;
			$g = 255;
			$b = 0;
			}
		elseif ($fraction == 0.75)
			{
			$r = 255;
			$g = 255;
			$b = 0;
			}
		elseif ($fraction == 1)
			{
			$r = 255;
			$g = 0;
			$b = 0;
			}
		elseif (($fraction < 0.25) AND ($fraction > 0))
			{
			$fraction = $fraction*4;
			$r = 0;
			$b = 255;
			$g = $fraction*255;
			}
		elseif (($fraction < 0.5) AND ($fraction > 0.25))
			{
			$fraction = $fraction-0.25;
			$fraction = $fraction*4;
			$r = 0;
			$b = $fraction*255;
			$b = 255-$b;
			$g = 255;
			}
		elseif (($fraction < 0.75) AND ($fraction > 0.5))
			{
			$fraction = $fraction-0.5;
			$fraction = $fraction*4;
			$r = $fraction*255;
			$b = 0;
			$g = 255;
			}
		elseif (($fraction < 1) AND ($fraction > 0.75))
			{
			$fraction = $fraction-0.75;
			$fraction = $fraction*4;
			$b = 0;
			$r = 255;
			$g = $fraction*255;
			$g = 255-$g;
			}
		elseif ($fraction = "NF")
			{
			$r = 255;
			$g = 255;
			$b = 255;
			}
		}
	elseif ($type == "BlueRed")
		{
		$g = 0;
		if ($fraction == 0)
			{
			$r = 0;
			$b = 255;
			}
		elseif ($fraction == 0.5)
			{
			$r = 255;
			$b = 255;
			}
		elseif ($fraction == 1)
			{
			$r = 255;
			$b = 0;
			}
		elseif (($fraction < 0.5) AND ($fraction > 0))
			{
			$fraction = $fraction*2;
			$r = 255*$fraction;
			$b = 255;
			}
		elseif (($fraction < 1) AND ($fraction > 0.5))
			{
			$fraction = $fraction-0.5;
			$fraction = $fraction*2;
			$fraction = 1-$fraction;
			$r = 255;
			$b = $fraction*255;
			}
		elseif ($fraction = "NF")
			{
			$r = 255;
			$g = 255;
			$b = 255;
			}
		}
	elseif (($type == "Greyscale") OR ($type == "Reds") OR ($type == "Blues") OR ($type == "Greens") OR ($type == "Yellows") OR ($type == "Cyans") OR ($type == "Magentas"))
		{
		if (is_numeric($fraction))
			{
			if ($type == "Greyscale")
				$lower = 30;
			else
				$lower = 0;
			$range = 255-$lower;
			$colour = $range*$fraction;
			$colour = $colour+$lower;
			}
		elseif ($fraction = "NF")
			{
			$colour = 255;
			}
		if ($type == "Greyscale")
			{
			$r = $colour;
			$g = $colour;
			$b = $colour;
			}
		elseif ($type == "Reds")
			{
			$r = 255;
			$g = 255-$colour;
			$b = 255-$colour;
			}
		elseif ($type == "Blues")
			{
			$r = 255-$colour;
			$g = 255-$colour;
			$b = 255;
			}
		elseif ($type == "Greens")
			{
			$r = 255-$colour;
			$g = 255;
			$b = 255-$colour;
			}
		elseif ($type == "Yellows")
			{
			$r = 255;
			$g = 255;
			$b = 255-$colour;
			}
		elseif ($type == "Cyans")
			{
			$r = 255-$colour;
			$g = 255;
			$b = 255;
			}
		elseif ($type == "Magentas")
			{
			$r = 255;
			$g = 255-$colour;
			$b = 255;
			}
		}
	elseif ($type == "Consistent")
		{
		if ($fraction == 0)
			{
			$r = 0;
			$g = 0;
			$b = 255;
			}
		elseif ($fraction == 0.5)
			{
			$r = 0;
			$g = 255;
			$b = 0;
			}
		elseif ($fraction == 1)
			{
			$r = 255;
			$g = 0;
			$b = 0;
			}
		elseif (($fraction < 0.5) AND ($fraction > 0))
			{
			$fraction = $fraction*2;
			$r = 0;
			$g = $fraction*255;
			$b = 255-$g;
			}
		elseif (($fraction < 1) AND ($fraction > 0.5))
			{
			$fraction = $fraction-0.5;
			$fraction = $fraction*2;
			$r = $fraction*255;
			$b = 0;
			$g = 255-$r;
			}
		elseif ($fraction = "NF")
			{
			$r = 255;
			$g = 255;
			$b = 255;
			}
		}
	if (($type == "Light") OR ($type == "Dark"))
		{
		if ($type == "Light")
			$min = 75;
		else
			$min = 0;
		if ($type == "Dark")
			$max = 180;
		else
			$max = 255;
		$range = $max-$min;
		if ($fraction == 0)
			{
			$r = $min;
			$g = $min;
			$b = $max;
			}
		elseif ($fraction == 0.25)
			{
			$r = $min;
			$g = $max;
			$b = $max;
			}
		elseif ($fraction == 0.5)
			{
			$r = $min;
			$g = $max;
			$b = $min;
			}
		elseif ($fraction == 0.75)
			{
			$r = $max;
			$g = $max;
			$b = $min;
			}
		elseif ($fraction == 1)
			{
			$r = $max;
			$g = $min;
			$b = $min;
			}
		elseif (($fraction < 0.25) AND ($fraction > 0))
			{
			$fraction = $fraction*4;
			$r = $min;
			$b = $max;
			$g = $fraction*$range;
			$g = $g+$min;
			}
		elseif (($fraction < 0.5) AND ($fraction > 0.25))
			{
			$fraction = $fraction-0.25;
			$fraction = $fraction*4;
			$r = 0;
			$b = $fraction*$range;
			$b = $max-$b;
			$b = $b+$min;
			$g = $max;
			}
		elseif (($fraction < 0.75) AND ($fraction > 0.5))
			{
			$fraction = $fraction-0.5;
			$fraction = $fraction*4;
			$r = $fraction*$range;
			$r = $r+$min;
			$b = $min;
			$g = $max;
			}
		elseif (($fraction < 1) AND ($fraction > 0.75))
			{
			$fraction = $fraction-0.75;
			$fraction = $fraction*4;
			$b = $min;
			$r = $max;
			$g = $fraction*$range;
			$g = $max-$g;
			}
		elseif ($fraction = "NF")
			{
			$r = 255;
			$g = 255;
			$b = 255;
			}
		}
	$r = round($r);
	$g = round($g);
	$b = round($b);
	$output = "rgb(" . $r . "," . $g . "," . $b . ")";
	Return $output;
	}
//---FunctionBreak---
/*This converts a value into a colour for a particular colour scheme of heatmap

Requires maths-functions.php

$x is the value
$min is the minimum value in the colour scale
$max is the maximum value in the colour scale
$scheme is the colour scheme to use

Output is a colour for a particular heat on a heat chart

This function should be reviewed*/
//---DocumentationBreak---
function valuetocolour($x,$min,$max,$type="Default")
	{
	if ((is_numeric($x) == true) AND (is_numeric($min) == true) AND (is_numeric($max) == true))
		{
		//Calculate fraction
		$fraction = normalisevalue($x,$min,$max);

		//Calculate colour
		$colour = heatmap($fraction,$type);
		}
	else
		//Default to white if data is not numeric
		$colour = "rgb(255,255,255)";

	Return $colour;
	}
//---FunctionBreak---
?>
