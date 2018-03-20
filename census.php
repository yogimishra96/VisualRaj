<!DOCTYPE html>

<meta name="robots" content="noindex">
<html>
    <head>

        <!--<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">-->
        <link rel="stylesheet" href="css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/d3.v3.min.js"></script>
        <script src="js/d3.v4.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script src="js/materialize.min.js"></script>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Rajasthan map</title>

        <link href="css/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="right">Version: 0.0.1</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li class="navitem"><i class="material-icons left">blur_on</i><a href="./index.html">Switch to Bubble Map</a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li class="navitem"><a href="./index.html">Switch to Bubble Map</a></li>
                </ul>
            </div>
        </nav>

        <script>

            (function ($) {
                $(function () {
                    $('.button-collapse').sideNav();
                }); // end of document ready
            })(jQuery); // end of jQuery name space

            $(document).ready(function () {
                $(".button-collapse").sideNav();
            })
        </script>

        <div class="se-pre-con"></div>

        <div class="container topmargin">
            <div class="row align">
                <p class="col s2 select">Select Year: </p>
                <form action="#" class="col s4 bar">
                    <p class="range-field">
                        <input type="range" id="input_year" min="2000" max="2016" />
                    </p>
                </form>
                <div class="col s6">
                    <strong><p id="year"></p></strong>
                </div>
            </div>
            <div class="row align">
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Population</span><br/>
                    <span id="total_population" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Males</span><br/>
                    <span id="total_male" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Females</span><br/>
                    <span id="total_female" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total infant's</span><br/>
                    <span id="total_infant" class="highValue"><strong>0</strong></span>
                </div>
                
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div class="mapContain col s8 animate2">
                </div>
                <div class="col s4 dataSumm">
                   
                </div>
            </div>
            <script>
                document.getElementById("input_year").value = 2016;
                var yearName = document.getElementById("year");
                var slider = document.getElementById("input_year");
                yearName.innerHTML = "Statistics for " + document.getElementById("input_year").value;

                slider.oninput = function () {
                    yearName.innerHTML = "Statistics for " + this.value;
                }
            </script>
            <script src="main.js"></script>
        </div>
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col l12 s12">
                        <h5 class="white-text">Note</h5>
                        <span class="Note">
                            This is rajasthan's data visual Repersantation  about census,crime,crop and branch wise. 
                        </span>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Contact Us</h5>
                        <span class="Note">
                            Rajasthan Hackathon
                        </span>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    2018
                </div>
            </div>
        </footer>
        <script async type="text/javascript" src="js/topojson.v2.min.js"></script>
        <script async defer src="js/d3-legend"></script>
        <script type="text/javascript" src="js/textAnimate.js"></script>
    </body>
</html>

