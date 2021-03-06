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
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<i class="demo-icon icon-cartoons1" style="font-size:100px; color:black">&#xe800;</i> 
			<h1><a href="./visualizer.php">MangaVis</a></h1>
			<!-- <span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></span> -->
		</div>
		<div id="triangle-up"></div>
	</div>
</div>
<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="./visualizer.php" accesskey="1" title="">Home</a></li>
				<li><a href="./database.php" accesskey="2" title="">Databases</a></li>
				<li><a href="./people.php" accesskey="3" title="">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="" style="color: #ff9000;">Titles</a></li>
				<li><a href="./sitemap.php" accesskey="5" title="">Sitemap</a></li>
				<li><a href="./about.php" accesskey="6" title="">About</a></li>
				<li accesskey="7" title="">
					<div class="container-2">
						<form name="form1" action="searchMangas.php"  >
							<input name="infos" type="search" id="search" placeholder="Search Title"/>
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
			<form action="title.php" >
				<input name="mangaName" id="toTitle" style="visibility: hidden; position: absolute;"/>
				<input id="idButton" type="submit" style="visibility: hidden; position: absolute;"/>
			</form>
			<ul class="list">
				<script language="php">
					
					include "con.php";

					// $sql = 'SELECT name, img FROM MangaFox_Mangas WHERE name  LIKE  "%'. $search . '%"';
					$sql = 'select * from (select name, img from MangaFox_Mangas UNION all select name, img from MangaHere_Mangas) as X where name LIKE "%'. $search . '%" group by name';
					$result = $conn->query($sql);

					if ($result->rowCount() > 0){
						// $count = ;
						// echo $count;

						foreach ($result as $row){
							print "<li>";
							print '<a class="manga_img">';
							print '<div style="float:left; overflow:hidden">';
							$name = $row ["name"];

							$name = strtr ($name, array ('"' => '¬'));	
							$img = $row["img"];
							$img[7] = "c";

							print '<img id="'. $name . '" src="' . $img . '" width="100" onclick="handleClick(this);" >';
							print '</div>';
							print '</a>';

							print '<div class="manga_text" id="'. $name .'" onclick="handleClick(this);">';
							print '<a class="title" style="cursor: pointer;">';
							print $row ["name"]; 
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

	
	<!-- 
		<div class="extra2 container">
			<div class="ebox1">
				<div class="hexagon"><span class="icon icon-lightbulb"></span></div>
				<div class="title">
					<h2>Fusce ultrices fringilla</h2>
					<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
				</div>
				<p>This is <strong>Plushiness</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
				<a href="#" class="button">Etiam posuere</a>
			</div>		

			<div class="ebox2">
				<div class="hexagon"><span class="icon icon-bullhorn"></span></div>
				<div class="title">
					<h2>Donec dictum metus</h2>
					<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
				</div>
				<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat. Pellentesque tristique ante ut risus. Quisque dictum. Integer nisl risus, sagittis convallis, rutrum id, elementum congue, nibh. Suspendisse dictum porta lectus. Donec placerat odio vel elit. Nullam ante orci, pellentesque eget, tempus quis, ultrices in, est. Curabitur sit amet nulla. Nam in massa. Sed vel tellus. Curabitur sem urna, consequat vel, suscipit in, mattis placerat, nulla. Sed ac leo. Pellentesque imperdiet.</p>
				<a href="#" class="button">Etiam posuere</a>
			</div>	 -->	

		</div>	

	</div>
</div>
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
