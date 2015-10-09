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

	for($i = 1; $i <= $row['votes1']; $i++)
		array_push($Q1Votes, 1);
	for($i = $row['votes1']+1; $i <= $row['votes2']; $i++ )
		array_push($Q1Votes, 2);
	for($i=$row['votes2']+1; $i <= $row['votes3']; $i++ )
		array_push($Q1Votes, 3);
	for($i=$row['votes3']+1; $i <= $row['votes4']; $i++ )
		array_push($Q1Votes, 4);
	for($i=$row['votes4']+1; $i <= $row['votes5']; $i++ )
		array_push($Q1Votes, 5);
	for($i=$row['votes5']+1; $i <= $row['votes6']; $i++ )
		array_push($Q1Votes, 6);
	for($i=$row['votes6']+1; $i <= $row['votes7']; $i++ )
		array_push($Q1Votes, 7);
	for($i=$row['votes7']+1; $i <= $row['votes8']; $i++ )
		array_push($Q1Votes, 8);
	for($i=$row['votes8']+1; $i <= $row['votes9']; $i++ )
		array_push($Q1Votes, 9);
	for($i=$row['votes9']+1; $i <= $row['votes10']; $i++ )
		array_push($Q1Votes, 10);
	
}

foreach ($resultMy as $row)
{
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

	for($i = 1; $i <= $row['votes1']; $i++)
		array_push($Q2Votes, 1);
	for($i = $row['votes1']+1; $i <= $row['votes2']; $i++ )
		array_push($Q2Votes, 2);
	for($i=$row['votes2']+1; $i <= $row['votes3']; $i++ )
		array_push($Q2Votes, 3);
	for($i=$row['votes3']+1; $i <= $row['votes4']; $i++ )
		array_push($Q2Votes, 4);
	for($i=$row['votes4']+1; $i <= $row['votes5']; $i++ )
		array_push($Q2Votes, 5);
	for($i=$row['votes5']+1; $i <= $row['votes6']; $i++ )
		array_push($Q2Votes, 6);
	for($i=$row['votes6']+1; $i <= $row['votes7']; $i++ )
		array_push($Q2Votes, 7);
	for($i=$row['votes7']+1; $i <= $row['votes8']; $i++ )
		array_push($Q2Votes, 8);
	for($i=$row['votes8']+1; $i <= $row['votes9']; $i++ )
		array_push($Q2Votes, 9);
	for($i=$row['votes9']+1; $i <= $row['votes10']; $i++ )
		array_push($Q2Votes, 10);
	
}


$wmean = 0;
$sum = 0;
for ($i = 0; $i < sizeof($Q1); $i++){
	$wmean += ($i+1)*strval($Q1[$i]);
	$sum += strval($Q1[$i]);
}
if ($wmean != 0)
	$wmeanQ1 = $wmean/$sum;

$wmean = 0;
$sum = 0;
for ($i = 0; $i < sizeof($Q2); $i++){
	$wmean += ($i+1)*strval($Q2[$i]);

	$sum += strval($Q2[$i]);
}
if ($wmean != 0)
	$wmeanQ2 = $wmean/$sum;

for ($i = 0; $i < sizeof($Q2Votes); $i++){
	$children[] = array('Q1' => strval($Q2Votes[$i]), 'BakaBaye' => strval($MyBayer), 'BakaAvg' => $wmeanQ2 );
}

if( sizeof($Q2Votes) == 0)
	$children[] = array('Q1' => 0, 'BakaBaye' => strval($MyBayer), 'BakaAvg' => $wmeanQ2 );

// $children[] = array('BakaBaye' => $BakaBayer);

header('Content-Type: application/json');
echo json_encode($children);

?>