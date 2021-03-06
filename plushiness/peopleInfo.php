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
<script src="http://www.d3plus.org/js/d3.js"></script>
<script src="http://www.d3plus.org/js/d3plus.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script  src="jquery.js"></script>
<link href="https://nvd3-community.github.io/nvd3/build/nv.d3.min.css" rel="stylesheet">
<script src="https://nvd3-community.github.io/nvd3/build/nv.d3.js"></script>
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
<link rel="stylesheet" type="text/css" href="menu.css">
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<link href="box.css" rel="stylesheet" type="text/css" />
<script src="box2.js"></script>
<script src="generateBox.js"></script>



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
				<li><a href="./people.php" accesskey="3" title="" style="color: #ff9000;">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="">Title</a></li>
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
							print '<p charset = "ISO-8859-1" style="text-align:justify;font-size:15px;line-height:26px;">';
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

		<div id="graphMenu" align="middle" style="margin-top:80px">
			<br><br>
			<ul class="flatflipbuttons">
				<li class='graphChart1'><a><span><img src="./icons/mind-map-32.png" /></span></a> <b>Social Network</b></li>
				<li class='barChart'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>Rank of titles</b></li>
				<li class='boxPlot'><a><span><img src="./icons/candle-stick-5-32.png" /></span></a><b>Grades average</b></li>

			</ul>
		</div>

		<div id="container" class="div2">

			<table style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid grey; border-collapse: collapse;">
				<tr >
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

		<div id="container" class="div5" >

			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid grey; border-collapse: collapse;">
				<tr style="margin-bottom:100px;"> 
					<td >
						<h1 align="center" style="font-size:20px">Rank of artist's titles </h1>
					</td>
				</tr>

				<tr>
					<td  style="width: 50%; height:90%;">
						
						<svg id="rank" >	
						</svg>
					</td>
				</tr>
			</table>
				
		</div>

		<div id="container" class="div6" >

			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid grey; border-collapse: collapse;">
				<tr style="margin-bottom:100px; height:2px"> 
					<td >
						<h1 align="center" style="font-size:20px;">Grades average</h1>
					</td>
				</tr>
				<tr>
					<td  style="width: 50%; height:90%;">
						
						<div align="center" class="boxPlotRank" >	
						</div>
					</td>
				</tr>
			</table>
				
		</div>

		<script type="text/javascript">
			var graph1 = false;
			var graph2 = false;
			var graph3 = false;

			// $('.div2').hide();
			$('.div6').hide();
			var c = 0;
			var intervalId = setInterval(function() {
				if (++c === 3) {

					$('.div2').hide();
					$('.div5').hide();

				    window.clearInterval(intervalId);
				}
				if($("path.d3plus_data").length){
		    		d3.selectAll('.nv-bar')
						.style("fill", $("path.d3plus_data", $('.div3')).attr("fill"));
				}
				else{
					d3.selectAll('.nv-bar')
						.style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));

				}
			}, 100);

			$('li.graphChart1')
				.on('click', function(d){

				if (!graph1){
					$('.div2').show();
					graph1 = true;
				}
				else
				{
					$('.div2').hide();
					graph1 = false;
				}
			});

			$('li.barChart')
				.on('click', function(d){

				if (!graph2){
					$('.div5').show();
					graph2 = true;
				}
				else
				{
					$('.div5').hide();
					graph2 = false;
				}
			});

			$('li.boxPlot')
				.on('click', function(d){

				if (!graph3){
					$('.div6').show();
					graph3 = true;
				}
				else
				{
					$('.div6').hide();
					graph3 = false;
				}
			});
		</script>

		<script>

		var counts = 0;
		var intervalId = setInterval(function() {

			if (++counts === 10) {
		       window.clearInterval(intervalId);
		    }
		    if($("path.d3plus_data").length){
		    	d3.selectAll('.nv-bar')
					.style("fill", $("path.d3plus_data", $('.div3')).attr("fill"));

			}
			else{
				d3.selectAll('.nv-bar')
					.style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));

			}
	    }, 100);


		// var color = d3.scale.category10().range();
		var color = d3plus.color.scale.range();

		if($('h1.personName').text() != "UNKNOWN"){
			d3.json("firstTitleRing.php", function(error, root){
				if (root == null){
					$('.div2').remove();
					$('.div5').remove();
					return;
				}

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
				.draw();
				
			});

			d3.json("ringPeople.php", function(error, root){
				// console.log(root);
				if(root == null){
					$('.div2').remove();
					$('.div5').remove();
					return;
				}
				var connections = root;
				var value = $('h1.personName').text().toLowerCase();
				// root[0].source;
				// console.log(connections.length);

				if(connections.length == 1 && root[0].source == root[0].target)
				{
					  var data = [
					    {"value": 100, "name": root[0].source}
					  ];

					  var attributes = [
					    {"name": root[0].source, "colors": color[0]},
					  ]
					  var pie = d3plus.viz()
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
					    // .attrs(attributes)
					    // .color("colors")
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
						var count = 0;
						var intervalId = setInterval(function() {

							if (++count === 10) {
						       window.clearInterval(intervalId);
						    }
							d3.selectAll('.nv-bar')
								.style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));
							// d3.select('.nv-bar').selectAll('g.nv-series').remove();
							// d3.selectAll('circle.nv-legend-symbol')
							// 	.style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));
							// d3.selectAll('circle.nv-legend-symbol')
							// 	.style("stroke", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));
						    }, 100);
						
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
									.draw();
				            }
				        });

				        $.ajax({
				            type: "POST",
				            url: 'getRankTitlePerAuthor.php',
				            data: {'valueAuthorBar' : value},

				            success: function(datas){
				            	// console.log(datas);
				            	nv.addGraph(function() {
									var chart = nv.models.multiBarHorizontalChart()
										.x(function(d) { return d.label })
										.y(function(d) { return d.value })
										.margin({top: 30, right: 10, bottom: 50, left: 295})						// .width(600)
										// .height(500)
										//.showValues(true)           //Show bar value next to each bar.
										// .tooltips(true)             //Show tooltips on hover.
										// .transitionDuration(350)
										.forceY([0,10])
										.showLegend(false)
										.showControls(false);        //Allow user to switch between "Grouped" and "Stacked" mode.
										

									chart.tooltip.enabled(true);

									var thickMark = [0,1,2,3,4,5,6,7,8,9,10];
									chart.yAxis
										.tickValues(thickMark)
										.tickFormat(function(d){  return d; });

									  // chart.xAxis
								   //    .tickFormat(function(d){ return d/100 });
								   chart.groupSpacing(0.3);

									d3.select('#rank ')
										.datum(datas)
										.transition()
										.duration(350)
										.call(chart);
					// 				var color = d3.scale().category20().range();
									// d3.selectAll('.nv-bar')
										// .style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));
									// console.log(previousColor);

									nv.utils.windowResize(chart.update);

									return chart;
								});
								
				            }
				        });

						$.ajax({
					            type: "POST",
					            url: 'lastBoxPlotPeople.php',
					            data: {'valueAuthorBar' : value},

					            success: function(dataCsv){
					            	console.log(dataCsv);
									graph = d3.select("div.boxPlotRank");
									graph.select("svg").remove();

									string = String(value);
									value = string.charAt(0).toUpperCase() + string.slice(1);


									generateBox(".boxPlotRank", value, dataCsv);
								}
						});



				       
					})
					.draw()
				}
			});

			d3.json('firstGetRankTitlePerAuthor.php', function(data) {
				if(data == null){
					$('.div2').remove();
					$('.div5').remove();
					return;
				}
				// console.log(data);
				nv.addGraph(function() {
					var chart = nv.models.multiBarHorizontalChart()
						.x(function(d) { return d.label })
						.y(function(d) { return d.value })
						.margin({top: 30, right: 10, bottom: 50, left: 295})						// .width(600)
						// .height(500)
						//.showValues(true)           //Show bar value next to each bar.
						// .tooltips(true)             //Show tooltips on hover.
						// .transitionDuration(350)
						.forceY([0,10])
						.showLegend(false)
						// .color(d3.scale.category20().range([0,10]))
						.showControls(false);        //Allow user to switch between "Grouped" and "Stacked" mode.
						

					chart.tooltip.enabled(true);

					var thickMark = [0,1,2,3,4,5,6,7,8,9,10];
					chart.yAxis
						.tickValues(thickMark)
						.tickFormat(function(d){ /*console.log(d);*/ return d; });

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

			

			
		}
		else{
			$('.div2').remove();
			$('.div5').remove();

		}
		</script>

		<script>
			var value =  $('h1.personName').text().toLowerCase();

			d3.json("firstBoxPlotPeople.php", function(dataCsv){

					graph = d3.select("div.boxPlotRank");
					graph.select("svg").remove();
					string = value;
					value = string.charAt(0).toUpperCase() + string.slice(1);
					generateBox(".boxPlotRank", value, dataCsv);
			});
		</script>






	</div>
</div>
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
