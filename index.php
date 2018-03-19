<!DOCTYPE html>

<meta name="robots" content="noindex">
<html>
    <head>

        <!--<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/d3.v3.min.js"></script>
        <script src="js/d3.v4.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script src="js/materialize.min.js"></script>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Rajasthan map</title>
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
            .legend-svg {
                display: block;
                margin: 0 auto;
            }
            svg {
                background: #FFF;
                opacity: 0.99;
            }

            div.tooltip {
                position: absolute;
                width: 120px;
                min-height: 80px;
                padding: 7px;
                font-size: 12px;
                background-color: #0277BD;
                fill-opacity: 0.4;
                color: white;
                border: 0px;
                border-radius: 5px;
                pointer-events: none;
                font-family: 'Open Sans', sans-serif;
                display: flex;
                flex-direction: column;
                justify-content: space-between;

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

            .select {
                font-size: 20px;
                margin: 15px 0px 15px 0px;
                text-align: center;
            }

            .title {
                text-align: center;
            }

            .topmargin {
                margin-top: 35px
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

            .highlight {
                text-align: center;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .highTitle {
                font-size: 20px;
                font-family: 'Open Sans', sans-serif;
            }

            .highValue {
                font-size: 34px;
                font-family: 'Open Sans', sans-serif;
            }

            .bar {
                padding: 0rem;
            }

            .dataSumm {
                background-color: #03A9F4;
                border-radius: 7.5px;
                color: white;
                -webkit-box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.64);
                -moz-box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.64);
                box-shadow: 6px 6px 9px -2px rgba(0,0,0,0.64);
            }

            .page-footer {
                background-color: #D81B60;
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
                color: #01579B;
            }

            .Note {
                font-family: 'Open Sans', sans-serif;
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

            .nav-wrapper {
                background-color: #0277BD;
            }


            @media only screen and (max-width: 675px) {
                .highTitle {
                    font-size: 14px;
                }

                .highValue {
                    font-size: 20px;
                }
                .highlight {
                    margin-top: 0px;
                    margin-bottom: 0px;
                }

                .dataSumm {
                    background-color: white;
                    color: black;
                    -webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.64);
                    -moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.64);
                    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.64);
                }

                #year {
                    font-size: 15px;
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
            <div class="row">
            </div>
            <div class="row">
                <div class="mapContain col s8 animate2">
                </div>
                <div class="col s4 dataSumm">
                    <div class="col s12 highlight animate1">
                        <span class="highTitle">Total Population</span><br/>
                        <span id="n_inc" class="highValue"><strong>0</strong></span>
                    </div>
                    <div class="col s12 highlight animate2">
                        <span class="highTitle">Male</span><br/>
                        <span id="total_male" class="highValue"><strong>0</strong></span>
                    </div>
                    <div class="col s12 highlight animate3">
                        <span class="highTitle">Female</span><br/>
                        <span id="total_female" class="highValue"><strong>0</strong></span>
                    </div>
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
                            Wholesalebox tech team
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
        <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.25.0/d3-legend.js"></script>
        <script type="text/javascript" src="js/textAnimate.js"></script>
    </body>
</html>

