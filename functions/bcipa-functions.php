<?php
//---FunctionBreak---
/*Retrieves all intra-peptide contacts from an interaction array

$interaction is an interaction array containing at least ['Sequence1'] and ['Sequence2'] elements
$frame is the frame that the interaction is in, defaulted in "a", must be abcdefg, anything specified in the interaction array will overwrite this

Output is the the average Williams helicity for the entire sequence */
//---DocumentationBreak---
function bcipacontacts($interaction,$frame="")
	{
  //Sequence 1 and 2 from interaction
	$sequencearray1 = str_split($interaction['Sequence1']);
	$sequencearray2 = str_split($interaction['Sequence2']);

	//Get frame and default to a if not set
  if ((isset($interaction['Frame']) == true) AND (($frame == "a") OR ($frame == "b") OR ($frame == "c") OR ($frame == "d") OR ($frame == "e") OR ($frame == "f") OR ($frame == "g")))
    $frame = $interaction['Frame'];
  elseif (($frame != "a") AND ($frame != "b") AND ($frame != "c") AND ($frame != "d") AND ($frame != "e") AND ($frame != "f") AND ($frame != "g"))
    $frame = "a";

	//Set offset to 0 by default
	if (isset($interaction['Offset']) == false)
		$interaction['Offset'] = 0;

	$count1 = count($sequencearray1);
	$count2 = count($sequencearray2);
	$cores = array();
	$electrostatics = array();
	$key1 = 0;
	$key2 = $key1+$interaction['Offset'];
	while (($key1 < $count1) AND ($key2 < $count2))
		{
		Switch ($frame)
			{
			Case "a":
        //Lookup residues
        if (isset($sequencearray2[$key1]) == true)
          $resi1 = $sequencearray2[$key1];
        else
          $resi1 = "-";
        if (isset($sequencearray2[$key2]) == true)
				  $resi2 = $sequencearray2[$key2];
        else
          $resi2 = "-";

				$contact = $resi1 . $resi2;
				array_push($cores,$contact);

				$key1 = $key1+3;
				$key2 = $key2+3;
				$frame = "d";
				Break;
			Case "b":
				$key1 = $key1+2;
				$key2 = $key2+2;
				$frame = "d";
				Break;
			Case "c":
				$key1 = $key1+1;
				$key2 = $key2+1;
				$frame = "d";
				Break;
			Case "d":
        //Lookup residues
        if (isset($sequencearray2[$key1]) == true)
          $resi1 = $sequencearray2[$key1];
        else
          $resi1 = "-";
        if (isset($sequencearray2[$key2]) == true)
          $resi2 = $sequencearray2[$key2];
        else
          $resi2 = "-";

        $contact = $resi1 . $resi2;
        array_push($cores,$contact);

				$key1 = $key1+1;
				$key2 = $key2+1;
				$frame = "e";
				Break;
			Case "e":
        //Lookup residues
        if (isset($sequencearray2[$key1]) == true)
          $resi1 = $sequencearray2[$key1];
        else
          $resi1 = "-";
        if (isset($sequencearray2[$key2-5]) == true)
          $resi2 = $sequencearray2[$key2-5];
        else
          $resi2 = "-";

        $contact = $resi1 . $resi2;
        array_push($electrostatics,$contact);

				$key1 = $key1+2;
				$key2 = $key2+2;
				$frame = "g";
				Break;
			Case "f":
				$key1 = $key1+1;
				$key2 = $key2+1;
				$frame = "g";
				Break;
			Case "g":
        //Lookup residues
        if (isset($sequencearray2[$key1]) == true)
          $resi1 = $sequencearray2[$key1];
        else
          $resi1 = "-";
        if (isset($sequencearray2[$key2+5]) == true)
          $resi2 = $sequencearray2[$key2+5];
        else
          $resi2 = "-";

        $contact = $resi1 . $resi2;
        array_push($electrostatics,$contact);

				$key1 = $key1+1;
				$key2 = $key2+1;
				$frame = "a";
				Break;
			}
		}
	$output = array();
	$output['Cores'] = $cores;
	$output['Electrostatics'] = $electrostatics;
	Return $output;
	}
//---FunctionBreak---
/*Calculates the score from the contacts array

$contacts is an array of contacts found by bcipacontacts()
$type is whether the interaction is Core or ES

Output is the interactions score*/
//---DocumentationBreak---
function bcipascoreinteractions($contacts,$type)
	{
	//Select scores based on interaction types
	$scores = array();
	if ($type == "Core")
		{
		$scores['LL'] = -1.5;
		$scores['II'] = -1.5;
		$scores['IV'] = -1.5;
		$scores['VV'] = -1;
		$scores['LV'] = -1;
		$scores['IL'] = -1;
		$scores['IR'] = -1;
		$scores['IK'] = -1;
		$scores['AI'] = -0.5;
		$scores['AL'] = -0.5;
		$scores['AV'] = -0.5;
		$scores['NN'] = -0.5;
		$scores['IN'] = -0.5;
		$scores['IT'] = -0.5;
		$scores['KL'] = -0.5;
		$scores['LT'] = -0.5;
		$scores['RR'] = -0.5;
		$scores['TV'] = 0.5;
		}
	elseif ($type == "ES")
		{
		$scores['ER'] = -2;
		$scores['EK'] = -1.5;
		$scores['KQ'] = -1.5;
		$scores['QR'] = -1.5;
		$scores['QQ'] = -1.5;
		$scores['EQ'] = -1;
		$scores['AQ'] = -0.5;
		$scores['AR'] = -0.5;
		$scores['DK'] = -0.5;
		$scores['DR'] = -0.5;
		$scores['KL'] = -0.5;
		$scores['LT'] = -0.5;
		$scores['KR'] = -0.5;
		$scores['EE'] = 0.5;
		$scores['KK'] = 0.5;
		$scores['RR'] = 0.5;
		$scores['DD'] = 1;
		$scores['DE'] = 1;
		$scores['TR'] = 1;
		}

	//Check each contact against scores array
	$score = 0;
	foreach ($contacts as $contact)
		{
		$contact = str_split($contact);
		sort($contact);
		$contact = implode("",$contact);

		if (array_key_exists($contact,$scores) == true)
			$score = $score+$scores[$contact];
		}

	Return $score;
	}
//---FunctionBreak---
/*Calculates the Tm of an interaction array using the bCIPA algorithm

$interaction is an interaction array containing at least ['Sequence1'] and ['Sequence2'] elements
$frame is optional and is defaulted to "a" if not set, or the frame in the interaction array is used

Output is the interaction array with interaction strength included*/
//---DocumentationBreak---
function bcipa($interaction,$frame="a")
	{
  //Set helicity if not already set
	if (isset($interaction['WilliamsHP1']) == false)
		$interaction['WilliamsHP1'] = williamshp($interaction['Sequence1']);
  if (isset($interaction['WilliamsHP2']) == false)
  	$interaction['WilliamsHP2'] = williamshp($interaction['Sequence2']);

  //Get core and electrostatic interaction scores
	$contacts = bcipacontacts($interaction,$frame);
  $interaction['Core'] = bcipascoreinteractions($contacts['Cores'],"Core");
	$interaction['Electrostatics'] = bcipascoreinteractions($contacts['Electrostatics'],"ES");

  //Weight parameters that contribute towards Tm
	$coretm = $interaction['Core']*-10.5716;
	$estm = $interaction['Electrostatics']*-4.7771;
	$interaction['TotalHP'] = $interaction['WilliamsHP1']+$interaction['WilliamsHP2'];
	$hptm = $interaction['TotalHP']*81.3256;

  //Calculate Tm from bCIPA formula
	$tm = -29.1320+$estm+$coretm+$hptm-273.15;

  //Round Tm
	$tm = round($tm);
	if ($tm == '-0')
		$tm = 0;
	$interaction['bCIPATm'] = $tm;

	Return $interaction;
	}
//---FunctionBreak---
?>
