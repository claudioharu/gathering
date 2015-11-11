<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select name, avg(visual) as visual
from (
(select name, visual
from MangaHere_Mangas
order by visual)
union all
(select name, visual
from MangaFox_Mangas
order by visual)) as a
group by name
order by avg(visual) Desc';

$results = $conn->query($sqls);
$i = 0;
foreach ($results as $row)
{
	$name = ucfirst($row['name']);
	$visual = $row['visual'];
	$hyperLink =  str_replace(" ","+",$row['name']);
		
	if (strlen($name) > 38){
		$name =  substr($name, 0, 33);
		$name = $name . " ...";
	}

	$child[] = array('name' => $name, 'value' => $visual, "hyperLink" => $hyperLink, 'pos' => $i);
	$i++;
}

header('Content-Type: application/json');
echo json_encode($child);
?>