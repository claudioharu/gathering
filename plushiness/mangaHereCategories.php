<?php
require "func.php";
include "con.php";

$sql = 'select categorie from MangasCategories where site = "mangahere" group by categorie';
$result = $conn->query($sql);

$categories = array();
foreach ($result as $row)
{
	array_push($categories, $row['categorie']);
	
}


$children =  array('categories' => $categories);

header('Content-Type: application/json');
echo json_encode($children);
?>