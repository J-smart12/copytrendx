<?php
$page_title = 'Dashboard';
include 'header.php';
?>

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total Clients</span>
            <div class="count"><?php echo count($clients); ?></div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-comments"></i> New Messages</span>
            <div class="count"><?php echo count($messages); ?></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>12% </i> From last Week</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Total Revenue</span>
            <div class="count">$<span class="counter">24,315</span></div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Month</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-line-chart"></i> Growth Rate</span>
            <div class="count">12.5%</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>2% </i> From last Month</span>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Revenue Overview <small>Weekly progress</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="demo-container" style="height:280px">
                        <div id="chart_plot_02" class="demo-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Activity <small>Weekly</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 5px; margin-bottom: 5px;">
                        <div class="col-xs-6">
                            <div id="sparkline_bar"></div>
                        </div>
                        <div class="col-xs-6">
                            <div id="sparkline_area" class="text-center"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4" style="text-align: center;">
                            <h3>45%</h3>
                            <p>New Users</p>
                        </div>
                        <div class="col-xs-4" style="text-align: center;">
                            <h3>65%</h3>
                            <p>Returning</p>
                        </div>
                        <div class="col-xs-4" style="text-align: center;">
                            <h3>85%</h3>
                            <p>Engagement</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Activities <small>Latest actions</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled msg_list">
                        <?php foreach(array_slice($lmessages, 0, 5) as $message): ?>
                        <li>
                            <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                                    <span><?php echo htmlspecialchars($message['name']); ?></span>
                                    <span class="time"><?php echo date('H:i', strtotime($message['created_at'])); ?></span>
                                </span>
                                <span class="message">
                                    <?php echo substr(htmlspecialchars($message['message']), 0, 50); ?>...
                                </span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Quick Stats <small>Overview</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="dashboard-widget-content">
                                <div class="sidebar-widget">
                                    <h4>Goal Completion</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-green" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                    </div>
                                    <h4>Server Load</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-blue" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">35%</div>
                                    </div>
                                    <h4>Bandwidth</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-widget-content">
                                <div class="sidebar-widget">
                                    <h4>Tasks</h4>
                                    <div class="sidebar-widget-count">15</div>
                                    <h4>Projects</h4>
                                    <div class="sidebar-widget-count">8</div>
                                    <h4>Team Members</h4>
                                    <div class="sidebar-widget-count">24</div>
                                    <h4>Open Tickets</h4>
                                    <div class="sidebar-widget-count">5</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- jQuery Sparklines -->
<script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>

<!-- Custom Theme Scripts -->
<script>
    $(document).ready(function() {
        // Sparkline charts
        var sparklineCharts = function() {
            $("#sparkline_bar").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                barColor: '#26B99A',
                height: '40',
                barWidth: 8
            });

            $("#sparkline_area").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
                type: 'line',
                lineColor: '#26B99A',
                fillColor: '#26B99A',
                height: '40',
                width: '100%'
            });
        };

        // Initialize charts
        sparklineCharts();

        // Flot chart
        if ($("#chart_plot_02").length) {
            var data1 = [
                [0, 1],
                [1, 9],
                [2, 6],
                [3, 10],
                [4, 7],
                [5, 11],
                [6, 13],
                [7, 9],
                [8, 12],
                [9, 10],
                [10, 12],
                [11, 16],
                [12, 15],
                [13, 12],
                [14, 15],
                [15, 16],
                [16, 18],
                [17, 15],
                [18, 19],
                [19, 20],
                [20, 18],
                [21, 20],
                [22, 19],
                [23, 22],
                [24, 20],
                [25, 18],
                [26, 20],
                [27, 19],
                [28, 21],
                [29, 20],
                [30, 22]
            ];

            var data2 = [
                [0, 3],
                [1, 6],
                [2, 4],
                [3, 7],
                [4, 9],
                [5, 10],
                [6, 12],
                [7, 13],
                [8, 9],
                [9, 11],
                [10, 12],
                [11, 14],
                [12, 12],
                [13, 15],
                [14, 17],
                [15, 14],
                [16, 16],
                [17, 19],
                [18, 21],
                [19, 17],
                [20, 19],
                [21, 18],
                [22, 21],
                [23, 20],
                [24, 21],
                [25, 19],
                [26, 20],
                [27, 22],
                [28, 24],
                [29, 23],
                [30, 25]
            ];

            var chart_plot_02 = $.plot($("#chart_plot_02"), [{
                data: data1,
                label: "Current Month",
                color: "#26B99A"
            }, {
                data: data2,
                label: "Previous Month",
                color: "#03586A"
            }], {
                series: {
                    lines: {
                        show: true,
                        fill: 0.2,
                        fillColor: {
                            colors: [{
                                opacity: 0.5
                            }, {
                                opacity: 0.15
                            }]
                        }
                    },
                    points: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                xaxis: {
                    ticks: 10,
                    tickDecimals: 0
                },
                yaxis: {
                    ticks: 10,
                    tickDecimals: 0
                },
                legend: {
                    position: 'nw',
                    backgroundColor: null,
                    margin: [30, 15]
                }
            });

            $("#chart_plot_02").bind("plothover", function(event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    $(".tooltip").html(item.series.label + " of " + x + " = " + y)
                        .css({
                            top: item.pageY + 5,
                            left: item.pageX + 5
                        })
                        .fadeIn(200);
                } else {
                    $(".tooltip").hide();
                }
            });

            $("<div class='tooltip' id='tooltip'></div>").appendTo("body");
        }
    });
</script>
