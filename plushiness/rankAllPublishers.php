<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select publisher, avg(visual) as viz
from MangaFox_Mangas as fox , bakaUpdates_Stats as baka
where fox.name = baka.name
group by publisher 
order by viz Desc limit 300';

$results = $conn->query($sqls);
$i = 0;
foreach ($results as $row)
{
	$name =$row['publisher'];
	$visual = $row['visual'];

	if($name != "N/A" && $name != 'Add')
	{
		$child[] = array('name' => $name, 'value' => $visual, 'pos' => $i);
		$i++;
	}
}


	
header('Content-Type: application/json');
echo json_encode($child);
?>