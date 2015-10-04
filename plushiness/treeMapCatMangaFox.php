<?php
require "func.php";
include "con.php";

session_start();



$sql = 'SELECT count(baka.name) as total, count(DISTINCT author) as author, categorie FROM MangasCategories as categ, bakaUpdates_Stats as baka WHERE  categ.name = baka.name and site  = "mangafox" group by categorie';

$result = $conn->query($sql);
$index = 0;
foreach ($result as $row)
{
	$name = ucfirst($row['categorie']);
	$size = $row['total'];
    $count = $row['author'];

    //mudar
	$children[] = array('name' => $name, 'size' =>$size, 'count' => $count);
    $parent[] = array('name' => $name , 'index' => $index, 'children' => [$children[sizeof($children)-1]] );

    $index ++;
}

$b = array('name' => 'MangaFox', 'children' => $parent);
header('Content-Type: application/json');
echo json_encode($b);
?>

