function boxPlotGraphic(dataCsv, id, name){	
	var labels = true; // show the text labels beside individual boxplots?

	var margin = {top: 20, right: 50, bottom: 70, left: 50};
	var  width = 900 - margin.left - margin.right;
	var height = 500 - margin.top - margin.bottom;

	var min = Infinity,
	    max = -Infinity;

	var data = [];
	data[0] = [];
	// data[1] = [];data[1]
	// add more rows if your csv file has more columns

	// add here the header of the csv file
	data[0][0] = name;
	// data[1][0] = "MangaFox";

	// console.log(csv[0]['BakaBaye']);
	data[0][2] =	dataCsv[0]['BakaBaye'];
	// data[1][2] =	dataCsv[0]['MyBaye'];

	data[0][3] =	dataCsv[0]['BakaAvg'];
	// data[1][3] =	dataCsv[0]['MyAvg'];
	// data[1][2] = csv[0]['ListBaye']
	// add more rows if your csv file has more columns

	data[0][1] = [];
	// data[1][1] = [];

		// console.log(dataCsv[0].Q11);
	dataCsv.forEach(function(x) {
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

		
	min = 0;
	max = 10;
		// console.log(data);
	var chart = d3.box()
		.whiskers(iqr(1.5))
		.height(height)	
		.domain([min, max])
		.showLabels(labels);

	var svg = d3.select(id).append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.attr("class", "box")    
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	var v1 = [];
	var v2 = [];
	i = 0;
	dataCsv.forEach (function(x) {
		v1[i] = Number(x.Q1);
		// v2[i] = Number(x.Q2);
		i++;
	});

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
		.style("font-size", "16px");
	    
		
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