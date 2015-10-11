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

/*
People.php
*/

function rank10Autores(datas, id){

var dat = [];
var cat = [];
var ticks = []
for (i=0; i < datas.length; i++)
{
   console.log(datas[i].value);
   // console.log(datas[i].label);
   cat.push(datas[i].label);
   dat.push(datas[i].value);
   ticks.push(281323*i);
}
// console.log(d3.sum(dat));
var test = dat.map(abbreviateNumber);
console.log(test);

var data = [];
for (i=0; i < dat.length; i++)
{
   data.push(dat[i]/d3.sum(dat)*100);
}

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d,i) {
    console.log(x(d));
    return "<strong>Number of Votes: </strong><span style='color:red'>"+ dat[i]+ "</span>";
  });

var left_width = 200;

var width = 900;;

var bar_w = 650,
    bar_h = 45,
    label_padding = 26,
    bar_padding = 5;
  
var height = (bar_h + bar_padding * 2) * cat.length;
var x = d3.scale.linear()
      .domain([0, d3.max(data)])
      .rangeRound([0, bar_w]);
  
var y = d3.scale.linear()
       .domain([0, 1])
       .range([0, bar_h + bar_padding]); // rangeRound to avoid antialiasing artifacts.

var chart = d3.select(id).append("svg")
     .attr("class", "chart")
     .attr("width", width)
     .attr("height", (bar_h + bar_padding) * data.length+30)
          // .attr("height", 1050)
     .append("g")
     .attr("transform", "translate(10, 20)");

chart.call(tip);

chart.selectAll("rect")
 .data(data)
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
            .on('mouseover', tip.show)
            .on('mouseout', tip.hide);

console.log(rect);

chart.selectAll("line")
  .data(x.ticks(6))
  .enter().append("line")
  .attr("x1", function(d) { return x(d) + left_width; })
  .attr("x2", function(d) { return x(d) + left_width; })
  .attr("y1", 0)
  .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

chart.selectAll(".rule")
  .data(x.ticks(6))
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
       dat.push(datas[0].mangafox[i].value);
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(datas[0].mangahere[i].value);
     }
     ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
     data.push(dat[i]/d3.sum(dat)*100);
  }

  var tips = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
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
        .domain([0, d3.max(data)])
        .rangeRound([0, bar_w]);
    
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

  chart.call(tips);

  chart.selectAll("rect")
   .data(data)
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
    .data(x.ticks(6))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(6))
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
       dat.push(datas[0].mangafox[i].value);
     }
     else
     {
        console.log(site);
        cat.push(datas[0].mangahere[i].name);
        dat.push(datas[0].mangahere[i].value);
     }
     ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
     data.push(dat[i]/d3.sum(dat)*100);
  }
  console.log('bbbb');
  var tipw = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d,i) {
      console.log('aaaaaa');
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
        .domain([0, d3.max(data)])
        .rangeRound([0, bar_w]);
    
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
    .data(x.ticks(6))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(6))
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
     ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
     data.push(dat[i]/d3.sum(dat)*100);
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
        .domain([0, d3.max(data)])
        .rangeRound([0, bar_w]);
    
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
    .data(x.ticks(6))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(6))
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
     ticks.push(281323*i);
  }
  // console.log(d3.sum(dat));
  var test = dat.map(abbreviateNumber);
  console.log(test);

  var data = [];
  for (i=0; i < dat.length; i++)
  {
     data.push(dat[i]/d3.sum(dat)*100);
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
    .data(x.ticks(6))
    .enter().append("line")
    .attr("x1", function(d) { return x(d) + left_width; })
    .attr("x2", function(d) { return x(d) + left_width; })
    .attr("y1", 0)
    .attr("y2",  (bar_h + bar_padding * 2) * cat.length-40);

  chart.selectAll(".rule")
    .data(x.ticks(6))
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