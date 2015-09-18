<?php

require "func.php";
include "con.php";

	session_start();

	$search = $_SESSION['ringValue'];
// $search = "Miura"

// function rings($search)
// {
	// select name, author, artist, totalVotes from bakaUpdates_Stats where author = "CHENG KIN WO" or artist = "CHENG KIN WO"

	$sqlBaka = 'SELECT author, artist FROM bakaUpdates_Stats WHERE author  = "'. $search . '" or artist="' . $search. '" GROUP BY  author, artist' ;
	$resultB = $conn->query($sqlBaka);

	foreach ($resultB as $row)
	{
		$artist = $row['artist'];
		$author = $row['author'];
		// $totalVotes = $row['totalVotes'];
		// $manga = $row["name"].
		$children[] = array('source' => $artist, 'target' =>$author, "strength" => 1);
	}



	// $b = array('name' => 'inicio', 'children' => $a);
	header('Content-Type: application/json');
	echo json_encode($children);
// }
?>