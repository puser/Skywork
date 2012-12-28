<style type="text/css"> .activity-level span{ display:none; } </style>
<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<div id="sidebarleft">
	<h1><?php echo __('Metrics Section') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li><a class="icon icon4-student" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Students') ?></a></li>
			<li class="active"><a class="icon icon4-question" href="#"><?php echo __('Question Activity') ?></a></li>
			<?php if($challenge['Challenge']['instructor_ratings']){ ?>
				<li><a class="icon icon4-graph" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/0/1"><?php echo __('Charting') ?></a></li>
			<?php } ?>
			<li><a class="icon icon4-flag" href="/metrics/view_flags/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Flagging') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo $challenge['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-notes"><a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/0"><?php echo __('Summary') ?></a></li>
			<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;"><?php echo __('Assignment') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<span class="icon2 icon2-question"></span>
				<h2><?php echo __('Question Activity') ?></h2>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-question-activity" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" valign="top"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
							<th class="col2" valign="top" align="center" width="10%"><a href="#" class="sort"><?php echo __('Question') ?></th>
							<th class="col3" valign="top" align="center" width="10%">
								<a style="font-size:9px;color:#000;" href="#" class="sort image-btn"><img src="/images/icons/icon-neutral-20x20.png" /><div style="margin-top:-5px;">Neutral</div>
							</th>
							<th class="col4" valign="top" align="center" width="10%">
								<a style="font-size:9px;color:#000;" href="#" class="sort image-btn"><img src="/images/icons/icon-like-19x21.png" /><div style="margin-top:-5px;">Like</div>
							</th>
							<th class="col5" valign="top" align="center" width="10%">
								<a style="font-size:9px;color:#000;" href="#" class="sort image-btn"><img src="/images/icons/icon-like2-20x20.png" /><div style="margin-top:-5px;">Dislike</div>
							</th>
							<th class="col6" valign="top" align="center" width="20%"><a href="#" class="sort"><?php echo __('Activity Level') ?><span class="question tooltip-mark-question" title="<?php echo __('These are questions with the most activity') ?>"></span></a></th>
							<th class="col7" width="10%"></th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$idx = 0;
						foreach($challenge['Question'] as $k=>$q){
							foreach($q['Response'] as $r){
								if(!$r['positive_comments'] && !$r['negative_comments'] && !$r['neutral_comments']) continue;
								elseif($idx >= 10) break;
								$idx++; ?>
								<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
									<td class="col1"><a href="#"><?php echo "{$r['User']['firstname']} {$r['User']['lastname']}"; ?></a></td>
									<td class="col2"><?php echo ($k + 1);?></td>
									<td class="col3"><?php echo $r['neutral_comments']; ?></td>
									<td class="col3"><?php echo $r['positive_comments']; ?></td>
									<td class="col4"><?php echo $r['negative_comments']; ?></td>
									<td class="col5">
										<div class="activity-level">
											<span style="width: <?php echo (((((strlen($r['response_body']) - $min_keystrokes) / $max_keystrokes) + ((count($r['Comment']) - $min_comments) / $max_comments)) / 2) * 100); ?>%"></span>
										</div>
									</td>
									<td class="col6">
										<a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $r['User']['id']; ?>#<?php echo $q['id']; ?>" class="read-more-arrow"></a>
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
		<a href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/0/1" class="btn2"><span><?php echo __('Next') ?></span></a>
	</div>

</div>

<div class="clear"></div>

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
		
		$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
			$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740 });
		});
		
		$("#metrics-question-activity").tablesorter({ 
				sortList: [[4,1]],
				cssDesc: 'sortup',
				cssAsc: 'sortdown',
        textExtraction: function(node){ 
					return $(node).children('a').length ? $(node).children('a').html() : ($(node).children('div').length ? $(node).children('.activity-level').children('span').first().css('width') : $(node).html());
        } 
    });

		$("#metrics-question-activity").bind("sortEnd",function() { 
			$('#metrics-question-activity tbody tr').removeClass('alternate');
			var idx = 0;
			$('#metrics-question-activity tbody tr').each(function(){
				if(++idx % 2) $(this).addClass('alternate');
			});
		});
	});
		
</script>