<?php 
    $title = "Hidden Plots";
    // $plotTargets = array (array('id'=>'chart1', 'width'=>600, 'height'=>400));
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

  <style type="text/css">
    .ui-tabs, .ui-accordion {
      width: 690px;
      margin: 2em auto;
    }
    .ui-tabs-nav, .ui-accordion-header {
      font-size: 12px;
    }
    
    .ui-tabs-panel, .ui-accordion-content {
      font-size: 14px;
    }
    
    .jqplot-target {
      font-size: 18px;
    }
    
    ol.description {
      list-style-position: inside;
      font-size:15px;
      margin:1.5em auto;
      padding:0 15px;
      width:600px;
    }
  </style>

<p class="description">This page demonstrates placing plots within jQuery UI widgets. Tab 2 and tab 3 contain plots.  Using a combination of alternate sizing specification and the jqplot "replot" method the plots are properly displayed when their containers are shown.</p>
  
  <p class="description">The alternate sizing specifications for setting plot height and width are needed because a hidden element (or child of a hidden element) has no size.  The first example in tab 2 uses custom "data-height" and "data-width" attributes on the plot target element.  The second example uses "width" and "height" properties specified on the options object passed into the $.jqplot() function.</p>

  <p class="description">The default plot size is 300px wide by 400px high. The default setting can be overridden by specifying different values to the $.jqplot.config.defaultHeight and $.jqplot.config.defaultWidth properties.  Height and width values are taken in this order of precedence:
  </p>
      
      <ol class="description">
        <li>The css properties of the plot target if available (not available with display:none;).</li>
        <li>Options object passed into the $.jqplot() function.</li>
        <li>Custom data-height and data-width attributes on the plot target.</li>
        <li>The config defaults.</li>
      </ol>
      
  <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Tab 1</a></li>
      <li><a href="#tabs-2">Tab 2</a></li>
      <li><a href="#tabs-3">Tab 3</a></li>
    </ul>
    <div id="tabs-1">
      Tabs 2 and 3 have plots.  Since tabs 2 and 3 are initially inactive, their contents (and the plots) are initially hidden.
    </div>
    
    <div id="tabs-2">
      <p>This plot was in an initially hidden container.  Its height and width are set by the "data-height" and "data-width" properties of the plot container.</p>
        <div id="chart1" data-height="260px" data-width="480px" style="margin-top:20px; margin-left:20px;"></div>
    </div>
    
    <div id="tabs-3">
      <p>This plot is in an initially hidden container.  Its height and width are set by the 'height' and 'width' properties of the options object passed into the plot constructor.</p>
        <div id="chart2" style="margin-top:20px; margin-left:20px;"></div>
    </div>
    
  </div> 
  
    <p class="description">In the accordion below, section 2 contains a plot.  Sizing plots in hidden accordion sections is very similar to sizing in a tab widget.  Because of the default animation on accordions, however, the plot will not draw itself until the entire accordion panel is shown.</p>
    
<div id="accordion" style="margin-top:50px">
  
  <h3><a href="#">Section 1</a></h3>
  <div>
    Here is section 1 there is no plot.  Section 2 has a plot that will display once the section is completely shown.
  </div>
  
  <h3><a href="#">Section 2</a></h3>
  <div>
    <p>
    This plot also has its height and width set with the data-height and data-width attributes.  Note, if you want the accordion widget to properly size itself </em>before</em> the plot is shown, you must also specify a css height and width on the plot target.
    </p>
    <div id="chart3" data-height="200" data-width="400" style="width:400px; height: 200px; margin-top: 20px; margin-left: 20px"></div>
  </div>
  
</div>

<p class="description">Code for generating the plots follows.  It is critical to bind the callback to the UI widgets "show" or "change" method which calls the plots "replot" method.  Without this, the plot won't properly redraw itself when its container becomes visible.</p>

<p class="description">
  Note in the ui.index and plot._drawCount properties in the tabsshow callback.  ui.index gives the index of the activated tab.  plot._drawCount keeps track of how many times the plot was visibly drawn (or redrawn/replotted).  Generally, replot only needs to be called the first time the plot is visibly drawn, hence the check for plot._drawCount === 0.
  </p>  

<pre class="code brush:js"></pre>

<script class="code" type="text/javascript">
    $(document).ready(function() {
        $.jqplot.config.enablePlugins = false;

        var l1 = [18, 36, 14, 11];
        var l2 = [[2, 14], [7, 2], [8,5]];
        var l3 = [4, 7, 9, 2, 11, 5, 9, 13, 8, 7];
        var l4 = [['peech',3], ['cabbage', 2], ['bean', 4], ['orange', 5]];

        $("#tabs").tabs();
        $("#accordion").accordion();

        var plot1 = $.jqplot('chart1', [l1, l2, l3],  {
          title: "I was hidden",
          lengend:{show:true},
          series:[{},{yaxis:'y2axis'}, {yaxis:'y3axis'}],
          cursor:{show:true, zoom:true},
          axesDefaults:{useSeriesColor:true, rendererOptions: { alignTicks: true}}
        });

        var plot2 = $.jqplot('chart2', [l4], {
          height: 200,
          width: 300,
          series:[{renderer:$.jqplot.PieRenderer}],
          legend:{show:true}
        });
    
        var catOHLC = [[1, 138.7, 139.68, 135.18, 135.4],
        [2, 143.46, 144.66, 139.79, 140.02],
        [3, 140.67, 143.56, 132.88, 142.44],
        [4, 136.01, 139.5, 134.53, 139.48],
        [5, 143.82, 144.56, 136.04, 136.97],
        [6, 136.47, 146.4, 136, 144.67],
        [7, 124.76, 135.9, 124.55, 135.81],
        [8, 123.73, 129.31, 121.57, 122.5]];

        var ticks = ['Tue', 'Wed', 'Thu', 'Fri', 'Mon', 'Tue', 'Wed', 'Thr'];
    
        var plot3 = $.jqplot('chart3',[catOHLC],{
          grid:{ drawGridlines:true},
          title: 'A CandleStick Chart',
          axes: {
              xaxis: {
                  renderer:$.jqplot.CategoryAxisRenderer,
                  ticks:ticks
              },
              yaxis: {
                  tickOptions:{formatString:'$%.2f'}
              }
          },
          series: [{renderer:$.jqplot.OHLCRenderer, rendererOptions:{candleStick:true}}]
        });

        $('#tabs').bind('tabsshow', function(event, ui) {
          if (ui.index === 1 && plot1._drawCount === 0) {
            plot1.replot();
          }
          else if (ui.index === 2 && plot2._drawCount === 0) {
            plot2.replot();
          }
        });

        $('#accordion').bind('accordionchange', function(event, ui) {
          var index = $(this).find("h3").index ( ui.newHeader[0] );
          if (index === 1) {
            plot3.replot();
          }
        });
    
    });
</script> 

<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.cursor.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.pieRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.ohlcRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.categoryAxisRenderer.js"></script>
  <link class="include" type="text/css" href="jquery-ui/css/smoothness/jquery-ui.min.css" rel="Stylesheet" /> 
  <script class="include" type="text/javascript" src="jquery-ui/js/jquery-ui.min.js"></script>

<!-- End additional plugins -->

<?php include "closer.html"; ?>
