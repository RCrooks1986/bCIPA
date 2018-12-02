<?php
//---FunctionBreak---
/*Finds the Williams et al. helicity score of a protein sequence

$sequence is the sequence of amino acids in a protein

Output is the the average Williams helicity for the entire sequence */
//---DocumentationBreak---
function williamshp($sequence)
	{
  //Remove each character in the sequence and multiply by Williams helicity value
	$sequence = str_replace("-","",$sequence);
	$length = strlen($sequence);
	$sequence = str_replace("A","",$sequence,$hp);
	$hpadd = $hp*1.41;
	$totalhp = $hpadd;
	$sequence = str_replace("C","",$sequence,$hp);
	$hpadd = $hp*0.66;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("D","",$sequence,$hp);
	$hpadd = $hp*0.99;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("E","",$sequence,$hp);
	$hpadd = $hp*1.59;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("F","",$sequence,$hp);
	$hpadd = $hp*1.16;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("G","",$sequence,$hp);
	$hpadd = $hp*0.43;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("H","",$sequence,$hp);
	$hpadd = $hp*1.05;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("I","",$sequence,$hp);
	$hpadd = $hp*1.09;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("K","",$sequence,$hp);
	$hpadd = $hp*1.23;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("L","",$sequence,$hp);
	$hpadd = $hp*1.34;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("M","",$sequence,$hp);
	$hpadd = $hp*1.3;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("N","",$sequence,$hp);
	$hpadd = $hp*0.76;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("P","",$sequence,$hp);
	$hpadd = $hp*0.34;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("Q","",$sequence,$hp);
	$hpadd = $hp*1.27;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("R","",$sequence,$hp);
	$hpadd = $hp*1.21;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("S","",$sequence,$hp);
	$hpadd = $hp*0.57;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("T","",$sequence,$hp);
	$hpadd = $hp*0.76;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("V","",$sequence,$hp);
	$hpadd = $hp*0.98;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("W","",$sequence,$hp);
	$hpadd = $hp*1.02;
	$totalhp = $totalhp+$hpadd;
	$sequence = str_replace("Y","",$sequence,$hp);
	$hpadd = $hp*0.74;
	$totalhp = $totalhp+$hpadd;
	//Sequence Helicity
	$sequenceremain = strlen($sequence);
	if ($sequenceremain > 0)
		Return false;
	else
		{
		$hp = $totalhp/$length;
		$hp = round($hp,4);
		Return $hp;
		}
	}
//---FunctionBreak---
?>
