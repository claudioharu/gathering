<?php

require "func.php";
include "con.php";
session_start();
$search = $_SESSION['boxInfos'];
// $search = "naruto";


$sqlBaka = 'SELECT votes1, votes2, votes3, votes4, votes5, votes6, votes7, votes8, votes9, votes10, percent1, percent2, percent3, percent4, percent5, percent6, percent7, percent8, percent9, percent10 FROM  bakaUpdates_Stats WHERE name  = "'. $search . '"';
$sqlMy = 'SELECT votes1, votes2, votes3, votes4, votes5, votes6, votes7, votes8, votes9, votes10, percent1, percent2, percent3, percent4, percent5, percent6, percent7, percent8, percent9, percent10 FROM  MangaMyanimelist_Stats WHERE name  = "'. $search . '"';
$sqlBakaBayer = 'SELECT 
    name, 
    ((avg_num_votes * avg_rating) + (this_num_votes * this_rating)) / (avg_num_votes + this_num_votes) as real_rating 
FROM 
(SELECT
    name,
    (SELECT count(name) FROM bakaUpdates_Stats) / (SELECT count(DISTINCT name) FROM bakaUpdates_Stats) AS avg_num_votes,
    (SELECT avg(bakaUpdates_Stats.avg) FROM bakaUpdates_Stats) AS avg_rating,
    count(name) as this_num_votes,
    avg(bakaUpdates_Stats.avg) as this_rating
FROM bakaUpdates_Stats
GROUP BY name) as baka WHERE name="'. $search . '"';

$sqlMyBayer = 'SELECT 
    name, 
    ((avg_num_votes * avg_rating) + (this_num_votes * this_rating)) / (avg_num_votes + this_num_votes) as real_rating 
FROM 
(SELECT
    name,
    (SELECT count(name) FROM MangaMyanimelist_Mangas) / (SELECT count(DISTINCT name) FROM MangaMyanimelist_Mangas) AS avg_num_votes,
    (SELECT avg(score) FROM MangaMyanimelist_Mangas) AS avg_rating,
    count(name) as this_num_votes,
    avg(score) as this_rating
FROM MangaMyanimelist_Mangas
GROUP BY name) as baka
where name = "'. $search . '"';



$resultBaka = $conn->query($sqlBaka);
$resultMy = $conn->query($sqlMy);
$resultBakaBayer = $conn->query($sqlBakaBayer);
$resultMyBayer = $conn->query($sqlMyBayer);

$Q1 = array();
$Q1Votes = array();
$Q2 = array();
$Q2Votes = array();

foreach ($resultBakaBayer as $row)
{
	$BakaBayer = $row['real_rating']; 
}

foreach ($resultMyBayer as $row)
{
	$MyBayer = $row['real_rating']; 
}

foreach ($resultBaka as $row)
{
	array_push($Q1Votes, $row['votes1']);
	array_push($Q1Votes, $row['votes2']);
	array_push($Q1Votes, $row['votes3']);
	array_push($Q1Votes, $row['votes4']);
	array_push($Q1Votes, $row['votes5']);
	array_push($Q1Votes, $row['votes6']);
	array_push($Q1Votes, $row['votes7']);
	array_push($Q1Votes, $row['votes8']);
	array_push($Q1Votes, $row['votes9']);
	array_push($Q1Votes, $row['votes10']);

	
	array_push($Q1, $row['percent1']);
	array_push($Q1, $row['percent2']);
	array_push($Q1, $row['percent3']);
	array_push($Q1, $row['percent4']);
	array_push($Q1, $row['percent5']);
	array_push($Q1, $row['percent6']);
	array_push($Q1, $row['percent7']);
	array_push($Q1, $row['percent8']);
	array_push($Q1, $row['percent9']);
	array_push($Q1, $row['percent10']);
	
}

foreach ($resultMy as $row)
{
	array_push($Q2Votes, $row['votes1']);
	array_push($Q2Votes, $row['votes2']);
	array_push($Q2Votes, $row['votes3']);
	array_push($Q2Votes, $row['votes4']);
	array_push($Q2Votes, $row['votes5']);
	array_push($Q2Votes, $row['votes6']);
	array_push($Q2Votes, $row['votes7']);
	array_push($Q2Votes, $row['votes8']);
	array_push($Q2Votes, $row['votes9']);
	array_push($Q2Votes, $row['votes10']);

	
	array_push($Q2, $row['percent1']);
	array_push($Q2, $row['percent2']);
	array_push($Q2, $row['percent3']);
	array_push($Q2, $row['percent4']);
	array_push($Q2, $row['percent5']);
	array_push($Q2, $row['percent6']);
	array_push($Q2, $row['percent7']);
	array_push($Q2, $row['percent8']);
	array_push($Q2, $row['percent9']);
	array_push($Q2, $row['percent10']);
	
}

// $Q1=[7, 1, 1, 2, 4, 6, 13, 20,  17, 29];
// $Q1Votes=[323, 34, 64, 95, 201, 286, 627, 970, 811, 1396];
// $Q2=[0.3, 0.3, 0.6, 1.4, 3.7, 7.3, 16.9, 23.3,  23.1, 23.2];
// $Q2Votes=[403,372,714,1571,4230,8428,19537,26955,26777,26852];

for ($i = 0; $i < 10; $i++){
	$children[] = array('Q1' => strval($Q1[$i]), 'Q1Votes' => strval($Q1Votes[$i]),  'Q2' =>strval($Q2[$i]), 'Q2Votes' => strval($Q2Votes[$i]), 'BakaBaye' => strval($BakaBayer), 'MyBaye' => strval($MyBayer));
}

// $children[] = array('BakaBaye' => $BakaBayer);

header('Content-Type: application/json');
echo json_encode($children);

?>