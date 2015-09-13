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


if (array_key_exists("personName", $_REQUEST)){  

	if(isset($_REQUEST['personName'])){
		$search = $_REQUEST['personName'];
		
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
				<li class="current_page_item"><a href="./visualizer.php" accesskey="1" title="">Home</a></li>
				<li><a href="#" accesskey="2" title="">Databases</a></li>
				<li><a href="./people.php" accesskey="3" title="">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="">Title</a></li>
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

					$nameB = $search;

					$sqlBaka = 'SELECT person, info, img FROM bakaUpdates_People WHERE person  = "'. $search . '"';
					$resultB = $conn->query($sqlBaka);
					// echo count($resultB);

					foreach ($resultB as $row)
					{
						$nameB = $row['person'];
						$infoB = $row['info'];
						$imgB = $row['img'];
					}

					// 	// echo $pos;
					// if(! ($pos > -1)){
						// print "<li>";
					print '<h1 style="font-size:28px" >';
					print  strtoupper($nameB); 
					print "</h1>";

					print '<tr>';
						print '<td rowspan="4">';
							print '<div id="left">';
							if ($imgB == null){
								// $img = "http://weblogs.pbspaces.com/stingrays/files/2011/10/silhouette-question-mark.jpg";
								print '<img src="http://www.grammarly.com/blog/wp-content/uploads/2015/01/Silhouette-question-mark.jpeg" width="200" style=" padding:1px; border:2px solid #021a40;" >';
							}
							else{
								print '<img src="data:image/jpeg;base64,' .  base64_encode($imgB) . '" width="200" style=" padding:1px; border:2px solid #021a40;" >';

							}
							print '</div>';
						print '</td>';
					print '</tr>';

					print '<tr>';
						print '<td  style="width: 50px;">';
						print '</td>';
						print '<td style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
							print "Information:";
						print '</td>';
					print '</tr>';

					print '<tr>';
						print '<td  style="width: 50px;">';
						print '</td>';
						print '<td>';
							print '<div id="right" >';
							print '<p charset = "ISO-8859-1" style="text-align:left;font-size:15px;line-height:26px;">';
							if($infoB != "N/A")
								print $infoB;
							else{
								print "Sorry, there is no information here";
							}
							print "</p>";
							print "</div>";
						print '</td>';
					// print '</li>';
					print '</tr>';

					// print '<tr>';
					// 	print '<td  style="width: 100px;">';
					// 	print '</td>';
					// 	print '<td>';
					// 		print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
					// 			print "Author:";
					// 		print '</span>';
					// 		print '<a href="./author.php">';
					// 			print '<span  style="padding-left: 25px">';
					// 			print $authorB;
					// 			print '</span>';
					// 		print '</a>';

					// 	print '</td>';
					// // print '</li>';
					// print '</tr>';
					// }
							
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
