# bCIPA
Scripts related to the bCIPA leucine zipper affinity prediction algorithm

These scripts apply the bCIPA algorithm to multiple protein sequences in a variety of different fashions. These are the interactome screen, the library vs target screen and the A vs B set screen.

Calculation Engines

The engines for the bCIPA multi sequence screener are:
bcipa-avsbset.php - For one set of sequences against another set of sequences
bcipa-interactome.php - For all interactions between members of a set of sequences
bcipa-libraryvstarget.php - For all interactions between one library of sequences and another

To use bcipa-avsbset.php
Inputs:
$sequences1 and $sequences2 are identically structured arrays containing protein sequences, where each element is an array containing ['Name'] and ['Sequence']
$frame is the frame that the leucine zippers are in.
$offset is the offset that the leucine zippers are offset by, default is 0 and is currently non-functional
Outputs:
$canvashtml is the canvas where the heat chart is drawn
$javascript is the javascript to draw the heat chart
$interactions is an array of the interactions, where each element is an array containing the elements ['bCIPATm'], ['Name1'], ['Name2'], ['Sequence1'] and ['Sequence2'] elements.

To use bcipa-interactome.php
Inputs:
$sequences is an array containing protein sequences, where each element is an array containing ['Name'] and ['Sequence']
$frame is the frame that the leucine zippers are in.
$offset is the offset that the leucine zippers are offset by, default is 0 and is currently non-functional
Outputs:
$canvashtml is the canvas where the heat chart is drawn
$javascript is the javascript to draw the heat chart
$interactions is an array of the interactions, where each element is an array containing the elements ['bCIPATm'], ['Name1'], ['Name2'], ['Sequence1'] and ['Sequence2'] elements.

To use bcipa-libraryvstarget.php
Inputs:
$library is an array containing protein sequences, where each element is an array containing ['Name'] and ['Sequence']
$target is an array containing ['Name'] and ['Sequence'] denoting a single protein sequence
$frame is the frame that the leucine zippers are in.
$offset is the offset that the leucine zippers are offset by, default is 0 and is currently non-functional
Output:
$interactions is an array of the interactions, where each element is an array containing the elements ['bCIPATm'], ['Name1'], ['Name2'], ['Sequence1'] and ['Sequence2'] elements.

An interaction table creation wizard script is interactions-tables.php
Inputs:
$interactions is an array of the interactions, where each element is an array containing the elements ['bCIPATm'], ['Name1'], ['Name2'], ['Sequence1'] and ['Sequence2'] elements.
Outputs:
$htmlinteractionstable is a table in HTML format which calls the table class "scientific" which can be defined in your css file;
$textinteractionstable is a table in a text area which can be copied and pasted into excel or a text editor.

In future these output (interactions-tables.php, sequences-to-display.php and interactions-heat.php) generators may be rationalised into a single script.

References:
To reference this script, please cite the following
Crooks, R. O., Lathbridge, A., Panek, A. S. and Mason, J. M. (2017) Computational Prediction and Design for Creating Iteratively Larger Heterospecific Coiled Coil Sets. Biochemistry. 56: 1573-1584.
Crooks, R. O., Baxter, D., Panek, A. S., Lubben, A. T. and Mason, J. M. (2016) Deriving Heterospecific Self-Assembling Protein-Protein Interactions Using a Computational Interactome Screen. J Mol Biol. 428: 385-398.
For the original algorithm:
Hagemann, U. B., Mason, J. M., Müller, K. M. and Arndt, K. M. (2008) Selectional and mutational scope of peptides sequestering the Jun-Fos coiled-coil domain. J Mol Biol. 381: 73-88.
Mason, J. M., Schmitz, M. A., Müller, K. M. and Arndt, K. M. (2006) Semirational design of Jun-Fos coiled coils with increased affinity: Universal implications for leucine zipper prediction and design. Proc Natl Acad Sci U S A. 103: 8989-94.
