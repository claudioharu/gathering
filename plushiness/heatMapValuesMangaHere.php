<?php
require "func.php";
include "con.php";
session_start();

$sql = 'select MangaHere1.categorie as x, MangaHere2.categorie as y , SUM(visual) as value from MangasCategories as MangaHere1, MangasCategories as MangaHere2, MangaHere_Mangas where MangaHere2.site = "mangahere" and MangaHere1.site = "mangahere" and MangaHere1.name = MangaHere2.name and MangaHere1.name = MangaHere_Mangas.name group by x, y';

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