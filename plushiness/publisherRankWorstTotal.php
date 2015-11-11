<?php
require "func.php";
include "con.php";

session_start();

$sqls = 'select *
from
(select publisher, visual
from MangaFox_Mangas as fox , bakaUpdates_Stats as baka
where fox.name = baka.name
group by publisher 
order by visual limit 10) as A
order by visual Desc';

$results = $conn->query($sqls);

foreach ($results as $row)
{
	$name = ucfirst($row['publisher']);
	$visual = $row['visual'];
	if (strlen($name) > 38){
		$name =  substr($name, 0, 33);
		$name = $name . " ...";
	}
	// $site = 'mangahere';
	$child[] = array('name' => $name, 'value' =>$visual, 'status' =>'total');
}

// echo $child;

$sql = '
select * from
(select publisher, visual
from MangaHere_Mangas as here , bakaUpdates_Stats as baka
where here.name = baka.name
group by publisher 
order by visual limit 10) as B
order by visual Desc';

$result = $conn->query($sql);

foreach ($result as $row)
{
	$nam = ucfirst($row['publisher']);
	$visua = $row['visual'];
	// $site = 'mangahere';
	if (strlen($nam) > 38){
		$nam =  substr($nam, 0, 33);
		$nam = $nam . " ...";
	}
	$children[] = array('name' => $nam, 'value' =>$visua, 'status' =>'total');
}



// echo $childrenh;
$b[] = array('mangafox' => $child, 'mangahere' => $children);
header('Content-Type: application/json');
echo json_encode($b);
?>