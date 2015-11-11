<?php
require "func.php";
include "con.php";
session_start();

$sql = 'select MangaFox1.categorie as x, MangaFox2.categorie as y , SUM(votes) as value from MangasCategories as MangaFox1, MangasCategories as MangaFox2, MangaFox_Mangas where MangaFox2.site = "mangafox" and MangaFox1.site = "mangafox" and MangaFox1.name = MangaFox2.name and MangaFox1.name = MangaFox_Mangas.name group by x, y';

$day = array();
$hour = array();
$value = array();

$result = $conn->query($sql);
foreach ($result as $row)
{
	
	array_push($day, $row['y']);
	array_push($hour, $row['x']);
	array_push($value, $row['value']);
}

// $day = ["action","action","action","action","action","action","action"]; //y
// $hour = ["action","adventure","comedy","doujinshi","mecha","horror","school life"]; //x
// $value = [197055683, 120205279,20, 0,0,0,2324524];

for ($i = 0; $i < sizeof($day); $i++)
{
	$children[] = array('day' => $day[$i], 'hour' =>$hour[$i], "value" => $value[$i]);
}

header('Content-Type: application/json');
echo json_encode($children);
?>