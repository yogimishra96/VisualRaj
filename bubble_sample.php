<!DOCTYPE html>

<meta name="robots" content="noindex">
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://d3js.org/d3.v3.min.js"></script>
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title> map</title>
  <style id="jsbin-css">
    .whole-strip {
      align-items: center;
    }
    #title {
      text-align: center;
      font-weight: 600;
    }
    .label {
      font-family: sans-serif;
      font-size: 9px;
    }
    .label {
      font-family: sans-serif;
      font-size: 9px;
    }
    .legend-svg {
      display: block;
      margin: 0 auto;
    }
    svg {
      background: #FFF;
      fill-opacity: 0.99;
    }
  </style>
  <style>
    html, body {
      font-family: 'Roboto', sans-serif;
      will-change: transform;
      will-change: opacity;
      will-change: scroll-position;
    }

    .align {
      display: flex;
      align-items: flex-end;
    }

    .Note {
      font-family: 'Open Sans', sans-serif;
    }

    .navitem {
      display: flex;
    }
    .left {
      margin-left: 7px;
    }
    .right {
      margin-right: 7px;
    }

    .nav-wrapper {
      background-color: #E53935;
    }

    .topmargin {
      margin-top: 35px
    }

    .select {
      font-size: 16px;
      margin: 15px 0px 15px 0px;
      text-align: center;
    }
    .bar {
      padding: 0rem;
    }
    .dataSumm {
      display: flex;
    }
    .highlight {
      text-align: center;
    }
    .highTitle {
      font-size: 16px;
      font-family: 'Open Sans', sans-serif;
    }

    .highValue {
      font-size: 22px;
      font-family: 'Open Sans', sans-serif;
    }

    .boxTitle {
      padding-top: 10px;
      padding-bottom: 15px;
      margin-top: 15px;
    }

    .boxInfo {
      margin-top: 8px;
      margin-bottom: 8px;
      font-size: 14px;
      font-family: 'Open Sans', sans-serif;
    }

    .last {
      margin-bottom: 30px;
    }

    .animate1{
      animation: animationFrames ease 0.5s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      animation-fill-mode:forwards; /*when the spec is finished*/
      -webkit-animation: animationFrames ease 0.5s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -webkit-animation-fill-mode:forwards; /*Chrome 16+, Safari 4+*/
      -moz-animation: animationFrames ease 0.5s;
      -moz-animation-iteration-count: 1;
      -moz-transform-origin: 50% 50%;
      -moz-animation-fill-mode:forwards; /*FF 5+*/
      -o-animation: animationFrames ease 0.5s;
      -o-animation-iteration-count: 1;
      -o-transform-origin: 50% 50%;
      -o-animation-fill-mode:forwards; /*Not implemented yet*/
      -ms-animation: animationFrames ease 0.5s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%;
      -ms-animation-fill-mode:forwards; /*IE 10+*/
    }

    .animate2{
      animation: animationFrames ease 1.5s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      animation-fill-mode:forwards; /*when the spec is finished*/
      -webkit-animation: animationFrames ease 1.5s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -webkit-animation-fill-mode:forwards; /*Chrome 16+, Safari 4+*/
      -moz-animation: animationFrames ease 1.5s;
      -moz-animation-iteration-count: 1;
      -moz-transform-origin: 50% 50%;
      -moz-animation-fill-mode:forwards; /*FF 5+*/
      -o-animation: animationFrames ease 1.5s;
      -o-animation-iteration-count: 1;
      -o-transform-origin: 50% 50%;
      -o-animation-fill-mode:forwards; /*Not implemented yet*/
      -ms-animation: animationFrames ease 1.5s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%;
      -ms-animation-fill-mode:forwards; /*IE 10+*/
    }

    .animate3{
      animation: animationFrames ease 2.5s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      animation-fill-mode:forwards; /*when the spec is finished*/
      -webkit-animation: animationFrames ease 2.5s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -webkit-animation-fill-mode:forwards; /*Chrome 16+, Safari 4+*/
      -moz-animation: animationFrames ease 2.5s;
      -moz-animation-iteration-count: 1;
      -moz-transform-origin: 50% 50%;
      -moz-animation-fill-mode:forwards; /*FF 5+*/
      -o-animation: animationFrames ease 2.5s;
      -o-animation-iteration-count: 1;
      -o-transform-origin: 50% 50%;
      -o-animation-fill-mode:forwards; /*Not implemented yet*/
      -ms-animation: animationFrames ease 2.5s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%;
      -ms-animation-fill-mode:forwards; /*IE 10+*/
    }

    #year {
      font-size: 18px;
      text-align: right;
      color: #B71C1C;
    }

    @keyframes animationFrames{
      0% {
        opacity:0;
        transform:  translate(0px,-25px)  ;
      }
      100% {
        opacity:1;
        transform:  translate(0px,0px)  ;
      }
    }

    @-moz-keyframes animationFrames{
      0% {
        opacity:0;
        -moz-transform:  translate(0px,-25px)  ;
      }
      100% {
        opacity:1;
        -moz-transform:  translate(0px,0px)  ;
      }
    }

    @-webkit-keyframes animationFrames {
      0% {
        opacity:0;
        -webkit-transform:  translate(0px,-25px)  ;
      }
      100% {
        opacity:1;
        -webkit-transform:  translate(0px,0px)  ;
      }
    }

    @-o-keyframes animationFrames {
      0% {
        opacity:0;
        -o-transform:  translate(0px,-25px)  ;
      }
      100% {
        opacity:1;
        -o-transform:  translate(0px,0px)  ;
      }
    }

    @-ms-keyframes animationFrames {
      0% {
        opacity:0;
        -ms-transform:  translate(0px,-25px)  ;
      }
      100% {
        opacity:1;
        -ms-transform:  translate(0px,0px)  ;
      }
    }

    .fadeIn {
       -webkit-animation-name: fadeIn;
       animation-name: fadeIn;
       -webkit-animation-duration: 1s;
       animation-duration: 1s;
       -webkit-animation-fill-mode: both;
       animation-fill-mode: both;
    }
    @-webkit-keyframes fadeIn {
       0% {opacity: 0;}
       100% {opacity: 1;}
    }
    @keyframes fadeIn {
       0% {opacity: 0;}
       100% {opacity: 1;}
    }

    circle {
      fill-opacity: 0.5;
    }

    .page-footer {
      background-color: #757575;
    }

    @media only screen and (max-width: 480px) {
      .response {
        display: block;
      }
    }
    @media only screen and (max-width: 550px) {
      .highlight {
        display: none;
      }
    }

    @media only screen and (max-width: 780px) {
      .boxTitle {
        padding-top: 5px;
        padding-bottom: 5px;
        margin-top: 10px;
        font-size: 20px;
      }

      .boxInfo {
        margin-top: 2px;
        margin-bottom: 2px;
        font-size: 12px;
        font-family: 'Open Sans', sans-serif;
      }
    }

    .values {
      display: none;
    }

    .display {
      display: block;
      background-color: #757575;
      color: white;
      border-radius: 7.5px;
      -webkit-box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.75);
      -moz-box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.75);
      box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.75);
    }

    @media only screen and (max-width: 550px) {
      .display {
        display: none;
      }
    }
  </style>
</head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="right">Version: 0.0.1</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li class="navitem"><i class="material-icons left">my_location</i><a href="./Heatmap.html">Switch to Heat Map</a></li>

      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li class="navitem"><a href="./Heatmap.html">Switch to Heat Map</a></li>
      </ul>
    </div>
  </nav>

  <script>

      (function($){
        $(function(){

          $('.button-collapse').sideNav();

        }); // end of document ready
      })(jQuery); // end of jQuery name space

    $( document ).ready(function(){
      $(".button-collapse").sideNav();
    })
  </script>

  <div class="container topmargin">
    <div class="row">
        <div class="col s6 align">
          <div class="col s5 align response">
            <p class="col s8 select">Select Year: </p>
            <strong><p class="col s4" id="year"></p></strong>
          </div>
          <form action="#" class="col s7 bar">
              <p class="range-field">
                <input type="range" id="input_year" min="2000" max="2016" />
              </p>
          </form>
        </div>
        <div class="col s6 dataSumm">
          <div class="col s12 highlight animate1">
            <span class="highTitle">Total Incidents</span><br/>
            <span id="n_inc" class="highValue"><strong>0</strong></span>
          </div>
          <div class="col s12 highlight animate2">
            <span class="highTitle">Reported Deaths</span><br/>
            <span id="n_kill" class="highValue"><strong>0</strong></span>
          </div>
          <div class="col s12 highlight animate3">
            <span class="highTitle">Reported Injuries</span><br/>
            <span id="n_wound" class="highValue"><strong>0</strong></span>
          </div>
      </div>
    </div>


    <div class="row">
      <div class="mapContain col s8 animate2">
      </div>
      <div class="col s4 values fadeIn">
        <div class="col s12 boxTitle">
          <h4>Summary</h4>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Date: </span></strong><span id="date">12/12/2012</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>City: </span></strong><span id="city">Peshawar/KPK</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Location: </span></strong><span id="loc">Location</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Target: </span></strong><span id="target">Target</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Perpetrator: </span></strong><span id="perp">Perpetrator</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Reported Casualties: </span></strong><span id="dead">512</span>
        </div>
        <div class="col s12 boxInfo">
          <strong><span>Reported Wounded: </span></strong><span id="injured">345</span>
        </div>
        <div class="col s12 boxInfo last">
          <strong><span>Source: </span></strong><span id="src">DAWN</span>
        </div>
      </div>
    </div>

    <script>
      document.getElementById("input_year").value = 2016;
      var yearName = document.getElementById("year");
      var slider = document.getElementById("input_year");
      yearName.innerHTML = document.getElementById("input_year").value;

      slider.oninput = function() {
        yearName.innerHTML = this.value;
      }
    </script>

    <script id="jsbin-javascript">

      // defining the map div with the id "map_strip"
      var map_block = d3.select("body")
                        .select(".mapContain")
                        //.append("div")
                        //.attr("id", "map_strip");
      // width and height of the svg viewport
      var width = 530*1.2, height = 491*1.2;
      // initializing the zoom behaviour, call the event listeneer zoomFunction when a zoom is detected
      var zoom = d3.behavior.zoom()
                    .scaleExtent([1, 8])
                    .on("zoom", zoomFunction)
      // defining the projection for map (change center and scale to get desired size for the map)
      var projection = d3.geoMercator()
          .center([73.58, 31.5])
          .scale([150 * 14]);
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
      d3.json("topojson/sample.topojson", function (error, topology) { // <-A
          svg.selectAll("path")
                .data(topojson.feature(topology, topology.objects.pakistan_districts).features)
                .enter().append("path")
                .attr("d", function (d, i){ return path(d)})
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

          d3.csv('csv/globalterrorismdb_edited_sorted.csv', function(data_terror){
            function update_points(year){
              // filtering the data based on year and district
              var data_terror_sub = data_terror.filter(function(d){
                return (d.iyear == year);
              })

              var sum_n_inc = data_terror_sub.length;

              var n_kill = data_terror_sub.map(function(d){
                return +d.nkill;
              })
              var sum_n_kill = n_kill.reduce((a, b) => a + b, 0);

              var n_wound = data_terror_sub.map(function(d){
                return +d.nwound;
              })
              var sum_n_wound = n_wound.reduce((a, b) => a + b, 0);

              // replacing the values on the monitor
              // d3.select("#n_inc").text(sum_n_inc);
              // d3.select("#n_kill").text(sum_n_kill);
              // d3.select("#n_wound").text(sum_n_wound);

              interp_text_transit("#n_inc", 1000, sum_n_inc)
              interp_text_transit("#n_kill", 1000, sum_n_kill)
              interp_text_transit("#n_wound", 1000, sum_n_wound)


              svg.selectAll("circle").remove()
              svg.selectAll("path")
                  .attr("transform", "translate(0, 0)" + " scale(1)");
              svg.selectAll("circle")
                .data(data_terror.filter(function(d){
                  return (d.iyear == year && (d.attacktype1 == 3 | d.attacktype2 == 3));
                }))
                .enter()
                .append("circle")
                .attr("cx", function(d, i){ return projection([+d.longitude, +d.latitude])[0]})
                .attr("cy", function(d, i){ return projection([+d.longitude, +d.latitude])[1]})
                .attr("fill", "brown")
                //.attr("r", 0)
                .attr("r", 0)
                .transition()
                .duration(1000)
                .ease(d3.easeCubic)
                .attr("r", function(d, i){
                  return 2 + (0.5 * (+d.nkill));
                })


              svg.selectAll("circle")
                .on("mouseover", function(d, i){
                    //this.parentNode.appendChild(this);//the path group is on the top with in its parent group
                    d3.select(this).style('stroke', 'black');
                    d3.select(this).style("stroke-width", 2);
                    d3.select(this).style("stroke-opacity", 1);
                    d3.select(this).style("fill-opacity", 0.75);
                    d3.select("#date")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.iday + "-" + d.imonth + "-" + d.iyear ;
                        }))
                    d3.select("#city")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.city + ", " + d.provstate;
                        }))
                    d3.select("#loc")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.location ? d.location : "Not Available";
                        }))
                    d3.select("#target")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.target1 ? d.target1 : "Not Available";
                        }))
                    d3.select("#perp")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.gname ? d.gname : "Not Available";
                        }))
                    d3.select("#dead")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.nkill ? d.nkill : "Not Available";
                        }))
                    d3.select("#injured")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.nwound ? d.nwound : "Not Available";
                        }))
                    d3.select("#src")
                      .text(d3.select(this).data().map(
                        function(d) {
                          return d.scite1 ? d.scite1 : "Not Available";
                        }))

                    d3.select(".values").classed("display", true)
                })
                .on("mouseout", function(){
                    d3.select(this).style("stroke", "none");
                    //d3.select(this).style("stroke-width", 0.15);
                    d3.select(this).style("fill-opacity", 0.5);
                    d3.select(".values").classed("display", false)
                });
            }


            update_points(document.getElementById("input_year").value);
            d3.select("#input_year").on("input", function() {
              update_points(+this.value);
            });
          })
      });
      function zoomFunction(){
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
    </script>
  </div>
  <footer class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col l12 s12">
          <h5 class="white-text">Note</h5>
          <span class="Note">Bubbles on the map show bombing incidents in a particular year. Each bubble has a minimum radius of 2px. For every casualty, the radius is increased by 0.5px.</span>
        </div>
        <div class="col l6 s12">
          <h5 class="white-text">Citation</h5>
          <p class="grey-text text-lighten-4">Data source: "Information on more than 170,000 Terrorist Attacks." Global Terrorism Database. The University of Maryland. Accessed February 27, 2018. http://www.start.umd.edu/gtd/.</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Contact Us</h5>
          <ul>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        2018
      </div>
    </div>
  </footer>

<script async type="text/javascript" src="https://d3js.org/topojson.v2.min.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.25.0/d3-legend.js"></script>
<script type="text/javascript" src="js/textAnimate.js"></script>

</body>
</html>