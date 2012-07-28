<div id="assignmentDialog" style="display:none;"> </div>

<div id="sidebarleft">
	<h1>Metrics Section</h1>
	<div id="sidemenu" >
		<ul>
			<li><a class="icon icon4-student" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/">Students</a></li>
			<li><a class="icon icon4-question" href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/">Question Activity</a></li>
			<li class="active"><a class="icon icon4-graph" href="#">Charting</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo $challenge['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-notes"><a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/">Summary</a></li>
			<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;">Assignment</a></li>
			<li class="action-exit"><a href="/">Exit</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<span class="icon2 icon2-graph"></span>
				<h2 >Charting</h2>
				<a href="#" class="customize-link">Customize</a>
				<div class="clear"></div>
			</div>
			<div class="box-content" style="text-align:center">
				<script type="text/javascript">
				      google.setOnLoadCallback(drawChart);
				      function drawChart() {
								var data = new google.visualization.DataTable();
								data.addColumn('number', 'Quality');
								data.addColumn('number', 'Activity');
								data.addColumn({type:'string', role:'tooltip'});
					
				        data.addRows([
									<?php
									$idx = 0;
									foreach($challenge['ClassSet'] as $c){
										foreach($c['User'] as $u){
											$idx++; ?>
											<?php if($idx > 1) echo ","; ?>
											[<?php echo round($quality[$u['id']][0] ? (100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0); ?>,
											<?php echo round((((($u['keystrokes'] - $min_keystrokes) / $max_keystrokes) + (($u['comments'] - $min_comments) / $max_comments)) / 2) * 100); ?>,
											'<?php echo "{$u['firstname']} {$u['lastname']}"; ?>']
										<?php }
									} ?>
				        ]);

				        var options = {
				          title: 'Student Quality / Activity in Bridge',
				          hAxis: {title: 'Quality', minValue: 0, maxValue: 100},
				          vAxis: {title: 'Activity', minValue: 0, maxValue: 100},
				          legend: 'none'
				        };

				        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
				        chart.draw(data, options);
				      	google.visualization.events.addListener(chart,'select',selectHandler);
							}

							function selectHandler(){
								window.location = '/responses/view/<?php echo $challenge['Challenge']['id']; ?>';//+rowMap[chart.getSelection()[0].row];
							}
				    </script>
						<div id="chart_div" style="width: 500px; height: 320px; display:inline-block;"></div>
			</div>
		</div>
		
	</div>
	
	<div class="clear"></div>
	
</div>

<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
			$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740 });
		});
	});
		
</script>