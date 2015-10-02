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
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script  src="jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script src="box.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<span class="icon icon-globe"></span>
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

					print '<tr>';
						print '<td rowspan="5">';
							print '<div id="left">';
							print '<img src="' . $imgB . ' width="200" style=" padding:1px; border:2px solid #021a40;" >';
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

		<div id="container" class="viz1">

			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<tr>
					<td>
						<h1 align="center" style="font-size:20px">Network of relationships between authors and artists </h1>
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

			var csv;
			// parse in the data	
			d3.json("boxPlotValues.php", function(error, value){
				csv = value;
				d3.select("svg").remove();
					var n = 10, // number of layers
					m = 2, // number of samples per layer
					stack = d3.layout.stack(),
					layers = bumpLayer(),
					yGroupMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); }),
					yStackMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y+10; }); });
					console.log(layers);

					// var tip = d3.tip()
					// .attr('class', 'd3-tip')
					// .offset([-10, 0])
					// .html(function(d) {
					// 	console.log(d);
					// 	return "<strong>Frequency:</strong> <span style='color:red'>" + d.y + "</span>";
					// });


					var margin = {top: 40, right: 10, bottom: 20, left: 50},
						width = 960 - margin.left - margin.right,
						height = 500 - margin.top - margin.bottom;

					// console.log(yStackMax);
					var x = d3.scale.ordinal()
						.domain(d3.range(m))
						.rangeRoundBands([0, width], .08);

					var y = d3.scale.linear()
						.domain([0, yGroupMax])
						.range([height, 0]);

					var maxColor =  d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); });
					var minColor =  d3.min(layers, function(layer) { return d3.min(layer, function(d) { return d.y; }); });
					console.log("maxColor: " + maxColor + " minColor: "+minColor);
					
					var color = d3.scale.linear()
						.domain([0,10, 15, 20, 25,35,40, 45,50, 55,60,65, 70,75,80,85, 90,95, 100])
						.range(['rgb(49,54,149)', 'rgb(69,117,180)', 'rgb(116,173,209)', 'rgb(171,217,233)', 'rgb(224,243,248)', 'rgb(255,255,191)', 'rgb(254,224,144)', 'rgb(253,174,97)', 'rgb(244,109,67)', 'rgb(215,48,39)', 'rgb(165,0,38)']);

					var xAxis = d3.svg.axis()
						.scale(x)
						.tickSize(0)
						.tickPadding(6)
						.tickFormat(function(d) { 
							if (d == 0)
								return "MangaHere";
							else
								return "MangaFox";
						})
						.orient("bottom");

					var yAxis = d3.svg.axis()
						.scale(y)
    					.orient("left")
    					.ticks(10);

					var svg = d3.select(".bar").append("svg")
						.attr("width", width + margin.left + margin.right)
						.attr("height", height + margin.top + margin.bottom)
						.append("g")
						.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

					var layer = svg.selectAll(".layer")
						.data(layers)
						.enter().append("g")
						.attr("class", "layer");
						// .style("fill", function(d, i) { console.log(d[0].y + " " + i ); return color(d[0].y); });

					var rect = layer.selectAll("rect")
						.data(function(d) { return d; })
						.enter().append("rect")
						.attr("x", function(d) { return x(d.x); })
						.attr("y", height)
						.attr("width", x.rangeBand())
						.attr("height", 0)
						.style("fill", function(d, i) { 
							console.log(d.y + " " + i );
							return color(d.y);
						})
						.style("stroke", "black")

						.on("mouseover", function() { tooltip.style("display", null); })
						.on("mouseout", function() { tooltip.style("display", "none"); })
						.on("mousemove", function(d) {
							var xPosition = d3.mouse(this)[0] - 10;
							var yPosition = d3.mouse(this)[1] - 25;
							tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")");
							tooltip.select("text").text((d.votes));
						});

					var tooltip = svg.append("g")
						.attr("class", "tooltip")
						.style("display", "none");

					tooltip.append("rect")
						.attr("width", 50)
						.attr("height", 20)
						.attr("fill", "orange")
						.style("opacity", 0.5);
						tooltip.append("text")
						.attr("x", 25)
						.attr("dy", "1.2em")
						.style("text-anchor", "middle")
						.attr("font-size", "12px")
						.attr("font-weight", "bold");

					rect.transition()
						.delay(function(d, i) { return i * 10; })
						.attr("y", function(d) { return y(5-d.y); })
						.attr("height", function(d) { return y(d.y); });

					svg.append("g")
						.attr("class", "x axis")
						.attr("transform", "translate(0," + height + ")")
						.call(xAxis);

					svg.append("g")
						.attr("class", "y axis")
						.call(yAxis)
						.append("text")
						.attr("transform", "rotate(-90)")
						.attr("y", 6)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.text("Votes (%)");

					d3.selectAll("input").on("change", change);

					var timeout = setTimeout(function() {
						console.log("here");
						transitionGrouped();
						// d3.select("input[value=\"grouped\"]").property("checked", true).each(change);
					}, 200);

					function change() {
						clearTimeout(timeout);
						transitionGrouped();
					}

					function transitionGrouped() {
						y.domain([0, yGroupMax]);

						rect.transition()
							.duration(400)
							.delay(function(d, i) { return i * 10; })
							.attr("x", function(d, i, j) { return x(d.x) + x.rangeBand() / n * j; })
							.attr("width", x.rangeBand() / n)
							.transition()
							.attr("y", function(d) { return y(d.y); })
							.attr("height", function(d) { return height - y(d.y); });
					}


					// Inspired by Lee Byron's test data generator.
					function bumpLayer(n, o) {


						console.log(csv);
						var arr = [];
						for (i =0; i < csv.length; i++){
							var aux = [];
							aux.push({x: 0, y: Number(csv[i]['Q1']), votes: Number(csv[i]['Q1Votes'])});
							aux.push({x: 1, y: Number(csv[i]['Q2']), votes: Number(csv[i]['Q2Votes'])});
							arr.push(aux);
						}

						// console.log(arr);
						return arr;
					}
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
		    		d3.select("svg").remove();
		    		// d3.select(".boxPlot").remove();
		    		var labels = true; // show the text labels beside individual boxplots?

					var margin = {top: 20, right: 50, bottom: 70, left: 50};
					var  width = 900 - margin.left - margin.right;
					var height = 500 - margin.top - margin.bottom;
					
					var min = Infinity,
					    max = -Infinity;
					
					// function generate_html(popup) {
					// 	var html = "";
					// 	var inputs =  popup['inputs'];
					// 	for (var input in inputs) {
					// 		html += "<strong>" + input + "</strong>" + ": " + inputs[input] + "<br>";
					// 	}
					// 	return html
					// 	var c = "red";
					// 	return 'Hi there! My color is <span style="color:' + c + '">' + c + '</span>';
					// }



					// var popups =  [
					//   {
					//   'inputs': {
					//     'Name': 'galo'
					//    }},
					//   {
					//   'inputs': {
					//     'Name': 'dog'
					//    }},
					//   {
					//   'inputs': {
					//     'Name': 'dog',
					//     'Occupation': 'barking'
					//    }}
					// ];

					// var tooltip = d3.select("body")
					// 	.append("div")
					// 	.attr("class","tooltip")
					// 	.style("position", "absolute")
					// 	.style("z-index", "10")
					// 	.style("visibility", "hidden");

					var data = [];
					data[0] = [];
					data[1] = [];
					// add more rows if your csv file has more columns

					// add here the header of the csv file
					data[0][0] = "MangaHere";
					data[1][0] = "MangaFox";
					// add more rows if your csv file has more columns

					data[0][1] = [];
					data[1][1] = [];
				  
					csv.forEach(function(x) {
						var v1 = Math.floor(x.Q1),
							v2 = Math.floor(x.Q2);
							// v3 = Math.floor(x.Q3),
							// v4 = Math.floor(x.Q4);
							// add more variables if your csv file has more columns
							
						var rowMax = Math.max(v1, Math.max(v2, Math.max(v1,v2)));
						var rowMin = Math.min(v1, Math.min(v2, Math.min(v1,v2)));

						data[0][1].push(v1);
						data[1][1].push(v2);
						// data[2][1].push(v3);
						// data[3][1].push(v4);
						 // add more rows if your csv file has more columns
						 
						if (rowMax > max) max = rowMax;
						if (rowMin < min) min = rowMin;	
					});
				  
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
					csv.forEach (function(x) {
						v1[i] = Number(x.Q1);
						v2[i] = Number(x.Q2);
						i++;
					});

					console.log('oi'+ v1);	
					function weightedMean(d){
						console.log(d[0]);
						var dados;
						if(d[0] == "MangaHere")
							dados = v1;
						else 
							dados = v2;
						console.log(dados);
						var wmean = 0;
						for (i = 0; i < dados.length; i++){
							wmean += (i+1)*dados[i];
						}
						if (wmean == 0)
							return 0;
						// console.log("weightedMean: " + wmean/d3.sum(d) );
						return wmean/d3.sum(dados);
					}
					
					var tip = d3.tip()
						.attr('class', 'd3-tip')
						.offset([-10, 0])
						.html(function(d) {
							return "<strong>"+d[0] + "</strong>"+'<br>'+"<strong>Avg: </strong><span style='color:red'>"+ (weightedMean(d)).toFixed(2) + "</span><br>" + "<strong>Median: </strong><span style='color:red'>" +  d3.quantile(d[1], .5)+"</span>" ;
						});

					svg.call(tip);
					

					// the x-axis
					var x = d3.scale.ordinal()	   
						.domain( data.map(function(d) { return d[0] } ) )	    
						.rangeRoundBands([0 , width], 0.7, 0.3); 		

					var xAxis = d3.svg.axis()
						.scale(x)
						.orient("bottom");

					// the y-axis
					var y = d3.scale.linear()
						.domain([min, max])
						.range([height + margin.top, 0 + margin.top]);
					
					var yAxis = d3.svg.axis()
					    .scale(y)
					    .orient("left");
					console.log("box" + data);
					// draw the boxplots	

					svg.selectAll(".box")	   
				      .data(data)
					  .enter()
					  .append("g")
						.attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
				      	// .transition().delay(1000).duration(20000)
				       // .on("mouseover", function(){return tooltip.style("visibility", "visible");})
		       		   // .on("mousemove", function(d, i){tooltip.html(generate_html(popups[i])); return tooltip.style("top", (event.pageY-10)+"px").style("left",(event.pageX+10)+"px"); })
				       // .on("mouseout", function(){return tooltip.style("visibility", "hidden");})
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
						  .text("Votes (%)");		
						
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
		    	}
		    	
		    	else{

					
		    		d3.select("svg").remove();
					var n = 10, // number of layers
					m = 2, // number of samples per layer
					stack = d3.layout.stack(),
					layers = bumpLayer(),
					yGroupMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); }),
					yStackMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y+10; }); });
					console.log(layers);

					// var tip = d3.tip()
					// .attr('class', 'd3-tip')
					// .offset([-10, 0])
					// .html(function(d) {
					// 	console.log(d);
					// 	return "<strong>Frequency:</strong> <span style='color:red'>" + d.y + "</span>";
					// });


					var margin = {top: 40, right: 10, bottom: 20, left: 50},
						width = 960 - margin.left - margin.right,
						height = 500 - margin.top - margin.bottom;

					// console.log(yStackMax);
					var x = d3.scale.ordinal()
						.domain(d3.range(m))
						.rangeRoundBands([0, width], .08);

					var y = d3.scale.linear()
						.domain([0, yGroupMax])
						.range([height, 0]);

					var maxColor =  d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); });
					var minColor =  d3.min(layers, function(layer) { return d3.min(layer, function(d) { return d.y; }); });
					console.log("maxColor: " + maxColor + " minColor: "+minColor);
					
					var color = d3.scale.linear()
						.domain([0,10, 15, 20, 25,35,40, 45,50, 55,60,65, 70,75,80,85, 90,95, 100])
						.range(['rgb(49,54,149)', 'rgb(69,117,180)', 'rgb(116,173,209)', 'rgb(171,217,233)', 'rgb(224,243,248)', 'rgb(255,255,191)', 'rgb(254,224,144)', 'rgb(253,174,97)', 'rgb(244,109,67)', 'rgb(215,48,39)', 'rgb(165,0,38)']);

					var xAxis = d3.svg.axis()
						.scale(x)
						.tickSize(0)
						.tickPadding(6)
						.tickFormat(function(d) { 
							if (d == 0)
								return "MangaHere";
							else
								return "MangaFox";
						})
						.orient("bottom");

					var yAxis = d3.svg.axis()
						.scale(y)
    					.orient("left")
    					.ticks(10);

					var svg = d3.select(".bar").append("svg")
						.attr("width", width + margin.left + margin.right)
						.attr("height", height + margin.top + margin.bottom)
						.append("g")
						.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

					var layer = svg.selectAll(".layer")
						.data(layers)
						.enter().append("g")
						.attr("class", "layer");
						// .style("fill", function(d, i) { console.log(d[0].y + " " + i ); return color(d[0].y); });

					var rect = layer.selectAll("rect")
						.data(function(d) { return d; })
						.enter().append("rect")
						.attr("x", function(d) { return x(d.x); })
						.attr("y", height)
						.attr("width", x.rangeBand())
						.attr("height", 0)
						.style("fill", function(d, i) { 
							// console.log(d.y + " " + i );
							// if(i == 0){
								// console.log(d.y/91971 *100);
								return color(d.y);
							// }
							// else {
							// 	// console.log(d.y/86420 *100);
							// 	return color(d.y); 
							// }
						})
						.style("stroke", "black")

						.on("mouseover", function() { tooltip.style("display", null); })
						.on("mouseout", function() { tooltip.style("display", "none"); })
						.on("mousemove", function(d) {
							var xPosition = d3.mouse(this)[0] - 10;
							var yPosition = d3.mouse(this)[1] - 25;
							tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")");
							tooltip.select("text").text((d.votes));
						});

					var tooltip = svg.append("g")
						.attr("class", "tooltip")
						.style("display", "none");

					tooltip.append("rect")
						.attr("width", 50)
						.attr("height", 20)
						.attr("fill", "orange")
						.style("opacity", 0.5);
						tooltip.append("text")
						.attr("x", 25)
						.attr("dy", "1.2em")
						.style("text-anchor", "middle")
						.attr("font-size", "12px")
						.attr("font-weight", "bold");

					rect.transition()
						.delay(function(d, i) { return i * 10; })
						.attr("y", function(d) { return y(5-d.y); })
						.attr("height", function(d) { return y(d.y); });

					svg.append("g")
						.attr("class", "x axis")
						.attr("transform", "translate(0," + height + ")")
						.call(xAxis);

					svg.append("g")
						.attr("class", "y axis")
						.call(yAxis)
						.append("text")
						.attr("transform", "rotate(-90)")
						.attr("y", 6)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.text("Votes (%)");

					d3.selectAll("input").on("change", change);

					var timeout = setTimeout(function() {
						console.log("here");
						transitionGrouped();
						// d3.select("input[value=\"grouped\"]").property("checked", true).each(change);
					}, 200);

					function change() {
						clearTimeout(timeout);
						transitionGrouped();
					}

					function transitionGrouped() {
						y.domain([0, yGroupMax]);

						rect.transition()
							.duration(400)
							.delay(function(d, i) { return i * 10; })
							.attr("x", function(d, i, j) { return x(d.x) + x.rangeBand() / n * j; })
							.attr("width", x.rangeBand() / n)
							.transition()
							.attr("y", function(d) { return y(d.y); })
							.attr("height", function(d) { return height - y(d.y); });
					}


					// Inspired by Lee Byron's test data generator.
					function bumpLayer(n, o) {


						console.log(csv);
						var arr = [];
						for (i =0; i < csv.length; i++){
							var aux = [];
							aux.push({x: 0, y: Number(csv[i]['Q1']), votes: Number(csv[i]['Q1Votes'])});
							aux.push({x: 1, y: Number(csv[i]['Q2']), votes: Number(csv[i]['Q2Votes'])});
							arr.push(aux);
						}

						// console.log(arr);
						return arr;
					}
		    	}
		    	
		    })
		    .id("group")
		    // .title("Nested Toggle")
		    .type("toggle")
		    .draw()



		   

	
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
