
<style type="text/css">
.chart {
	/*background: #b0e0f8;*/
	margin: 5px;
}
.chart rect {
	stroke: white;
	fill: steelblue;
}
.chart rect:hover {
  fill: #64707D;
}

.chart line {
  stroke: #c1c1c1;
}

.chart .rule {
  fill: #000;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
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
				<li><a href="./mangas.php" accesskey="4" title="">Titles</a></li>
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
			<div id="container" class="div1">
			<table  style="width: 80%; height:100%; margin-left:40px; margin-top:50px;  border: 1px solid black; border-collapse: collapse;">
				<!-- <tr><td>	Here you can blábláblá <br> Use the searchbar to ....</td></tr> -->
				<tr>
					<td align="center">
						  <div class="Menu1" align="left" style="margin-left:150px">
					</td>
				</tr>
				<tr>					
					<td  style="width: 100%; height:90%;">
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
						<div class="rankTitle">

						</div>
						
					</td>
				</tr>

				<tr>
					<td align="center">
						  <div class="Menu2" align="left" style="margin-left:150px">
					</td>
				</tr>
				<tr>					
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

				<tr>					
					<td  style="width: 100%; height:90%;">
					
						<div class="rankPublisher">

						</div>
						
					</td>
				</tr>
			</table>
			</div>
		
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
<div id="stamp" class="container">
	<div class="hexagon"><span class="icon icon-wrench"></span></div>
</div>
<!-- <div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
 -->
</body>
</html>
