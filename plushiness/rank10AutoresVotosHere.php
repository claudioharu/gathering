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

$sqlAuthor = array();
$aux = "select name, sum(votes) as votes, author
from MangaFox_Mangas
where author = '";
$aux2 = "' group by name";

foreach ($result as $row)
{
	$name = ucfirst($row['name']);
	$author = ucfirst($row['author']);
	$visual = $row['visual'];
if (strpos($a,'are') !== false) {
    echo 'true';
}
	if( strpos($author, 'Tamura ') !== false){
		$author = 'Tamura Ryuuhei';
	}
	else if(strpos($author, 'Takahiro ') !==false)
	{
		$author = 'Takahiro';
	}
	if (strlen($name) > 53){
		$name =  substr($name, 0, 48);
		$name = $name . " ...";
	}
	$children[] = array('label' => $author, 'value' =>$visual);
	// echo($aux . $author. $aux2);
	// echo "<br>";
	array_push($sqlAuthor, $aux . $author. $aux2);

}

foreach ($sqlAuthor as $s)
{
	$results = $conn->query($s);
	
	foreach ($results as $row)
	{
		$name = ucfirst($row['name']);
		$author = ucfirst($row['author']);
		$visual = $row['votes'];
		$released = $row['name'];
		if (strlen($released) > 10){
			$released =  substr($released, 0, 8);
			$released = $released . " ...";
		}
		$child[] = array('author' => $author, 'released' => $released, 'votes' => $visual, "name" => $name);
	}

}
$b[] = array('chart1' => $children, 'chart2' => $child);
header('Content-Type: application/json');
echo json_encode($b);
?>