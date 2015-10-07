// function rank10Autores(datas,id)
// {
//     console.log(datas);
//     nv.addGraph(function() {
//         var chart = nv.models.multiBarHorizontalChart()
//             .x(function(d) { return d.label })
//             .y(function(d) { return d.value })
//             .margin({top: 30, right: 10, bottom: 50, left: 295})            // .width(600)
//             // .height(500)
//             .showValues(true)           //Show bar value next to each bar.
//             // .tooltips(true)             //Show tooltips on hover.
//             // .transitionDuration(350)
//             .forceY([0,datas[0].values[0].value])
//             .showControls(false);        //Allow user to switch between "Grouped" and "Stacked" mode.


//         chart.tooltip.enabled(true);

//         // var thickMark = [0,1,2,3,4,5,6,7,8,9,10];
//         // chart.yAxis
//         // .tickValues(thickMark)
//         // .tickFormat(function(d){  return d; });

//         // chart.xAxis
//         //    .tickFormat(function(d){ return d/100 });
//         chart.groupSpacing(0.3);

//         d3.select(id)
//             .append("svg")
//             .attr("width", 900)
//             .attr("height", 550)
//             .datum(datas)
//             .transition()
//             .duration(350)
//             .call(chart);
//         //        var color = d3.scale().category20().range();
//         // d3.selectAll('.nv-bar')
//         // .style("fill", $("rect.d3plus_data", $('.div3')).eq(0).attr("fill"));
//         // console.log(previousColor);

//         nv.utils.windowResize(chart.update);

//         return chart;
//     });

// }
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

var tips = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    // console.log(d);
  return "<strong><a style='color:red'>"+ d+ "</a></strong>";
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

chart.selectAll("rect")
 .data(data)
 .enter()
 .append("rect")
 .attr("x", function(d, i) { return left_width; })
 .attr("y", function(d, i) { return y(i) - .5; })
 .attr("height", bar_h)
 .attr("width", 0)
 .transition().delay(function (d,i){ return i * 600;})
 .duration(800)
 .attr("width", function(d) { return x(d); });

chart.selectAll("rect")
    .on('mouseover', tips.show)
    .on('mouseout', tips.hide);

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