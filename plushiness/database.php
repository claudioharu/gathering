
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<link rel="stylesheet" type="text/css" href="barChart.css">
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
<link rel="stylesheet" type="text/css" href="menu.css">


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
<style>
	rect.bordered {
		stroke: #E6E6E6;
		stroke-width:2px;   
	}

	text.mono {
		font-size: 9pt;
		font-family: Consolas, courier;
		fill: #000;
	}

	text.axis-workweek {
		fill: #000;
	}

	text.axis-worktime {
		fill: #000;
	}

</style>

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
				<li><a href="./mangas.php" accesskey="4" title="">Titles</a></li>
				<li><a href="./about.php" accesskey="5" title="">About</a></li>
				<!-- <li accesskey="6" title="">
					<div class="container-2">
						<form name="form1" action="search.php"  >
							<input name="infos" type="search" id="search" placeholder="Search..."/>
							<input type="submit" style="visibility: hidden; position: absolute;"/>
						</form>
					</div>
				</li> -->
			</ul>
		</div>
</div>

<div id="wrapper">
  <div id="graphMenu" align="middle">
    <br><br>
    <ul class="flatflipbuttons">
        <li class='barChart'><a><span><img src="./icons/bar-chart-5-32.png" /></span></a><b>Bar Chart</b></li>
        <li class='heatMap'><a><span><img src="./icons/heat-map-32.png" /></span></a> <b>Heat Map</b></li>
        <li class='treeMap'><a><span><img src="./icons/tree-structure-32.png" /></span></a> <b>Tree Map</b></li>
      </ul>
  </div>
	<div id="featured-wrapper" style="margin-top: -80px;">
    

		<div style="color:black; font-size: 1.0em; font-weight: 250;  font-family: Arial;">
			<table style="width:70%; margin-left:100px; margin-top:-50px; border: 1px solid black; border-collapse: collapse; ">
				<tr class="1">
					<td>

						<h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
					</td>
				</tr>
		
				<tr class="1">
					<td>
						 <div class="Menu" align="left" style="margin-left:150px"></div>
					</td>
				</tr>

				<tr class="1">
					<td>
						<div id="chart"></div>
					</td>
				</tr>

        <tr class='2'>
          <td>
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
          </td>
        </tr>
    
        <tr class='2'> 
          <td>
             <div class="Menu2" align="left" style="margin-left:150px"></div>
          </td>
        </tr>

        <tr class='2'>
          <td>
            <div id="chart2"></div>
          </td>
        </tr>

        <tr class='3'>
          <td>
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
          </td>
        </tr>
    
        <tr class='3'>
          <td>
             <div class="Menu3" align="left" style="margin-left:150px">
              </div>
             <form align="left" style="margin-left:150px">
              <label>Order by:</label>
              <label><input class="Size" type="radio" name="mode" value="size" checked> Titles</label>
              <label><input class="Count" type="radio" name="mode" value="count"> Authors</label>
            </form>
            <br>
          </td>
        </tr>

        <tr class='3'>
          <td>
            <div id="chart3"></div>
          </td>
        </tr>

        <tr class='4'>
          <td  style="width: 100%; height:90%; padding-top: 4.5em; padding-bottom: 2.5em">
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;"> 10 Most popular publishers
        </tr>
    
        <tr class='4'>
          <td>
             <div class="Menu4" align="left" style="margin-left:150px">
            </div>
          </td>
        </tr>

        <tr class='4'>
          <td>
            <div align="left" class="publisherBars"></div>
          </td>
        </tr>

        <tr class='4'>
          <td  style="width: 100%; height:90%; padding-top: 4.5em; padding-bottom: 2.5em">
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;"> 10 Less popular publishers
        </tr>
    
        <tr class='4'>
          <td>
             <div class="Menu5" align="left" style="margin-left:150px">
            </div>
          </td>
        </tr>

        <tr class='4'>
          <td>
            <div align="left" class="worstPublishersBars"></div>
          </td>
        </tr>

				
	</table>

<script type="text/javascript">
$('.4').hide();
$('.3').hide();
$('.1').hide();
$('.2').hide();

var set1 = false;
var set2 = false;
var set3 = false;

  $('li.barChart')
    .on('click', function(d){

      if (!set1){
        console.log("barChart");
        $('.4').show();
        set1 = true;
      }
      else
      {
        $('.4').hide();
        set1 = false;
      }

    });

  $('li.treeMap')
    .on('click', function(d){
      console.log("heatmap");
      if (!set2){
        console.log("barChart");
        $('.3').show();
        set2 = true;
      }
      else
      {
        $('.3').hide();
        set2 = false;
      }
      // $('.3').hide();
    });

  $('li.heatMap')
  .on('click', function(d){
    console.log("treemap");

    if (!set3){
      console.log("barChart");
      $('.1').show();
      $('.2').show();
      set3 = true;
    }
    else
    {
      $('.1').hide();
      $('.2').hide();
       set3 = false;
    }
    // $('.1').hide();
    // $('.2').hide();
  });

</script>

<script type="text/javascript">

    d3.json("publisherRankTotal.php", function(data){
        rankPublisher(data, ".publisherBars", "mangafox", "");
    });

    var sampleDataRankPop = [
      {"group": "MangaFox"},
      {"group": "MangaHere"}
    ];

    var toggleRank = d3plus.form()
      .container("div.Menu4")
      .data(sampleDataRankPop)
      .focus("MangaFox", function(d){
          if(d == "MangaFox"){

            d3.select('.publisherBars svg').remove();
            d3.json("publisherRankTotal.php", function(data){
                rankPublisher(data, ".publisherBars", "mangafox", "");
            });
          }
          else{

            d3.select('.publisherBars svg').remove();
            d3.json("publisherRankTotal.php", function(data){
                rankPublisher(data, ".publisherBars", "mangahere", "");
            });
          }
        })
      .id("group")
      .type("toggle")
      .draw();

</script>

<script type="text/javascript">

    d3.json("publisherRankWorstTotal.php", function(data){
        rankWorstPublisher(data, ".worstPublishersBars", "mangafox", "");
    });

    var sampleDataRankWorstPop = [
      {"group": "MangaFox"},
      {"group": "MangaHere"}
    ];

    var toggleRankWorst = d3plus.form()
      .container("div.Menu5")
      .data(sampleDataRankPop)
      .focus("MangaFox", function(d){
          if(d == "MangaFox"){

            d3.select('.worstPublishersBars svg').remove();
            d3.json("publisherRankWorstTotal.php", function(data){
                rankWorstPublisher(data, ".worstPublishersBars", "mangafox", "");
            });
          }
          else{

            d3.select('.worstPublishersBars svg').remove();
            d3.json("publisherRankWorstTotal.php", function(data){
                rankWorstPublisher(data, ".worstPublishersBars", "mangahere", "");
            });
          }
        })
      .id("group")
      .type("toggle")
      .draw();

</script>

<script>

var categSetTreeMap = ["treeMapCatMangaHere.php", "treeMapCatMangaFox.php"];    

d3.json(categSetTreeMap[1], function(error, data) {
  graficoTreeMap(data);
});


var sampleDataTreeMap = [
  {"group": "MangaFox"},
  {"group": "MangaHere"}
];

var togglesMap = d3plus.form()
  .container("div.Menu3")
  .data(sampleDataTreeMap)
  .focus("MangaFox", function(d){
      if(d == "MangaFox"){
        $('.Size').prop('checked',true);
        $('.Count').prop('checked',false);

        $('#chart3').find('div').remove();
         d3.json(categSetTreeMap[1], function(error, data) {
            graficoTreeMap(data);
          });
      }
      else{
        // console.log('mangahere')
        $('.Size').prop('checked',true);
        $('.Count').prop('checked',false);

        $('#chart3').find('div').remove();
        d3.json(categSetTreeMap[0], function(error, data) {
          // console.log(error);
          graficoTreeMap(data);
        });
      }
    })
  .id("group")
  .type("toggle")
  .draw();

function graficoTreeMap(data){
  var w = 1280 - 80,
      h = 800 - 180,
      x = d3.scale.linear().range([0, w]),
      y = d3.scale.linear().range([0, h]),
      // color = d3.scale.category10(),
      root,
      node,
      color = d3.scale.linear().domain([0,5,10,15,20,25,30,32]).range(['rgb(158,1,66)','rgb(213,62,79)','rgb(244,109,67)','rgb(253,174,97)','rgb(254,224,139)','rgb(255,255,191)','rgb(230,245,152)','rgb(171,221,164)','rgb(102,194,165)','rgb(50,136,189)','rgb(94,79,162)']);

  var tips = d3.tip()
          .attr('class', 'd3-tip')
          .offset([-10, 0])
          .html(function(d) {
            // console.log(d);
          return "<strong><a style='color:red'>"+ d.parent.name+ "</a></strong><br><strong>Size: </strong><span style='color:red'>"+ d.size + "</span>"+"<br><strong>Count: </strong><span style='color:red'>"+ d.count + "</span>";
      });

  var treemap = d3.layout.treemap()
      .round(false)
      .size([w, h])
      .sticky(true)
      .value(function(d) { return d.size; });

  var svg = d3.select("#chart3").append("div")
      .attr("class", "chart")
      .style("width", w + "px")
      .style("height", h + "px")
    .append("svg:svg")
      .attr("width", w)
      .attr("height", h)
    .append("svg:g")
      .attr("transform", "translate(.5,.5)");

  svg.call(tips);

  // d3.json("treeMapCatMangaHere.php", function(data) {
    node = root = data;
    // console.log(data);

    var nodes = treemap.nodes(root)
        .filter(function(d) { return !d.children; });

    var cell = svg.selectAll("g")
        .data(nodes)
      .enter().append("svg:g")
        .attr("class", "cell")
        .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
        // .on("click", function(d) { return zoom(node == d.parent ? root : d.parent); })
        .on('mouseover', tips.show)
        .on('mouseout', tips.hide);


    cell.append("svg:rect")
        .attr("width", function(d) { return d.dx - 1; })
        .attr("height", function(d) { return d.dy - 1; })
        .style("fill", function(d, i) { return color(d.parent.index); });

    cell.append("svg:text")
        .attr("x", function(d) { return d.dx / 2; })
        .attr("y", function(d) { return d.dy / 2; })
        .attr("dy", ".35em")
        .attr("text-anchor", "middle")
        .text(function(d) { return d.name; })
        .style("opacity", function(d) { d.w = this.getComputedTextLength(); return d.dx > d.w ? 1 : 0; });

    // d3.select(window).on("click", function() { zoom(root); });

    d3.selectAll("input").on("change", function() {
      // console.log("eu");
      treemap.value(this.value == "size" ? size : count).nodes(root);
      zoom(node);
    });

    // treemap.value(size).nodes(root);
    // zoom(node);

  // });


  function size(d) {
    return d.size;
  }

  function count(d) {
    return d.count;
  }

  function zoom(d) {

    var kx = w / d.dx, ky = h / d.dy;
    x.domain([d.x, d.x + d.dx]);
    y.domain([d.y, d.y + d.dy]);

    var t = svg.selectAll("g.cell").transition()
        .duration(d3.event.altKey ? 7500 : 750)
        .attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; });

    t.select("rect")
        .attr("width", function(d) { return kx * d.dx - 1; })
        .attr("height", function(d) { var h = ky * d.dy - 1; if (h > 0) return h; else return -h; })

    t.select("text")
        .attr("x", function(d) { return kx * d.dx / 2; })
        .attr("y", function(d) { return ky * d.dy / 2; })
        .style("opacity", function(d) { return kx * d.dx > d.w ? 1 : 0; });

    node = d;
    d3.event.stopPropagation();
  }
}
</script>



<script type="text/javascript">



      var categSets = ["mangaFoxCategories.php", "mangaHereCategories.php"];    
     
      d3.json(categSets[0], function(error, data) {
        grafico(data, 0);
      });
      

      var sampleData = [
        {"group": "MangaFox"},
        {"group": "MangaHere"}
      ];

      var toggles = d3plus.form()
        .container("div.Menu")
        .data(sampleData)
        .focus("MangaFox", function(d){
            if(d == "MangaFox"){
              $('#chart').find('svg').remove();
               d3.json(categSets[0], function(error, data) {
                  grafico(data, 0);
                });
            }
            else{
              $('#chart').find('svg').remove();
              d3.json(categSets[1], function(error, data) {
                  grafico(data, 1);
              });
            }
          })
        .id("group")
        .type("toggle")
        .draw();
      
      function grafico(data, i){
        // console.log(data);     
        var categ = data.categories;   

        var margin = { top: 90, right: 0, bottom: 100, left: 130 },
          width = 1000 - margin.left - margin.right,
          height = 700 - margin.top - margin.bottom,
          gridSize = Math.floor(width / 60),
          legendElementWidth = gridSize*3,
          buckets = 12,
          colors = ['rgb(49,54,149)', 'rgb(69,117,180)', 'rgb(116,173,209)', 'rgb(171,217,233)', 'rgb(224,243,248)', 'rgb(255,255,191)', 'rgb(254,224,144)', 'rgb(253,174,97)', 'rgb(244,109,67)', 'rgb(215,48,39)', 'rgb(165,0,38)']
          
          days = categ,
          times = categ;
          datasets = ["heatMapValuesMangaFox.php", "heatMapValuesMangaHere.php"];    
     
      var svg = d3.select("#chart").append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
          .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      var dayLabels = svg.selectAll(".dayLabel")
          .data(days)
          .enter().append("text")
            .text(function (d) { return d; })
            .attr("x", 0)
            .attr("y", function (d, i) { return i * gridSize; })
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridSize / 1.5 + ")");

      var timeLabels = svg.selectAll(".timeLabel")
          .data(times)
          .enter().append("text")
            .attr("class", "Horizontal")
            .text(function(d) { return d; })
            .attr("transform", function(d,i){
              var xText = i * gridSize+10;
              var yText = -5;
              return "translate("  + xText + "," + yText + ") rotate(-60)"
              });

  		var tip = d3.tip()
  			.attr('class', 'd3-tip')
  			.offset([-10, 0])
  			.html(function(d) {
  			return "<strong>Axis X: </strong><span style='color:red'>"+ d.hour+"</span><br><strong>Axis Y: </strong><span style='color:red'>"+ d.day+"</span><br><strong>Visualizations:</strong> <span style='color:red'>" + abbreviateNumber(d.value) + "</span>";
  		});

  		svg.call(tip);


      var heatmapChart = function(jsonFile) {
        d3.json(jsonFile, 

        function(error, data) {
          // console.log(data);
          var colorScale = d3.scale.quantile()
              .domain([0, buckets - 1, d3.max(data, function (d) { return Math.log(d.value); })])
              .range(colors);

          var cards = svg.selectAll(".hour")
              .data(data, function(d) {return d.day+':'+d.hour;});

          cards.append("title");

          cards.enter().append("rect")
              .attr("x", function(d) { return (categ.indexOf(d.hour)) * gridSize; })
              .attr("y", function(d) { return (categ.indexOf(d.day)) * gridSize; })
              .attr("rx", 4)
              .attr("ry", 4)
              .attr("class", "hour bordered")
              .attr("width", gridSize)
              .attr("height", gridSize)
              .style("fill", colors[0])
              .on('mouseover', tip.show)
      		    .on('mouseout', tip.hide);

          cards.transition().duration(1000)
              .style("fill", function(d) { return colorScale(Math.log(d.value)); });

          cards.select("title").text(function(d) { return Math.log(d.value); });
          
          cards.exit().remove();

          var legend = svg.selectAll(".legend")
              .data([0].concat(colorScale.quantiles()), function(d) { return d; });

          legend.enter().append("g")
              .attr("class", "legend");

          legend.append("rect")
            .attr("x", function(d, i) { return legendElementWidth * i; })
            .attr("y", (categ.length+2)*gridSize)
            .attr("width", legendElementWidth)
            .attr("height", gridSize / 2)
            .style("fill", function(d, i) { return colors[i]; });

          legend.append("text")
            .attr("class", "mono")
            .text(function(d) {  return "≥" + abbreviateNumber(Math.round(Math.exp(d))); })
            .attr("x", function(d, i) { return legendElementWidth * i; })
            .attr("y", (categ.length+3.5)*gridSize);

          legend.exit().remove();

        });  
      };
      heatmapChart(datasets[i]);
    }
	</script>

<script type="text/javascript">
     
      d3.json(categSets[0], function(error, data) {
        grafico2(data, 0);
      });
      
      var toggle = d3plus.form()
        .container("div.Menu2")
        .data(sampleData)
        .focus("MangaFox", function(d){
            if(d == "MangaFox"){
              $('#chart2').find('svg').remove();
               d3.json(categSets[0], function(error, data) {
                  grafico2(data, 0);
                });
            }
            else{
              $('#chart2').find('svg').remove();
              d3.json(categSets[1], function(error, data) {
                  grafico2(data, 1);
              });
            }
          })
        .id("group")
        .type("toggle")
        .draw();
      
      function grafico2(data, i){
        // console.log(data);     
        var categ = data.categories;   

        var margin = { top: 90, right: 0, bottom: 100, left: 130 },
          width = 1000 - margin.left - margin.right,
          height = 700 - margin.top - margin.bottom,
          gridSize = Math.floor(width / 60),
          legendElementWidth = gridSize*3,
          buckets = 12,
          colors = ['rgb(49,54,149)', 'rgb(69,117,180)', 'rgb(116,173,209)', 'rgb(171,217,233)', 'rgb(224,243,248)', 'rgb(255,255,191)', 'rgb(254,224,144)', 'rgb(253,174,97)', 'rgb(244,109,67)', 'rgb(215,48,39)', 'rgb(165,0,38)']
          
          days = categ,
          times = categ;
          datasets = ["heatMapValuesMangaFoxVotos.php", "heatMapValuesMangaHereVotos.php"];    
     
      var svg = d3.select("#chart2").append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
          .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      var dayLabels = svg.selectAll(".dayLabel")
          .data(days)
          .enter().append("text")
            .text(function (d) { return d; })
            .attr("x", 0)
            .attr("y", function (d, i) { return i * gridSize; })
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridSize / 1.5 + ")");

      var timeLabels = svg.selectAll(".timeLabel")
          .data(times)
          .enter().append("text")
            .attr("class", "Horizontal")
            .text(function(d) { return d; })
            .attr("transform", function(d,i){
              var xText = i * gridSize+10;
              var yText = -5;
              return "translate("  + xText + "," + yText + ") rotate(-60)"
            });
		var tip = d3.tip()
			.attr('class', 'd3-tip')
			.offset([-10, 0])
			.html(function(d) {
			return "<strong>Axis X: </strong><span style='color:red'>"+ d.hour+"</span><br><strong>Axis Y: </strong><span style='color:red'>"+ d.day+"</span><br><strong>Votes: </strong> <span style='color:red'>" + abbreviateNumber(d.value) + "</span>";
		});

		svg.call(tip);


      var heatmapChart2 = function(jsonFile) {
        d3.json(jsonFile, 

        function(error, data) {
          // console.log(data);
          var colorScale = d3.scale.quantile()
              .domain([0, buckets - 1, d3.max(data, function (d) { return Math.log(d.value); })])
              .range(colors);

          var cards = svg.selectAll(".hour")
              .data(data, function(d) {return d.day+':'+d.hour;});

          cards.append("title");

          cards.enter().append("rect")
              .attr("x", function(d) { return (categ.indexOf(d.hour)) * gridSize; })
              .attr("y", function(d) { return (categ.indexOf(d.day)) * gridSize; })
              .attr("rx", 4)
              .attr("ry", 4)
              .attr("class", "hour bordered")
              .attr("width", gridSize)
              .attr("height", gridSize)
              .style("fill", colors[0])
              .on('mouseover', tip.show)
      		    .on('mouseout', tip.hide);

          cards.transition().duration(1000)
              .style("fill", function(d) { return colorScale(Math.log(d.value)); });

          cards.select("title").text(function(d) { return Math.log(d.value); });
          
          cards.exit().remove();

          var legend = svg.selectAll(".legend")
              .data([0].concat(colorScale.quantiles()), function(d) { return d; });

          legend.enter().append("g")
              .attr("class", "legend");

          legend.append("rect")
            .attr("x", function(d, i) { return legendElementWidth * i; })
            .attr("y", (categ.length+2)*gridSize)
            .attr("width", legendElementWidth)
            .attr("height", gridSize / 2)
            .style("fill", function(d, i) { return colors[i]; });

          legend.append("text")
            .attr("class", "mono")
            .text(function(d) { return "≥" + abbreviateNumber(Math.round(Math.exp(d))); })
            .attr("x", function(d, i) { return legendElementWidth * i; })
            .attr("y", (categ.length+3.5)*gridSize);

          legend.exit().remove();

        });  
      };

      heatmapChart2(datasets[i]);
    }
// </script>

		</div>
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
