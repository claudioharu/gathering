<?php

require "func.php";
include "con.php";

session_start();

$search = $_POST['valueAuthorBar'][0];


$sqlBaka = 'SELECT name, avg FROM bakaUpdates_Stats WHERE author  = "'. $search . '" or artist="' . $search. '" order by avg DESC';
$resultB = $conn->query($sqlBaka);

foreach ($resultB as $row)
{
	$name = ucfirst($row['name']);
	$rate = $row['avg'];

	if (strlen($name) > 53){
		$name =  substr($name, 0, 50);
		$name = $name . " ...";
	}
	$children[] = array('label' => $name, 'value' =>$rate);
}

$b[] = array('key' => 'Titles AVG', 'values' => $children);
header('Content-Type: application/json');
echo json_encode($b);

?>