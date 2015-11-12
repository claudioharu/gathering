<?php

require "func.php";
include "con.php";

session_start();

$search = $_POST['valueAuthorBar'][0];

// $search = "OBATA TAKESHI";
$sqlBaka = 'SELECT name, avg FROM bakaUpdates_Stats WHERE author  = "'. $search . '" or artist="' . $search. '" order by avg DESC';
$resultB = $conn->query($sqlBaka);

foreach ($resultB as $row)
{
	$name = ucfirst($row['name']);
	$rate = $row['avg'];


	$children[] = array('value' =>$rate);
}
header('Content-Type: application/json');
echo json_encode($children);

?>