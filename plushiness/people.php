
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
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script src="rank10.js"></script>
<script src="donut.js"></script>
<link rel="stylesheet" type="text/css" href="barChart.css">
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
	<br><br><br><br><br><br>
	<div >
		<table style="width:70%; margin-left:250px; margin-top:-50px; ">
			<!-- <tr><td align="left"><p><b>Final course assignment</b></p></td></tr> -->
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; " ><p>In this section we present information about authors and artists featurd in our databases.</p></td></tr>
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; "><p>Below, you will find gerneral information about these people.</a></p></td></tr>
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; "><p>If you, wish, you can view information about a specific person by typing its name into the search bar.</p></td></tr>
		</table>
	</div>
  <div id="graphMenu" align="middle">
    <br><br>
	<ul class="flatflipbuttons">
		<li class='donutChart1'><a><span><img src="./icons/donat-chart-32.png" /></span></a> <b>Genre Popularity</b></li>
		<!-- <li class='donutChart2'><a><span><img src="./icons/donat-chart-32.png" /></span></a> <b>Donut Chart Votes</b></li> -->
        <li class='barChart'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>10 Most famous</b></li>

	</ul>
  </div>
	<div id="featured-wrapper" style="margin-top: -80px;">

		<div id="container" class="div1">
			<div class="pies">
				<!-- border: 1px solid black; -->
			<table  style="width: 80%; height:70%; margin-left:40px; margin-top:50px; border-collapse: collapse;">
				
				<tr> 
					<td class="pie1" style="padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">Genre with More Views</h1>
					</td>
					<td class="pie2"style="padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">Genre with More Votes</h1>
					</td>
				</tr>
				
				<tr>
					<td class="pie1">
						<div style="margin-left:100px" >

							<legend for="toggles">Database:</legend>
							
							<input type="radio" name="toggles" value="mf" checked>
							<label for="mf">MangaFox</label>
							
							<input type="radio" name="toggles" value="mh">
							<label for="mh">MangaHere</label>
						</div>
					</td>

					<td class="pie2">
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
					<td class="pie1" style="width: 100%; height:90%;">
						<div class="donutA1">
						<div align="center" id="donut" style="margin-top:20px "></div>
						</div>
					</td>
					<td class="pie2" style="width: 100%; height:90%;">
						<div class="donutA2">
						<div align="center" id="donut2" style="margin-top:20px "></div>
						</div>
					</td>
				</tr>

			</table >
		</div>
		<div class="chart1">
			<!-- border: 1px solid black; -->
			<table   style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border-collapse: collapse;">
				<tr style="margin-bottom:100px;"> 
					<td style="padding-top:5.4em; padding-bottom:2.4em">
						<h1 align="center" style="font-size:20px">Popularity of previous works</h1>
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
				
		</div>

		<script type="text/javascript">
			var pie1 = false;
			// var pie2 = false;
			var bar = false;
			$('.pies').hide();
			// $('.pie2').hide();
			$('.chart1').hide();

			$('li.donutChart1')
				.on('click', function(d){

				if (!pie1){
					$('.pies').show();
					pie1 = true;
				}
				else
				{
					$('.pies').hide();
					pie1 = false;
				}
			});

			// $('li.donutChart2')
			// 	.on('click', function(d){

			// 	if (!pie2){
			// 		$('.pie2').show();
			// 		pie2 = true;
			// 	}
			// 	else
			// 	{
			// 		$('.pie2').hide();
			// 		pie2 = false;
			// 	}
			// });

			$('li.barChart')
				.on('click', function(d){

				if (!bar){
					$('.chart1').show();
					bar = true;
				}
				else
				{
					$('.chart1').hide();
					bar = false;
				}
			});
		</script>

		<script>
			var datas2 = [];
			var dat2 = [];

	        d3.json('donutValuesVotes.php', function(data){
	        	console.log(data.Fox[0]);
	        	datas2["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        	datas2["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
				dat2["Female"] = Number(data.Fox[0].Female);
				dat2["Male"] = Number(data.Fox[1].Male);

				var chart2 = donut("Votes")
			        .$el(d3.select('#donut2'))
			        .data(datas2)
			        .render(dat2);

				var toggles2 = d3plus.form()
					.data("[name=toggles2]")
					.focus("mf2",function(d){

						if(d == 'mf2'){
							datas2["Female"] =  Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
	        				datas2["Male"] = Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
							dat2["Female"] = Number(data.Fox[0].Female);
							dat2["Male"] = Number(data.Fox[1].Male);
							chart2.data(datas2).render(dat2);
						}
						else
						{
							
							datas2["Female"] =  Math.round( (Number(data.Here[0].Female)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100 );
	        				datas2["Male"] = Math.round((Number(data.Here[1].Male)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100);
							dat2["Female"] = Number(data.Fox[0].Female);
							dat2["Male"] = Number(data.Fox[1].Male);
							chart2.data(datas2).render(dat2);
						}
					})
					.draw();
			});


		</script>

		<script>
			

	        d3.json('donutValuesVisual.php', function(data){
	        	var datas = [];
				var dat = [];
	        	// console.log(data.Fox[0]);
	        	datas["Female"] =  Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
	        	datas["Male"] = Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
				// console.log(datas);	 
				dat["Female"] = Number(data.Fox[1].Male);
				dat["Male"] =  Number(data.Fox[0].Female);

				chart = donut("Visualizations")
			        .$el(d3.select('#donut'))
			        .data(datas)
			        .render(dat);
					// donutChart('','#donut', 'all', 'mangafox');
			

			var toggles = d3plus.form()
				.data("[name=toggles]")
				.focus("mf",function(d){
					console.log(d);
					if(d == 'mf'){
						//d3.json('donutValuesVisual.php', function(data){
						// var datas = [];
						// var dat = [];
						datas["Female"] =  Math.round((Number(data.Fox[1].Male)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100);
        				datas["Male"] = Math.round( (Number(data.Fox[0].Female)/(Number(data.Fox[0].Female) + Number(data.Fox[1].Male)))*100 );
						dat["Female"] = Number(data.Fox[1].Male);
						dat["Male"] = Number(data.Fox[0].Female);
						// $('#donut').remove();
						// $('div.donutA1').append('<div align="center" id="donut" style="margin-top:20px "></div>');
						chart.data(datas).render(dat);
						// chart.data(datas).render(dat);
						// donut("Visualizations")
					 //        .$el(d3.select('#donut'))
					 //        .data(datas)
					 //        .render(dat);
						// });

					}
					else
					{
						// d3.json('donutValuesVisual.php', function(data){
							// var datas = [];
							// var dat = [];
							datas["Female"] = Math.round((Number(data.Here[1].Male)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100);
	        				datas["Male"] =  Math.round( (Number(data.Here[0].Female)/(Number(data.Here[0].Female) + Number(data.Here[1].Male)))*100 );
							dat["Female"] = Number(data.Fox[1].Male);
							dat["Male"] = Number(data.Fox[0].Female);
							chart.data(datas).render(dat);

							// $('#donut').remove();
							// $('div.donutA1').append('<div align="center" id="donut" style="margin-top:20px "></div>');
							// console.log(datas);
							// chart.data(datas).render(dat);
							// donut("Visualizations")
						        // .$el(d3.select('#donut'))
						        // .data(datas)
						        // .render(dat);
							// chart.data(datas).render(dat);
						// });
					}
				})
				.draw();
		});
			

		</script>


		<script>


			d3.json('rank10AutoresVotosFox.php', function(data){
				// console.log(data[0].chart1);
				rank10Autores(data,'.rank', 'fox');
			});

			var sampleDataRankPop = [
			  {"group": "MangaFox"},
			  {"group": "MangaHere"}
			];

			var togglesMap = d3plus.form()
			  .container("div.Menu2")
			  .data(sampleDataRankPop)
			  .focus("MangaFox", function(d){
			      if(d == "MangaFox"){
			      	// console.log("ya");
			      	d3.select('.rank svg').remove();
			      	d3.json('rank10AutoresVotosFox.php', function(data){
						rank10Autores(data,'.rank', 'fox');
					});
			      	
			      }
			      else{
			      	
			      	d3.select('.rank svg').remove();
			      	d3.json('rank10AutoresVotosHere.php', function(data){
						rank10Autores(data,'.rank', 'here');
					});
			      }
			    })
			  .id("group")
			  .type("toggle")
			  .draw();

		</script>
	</div>
</div>
<!-- <div id="stamp" class="container">
	<div class="hexagon"><span class="icon icon-wrench"></span></div>
</div> -->
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
