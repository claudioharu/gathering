<?php

$Q1=[7, 1, 1, 2, 4, 6, 13, 20,  17, 29];
$Q1Votes=[323, 34, 64, 95, 201, 286, 627, 970, 811, 1396];
$Q2=[0.3, 0.3, 0.6, 1.4, 3.7, 7.3, 16.9, 23.3,  23.1, 23.2];
$Q2Votes=[403,372,714,1571,4230,8428,19537,26955,26777,26852];

for ($i = 0; $i < 10; $i++){
	$children[] = array('Q1' => strval($Q1[$i]), 'Q1Votes' => strval($Q1Votes[$i]),  'Q2' =>strval($Q2[$i]), 'Q2Votes' => strval($Q2Votes[$i]),);
}


header('Content-Type: application/json');
echo json_encode($children);

?>