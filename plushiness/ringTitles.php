<?php
require "func.php";
include "con.php";
session_start();

$search = $_POST['value'][0];

$sqlBaka = 'SELECT name FROM bakaUpdates_Stats WHERE author  = "'. $search . '" or artist="' . $search. '"';
$resultB = $conn->query($sqlBaka);

foreach ($resultB as $row)
{
	$manga = $row["name"];
	if ($manga != "unknown")
		$children[] = array('source' => $search, 'target' =>$manga, "strength" => 1);
}

header('Content-Type: application/json');
echo json_encode($children);
?>