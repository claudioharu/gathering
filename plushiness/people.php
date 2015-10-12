

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
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script src="rank10.js"></script>
<script src="donut.js"></script>
<link rel="stylesheet" type="text/css" href="barChart.css">





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

			<table  style="width: 80%; height:70%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				
				<tr> 
					<td style="padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">Pie Chart Visual</h1>
					</td>
					<td style="padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">Pie Chart Votes</h1>
					</td>
				</tr>
				
				<tr>
					<td>
						<div style="margin-left:100px" >

							<legend for="toggles">Database:</legend>
							
							<input type="radio" name="toggles" value="mf" checked>
							<label for="mf">MangaFox</label>
							
							<input type="radio" name="toggles" value="mh">
							<label for="mh">MangaHere</label>
						</div>
					</td>

					<td>
						<div style="margin-left:100px " >

							<legend for="toggles2">Database:</legend>
							
							<input type="radio" name="toggles2" value="mf2" checked>
							<label for="mf2">MangaFox</label>
							
							<input type="radio" name="toggles2" value="mh2">
							<label for="mh2">MangaHere</label>
						</div>
					</td>
				</tr>

				<tr>					
					<td  style="width: 100%; height:90%;">
						<div align="center" id="donut" style="margin-top:20px "></div>
					</td>
					<td  style="width: 100%; height:90%;">
						<div align="center" id="donut2" style="margin-top:20px "></div>
					</td>
				</tr>

			</table >
			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<tr style="margin-bottom:100px;"> 
					<td style="padding-top:5.4em; padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">10 Most famous authors</h1>
					</td>
				</tr>
				
				<tr>
					<td>
						<div class="Menu2" align="left" style="margin-left:150px"></div>
					</td>
				</tr>

				<tr>					
					<td  style="width: 100%; height:90%;">
					
						<div class="rank">

						</div>
						
					</td>
				</tr>

				
			</table>
				
		</div>

		<script>
			var datas2 = [];
			// data["Female"] =  89;
	  //       data["Male"] =10;

	        d3.json('donutValuesVotes.php', function(data){
	        	console.log(data.Fox[0]);
	        	datas2["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        	datas2["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
				// console.log(datas2);	       

				var chart = donut()
			        .$el(d3.select('#donut2'))
			        .data(datas2)
			        .render();

				var toggles2 = d3plus.form()
					.data("[name=toggles2]")
					.focus("mf2",function(d){
						console.log(d);
						if(d == 'mf2'){
							
							datas2["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        				datas2["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
							chart.data(datas2).render();
						}
						else
						{
							
							datas2["Female"] =  Math.round( (Number(data.Here[0].Female)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100 );
	        				datas2["Male"] = Math.round((Number(data.Here[1].Male)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100);
							chart.data(datas2).render();
						}
							

					})
					.draw();

			});

		</script>

		<script>
			var datas = [];
			// data["Female"] =  89;
	  //       data["Male"] =10;

	        d3.json('donutValuesVisual.php', function(data){
	        	console.log(data.Fox[0]);
	        	datas["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        	datas["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
				console.log(datas);	       

				var chart = donut()
			        .$el(d3.select('#donut'))
			        .data(datas)
			        .render();
					// donutChart('','#donut', 'all', 'mangafox');

				var toggles = d3plus.form()
					.data("[name=toggles]")
					.focus("mf",function(d){
						console.log(d);
						if(d == 'mf'){
							
							datas["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        				datas["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
							chart.data(datas).render();
						}
						else
						{
							
							datas["Female"] =  Math.round( (Number(data.Here[0].Female)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100 );
	        				datas["Male"] = Math.round((Number(data.Here[1].Male)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100);
							chart.data(datas).render();
						}
							

					})
					.draw();

			});

		</script>


		<script>

			d3.json('rank10AutoresVotos.php', function(data){
				rank10Autores(data,'.rank');
			});

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
