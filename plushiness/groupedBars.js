function sortNumber(a,b) {
    return a - b;
}

function GroupedBarChart(csv){
	console.log("funcao ^^");
	var n = 10, // number of layers
	m = 2, // number of samples per layer
	stack = d3.layout.stack(),
	layers = bumpLayer(),
	yGroupMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); }),
	yStackMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y+10; }); });
	// console.log(layers);

	var tips = d3.tip()
			.attr('class', 'd3-tip')
			.offset([-10, 0])
			.html(function(d, i, x) {
				console.log(x);
				console.log(d);
				return "<strong>Vote "+(x+1)+ ": </strong>" + "<span style='color:red'>" + d['percent'] +"%</span>" ;
			});

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
	// console.log("maxColor: " + maxColor + " minColor: "+minColor);

	var group1 = [];
	group2 = [];
	layers.forEach(
		function(d) {
      		group1.push(+d[0].y);
      		group2.push(+d[1].y);

  		});



	group1.sort(sortNumber);
	var color1 = d3.scale.ordinal()
		.domain(group1)
		.range(['rgb(255,247,251)','rgb(236,231,242)','rgb(208,209,230)','rgb(166,189,219)','rgb(116,169,207)','rgb(54,144,192)','rgb(5,112,176)','rgb(4,90,141)','rgb(2,56,88)']);

	group2.sort(sortNumber);
	var color2 = d3.scale.ordinal()
		.domain(group2)
		.range(['rgb(255,247,251)','rgb(236,231,242)','rgb(208,209,230)','rgb(166,189,219)','rgb(116,169,207)','rgb(54,144,192)','rgb(5,112,176)','rgb(4,90,141)','rgb(2,56,88)']);
	
	console.log([d3.min(group2), d3.max(group2)]);
	// console.log([d3.min(layers.map(function(d){ return d[1].y;})), d3.max(layers.map(function(d){ return d.value;}))]);

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

	svg.call(tips);

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
		.on('mouseover', tips.show)
	    .on('mouseout', tips.hide)
		.style("fill", function(d, i) { 
			if(i == 0)
			// console.log(d.y + " " + i );
				return color1(d.y);
			else
				return color2(d.y);
		})
		.style("stroke", "black");


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
		// console.log("here");
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


		// console.log(csv);
		var arr = [];
		for (i =0; i < csv.length; i++){
			var aux = [];
			aux.push({x: 0, y: Number(csv[i]['Q1']), votes: Number(csv[i]['Q1Votes']), percent: Number(csv[i]['Q1'])});
			aux.push({x: 1, y: Number(csv[i]['Q2']), votes: Number(csv[i]['Q2Votes']), percent: Number(csv[i]['Q2'])});
			arr.push(aux);
		}

		// console.log(arr);
		return arr;
	}
}