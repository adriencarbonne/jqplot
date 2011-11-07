<?php 
    $title = "Resizable Plots";
    // $plotTargets = array (array('id'=>'chart1', 'width'=>600, 'height'=>400));
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

  <style type="text/css">
  body {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }
  
  p, pre {
    margin: 1.5em;
  }

  body table {
    margin: 2em;
  }
  
    #resizable1, #resizable2 { 
      width: 440px; 
      height: 330px;
      margin-top: 2em;
      margin-bottom: 2em;
      padding: 1.2em;
    }
    
    
    .jqplot-target {
      font-size: 16px;
    }
    
    .ui-resizable-helper {
      border: 2px solid gray;
    }
  </style>

<p>Plot targets can be placed inside of resizable containers for dynamic plot sizing.  The examples here use the jQuery UI package for resizing functionality.</p>

    <table><tr>
      <td>
<div id="resizable1" class="ui-widget-content">
    <div id="chart1" style="height:96%; width:96%;"></div>
</div>
</td>
<td>

<p>The first plot has good resize performance in Firefox, Safari and other canvas enabled browsers.  The plot will resize dynamically with the container.  IE performance will be slow since IE doesn't natively support the canvas element.</p>

<p>Resizing is handled by binding a handler to the 'resize' event. The handler function replots the plot during resize.  Here, the plot targets's height and width must be specified as a percentage of the container and the container must be visible.</p>

<p>The event handler looks like:</p>
<pre>
    $('#resizable1').bind('resize', function(event, ui) {
        plot1.replot( { resetAxes: true } );
    });
</pre>
</td>
</tr></table>
<table><tr>
  <td>

<div id="resizable2" class="ui-widget-content">
    <div id="chart2" style="height:96%; width:96%;"></div>
</div>
</td>
<td>
<p>The second plot uses an alternative sizing method that is more responsive in all browsers, especially IE.  The differnece?  First, the plot target is given a static height and width that will fit inside the resizable container.  Then, instead of resizing dynamically with the container, the plots replot() method is called at the end of the resize.  When resizing is done, the plot targets hieght and width are set to a percentage of the container's and then the replot method is called.</p>

<p>Also, an options object is passed into the replot method.  It contains a single option, resetAxes, which, if true, resets all axes so the min, max, numberTicks and tickInterval are recalculated.</p>
<pre>
    $('#resizable2').bind('resizestop', function(event, ui) {
        $('#chart2').height($('#resizable2').height()*0.96);
        $('#chart2').width($('#resizable2').width()*0.96);
        plot2.replot({resetAxes:true});
    });
</pre>

<p>You can also pass in option objects to reset specific axes like:</p>

<pre>
    {resetAxes:['yaxis', 'y2axis']};
    
    or
    
    {resetAxes:{yaxis:true, y2axis:true}};
</pre>

</td></tr></table>

<pre class="code brush:js"></pre>


  <script type="text/javascript" class="code">
  
  $(document).ready(function(){

    $.jqplot._noToImageButton = true;

    var l1 = [18, 36, 41, 93, 100, 115, 133, 129, 119, 107, 91, 146, 169];
    var l2 = [[8, 66], [13, 46], [22,14]];
    var l3 = [[3.3, 7], [9.5, 22], [12.1, 37], [18.6, 95], [24, 102]];

    var options = {
      title: "Lines",
      legend:{show:true, location:'se'},
      seriesDefaults:{trendline:{show:true, type:"exp"}},
      axes:{
        yaxis:{
          renderer:$.jqplot.LogAxisRenderer
        }
      }
    };
    
    $("#resizable1").resizable({delay:20});
    $("#resizable2").resizable({delay:20, helper:'ui-resizable-helper'});

    $('#resizable1').bind('resize', function(event, ui) {
        // pass in resetAxes: true option to get rid of old ticks and axis properties
        // which should be recomputed based on new plot size.
        plot1.replot( { resetAxes: true } );
    });
    
    $('#resizable2').bind('resizestop', function(event, ui) {
        $('#chart2').height($('#resizable2').height()*0.96);
        $('#chart2').width($('#resizable2').width()*0.96);
        // pass in resetAxes: true option to get rid of old ticks and axis properties
        // which should be recomputed based on new plot size.
        plot2.replot( { resetAxes:true } );
    });
    
    var plot1 = $.jqplot('chart1', [l1, l3],  options);
    var plot2 = $.jqplot('chart2', [l1, l3],  options);

  });
  
  </script>

<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

  <script class="include" type="text/javascript" src="../src/jquery.jqplot.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.logAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.trendline.js"></script>
  
  <link class="include" type="text/css" href="jquery-ui/css/ui-lightness/jquery-ui.min.css" rel="Stylesheet" /> 
  <script class="include" type="text/javascript" src="jquery-ui/js/jquery-ui.min.js"></script>
<!-- End additional plugins -->

<?php include "closer.html"; ?>
