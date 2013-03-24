<style type='text/css'>
.opened { background-color:#D9E8F1 !important; }
.remove-class:hover a.remove-class-icon { background: url('/images/arrow-down-purple.png') no-repeat center center !important; }
.remove-class:hover,.remove-class.open,.remove-class { border:0 !important;height:16px; }
.remove-class.open:hover a.remove-class-icon,.remove-class.open a.remove-class-icon{ background:transparent url('/images/arrow-up-purple.png') no-repeat center center !important; }
</style>

<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<div id="sidebarleft">
	<h1><?php echo __('Metrics Section') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li><a class="icon icon4-student" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Students') ?></a></li>
			<?php if($challenge['Challenge']['collaboration_type'] != 'NONE'){ ?>
				<li><a class="icon icon4-question" href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Question Activity') ?></a></li>
				<?php if($challenge['Challenge']['instructor_ratings']){ ?>
					<li><a class="icon icon4-graph" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/0/1"><?php echo __('Charting') ?></a></li>
				<?php }
			} ?>
			<li class="active"><a class="icon icon4-flag" href="/metrics/view_flags/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Flagging') ?></a></li>
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
				<span class="icon2 icon2-flag"></span>
				<h2><?php echo __('Flagging') ?></h2>
				<a href="#modal-customize" class="modal-link customize-link"><?php echo __('Customize') ?></a>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-students-analysis" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" width="30%"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
							<th class="col2" width="16%"><a href="#" class="sort"><?php echo __('Incidents') ?></a></th>
							<th class="col3" width="45%"></th>
							<th class="col5" width="9%"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$idx = 0;
						$listed_users = array();
						foreach($challenge['ClassSet'] as $ci=>$c){
							foreach($c['User'] as $ui=>$u){
								if(in_array($u['id'],$listed_users) || (!@$user_flags[$u['id']] && !@$maxwords_flag[$u['id']]) || $u['user_type'] != 'P') continue;
								else $listed_users[] = $u['id'];
								$idx++;
								?>
						<tr <?php if($idx % 2){ ?>class="alternate"<?php } ?> onmouseover="$(this).find('.studentwork-more,.remove-class').show();" onmouseout="$(this).find('.studentwork-more').hide();if(!$(this).find('.remove-class').hasClass('open')){ $(this).find('.remove-class').hide(); }">
							<td class="col1">
								<a href="#" onclick="$(this).parents('tr').toggleClass('opened');$(this).parents('tr').nextUntil(':not(.flag_details)').toggle();$(this).next().toggleClass('open');" style="float:left;">
									<?php echo $u['firstname'].' '.$u['lastname']; ?>
								</a>
								<div class="remove-class" style="margin-left:10px;display:none;float:left;">
									<a class="remove-class-icon" href="#" onclick="return false;"></a>
								</div>
							</td>
							<td class="col2"><?php echo @$user_flag_total[$u['id']]; ?></td>
							<td></td>
							<td class="col5">
								<a href="<?php echo $u['id']; ?>" onclick="userflag('/word_flags/browse/<?php echo $u['id']; ?>/<?php echo $challenge['Challenge']['id']; ?>',$(this).index('.userLevelLink'));return false;" class="studentwork-more userLevelLink" id="students-highest-quality-more" style="display:none;margin-left:0;">
									<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;"><?php echo __('View'); ?></span>
								</a>
							</td>
						</tr>
						<?php if(@$user_flags[$u['id']]){
							foreach(@$user_flags[$u['id']] as $f=>$c){
								foreach($c as $word=>$count){ ?>
									<tr class="flag_details" style="display:none;background-color:#fffef6;" onmouseover="$(this).find('.studentwork-more').show();" onmouseout="$(this).find('.studentwork-more').hide();">
										<td class="col1"><?php echo ($f == 'WORD' ? 'Word Overuse' : ($f == 'EXPL' ? 'Explicit Language' : 'Phrase Flag')); ?></td>
										<td class="col2"><?php echo $count; ?></td>
										<td class="col3"><?php echo ($f == 'EXPL' ? substr($word,0,1) . str_repeat('*',strlen($word) - 1) : $word); ?></td>
										<td class="col5">
											<a href="/word_flags/browse/<?php echo $u['id']; ?>/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $f; ?>/<?php echo $word; ?>" class="studentwork-more" id="students-highest-quality-more" style="display:none;margin-left:0;">
												<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;"><?php echo __('View'); ?></span>
											</a>
										</td>
									</tr>
						<?php }}}if(@$maxwords_flag[$u['id']]){ ?>
							<tr class="flag_details" style="display:none;background-color:#fffef6;" onmouseover="$(this).find('.studentwork-more').show();" onmouseout="$(this).find('.studentwork-more').hide();">
								<td class="col1">Assignment Maximum</td>
								<td class="col2"><?php echo $maxwords_flag[$u['id']]['flags']; ?></td>
								<td class="col3"><?php echo $maxwords_flag[$u['id']]['words']; ?> over maximum allowed</td>
								<td class="col5">
									<a href="/word_flags/browse/<?php echo $u['id']; ?>/<?php echo $challenge['Challenge']['id']; ?>/MAX" class="studentwork-more" id="students-highest-quality-more" style="display:none;margin-left:0;">
										<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;"><?php echo __('View'); ?></span>
									</a>
								</td>
							</tr>
						<?php }}} ?>
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
				<table class="table-type-1">
					<thead>
						<tr>
							<th width="200"><?php echo __('Flag Name') ?></th>
							<th><?php echo __('Created') ?></th>
							<th><?php echo __('Last Edit') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr class="alternate">
							<td>Explicit Language</td>
							<td>05/10/2012</td>
							<td></td>
							<td>
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul><li><a href="/word_flags/view/EXPL" class="icon3 icon3-pen modal-link" style="width:35px;">Edit</a></li></ul>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Word Overuse Warning</td>
							<td>05/10/2012</td>
							<td></td>
							<td>
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul><li><a href="/word_flags/view/" class="icon3 icon3-pen modal-link" style="width:35px;">Edit</a></li></ul>
									</div>
								</div>
							</td>
						</tr>
						<!-- DEPRECIATED 1/12/2012
						<tr class="alternate">
							<td>Phrase Flag</td>
							<td>05/10/2012</td>
							<td></td>
							<td>
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul><li><a href="/word_flags/view/PHRASE" class="icon3 icon3-pen modal-link" style="width:35px;">Edit</a></li></ul>
									</div>
								</div>
							</td>
						</tr>
						-->
					</tbody>
				</table>
			
				<div style="width:80px;margin: 0 auto 20px auto; ">
					<div style="width: 80px; float: right;">
						<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Close') ?></span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>


<script type="text/javascript">
function userflag(url,e){
	if($('.userLevelLink').length > 1){
		prev_user = e ? $($('.userLevelLink')[e - 1]).attr('href') : $('.userLevelLink').last().attr('href');
		next_user = e < $('.userLevelLink').last().index('.userLevelLink') ? $($('.userLevelLink')[e + 1]).attr('href') : $('.userLevelLink').first().attr('href');
		window.location = url + '?prev_user=' + prev_user + '&next_user=' + next_user;
	}else window.location = url;
}

jQuery(document).ready(function($){

	$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
		$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
	});

	$(".modal-link").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true,
		'width' : 500
	}); 
	
}); 
</script>