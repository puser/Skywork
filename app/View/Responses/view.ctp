<style type="text/css">
.activeMarker {
	width:8px;
	display:inline-block;
	position:absolute;
	opacity:.6;
	cursor:pointer;
}
.inactiveMarker {
	width:3px;
	display:inline-block;
	position:absolute;
	opacity:.7;
	cursor:pointer;
}
.markerContainer {
	width:3px;
	display:inline-block;
	position:relative;
	top:-13px;
}
.activeDetail {
	background-color:#feffbd;
}
</style>

<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<div id="sidebarleft">

	<?php if($_SESSION['User']['user_type'] == 'P' && !$completed){ ?>

		<h1><?php echo __('Feedback') ?></h1>
		<p><?php echo "{$user['User']['firstname']} {$user['User']['lastname']}"; ?></p>
		<div id="sidemenu">
			<ul>
				<?php foreach($challenge[0]['Question'] as $q){ ?>
					<li class="userNav<?php if($q['id'] == $question_id){ ?> active<?php } ?>">
						<a class="no-icon" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $user['User']['id']; ?>/<?php echo $q['id']; ?>">
							<?php echo $q['section']?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	
	<?php }elseif($_SESSION['User']['user_type'] == 'P'){ ?>
		
		<h1><?php echo __('Summary') ?></h1>
		<div id="sidemenu">
			<ul>
				<?php if($challenge[0]['Group']){
					$this_group = array_pop($challenge[0]['Group']);
					foreach($this_group['User'] as $u){ ?>
						<li class="userNav<?php if($u['id'] == $user_id){ ?> active<?php } ?>" id="userNav<?php echo $u['id']; ?>">
							<div class='show_text_trimed' align='left' style='display:none'><?php if(strlen($u['firstname'].' '.$u['lastname'])>20){ echo substr($u['firstname'].' '.$u['lastname'], 0, 20).'...'; }else{ echo $u['firstname'].' '.$u['lastname']; } ?></div>
							<a class='trim_text' href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
								<?php if(strlen($u['firstname'].' '.$u['lastname'])>20){echo substr($u['firstname'].' '.$u['lastname'], 0, 20).'...';}else{ echo $u['firstname'].' '.$u['lastname']; } ?>
							</a><div class='show_text' style='display:none'><?php echo $u['firstname'].' '.$u['lastname']; ?></div>
						</li>
					<?php }
				}else{
					foreach($challenge[0]['ClassSet'] as $c){ ?>
						<li id="groupNav<?php echo $c['id']; ?>">
							<a href="#" class="sidemenu2-title"><?php echo $c['group_name']; ?></a>
							<ul>
								<?php foreach($c['User'] as $u){
									if($u['id'] == $challenge[0]['Challenge']['user_id']) continue; ?>
									<li class="userNav" id="userNav<?php echo $u['id']; ?>">
										<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
											<?php echo $u['firstname'].' '.$u['lastname']; ?>
										</a>
										<?php if($u['id'] == $user_id){ ?>
											<script type="text/javascript">
											$(document).ready(function(){	
												$("#groupNav<?php echo $c['id']; ?> a.sidemenu2-title").trigger("click");
											});
											</script>
										<?php } ?>
									</li>
									<?php } ?>
							</ul>
						</li>
					<?php }
				} ?>
			</ul>
		</div>

	<?php }else{ ?>
	
		<h1><?php echo ($completed ? __('Summary Page') : __('Instructor Feedback')); ?></h1>
		<div id="sidemenu2">
			<ul>
				<?php if($challenge[0]['Group']){
					foreach($challenge[0]['Group'] as $k=>$g){ ?>
						<li id="groupNav<?php echo $g['id']; ?>">
							<a href="#" class="sidemenu2-title"><?php echo __('Group') ?> <?php echo ($k + 1); ?></a>
							<ul>
								<?php foreach($g['User'] as $u){
									if($u['id'] == $_SESSION['User']['id']) continue; ?>
									<li class="userNav" id="userNav<?php echo $u['id']; ?>">
										<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
											<?php echo $u['firstname'].' '.$u['lastname']; ?>
										</a>
										<?php if($u['id'] == $user_id){ ?>
											<script type="text/javascript">
											$(document).ready(function(){	
												$("#groupNav<?php echo $g['id']; ?> a.sidemenu2-title").trigger("click");
											});
											</script>
											<?php } ?>
									</li>
									<?php } ?>
							</ul>
						</li>
					<?php }
				}else{
					foreach($challenge[0]['ClassSet'] as $c){ ?>
						<li id="groupNav<?php echo $c['id']; ?>">
							<a href="#" class="sidemenu2-title"><?php echo $c['group_name']; ?></a>
							<ul>
								<?php foreach($c['User'] as $u){
									if($u['id'] == $_SESSION['User']['id']) continue; ?>
									<li class="userNav" id="userNav<?php echo $u['id']; ?>">
										<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
											<?php echo $u['firstname'].' '.$u['lastname']; ?>
										</a>
										<?php if($u['id'] == $user_id){ ?>
											<script type="text/javascript">
											$(document).ready(function(){	
												$("#groupNav<?php echo $c['id']; ?> a.sidemenu2-title").trigger("click");
											});
											</script>
										<?php } ?>
									</li>
									<?php } ?>
							</ul>
						</li>
					<?php }
				} ?>
			</ul>
		</div>
	<?php } ?>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle"><?php echo $challenge[0]['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<?php if($_SESSION['User']['user_type'] != 'P' && $completed){ ?>
				<li class="action-graph"><a href="/metrics/view_students/<?php echo $challenge[0]['Challenge']['id']; ?>"><?php echo __('Metrics') ?></a></li>
			<?php } ?>
			<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;"><?php echo __('Assignment') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded" style="min-height:30px;">
		<?php 
		$user_colors = array();
		$all_colors = array('#ACD3E7','#FF9999','#96E8BF','#FFFF99','#85A6E6','#FFD175','#CCFFCC','#C2C2A3','#E9E9E9','#9B9BCC');
		
		$js_comments = array();
		$responseCount = $start_offset = $commentCount = 0;
		foreach($challenge[0]['Question'] as $k=>$q){
			if($_SESSION['User']['user_type'] == 'P' && $q['id'] != $question_id && !$completed) continue;
			if(@$q['Response'][0]){
				$responseCount++; ?>
			<div class="question-item"<?php if(!$completed){ ?> style="overflow:hidden;"<?php } ?>>
				<div class="box-head">
					<span class="icon2 icon2-listcountgreen"><?php echo ($k+1); ?></span><a name="<?php echo $q['id']; ?>" href="#"> </a>
					<h2><?php echo $q['section']; ?></h2>
					<?php if($completed && $_SESSION['User']['user_type'] != 'P'){ ?>
						<div class="summary-quality">
							<span class="<?php echo ($q['response_total'] == 1 ? 'great' : ($q['response_total'] == 2 ? 'good' : ($q['response_total'] == 3 ? 'average' : ($q['response_total'] == 4 ? 'poor' : 'poor')))); ?>">
								<?php echo ($q['response_total'] == 1 ? __('Very High') : ($q['response_total'] == 2 ? __('Good') : ($q['response_total'] == 3 ? __('Average') : ($q['response_total'] == 4 ? __('Below Average') : __('Poor'))))); ?> <?php echo __('Quality') ?>
							</span>
							<?php if(!$k && !@$_REQUEST['notips']){ ?><a class="tooltip-mark tooltip-mark-question" title="<?php echo __('Average quality for this Question') ?>"></a><?php } ?>
						</div>
					<?php }elseif(!$completed){ ?>
						<div class="like-scale">
							<ul id="response_scale_<?php echo $q['Response'][0]['id']; ?>">
								<li class="scale1<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 1) echo ' selected'; ?>"><span><?php echo __('Very High') ?> <?php echo __('Quality') ?></span></li>
								<li class="scale2<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 2) echo ' selected'; ?>"><span><?php echo __('Good') ?> <?php echo __('Quality') ?></span></li>
								<li class="scale3<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 3) echo ' selected'; ?>"><span><?php echo __('Average') ?> <?php echo __('Quality') ?></span></li>
								<li class="scale4<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 4) echo ' selected'; ?>"><span><?php echo __('Below Average') ?> <?php echo __('Quality') ?></span></li>
								<li class="scale5<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 5) echo ' selected'; ?>"><span><?php echo __('Poor') ?> <?php echo __('Quality') ?></span></li>
							</ul>
						</div>
					<?php } ?>
					<div class="clear"></div>
				</div>
				<div class="box-content">
					<ul class="fieldset2">
						<li>
							<p class="label-text ">
								<span class="black6">
									<?php echo stripslashes($q['question']); ?>
								</span>
							</p>
							<div class="textvalue">
								<p id="responseBody<?php echo $k; ?>">
									<?php 
									$q['Response'][0]['response_body'] = stripslashes($q['Response'][0]['response_body']);
									$mod_response = $q['Response'][0]['response_body'];
									foreach(@$q['Response'][0]['Comment'] as $i=>$c){
										if(!@$user_colors[$c['user_id']]) $user_colors[$c['user_id']] = array_pop($all_colors);
										if(!$all_colors) $all_colors = array('#ACD3E7','#FF9999','#96E8BF','#FFFF99','#85A6E6','#FFD175','#CCFFCC','#C2C2A3','#E9E9E9','#9B9BCC');
										
										if($_SESSION['User']['user_type'] == 'P' && $_SESSION['User']['id'] != $q['Response'][0]['user_id'] && $_SESSION['User']['id'] != $c['user_id']) continue;
										
										$mod_response = substr($q['Response'][0]['response_body'],0,$c['segment_start']) . '<span class="markerContainer"><span style="background-color:'.$user_colors[$c['user_id']].' !important;" onmouseover="$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').removeClass(\'inactiveMarker\');$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').addClass(\'activeMarker\');$(this).parent().parent().find(\'.inactiveMarker\').hide();" onmouseout="$(this).parent().parent().find(\'.inactiveMarker\').show();$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').addClass(\'inactiveMarker\');$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').removeClass(\'activeMarker\');" onclick="setTimeout(function(){ show_comment('.$k.',\''.$c['user_id'].'_'.$k.'\',\''.$c['id'].'\',\''.$user_colors[$c['user_id']].'\',$(this).parent()); },15);" name="Click" title="Click" class="inactiveMarker commentMarker'.$k.'_'.$c['user_id'].'">&nbsp;</span></span>' . substr(@$mod_response?$mod_response:$q['Response'][0]['response_body'],$c['segment_start']);
										
										if(!$completed){
											$js_comments[$commentCount][] = array(	'elementId' 	=> 'textAnnotate_' . (($c['segment_start'] > 0 ? substr_count($q['Response'][0]['response_body'],' ',0,$c['segment_start']) : 0) + $start_offset + $k),
																									'formValues'	=> array(	array(	'name'	=> 'comment',
																									 																'value'	=> $c['comment'] ),
																																					array(	'name'	=> 'type',
																																									'value'	=> $c['type'] ),
																																					array(	'name'	=> 'id',
																																									'value'	=> $c['id'] )));
																																								
											for($j = 1;$j <= substr_count($q['Response'][0]['response_body'],' ',$c['segment_start'],$c['segment_length'] > 0 ? $c['segment_length'] - 1 : strlen($q['Response'][0]['response_body']) - $c['segment_start']);$j++){
												$js_comments[$commentCount][] = array(	'elementId' 	=> 'textAnnotate_' . (($c['segment_start'] > 0 ? substr_count($q['Response'][0]['response_body'],' ',0,$c['segment_start']) : 0) + $start_offset + $j + $k),
																										'formValues'	=> array(	array(	'name'	=> 'comment',
																										 																'value'	=> $c['comment'] ),
																																						array(	'name'	=> 'type',
																																										'value'	=> $c['type'] ),
																																						array(	'name'	=> 'id',
																																										'value'	=> $c['id'] )));
											}
											$commentCount++;
										}
									}
									echo ($completed ? nl2br($mod_response) : nl2br($q['Response'][0]['response_body']));
									$start_offset += substr_count($q['Response'][0]['response_body'],' ');
									?>
								</p>
								<?php 
								if($completed){
									$mod_response = array();
									foreach(@$q['Response'][0]['Comment'] as $c){
										if($_SESSION['User']['user_type'] == 'P' && $_SESSION['User']['id'] != $q['Response'][0]['user_id'] && $_SESSION['User']['id'] != $c['user_id']) continue; 
										if(!@$mod_response[$c['user_id']]) $mod_response[$c['user_id']] = $q['Response'][0]['response_body'];
										
										$mod_response[$c['user_id']] = $c['segment_start'] + $c['segment_length'] > strlen($mod_response[$c['user_id']]) || $c['segment_length'] < 0 ? ($mod_response[$c['user_id']] . '</span>') : (substr($mod_response[$c['user_id']],0,$c['segment_start']+$c['segment_length']) . '</span>' . substr($mod_response[$c['user_id']],$c['segment_start']+$c['segment_length']));
										$mod_response[$c['user_id']] = substr($q['Response'][0]['response_body'],0,$c['segment_start']) . '<span class="commentHighlight" id="commentHighlight_'.$c['id'].'">' . substr($mod_response[$c['user_id']],$c['segment_start']);
										$mod_response[$c['user_id']] = substr($q['Response'][0]['response_body'],0,$c['segment_start']) . '<span style="background-color:'.$user_colors[$c['user_id']].' !important;">&nbsp;</span>' . substr($mod_response[$c['user_id']],$c['segment_start']); ?>
									<?php }foreach($mod_response as $kmr=>$mr){ ?>
										<p id="responseBody<?php echo $k; ?>_<?php echo $kmr.'_'.$k; ?>" style="display:none;">
											<?php echo nl2br($mr); ?>
										</p>
									<?php }
								}
								
								if(!$completed){ ?>
									<div style="display:none;" class="notice-for-edit">
										<?php echo __('Highlight a section of the text to add a comment.') ?>
									</div>
									<div style="background-image:none;" class="notice-for-edit spacer"> </div>
								<?php } ?>
							</div>
						</li>
					</ul>
					<?php
					$q['Response'][0]['Comment'] = @array_reverse($q['Response'][0]['Comment'],true);
					foreach(@$q['Response'][0]['Comment'] as $c){ ?>
					<div class="question-comments <?php echo ($c['type'] ? 'like' : 'dislike'); ?> comment_detail_<?php echo $c['user_id'] . '_' . $k; ?>" id="commentDetail_<?php echo $c['id']; ?>" style="display:none;margin-bottom:5px;position:relative;" onmouseover="if(!$(this).hasClass('activeDetail')){ $(this).find('.studentwork-more').show(); }" onmouseout="$(this).find('.studentwork-more').hide();">
						<p>
							<span class="highlight-blue" style="background-color:<?php echo $user_colors[$c['user_id']]; ?> !important;"><?php echo "{$c['User']['firstname']} {$c['User']['lastname']}"; ?></span>
							<?php echo stripslashes($c['comment']); ?>
						</p>
						
						<a href="#<?php echo $q['id']; ?>" class="studentwork-more" style="display:none;position:absolute;top:12px;right:12px;" onclick="setTimeout(function(){ show_comment('<?php echo $k; ?>','<?php echo $c['user_id'].'_'.$k; ?>','<?php echo $c['id']; ?>','<?php echo $user_colors[$c['user_id']]; ?>'); },15);">
							<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;">View</span>
						</a>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php }
		} ?>
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 275px; margin: 0 auto; ">
		<div style="width: 120px; float: left;" id="nextStudentBtn">
			<a href="#" onclick="next<?php echo ($_SESSION['User']['user_type'] == 'P' ? 'Question' : 'Student'); ?>();return false;" class="btn2">
				<span><?php echo ($_SESSION['User']['user_type'] == 'P' ? 'Continue' : 'Next Student'); ?></span>
			</a>
		</div>
		<div style="width:120px;float:right;" id="topOfPage">
			<a href="#" class="btn3"><span><?php echo __('Top of Page') ?></span></a>
		</div>
		<div class="clear"></div>
	</div>
	
	<a class="show-overlay" href="#modalSaveChoices" id="finalDialog" style="display:none;"> </a>

</div>

<div class="clear"></div>

<div style="display:none;">
	<div id="modalSaveChoices" style="height:220px;overflow:hidden;">
		<div class="box-heading modal-box-head1">
			<span class="icon icon-star"></span>
			<h2 class="page-subtitle label-text"><?php echo __('Congratulations!') ?></h2>
		</div>

		<br />
		<p class="blue textAlignCenter" style="font-size:15px;width:390px;margin-left:45px;margin-right:45px;"><?php echo __('You have completed all sections. You have until the next Due Date to edit any information you wish. Would you like to go to Home?') ?></p>
		<br /><br /><br />
		<div class="exitSaveOptions" style="width:475px;margin-left:13px;">
			<a style="float:left;cursor:pointer;width:180px;" href="/" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Yes, Save and Go Home') ?></span></a>
			<a style="float:right;cursor:pointer;width:240px;" onclick="jQuery.fancybox.close();firstStudent();return false;" class="btn3 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Save, but Continue to Edit Answers') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	
	$("#sidemenu a").mouseenter(function () {
		$(this).html($(this).next(".show_text").text());
	});
	$("#sidemenu a").mouseout(function() {
		$(this).html($(this).prev(".show_text_trimed").text());
	});

	<?php if(!$user_id){ ?>
		$("#sidemenu2 li:first-child a.sidemenu2-title").trigger("click");
	<?php }if($user_id==='0'){ ?>
		window.location = $("#sidemenu2 li:first-child li:first-child a").attr('href');
	<?php } ?>
	
	if($(window).height() >= $(document).height()) $('#topOfPage').hide().parent().width(120);
	if(!$('.question-item').length) $('#puentes-answer-questions').html('<?php echo __('This user has not submitted responses') ?>');
	
	<?php if(!$completed){ ?>
		annotaterInit(".textvalue p");
		$('.question-item').each(function(){
			$(this).height($(this).height());
		});
		$('#puentes-answer-questions').height($('#puentes-answer-questions').height());
	<?php }else{ ?>
		if(!$('.userNav .active').parent().next().find('a').length && !$('.userNav .active').parents('ul').first().parent().next().find('.userNav').first().length) $('#nextStudentBtn').hide();
	<?php } ?>
	
	$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge[0]['Challenge']['id']; ?>/1',function(){
		$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
	});
	
	$('.like-scale li').click(function(){
		$(this).siblings().removeClass('selected');
		if(!$(this).parent().find('li selected').length){
			editMessage = $(this).parents('.question-item').find('.notice-for-edit');
			editMessage.fadeIn();
			
			editSpacer = $(this).parents('.question-item').find('.notice-for-edit.spacer');
			editSpacer.hide();
			
			setTimeout(function(){
				editMessage.fadeOut('slow',function(){
					editSpacer.show();
				});
			},2200);
		}else $(this).parent().find('li').removeClass('selected');
		$(this).addClass('selected');
		
		r_parent = $(this).parent();
		response_data = { response_id: r_parent.attr('id').replace('response_scale_',''),response_body: parseInt($(this).attr('class').replace('scale','')) };
		if(r_parent.data('rID')) response_data.id = r_parent.data('rID');
		
		$.ajax({url:'/responses/update/',data:response_data,success:function(r){
			r_parent.data('rID',r);
		}});
	});
});

var currentAnnotation = null;
var responses = new Array();
<?php if($responseCount){
	foreach($challenge[0]['Question'] as $k=>$q){
		if($_SESSION['User']['user_type'] == 'P' && $q['id'] != $question_id) continue; ?>
		responses.push({text:'<?php echo str_replace("\n",'~~',$q['Response'][0]['response_body']); ?>'.replace('~~',"\n"),id:<?php echo $q['Response'][0]['id']; ?>});
	<?php }
} ?>

function saveAnnotation(){
	start = currentAnnotation.annotation[0].elementId.replace('textAnnotate_','');
	end = parseInt(currentAnnotation.annotation[currentAnnotation.annotation.length - 1].elementId.replace('textAnnotate_',''));
	r_id = 0;
	
	lastPos = responseIdx = 0;
	for(i = 0;i < end + 10;i++){
		if(responses[responseIdx].text.substr(lastPos).indexOf(' ') == -1){
			responseIdx++;
			lastPos = responses[responseIdx].text.substr(0).indexOf(' ') + 1;
		}else lastPos = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
		
		if(i + 1 + responseIdx == start && !r_id){
			start = lastPos;
			r_id = responses[responseIdx].id;
		}else if(i + 1 + responseIdx == end){
			end = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
			if(end == -1) end = responses[responseIdx].text.length;
			break;
		}
	}
	
	if(end - start < 0) end = responses[responseIdx].text.length;
	if(!r_id) r_id = responses[0].id;
	
	$('.comment-submit img').show();
	$('.comment-submit a').hide();
	$.ajax({url:'/comments/save/',data:{comment:{response_id:r_id,segment_start:start,segment_length:(end - start),comment:currentAnnotation.formValues[0].value,type:currentAnnotation.formValues[1].value,id:currentAnnotation.formValues[2].value}},success:function(r){
		if(r){
			$('.comment-id').val(r);
			$('.answer-comment-box textarea').click();
		}
		
		setTimeout(function(){
			$('.comment-submit img').hide();
			$('.comment-submit a').show();
			
			$('.jQueryTextAnnotaterDialog').hide();
			$('.answer-comment-box .close').removeClass('removeAnnotationBtn').click();
			currentAnnotation = null;
		},5);
	}});
}

function annotaterInit(cssSelector) {

	var options = {};
	options.form = '<div class="answer-comment-box"><textarea name="comment" class="comment-textarea"></textarea><div class="vote"><ul><li class="voteup"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().next().addClass(\'inactive\');$(\'.comment-type\').val(1);return false;"></a></li><li class="votedown"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().prev().addClass(\'inactive\');$(\'.comment-type\').val(0);return false;"></a></li></ul></div><div class="comment-submit"><img src="/images/loadingWheel.gif" style="display:none;" /><a href="#" onclick="if($(\'.jQueryTextAnnotaterDialogForm input.comment-type\').val() == \'N\'){ alert(\'You must select Like or Dislike to save a comment.\'); }else{ saveAnnotation(); }return false;" class="btn1"><span>Comment</span></a></div><a href="#" class="removeAnnotationBtn deleteComment" style="float: right;color: #000;text-decoration: underline;padding-top: 2px;">Remove this comment</a><div class="clear"></div><div class="callout-corner"></div><a href="#" class="close" onclick="$(\'.jQueryTextAnnotaterDialog\').hide();return false;"></a><input type="hidden" name="type" class="comment-type" value="N" /><input type="hidden" name="id" class="comment-id" value="" /></div>';
	options.annotateCharacters = false; 
	options.formDeleteAnnotationButton = '.removeAnnotationBtn';

	jQuery(cssSelector).textAnnotate(options);

	//annotation saved
	jQuery(cssSelector).textAnnotate('bind', 'saveForm', function(data){
		currentAnnotation = data;
	});
	
	jQuery(cssSelector).textAnnotate('bind', 'removeAnnotation', function(removedAnnotation){
		$.ajax({url:'/comments/delete/' + removedAnnotation[0].formValues[2].value});
	});
	
	jQuery(cssSelector).textAnnotate('bind', 'addAnnotation', function(addedAnnotation){
		setTimeout(function(){
			$('.jQueryTextAnnotaterDialogForm input.comment-type').val('N');
			$('.jQueryTextAnnotaterDialogForm input.comment-id').val('');
			$('.vote .votedown').removeClass('inactive');
			$('.vote .voteup').removeClass('inactive');
		},75);
	});
	
	jQuery(cssSelector).textAnnotate('bind', 'beforeShowDialog', function(data){
		setTimeout(function(){
			if($('.jQueryTextAnnotaterDialogForm textarea').val() != ''){
				$('.answer-comment-box').height(110);
				$('.answer-comment-box').css('top','-145px');
				$('.deleteComment').show();
				$('.comment-submit .btn1 span').html('Save');
				$('.answer-comment-box .close').removeClass('removeAnnotationBtn');
			}else{
				$('.answer-comment-box').height(90);
				$('.answer-comment-box').css('top','-125px');
				$('.deleteComment').hide();
				$('.comment-submit .btn1 span').html('Comment');
				$('.answer-comment-box .close').addClass('removeAnnotationBtn');
			}
			
			if($('.jQueryTextAnnotaterDialogForm textarea').val() == ''){
				$('.vote .votedown').removeClass('inactive');
				$('.vote .voteup').removeClass('inactive');
			}else if($('.jQueryTextAnnotaterDialogForm input.comment-type').val() == '0'){
				$('.vote .votedown').removeClass('inactive');
				$('.vote .voteup').addClass('inactive');
			}else{
				$('.vote .votedown').addClass('inactive');
				$('.vote .voteup').removeClass('inactive');
			}
		},25);
	});
	
	<?php if($js_comments){ ?>
		jQuery(cssSelector).textAnnotate('addAnnotations', <?php echo json_encode($js_comments); ?>);
	<?php } ?>
}

function nextStudent(){
	if($('.userNav .active').parent().next().find('a').length){
		window.location = $('.userNav .active').parent().next().find('a').attr('href');
	}else if($('.userNav .active').parents('ul').first().parent().next().find('.userNav').first().length){
		window.location = $('.userNav .active').parents('ul').first().parent().next().find('.userNav').first().find('a').attr('href');
	}else{
		$('#finalDialog').click();
	}
}

function nextQuestion(){
	if($('.userNav.active').next().find('a').length){
		$('.question-item').fadeOut('normal',function(){
			window.location = $('.userNav.active').next().find('a').attr('href');
		});
	}else{
		$('#finalDialog').click();
	}
}

function firstStudent(){
	window.location = $('.userNav').first().find('a').attr('href');
}
</script>