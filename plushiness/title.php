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

		$_SESSION['boxInfos'] = $search;
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
<link href="box.css" rel="stylesheet" type="text/css" />
<script src="http://www.d3plus.org/js/d3.js"></script>
<script src="http://www.d3plus.org/js/d3plus.js"></script>
<script  src="jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script src="box.js"></script>
<script src="groupedBars.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
<link rel="stylesheet" type="text/css" href="menu.css">


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
				<li><a href="./mangas.php" accesskey="4" title="">Title</a></li>
				<li><a href="./about.php" accesskey="5" title="">About</a></li>
				<li accesskey="6" title="">
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

					// $sqlA = 'SELECT name, info FROM MangaMyanimelist_Mangas WHERE name  = "'. $search . '"';
					$sqlA = 'SELECT name, info, author, artist FROM  bakaUpdates_Stats WHERE name  = "'. $search . '"';

					// echo ($sql);
					$temAlgo = false;
					$resultA = $conn->query($sqlA);

					foreach ($resultA as $row)
					{
						$nameA = $row['name'];
						$infoA = $row['info'];
						$authorA = $row["author"];
						$artistA = $row["artist"];
					}

					// $sqlM = 'SELECT name, info, img, author, artist FROM MangaFox_Mangas WHERE name  = "'. $search . '"';
					$sqlM = 'select * from (select name, info, img, author, artist from MangaFox_Mangas UNION all select name, info, img, author, artist from MangaHere_Mangas) as X where name = "'. $search . '" group by name';

					$resultB = $conn->query($sqlM);
					// echo count($resultB);

					$sqlReleased = 'select released from MangaFox_Mangas where name = "'. $search . '"';
					$resultReleased = $conn->query($sqlReleased);

					foreach ($resultReleased as $row){
						$released = $row['released'];
					}

					foreach ($resultB as $row)
					{
						$nameB = $row['name'];
						$infoB = $row['info'];
						$imgB = $row['img'];
						$authorB = $row['author'];
						$artistB = $row['artist'];
					}


					print '<h1 style="font-size:28px" >';
					print  strtoupper($nameB); 
					print "</h1>";

					// $aux = substr($imgB, 8);
					 $imgB[7] = "c";
					// echo $aux;
					// $imgB = "c"
					print '<tr>';
						print '<td rowspan="5">';
							print '<div id="left">';
							print '<img src="' . $imgB . '" width="200" style=" padding:1px; border:2px solid #021a40;" >';
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
							if($infoA != "N/A" && !empty($infoA)){
								print $infoA;
							}
							else{
								if (!empty($infoB))
									print $infoB;
								else
									print "Sorry, there is no information here";
							}
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
								print "Released:";
							print '</span>';
							print '<span  style="padding-left: 15px">';
								if(!empty($released))
									print $released;
								else
									print 'N/A';	
							print '</span>';
						print '</td>';
					print '</tr>';

					print '<tr>';
						print '<td  style="width: 100px;">';
						print '</td>';
						print '<td>';
							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;">';
								print "Author:";
							print '</span>';
							

							if($authorA != "N/A" && !empty($authorA)){
								$aux = str_replace(' ', '+', $authorA);	
								$_REQUEST['personName'] = $authorA;						
							}
							else
							{
								if (!empty($authorB)){
									$aux = str_replace(' ', '+', $authorB);
									$_REQUEST['personName'] = $authorB;
								}
							}
						
							print '<a href="./peopleInfo.php?personName=' . $aux . '">';
								print '<span  style="padding-left: 25px">';
									if($authorA != "N/A" && !empty($authorA)){
										print ucfirst($authorA);
									}
									else
									{
										if (!empty($authorB))
											print ucfirst($authorB);
										else
											print "N/A";
									}
								print '</span>';
							print '</a>';

							if($artistA != "N/A" && !empty($artistA)){
								$auxB = str_replace(' ', '+', $artistA);
								$_REQUEST['personName'] = $artistA;
				
							}
							else
							{
								if (!empty($artistB)){
									$auxB = str_replace(' ', '+', $artistB);
									$_REQUEST['personName'] = $artistB;

								}


							}
						

							print '<span style="font-size:15px; color:#454445; font-weight:bold; font-style:italic;padding-left: 25px;">';
								print "Artist:";
							print '</span>';

							print '<a href="./peopleInfo.php?personName=' . $auxB. '">';
								print '<span  style="padding-left: 25px">';
									if($artistA != "N/A" && !empty($artistA)){
										print ucfirst($artistA);
									}
									else
									{
										if (!empty($artistB))
											print ucfirst($artistB);
										else
											print "N/A";
									}
								print '</span>';
							print '</a>';

						print '</td>';
					// print '</li>';
					print '</tr>';
				

					//closing connection		
					$conn = null;
		</script>
		</table>
		
		</div>
		<div style="margin-top:80px" align="middle">
			<ul class="flatflipbuttons">
	  	    <li class='chart'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>Charts</b></li>
	  		</ul>
	  	</div>

		<div id="container" class="viz1">

			<table style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<tr>
					<td>
						<h1 align="center" style="font-size:20px">Votes distribution</h1>
					</td>
				</tr>

				<tr>
					<td  style="width: 50%; height:90%;" class="charts">
						<div id="container" class="menu">
						</div>
						<div id="container" class="boxPlot" >	
						</div>
						<div id="container" class="bar" >
							<!-- <form>
								<label><input type="radio" name="mode" value="grouped"> Grouped</label>
								<label><input type="radio" name="mode" value="stacked" checked> Stacked</label>
							</form> -->
						</div>
					</td>
				
				</tr>
			</table>
		</div>

		<script type="text/javascript">
			var chart = false;
			$('.viz1').hide();
			$('li.chart')
				.on('click', function(d){

				if (!chart){
					$('.viz1').show();
					chart = true;
				}
				else
				{
					$('.viz1').hide();
					chart = false;
				}
			});
		</script>

		<script type="text/javascript">

			var csv;
			// parse in the data	
			d3.json("groupRank.php", function(error, value){
				csv = value;
				GroupedBarChart(csv);
			});


		  	var box = false;
		  	
			var sampleData = [
				{"group": "bar chart"},
				{"group": "box plot chart"}
			];

			var toggles = d3plus.form()
			.container(".menu")
			.data(sampleData)
			.focus("bar chart", function(d){
		    	if(d == "box plot chart"){

			    	d3.json("boxPlotValues.php", function(dataCsv){
			    		// console.log(dataCsv);
			    		d3.select("svg").remove();
			    		// d3.select(".boxPlot").remove();
			    		var labels = true; // show the text labels beside individual boxplots?

						var margin = {top: 20, right: 50, bottom: 70, left: 50};
						var  width = 900 - margin.left - margin.right;
						var height = 500 - margin.top - margin.bottom;
						
						var min = Infinity,
						    max = -Infinity;

						var data = [];
						data[0] = [];
						data[1] = [];
						// add more rows if your csv file has more columns

						// add here the header of the csv file
						data[0][0] = "MangaHere";
						data[1][0] = "MangaFox";

						// console.log(csv[0]['BakaBaye']);
						data[0][2] =	dataCsv[0]['BakaBaye'];
						data[1][2] =	dataCsv[0]['MyBaye'];

						data[0][3] =	dataCsv[0]['BakaAvg'];
						data[1][3] =	dataCsv[0]['MyAvg'];
						// data[1][2] = csv[0]['ListBaye']
						// add more rows if your csv file has more columns

						data[0][1] = [];
						data[1][1] = [];
					  
					  	// console.log(dataCsv[0].Q11);
						dataCsv[0].Q11.forEach(function(x) {
							// console.log(x);
							var v1 = Math.floor(x.Q1);
								// v2 = Math.floor(x.Q2);
								// v3 = Math.floor(x.Q3),
								// v4 = Math.floor(x.Q4);
								// add more variables if your csv file has more columns
								
							// var rowMax = Math.max(v1, Math.max(v2, Math.max(v1,v2)));
							// var rowMin = Math.min(v1, Math.min(v2, Math.min(v1,v2)));

							data[0][1].push(v1);
							// data[1][1].push(v2);
							// data[2][1].push(v3);
							// data[3][1].push(v4);
							 // add more rows if your csv file has more columns
							 
							// if (rowMax > max) max = rowMax;
							// if (rowMin < min) min = rowMin;	
						});

						dataCsv[0].Q22.forEach(function(x) {
							// console.log(x);
							// var v1 = Math.floor(x.Q1),
							var	v2 = Math.floor(x.Q2);
								// v3 = Math.floor(x.Q3),
								// v4 = Math.floor(x.Q4);
								// add more variables if your csv file has more columns
								
							// var rowMax = Math.max(v1, Math.max(v2, Math.max(v1,v2)));
							// var rowMin = Math.min(v1, Math.min(v2, Math.min(v1,v2)));

							// data[0][1].push(v1);
							data[1][1].push(v2);
							// data[2][1].push(v3);
							// data[3][1].push(v4);
							 // add more rows if your csv file has more columns
							 
							// if (rowMax > max) max = rowMax;
							// if (rowMin < min) min = rowMin;	
						});
					  	
					  	min = 0;
						max = 10;
					  	// console.log(data);
						var chart = d3.box()
							.whiskers(iqr(1.5))
							.height(height)	
							.domain([min, max])
							.showLabels(labels);

						var svg = d3.select(".boxPlot").append("svg")
							.attr("width", width + margin.left + margin.right)
							.attr("height", height + margin.top + margin.bottom)
							.attr("class", "box")    
							.append("g")
							.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

						var v1 = [];
						var v2 = [];
						i = 0;
						dataCsv[0].Q11.forEach (function(x) {
							v1[i] = Number(x.Q1);
							// v2[i] = Number(x.Q2);
							i++;
						});

						dataCsv[0].Q22.forEach (function(x) {
							// v1[i] = Number(x.Q1);
							v2[i] = Number(x.Q2);
							i++;
						})

						
						var tip = d3.tip()
							.attr('class', 'd3-tip')
							.offset([-10, 0])
							.html(function(d) {
								// console.log(d);
								return "<strong>"+d[0] + "</strong>"+'<br><br>'+"<strong>Avg: </strong><span style='color:red'>"+ d[3].toFixed(2) + "</span><br>"+"<strong>Bayer Avg: </strong><span style='color:red'>"+ (Number(d[2])).toFixed(2) + "</span><br>" + "<strong>Median: </strong><span style='color:red'>" +  d3.quantile(d[1], .5)+"</span>" ;
							});

						svg.call(tip);
						
						// the x-axis
						var x = d3.scale.ordinal()	   
							.domain( data.map(function(d) { return d[0] } ) )	    
							.rangeRoundBands([0 , width], 0.7, 0.3); 		

						var xAxis = d3.svg.axis()
							.scale(x)
							.orient("bottom");

						console.log("minmax: " + min + " " + max);
						// the y-axis
						
						var y = d3.scale.linear()
							.domain([min, max])
							.range([height + margin.top, 0 + margin.top]);
						
						var yAxis = d3.svg.axis()
						    .scale(y)
						    .orient("left");
						// console.log("box" + data);
						// draw the boxplots	

						svg.selectAll(".box")	   
					      .data(data)
						  .enter()
						  .append("g")
					 	   .attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
					       .on('mouseover', tip.show)
	      		    	   .on('mouseout', tip.hide)
					       .call(chart.width(x.rangeBand()));
			      
						// add a title
						svg.append("text")
					        .attr("x", (width / 2))             
					        .attr("y", 0 + (margin.top / 2))
					        .attr("text-anchor", "middle")  
					        .style("font-size", "18px") 
					        //.style("text-decoration", "underline")  
					        .text("Average of votes");
					 
						 // draw y axis
						svg.append("g")
					        .attr("class", "y axis")
					        .call(yAxis)
							.append("text") // and text1
							  .attr("transform", "rotate(-90)")
							  .attr("y", 6)
							  .attr("dy", ".71em")
							  .style("text-anchor", "end")
							  .style("font-size", "16px") 
							  .text("Votes");		
							
						// draw x axis	
						svg.append("g")
					      .attr("class", "x axis")
					      .attr("transform", "translate(0," + (height  + margin.top + 10) + ")")
					      .call(xAxis)
						  .append("text")             // text label for the x axis
					        .attr("x", (width / 2) )
					        .attr("y",  10 )
							.attr("dy", ".71em")
					        .style("text-anchor", "middle")
							.style("font-size", "16px") 
					        .text("Quarter"); 
						
						// Returns a function to compute the interquartile range.
						function iqr(k) {
						  return function(d, i) {
						    var q1 = d.quartiles[0],
						        q3 = d.quartiles[2],
						        iqr = (q3 - q1) * k,
						        i = -1,
						        j = d.length;
						    while (d[++i] < q1 - iqr);
						    while (d[--j] > q3 + iqr);
						    return [i, j];
						  };
						}
					});
			    }
		    	
		    	else{

		    		d3.select("svg").remove();
		    		GroupedBarChart(csv);
				
				}
		    	
		    })
		    .id("group")
		    // .title("Nested Toggle")
		    .type("toggle")
		    .draw()
	
		</script>

	</div>
</div>
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
