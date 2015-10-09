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
			// console.log(d.y + " " + i );
			return color(d.y);
		})
		.style("stroke", "black");

		// .on("mouseover", function() { tooltip.style("display", null); })
		// .on("mouseout", function() { tooltip.style("display", "none"); })
		// .on("mousemove", function(d) {
		// 	var xPosition = d3.mouse(this)[0] - 10;
		// 	var yPosition = d3.mouse(this)[1] - 25;
		// 	tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")");
		// 	tooltip.select("text").text((d.votes));
		// });

	// var tooltip = svg.append("g")
	// 	.attr("class", "tooltip")
	// 	.style("display", "none");

	// tooltip.append("rect")
	// 	.attr("width", 50)
	// 	.attr("height", 20)
	// 	.attr("fill", "orange")
	// 	.style("opacity", 0.5);
	// 	tooltip.append("text")
	// 	.attr("x", 25)
	// 	.attr("dy", "1.2em")
	// 	.style("text-anchor", "middle")
	// 	.attr("font-size", "12px")
	// 	.attr("font-weight", "bold");

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