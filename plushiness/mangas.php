
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script  src="jquery.js"></script>
<script src="http://www.d3plus.org/js/d3.js"></script>
<script src="http://www.d3plus.org/js/d3plus.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script src="rank10.js"></script>
<link rel="stylesheet" type="text/css" href="barChart.css">
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
<link rel="stylesheet" type="text/css" href="menu.css">
<link rel="stylesheet" type="text/css" href="context.css">



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
	<br><br><br><br><br><br>
	<div >
		<table style="width:70%; margin-left:250px; margin-top:-50px; ">
			<!-- <tr><td align="left"><p><b>Final course assignment</b></p></td></tr> -->
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; "><p>In this section you can find information regarding the titles presented in our databases.</p></td></tr>
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; "><p>Please use the search field above to find information of a specific title.</a></p></td></tr>
			<tr><td align="left" style="color:black; font-size: 1em; font-weight: 250; "><p>Use the buttons bellow to view information about popularity.</p></td></tr>
		</table>
	</div>
  <div id="graphMenu" align="middle">
    <br><br>
    <ul class="flatflipbuttons">
        <li class='barChart1'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>10 Most Popular Titles</b></li>
        <li class='barChart2'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>10 Less Popular Titles</b></li>
        <li class='barChart3'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>Rank of All Titles</b></li>
      </ul>
  </div>
	<div id="featured-wrapper" style="margin-top: -80px;">
			<div id="container" class="div1">
				<!-- border: 1px solid black; -->
			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border-collapse: collapse;">
				<!-- <tr><td>	Here you can blábláblá <br> Use the searchbar to ....</td></tr> -->
				<tr class="bar1">
					<td style="padding-bottom: 1.5em;">
						<h1 align="center" style="font-size:20px; height:10px;">10 Most Popular Titles</h1>
					</td>
				</tr>
				<tr class="bar1">
					<td align="center">
						  <div class="Menu1" align="left" style="margin-left:150px">
					</td>
				</tr>
				<tr class="bar1">					
					<td  style="width: 100%; height:90%; padding-bottom: 4.5em; ">
						<div align="left" style="margin-left:150px">
							<div class='mode1'>
								<form>
										<label><input type="radio" name="mode1" value="total" checked> Total</label>
										<label><input type="radio" name="mode1" value="ongoing"> Ongoing</label>
										<label><input type="radio" name="mode1" value="completed" > Completed</label>
								
								</form>
							</div>
							<div class='mode2'>
								<form>
										<label><input type="radio" name="mode2" value="total" checked> Total</label>
										<label><input type="radio" name="mode2" value="ongoing"> Ongoing</label>
										<label><input type="radio" name="mode2" value="completed" > Completed</label>
								</form>
							</div>
						</div>
						<div class="rankTitle"></div>
					</td>
				</tr>


				<tr class="bar2">
					<td style="padding-bottom: 1.5em;">
						<h1 align="center" style="font-size:20px; height:10px;">10 Less Popular Titles</h1>
					</td>
				</tr>

				<tr class="bar2">
					<td align="center">
						  <div class="Menu2" align="left" style="margin-left:150px">
					</td>
				</tr>
				<tr class="bar2">					
					<td  style="width: 100%; height:90%;">
						<div align="left" style="margin-left:150px">
							<div class='mode1w'>
								<form>
										<label><input type="radio" name="mode1w" value="total" checked> Total</label>
										<label><input type="radio" name="mode1w" value="ongoing"> Ongoing</label>
										<label><input type="radio" name="mode1w" value="completed" > Completed</label>
								
								</form>
							</div>
							<div class='mode2w'>
								<form>
										<label><input type="radio" name="mode2w" value="total" checked> Total</label>
										<label><input type="radio" name="mode2w" value="ongoing"> Ongoing</label>
										<label><input type="radio" name="mode2w" value="completed" > Completed</label>
								</form>
							</div>
						</div>
						<div class="rankTitleWorst">

						</div>
						
					</td>
				</tr>
				<tr class="bar3" style=" margin: 30px auto; padding: 0; height:10px; " >
			      <td>
			        <h1 align="center" style="font-size:20px; ">Rank of All Titles</h1>
			      </td>
			    </tr>
			    <tr  style=" margin: 30px auto; padding: 0;" class="bar3">    
			      <td style="width: 100%; height:90%;">
			        <div class="context" style="position: relative; "></div>
			        <div class="rankAllTitles" style="overflow: scroll; height:50%; width:auto;  position: relative; overflow-x: hidden;"></div>           
			      </td>
			    </tr>
			
			</table>
			</div>

		<script type="text/javascript">

			var bar1 = false;
			var bar2 = false;
			var bar3 = false;
			$('.bar1').hide();
			$('.bar2').hide();
			$('.bar3').hide();


			$('li.barChart1')
				.on('click', function(d){

				if (!bar1){
					$('.bar1').show();
					bar1 = true;
				}
				else
				{
					$('.bar1').hide();
					bar1 = false;
				}
			});

			$('li.barChart2')
				.on('click', function(d){

				if (!bar2){
					$('.bar2').show();
					bar2 = true;
				}
				else
				{
					$('.bar2').hide();
					bar2 = false;
				}
			});

			$('li.barChart3')
				.on('click', function(d){

				if (!bar3){
					$('.bar3').show();
					bar3 = true;
				}
				else
				{
					$('.bar3').hide();
					bar3 = false;
				}
			});
		</script>

<!-- All titles -->
		<script type="text/javascript">
d3.json("rankAllTitles.php", function(error, data2) {
    d3.select("svg.chartAllTitle").remove();
    var subset = [];
    j = 0;
    for (i = 0; i <=  100; i++)
    {
      subset[j] = data2[i];
      j++;
    }
    rankAllTitles(subset, ".rankAllTitles");
});

d3.json("rankAllTitles.php", function(error, data) {

var margin = {top: 10, right: 10, bottom: 100, left: 40},
    margin2 = {top: 430, right: 10, bottom: 20, left: 200}, // tirando o final do grafico
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom,
    height2 = 500 - margin2.top - margin2.bottom;

var x = d3.scale.linear().range([0, width]),
    x2 = d3.scale.linear().range([0, width]),
    y = d3.scale.linear().range([height, 0]),
    y2 = d3.scale.linear().range([height2, 0]);

var xAxis = d3.svg.axis().scale(x).orient("bottom"),
    xAxis2 = d3.svg.axis().scale(x2).orient("bottom"),
    yAxis = d3.svg.axis().scale(y).orient("left");

var centering = false,
    center,
    alpha = .2;

var area = d3.svg.area()
    .interpolate("basis")
    .x(function(d) { return x(d.pos); })
    .y0(height)
    .y1(function(d) { return y(d.value); });

var area2 = d3.svg.area()
    .interpolate("basis")
    .x(function(d) { return x2(d.pos); })
    .y0(height2)
    .y1(function(d) { return y2(d.value); });

var svg = d3.select(".context").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", 200);


//Grafico de baixo
var context = svg.append("g")
    .attr("class", "context")
    .attr("transform", "translate(" + margin2.left + "," + 20 + ")");


var arc = d3.svg.arc()
    .outerRadius(height2 / 2)
    .startAngle(0)
    .endAngle(function(d, i) { return i ? -Math.PI : Math.PI; });
  
  data.forEach(function(d) {
      d.pos = +d.pos;
      d.value = +d.value;
  });

  console.log(data);
  
  x.domain([0, 17022]);
  y.domain([d3.min(data.map(function(d){return d.value;})), d3.max(data.map(function(d) { return d.value; }))]);
  x2.domain(x.domain());
  y2.domain(y.domain());

  var brush = d3.svg.brush()
    .x(x2)
    .extent([0,100])
    .on("brush", brushmove);

  var gBrush = svg.append("g")
    .attr("class", "brush")
    .call(brush);

  gBrush.selectAll(".resize").append("path")
    .attr("transform", "translate(0," +  height2 / 2 + ")")
    .attr("d", arc)
    .attr("transform", "translate(" + margin2.left + "," + (20+25) + ")");


  gBrush.selectAll("rect")
    .attr("height", height2)
    .attr("transform", "translate(" + margin2.left + "," + 20 + ")");
  
  gBrush.select(".background")
    .on("mousedown.brush", brushcenter)
    .on("touchstart.brush", brushcenter);

  gBrush.call(brush.event);

  context.append("path")
      .datum(data)
      .attr("class", "area")
      .attr("d", area2);

  context.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height2 + ")");

function brushmove() {
  
    var extent = [];

    extent[0] = Math.round(brush.extent()[0]);
    extent[1] = Math.round(brush.extent()[1]);
    if (extent[1]- extent[0] > 100) {
      d3.event.target.extent([extent[0],extent[0]+ 101]);
      d3.event.target(d3.select(this));
      // d3.json("/plushiness/rankAllTitles.php", function(error, datas) {
          d3.select("svg.chartAllTitle").remove();
          var subset = [];
          j = 0;
          for (i = extent[0]; i <=  extent[0]+ 101; i++)
          {
            subset[j] = data[i];
            j++;
          }
          rankAllTitles(subset, ".rankAllTitles");
      // });   
    }
    else{
      // console.log(extent);
      // d3.json("/plushiness/rankAllTitles.php", function(error, data2) {
          d3.select("svg.chartAllTitle").remove();
          var subset = [];

          j = 0;
          for (i = extent[0]; i <=  extent[1]; i++)
          {
            subset[j] = data[i];
            j++;
          }
          rankAllTitles(subset, ".rankAllTitles");
      // });

      console.log(extent);
    }

   
}

function brushcenter() {
  var self = d3.select(window),
      target = d3.event.target,
      extent = brush.extent(),
      size = extent[1] - extent[0],
      domain = x2.domain(),
      x0 = domain[0] + size / 2,
      x1 = domain[1] - size / 2;

  recenter(true);
  brushmove();

  if (d3.event.changedTouches) {
    self.on("touchmove.brush", brushmove).on("touchend.brush", brushend);
  } else {
    self.on("mousemove.brush", brushmove).on("mouseup.brush", brushend);
  }

  function brushmove() {
    d3.event.stopPropagation();
    center = Math.max(x0, Math.min(x1, x.invert(d3.mouse(target)[0])));
    recenter(false);
  }

  function brushend() {
    brushmove();
    self.on(".brush", null);
  }
}

function recenter(smooth) {
  if (centering) return; // timer is active and already tweening
  if (!smooth) return void tween(1); // instantaneous jump
  centering = true;

  function tween(alpha) {
    var extent = brush.extent(),
        size = extent[1] - extent[0],
        center1 = center * alpha + (extent[0] + extent[1]) / 2 * (1 - alpha);

    gBrush
        .call(brush.extent([center1 - size / 2, center1 + size / 2]))
        .call(brush.event);

    return !(centering = Math.abs(center1 - center) > 1e-3);
  }

  d3.timer(function() {
    return tween(alpha);
  });
}

});

		</script>
		
<?php 
if($_GET["set1"]==1){ 
	echo '<script type="text/javascript">';
	echo "$('.bar1').show();"; 
	echo '</script>';
} else if($_GET["set2"]==1){ 
	echo '<script type="text/javascript">';
	echo "$('.bar2').show();"; 
	echo '</script>';
} else if($_GET["set3"]==1){ 
	echo '<script type="text/javascript">';
	echo "$('.bar3').show();"; 
	echo '</script>';
}
?>
		
		<script type="text/javascript">

			d3.json('popTitleTotal.php', function(data){
					$('.mode2').hide();
					$('.mode1').show();
	 				rankPop(data,'.rankTitle','mangafox','');
			});

			var sampleDataRankPop = [
			  {"group": "MangaFox"},
			  {"group": "MangaHere"}
			];

			var togglesMap = d3plus.form()
			  .container("div.Menu1")
			  .data(sampleDataRankPop)
			  .focus("MangaFox", function(d){
			      if(d == "MangaFox"){
			      	d3.select('.rankTitle svg').remove();
			      	$('.mode2').hide();
			      	$('.mode1').show();
			        d3.json('popTitleTotal.php', function(data){
			 			rankPop(data,'.rankTitle','mangafox','');
					});
			      }
			      else{
			      	$('.mode2').show();
			      	$('.mode1').hide();
			      	d3.select('.rankTitle svg').remove();
			      	d3.json('popTitleTotal.php', function(data){
						rankPop(data,'.rankTitle',"mangahere",'');
					});
			      }
			    })
			  .id("group")
			  .type("toggle")
			  .draw();

			$("input[name=mode1]:radio")
				.change(function () {
					d3.select('.rankTitle svg').remove();
					if( $(this).is(":checked") ){ // check if the radio is checked
						var val = $(this).val();
						if(val == 'total')
						{
							d3.json('popTitleTotal.php', function(data){
								rankPop(data,'.rankTitle',"mangafox", val);
							});
						}
						else if(val == 'ongoing')
						{
							d3.json('popTitleOngoing.php', function(data){
								rankPop(data,'.rankTitle',"mangafox", val);
							});
						}
						else{
							d3.json('popTitleCompleted.php', function(data){
								console.log(data);
								rankPop(data,'.rankTitle',"mangafox", val);
							});
						}
			        }
					
				});

			$("input[name=mode2]:radio")
				.change(function () {
					d3.select('.rankTitle svg').remove();
					if( $(this).is(":checked") ){ // check if the radio is checked
						var val = $(this).val();
						if(val == 'total')
						{
							d3.json('popTitleTotal.php', function(data){
								rankPop(data,'.rankTitle',"mangahere", val);
							});
						}
						else if(val == 'ongoing')
						{
							d3.json('popTitleOngoing.php', function(data){
								rankPop(data,'.rankTitle',"mangahere", val);
							});
						}
						else{
							d3.json('popTitleCompleted.php', function(data){
								rankPop(data,'.rankTitle',"mangahere", val);
							});
						}
			        }	
				});
		</script>
		<script type="text/javascript">

			d3.json('worstTitleTotal.php', function(data){
					$('.mode2w').hide();
					$('.mode1w').show();
	 				rankWorst(data,'.rankTitleWorst','mangafox','');
			});

			var sampleDataWorstRank = [
			  {"group": "MangaFox"},
			  {"group": "MangaHere"}
			];

			var togglesMap = d3plus.form()
			  .container("div.Menu2")
			  .data(sampleDataWorstRank)
			  .focus("MangaFox", function(d){
			      if(d == "MangaFox"){
			      	d3.select('.rankTitleWorst svg').remove();
			      	$('.mode2w').hide();
			      	$('.mode1w').show();
			        d3.json('worstTitleTotal.php', function(data){
			 			rankWorst(data,'.rankTitleWorst','mangafox','');
					});
			      }
			      else{
			      	$('.mode2w').show();
			      	$('.mode1w').hide();
			      	d3.select('.rankTitleWorst svg').remove();
			      	d3.json('worstTitleTotal.php', function(data){
						rankWorst(data,'.rankTitleWorst',"mangahere",'');
					});
			      }
			    })
			  .id("group")
			  .type("toggle")
			  .draw();

			$("input[name=mode1w]:radio")
				.change(function () {
					d3.select('.rankTitleWorst svg').remove();
					if( $(this).is(":checked") ){ // check if the radio is checked
						var val = $(this).val();
						if(val == 'total')
						{
							d3.json('worstTitleTotal.php', function(data){
								rankWorst(data,'.rankTitleWorst',"mangafox", val);
							});
						}
						else if(val == 'ongoing')
						{
							d3.json('worstTitleOngoing.php', function(data){
								rankWorst(data,'.rankTitleWorst',"mangafox", val);
							});
						}
						else{
							d3.json('worstTitleCompleted.php', function(data){
								// console.log(data);
								rankWorst(data,'.rankTitleWorst',"mangafox", val);
							});
						}
			        }
					
				});

			$("input[name=mode2w]:radio")
				.change(function () {
					d3.select('.rankTitleWorst svg').remove();
					if( $(this).is(":checked") ){ // check if the radio is checked
						var val = $(this).val();
						if(val == 'total')
						{
							d3.json('worstTitleTotal.php', function(data){
								rankWorst(data,'.rankTitleWorst',"mangahere", val);
							});
						}
						else if(val == 'ongoing')
						{
							d3.json('worstTitleOngoing.php', function(data){
								rankWorst(data,'.rankTitleWorst',"mangahere", val);
							});
						}
						else{
							d3.json('worstTitleCompleted.php', function(data){
								rankWorst(data,'.rankTitleWorst',"mangahere", val);
							});
						}
			        }	
				});
			
		</script>
			
		</div>	

	</div>
</div>
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>
</body>
</html>
