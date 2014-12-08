<?php
require_once('header.php');
?>

<?php
require_once('fetchstats.php'); // Fetches All statistics Needed from the website
?>
<h4>LP Dashboard</h4><br/><br/>
<div class="row">
    <!--Dashboard Left Tab-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 panel-default">
        <table class="table table-condensed table-bordered">
            <thead><tr><td colspan="2"><center><b>Website Statistics</b></center></td></tr></thead>
            <tbody>
                <tr><td>Website Users</td><td><?=$site_stats->user_count;?></td></tr>
                <tr><td>Active Users 1 Week</td><td><?=$site_stats->user_week;?></td></tr>
                <tr><td>Active Users Within 1 Month</td><td><?=$site_stats->user_month;?></td></tr>
                <tr><td>Points In Circulation</td><td><?=$site_stats->points_all;?> </td></tr>
            </tbody>
        </table>
    </div>
    
    <!--Main Body-->
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
        <div class="panel panel-default">
            <table class="table infograph-top hidden-xs">
                <tr>
                    <td>Users Online Today: <?=$site_stats->user_today;?></td>
                    <td>Hits Today:</td>
                    <td>Purchase today: <?=$site_stats->cash_today;?></td>
                   
                    <td class="systemtime">System Date/Time: <?php echo date('Y-m-d | h:i:s a');?></td>
                 
                </tr>
                
            </table>
        </div>
        </div>
        <div class="row section-charts">
            <div class="col-lg-6">
            <b>User Activity (User Signups)</b><br/>
            <div style="width: 100%">
                <canvas id="canvas" height="200" width="600"></canvas>
            </div>
            </div>
            <div class="col-lg-6">
                <b>Payment Statistics (in USD $)</b>
                <div style="width: 100%">
                    <canvas id="canvas2" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--JS CHARTS-->

<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [<?php
            end($site_stats->user_activity);
            $last_key = key($site_stats->user_activity);
                foreach($site_stats->user_activity as $key=>$val){
                    echo '"'.$key.'"';
                    if($key != $last_key) echo ',';
                }
            ?>],
			datasets : [
				{
					label: "User Activity",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php
            end($site_stats->user_activity);
            $last_key = key($site_stats->user_activity);
                foreach($site_stats->user_activity as $key=>$val){
                    echo $val;
                    if($key != $last_key) echo ',';
                }
            ?>]
				}
			]
		}
        
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData2 = {
			labels : [<?php
            end($site_stats->cash_activity);
            $last_key = key($site_stats->cash_activity);
                foreach($site_stats->cash_activity as $key=>$val){
                    echo '"'.$key.'"';
                    if($key != $last_key) echo ',';
                }
            ?>],
			datasets : [
				{
					label: "Cash Activity",
					fillColor : "rgba(126,246,114,0.2)",
					strokeColor : "rgba(126,246,114,1)",
					pointColor : "rgba(126,246,114,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php
            end($site_stats->cash_activity);
            $last_key = key($site_stats->cash_activity);
                foreach($site_stats->cash_activity as $key=>$val){
                    echo $val;
                    if($key != $last_key) echo ',';
                }
            ?>]
				},
				
			]

		}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
        
        var ctx = document.getElementById("canvas2").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData2, {
			responsive: true
		});
	}
	</script>
    
   
    <!--END OF JS CHARTS-->
<?php require_once('footer.php');?>