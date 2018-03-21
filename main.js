
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
var global_dataPoints = 0;

d3.json("topojson/rajasthan_districts.topojson", function (error, topology) { // <-A
    // read in the district level data
    d3.csv("csv/1991_2001_2011_cencus.csv", function (dist_data) {
        d3.select("#input_year_select").on("change", function () {
            update_choropleth(+this.value);
        });
        //console.log(dist_data);
        // var dist_data_sub_att = dist_data_sub.filter(function(d){
        //   return (d.district == "Attock");
        // })
        // .map(function(d){
        //   return +d.sum_kill;
        // });
        // console.log(dist_data);
        // console.log(dist_data);
                
        var max_total = dist_data.map(function (d) {
//            console.log(d);
            var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
            return +total;
        });
        
        //console.log(max_total);
        var max_total = d3.max(max_total);
        
        
        //max_total = max_total/1000000;
        // define color scale for the heat map
        var linearScale_min1 = d3.scaleLinear()
                .domain([0, max_total])
                .range([0, 500])

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
                .attr("class", "place-label")
                .style("opacity", 1)
                .style("stroke", "white")
                .style("stroke-width", 0.2)
                .style("fill", "#FB8C00")
                .text(function (d) {
                    return d.properties.Dist_Name;
                });

        function update_choropleth(year) {
            console.log(year);
            d3.selectAll("path")
                    .attr("transform", "translate(0, 0) " + "scale(1)");
            // filtering the data based on year and district
            //console.log(dist_data);
            // Need when filter with year
             var dist_data_sub = dist_data.filter(function (d) {
                 return (d.year == year);
             })
            
            //  remove below line
            //dist_data_sub = dist_data;

            var t_male = dist_data_sub.map(function (d) {
                var tot = parseInt(d.males_rural) + parseInt(d.males_urban);
                return +tot;
            })

            //var sum_n_inc = n_inc.reduce((a, b) => a + b, 0);
            var t_female = dist_data_sub.map(function (d) {
                var tot = parseInt(d.females_rural) + parseInt(d.females_urban);
                return +tot;
            })

            total_female = t_female.reduce((a, b) => a + b, 0);
            total_male = t_male.reduce((a, b) => a + b, 0);
            total_population = total_female + total_male;
            
            
                var data_1991_population = dist_data.filter(function (data) {
                //   return (data.district == district_name);
                    return (data.year == 1991);
               }).map(function (d) {
                   var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                   return +total;
               }).reduce((a, b) => a + b, 0);

                var data_2001_population = dist_data.filter(function (data) {
                     return (data.year == 2001);
                }).map(function (d) {
                    var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                    return +total;
                }).reduce((a, b) => a + b, 0);
                        
                var data_2011_population = dist_data.filter(function (data) {
                     return (data.year == 2011);
                }).map(function (d) {
                    var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                    return +total;
                }).reduce((a, b) => a + b, 0);
                        
                global_dataPoints = [  
                                {label: "1991", y: (data_1991_population/1000000)},
                                {label: "2001", y: (data_2001_population/1000000)},
                                {label: "2011", y: (data_2011_population/1000000)}
                                    ];
                                    
                console.log(global_dataPoints);
                updateChartAccordingToDistrict(global_dataPoints);
                 

            interp_text_transit("#total_population", 1000, total_population)
            interp_text_transit("#total_female", 1000, total_female)
            interp_text_transit("#total_male", 1000, total_male)
            interp_text_transit("#total_infant", 1000, total_male)

            svg.selectAll("path")
                    // .on("mouseover", null)
                    // .on("mouseout", null)
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
                        
                               updateChartAccordingToDistrict(global_dataPoints);

                    }) 
                    .on('click', function (d, i) {
                        
                    })
                    .on("mouseenter", function (d, i) {
                        //console.log("Hello");

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
                        var year = document.getElementById("input_year_select").value;

                        var rel_data = dist_data.filter(function (data) {
                         //   return (data.district == district_name);
                             return (data.year == year && data.district == district_name);
                        });
                        
                     
                        var data_1991_total = dist_data.filter(function (data) {
                         //   return (data.district == district_name);
                             return (data.year == 1991 && data.district == district_name);
                        }).map(function (d) {
                            var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                            return +total;
                        }).reduce((a, b) => a + b, 0);
                        
                        var data_2001_total = dist_data.filter(function (data) {
                             return (data.year == 2001 && data.district == district_name);
                        }).map(function (d) {
                            var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                            return +total;
                        }).reduce((a, b) => a + b, 0);
                        
                        var data_2011_total = dist_data.filter(function (data) {
                             return (data.year == 2011 && data.district == district_name);
                        }).map(function (d) {
                            var total = parseInt(d.person_rural) + parseInt(d.persons_urban);
                            return +total;
                        }).reduce((a, b) => a + b, 0);
                        
                        dataPoints = [  
                                        {label: "1991", y: (data_1991_total/1000000)},
                                        {label: "2001", y: (data_2001_total/1000000)},
                                        {label: "2011", y: (data_2011_total/1000000)}
                                    ];
                        updateChartAccordingToDistrict(dataPoints);
                 
                        
                        var sum_total = 0;
                        var sum_male = rel_data.map(function (d) {
                            var tot = parseInt(d.males_rural) + parseInt(d.males_urban);
                            return  +tot
                        });
                        var sum_female = rel_data.map(function (d) {
                            var tot = parseInt(d.females_rural) + parseInt(d.females_urban);
                            return  +tot;
                        });
                        var sum_infant = rel_data.map(function (d) {
                            var tot = parseInt(d.six_persons_rural) + parseInt(d.six_persons_urban);
                            return  +tot;
                        });

                        var rural_infant = rel_data.map(function (d) {
                            var tot = parseInt(d.six_persons_rural);
                            return  +tot;
                        });
                        var urban_infant = rel_data.map(function (d) {
                            var tot = parseInt(d.six_persons_urban);
                            return  +tot;
                        });
                        // total rural females
                        var rural_females = rel_data.map(function (d) {
                            var tot = parseInt(d.females_rural);
                            return  +tot;
                        });

                        var urban_females = rel_data.map(function (d) {
                            var tot = parseInt(d.females_urban);
                            return  +tot;
                        });

                        var rural_males = rel_data.map(function (d) {
                            var tot = parseInt(d.males_rural);
                            return  +tot;
                        });

                        var urban_males = rel_data.map(function (d) {
                            var tot = parseInt(d.males_urban);
                            return  +tot;
                        });

                        sum_total = parseInt(sum_male) + parseInt(sum_female);

                        if (isNaN(sum_total)) {
                            sum_total = 0;
                        }

                        interp_text_transit("#total_population", 1000, sum_total)
                        interp_text_transit("#total_female", 1000, sum_female)
                        interp_text_transit("#total_male", 1000, sum_male)
                        interp_text_transit("#total_infant", 1000, sum_infant)


                        tooltip.html('<span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">\n\
                                        District: </span>' + district_name + '</span>\n\
                                        <span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Rural Male: </span>" + rural_males + '</span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Urban Male: </span>" + urban_males + '</span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Rural female: </span>" + rural_females + '</span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Urban Female: </span>" + urban_females + '</span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Rural Infants: </span>" + rural_infant + '</span>\n\
                                        <span style="font-weight:600; color: #FFEB3B;">' + "Urban Infants: </span>" + urban_infant + '</span>\n\
                                        \n\
                                        <span><span style="font-weight:600; color: #FFEB3B;">' + "Total: </span>" + sum_total + '</span>')
                                .style("left", (d3.event.pageX) + "px")
                                .style("top", (d3.event.pageY + 20) + "px");
                        
                        
                     //    updateChartAccordingToDistrict(dataPointForChart);

                    })
                    .transition()
                    .style("fill", function (d, i) {
                        //     return '#FB8C00';
                        return dist_data_sub.filter(function (data) {
                            return (data.district == d.properties.Dist_Name);
                        }).map(function (data) {

                            var female_total = parseInt(data.females_urban) + parseInt(data.females_rural);
                            var male_total = parseInt(data.males_rural) + parseInt(data.males_urban);

                            var total = parseInt(female_total) + parseInt(male_total);

                            if (isNaN(total)) {
                                total = 0;
                            }

                            // console.log("linear scale"+linearScale_min1(total));
                            // console.log("log color scale"+ logColorScale(linearScale_min1(total)));
                            return (logColorScale(linearScale_min1(total)));
                        });

                    })
                    .style("opacity", 0.9)
                    .attr("class", "district");
            //.transition()
        }
        update_choropleth(document.getElementById("input_year_select").value);
        d3.select("#input_year_select").on("change", function () {
           // alert("hello");
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

      