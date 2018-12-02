<?php
include 'required-files.php';

$text = ">Sequence1\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence2\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence3\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
//$text = "THERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
//$text = "Sequence1\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nSequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nSequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
//$text = ">Sequence1\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";

//Standardise the new lines of the text input
$text = standardisenewlines($text);

//Number of tabs and arrows to work out what the input type is
$tabs = substr_count($text,"\t");
$arrows = substr_count($text,">");

if (($arrows > 0) AND ($tabs == 0))
  {
  $sequences = texttofasta($text);
  $sequences = $sequences['Sequences'];
  }
elseif (($arrows == 0) AND ($tabs > 0))
  {
  echo "This is a TSV";
  }
elseif (($arrows == 0) AND ($tabs == 0))
  {
  echo "This is one line per sequence";
  }
else
  {
  echo "Error, input is ambiguous, it should either be FASTA, tab separated, or 1 line per sequence, do not have any tabs or > in your input unless you intend it to be FASTA or TSV input.";
  }

print_r($sequences);
?>
