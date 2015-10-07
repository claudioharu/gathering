
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


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
<script src="http://d3js.org/d3.v3.js"></script>
<script src="http://www.d3plus.org/js/d3.js"></script>
<script src="http://www.d3plus.org/js/d3plus.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script  src="jquery.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>


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

	div.tooltip {   
		position: absolute;           
		text-align: center;           
		width: 60px;                  
		height: 28px;                 
		padding: 2px;             
		font: 12px sans-serif;        
		background: lightsteelblue;   
		border: 0px;      
		border-radius: 8px;           
		pointer-events: none;         
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

	<div id="featured-wrapper">
		<div style="color:black; font-size: 1.0em; font-weight: 250;  font-family: Arial;">
			<table style="width:70%; margin-left:100px; margin-top:-50px; border: 1px solid black; border-collapse: collapse; ">
				<tr>
					<td>
						<h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
					</td>
				</tr>
		
				<tr>
					<td>
						 <div class="Menu" align="left" style="margin-left:150px"></div>
					</td>
				</tr>

				<tr>
					<td>
						<div id="chart"></div>
					</td>
				</tr>

        <tr>
          <td>
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
          </td>
        </tr>
    
        <tr>
          <td>
             <div class="Menu2" align="left" style="margin-left:150px"></div>
          </td>
        </tr>

        <tr>
          <td>
            <div id="chart2"></div>
          </td>
        </tr>

        <tr>
          <td>
            <h1 align="left"  style="font-size:20px;  margin-left:150px;  margin-bottom:10px;">Network of relationships between authors and artists </h1>
          </td>
        </tr>
    
        <tr>
          <td>
             <div class="Menu3" align="left" style="margin-left:150px">
             <form>
              <label>Order by:</label>
              <label><input class="Size" type="radio" name="mode" value="size" checked> Titles</label>
              <label><input class="Count" type="radio" name="mode" value="count"> Authors</label>
            </form>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div id="chart3"></div>
          </td>
        </tr>

				
	</table>

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
        console.log('mangahere')
        $('.Size').prop('checked',true);
        $('.Count').prop('checked',false);

        $('#chart3').find('div').remove();
        d3.json(categSetTreeMap[0], function(error, data) {
          console.log(error);
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
    console.log(data);

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
        .style("fill", function(d, i) { console.log(d);return color(d.parent.index); });

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
function abbreviateNumber(value) {
    var newValue = value;
    if (value >= 1000) {
        var suffixes = ["", "k", "m", "b","t"];
        var suffixNum = Math.floor( (""+value).length/3 );
        var shortValue = '';
        for (var precision = 2; precision >= 1; precision--) {
            shortValue = parseFloat( (suffixNum != 0 ? (value / Math.pow(1000,suffixNum) ) : value).toPrecision(precision));
            var dotLessShortValue = (shortValue + '').replace(/[^a-zA-Z 0-9]+/g,'');
            if (dotLessShortValue.length <= 2) { break; }
        }
        if (shortValue % 1 != 0)  shortNum = shortValue.toFixed(1);
        newValue = shortValue+suffixes[suffixNum];
    }
    return newValue;
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
