<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select name, visual
from MangaHere_Mangas
where status = "Completed"
order by visual Desc limit 10';

$results = $conn->query($sqls);

foreach ($results as $row)
{
	$name = ucfirst($row['name']);
	$visual = $row['visual'];
	// $site = 'mangahere';
	$child[] = array('name' => $name, 'value' =>$visual, 'status' =>'Completed');
}

// echo $child;

$sql = 'select name, visual, status 
from MangaFox_Mangas
where status = "Completed"
order by visual Desc limit 10';

$result = $conn->query($sql);

foreach ($result as $row)
{
	$nam = ucfirst($row['name']);
	$visua = $row['visual'];
	// $site = 'mangahere';
	$children[] = array('name' => $nam, 'value' =>$visua, 'status' =>'Completed');
}



// echo $childrenh;
$b[] = array('mangahere' => $child, 'mangafox' => $children);
header('Content-Type: application/json');
echo json_encode($b);
?>