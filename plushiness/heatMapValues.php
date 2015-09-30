<?php
require "func.php";
include "con.php";
session_start();



$day = [1,1,1,1,1,1,8];
$hour = [1,2,3,4,5,6,7];
$value = [197055683, 120205279,20, 0,0,0,2324524];

for ($i = 0; $i < 7; $i++)
{
	$children[] = array('day' => $day[$i], 'hour' =>$hour[$i], "value" => $value[$i]);
}

header('Content-Type: application/json');
echo json_encode($children);
?>