<?php 
    $title = "Bubble Charts";
    // $plotTargets = array('chart1', 'chart2', 'chart3');
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

  <style type="text/css">
    .jqplot-target {
        margin-bottom: 2em;
    }
    
    .note {
        font-size: 0.8em;
    }
    
    #tooltip1b {
        font-size: 12px;
        color: rgb(15%, 15%, 15%);
        padding:2px;
        background-color: rgba(95%, 95%, 95%, 0.8);
    }
    
    #legend1b {
        font-size: 12px;
        border: 1px solid #cdcdcd;
        border-collapse: collapse;
    }
    #legend1b td, #legend1b th {
        border: 1px solid #cdcdcd;
        padding: 1px 4px;
    }
  </style>

 
 <p>Bubble charts represent 3 dimensional data.  Data is passed in to a bubble chart as a series of [x, y, radius, &lt;label or object&gt;].  The optional fourth element of the data point can either be either a label string or an object having 'label' and/or 'color' properties to assign to the bubble.</p>

<p>By default, all bubbles are scaled according to the size of the plot area.  The radius value in the data point will be adjusted to fit the bubbles in the chart.  If the "autoscaleBubbles" option is set to false, the radius value in the data will be taken as a literal pixel value for the radius of the points.</p>

<p>The below chart show basic customization of bubble appearance with the "bubbleAlpha" and "highlightAlpha" options.</p>

<div id="chart1" class="plot" style="width:460px;height:340px;"></div>
<pre class="code brush:js"></pre>

<div style="position:absolute;z-index:99;display:none;" id="tooltip1b"></div>

<table><tr>
    <td><div id="chart1b" class="plot" style="width:460px;height:340px;"></div></td>
    <td><div style="height:340px;"><table id="legend1b"><tr><th>Company</th><th>R Value</th></tr></table></div></td>
</tr></table>
<pre class="code brush:js"></pre>

<p>Below is a basic bubble chart showing usage of the optional label and color properties passed in with the data.</p>

<div id="chart1c" class="plot" style="width:460px;height:340px;"></div>
<pre class="code brush:js"></pre>

<p>The next chart uses the "bubbleGradients: true" option to specify gradient fills on the bubbles.  Radial gradients are not supported in IE<sup>*</sup> and will be automatically disabled.</p>  

<div id="chart2" class="plot" style="width:460px;height:340px;"></div>

<p class="note"><sup>*</sup>Radial gradients are not supported in IE 7 and IE 8 because they are not supported in the excanvas emulation layer used by jqPlot to render charts in IE 7 and IE 8.  jqPlot renders charts using the HTML canvas element which is supported by nearly every browser including IE 9.  Excanvas translates the canvas rendering to VML rendering for IE 7 and 8, but unfortunately does not properly handle radial gradients.</p>

<pre class="code brush:js"></pre>

<p>The following bubble chart shows the "autoscalePointsFactor" and "autoscaleMultiplier" options which can be used to control bubble scaling.  The "autoscalePointsFactor" options controls bubble scaling with the number of points on the plot.  A negative value will decrease bubble size and number of bubbles increases.  The "autoscaleMultiplier" will makes all bubbles larger or smaller for values greater  or less than 1.0.</p>

<p>This chart also demonstrates some of the highlighting options.  Bubble highlighting is controlled with the "highlightMouseOver" and "highlightMouseDown" boolean options.  Here the "highlightMouseDown: true" option is set which causes the plot to highlight on mousedown (click).  This automatically sets the "highlightMouseOver" option to false.</p>

<p>Events are also trigger with plot interaction.  Specifically, "jqplotDataHighlight", "jqplotDataUnhighlight", "jqplotDataClick" and "jqplotDataRightClick" events are triggered.  Handlers are passed an event object, the series index, the point index, and the bubble data.</p>

<div id="chart3" class="plot" style="width:600px;height:400px;"></div>
<pre class="code brush:js"></pre>

<script class="code" language="javascript" type="text/javascript">$(document).ready(function(){
    
    var arr = [[11, 123, 1236, "Acura"], [45, 92, 1067, "Alfa Romeo"], 
    [24, 104, 1176, "AM General"], [50, 23, 610, "Aston Martin Lagonda"], 
    [18, 17, 539, "Audi"], [7, 89, 864, "BMW"], [2, 13, 1026, "Bugatti"]];
    
    plot1 = $.jqplot('chart1',[arr],{
        title: 'Transparent Bubbles',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });    
});</script>

<script class="code" language="javascript" type="text/javascript">$(document).ready(function(){
    
    var arr = [[11, 123, 1236, "Acura"], [45, 92, 1067, "Alfa Romeo"], 
    [24, 104, 1176, "AM General"], [50, 23, 610, "Aston Martin Lagonda"], 
    [18, 17, 539, "Audi"], [7, 89, 864, "BMW"], [2, 13, 1026, "Bugatti"]];
    
    plot1b = $.jqplot('chart1b',[arr],{
        title: 'Tooltip and Custom Legend Highlighting',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8,
                showLabels: false
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });
    
    // Legend is a simple table in the html.
    // Now populate it with the labels from each data value.
    $.each(arr, function(index, val) {
        $('#legend1b').append('<tr><td>'+val[3]+'</td><td>'+val[2]+'</td></tr>');
    });
    
    // Now bind function to the highlight event to show the tooltip
    // and highlight the row in the legend. 
    $('#chart1b').bind('jqplotDataHighlight', 
        function (ev, seriesIndex, pointIndex, data, radius) {    
            var chart_left = $('#chart1b').offset().left,
                chart_top = $('#chart1b').offset().top,
                x = plot1b.axes.xaxis.u2p(data[0]),  // convert x axis unita to pixels on grid
                y = plot1b.axes.yaxis.u2p(data[1]);  // convert y axis units to pixels on grid
            var color = 'rgb(50%,50%,100%)';
            $('#tooltip1b').css({left:chart_left+x+radius+5, top:chart_top+y});
            $('#tooltip1b').html('<span style="font-size:14px;font-weight:bold;color:'+color+';">' + 
            data[3] + '</span><br />' + 'x: '+data[0] + '<br />' + 'y: ' + 
            data[1] + '<br />' + 'r: ' + data[2]);
            $('#tooltip1b').show();
            $('#legend1b tr').css('background-color', '#ffffff');
            $('#legend1b tr').eq(pointIndex+1).css('background-color', color);
        });
    
    // Bind a function to the unhighlight event to clean up after highlighting.
    $('#chart1b').bind('jqplotDataUnhighlight', 
        function (ev, seriesIndex, pointIndex, data) {
            $('#tooltip1b').empty();
            $('#tooltip1b').hide();
            $('#legend1b tr').css('background-color', '#ffffff');
        });
});</script>

<script class="code" language="javascript" type="text/javascript">$(document).ready(function(){
    
    var arr = [[11, 123, 1236, {label:"Acura", color:'sandybrown'}], 
    [45, 92, 1067, {label:"Alfa Romeo", color:'skyblue'}], 
    [24, 104, 1176, {label:"AM General", color:"salmon"}], [50, 23, 610, {color:"papayawhip"}], 
    [18, 17, 539, "Audi"], [7, 89, 864], [2, 13, 1026, "Bugatti"]];
    
    plot1c = $.jqplot('chart1c',[arr],{
        title: 'Bubble Data Customizations',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer
        }
    });
    
});</script>

<script class="code" language="javascript" type="text/javascript">$(document).ready(function(){

    var arr = [[11, 123, 1236, "Acura"], [45, 92, 1067, "Alfa Romeo"], 
    [24, 104, 1176, "AM General"], [50, 23, 610, "Aston Martin Lagonda"], 
    [18, 17, 539, "Audi"], [7, 89, 864, "BMW"], [2, 13, 1026, "Bugatti"]];
    
    plot2 = $.jqplot('chart2',[arr],{
        title: 'Bubble Gradient Fills*',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleGradients: true
            },
            shadow: true
        }
    });
    
});</script>

<script class="code" language="javascript" type="text/javascript">$(document).ready(function(){
    
    var arr = [[44, 66, 897, "Acura"], [25, 40, 1119, "Alfa Romeo"], [2, 33, 1197, "AM General"], 
    [4, 132, 896, "Aston Martin Lagonda"], [2, 129, 314, "Audi"], [14, 47, 612, "BMW"], 
    [45, 112, 719, "Bugatti"], [11, 38, 785, "Buick"], [15, 39, 367, "Cadillac"], 
    [6, 133, 726, "Chevrolet"], [48, 84, 1082, "Citroen"], [40, 18, 1047, "DaimlerChrysler Corporation"], 
    [24, 107, 1065, "Daewoo Motor Co."], [27, 92, 792, "Delorean Motor Company"], [1, 78, 803, "Dodge"], 
    [5, 149, 320, "Ferrari"], [11, 127, 497, "Fiat"], [14, 18, 805, "Ford Motor Company"], 
    [9, 101, 394, "General Motors"], [16, 57, 338, "GMC"], [19, 89, 977, "Holden"], 
    [35, 78, 464, "Honda"], [18, 130, 364, "Hummer"], [37, 20, 699, "Hyundai"], 
    [33, 140, 457, "Infiniti"], [12, 122, 533, "Isuzu"], [25, 67, 767, "Jaguar Cars"], 
    [0, 7, 481, "Jeep"], [38, 36, 611, "Jensen Motors"], [43, 91, 943, "Kia"], [45, 21, 569, "Laforza"]];
    
    plot3 = $.jqplot('chart3',[arr],{
        title: 'Bubble Auto Scaling Options',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                autoscalePointsFactor: -0.15,
                autoscaleMultiplier: 0.85,
                highlightMouseDown: true,
                bubbleAlpha: 0.7
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });
    
});</script>


<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- Additional plugins go here -->

  <script class="include" type="text/javascript" src="../src/plugins/jqplot.bubbleRenderer.js"></script>

<!-- End additional plugins -->

<?php include "closer.html"; ?>
