<?php

$Q1=[20000, 9879, 5070, 7343, 9136, 7943, 10546, 9385,  8669, 4000];
$Q2=[15000, 9323, 9395, 8675, 5354, 6725, 10899, 9365,  8238, 7446];

for ($i = 0; $i < 10; $i++){
	$children[] = array('Q1' => strval($Q1[$i]), 'Q2' =>strval($Q2[$i]));
}


header('Content-Type: application/json');
echo json_encode($children);

?>