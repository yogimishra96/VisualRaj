
// defining the map div with the id "map_strip"
var map_block = d3.select("body")
        .select(".mapContain")
//.append("div")
//.attr("id", "map_strip");
// width and height of the svg viewport
var width = 530 * 1.2, height = 491 * 1.2;
// initializing the zoom behaviour, call the event listeneer zoomFunction when a zoom is detected
var zoom = d3.behavior.zoom()
        .scaleExtent([1, 8])
        .on("zoom", zoomFunction)
// defining the projection for map (change center and scale to get desired size for the map)
var projection = d3.geoMercator()
        .center([76.58, 27.5])
        .scale([200 * 14]);
// defining the paths for the maps
var path = d3.geoPath().projection(projection);
// defining the svg view port for the map within the div
var svg = map_block//.append("div")
        //.classed("map_box_div", true)
        .append("svg")
        //.attr("width", width)
        //.attr("height", height)
        .attr("preserveAspectRatio", "xMinYMin meet")
        .attr("viewBox", "0 0 " + width + " " + height)
        .style("fill-opacity", 1)
        .classed("map_in_a_box", "true")
        .append("g")
        .classed("map_group", "true");
d3.json("topojson/rajasthan_districts.topojson", function (error, topology) { // <-A
    svg.selectAll("path")
            .data(topojson.feature(topology, topology.objects.Rajasthan).features)
            .enter().append("path")
            .attr("d", function (d, i) {
                return path(d)
            })
            .style("fill-opacity", 1)
            //.style("stroke", "grey")
            .style("stroke", "white")
            .style("stroke-width", 0.2)
            //.style("fill", "#9E9E9E")
            //.style("fill", "#A7FFEB")
            //.style("fill", "#1DE9B6")
            //.style("fill", "#64FFDA")
            //.style("fill", "#81C784")
            .style("fill", "#66BB6A")
            .style("fill-opacity", 0.9)
            .attr("class", "district");
    svg.call(zoom);
    // get the terrorism data in

    d3.csv('csv/tourism_data_1.csv', function (data_tourism) {
        function update_points(year) {
            console.log(year);
            // console.log(data_tourism);
            //var sum_n_inc = data_tourism.length;

            var total_tourists_count = data_tourism.map(function (d) {
              var total = 0;
                switch(year){
                    case '2014':{
                        total = parseInt(d['2014_videshi']) + parseInt(d['2014_local']);
                        break;
                    }
                    case '2015':{
                         total = parseInt(d['2015_videshi']) + parseInt(d['2015_local']);
                        break;    
                    }
                    case '2016':{
                         total = parseInt(d['2016_videshi']) + parseInt(d['2016_local']);
                        break;
                    }
                    case '2017':{
                         total = parseInt(d['2017_videshi']) + parseInt(d['2017_local']);
                        break;    
                    }
                }
              
                return +total; // +d.nkill;
            }).reduce((a, b) => a + b, 0);
            // var total_tourists_count = total_tourists.);

            // replacing the values on the monitor
            // d3.select("#n_inc").text(sum_n_inc);
            // d3.select("#n_kill").text(sum_n_kill);
            // d3.select("#n_wound").text(sum_n_wound);

            interp_text_transit("#total_tourists_count", 1000, total_tourists_count)
            interp_text_transit("#total_foreign_count", 1000, total_tourists_count)
            interp_text_transit("#total_local_count", 1000, total_tourists_count)
            interp_text_transit("#total_growth_from_previous", 1000, total_tourists_count)


            svg.selectAll("circle").remove()
            svg.selectAll("path")
                    .attr("transform", "translate(0, 0)" + " scale(1)");
            svg.selectAll("circle")
                    .data(data_tourism.filter(function (d) {
                        return d; //(d.iyear == year && (d.attacktype1 == 3 | d.attacktype2 == 3));
                    }))
                    .enter()
                    .append("circle")
                    .attr("cx", function (d, i) {
                        console.log(d);
                        return projection([+d.long, +d.lat])[0]
                    })
                    .attr("cy", function (d, i) {
                        return projection([+d.long, +d.lat])[1]
                    })
                    .attr("fill", "brown")
                    //.attr("r", 0)
                    .attr("r", 0)
                    .transition()
                    .duration(1000)
                    .ease(d3.easeCubic)
                    .attr("r", function (d, i) {
                        console.log(d);
                        // code here for bubble radus
                        return 2 + (0.5 * (12));
                    })

            svg.selectAll("circle")
                    .on("mouseover", function (d, i) {
                        //this.parentNode.appendChild(this);//the path group is on the top with in its parent group
                        d3.select(this).style('stroke', 'black');
                        d3.select(this).style("stroke-width", 2);
                        d3.select(this).style("stroke-opacity", 1);
                        d3.select(this).style("fill-opacity", 0.75);
                   
                        d3.select("#city")
                                .text(d3.select(this).data().map(
                                        function (d) {
                                            return "Development In Progress";
                                        }))
                        d3.select("#loc")
                                .text(d3.select(this).data().map(
                                        function (d) {
                                            return d.location ? d.location : "Development In Progress";
                                        }))
                        
                        d3.select(".values").classed("display", true)
                    })
                    .on("mouseout", function () {
                        d3.select(this).style("stroke", "none");
                        //d3.select(this).style("stroke-width", 0.15);
                        d3.select(this).style("fill-opacity", 0.5);
                        d3.select(".values").classed("display", false)
                    });
        }


        update_points(document.getElementById("input_year_select").value);
        d3.select("#input_year_select").on("input", function () {
            update_points(+this.value);
        });
    })
});
function zoomFunction() {
    // get the requisite params to be used in translation of paths when zoomed
    // panning params
    var panVector = d3.event.translate;
    // zooming params
    var scaleMultiplier = d3.event.scale;
    d3.selectAll("path")
            .attr("transform", "translate(" + panVector + ") " + "scale(" + scaleMultiplier + ")");
    d3.selectAll("circle")
            .attr("transform", "translate(" + panVector + ") " + "scale(" + scaleMultiplier + ")");
}
