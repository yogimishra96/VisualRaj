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
        <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
          <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/bubble.css" rel="stylesheet">
        <title> map</title>
        
    
    </head>

    <body>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="right">Version: 0.0.1</a>
                <a href="#" class="center-align visual-raj-heading">Visual Raj</a>

                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li class="navitem"><i class="material-icons left">my_location</i>
                        <a href="./index.php">Switch to Census Map</a></li>

                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li class="navitem"><a href="./index.php">Switch to Census Map</a></li>
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

        <div class="container topmargin">
            <div class="row align">
                <p class="col s2">Select Year: </p>
                <form action="#" class="col s4">
                    <!--<p class="range-field">-->
                    <select id="input_year_select" name="year" style="display: block !important">
                        <option value="2011" selected="selected" >2018</option>
                        <option value="2011" selected="selected" >2017</option>
                        <option value="2011" selected="selected" >2016</option>
                        <option value="2011" selected="selected" >2015</option>
                      
                    </select>
                    <!--<input type="range" id="input_year" min="2000" max="2016" />-->
                    <!--</p>-->
                </form>
                <div class="col s6">
                    <strong><p id="year"></p></strong>
                </div>
            </div>
            <div class="row align">
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Tourists</span><br/>
                    <span id="total_tourists_count" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Foreign Tourists</span><br/>
                    <span id="total_foreign_count" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Total Local Tourists</span><br/>
                    <span id="total_local_count" class="highValue"><strong>0</strong></span>
                </div>
                <div class="col s2 highlight animate1">
                    <span class="highTitle">Growth in tourism from previous year</span><br/>
                    <span id="total_growth_from_previous" class="highValue"><strong>0</strong></span>
                </div>
            </div>

            <div>
                <a href="index.php" style="color: red ;margin-right: 10px ;text-align:center" >This Page is in Progress Click here to go main page</a>
            </div>
            <div class="row">
                <div class="mapContain col s8 animate2">
                </div>
                <div class="col s4 values fadeIn">
                    <div class="col s12 boxTitle">
                        <h4>Summary</h4>
                    </div>
                    <div class="col s12 boxInfo">
                        <strong><span>City: </span></strong><span id="city">Peshawar/KPK</span>
                    </div>
                    <div class="col s12 boxInfo">
                        <strong><span>Location: </span></strong><span id="loc">Location</span>
                    </div>
                    
                </div>
            </div>

            <script>
                document.getElementById("input_year_select").value = 2018;
                var yearName = document.getElementById("year");
                var slider = document.getElementById("input_year_select");
                yearName.innerHTML = document.getElementById("input_year_select").value;

                slider.oninput = function () {
                    yearName.innerHTML = this.value;
                }
            </script>

            <script src="bubble.js" ></script>
        </div>
        <footer class="page-footer">
            <div class="container">
                <div class="row"> 
                    <div class="col 12 s12">
                        <h5 class="white-text">Contact Us</h5>
                        <span class="Note">
                            WSB Tech Nerds
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
        <script async defer src="js/d3-legend.js"></script>
        <script type="text/javascript" src="js/textAnimate.js"></script>

    </body>
</html>