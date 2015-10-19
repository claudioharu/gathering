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


function vertBar(datas, id, site, author)
{
console.log("vertBar " + author);
// console.log(site);
console.log(datas);

var margin = {top: 40, right: 20, bottom: 30, left: 40},
  width = 960 - margin.left - margin.right,
  height = 500 - margin.top - margin.bottom;

// var formatPercent = d3.format(".0%");

var x = d3.scale.ordinal()
    .rangeRoundBands([0, 650], .2);

var y = d3.scale.linear()
    .range([height, 0]);

var auxY = d3.scale.linear()
    .range([0, height]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");
    // .tickFormat(formatPercent);

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>Votes Avg :</strong> <span style='color:red'>" + d.votes + "</span>";
  })

var svg = d3.select(id).append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .attr("class", "chart")

  .append("g")
    .attr("transform", "translate(" + (margin.left+150) + "," + margin.top + ")");

svg.call(tip);

var subset = datas[0].chart2.filter(
                        function(e){
                            return e.author == author;
                        });
var data=[];
for( i = 0; i < subset.length; i++)
{
    data.push(type(subset[i]));
}
// console.log(data);
// data = type(subset);
// d3.tsv("data.tsv", type, function(error, data) {
//   console.log('format.tsv');
//   console.log(data);

  x.domain(data.map(function(d) { return d.released; }));
  y.domain([0, d3.max(data, function(d) { return d.votes; })]);
  auxY.domain([0, d3.max(data, function(d) { return d.votes; })]);
  
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
      .text("Number of Votes");

 svg.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.released); })
      .attr("width", x.rangeBand())
      .attr("y", height)
      .attr("height", 0)
      .transition()
      .delay(function (d, i) { return i*100; })
      .attr("y", function (d, i) { return height-auxY(d.votes); })
      .attr("height", function (d) { return auxY(d.votes); });
     

  d3.select('svg.chart')
    .selectAll('.bar')
    .on('mouseover', tip.show)
    .on('mouseout', tip.hide)
    .on('click', function(){
      d3.select(id+' svg').remove();
      console.log("eu");
      console.log(datas);
      rank10Autores(datas, id, site);
    });

// });



function type(d) {
  // if()
  console.log('type');
  console.log(d);
  // d.released = +d.released;
  d.votes = +d.votes;
  // d.frequency = +d.frequency;

  console.log(d);
  return d;
}
}

/*
People.php
*/
function rank10Autores(dat, id, site){

console.log(dat);
var dats = dat;
// change
datas = dat[0].chart1;

// console.log(site);
var dat = [];
var cat = [];
var ticks = []
for (i=0; i < datas.length; i++)
{
   // console.log(Math.round(datas[i].value));
   // console.log(datas[i].label);
   cat.push(datas[i].label);
   dat.push(Math.round(datas[i].value));
}


// console.log(d3.sum(dat));
var test = dat.map(abbreviateNumber);
// console.log(test);



var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d,i) {
    console.log(x(d));
    return "<strong>Votes AVG : </strong><span style='color:red'>"+ dat[i]+ "</span>";
  });

var left_width = 200;

var width = 900;;

var bar_w = 650,
    bar_h = 45,
    label_padding = 26,
    bar_padding = 5;
  
var height = (bar_h + bar_padding * 2) * cat.length;

var x = d3.scale.linear()
      .domain([0, d3.max(dat)])
      .rangeRound([0, bar_w]);

ticks = x.ticks(10);

var y = d3.scale.linear()
       .domain([0, 1])
       .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

var chart = d3.select(id).append("svg")
     .attr("class", "chart")
     .attr("width", width)
     .attr("height", (bar_h + bar_padding) * dat.length+30)
          // .attr("height", 1050)
     .append("g")
     .attr("transform", "translate(10, 20)");

chart.call(tip);

chart.selectAll("rect")
 .data(dat)
 .enter()
 .append("rect")
 .attr("class", "bar")
 .attr("height", bar_h)
 .attr("width", 0)
 .attr("x", function(d, i) { return left_width; })
 .attr("y", function(d, i) { return y(i) - .5; })
 .transition().delay(function (d,i){ return i * 600;})
 .duration(800)
 .attr("width", function(d) { return x(d); });

var rect = d3.select('svg.chart')
            .selectAll('.bar')
            .on('mouseover', tip.show)
            .on('mouseout', tip.hide)
            .on('click', function(d,i){
              d3.select(id+' svg').remove();
              console.log(cat[i])
              // console.log('here');
              // console.log(dats);
              vertBar(dats,id, site, cat[i]);
            });


chart.selectAll("line")
  .data(x.ticks(10))
  .enter().append("line")
  .attr("x1", function(d) { return x(d) + left_width; })
  .attr("x2", function(d) { return x(d) + left_width; })
  .attr("y1", 0)
  .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

chart.selectAll(".rule")
  .data(x.ticks(10))
  .enter().append("text")
  .attr("class", "rule")
  .attr("x", function(d,i) { return x(d) + left_width; })
  .attr("y", 0)
  .attr("dy", -6)
  .attr("text-anchor", "middle")
  .attr("font-size", 10)
  .text(function(d,i) { return abbreviateNumber(ticks[i]); });

chart.selectAll("text.values")
 .data(dat)
 .enter().append("text")
 .attr("width", bar_w)
 .attr("x", function(d) { return x(d) + left_width; })
 .attr("y", function(d, i) {
    return y(i) + bar_h/2; })
 .attr("dx", -5)
 .attr("dy", ".36em")
 .attr("text-anchor", "end")
 .transition().delay(function (d,i){ return i * 600;})
 .duration(800);
 // .text(function(d,i) { return abbreviateNumber(dat[i]); });
 

chart.selectAll("text.name")
  .data(cat)
  .enter().append("text")
  .attr("x", left_width-10)
  .attr("y", function(d, i){ 
    return y(i) + bar_h/2; } )
 .attr("dx", -5)
 .attr("dy", ".36em")
 .attr("text-anchor", "end")
  .attr('class', 'name')
  .text(String);
}

/*
Mangas.php
Dez melhores
*/
function rankPop(datas, id, site, filter){
  console.log(datas);
  var dat = [];
  var cat = [];
  var ticks = []
  for (i=0; i < 10; i++)
  {
     // console.log(datas[i].value);
     if(site == "mangafox"){
       console.log(site);
       // console.log(datas[i].label);
       cat.push(datas[0].mangafox[i].name);
       dat.push(Number(datas[0].mangafox[i].value));
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(Number(datas[0].mangahere[i].value));
     }
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var tips = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
      console.log(x(d));
      return "<strong>Number of Visualizations: </strong><span style='color:red'>"+ dat[i]+ "</span>";
    });

  var left_width = 200;

  var width = 950;;

  var bar_w = 650,
      bar_h = 45,
      label_padding = 26,
      bar_padding = 5;
    
  var height = (bar_h + bar_padding * 2) * cat.length;
  var x = d3.scale.linear()
        .domain([0, d3.max(dat)])
        .rangeRound([0, bar_w]);
  
  ticks = x.ticks(10);

  var y = d3.scale.linear()
         .domain([0, 1])
         .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

  var chart = d3.select(id).append("svg")
       .attr("class", "chart")
       .attr("width", width)
       .attr("height", (bar_h + bar_padding) * dat.length+30)
            // .attr("height", 1050)
       .append("g")
       .attr("transform", "translate(80, 20)");

  chart.call(tips);

  chart.selectAll("rect")
   .data(dat)
   .enter()
   .append("rect")
   .attr("class", "bar")
   .attr("height", bar_h)
   .attr("width", 0)
   .attr("x", function(d, i) { return left_width; })
   .attr("y", function(d, i) { return y(i) - .5; })
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .attr("width", function(d) { return x(d); });

  var rect = d3.select('svg')
              .selectAll('.bar')
              .on('mouseover', tips.show)
              .on('mouseout', tips.hide);

  // console.log(rect);

  chart.selectAll("line")
    .data(x.ticks(10))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(10))
    .enter().append("text")
    .attr("class", "rule")
    .attr("x", function(d,i) { return x(d) + left_width; })
    .attr("y", 0)
    .attr("dy", -6)
    .attr("text-anchor", "middle")
    .attr("font-size", 10)
    .text(function(d,i) { return abbreviateNumber(ticks[i]); });

  chart.selectAll("text.values")
   .data(dat)
   .enter().append("text")
   .attr("width", bar_w)
   .attr("x", function(d) { return x(d) + left_width; })
   .attr("y", function(d, i) {
      return y(i) + bar_h/2; })
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .text(function(d,i) { return abbreviateNumber(dat[i]); });
   

  chart.selectAll("text.name")
    .data(cat)
    .enter().append("text")
    .attr("x", left_width-10)
    .attr("y", function(d, i){ 
      return y(i) + bar_h/2; } )
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
    .attr('class', 'name')
    .text(String);
}

/*
Mangas.php
Dez piores
*/
function rankWorst(datas, id, site, filter){
  // console.log(datas);
  var dat = [];
  var cat = [];
  var ticks = []
  for (i=0; i < 10; i++)
  {
     // console.log(datas[i].value);
     if(site == "mangafox"){
       console.log(site);
       // console.log(datas[i].label);
       cat.push(datas[0].mangafox[i].name);
       dat.push(Number(datas[0].mangafox[i].value));
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(Number(datas[0].mangahere[i].value));
     }
     // ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);
  console.log("AAAA"+d3.max(dat));
  console.log(dat);
  // var data = [];
  // for (i=0; i < dat.length; i++)
  // {
  //    data.push((dat[i]/d3.sum(dat))*100);
  // }
  var tipw = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
      console.log(x(d));
      return "<strong>Number of Visual: </strong><span style='color:red'>"+ dat[i]+ "</span>";
    });

  var left_width = 200;

  var width = 950;;

  var bar_w = 650,
      bar_h = 45,
      label_padding = 26,
      bar_padding = 5;
    
  var height = (bar_h + bar_padding * 2) * cat.length;
  var x = d3.scale.linear()
        .domain([0,  d3.max(dat, function(d) { console.log(d); return d })])
        .rangeRound([0, bar_w]);
  
  ticks = x.ticks();

  var y = d3.scale.linear()
         .domain([0, 1])
         .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

  var chart = d3.select(id).append("svg")
       .attr("class", "chart")
       .attr("width", width)
       .attr("height", (bar_h + bar_padding) * dat.length+30)
            // .attr("height", 1050)
       .append("g")
       .attr("transform", "translate(80, 20)");

  chart.call(tipw);

  chart.selectAll("rect")
   .data(dat)
   .enter()
   .append("rect")
   .attr("class", "bar")
   .attr("id", 'worst')
   .attr("height", bar_h)
   .attr("width", 0)
   .attr("x", function(d, i) { return left_width; })
   .attr("y", function(d, i) { return y(i) - .5; })
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .attr("width", function(d) { return x(d); });

  var rect = d3.select(id + ' svg')
              .selectAll('#worst')
              .on('mouseover', tipw.show)
              .on('mouseout', tipw.hide);

  console.log(rect);

  chart.selectAll("line")
    .data(x.ticks(10))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(10))
    .enter().append("text")
    .attr("class", "rule")
    .attr("x", function(d,i) { return x(d) + left_width; })
    .attr("y", 0)
    .attr("dy", -6)
    .attr("text-anchor", "middle")
    .attr("font-size", 10)
    .text(function(d,i) { return abbreviateNumber(ticks[i]); });

  chart.selectAll("text.values")
   .data(dat)
   .enter().append("text")
   .attr("width", bar_w)
   .attr("x", function(d) { return x(d) + left_width; })
   .attr("y", function(d, i) {
      return y(i) + bar_h/2; })
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .text(function(d,i) { return abbreviateNumber(dat[i]); });
   

  chart.selectAll("text.name")
    .data(cat)
    .enter().append("text")
    .attr("x", left_width-10)
    .attr("y", function(d, i){ 
      return y(i) + bar_h/2; } )
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
    .attr('class', 'name')
    .text(String);
}

function rankWorstPublisher(datas, id, site, filter){
  // console.log(datas);
  var dat = [];
  var cat = [];
  var ticks = []
  for (i=0; i < 10; i++)
  {
     // console.log(datas[i].value);
     if(site == "mangafox"){
       console.log(site);
       // console.log(datas[i].label);
       cat.push(datas[0].mangafox[i].name);
       dat.push(datas[0].mangafox[i].value);
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(datas[0].mangahere[i].value);
     }
     // ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
     data.push((dat[i]/d3.sum(dat))*100);
  }
  // console.log('bbbb');
  var tipw = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
      // console.log('aaaaaa');
      console.log(x(d));
      return "<strong>Number of Votes: </strong><span style='color:red'>"+ dat[i]+ "</span>";
    });

  var left_width = 200;

  var width = 950;;

  var bar_w = 650,
      bar_h = 45,
      label_padding = 26,
      bar_padding = 5;
    
  var height = (bar_h + bar_padding * 2) * cat.length;
  var x = d3.scale.linear()
        .domain([0, d3.max(dat)])
        .rangeRound([0, bar_w]);

  
  ticks = x.ticks(10);

  var y = d3.scale.linear()
         .domain([0, 1])
         .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

  var chart = d3.select(id).append("svg")
       .attr("class", "chart")
       .attr("width", width)
       .attr("height", (bar_h + bar_padding) * dat.length+30)
            // .attr("height", 1050)
       .append("g")
       .attr("transform", "translate(80, 20)");

  chart.call(tipw);

  chart.selectAll("rect")
   .data(dat)
   .enter()
   .append("rect")
   .attr("class", "bar")
   .attr("id", 'worstPublishers')
   .attr("height", bar_h)
   .attr("width", 0)
   .attr("x", function(d, i) { return left_width; })
   .attr("y", function(d, i) { return y(i) - .5; })
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .attr("width", function(d) { return x(d); });

  var rect = d3.select(id + ' svg')
              .selectAll('#worstPublishers')
              .on('mouseover', tipw.show)
              .on('mouseout', tipw.hide);

  // console.log(rect);

  chart.selectAll("line")
    .data(x.ticks(10))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(10))
    .enter().append("text")
    .attr("class", "rule")
    .attr("x", function(d,i) { return x(d) + left_width; })
    .attr("y", 0)
    .attr("dy", -6)
    .attr("text-anchor", "middle")
    .attr("font-size", 10)
    .text(function(d,i) { return abbreviateNumber(ticks[i]); });

  chart.selectAll("text.values")
   .data(dat)
   .enter().append("text")
   .attr("width", bar_w)
   .attr("x", function(d) { return x(d) + left_width; })
   .attr("y", function(d, i) {
      return y(i) + bar_h/2; })
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .text(function(d,i) { return abbreviateNumber(dat[i]); });
   

  chart.selectAll("text.name")
    .data(cat)
    .enter().append("text")
    .attr("x", left_width-10)
    .attr("y", function(d, i){ 
      return y(i) + bar_h/2; } )
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
    .attr('class', 'name')
    .text(String);
}

function rankPublisher(datas, id, site, filter){
  var dat = [];
  var cat = [];
  var ticks = []
  for (i=0; i < 10; i++)
  {
     // console.log(datas[i].value);
     if(site == "mangafox"){
       console.log(site);
       // console.log(datas[i].label);
       cat.push(datas[0].mangafox[i].name);
       dat.push(datas[0].mangafox[i].value);
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(datas[0].mangahere[i].value);
     }
     // ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
    if(i == 0)
      data.push(500000);
    else
      data.push(dat[i]);
  }
  var tipw = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
      // console.log(x(d));
      return "<strong>Number of Votes: </strong><span style='color:red'>"+ dat[i]+ "</span>";
    });

  var left_width = 200;

  var width = 950;;

  var bar_w = 650,
      bar_h = 45,
      label_padding = 26,
      bar_padding = 5;
    
  var height = (bar_h + bar_padding * 2) * cat.length;
  var x = d3.scale.linear()
        .domain([0, d3.max(data)])
        .rangeRound([0, bar_w]);
  
  ticks =d3.scale.linear()
        .domain([0, d3.max(dat)])
        .rangeRound([0, bar_w]).ticks(10);

  var y = d3.scale.linear()
         .domain([0, 1])
         .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

  var chart = d3.select(id).append("svg")
       .attr("class", "chart")
       .attr("width", width)
       .attr("height", (bar_h + bar_padding) * data.length+30)
            // .attr("height", 1050)
       .append("g")
       .attr("transform", "translate(80, 20)");

  chart.call(tipw);

  chart.selectAll("rect")
   .data(data)
   .enter()
   .append("rect")
   .attr("class", "bar")
   .attr("id", 'publisher')
   .attr("height", bar_h)
   .attr("width", 0)
   .attr("x", function(d, i) { return left_width; })
   .attr("y", function(d, i) { return y(i) - .5; })
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .attr("width", function(d) { return x(d); });

  var rect = d3.select(id + ' svg')
              .selectAll('#publisher')
              .on('mouseover', tipw.show)
              .on('mouseout', tipw.hide);

  console.log(rect);

  chart.selectAll("line")
    .data(x.ticks(10))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(10))
    .enter().append("text")
    .attr("class", "rule")
    .attr("x", function(d,i) { return x(d) + left_width; })
    .attr("y", 0)
    .attr("dy", -6)
    .attr("text-anchor", "middle")
    .attr("font-size", 10)
    .text(function(d,i) { return abbreviateNumber(ticks[i]); });

  chart.selectAll("text.values")
   .data(data)
   .enter().append("text")
   .attr("width", bar_w)
   .attr("x", function(d) { return x(d) + left_width; })
   .attr("y", function(d, i) {
      return y(i) + bar_h/2; })
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
   .transition().delay(function (d,i){ return i * 600;})
   .duration(800)
   .text(function(d,i) { return abbreviateNumber(dat[i]); });
   

  chart.selectAll("text.name")
    .data(cat)
    .enter().append("text")
    .attr("x", left_width-10)
    .attr("y", function(d, i){ 
      return y(i) + bar_h/2; } )
   .attr("dx", -5)
   .attr("dy", ".36em")
   .attr("text-anchor", "end")
    .attr('class', 'name')
    .text(String);
}