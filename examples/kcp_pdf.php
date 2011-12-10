<?php 
    $title = "Probability Density Function Chart";
    // $plotTargets = array (array('id'=>'chart1', 'width'=>600, 'height'=>400));
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->


  <link class="include" type="text/css" href="jquery-ui/css/ui-lightness/jquery-ui.min.css" rel="Stylesheet" /> 

  <style type="text/css">

    .chart-container {
        border: 1px solid darkblue;
        padding: 30px;
        width: 500px;
        height: 400px;
        
    }

    #chart1 {
        width: 96%;
        height: 96%;
    }

    .jqplot-datestamp {
      font-size: 0.8em;
      color: #777;
/*      margin-top: 1em;
      text-align: right;*/
      font-style: italic;
      position: absolute;
      bottom: 15px;
      right: 15px;
    }

    td.controls li {
        list-style-type: none;
    }

    td.controls ul {
        margin-top: 0.5em;
        padding-left: 0.2em;
    }

    pre.code {
        margin-top: 45px;
        clear: both;
    }


  </style>

    <table class="app">
        <td class="controls">

            <div>
                Data Series:
                <ul>
                    <li><input name="dataSeries" value="national" type="radio" checked />National</li>
                    <li><input name="dataSeries" value="urban" type="radio" />Urban</li>
                    <li><input name="dataSeries" value="rural" type="radio" />Rural</li>
                </ul>
            </div>

            <div>
                Background Color:
                <ul>
                    <li><input name="backgroundColor" value="white" type="radio" checked />Default</li>
                    <li><input name="backgroundColor" value="#efefef" type="radio" />Gray</li>
                </ul>
            </div>

            <div>
                Line Width:
                <ul>
                    <li><input name="lineWidth" value="2.5" type="radio" checked />Thin</li>
                    <li><input name="lineWidth" value="5" type="radio" />Thick</li>
                </ul>
            </div>

            <div>
                Grids:
                <ul>
                    <li><input name="gridsVertical" value="vertical" type="checkbox" checked />Vertical</li>
                    <li><input name="gridsHorizontal" value="horizontal" type="checkbox" checked />Horizontal</li>
                </ul>
            </div>

            <div>
                Set lines at:
                <ul>
                    <li><input name="userLine1" value="8250" type="text" size="8" /> and </li>
                    <li><input name="userLine2" value="60000" type="text" size="8" /></li>
                </ul>
            </div>
        </td>

        <td class="chart">
            <div class="chart-container">    
                <div id="chart1"></div>
                <div class="jqplot-datestamp"></div>
            </div>
        </td>

    </table>

    <pre class="code brush:js"></pre>
  

 
  <script class="code" type="text/javascript">
$(document).ready(function(){
    var dataSets = {
        national: [[1521.3938, 0.03708],[1626.3757, 0.042449],[1738.6018, 0.049646],[1858.5719, 0.060338],[1986.8205, 0.071497],
        [2123.9187, 0.087044],[2270.4772, 0.104666],[2427.1488, 0.128184],[2594.6313, 0.159819],[2773.6707, 0.199611],
        [2965.0643, 0.243673],[3169.6651, 0.287224],[3388.384, 0.342159],[3622.1955, 0.415635],[3872.1408, 0.517318],
        [4139.3332, 0.659341],[4424.963, 0.840113],[4730.3023, 1.074108],[5056.7112, 1.442097],[5405.6431, 1.981591],
        [5778.6531, 2.7619],[6177.4022, 3.842131],[6603.6665, 5.373085],[7059.3446, 7.749981],[7546.4664, 11.242774],
        [8067.2013, 15.291262],[8623.869, 19.8475],[9218.9488, 25.015106],[9855.0905, 30.121086],[10535.1293, 35.513309],
        [11262.0934, 41.587183],[12039.2208, 46.321554],[12869.973, 49.223654],[13758.0502, 51.762768],[14707.4081, 54.47173],
        [15722.2754, 56.863937],[16807.1724, 57.920473],[17966.9296, 58.642722],[19206.7162, 59.984755],[20532.0529, 61.048963],
        [21948.8429, 59.669989],[23463.3991, 56.956409],[25082.4581, 54.101304],[26813.238, 53.0051],[28663.448, 51.385158],
        [30641.3597, 50.165756],[32755.7239, 47.205435],[35015.9867, 43.941876],[37432.2159, 40.609332],[40015.1736, 37.393368],
        [42776.4074, 34.753172],[45728.1335, 31.843056],[48883.5393, 29.239575],[52256.6796, 26.946508],[55862.5786, 24.54375],
        [59717.3573, 21.987525],[63838.07, 19.447158],[68243.1267, 16.947396],[72952.1481, 14.562087],[77986.109, 12.487872],
        [83367.4313, 10.610279],[89120.1733, 9.061827],[95269.7861, 7.759485],[101843.7444, 6.5685],[108871.3294, 5.529717],
        [116383.8431, 4.605731],[124414.8718, 3.803268],[132999.9458, 3.106561],[142177.421, 2.580555],[151988.1749, 2.127878],
        [162475.9062, 1.720439],[173687.5023, 1.418638],[185672.5653, 1.173246],[198484.6408, 0.977631],[212180.7957, 0.832246],
        [226822.0345, 0.720185],[242473.814, 0.624252],[259205.3802, 0.54125],[277091.4846, 0.469102],[296211.7947, 0.415329],
        [316651.475, 0.374489],[338501.5668, 0.335609],[361859.7555, 0.297025],[386829.3815, 0.261974],[413522.0015, 0.228367],
        [442056.5084, 0.19707],[472559.9991, 0.17066],[505168.8456, 0.147428],[540027.3147, 0.128476],[577291.1437, 0.112712],
        [617126.311, 0.097754],[659710.2484, 0.083718],[705233.3359, 0.070908],[753896.9752, 0.061016],[805918.5808, 0.053385],
        [861529.8645, 0.047077],[920978.5269, 0.041268],[984529.3611, 0.035943],[1052466.484, 0.031318],[1125090.461, 0.027688]],

        urban: [[2918.1368, 0.0059], [3099.059, 0.0071], [3291.1983, 0.0086], [3495.2501, 0.0105], [3711.9529, 0.0127], 
        [3942.0911, 0.015], [4186.4977, 0.018], [4446.0574, 0.0218], [4721.7095, 0.0262], [5014.4519, 0.0315], 
        [5325.3441, 0.03890], [5655.5113, 0.0493], [6006.1487, 0.0633], [6378.5253, 0.0833], [6773.9889, 0.1099], 
        [7193.971, 0.1432], [7639.9917, 0.18610], [8113.6654, 0.2476], [8616.7064, 0.3266], [9150.9356, 0.432399], 
        [9718.2865, 0.5759], [10320.8128, 0.7497], [10960.6953, 0.9448], [11640.25, 1.1693], [12361.9366, 1.4078], 
        [13128.3672, 1.6660], [13942.3158, 1.9247], [14806.7287, 2.10529], [15724.7345, 2.291], [16699.656, 2.4804], 
        [17735.0219, 2.6917], [18834.5796, 2.9825], [20002.3091, 3.350899], [21242.4369, 3.7607], [22559.4426, 4.1855], 
        [23958.1299, 4.5129], [25443.5105, 4.8198], [27020.9832, 5.254099], [28696.2577, 5.6751], [30475.3976, 6.1493], 
        [32364.8747, 6.3607], [34371.4652, 6.4803], [36502.4624, 6.7534], [38765.5793, 6.7358], [41169.0072, 6.4996], 
        [43721.489, 5.9422], [46432.1785, 5.7844], [49310.9281, 5.943099], [52368.1573, 5.9219], [55614.9317, 5.635099], 
        [59063.062, 5.1036], [62724.914, 4.6486], [66613.7972, 4.2762], [70743.7873, 3.8538], [75129.8328, 3.4799], 
        [79787.8886, 3.066], [84734.6595, 2.6792], [89988.1253, 2.312799], [95567.3009, 2.0393], [101492.3799, 1.7922], 
        [107784.9158, 1.5635], [114467.4749, 1.3438], [121564.3462, 1.1612], [129101.2165, 0.992799], [137105.3654, 0.818], 
        [145605.9093, 0.6722], [154633.333, 0.549], [164220.4481, 0.4517], [174401.955, 0.379299], [185214.7052, 0.3252], 
        [196698.0321, 0.2772], [208893.1174, 0.23700], [221844.2859, 0.2049], [235598.4142, 0.1818], [250205.285, 0.1607], 
        [265718.0332, 0.1396], [282192.2909, 0.1211], [299687.9363, 0.1047], [318268.2947, 0.0906], [338000.617, 0.0787], 
        [358956.683, 0.0681], [381211.6455, 0.0586], [404846.394, 0.0504], [429946.4736, 0.0421], [456602.7336, 0.034], 
        [484912.1405, 0.02799], [514976.218, 0.0238], [546904.2389, 0.0206], [580811.7657, 0.0179], [616821.5259, 0.0154], 
        [655064.5111, 0.013], [695677.8688, 0.011], [738809.2149, 0.0093], [784614.6621, 0.0081], [833260.0023, 0.0073], 
        [884922.1907, 0.0066], [939786.4993, 0.0061], [998052.3412, 0.0056], [1059930.608, 0.0052], [1125645.267, 0.0048]],

        rural: [[1522.3755, 0.005], [1621.4335, 0.005], [1726.937, 0.006], [1839.3056, 0.00699], [1958.9857, 0.009], 
        [2086.4531, 0.01], [2222.2145, 0.012], [2366.8099, 0.015], [2520.8136, 0.018], [2684.8381, 0.023], [2859.5353, 0.029],
        [3045.6, 0.036], [3243.7713, 0.043], [3454.8371, 0.05], [3679.6367, 0.06], [3919.0639, 0.074], [4174.0698, 0.092], 
        [4445.6684, 0.117], [4734.9398, 0.148], [5043.0332, 0.189], [5371.1735, 0.258], [5720.6654, 0.356], 
        [6092.8986, 0.488], [6489.3516, 0.672], [6911.6011, 0.946], [7361.3256, 1.355], [7840.3135, 1.87399], 
        [8350.4675, 2.434], [8893.8162, 3.016], [9472.5195, 3.639], [10088.8789, 4.22], [10745.3427, 4.92399], 
        [11444.5212, 5.652], [12189.194, 6.117], [12982.3225, 6.414], [13827.0569, 6.66], [14726.7567, 6.9099], 
        [15684.9997, 7.131], [16705.5921, 7.213], [17792.5925, 7.22], [18950.322, 7.263], [20183.3846, 7.2459], 
        [21496.6782, 6.973], [22895.4161, 6.457], [24385.1837, 5.9110], [25971.888, 5.513], [27661.8365, 5.162],
        [29461.7179, 4.749], [31378.744, 4.319], [33420.5079, 3.81299], [35595.0905, 3.306], [37911.2052, 2.867],
        [40378.0258, 2.518], [43005.3584, 2.233], [45803.6014, 1.96099], [48783.9674, 1.692], [51958.2609, 1.411], 
        [55339.1005, 1.168],[58939.867, 0.9520], [62774.9884, 0.77799], [66859.655, 0.647], [71210.033, 0.538], 
        [75843.5542, 0.4349], [80778.5711, 0.348], [86034.7015, 0.2789999], [91632.7482, 0.22300], [97595.1423, 0.177], 
        [103945.4998, 0.148], [110709.0646, 0.128], [117912.6058, 0.112999], [125584.9876, 0.099], [133756.5988, 0.086], 
        [142459.781, 0.074], [151729.4076, 0.064], [161602.1937, 0.054], [172117.386, 0.046], [183316.6015, 0.038], 
        [195244.7151, 0.032], [207948.9717, 0.02799], [221479.8735, 0.025], [235890.9734, 0.021], [251240.0159, 0.019], 
        [267587.7958, 0.017], [284999.0141, 0.015], [303543.4372, 0.013999], [323294.5157, 0.013], [344330.7648, 0.011], 
        [366735.4418, 0.01], [390598.3214, 0.01], [416013.9199, 0.009], [443083.2701, 0.008], [471913.507, 0.008], 
        [502620.1526, 0.00699], [535324.8297, 0.006], [570156.9769, 0.006], [607256.1655, 0.005], [646769.3381, 0.005], 
        [688853.5686, 0.005], [733675.418, 0.004], [781414.486, 0.004]]
    }


    
    plot1 = $.jqplot("chart1", [dataSets.national], {
        title: "Probability Density Function",
        cursor: {
            show: false
        },
        highlighter: {
            show: true,
            showMarker: false,
            useAxesFormatters: false,
            formatString: '%d, %.1f'
        },
        axesDefaults: {
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
        },
        seriesDefaults: {
            showMarker: false
        },
        axes: {
            xaxis: {
                label: 'Per Capita Expenditure (local currency)',
                renderer: $.jqplot.LogAxisRenderer,
                pad:0,
                ticks: [700, 7000, 70000, 700000, {value:1000000, showLabel:false, showMark:false, showGridline:false}],
                tickOptions: {
                    formatString: "%d"
                }
            },
            yaxis: {
                label: 'Population Share (%)',
                forceTickAt0: true,
                pad: 0
            }
        },
        grid: {
            drawBorder: false,
            shadow: false,
            // background: 'rgba(0,0,0,0)'  works.
            background: "white"
        },
        canvasOverlay: {
            show: true,
            objects: [
                {verticalLine: {
                    name: "line1",
                    x: 8250,
                    color: "#d4c35D",
                    yOffset: 0,
                    shadow: false,
                    showTooltip: true,
                    tooltipFormatString: "PCE=%'d",
                    showTooltipPrecision: 0.5
                }},
                {verticalLine: {
                    name: "line2",
                    x: 60000,
                    color: "#d4c35D",
                    yOffset: 0,
                    shadow: false,
                    showTooltip: true,
                    tooltipFormatString: "PCE=%'d",
                    showTooltipPrecision: 0.5
                }}
            ]
        }
    });

    var d = new $.jsDate();
    $("div.jqplot-datestamp").html("Generated on "+d.strftime("%v"));

    $("input[type=radio][name=backgroundColor]").change(function(){ 
        plot1.grid.background = $(this).val();
        plot1.replot();
    });

    $("input[type=radio][name=dataSeries]").change(function(){ 
        var val = $(this).val();
        plot1.series[0].data = dataSets[val];

        switch (val) {
            case "national":
                plot1.series[0].renderer.shapeRenderer.strokeStyle = "#4bb2c5";
                break;
            case "urban":
                plot1.series[0].renderer.shapeRenderer.strokeStyle = "#c54b62";
                break;
            case "rural":
                plot1.series[0].renderer.shapeRenderer.strokeStyle = "#b2c54b";
                break;
            default:
                plot1.series[0].renderer.shapeRenderer.strokeStyle = "#4bb2c5";
                break;
        }
        // hack to make sure plot auto computes a new format string if needed.
        plot1.axes.yaxis.tickOptions.formatString = ''
        plot1.replot({resetAxes:["yaxis"]});
    });

    $("input[type=checkbox][name=gridsVertical]").change(function(){
        plot1.axes.xaxis.tickOptions.showGridline = this.checked;
        plot1.replot();
    });

    $("input[type=checkbox][name=gridsHorizontal]").change(function(){
        plot1.axes.yaxis.tickOptions.showGridline = this.checked;
        plot1.replot();
    });

    $("input[type=text][name=userLine1]").keyup(function(){
        var val = parseFloat($(this).val());
        plot1.plugins.canvasOverlay.get("line1").options.x = val;
        plot1.replot();
    });

    $("input[type=text][name=userLine2]").keyup(function(){
        var val = parseFloat($(this).val());
        plot1.plugins.canvasOverlay.get("line2").options.x = val;
        plot1.replot();
    });

    $("input[type=radio][name=lineWidth]").change(function(){
        var val = parseFloat($(this).val()), shadowOffset; 
        plot1.series[0].renderer.shapeRenderer.lineWidth = val;
        plot1.series[0].renderer.shadowRenderer.lineWidth = val;
        // for thick lines, scale shadow offset.
        if (val > 2.5) {
            shadowOffset = 1.25 * (1 + (Math.atan((val/2.5))/0.785398163 - 1)*0.6);
            // var shadow_offset = this.shadowOffset;
        }
        // for skinny lines, don't make such a big shadow.
        else {
            shadowOffset = 1.25*Math.atan((val/2.5))/0.785398163;
        }
        plot1.series[0].renderer.shadowRenderer.offset = shadowOffset;
        plot1.plugins.canvasOverlay.get("line1").options.lineWidth = val;
        plot1.plugins.canvasOverlay.get("line2").options.lineWidth = val;
        plot1.replot();
    });
    
    
    $("div.chart-container").resizable({delay:20});    

    $("div.chart-container").bind("resize", function(event, ui) {
        plot1.replot();
    });
});

</script>


<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.logAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.cursor.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasTextRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.highlighter.js"></script>
  <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasOverlay.js"></script>
  <script class="include" type="text/javascript" src="jquery-ui/js/jquery-ui.min.js"></script>

<!-- End additional plugins -->

<?php include "closer.html"; ?>
