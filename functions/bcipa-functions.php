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
/*Calculates the core score from the core contacts array

$contacts is an array of core contacts found by bcipacontacts()

Output is the core interactions score*/
//---DocumentationBreak---
function bcipacore($contacts)
	{
	$contacts = implode($contacts,"-");
	$scores = array("II","LL","VI","IV");
	str_replace($scores,"",$contacts,$count);
	$core = $count*-1.5;
	$scores = array("VV","VL","LV","IL","IL","IR","RI","IK","KI");
	str_replace($scores,"",$contacts,$count);
	$coreadd = $count*-1;
	$core = $core+$coreadd;
	$scores = array("IA","AI","LA","AL","VA","AV","NN","IN","NI","IT","TI","LK","KL","LT","TL","RR");
	str_replace($scores,"",$contacts,$count);
	$coreadd = $count*-0.5;
	$core = $core+$coreadd;
	$scores = array("VT","TV");
	str_replace($scores,"",$contacts,$count);
	$coreadd = $count*0.5;
	$core = $core+$coreadd;
	Return $core;
	}
//---FunctionBreak---
/*Calculates the electrostatic score from the electrostatic contacts array

$contacts is an array of electrostatic contacts found by bcipacontacts()

Output is the electrostatic interactions score*/
//---DocumentationBreak---
function bcipaes($contacts)
	{
	$contacts = implode($contacts,"-");
	$scores = array("RE","ER");
	str_replace($scores,"",$contacts,$count);
	$es = $count*-2;
	$scores = array("KE","EK","KQ","QK","RQ","QR","QQ");
	str_replace($scores,"",$contacts,$count);
	$esadd = $count*-1.5;
	$es = $es+$esadd;
	$scores = array("QE","EQ");
	str_replace($scores,"",$contacts,$count);
	$esadd = $count*-1;
	$es = $es+$esadd;
	$scores = array("QA","AQ","RA","AR","KD","DK","RD","DR","KL","LK","TL","LT","RK","KR");
	str_replace($scores,"",$contacts,$count);
	$esadd = $count*-0.5;
	$es = $es+$esadd;
	$scores = array("EE","KK","RR");
	str_replace($scores,"",$contacts,$count);
	$esadd = $count*0.5;
	$es = $es+$esadd;
	$scores = array("DD","DE","ED","RT","TR");
	str_replace($scores,"",$contacts,$count);
	$esadd = $count*1;
	$es = $es+$esadd;
	Return $es;
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
  $interaction['Core'] = bcipacore($contacts['Cores']);
	$interaction['Electrostatics'] = bcipaes($contacts['Electrostatics']);

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
