<?php
include 'required-files.php';

//$text = ">Sequence1\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence2\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence3\nTHERSERFERSBZZZZEEEPIYTGMNV\n>Sequence4\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
$text = "THERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nTHERSERFERSBZZZZEEEPIYTGMNV\nTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
//$text = "Sequence1\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nSequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\nSequence3\tTHERSERFERSBZZZZEEEPIYTGMNV\nSequence4\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";
//$text = ">Sequence1\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence2\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV\n>Sequence3\tTHERSERFERSBZZZZEEEPIYTGMNV\n>Sequence4\tTHERSERFERSKLSFDEDDESSEWEEEPIYTGMNV";

//Standardise the new lines of the text input
$text = standardisenewlines($text);

//Number of tabs and arrows to work out what the input type is
$tabs = substr_count($text,"\t");
$arrows = substr_count($text,">");

if (($arrows > 0) AND ($tabs == 0))
  {
  //Input as a FASTA formatted text
  $sequences = texttofasta($text);
  $sequences = $sequences['Sequences'];
  }
elseif (($arrows == 0) AND ($tabs > 0))
  {
  //Import as a table
  $headers = array("Name","Sequence");
  $sequences = texttoarraytable($text,$headers);
  }
elseif (($arrows == 0) AND ($tabs == 0))
  {
  //Import as one sequence per line
  $sequences = explode("\n",$text);
  $sequencecount = 1;

  //Give each sequence a default name and format as the other sequences are formatted
  foreach ($sequences as $sequencekey=>$sequence)
    {
    $sequencename = "Protein " . $sequencecount;
    $sequenceline = array("Name"=>$sequencename,"Sequence"=>$sequence);
    $sequencecount++;

    $sequences[$sequencekey] = $sequenceline;
    }
  }
else
  {
  echo "Error, input is ambiguous, it should either be FASTA, tab separated, or 1 line per sequence, do not have any tabs or > in your input unless you intend it to be FASTA or TSV input.";
  }

//Run validation check on sequences and remove any that are not legal protein sequences
$legals = str_split("ACDEFGHIKLMNPQRSTVWY");
foreach ($sequences as $sequenceskey=>$sequence)
  {
  if (checklegal($sequence['Sequence'],$legals) == false)
    unset($sequences[$sequenceskey]);
  }

print_r($sequences);
?>
