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
		$_SESSION['ringValue'] = $search;
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
<script src="http://www.d3plus.org/js/d3.js"></script>
<script src="http://www.d3plus.org/js/d3plus.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script  src="jquery.js"></script>
<link href="https://nvd3-community.github.io/nvd3/build/nv.d3.min.css" rel="stylesheet">
<script src="https://nvd3-community.github.io/nvd3/build/nv.d3.js"></script>



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
		<div id="container" class="div1">
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

					$sqlBaka = 'SELECT person, info, img, birthPlace, birthDate, website, facebook, twitter FROM bakaUpdates_People WHERE person  = "'. $search . '"';
					$resultB = $conn->query($sqlBaka);
					// echo count($resultB);

					foreach ($resultB as $row)
					{
						$nameB = $row['person'];
						$infoB = $row['info'];
						$imgB = $row['img'];
						$birthPlace = $row['birthPlace'];
						$birthDate = $row['birthDate'];
						$website = $row['website'];
						$facebook = $row['facebook'];
						$twitter = $row['twitter'];
					}

					print '<h1 style="font-size:28px" class = "personName" >';
					print  strtoupper($nameB); 
					print "</h1>";

					print '<tr>';
						print '<td rowspan="5">';
							print '<div id="left">';
							if ($imgB == null){
								print '<img src="http://www.grammarly.com/blog/wp-content/uploads/2015/01/Silhouette-question-mark.jpeg" width="200" height="100" style=" padding:1px; border:2px solid #021a40;" >';
							}
							else{
								print '<img src="data:image/jpeg;base64,' .  base64_encode($imgB) . '" width="200" height="250" style=" padding:1px; border:2px solid #021a40;" >';

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
					print '</tr>';

					print '<tr>';
						print '<td  style="width: 50px;">';
						print '</td>';
						print '<td>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
								print "Birth Place:";
							print '</span>';
							print '<span style="padding-left: 20px">';
								print $birthPlace;
							print '</span>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic; padding-left: 20px;">';
								print "Birth Date:";
							print '</span>';
							print '<span style="padding-left: 20px">';
								print $birthDate;
							print '</span>';
						print '</td>';
					print '</tr>';

					print '<tr>';
						print '<td  style="width: 50px;">';
						print '</td>';
						print '<td>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
								print "WebSite:";
							print '</span>';
							print '<span style="padding-left: 20px">';
								print $website;
							print '</span>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic; padding-left: 20px;">';
								print "Twitter:";
							print '</span>';
							print '<span style="padding-left: 20px">';
								print $twitter;
							print '</span>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic; padding-left: 20px;">';
								print "Facebook:";
							print '</span>';
							print '<span style="padding-left: 20px">';
								print $facebook;
							print '</span>';
						print '</td>';
					print '</tr>';

					$conn = null;
		</script>
		</table>
		</div>

		<div id="container" class="div2">

			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<tr>
					<td>
						<h1 align="center" style="font-size:20px">Network of relationships between authors and artists </h1>
					</td>
					<td>
						<h1 align="center" style="font-size:20px">Network of relationships between authors and titles </h1>
					</td>
				</tr>

				<tr>
					<td  style="width: 50%; height:90%;">
						<div id="container" class="div3" >	
						</div>
					</td>
					<td style="width: 50%; height:90%;">
						<div id="container" class="div4">
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div id="container" class="div5">

			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<tr style="margin-bottom:100px;"> 
					<td >
						<h1 align="center" style="font-size:20px">Network of relationships between authors and artists </h1>
					</td>
				</tr>
			<!-- 	<tr sytle="height: 200px">
				<tr/> -->


				<tr>
					<td  style="width: 50%; height:90%;">
						
						<svg id="rank" >	
						</svg>
					</td>
				</tr>
			</table>
				
		</div>

		<script>

			d3.json("firstTitleRing.php", function(error, root){
				// console.log(root);
				var connections = root;
				var value = root[0].source;
				// console.log(root[0].source);
				var visualization = d3plus.viz()
				.container(".div4")
				.type("rings")
				.edges(connections)
				.focus({
					"tooltip" : false,
					"value" : value
				})
				.draw()
			});

			d3.json("ringPeople.php", function(error, root){

				var connections = root;
				var value = $('h1.personName').text().toLowerCase();
				// root[0].source;
				console.log(connections.length);

				if(connections.length == 1 && root[0].source == root[0].target)
				{
					  var data = [
					    {"value": 100, "name": root[0].source}
					  ]
					  d3plus.viz()
					    .container(".div3")
					    .data(data)
					    .type("pie")
					    .id("name")
					    .size("value")
					    .timing(10)
					    .tooltip({
					      "value" : false
					    })
					    .height(180)
					    .draw();
				}
				else{
					var visualization = d3plus.viz()
					.container(".div3")
					.type("rings")
					.edges(connections)
					.focus({
						"tooltip" : false,
						"value" : value
					}, function(value){
						
						$.ajax({
				            type: "POST",
				            url: 'ringTitles.php',
				            data: {'value' : value},

				            success: function(data){

								var connectionsM = data;
								var valueM = data[0].source;


								var visualization2 = d3plus.viz()
									.container(".div4")
									.type("rings")
									.edges(connectionsM)
									.focus({
										"tooltip" : false,
										"value" : valueM
									})
									.draw()
				            }
				        });

				        $.ajax({
				            type: "POST",
				            url: 'getRankTitlePerAuthor.php',
				            data: {'valueAuthorBar' : value},

				            success: function(datas){
				            	console.log(datas);
				            	nv.addGraph(function() {
									var chart = nv.models.multiBarHorizontalChart()
										.x(function(d) { return d.label })
										.y(function(d) { return d.value })
										.margin({top: 30, right: 10, bottom: 50, left: 295})						// .width(600)
										// .height(500)
										.showValues(true)           //Show bar value next to each bar.
										// .tooltips(true)             //Show tooltips on hover.
										// .transitionDuration(350)
										.forceY([0,10])
										.showControls(false);        //Allow user to switch between "Grouped" and "Stacked" mode.
										

									chart.tooltip.enabled(true);

									var thickMark = [0,1,2,3,4,5,6,7,8,9,10];
									chart.yAxis
										.tickValues(thickMark)
										.tickFormat(function(d){ console.log(d); return d });

									  // chart.xAxis
								   //    .tickFormat(function(d){ return d/100 });
								   chart.groupSpacing(0.3);

									d3.select('#rank ')
										.datum(datas)
										.transition()
										.duration(350)
										.call(chart);

									nv.utils.windowResize(chart.update);

									return chart;
								});
								
				            }
				        });



				       
					})
					.draw()
				}
			});

			d3.json('firstGetRankTitlePerAuthor.php', function(data) {
				console.log(data);
				nv.addGraph(function() {
					var chart = nv.models.multiBarHorizontalChart()
						.x(function(d) { return d.label })
						.y(function(d) { return d.value })
						.margin({top: 30, right: 10, bottom: 50, left: 295})						// .width(600)
						// .height(500)
						.showValues(true)           //Show bar value next to each bar.
						// .tooltips(true)             //Show tooltips on hover.
						// .transitionDuration(350)
						.forceY([0,10])
						.showControls(false);        //Allow user to switch between "Grouped" and "Stacked" mode.
						

					chart.tooltip.enabled(true);

					var thickMark = [0,1,2,3,4,5,6,7,8,9,10];
					chart.yAxis
						.tickValues(thickMark)
						.tickFormat(function(d){ console.log(d); return d });

					  // chart.xAxis
				   //    .tickFormat(function(d){ return d/100 });
				   chart.groupSpacing(0.3);

					d3.select('#rank ')
						.datum(data)
						.transition()
						.duration(350)
						.call(chart);

					nv.utils.windowResize(chart.update);

					return chart;
				});
			});

			// (function(){

			//     var margin = {top: 50, bottom: 50, left:250, right: 40};
			//     var width = 900 - margin.left - margin.right;
			//     var height = 450 - margin.top - margin.bottom;

			//     var xScale = d3.scale.linear().range([0, width]);
			//     var yScale = d3.scale.ordinal().rangeRoundBands([0, height], 1.8,0);

			//     var numTicks = 5;
			//     var xAxis = d3.svg.axis().scale(xScale)
			//                     .orient("top")
			//                     .tickSize((-height))
			//                     .ticks(numTicks);

			//     var svg = d3.select(".rank").append("svg")
			//                 .attr("width", width+margin.left+margin.right)
			//                 .attr("height", height+margin.top+margin.bottom)
			//                 .attr("class", "base-svg");

			//     var barSvg = svg.append("g")
			//                 .attr("transform", "translate("+margin.left+","+margin.top+")")
			//                 .attr("class", "bar-svg");

			//     var x = barSvg.append("g")
			//             .attr("class", "x-axis");

			//     var url = "data.json";

			//     d3.json(url, function(data) {

			//         var xMax = d3.max(data, function(d) { return d.rate; } );
			//         var xMin = 0;
			//         xScale.domain([xMin, xMax]);
			//         yScale.domain(data.map(function(d) { return d.country; }));

			//         d3.select(".base-svg").append("text")
			//             .attr("x", margin.left)
			//             .attr("y", (margin.top)/2)
			//             .attr("text-anchor", "start")
			//             .text("Narrowly defined unemployment rates: top 20 countries (2010)")
			//             .attr("class", "title");

			//         var groups = barSvg.append("g").attr("class", "labels")
			//                     .selectAll("text")
			//                     .data(data)
			//                     .enter()
			//                     .append("g");

			//         groups.append("text")
			//                 .attr("x", "0")
			//                 .attr("y", function(d) { return yScale(d.country); })
			//                 .text(function(d) { return d.country; })
			//                 .attr("text-anchor", "end")
			//                 .attr("dy", ".9em")
			//                 .attr("dx", "-.32em")
			//                 .attr("id", function(d,i) { return "label"+i; });

			//         var bars = groups
			//                     .attr("class", "bars")
			//                     .append("rect")
			//                     .attr("width", function(d) { return xScale(d.rate); })
			//                     .attr("height", height/20)
			//                     .attr("x", xScale(xMin))
			//                     .attr("y", function(d) { return yScale(d.country); })
			//                     .attr("id", function(d,i) { return "bar"+i; });

			//         groups.append("text")
			//                 .attr("x", function(d) { return xScale(d.rate); })
			//                 .attr("y", function(d) { return yScale(d.country); })
			//                 .text(function(d) { return d.rate; })
			//                 .attr("text-anchor", "end")
			//                 .attr("dy", "1.2em")
			//                 .attr("dx", "-.32em")
			//                 .attr("id", "precise-value");

			//         bars
			//             .on("mouseover", function() {
			//                 var currentGroup = d3.select(this.parentNode);
			//                 currentGroup.select("rect").style("fill", "brown");
			//                 currentGroup.select("text").style("font-weight", "bold");
			//             })
			//             .on("mouseout", function() {
			//                 var currentGroup = d3.select(this.parentNode);
			//                 currentGroup.select("rect").style("fill", "steelblue");
			//                 currentGroup.select("text").style("font-weight", "normal");
			//             });

			//         x.call(xAxis);
			//         var grid = xScale.ticks(numTicks);
			//         barSvg.append("g").attr("class", "grid")
			//             .selectAll("line")
			//             .data(grid, function(d) { return d; })
			//             .enter().append("line")
			//                 .attr("y1", 0)
			//                 .attr("y2", height+margin.bottom)
			//                 .attr("x1", function(d) { return xScale(d); })
			//                 .attr("x2", function(d) { return xScale(d); })
			//                 .attr("stroke", "white");

			// 		    });

			// })();

		</script>
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
