<?php

require "func.php";
include "con.php";

session_start();

$sqlBaka = 'select gender, sum(votes) as votes
from MangaFox_Mangas as fox, bakaUpdates_People as baka
where fox.author = baka.person 
group by gender';
$resultB = $conn->query($sqlBaka);

foreach ($resultB as $row)
{
	$gender = $row['gender'];
	$votes = $row['votes'];
	
	$children[] = array($gender => $votes);
}



$sql = 'select gender, sum(votes) as votes
from MangaHere_Mangas as fox, bakaUpdates_People as baka
where fox.author = baka.person 
group by gender';
$result = $conn->query($sql);

foreach ($result as $row)
{
	$gender = $row['gender'];
	$votes = $row['votes'];
	
	$child[] = array($gender => $votes);
}



$b = array( 'Fox' => $children, "Here" => $child);
header('Content-Type: application/json');
echo json_encode($b);

?>
