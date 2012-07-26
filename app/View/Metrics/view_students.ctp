<div id="sidebarleft">
	<h1>Metrics Section</h1>
	<div id="sidemenu" >
		<ul>
			<li class="active">
				<a class="icon icon4-student" href="metrics-section-students.html">Students</a>
				<ul>
					<li id="groupNavAll"><a href="#" class="active">All Students</a></li>
					<?php if($challenge['Group']){
						foreach($challenge['Group'] as $k=>$g){ ?>
							<li id="groupNav<?php echo $g['id']; ?>">
								<a href="#">Group <?php echo ($k + 1); ?></a>
							</li>
						<?php }
					}else{
						foreach($challenge['ClassSet'] as $c){ ?>
							<li id="groupNav<?php echo $c['id']; ?>">
								<a href="#"><?php echo $c['group_name']; ?></a>
							</li>
						<?php }
					} ?>
				</ul>
			</li>
			<li ><a class="icon icon4-question" href="metrics-section-question-activity.html">Question Activity</a></li>
			<li ><a class="icon icon4-graph" href="metrics-section-charting.html">Charting</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo $challenge['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-notes"><a href="#" >Student Work</a></li>
			<li class="action-preview"><a href="#" >Assignment</a></li>
			<li class="action-exit"><a href="#" >Exit</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<span class="icon2 icon2-people-green"></span>
				<h2 >Student Analysis: All Students</h2>
				<a href="#modal-customize" class="modal-link customize-link">Customize</a>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-students-analysis" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" width="20%"><a href="#" class="sort sortdown">Student Name</a></th>
							<th class="col2" width="23%"><a href="#" class="sort sortdown">Completion Level</a></th>
							<th class="col3" width="23%"><a href="#" class="sort sortdown">Average Quality Level</a></th>
							<th class="col4" width="23%"><a href="#" class="sort sortdown">Students Activity Level</a></th>
							<th class="col5" width="7%"></th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$idx = 0;
						foreach($challenge['ClassSet'] as $c){
							foreach($c['User'] as $u){
								$idx++;
								?>
								<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
									<td class="col1"><a class="modal-link" href="#modal-collaborators"><?php echo "{$u['firstname']} {$u['lastname']}"; ?></a></td>
									<td class="col2">
										<div class="activity-level activity-level-blue">
											<span style="width: <?php echo ($u['completion'] * 100); ?>%"></span>
										</div>
										<div class="activity-level-percentage"><?php echo round($u['completion'] * 100); ?>%</div>
										<div class="clear"></div>
									</td>
									<td class="col3">
										<div class="activity-level activity-level-red">
											<span style="width: <?php echo ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 4) * 100); ?>%"></span>
										</div>
										<div class="activity-level-percentage"><?php echo round((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 4) * 100); ?>%</div>
										<div class="clear"></div>
									</td>
									<td class="col4">
										<div class="activity-level">
											<span style="width: <?php echo ((((($u['keystrokes'] - $min_keystrokes) / $max_keystrokes) + (($u['comments'] - $min_comments) / $max_comments)) / 2) * 100); ?>%"></span>
										</div>
										<div class="activity-level-percentage">
											<?php echo round((((($u['keystrokes'] - $min_keystrokes) / $max_keystrokes) + (($u['comments'] - $min_comments) / $max_comments)) / 2) * 100); ?>%
										</div>
										<div class="clear"></div>
									</td>
									<td class="col5">
										<ul class="table-toggle-button">
											<li class="value-false active"></li>
											<li class="value-true"></li>
										</ul>
									</td>
								</tr>
							<?php }
						} ?>
					</tbody>
					
				</table>
			</div>
		</div>
		
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 80px; margin: 0 auto;">
		<a href="#" class="btn2"><span>Next</span></a>
	</div>

</div>

<div class="clear"></div>

<div style="display: none;">
	<div id="modal-customize">
		
		<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
			
			<div class="modal-box-head">
				<span class="icon icon-customize"></span>
				<h2><span >Customize</span></h2>
			</div>
			<div class="modal-box-content">
				
				<ul style="width: 550px; margin: 0 auto;">
					<li style="margin-bottom: 20px">
						<p>1. Select Date Range: (Select dropdown or enter dates manually)</p>
						<p><select >
								<option value="">- Select Date Range - </option>
								<option value="">Date Range 1</option>
							</select> -or-
						</p>
						<p>
							From
							<span class="date-input-wrap" >
								<input type="text" value="" size="20" /> 
								<a href="#" class="datepicker"></a> 
							</span>	
							to 
							<span class="date-input-wrap" >
								<input type="text" value="" size="20" /> 
								<a href="#" class="datepicker"></a>
							</span>
						</p>
					</li>
					<li style="margin-bottom: 40px;">
						<p>2. View quality of studentís work based on:</p>
						<p>
							<select >
								<option value="">- Select Ordering Type - </option>
								<option value="">Ordering Option 1</option>
							</select>
						</p>
					</li>
				</ul>
				
				<div style="width: 210px; margin: 0 auto 20px auto; ">
					<div style="width: 80px; float: left;">
						<a href="#" class="btn2" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span>Run</span></a>
					</div>
					<div style="width: 80px; float: right;">
						<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function($){
	
		$(".table-toggle-button li").click(function(){
			if(!$(this).hasClass("active")) {
				$(".table-toggle-button li").removeClass("active"); 
				$(this).addClass("active");
				if($(this).hasClass("value-true")) $(".activity-level-percentage").show(); 
				else $(".activity-level-percentage").hide(); 
			}
		}); 
		
		
		$(".modal-link").fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true,
			'width' : 500
		}); 
		
	}); 
	
</script>