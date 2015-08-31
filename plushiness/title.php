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


if (array_key_exists("mangaName", $_REQUEST)){  

	if(isset($_REQUEST['mangaName'])){
		$search = $_REQUEST['mangaName'];
		
		if($search == "")
		{
			Redirect('./visualizer.php', false);
		}
		$search = strtr ($search, array ('¬' => '"'));
	}
}
?>


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
				<li class="current_page_item"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="#" accesskey="2" title="">Our Clients</a></li>
				<li><a href="#" accesskey="3" title="">About Us</a></li>
				<li><a href="#" accesskey="4" title="">Careers</a></li>
				<li><a href="#" accesskey="5" title="">Contact Us</a></li>
				<li accesskey="6" title="">
					<div class="container-2">
						<form name="form1" action="search.php"  >
							<input name="infos" type="search" id="search" placeholder="Search..."/>
							<input type="submit" style="visibility: hidden; position: absolute;"/>
						</form>
					</div>
				</li>
			</ul>
		</div>
</div>

<div id="wrapper">

	<div id="featured-wrapper">
		<div id="container">
		<table style="width:80%; margin-left:40px; margin-top:50px; ">
		<script language="php">
					require "func.php";
					include "con.php";
					// echo $search;
					
					$positions = array();
					$pos = -1;
					while (($pos = strpos($search, '"', $pos+1)) !== false) {
					    $positions[] = $pos;
					}

					if(count($positions > 0)){
						// $result = implode(', ', $positions);
						// print_r($positions);
						for ($i = count($positions)-1; $i >=0; $i-- )
						{

							$search = stringInsert($search,$positions[$i],'\\');
							// echo $name;
						}
					}

					$sql = 'SELECT name, info FROM MangaMyanimelist_Mangas WHERE name  = "'. $search . '"';
					// echo ($sql);
					$temAlgo = false;
					$result = $conn->query($sql);
					if (count($result) > 0){

						foreach ($result as $row){
							

							$pos = strripos($row ["info"], "no background information has been added to this title");
							// echo $pos;
							if(! ($pos > -1)){
								// print "<li>";

								print '<div class="manga_text" >';
								print '<a class="title" >';
								print $row ["name"]; 
								print "</a>";
								print '<p style="text-align:left;font-size:15px;line-height:26px;">';
								print $row ["info"];
								print "</p>";
								print "</div>";
								// print '</li>';
								$temAlgo = true;
							}
							else{
								$temAlgo = false;
								break;
							}
						}
						if($temAlgo == false)
						{
							$sql = 'SELECT name, info, img, author, artist FROM MangaFox_Mangas WHERE name  = "'. $search . '"';
							$result = $conn->query($sql);

							foreach ($result as $row){

								print '<h1 style="font-size:28px" >';
								print  strtoupper($row ["name"]); 
								print "</h1>";

								print '<tr>';
									print '<td rowspan="4">';
										print '<div id="left">';
										print '<img src="' . $row["img"] . ' width="200" style=" padding:1px; border:2px solid #021a40;" >';
										print '</div>';
									print '</td>';
								print '</tr>';

								print '<tr>';
									print '<td  style="width: 50px;">';
									print '</td>';
									print '<td style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
										print "Summary:";
									print '</td>';
								print '</tr>';

								print '<tr>';
									print '<td  style="width: 50px;">';
									print '</td>';
									print '<td>';
										print '<div id="right" >';
										print '<p style="text-align:left;font-size:15px;line-height:26px;">';
										if(!empty($row["info"]))
											print $row ["info"];
										else 
											print "Sorry, there is no information here";
										print "</p>";
										print "</div>";
									print '</td>';
								// print '</li>';
								print '</tr>';

								print '<tr>';
									print '<td  style="width: 100px;">';
									print '</td>';
									print '<td>';
										print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
											print "Author:";
										print '</span>';
										print '<a href="./author.php">';
											print '<span  style="padding-left: 25px">';
											print $row['author'];
											print '</span>';
										print '</a>';

									print '</td>';
								// print '</li>';
								print '</tr>';
							}
						}


					}

					//closing connection		
					$conn = null;
		</script>
		</table>
		
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
