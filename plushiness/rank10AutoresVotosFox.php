<?php
require "func.php";
include "con.php";

session_start();

$sql = 'select x.name, x.author, avg(votes) as visual
from MangaFox_Mangas as x, bakaUpdates_Stats as y
where x.name = y.name
group by x.author
order by avg(votes) Desc limit 10';

$result = $conn->query($sql);

$sqlAuthor = array();
$aux = "select released, votes, name, author
from MangaFox_Mangas
where author = '";

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

	array_push($sqlAuthor, $aux . $author. "'");

}

foreach ($sqlAuthor as $s)
{
	$results = $conn->query($s);
	
	foreach ($results as $row)
	{
		$name = ucfirst($row['name']);
		$author = ucfirst($row['author']);
		$visual = $row['votes'];
		$released = $row['released'];
		
		$child[] = array('author' => $author, 'released' => $released, 'votes' => $visual);
	}

}
$b[] = array('chart1' => $children, 'chart2' => $child);
header('Content-Type: application/json');
echo json_encode($b);
?>