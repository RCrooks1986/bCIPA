<?php
//---FunctionBreak---
/*Returns the input sequence and returns only legal characters

$string is the input string
$legals is the legally allowed characters

Output is an output string with only legal characters in it*/
//---DocumentationBreak---
function legalcharactersonly($string,$legals)
	{
	//Split legals into array if it is not an array
	if (is_array($legals) == false)
		$legals = str_split($legals);

	if ($string != '')
		{
		//Convert string to array
		$string = str_split($string);

		$output = "";

		//Loop through each character
		$key = 0;
		$count = count($string);
		while ($key < $count)
			{
			//Add character to output if in legals array
			if (in_array($string[$key],$legals))
				$output = $output . $string[$key];
			$key++;
			}

		Return $output;
		}
	else
		Return $string;
	}
//---FunctionBreak---
/*Checks that a string is a legal string for the input

$string is the input string
$legals is the legally allowed characters

Output is true or false depending on whether the string is legal or not*/
//---DocumentationBreak---
function checklegal($teststring,$legals)
	{
	//Return an output string that is only legal characters
	$outputstring = legalcharactersonly($teststring,$legals);

	if ($teststring == $outputstring)
		Return true;
	else
		Return false;
	}
//---FunctionBreak---
/*Converts a piece of text into a 2 dimenstional array

$text is the text to convert into a 2 dimensional array
$keys is an array of what the keys are for each element in each line of the array, default is 0, 1, 2 etc
$separator is the separator, default is "/t" (tab)

Output is a 2 dimensional array with the same data as the text table*/
//---DocumentationBreak---
function texttoarraytable($text,$keys="",$separator="/t")
	{
	//Explode text into rows array
	$text = standardisenewlines($text);
	$text = explode("\n",$text);

	if ($keys == "Top")
		{
		$keys = explode($separator,$text[0]);
		$rowkey = 1;
		}
	else
		$rowkey = 0;

	//End point for loop
	$rowcount = count($text);
	$output = array();

	while ($rowkey < $rowcount)
		{
		//Make temporary line
		$templine = explode($separator,$text[$rowkey]);

		if (is_array($keys) == true)
			{
			//Column and count
			$colskey = 0;
			$outputline = array();
			$colscount = count($templine);

			while ($colskey < $colscount)
				{
				//Element and key for line
				$colkey = $keys[$colskey];
				$colelement = $templine[$colskey];

				//Add element to array with that key
				$outputline[$colkey] = $colelement;
				$colskey++;
				}

			array_push($output,$outputline);
			}
		else
			array_push($output,$templine);
		$rowkey++;
		}

	Return $output;
	}
//---FunctionBreak---
/*Standardises the different new line types into "/n" which can be easily parsed

$text is the piece of test to standardise

Output is the text with new lines standardised to "/n"*/
//---DocumentationBreak---
function standardisenewlines($text)
	{
	//
	$text = str_replace("\r","\n",$text);
	$replaced = 1;

	//Replace all double new lines and replace with singles until no more new lines are found
	while ($replaced > 0)
		{
		$text = str_replace("\n\n","\n",$text,$replaced);
		}

	//Remove new line tags from start and end if found
	if (substr($text,0,2) == "\n")
		$text = substr($text,2);
	if (substr($text,-2) == "\n")
		$text = substr($text,0,-2);

	Return $text;
	}
?>
