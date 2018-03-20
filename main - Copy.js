
// defining the map div with the id "map_strip"
var map_block = d3.select("body")
        .select(".mapContain")
//.append("div")
//.attr("id", "map_strip");
// width and height of the svg viewport
var width = 780 * 1.2;
var height = 550 * 1.2;
// defining the projection for map (change center and scale to get desired size for the map)
var projection = d3.geoMercator()
        .center([73.58, 27.5])
        .scale([350 * 14]);
// defining the paths for the maps
var path = d3.geoPath().projection(projection);
var zoom = d3.behavior.zoom()
        .scaleExtent([1, 8])
        .on("zoom", zoomFunction)
// defining the svg view port for the map within the div
var svg = map_block//.append("div")
        //.classed("map_box_div", true)
        .append("svg")
        //.attr("width", width)
        //.attr("height", height)
        .attr("preserveAspectRatio", "xMinYMin meet")
        .attr("viewBox", "0 0 " + width + " " + height)
        .style("opacity", 1)
        .classed("map_in_a_box", "true")
        .append("g")
        .classed("map_group", "true");

var tooltip = d3.select("body").append("div")
        .classed("tooltip", true)
        .style("opacity", 0);


var total_population = 0;
var total_female = 0;
var total_male = 0;
var total_infants = 0;

d3.json("topojson/rajasthan_districts.topojson", function (error, topology) { // <-A
    // read in the district level data
    d3.csv("csv/2011_cencus.csv", function (dist_data) {
        d3.select("#input_year").on("input", function () {
            update_choropleth(+this.value);
        });
        // var dist_data_sub_att = dist_data_sub.filter(function(d){
        //   return (d.district == "Attock");
        // })
        // .map(function(d){
        //   return +d.sum_kill;
        // });
        console.log(dist_data);
        var max_total = dist_data.map(function (d) {
            var total = parseInt(d.female) + parseInt(d.male);
            return +total;
        });
        var max_total = d3.max(max_total);

        console.log(max_total);

        // define color scale for the heat map
        var linearScale_min1 = d3.scaleLinear()
                .domain([0, max_total])
                .range([Math.exp(0), Math.exp(9)])

        var logColorScale = d3.scaleLog()
                .base(Math.E)
                .domain([Math.exp(0), Math.exp(9)])
                .range(["#FB8C00", "#B71C1C"]);

        svg.selectAll("path")
                .data(topojson.feature(topology, topology.objects.Rajasthan).features)
                .enter().append("path")
                .attr('id', function (d) {
                    return d.properties.Dist_Name;
                })
                .attr("d", function (d, i) {
                    return path(d)
                })
                .style("opacity", 1)
                .style("stroke", "white")
                .style("stroke-width", 0.2)
                .style("fill", "#FB8C00")
        function update_choropleth(year) {

            d3.selectAll("path")
                    .attr("transform", "translate(0, 0) " + "scale(1)");
            // filtering the data based on year and district
            var dist_data_sub = dist_data.filter(function (d) {
                return (d.iyear == year);
            })
            var t_male = dist_data_sub.map(function (d) {
                return  +d.male;
            })
            //var sum_n_inc = n_inc.reduce((a, b) => a + b, 0);
            var t_female = dist_data_sub.map(function (d) {
                return +d.female;
            })

            total_female = t_female.reduce((a, b) => a + b, 0);
            total_male = t_male.reduce((a, b) => a + b, 0);
            total_population = total_female + total_male;

            interp_text_transit("#total_population", 1000, total_population)
            interp_text_transit("#total_female", 1000, total_female)
            interp_text_transit("#total_male", 1000, total_male)
            interp_text_transit("#total_infant", 1000, total_male)

            svg.selectAll("path")
                    // .on("mouseover", null)
                    // .on("mouseout", null)
                    .on("mouseover", function (d, i) {
                        //    console.log(d);
                        this.parentNode.appendChild(this);//the path group is on the top with in its parent group
                        d3.select(this).style('stroke', 'black');
                        d3.select(this).style("stroke-width", 1.5);
                        d3.select(this).style("opacity", 1);

                        // logic for tooltip
                        tooltip.transition()
                                .duration(250)
                                .style("opacity", 0.9);
                        var district_name = d.properties.Dist_Name;
                        var district_code = d.properties.Dist_Code;
                        var year = document.getElementById("input_year").value;

                        var rel_data = dist_data.filter(function (data) {
                            return (data.iyear == year && data.district == district_name);
                        })
                        //console.log(rel_data);

                        var sum_male = rel_data.map(function (d) {
                            return d.male
                        });
                        var sum_female = rel_data.map(function (d) {
                            return d.female
                        });
                        var total = parseInt(sum_male) + parseInt(sum_female);

                        tooltip.html('<span>\n\
                                                                <span style="font-weight:600; color: #FFEB3B;">District: </span>' + district_name + '</span>\n\
                                                                <span>\n\
                                                                <span style="font-weight:600; color: #FFEB3B;">' + "Male: </span>" + sum_male + '</span>\n\
                                                                <span><span style="font-weight:600; color: #FFEB3B;">' + "Female: </span>" + sum_female + '</span>\n\
                                                                <span><span style="font-weight:600; color: #FFEB3B;">' + "Total: </span>" + total + '</span>')
                                .style("left", (d3.event.pageX) + "px")
                                .style("top", (d3.event.pageY + 20) + "px");
                    })
                    .on("mouseout", function () {
                        d3.select(this).style("stroke", "white");
                        d3.select(this).style("stroke-width", 0.2);
                        d3.select(this).style("opacity", 0.9);
                        
                        interp_text_transit("#total_population", 1000, total_population)
                        interp_text_transit("#total_female", 1000, total_female)
                        interp_text_transit("#total_male", 1000, total_male)
                        interp_text_transit("#total_infant", 1000, total_male)
                        // remove tooltip on mouseout
                        tooltip.transition()
                                .duration(500)
                                .style("opacity", 0);
                    })
                    .on("mouseenter", function (d, i) {
                        console.log("Hello");
                        var district_name = d.properties.Dist_Name;
                        var district_code = d.properties.Dist_Code;
                        var year = document.getElementById("input_year").value;

                        var rel_data = dist_data.filter(function (data) {
                            return (data.iyear == year && data.district == district_name);
                        });
                        
                        console.log(rel_data);
                        var sum_total = 0;
                        var sum_male = rel_data.map(function (d) {
                            return d.male
                        });
                        var sum_female = rel_data.map(function (d) {
                            return d.female
                        });
                        sum_total = parseInt(sum_male) + parseInt(sum_female);
                        
                        if(isNaN(sum_total)){
                            sum_total = 0;
                        }
                        console.log(sum_total);
                        interp_text_transit("#total_population", 1000, sum_total)
                        interp_text_transit("#total_female", 1000, sum_female)
                        interp_text_transit("#total_male", 1000, sum_male)
                        interp_text_transit("#total_infant", 1000, sum_male)

                    })
                    .transition()
                    .style("fill", function (d, i) {
                        //     return '#FB8C00';
                        return dist_data_sub.filter(function (data) {
                            return (data.district == d.properties.Dist_Name);
                        }).map(function (data) {

                            var total = parseInt(data.female) + parseInt(data.male);
                            (logColorScale(linearScale_min1(total)));
                            return (linearScale_min1(total));
                        });

                    })
                    .style("opacity", 0.9)
                    .attr("class", "district");
            //.transition()
        }
        update_choropleth(document.getElementById("input_year").value);
        d3.select("#input_year").on("input", function () {
            update_choropleth(+this.value);
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
}
      