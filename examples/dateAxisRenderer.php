<?php 
    $title = "Candlestick and Open Hi Low Close charts";
    // $plotTargets = array('chart1');
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

<p class="text">Date axis renderer with default settings.  Ticks are given wider spacing by default since date axes typically have longer tick labels.</p>
<div id="chart1" style="margin:20px;height:240px; width:640px;"></div>
<p class="text">Date axis recognizes rotated tick labels.  It will space ticks a little closer when labels are rotated.</p>
<div id="chart2" style="margin:20px;height:240px; width:640px;"></div>
<p class="text">If you want more or less ticks, specify the "numberTicks" options.  Date axes will try to produce the desired number of ticks, but may adjust to get a nice interval.</p>
<div id="chart3" style="margin:20px;height:240px; width:640px;"></div>

<script type="text/javascript">
    var ohlc = [['07/06/09', 138.7, 139.68, 135.18, 135.4],
    ['06/29/09', 143.46, 144.66, 139.79, 140.02],
    ['06/22/09', 140.67, 143.56, 132.88, 142.44],
    ['06/15/09', 136.01, 139.5, 134.53, 139.48],
    ['06/08/09', 143.82, 144.56, 136.04, 136.97],
    ['06/01/09', 136.47, 146.4, 136, 144.67],
    ['05/26/09', 124.76, 135.9, 124.55, 135.81],
    ['05/18/09', 123.73, 129.31, 121.57, 122.5],
    ['05/11/09', 127.37, 130.96, 119.38, 122.42],
    ['05/04/09', 128.24, 133.5, 126.26, 129.19],
    ['04/27/09', 122.9, 127.95, 122.66, 127.24],
    ['04/20/09', 121.73, 127.2, 118.6, 123.9],
    ['04/13/09', 120.01, 124.25, 115.76, 123.42],
    ['04/06/09', 114.94, 120, 113.28, 119.57],
    ['03/30/09', 104.51, 116.13, 102.61, 115.99],
    ['03/23/09', 102.71, 109.98, 101.75, 106.85],
    ['03/16/09', 96.53, 103.48, 94.18, 101.59],
    ['03/09/09', 84.18, 97.2, 82.57, 95.93],
    ['03/02/09', 88.12, 92.77, 82.33, 85.3],
    ['02/23/09', 91.65, 92.92, 86.51, 89.31],
    ['02/17/09', 96.87, 97.04, 89, 91.2],
    ['02/09/09', 100, 103, 95.77, 99.16],
    ['02/02/09', 89.1, 100, 88.9, 99.72],
    ['01/26/09', 88.86, 95, 88.3, 90.13],
    ['01/20/09', 81.93, 90, 78.2, 88.36],
    ['01/12/09', 90.46, 90.99, 80.05, 82.33],
    ['01/05/09', 93.17, 97.17, 90.04, 90.58],
    ['12/29/08', 86.52, 91.04, 84.72, 90.75],
    ['12/22/08', 90.02, 90.03, 84.55, 85.81],
    ['12/15/08', 95.99, 96.48, 88.02, 90],
    ['12/08/08', 97.28, 103.6, 92.53, 98.27],
    ['12/01/08', 91.3, 96.23, 86.5, 94],
    ['11/24/08', 85.21, 95.25, 84.84, 92.67],
    ['11/17/08', 88.48, 91.58, 79.14, 82.58],    
    ['11/10/08', 100.17, 100.4, 86.02, 90.24],
    ['11/03/08', 105.93, 111.79, 95.72, 98.24],
    ['10/27/08', 95.07, 112.19, 91.86, 107.59],
    ['10/20/08', 99.78, 101.25, 90.11, 96.38],
    ['10/13/08', 104.55, 116.4, 85.89, 97.4],
    ['10/06/08', 91.96, 101.5, 85, 96.8],
    ['09/29/08', 119.62, 119.68, 94.65, 97.07],
    ['09/22/08', 139.94, 140.25, 123, 128.24],
    ['09/15/08', 142.03, 147.69, 120.68, 140.91],
    ['09/08/08', 164.57, 164.89, 146, 148.94]
    ];
     
    var hlc = [['07/06/09', 139.68, 135.18, 135.4],
    ['06/29/09', 144.66, 139.79, 140.02],
    ['06/22/09', 143.56, 132.88, 142.44],
    ['06/15/09', 139.5, 134.53, 139.48],
    ['06/08/09', 144.56, 136.04, 136.97],
    ['06/01/09', 146.4, 136, 144.67],
    ['05/26/09', 135.9, 124.55, 135.81],
    ['05/18/09', 129.31, 121.57, 122.5],
    ['05/11/09', 130.96, 119.38, 122.42],
    ['05/04/09', 133.5, 126.26, 129.19],
    ['04/27/09', 127.95, 122.66, 127.24],
    ['04/20/09', 127.2, 118.6, 123.9],
    ['04/13/09', 124.25, 115.76, 123.42],
    ['04/06/09', 120, 113.28, 119.57],
    ['03/30/09', 116.13, 102.61, 115.99],
    ['03/23/09',  109.98, 101.75, 106.85],
    ['03/16/09', 103.48, 94.18, 101.59],
    ['03/09/09', 97.2, 82.57, 95.93],
    ['03/02/09', 92.77, 82.33, 85.3],
    ['02/23/09', 92.92, 86.51, 89.31],
    ['02/17/09', 97.04, 89, 91.2],
    ['02/09/09', 103, 95.77, 99.16],
    ['02/02/09', 100, 88.9, 99.72],
    ['01/26/09', 95, 88.3, 90.13],
    ['01/20/09', 90, 78.2, 88.36],
    ['01/12/09', 90.99, 80.05, 82.33],
    ['01/05/09', 97.17, 90.04, 90.58],
    ['12/29/08', 91.04, 84.72, 90.75],
    ['12/22/08', 90.03, 84.55, 85.81],
    ['12/15/08', 96.48, 88.02, 90],
    ['12/08/08', 103.6, 92.53, 98.27],
    ['12/01/08', 96.23, 86.5, 94],
    ['11/24/08', 95.25, 84.84, 92.67],
    ['11/17/08', 91.58, 79.14, 82.58],  
    ['11/10/08', 100.4, 86.02, 90.24],
    ['11/03/08', 111.79, 95.72, 98.24],
    ['10/27/08', 112.19, 91.86, 107.59],
    ['10/20/08', 101.25, 90.11, 96.38],
    ['10/13/08', 116.4, 85.89, 97.4],
    ['10/06/08', 101.5, 85, 96.8],
    ['09/29/08', 119.68, 94.65, 97.07],
    ['09/22/08', 140.25, 123, 128.24],
    ['09/15/08', 147.69, 120.68, 140.91],
    ['09/08/08', 164.89, 146, 148.94]
    ];
</script>

<script class="code" type="text/javascript">
$(document).ready(function(){
    title: "CandleStick Chart",
    // Globally enable plugins like cursor and highlighter
    $.jqplot.config.enablePlugins = true;

    // for 2 digit years, set the default centry to 2000.
    $.jsDate.config.defaultCentury = 2000;
    
    plot1 = $.jqplot('chart1',[ohlc],{
        axes: {
          xaxis: {
              renderer:$.jqplot.DateAxisRenderer,
          },
          yaxis: {
              tickOptions:{prefix: '$'}
          }
        },
        series: [
            {
                renderer:$.jqplot.OHLCRenderer, 
                rendererOptions:{ 
                    candleStick:true 
                }
            }
        ],
        highlighter: {
            showMarker:false,
            tooltipAxes: 'xy',
            yvalues: 4,
            formatString:'<table class="jqplot-highlighter"> \
                <tr><td>date:</td><td>%s</td></tr> \
                <tr><td>open:</td><td>%s</td></tr> \
                <tr><td>hi:</td><td>%s</td></tr> \
                <tr><td>low:</td><td>%s</td></tr> \
                <tr><td>close:</td><td>%s</td></tr> \
            </table>'
        }
    });
});
</script>

<script class="code" type="text/javascript">
$(document).ready(function(){
        
    plot2 = $.jqplot('chart2',[ohlc],{
        title: 'OHLC chart',
        axes: {
            xaxis: {
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: -30
                }
            },
            yaxis: {
                tickOptions:{
                    prefix: '$'
                }
            }
        },
        series: [
            {
                renderer:$.jqplot.OHLCRenderer
            }
        ],
        highlighter: {
            showMarker:false,
            tooltipAxes: 'xy',
            yvalues: 4,
            formatString:'<table class="jqplot-highlighter"> \
                <tr><td>date:</td><td>%s</td></tr> \
                <tr><td>open:</td><td>%s</td></tr> \
                <tr><td>hi:</td><td>%s</td></tr> \
                <tr><td>low:</td><td>%s</td></tr> \
                <tr><td>close:</td><td>%s</td></tr> \
            </table>'
        }
    });
});
</script>

<script class="code" type="text/javascript">
$(document).ready(function(){
        
    plot3 = $.jqplot('chart3',[ohlc],{
        title: 'Pad = 2.02',
        axesDefaults:{},
        axes: {
            xaxis: {
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                numberTicks: 7,
                tickOptions: {
                    angle: -30
                }
            },
            yaxis: {
                tickOptions:{
                    prefix: '$'
                }
            }
        },
        series: [
            {
                renderer:$.jqplot.OHLCRenderer, 
                rendererOptions:{ 
                    candleStick:true 
                }
            }
        ],
        highlighter: {
            showMarker:false,
            tooltipAxes: 'xy',
            yvalues: 4,
            formatString:'<table class="jqplot-highlighter"> \
                <tr><td>date:</td><td>%s</td></tr> \
                <tr><td>open:</td><td>%s</td></tr> \
                <tr><td>hi:</td><td>%s</td></tr> \
                <tr><td>low:</td><td>%s</td></tr> \
                <tr><td>close:</td><td>%s</td></tr> \
            </table>'
        }
    });
});
</script>

<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

    <script class="include" type="text/javascript" src="../src/plugins/jqplot.dateAxisRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.categoryAxisRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasTextRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasAxisTickRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.ohlcRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.highlighter.js"></script>

<!-- End additional plugins -->

<?php include "closer.html"; ?>
