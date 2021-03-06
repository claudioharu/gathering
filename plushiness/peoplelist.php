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

$search = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<style>
@font-face {
      font-family: 'fontello';
      src: url('./font/fontello.eot?93932919');
      src: url('./font/fontello.eot?93932919#iefix') format('embedded-opentype'),
           url('./font/fontello.woff?93932919') format('woff'),
           url('./font/fontello.ttf?93932919') format('truetype'),
           url('./font/fontello.svg?93932919#fontello') format('svg');
      font-weight: normal;
      font-style: normal;
    }
     
     
    .demo-icon
    {
      font-family: "fontello";
      font-style: normal;
      font-weight: normal;
      speak: none;
     
      display: inline-block;
      text-decoration: inherit;
      width: 1em;
      margin-right: .2em;
      text-align: center;
      /* opacity: .8; */
     
      /* For safety - reset parent styles, that can break glyph codes*/
      font-variant: normal;
      text-transform: none;
     
      /* fix buttons height, for twitter bootstrap */
      line-height: 1em;
     
      /* Animation center compensation - margins should be symmetric */
      /* remove if not needed */
      margin-left: .2em;
     
      /* You can be more comfortable with increased icons size */
      /* font-size: 120%; */
     
      /* Font smoothing. That was taken from TWBS */
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
     
      /* Uncomment for 3D effect */
      /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
    }
     </style>

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
<link rel="stylesheet" href="css/animation.css">

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<i class="demo-icon icon-cartoons1" style="font-size:100px; color:black">&#xe800;</i> 
			<h1><a href="./visualizer.php">MangaVis</a></h1>
		</div>
		<div id="triangle-up"></div>
	</div>
</div>
<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="./visualizer.php" accesskey="1" title="">Home</a></li>
				<li><a href="./database.php" accesskey="2" title="">Databases</a></li>
				<li><a href="./people.php" accesskey="3" title="" style="color: #ff9000;">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="">Titles</a></li>
				<li><a href="./sitemap.php" accesskey="5" title="">Sitemap</a></li>
				<li><a href="./about.php" accesskey="6" title="">About</a></li>
				<li accesskey="7" title="">
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

					// $sql = 'SELECT person, img FROM bakaUpdates_People WHERE person  LIKE  "%'. $search . '%"';
					// $sql = 'SELECT name, img FROM MangaFox_Mangas WHERE name  LIKE  "%naruto%"';
					$sql = 'select Distinct(name) from( 
select author as name
from MangaFox_Mangas
UNION all
select artist as name
from MangaFox_Mangas
UNION all
select artist as name
from MangaHere_Mangas
UNION all
select author as name
from MangaHere_Mangas
) as b
order by name';

					$result = $conn->query($sql);
					$i = 0;
					if (count($result) > 0){
						foreach ($result as $row){
							if($i > 32 && $i < 8365){
								print "<li>";
								$name = $row ["name"];
								$name = strtr ($name, array ('"' => '¬'));	

								print '<div class="manga_text" id="'. $name .'" onclick="handleClick(this);">';
								print '<a class="title " style="cursor: pointer;">';
								print $row ["name"]; 
								print "</a>";
								print "</div>";
								print '</li>';
							}
							$i++;
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
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
