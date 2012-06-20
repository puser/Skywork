<div class="head"><div class="tl"></div><div class="tr"></div></div>
<div class="body">
	<div class="body-r">
		<div class="content" style="overflow:hidden;">
			
			<div class="box-heading" style="border-bottom:1px solid #ccc;height:36px;">
				<span class="icon icon-star"></span>
				<!-- <h2 class="page-subtitle">Statistics</h2> -->
				<select style="margin-left: 50px;margin-top: 9px;" onchange="if($(this).val()) flip_details(<?php echo $challenge['Challenge']['id']; ?>,'leaderboard');">
					<option value="">My Statistics</option>
					<option value="leaderboard">Leaderboard</option>
				</select>
			</div>
			
			<div id="leaderboard-current-standings" class="caseclub-table">
				<script type="text/javascript">
				var chart = null;
				var rowMap = new Array();

				function drawChart() {
					// Create the data table.
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Question');
					data.addColumn('number', 'Agree');
					data.addColumn('number', 'Disagree');
					data.addRows([
					<?php 
					$idx_offset = 0;
					$rowMap = '';
					foreach($challenge['Question'] as $k=>$q){
						if(!$q){
							$idx_offset++;
							continue;
						}elseif($k-$idx_offset) echo ',';
						$rowMap .= 'rowMap['.($k-$idx_offset).'] = '.$q['id'].';';
						?>
					  ['Q<?php echo ($k-$idx_offset)+1; ?>',<?php echo $q['agrees']; ?>,<?php echo $q['disagrees']; ?>]
					<?php } ?>
					]);

					<?php echo $rowMap; ?>
					// Set chart options
					var options = {
					          width: 480, height: 255,
					          title: '',
					          hAxis: {title: 'Questions',  titleTextStyle: {color: 'black'}},
							  vAxis: {gridlines:{count:1}},
							  series: [{color:'#9ed37c',visibleInLegend: true},{color:'#e65552',visibleInLegend:true}],
							  legend: {position: 'top' }
					        };

					// Instantiate and draw our chart, passing in some options.
					chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
					chart.draw(data, options);

					google.visualization.events.addListener(chart,'select',selectHandler);
				}

				function selectHandler(){
					if(chart.getSelection().length > 0){
						if(typeof chart.getSelection()[0].row !== "undefined") window.location = '/responses/view/'+rowMap[chart.getSelection()[0].row];
					}
				}

				drawChart();
				setTimeout('drawChart()',600);
				</script>
				<div class="cl-body">
					
					<a href="#" class="tooltip-q" style="top:74px;left:210px;">
						<span class="tooltip-q-text" style="left:0px;width:178px;">Click on a bar to view comments</span>
					</a>
				
					<div id="chart_div"></div>
					
					<?php if($idx_offset == count($challenge['Question'])) echo "Not enough data exists to display details for this challenge."; ?>
					
				</div>
			</div><!-- #leaderboard-current-standings -->
			
		</div>
	</div>
</div>
<div class="foot"><div class="fl"></div><div class="fr"></div></div>