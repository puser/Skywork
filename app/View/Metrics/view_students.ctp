<style type="text/css"> .activity-level span{ display:none; } </style>
<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<div id="sidebarleft">
	<h1><?php echo __('Metrics Section') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li class="active">
				<a class="icon icon4-student" href="#"><?php echo __('Students') ?></a>
				<?php if(count($challenges) == 1 && $challenges[0]['Group']){ ?>
					<ul>
						<li id="groupNavAll"><a href="/metrics/view_students/<?php echo $challenges[0]['Challenge']['id']; ?>/" class="active">
							<?php echo (!$group_id ? '<strong>' : '' ).__('All Students').(!$group_id ? '</strong>' : '' ); ?>
						</a></li>
						<?php foreach($challenges[0]['Group'] as $k=>$g){ ?>
							<li id="groupNav<?php echo $g['id']; ?>">
								<a href="/metrics/view_students/<?php echo $challenges[0]['Challenge']['id']; ?>/<?php echo $g['id']; ?>">
									<?php echo ($group_id == $g['id'] ? '<strong>' : '').__('Group').' '.($k + 1).($group_id == $g['id'] ? '</strong>' : ''); ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</li>
			<li><a class="icon icon4-question" href="/metrics/view_questions/<?php echo $challenges[0]['Challenge']['id']; ?>/"><?php echo __('Question Activity') ?></a></li>
			<li><a class="icon icon4-graph" href="/metrics/view_students/<?php echo $challenges[0]['Challenge']['id']; ?>/0/1"><?php echo __('Charting') ?></a></li>
			<li><a class="icon icon4-flag" href="/metrics/view_flags/<?php echo $challenges[0]['Challenge']['id']; ?>/"><?php echo __('Red Flags') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo (count($challenges) == 1 ? $challenges[0]['Challenge']['name'] : 'Custom Report'); ?></div>
	
	<div class="actionmenu">
		<ul>
			<?php if(count($challenges)==1){ ?>
				<li class="action-notes"><a href="/responses/view/<?php echo $challenges[0]['Challenge']['id']; ?>/0"><?php echo __('Summary') ?></a></li>
				<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;"><?php echo __('Assignment') ?></a></li>
			<?php } ?>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<span class="icon2 icon2-people-green"></span>
				<h2><?php echo __('Student Analysis:') ?> <?php echo __('All Students') ?></h2>
				<a href="#modal-customize" class="modal-link customize-link"><?php echo __('Customize') ?></a>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-students-analysis" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" width="20%"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
							<th class="col2" width="23%"><a href="#" class="sort"><?php echo __('Completion Level') ?></a></th>
							<th class="col3" width="23%"><a href="#" class="sort"><?php echo __('Average Quality Level') ?></a></th>
							<th class="col4" width="23%"><a href="#" class="sort"><?php echo __('Students Activity Level') ?></a></th>
							<th class="col5" width="7%"></th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$idx = 0;
						$listed_users = array();
						foreach($challenges as $challenge){
							foreach($challenge['ClassSet'] as $c){
								foreach($c['User'] as $u){
									if(in_array($u['id'],$listed_users)) continue;
									else $listed_users[] = $u['id'];
									$idx++;
									?>
									<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
										<td class="col1"><a class="modal-link" href="#modal-collaborators"><?php echo "{$u['firstname']} {$u['lastname']}"; ?></a></td>
										<td class="col2">
											<div class="activity-level activity-level-blue">
												<span style="width: <?php echo ((@$activity[$u['id']]['responses'] / @$activity[$u['id']]['questions']) * 100); ?>%"></span>
											</div>
											<div class="activity-level-percentage"><?php echo round((@$activity[$u['id']]['responses'] / @$activity[$u['id']]['questions']) * 100); ?>%</div>
											<div class="clear"></div>
										</td>
										<td class="col3">
											<div class="activity-level activity-level-red">
												<span style="width: <?php if(($quality[$u['id']][0] ? (100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0) <100){echo ($quality[$u['id']][0] ? (100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0); }else{ echo 100; }?>%"></span>
											</div>
											<div class="activity-level-percentage"><?php if(($quality[$u['id']][0] ? round(100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0)<100){ echo ($quality[$u['id']][0] ? round(100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0); }else{ echo 100; } ?>%</div>
											<div class="clear"></div>
										</td>
										<td class="col4">
											<div class="activity-level">
												<span style="width: <?php if((((((($activity[$u['id']]['keys'] / count($activity[$u['id']]['challenges'])) - $min_keystrokes) / ($max_keystrokes ? $max_keystrokes : 1)) + ((($activity[$u['id']]['comments'] / count($activity[$u['id']]['challenges'])) - $min_comments) / ($max_comments ? $max_comments : 1))) / 2) * 100)<100){echo (((((($activity[$u['id']]['keys'] / count($activity[$u['id']]['challenges'])) - $min_keystrokes) / ($max_keystrokes ? $max_keystrokes : 1)) + ((($activity[$u['id']]['comments'] / count($activity[$u['id']]['challenges'])) - $min_comments) / ($max_comments ? $max_comments : 1))) / 2) * 100); }else{ echo 100; } ?>%"></span>
											</div>
											<div class="activity-level-percentage">
												<?php if(round(((((($activity[$u['id']]['keys'] / count($activity[$u['id']]['challenges'])) - $min_keystrokes) / ($max_keystrokes ? $max_keystrokes : 1)) + ((($activity[$u['id']]['comments'] / count($activity[$u['id']]['challenges'])) - $min_comments) / ($max_comments ? $max_comments : 1))) / 2) * 100) < 100){echo round(((((($activity[$u['id']]['keys'] / count($activity[$u['id']]['challenges'])) - $min_keystrokes) / ($max_keystrokes ? $max_keystrokes : 1)) + ((($activity[$u['id']]['comments'] / count($activity[$u['id']]['challenges'])) - $min_comments) / ($max_comments ? $max_comments : 1))) / 2) * 100);}else{echo 100;} ?>%
											</div>
											<div class="clear"></div>
										</td>
										<td class="col5">
											<ul class="table-toggle-button" style="display:none;">
												<li class="value-false active"></li>
												<li class="value-true"></li>
											</ul>
										</td>
									</tr>
								<?php }
							}
						} ?>
					</tbody>
					
				</table>
			</div>
		</div>
		
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 80px; margin: 0 auto;">
		<a href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/" class="btn2"><span><?php echo __('Next') ?></span></a>
	</div>

</div>

<div class="clear"></div>

<div style="display: none;">
	<div id="modal-customize">
		
		<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
			
			<div class="modal-box-head">
				<span class="icon icon-customize"></span>
				<h2><span><?php echo __('Customize') ?></span></h2>
			</div>
			<div class="modal-box-content">
				<form id="custom_metrics" action="/metrics/view_students/" method="POST">
				<ul style="width: 550px; margin: 0 auto;">
					<li style="margin-bottom: 20px">
						<p>1. View metrics for my following classes:</p>
						<p><select name="class_id">
								<option value="">All my classes</option>
								<?php foreach($user['ClassSet'] as $c){ ?>
									<option value="<?php echo $c['id']; ?>"<?php if(@$_REQUEST['class_id'] == $c['id']) echo ' selected="selected"'; ?>><?php echo $c['group_name']; ?></option>
								<?php } ?>
							</select>
						</p>
					</li>
					<li style="margin-bottom: 20px">
						<p>2. Select date range:</p>
						<p><select name="date_range">
								<option value="1"<?php if(@$_REQUEST['date_range'] == 1) echo ' selected="selected"'; ?>>Most recent bridge</option>
								<option value="2"<?php if(@$_REQUEST['date_range'] == 2) echo ' selected="selected"'; ?>>Last 2 bridges</option>
								<option value="3"<?php if(@$_REQUEST['date_range'] == 3) echo ' selected="selected"'; ?>>Last 3 bridges</option>
								<option value="4"<?php if(@$_REQUEST['date_range'] == 4) echo ' selected="selected"'; ?>>Last 4 bridges</option>
								<option value="5"<?php if(@$_REQUEST['date_range'] == 5) echo ' selected="selected"'; ?>>Last 5 bridges</option>
							</select>
						</p>
					</li>
					<li style="margin-bottom: 40px;">
						<p>3. View quality of students' work based on:</p>
						<p>
							<select name="quality">
								<option value="I"<?php if(@$_REQUEST['quality'] == 'I') echo ' selected="selected"'; ?>>Instructor feedback only</option>
								<option value="S"<?php if(@$_REQUEST['quality'] == 'S') echo ' selected="selected"'; ?>>Student feedback only</option>
								<option value="A"<?php if(@$_REQUEST['quality'] == 'A') echo ' selected="selected"'; ?>>Instructor &amp; student feedback</option>
							</select>
						</p>
					</li>
				</ul>
				</form>
				<div style="width: 210px; margin: 0 auto 20px auto; ">
					<div style="width: 80px; float: left;">
						<a href="#" onclick="$('#custom_metrics').submit();return false;" class="btn2" style="width: 100%" onclick="jQuery.fancybox.close(); return false; ">
							<span><?php echo __('Run') ?></span>
						</a>
					</div>
					<div style="width: 80px; float: right;">
						<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function($){
		
		setTimeout(function(){
			$('.activity-level span').each(function(){
				w = $(this).width();
				$(this).width(0);
				$(this).css('display','inline-block');
				$(this).animate({'width':w});
			});
		},320);
		
	<?php if(count($listed_users)){ ?>
		$("#metrics-students-analysis").tablesorter({ 
				sortList: [[0,0]],
				cssDesc: 'sortup',
				cssAsc: 'sortdown',
        textExtraction: function(node){ 
					return $(node).children('a').length ? $(node).children('a').html() : ($(node).children('div').length ? $(node).children('.activity-level').children('span').first().css('width') : $(node).html());
        } 
    });
	<?php } ?>

		$("#metrics-students-analysis").bind("sortEnd",function() { 
			$('#metrics-students-analysis tbody tr').removeClass('alternate');
			var idx = 0;
			$('#metrics-students-analysis tbody tr').each(function(){
				if(++idx % 2) $(this).addClass('alternate');
			});
		});
	
	<?php if(count($challenges)==1){ ?>
		$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
			$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
		});
	<?php } ?>
		
		$(".table-toggle-button li").click(function(){
			if(!$(this).hasClass("active")) {
				$(".table-toggle-button li").removeClass("active"); 
				if($(this).hasClass('value-false')){
					$('.value-false').addClass("active");
					$(".activity-level-percentage").hide(); 
					set_stat_session(0);
				}else{
					$('.value-true').addClass("active");
					$(".activity-level-percentage").show(); 
					set_stat_session(1);
				}
			}
		}); 
		
		<?php if(@$_SESSION['show_stats']){ ?>
			$('.value-true').first().click();
		<?php } ?>
		
		$(".modal-link").fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true,
			'width' : 500
		}); 
		
	}); 
	
</script>