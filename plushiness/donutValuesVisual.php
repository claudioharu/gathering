<?php

require "func.php";
include "con.php";

session_start();

$sqlBaka = 'select gender, Sum(visual) as visual
from MangaFox_Mangas as fox, bakaUpdates_People as baka
where fox.author = baka.person 
group by gender';
$resultB = $conn->query($sqlBaka);

$data = [];
foreach ($resultB as $row)
{
	$gender = $row['gender'];
	$visual = $row['visual'];

	// $data[$gender] = $visual;
	
	$children[] = array($gender => $visual);
}



$sql = 'select gender, Sum(visual) as visual
from MangaHere_Mangas as fox, bakaUpdates_People as baka
where fox.author = baka.person 
group by gender';
$result = $conn->query($sql);

$datas = [];
foreach ($result as $row)
{
	$gender = $row['gender'];
	$visual = $row['visual'];

	// $datas[$gender] = $visual;
	
	$child[] = array($gender => $visual);
}



$b = array( 'Fox' => $children, "Here" => $child);
header('Content-Type: application/json');
echo json_encode($b);

?>
