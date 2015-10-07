<?php
require "func.php";
include "con.php";

session_start();




$sql = 'select X.name, baka.author, visual  from 
	(select name, author, visual, status from MangaFox_Mangas UNION all 
	select name, author, visual, status from MangaHere_Mangas) as X,
	bakaUpdates_Stats as baka
	where baka.name = X.name
	group by X.author
	order by visual Desc limit 10';

$result = $conn->query($sql);

foreach ($result as $row)
{
	$name = ucfirst($row['name']);
	$author = ucfirst($row['author']);
	$visual = $row['visual'];

	if (strlen($name) > 53){
		$name =  substr($name, 0, 48);
		$name = $name . " ...";
	}
	$children[] = array('label' => $author, 'value' =>$visual);
}

// $b[] = array('key' => 'Titles AVG', 'values' => $children);
header('Content-Type: application/json');
echo json_encode($children);
?>