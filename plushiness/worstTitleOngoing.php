<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select * from
(select name, visual
from MangaHere_Mangas
where status != "Completed"
order by visual limit 10) as A
order by visual Desc';

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
	$child[] = array('name' => $name, 'value' =>$visual, 'status' =>'Ongoing');
}

// echo $child;

$sql = 'select * from
(select name, visual, status 
from MangaFox_Mangas
where status = "Ongoing"
order by visual limit 10) as B
order by visual Desc';

$result = $conn->query($sql);

foreach ($result as $row)
{
	$nam = ucfirst($row['name']);
	$visua = $row['visual'];
	if (strlen($nam) > 38){
		$nam =  substr($nam, 0, 33);
		$nam = $nam . " ...";
	}
	// $site = 'mangahere';
	$children[] = array('name' => $nam, 'value' =>$visua, 'status' =>'Ongoing');
}



// echo $childrenh;
$b[] = array('mangahere' => $child, 'mangafox' => $children);
header('Content-Type: application/json');
echo json_encode($b);
?>