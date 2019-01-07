<?php
//---FunctionBreak---
/*This function is used to sort peptide interactomes arrays

The array sorted is a 2 dimensional array containing one interaction per array element and within each interaction ['Peptide 1'] and ['Peptide 2'] elements. Other elements can store other interaction properties, but these are not required for sorting

Called using usort*/
//---DocumentationBreak---
function interactomesort($a, $b)
	{
	//
	if ($a['Peptide 1'] == $b['Peptide 1'])
		{
		if ($a['Peptide 2'] == $b['Peptide 2'])
			{
			return 0;
			}
		}
	return ($a < $b) ? -1 : 1;
	}
//---FunctionBreak---
?>
