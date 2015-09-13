<?php

session_start();
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}


if (array_key_exists("infos", $_REQUEST)){  

	if(isset($_REQUEST['infos'])){
		$search = $_REQUEST['infos'];
		// echo $search;
		if($search == "")
		{
			Redirect('./visualizer.php', false);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="search2.css">
<link rel="stylesheet" type="text/css" href="manga.css">
<script  src="getImgId.js"></script>
<script  src="jquery.js"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<span class="icon icon-globe"></span>
			<h1><a href="./visualizer.php">Plushiness</a></h1>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></span>
		</div>
		<div id="triangle-up"></div>
	</div>
</div>
<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="./visualizer.php" accesskey="1" title="">Home</a></li>
				<li><a href="#" accesskey="2" title="">Databases</a></li>
				<li><a href="./people.php" accesskey="3" title="">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="">Titles</a></li>
				<li><a href="./about.php" accesskey="5" title="">About</a></li>
				<li accesskey="6" title="">
					<div class="container-2">
						<form name="form1" action="searchPeople.php"  >
							<input name="infos" type="search" id="search" placeholder="Search People"/>
							<input type="submit" style="visibility: hidden; position: absolute;"/>
						</form>
					</div>
				</li>
			</ul>
		</div>
</div>

<div id="wrapper">

	<div id="featured-wrapper">
	
		<div id="mangalist" class="container">
			<form action="peopleInfo.php" >
				<input name="personName" id="toTitle" style="visibility: hidden; position: absolute;"/>
				<input id="idButton" type="submit" style="visibility: hidden; position: absolute;"/>
			</form>
			<ul class="list">
				<script language="php">
					
					include "con.php";

					$sql = 'SELECT person, img FROM bakaUpdates_People WHERE person  LIKE  "%'. $search . '%"';
					// $sql = 'SELECT name, img FROM MangaFox_Mangas WHERE name  LIKE  "%naruto%"';
					$result = $conn->query($sql);

					if (count($result) > 0){
						foreach ($result as $row){

							print "<li>";
							print '<a class="manga_img">';
							print '<div style="float:left; overflow:hidden">';
							$name = $row ["person"];

							$name = strtr ($name, array ('"' => '¬'));	
							if($row["img"] != null){
								print '<img id="'. $name . '" src="data:image/jpeg;base64,' . base64_encode($row["img"]) . '"  onclick="handleClick(this);" >';
							}
							else{
								print '<img id ="' .$name . '" src="http://www.grammarly.com/blog/wp-content/uploads/2015/01/Silhouette-question-mark.jpeg" onclick="handleClick(this);" >';
							}
							print '</div>';
							print '</a>';

							print '<div class="manga_text" id="'. $name .'" onclick="handleClick(this);">';
							print '<a class="title" >';
							print $row ["person"]; 
							print "</a>";
							print "</div>";
							print '</li>';
						}

					}
					//closing connection		
					$conn = null;
				</script>
			</ul>
			
		</div>

	
	
		</div>	

	</div>
</div>
<div id="stamp" class="container">
	<div class="hexagon"><span class="icon icon-wrench"></span></div>
</div>
<!-- <div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
 -->
</body>
</html>
