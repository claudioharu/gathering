<?php
require "func.php";
include "con.php";

session_start();

$sql = 'select x.name, x.author, avg(votes) as visual
from MangaHere_Mangas as x, bakaUpdates_Stats as y
where x.name = y.name
group by x.author
order by avg(votes) Desc limit 10';

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