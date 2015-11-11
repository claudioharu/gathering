<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select name, visual
from MangaHere_Mangas
order by visual Desc limit 10';

$results = $conn->query($sqls);

foreach ($results as $row)
{
	$name = ucfirst($row['name']);
	$visual = $row['visual'];
	if (strlen($name) > 38){
		$name =  substr($name, 0, 33);
		$name = $name . " ...";
	}
	// $site = 'mangahere';
	$child[] = array('name' => $name, 'value' =>$visual, 'status' =>'total');
}

// echo $child;

$sql = 'select name, visual, status 
from MangaFox_Mangas
order by visual Desc limit 10';

$result = $conn->query($sql);

foreach ($result as $row)
{
	$nam = ucfirst($row['name']);
	$visua = $row['visual'];
	// $site = 'mangahere';
	if (strlen($nam) > 38){
		$nam =  substr($nam, 0, 33);
		$nam = $nam . " ...";
	}
	$children[] = array('name' => $nam, 'value' =>$visua, 'status' =>'total');
}



// echo $childrenh;
$b[] = array('mangahere' => $child, 'mangafox' => $children);
header('Content-Type: application/json');
echo json_encode($b);
?>