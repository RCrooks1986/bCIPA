<?php
//---FunctionBreak---
/*Parses a block of text in FASTA format into an array of sequences and comments

$text is the text to find FASTA formatted Sequences

Output is an output array with ['Comment'] (if available) and ['Sequences']
['Sequences'] is a multidimensional array where each element has ['Name'] and
['Sequence'] elements
*/
//---DocumentationBreak---
function texttofasta($text)
	{
	//Standardise new lines for text input
	$text = standardisenewlines($text);

	//Explode FASTA by > indicating beginning of new sequence
	$text = explode(">",$text);

	//Shift FASTA comment from text array and create sequences array to store results of FASTA parsing
	$comment = array_shift($text);
	$sequences = array();

	//Process each FASTA format sequence and push to array
	foreach ($text as &$sequence)
		{
		$sequence = parsefasta($sequence);
		array_push($sequences,$sequence);
		}

	//Output processed fasta array
	$output = array("Sequences"=>$sequences);

	//Format comment as HTML if any is present and add to array
	if ($comment != '')
		{
		$comment = standardisenewlines($comment);
		$comment = str_replace("\n","<br>",$comment);
		$comment = "<p>" . $comment . "</p>";

		$output['Comment'] = $comment;
		}

	Return $output;
  }
//---FunctionBreak---
/*Parses a single example of a FASTA formatted sequence

$text is the FASTA formatted sequences

Output is an array with ['Name'] and ['Sequence']

This function assumes that it is a FASTA sequence, it does no checking*/
//---DocumentationBreak---
function parsefasta($text)
	{
	//Explode text into array
	$text = explode("\n",$text);

	//Get name and sequence
	$name = array_shift($text);
	$sequence = implode($text);

	//Output format
	$output = array("Name"=>$name,"Sequence"=>$sequence);
	Return $output;
	}
//---FunctionBreak---
?>
