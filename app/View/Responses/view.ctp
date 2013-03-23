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
	background-color:#feffbd !important;
}
.annotated[annotatelevel="0"],.annotated[annotatelevel="1"],.annotated[annotatelevel="2"] {
	padding-right:3px;
	margin-right:-3px;
}
#activeFlag {
	background-color:#ff8d8d;
}
.commentHover {
	background-color:#eee !important;
}
</style>

<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<?php if(!@$ajax){ ?>
	<div id="sidebarleft">

		<?php if($_SESSION['User']['user_type'] == 'P' && !$completed){ ?>
			
			<h1><?php echo __('Feedback') ?></h1>
			<div id="sidemenu2">
				<ul>
					<?php if($challenge[0]['Group']){
						foreach($challenge[0]['Group'] as $k=>$g){ ?>
							<li id="groupNav<?php echo $g['id']; ?>">
								<a href="#" class="sidemenu2-title"><?php echo __('Group') ?> <?php echo ($k + 1); ?></a>
								<ul>
									<?php foreach($g['User'] as $u){
										if($u['user_type'] != 'P' || $u['id'] == $_SESSION['User']['id']) continue; ?>
										<li class="userNav" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
											<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1" <?php if(!@$user_responses[$u['id']]){ ?>style="color:#c95248;"<?php } ?>>
												<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
												<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
											</a>
											<?php if($u['id'] == $user_id || @$complete_eval){ ?>
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
										if($u['user_type'] != 'P' || $u['id'] == $_SESSION['User']['id']) continue; ?>
										<li class="userNav" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
											<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1" <?php if(!@$user_responses[$u['id']]){ ?>style="color:#c95248;"<?php } ?>>
												<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
												<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
											</a>
											<?php if($u['id'] == $user_id || @$complete_eval){ ?>
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
	
		<?php }elseif($_SESSION['User']['user_type'] == 'P'){ ?>
		
			<h1 id='studentsummary'><?php echo __('Summary') ?></h1>
			<div id="sidemenu">
				<?php if($challenge[0]['Challenge']['collaboration_type'] != 'NONE'){ ?>
					<ul>
						<?php if($challenge[0]['Group']){
							$this_group = array_pop($challenge[0]['Group']);
					
							// shift current user to front
							foreach($this_group['User'] as $uk=>$u){
								if($u['id'] == $_SESSION['User']['id']){
									unset($this_group['User'][$uk]);
									array_unshift($this_group['User'],$u);
									break;
								}
							}
					
							foreach($this_group['User'] as $u){ ?>
								<li class="userNav<?php if($u['id'] == $user_id && !@$_REQUEST['instructor_comments'] && !@$_REQUEST['collaborator_comments']){ ?> active-name<?php }else{ ?> name<?php } ?>" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
									<a style="padding-left:30px;width:136px;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
										<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
										<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
									</a>
								</li>
							<?php }
						}else{
							foreach($challenge[0]['ClassSet'] as $c){ ?>
								<li id="groupNav<?php echo $c['id']; ?>">
									<a style="padding-left:30px;width:136px;" href="#" class="sidemenu2-title"  onclick="$('#instructor_comment_nav').removeClass('active');"><?php echo $c['group_name']; ?></a>
									<ul>
										<?php
									// shift current user to front
										foreach($c['User'] as $uk=>$u){
											if($u['id'] == $_SESSION['User']['id']){
												unset($c['User'][$uk]);
												array_unshift($c['User'],$u);
												break;
											}
										}
								
										foreach($c['User'] as $u){
											if($u['id'] == $challenge[0]['Challenge']['user_id']) continue; ?>
											<li class="userNav" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
												<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1">
														<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
														<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
												</a>
												<?php if($u['id'] == $user_id && !@$_REQUEST['instructor_comments'] && !@$_REQUEST['collaborator_comments']){ ?>
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
				<?php }else{ ?>
					<!--<ul>
						<li class="userNav active-name" id="userNav<?php echo $_SESSION['User']['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
							<a style="padding-left:30px;width:136px;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $_SESSION['User']['id']; ?>?notips=1">
								<span class="shortname"><?php echo substr($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname'],0,20) . (strlen($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']) > 20 ? '...' : ''); ?></span>
								<span class="fullname" style="display:none;"><?php echo $_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']; ?></span>
							</a>
						</li>
					</ul>-->
				<?php } ?>
				<ul>
					<li id="instructor_comment_nav" <?php if(@$_REQUEST['instructor_comments'] || $challenge[0]['Challenge']['collaboration_type'] == 'NONE'){ ?>class="active"<?php } ?>>
						<a style="font-size:13px;padding-left:30px;width:136px;background-image:url(/images/paper.png);background-position:4px 8px;background-repeat:no-repeat;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $_SESSION['User']['id']; ?>?notips=1&instructor_comments=1">Instructor Comments</a>
					</li>
					<?php if($challenge[0]['Collaborator']){ ?>
						<li id="collab_comment_nav" <?php if(@$_REQUEST['collaborator_comments']){ ?>class="active"<?php } ?>>
							<a style="font-size:13px;padding-left:30px;width:136px;background-image:url(/images/person.png);background-position:4px 8px;background-repeat:no-repeat;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $_SESSION['User']['id']; ?>?notips=1&collaborator_comments=1">Collaborator Comments</a>
						</li>
					<?php } ?>
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
										<li class="userNav" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
											<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1" <?php if(!@$user_responses[$u['id']]){ ?>style="color:#c95248;"<?php } ?>>
												<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
												<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
											</a>
											<?php if($u['id'] == $user_id || @$complete_eval){ ?>
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
										<li class="userNav" id="userNav<?php echo $u['id']; ?>" onmouseout="$(this).find('.shortname').show();$(this).find('.fullname').hide();" onmouseover="$(this).find('.shortname').hide();$(this).find('.fullname').show();">
											<a<?php if($u['id'] == $user_id){ ?> class="active"<?php } ?> href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>?notips=1" <?php if(!@$user_responses[$u['id']]){ ?>style="color:#c95248;"<?php } ?>>
												<span class="shortname"><?php echo substr($u['firstname'].' '.$u['lastname'],0,20) . (strlen($u['firstname'].' '.$u['lastname']) > 20 ? '...' : ''); ?></span>
												<span class="fullname" style="display:none;"><?php echo $u['firstname'].' '.$u['lastname']; ?></span>
											</a>
											<?php if($u['id'] == $user_id || @$complete_eval){ ?>
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
				<?php if(!$completed){ ?>
					<ul>
						<li<?php if(@$complete_eval){ ?> class="active"<?php } ?>>
							<a style="font-size:13px;padding-left:30px;width:136px;background-image:url(/images/icons/greencheck_menu_16.png);background-position:4px 8px;background-repeat:no-repeat;<?php if(@$complete_eval){ ?>display: block; padding: 13px 10px 13px 60px; margin: 0 0 0 0; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, serif; background-position: 15px center; background-repeat: no-repeat; width: 110px; color: #666666; text-decoration: none;border-left: 4px solid #f5866c;background-color: #ffffff; color: #f5866c; background-position: 11px center; padding-left: 56px;<?php } ?>" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/complete_eval/"><?php echo __('I\'m Done!') ?></a>
						</li>
					</ul>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>

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
	
	<?php if(@$complete_eval){ ?>
		<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded" style="min-height:30px;line-height:25px;">
			<div class="box-head">
				<span class="icon2 icon2-greencheck" style="height:33px;"></span>
				<h2><?php echo __('Evaluation of Completed Assignment') ?></h2>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="box-content" style="font-size:12pt;margin-left: 120px;">
				<?php if($challenge[0]['Challenge']['eval_complete']){ ?>
					You have already sent your comments and corrections to your students.<br />
					You may, however, make as many changes and resend to your students.
					<br /><br />
					Click Send to Students:<br />
					1. Puentes will send an automated email notifying your students<br />
					2. Your students will be able to see your comments and corrections
					<br /><br />
					Click Continue Evaluating Student Work:<br />
					Choose this option if you feel that you would like to continue evaluating<br />
					student work and send your comments and corrections at a later point.<br /><br /><br />
					
					<div style="margin:0 auto;width:150px;">
						<div style="width:150px;float:left;margin-left: -62px;">
							<a href="/responses/submit_evaluation/<?php echo $challenge[0]['Challenge']['id']; ?>/" class="btn2"><span><?php echo __('Re-send to Students') ?></span></a>
						</div>
					</div>
					<a style="float:right;font-size:14px;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/"><?php echo __('Continue Evaluating Students') ?></a>
				<?php }elseif($challenge[0]['Challenge']['collaboration_type'] == 'NONE' || date_create($challenge[0]['Challenge']['responses_due']) < date_create()){ ?>
					You have clicked to finish evaluating your student’s work. You may: 
					<br /><br />
					Click Send to Students:<br />
					1. Puentes will send an automated email notifying your students<br />
					2. Your students will be able to see your comments and corrections
					<br /><br />
					Click Continue Evaluating Student Work:<br />
					Choose this option if you feel that you would like to continue evaluating <br />
					student work and send your comments and corrections at a later point.
					<br /><br /><br />
		
					<div style="margin:0 auto;width:150px;">
						<div style="width:150px;float:left;margin-left: -62px;">
							<a href="#modalProgress" onclick="window.location='/responses/submit_evaluation/<?php echo $challenge[0]['Challenge']['id']; ?>/';progressIndicator();" class="show-overlay btn2"><span><?php echo __('Send to Students') ?></span></a>
						</div>
					</div>
					<a style="float:right;font-size:14px;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/"><?php echo __('Continue Evaluating Students') ?></a>
				<?php }else{ ?>
					This is where you would opt to send your comments and corrections back to <br />
					your students. Your students, however, are still completing the collaboration<br />
					(Due Date 2) and will finish <?php echo date_format(date_create($challenge[0]['Challenge']['responses_due']),'m/d/Y'); ?>.
					<br /><br />
					Once they’re done with Due Date 2, you will have access to the metrics section<br />
					and will be able to opt to send to your comments and corrections back to your <br />
					students.
					<br /><br /><br />
				
					<a style="float:right;font-size:14px;" href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/"><?php echo __('Continue Evaluating Students') ?></a>
				<?php } ?>
			</div>
			<br /><br />
			<div class="clear"></div>
		</div>
	<?php }else{ ?>
	
		<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded" style="min-height:30px;">
			<?php 
			$collab_ids = array(); 
			if(@$_REQUEST['collaborator_comments']){
				foreach($challenge[0]['Collaborator'] as $c) $collab_ids[] = $c['id'];
			}
		
			$user_colors = array();
			$all_colors = array('#F75D59','#736AFF','#C68E17','#3EA99F','#F88017');
					
			$js_comments = array();
			$responseCount = $start_offset = $commentCount = 0;
			foreach($challenge[0]['Question'] as $k=>$q){
				// if($_SESSION['User']['user_type'] == 'P' && $q['id'] != $question_id && !$completed) continue;
				if(@$q['Response'][0]){
					if(!$completed) $challenge[0]['Question'][$k]['Response'][0]['response_body'] = str_replace("\n"," ",str_replace("\r"," ",$challenge[0]['Question'][$k]['Response'][0]['response_body']));
					else $challenge[0]['Question'][$k]['Response'][0]['response_body'] = $q['Response'][0]['response_body'] = preg_replace("/\s+/"," ",str_replace("  <p>&nbsp;</p>  ","<br />",str_replace("\n"," ",str_replace("\r"," ",$challenge[0]['Question'][$k]['Response'][0]['response_body']))));
					$responseCount++; ?>
				<div class="question-item"<?php if(!$completed){ ?> style="overflow:hidden;"<?php } ?>>
					<div class="box-head">
						<span class="icon2 icon2-listcountgreen"><?php echo ($k+1); ?></span><a name="<?php echo $q['id']; ?>" href="#"> </a>
						<h2><?php echo ($challenge[0]['Challenge']['response_types'] == 'E' ? 'Essay' : 'Question ' . ($k+1));//$q['section']; ?></h2>
						<?php if($completed && $_SESSION['User']['user_type'] != 'P' && ($challenge[0]['Challenge']['instructor_ratings'] || $challenge[0]['Challenge']['student_ratings']) && $q['response_total']){ ?>
							<div class="summary-quality">
								<span class="<?php echo ($q['response_total'] == 1 ? 'great' : ($q['response_total'] == 2 ? 'good' : ($q['response_total'] == 3 ? 'average' : ($q['response_total'] == 4 ? 'poor' : 'poor')))); ?>">
									<?php echo ($q['response_total'] == 1 ? __('Very High') : ($q['response_total'] == 2 ? __('Good') : ($q['response_total'] == 3 ? __('Average') : ($q['response_total'] == 4 ? __('Below Average') : __('Poor'))))); ?> <?php echo __('Quality') ?>
								</span>
								<?php if(!$k && !@$_REQUEST['notips']){ ?><a class="tooltip-mark tooltip-mark-question" title="<?php echo __('Average quality for this Question') ?>"></a><?php } ?>
							</div>
						<?php }elseif(!$completed && (($challenge[0]['Challenge']['instructor_ratings'] && $_SESSION['User']['user_type'] != 'P') || ($challenge[0]['Challenge']['student_ratings'] && $_SESSION['User']['user_type'] == 'P'))){ ?>
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
								<div class="textvalueWrapper" id="textvalueWrapper_<?php echo $k; ?>" style="overflow:hidden;">
									<div class="textvalue">
										<<?php echo ($completed ? 'div' : 'p'); ?> class="responseBodys" id="responseBody<?php echo $k; ?>">
											<?php
											$q['Response'][0]['response_body'] = stripslashes($q['Response'][0]['response_body']);
											$mod_response = $q['Response'][0]['response_body'];
											foreach(@$q['Response'][0]['Comment'] as $i=>$c){ 
												if(!@$user_colors[$c['user_id']]) $user_colors[$c['user_id']] = array_pop($all_colors);
												if(!$all_colors) $all_colors = array('#ACD3E7','#FF9999','#96E8BF','#FFFF99','#85A6E6','#FFD175','#CCFFCC','#C2C2A3','#E9E9E9','#9B9BCC');
											
												$rbody_decoded = utf8_decode($q['Response'][0]['response_body']);
												$br_offset = @substr_count($rbody_decoded,"\n\n",0,$c['segment_start']);
												$br_offset += @substr_count(str_replace("\n\n","\n",$rbody_decoded),"\n",$c['segment_start'] + $br_offset,5);
												$br_offset += @substr_count(str_replace("\n",' ',str_replace("\n\n","\n",$rbody_decoded)),"  ",0,$c['segment_start'] + $br_offset);
											
												$rbody_tmp = substr($q['Response'][0]['response_body'],0,$c['segment_start']);
												$rbody_tmp_decode = utf8_decode($rbody_tmp);
												$c['segment_start'] += strlen($rbody_tmp) - strlen($rbody_tmp_decode);
											
												if(($_SESSION['User']['user_type'] == 'P' && $_SESSION['User']['id'] != $q['Response'][0]['user_id'] && $_SESSION['User']['id'] != $c['user_id']) || (@$_REQUEST['instructor_comments'] && $c['user_id'] != $challenge[0]['Challenge']['user_id']) || (@$_REQUEST['collaborator_comments'] && !in_array($c['user_id'],$collab_ids))) continue;
											
												// new highlight logic to accommodate RTE
												$tag_offset = 0;
												$in_tag = $in_char = $in_comment = false;
												for($i = 0;$i < strlen($mod_response);$i++){
													if($in_tag && $mod_response[$i] == '>'){
														$in_tag = false;
														$tag_offset++;
														continue;
													}elseif($in_tag){
														$tag_offset++;
														continue;
													}elseif($mod_response[$i] == '<'){
														$in_tag = true;
														$tag_offset++;
														continue;
													}elseif($in_char && $mod_response[$i] == ';'){
														$in_char = false;
														$tag_offset++;
														continue;
													}elseif($in_char){
														$tag_offset++;
														continue;
													}elseif($mod_response[$i] == '&'){
														$in_char = true;
														continue;
													}elseif($mod_response[$i] == ' ' && ($mod_response[$i - 1] == ' ' || substr($mod_response,$i-6,6) == '&nbsp;')){
														$tag_offset++;
													}
												
													if($c['segment_start'] == $i - $tag_offset){
														$in_comment = true;
														$span_str = '<span class="markerContainer"><span style="background-color:'.$user_colors[$c['user_id']].' !important;" onmouseover="$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').removeClass(\'inactiveMarker\');$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').addClass(\'activeMarker\');$(this).parent().parent().find(\'.inactiveMarker\').hide();" onmouseout="$(this).parent().parent().find(\'.inactiveMarker\').show();$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').addClass(\'inactiveMarker\');$(\'.commentMarker'.$k.'_'.$c['user_id'].'\').removeClass(\'activeMarker\');" onclick="setTimeout(function(){ show_comment('.$k.',\''.$c['user_id'].'_'.$k.'\',\''.$c['id'].'\',\''.$user_colors[$c['user_id']].'\',$(this).parent()); },15);" name="Click" title="Click" class="inactiveMarker commentMarker'.$k.'_'.$c['user_id'].'" id="commentMarker_'.$c['id'].'">&nbsp;</span></span>';
														$mod_response = substr($mod_response,0,$i) . $span_str . substr($mod_response,$i);
														break;
													}
												}
									
												if(!$completed){
											
													$alt_response = preg_replace("/\s+/"," ",str_replace("'","\\'",str_replace("\n",' ',str_replace("\n\n","\n",str_replace("\r","\n",str_replace("\xA0",' ',html_entity_decode(strip_tags($q['Response'][0]['response_body']))))))));
													//$alt_response = utf8_decode($alt_response);
												
													$js_comments[$commentCount][] = array(	'elementId' 	=> 'textAnnotate_' . (($c['segment_start'] > 0 ? substr_count($alt_response,' ',0,$c['segment_start']) : 0) + $start_offset + $k),
																											'formValues'	=> array(	array(	'name'	=> 'comment',
																											 																'value'	=> $c['comment'] ),
																																							array(	'name'	=> 'type',
																																											'value'	=> $c['type'] ),
																																							array(	'name'	=> 'id',
																																											'value'	=> $c['id'] )));
																																							
													for($j = 1;$j <= substr_count($alt_response,' ',$c['segment_start'],$c['segment_length'] > 0 ? $c['segment_length'] - 1 : strlen($alt_response) - $c['segment_start']);$j++){
														$js_comments[$commentCount][] = array(	'elementId' 	=> 'textAnnotate_' . (($c['segment_start'] > 0 ? substr_count($alt_response,' ',0,$c['segment_start']) : 0) + $start_offset + $j + $k),
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
								
											if(@$_REQUEST['highlight'] && @$_REQUEST['response_id'] == $q['Response'][0]['id']){
												$wordpos = 0;
												for($i = 0;$i < @$_REQUEST['pos'];$i++) $wordpos = stripos(strtoupper($mod_response),strtoupper($_REQUEST['highlight']),$wordpos + 1);
												$mod_response = substr_replace($mod_response,'<span id="activeFlag">' . $_REQUEST['highlight'] . '</span>',$wordpos,strlen($_REQUEST['highlight']));
											}
								
											echo ($completed ? $mod_response : $q['Response'][0]['response_body']);
											$start_offset += substr_count($q['Response'][0]['response_body'],' ');
											?>
										</<?php echo ($completed ? 'div' : 'p'); ?>>
										<?php 
										if($completed){
											$mod_response = array();
											$rbody_decoded = utf8_decode($q['Response'][0]['response_body']);
											foreach(@$q['Response'][0]['Comment'] as $c){
											
												$br_offset = @substr_count($rbody_decoded,"\n\n",0,$c['segment_start']);
												$br_offset += @substr_count(str_replace("\n\n","\n",$rbody_decoded),"\n",$c['segment_start'] + $br_offset,5);
												$br_offset += @substr_count(str_replace("\n",' ',str_replace("\n\n","\n",$rbody_decoded)),"  ",0,$c['segment_start'] + $br_offset);
											
												$rbody_tmp = substr($q['Response'][0]['response_body'],0,$c['segment_start']);
												$rbody_tmp_decode = utf8_decode($rbody_tmp);
												$c['segment_start'] += strlen($rbody_tmp) - strlen($rbody_tmp_decode);
																					
												if(($_SESSION['User']['user_type'] == 'P' && $_SESSION['User']['id'] != $q['Response'][0]['user_id'] && $_SESSION['User']['id'] != $c['user_id']) || (@$_REQUEST['instructor_comments'] && $c['user_id'] != $challenge[0]['Challenge']['user_id']) || (@$_REQUEST['collaborator_comments'] && !in_array($c['user_id'],$collab_ids))) continue; 
												if(!@$mod_response[$c['user_id']]) $mod_response[$c['user_id']] = $q['Response'][0]['response_body'];
											
												// new highlight logic to accommodate RTE
												$tag_offset = 0;
												$in_tag = $in_char = $in_comment = false;
												for($i = 0;$i < strlen($mod_response[$c['user_id']]);$i++){
													if($in_tag && $mod_response[$c['user_id']][$i] == '>'){
														$in_tag = false;
														$tag_offset++;
														continue;
													}elseif($in_tag){
														$tag_offset++;
														continue;
													}elseif($mod_response[$c['user_id']][$i] == '<'){
														$in_tag = true;
														$tag_offset++;
														continue;
													}elseif($in_char && $mod_response[$c['user_id']][$i] == ';'){
														$in_char = false;
														$tag_offset++;
														continue;
													}elseif($in_char){
														$tag_offset++;
														continue;
													}elseif($mod_response[$c['user_id']][$i] == '&'){
														$in_char = true;
														continue;
													}elseif($mod_response[$c['user_id']][$i] == ' ' && ($mod_response[$c['user_id']][$i - 1] == ' ' || substr($mod_response[$c['user_id']],$i-7,6) == '&nbsp;')){
														$tag_offset++;
													}
												
													if($c['segment_start'] == $i - $tag_offset){
														$in_comment = true;
														$span_str = '<span style="background-color:'.$user_colors[$c['user_id']].' !important;">&nbsp;</span>';
														$mod_response[$c['user_id']] = substr($mod_response[$c['user_id']],0,$i) . $span_str . substr($mod_response[$c['user_id']],$i);
														$i += strlen($span_str);
														$tag_offset += strlen($span_str);
													}
												
													if($c['segment_start'] + $c['segment_length'] == $i - $tag_offset || $in_comment){
														$span_str = '<span class="commentHighlight commentHighlight_'.$c['id'].'">';
														$mod_response[$c['user_id']] = substr($mod_response[$c['user_id']],0,$i) . $span_str . $mod_response[$c['user_id']][$i] . '</span>' . substr($mod_response[$c['user_id']],$i + 1);
														if($c['segment_start'] + $c['segment_length'] == $i - $tag_offset) break;
														$i += strlen($span_str) + 7;
														$tag_offset += strlen($span_str) + 7;
													}
												}
										/*
												// old highlight logic
												$mod_response[$c['user_id']] = $c['segment_start'] + $c['segment_length'] > strlen($mod_response[$c['user_id']]) || $c['segment_length'] < 0 ? ($mod_response[$c['user_id']] . '</span>') : (substr($mod_response[$c['user_id']],0,$c['segment_start']+$c['segment_length'] + $br_offset) . '</span>' . substr($mod_response[$c['user_id']],$c['segment_start']+$c['segment_length'] + $br_offset));
												$mod_response[$c['user_id']] = substr($q['Response'][0]['response_body'],0,$c['segment_start'] + $br_offset) . '<span class="commentHighlight" id="commentHighlight_'.$c['id'].'">' . substr($mod_response[$c['user_id']],$c['segment_start'] + $br_offset);
												$mod_response[$c['user_id']] = substr($q['Response'][0]['response_body'],0,$c['segment_start'] + $br_offset) . '<span style="background-color:'.$user_colors[$c['user_id']].' !important;">&nbsp;</span>' . substr($mod_response[$c['user_id']],$c['segment_start'] + $br_offset); 
									*/
												if(@$_REQUEST['highlight'] && @$_REQUEST['response_id'] == $q['Response'][0]['id']){
													$wordpos = 0;
													for($i = 0;$i < @$_REQUEST['pos'];$i++) $wordpos = stripos(strtoupper($mod_response[$c['user_id']]),strtoupper($_REQUEST['highlight']),$wordpos + 1);
													$mod_response[$c['user_id']] = substr_replace($mod_response[$c['user_id']],'<span id="activeFlag">' . $_REQUEST['highlight'] . '</span>',$wordpos,strlen($_REQUEST['highlight']));
												}
									
											}foreach($mod_response as $kmr=>$mr){ ?>
												<div id="responseBody<?php echo $k; ?>_<?php echo $kmr.'_'.$k; ?>" class="responseBodys" style="display:none;">
													<?php echo nl2br($mr); ?>
												</div>
											<?php }
										}
							
										if(!$completed){ ?>
											<div style="display:none;" class="notice-for-edit">
												<?php echo __('Highlight a section of the text to add a comment.') ?>
											</div>
											<div style="background-image:none;" class="notice-for-edit spacer"> </div>
										<?php } ?>
									</div>
								</div>
							</li>
						</ul>
						<?php
						$q['Response'][0]['Comment'] = @array_reverse($q['Response'][0]['Comment'],true);
						foreach(@$q['Response'][0]['Comment'] as $c){ ?>
						<div class="question-comments <?php echo ($c['type'] == 2 ? 'neutral' : ($c['type'] ? 'like' : 'dislike')); ?> comment_detail_<?php echo $c['user_id'] . '_' . $k; ?>" id="commentDetail_<?php echo $c['id']; ?>" style="display:none;margin-bottom:5px;position:relative;" onmouseover="if(!$(this).hasClass('activeDetail')){ $(this).addClass('commentHover'); }" onmouseout="$(this).removeClass('commentHover');" onclick="setTimeout(function(){ show_comment('<?php echo $k; ?>','<?php echo $c['user_id'].'_'.$k; ?>','<?php echo $c['id']; ?>','<?php echo $user_colors[$c['user_id']]; ?>'); },15);">
							<p>
								<span class="highlight-blue" style="background-color:<?php echo $user_colors[$c['user_id']]; ?> !important;"><?php echo "{$c['User']['firstname']} {$c['User']['lastname']}"; ?></span>
								<?php
								if(@$_REQUEST['highlight'] && @$_REQUEST['comment_id'] == $c['id']){
									$wordpos = 0;
									for($i = 0;$i < @$_REQUEST['pos'];$i++) $wordpos = stripos(strtoupper($c['comment']),strtoupper($_REQUEST['highlight']),$wordpos + 1);
									$c['comment'] = substr_replace($c['comment'],'<span id="activeFlag">' . $_REQUEST['highlight'] . '</span>',$wordpos,strlen($_REQUEST['highlight']));
								}
								echo stripslashes($c['comment']); ?>
							</p>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php }
			} ?>
			
			<div class="question-item" style="display:none;" id="grading_wrapper">
				<div class="box-head">
					<h2><?php echo "{$user['User']['firstname']} {$user['User']['lastname']}" ?></h2>
				</div>
				<div class="box-content">
					
				</div>
			</div>
			
			<div class="box-foot">
				<div class="pagination">
					<div class="alignleft pagination-prev">
						<select style="width:75px;" onchange="render_pagination(currentPage,currentQuestion);">
							<option value="30">30 lines</option>
							<option value="60">60 lines</option>
							<option value="90">90 lines</option>
							<option value="">Everything</option>
						</select>

						<a href="#"><?php echo __('Previous') ?></a>
					</div>
					<div class="alignright pagination-next">
						<a href="#"><?php echo __('Next') ?></a>
					</div>

					<div class="aligncenter pagination-pages">
						<ul>
							<?php foreach($challenge[0]['Question'] as $k=>$q){ ?>
								<li id="qnav_<?php echo $k; ?>">
									<a href="#" onclick="render_pagination(0,<?php echo $k; ?>);return false;"><?php echo ($k + 1); ?></a>
									<ul class="qnav_sub" style="display:inline;font-size:75%;"> </ul>
								</li>
							<?php } ?>
						</ul>
					</div>

					<div class="clear"></div>
				</div>
			</div>
			
		</div>
		
			<div style="color:#999;" id="wordLineCounts">
			Total lines: <span id="lineCount" style="color:#000;padding-right:10px;"> </span>
			Total words:
			<?php foreach($challenge[0]['Question'] as $k=>$q){ ?><span id="wordCount_<?php echo $k; ?>" class="wordCounts" style="color:#000;"><?php echo str_word_count($q['Response'][0]['response_body']); ?></span><?php } ?>
		</div>
		
		<script type="text/javascript">
		var currentPage = 0;
		var currentQuestion = 0;
		function render_pagination(page,question){
			currentPage = page;
			currentQuestion = question;

			if(!$('.pagination-prev select').val()){
				// show everything
				$('.textvalueWrapper').show();
				$('.question-item').show();
				$('.textvalueWrapper,.textvalueWrapper .textvalue').css('height','auto');
				$('.box-foot').hide();
			}else{
				currentResponse = $('#textvalueWrapper_' + currentQuestion);
				
				$('.question-item').hide();
				currentResponse.parents('.question-item').show();
				currentResponse.height('auto');
				
				// count lines in response
				currentResponse.find('.textvalue').css('height','auto');
				currentResponse.find('.textvalue').css('line-height','40px');
				lineCount = Math.round((currentResponse.find('.textvalue').height() - 40) / 40);
				currentResponse.find('.textvalue').css('line-height','18px');
				
				if(lineCount < 0) $('#wordLineCounts').hide();
				else{
					$('#lineCount').html(lineCount);
					$('.wordCounts').hide();
					$('#wordCount_' + currentQuestion).show();
				}
				
				// show current response
				pageHeight = lineCount - ($('.pagination select').val() * (currentPage + 1)) >= 0 ? 18 * $('.pagination select').val() : 18 * (lineCount - ($('.pagination select').val() * currentPage));
				currentResponse.height(pageHeight);

				// set height based on display selection
				currentResponse.find('.textvalue').height(($('.pagination select').val() * 18) + 40);
				currentResponse.find('.textvalue').css('margin-top',-(currentPage * 18 * $('.pagination select').val()));

				// set up pagination links
				pageCount = Math.ceil(lineCount / $('.pagination select').val());
				if((currentPage + 1) < pageCount || (currentQuestion + 1) < <?php echo count($challenge[0]['Question']); ?>){
					$('.pagination-next').show();
					$('.pagination-next a').click(function(){
						nextLink = $('.pagination li.current').last().next().find('a').length ? $('.pagination li.current').last().next().find('a').first() : $('.pagination li.current').parents('li').next().find('a').first();
						nextLink.click();
					});
				}
				else $('.pagination-next').hide();

				if(!currentPage && !currentQuestion){
					$('.pagination-prev a').hide();
					$('.pagination-prev select').show();
				}else{
					$('.pagination-prev a').show();
					$('.pagination-prev a').click(function(){
						prevLink = $('.pagination li.current').last().prev().find('a').length ? $('.pagination li.current').last().prev().find('a').last() : $('.pagination li.current').parents('li').prev().find('a').last();
						prevLink.click();
					});
					
					$('.pagination-prev select').hide();
				}

				$('.pagination-pages li').removeClass('current');
				$('.qnav_sub').hide();
				$('.qnav_sub li').remove();
				$('#qnav_' + currentQuestion).addClass('current');

				if(pageCount > 1){
					$('#qnav_' + currentQuestion + ' .qnav_sub').show();

					for(i = 0;i < pageCount;i++){
						$('#qnav_' + currentQuestion + ' .qnav_sub').append('<li' + (currentPage == i ? ' class="current"' : '') + '><a onclick="render_pagination(' + i + ',' + question + ');return false;" href="#">' + (i + 1) + '</a></li>');
					}
				}

				$('.box-foot').show();
			}
			
			$('#puentes-answer-questions,.question-item').css('height','auto');
			$('.question-item').each(function(){
				$(this).height($(this).height());
			});
			$('#puentes-answer-questions').height($('#puentes-answer-questions').height());
		}

		render_pagination(0,0);
		</script>
		
	<?php } ?>
	
	<div class="clear"></div>
	
	<?php if(!@$ajax && !@$complete_eval){ ?>
		<div style="width: 275px; margin: 0 auto; " id='parentGototop'>
			<div style="padding-right:10px;width:160px;display:none;float:left;" id="finishedEvalBtn">
				<a href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/complete_eval/" class="btn1">
					<span><?php echo __('I\'m Done Evaluating') ?></span>
				</a>
			</div>
 			<div style="width: 120px; float: left;" id="nextStudentBtn">
				<a href="#" onclick="nextStudent();return false;" class="btn2">
					<span><?php echo ($_SESSION['User']['user_type'] == 'P' ? 'Continue' : 'Next Student'); ?></span>
				</a>
			</div>
		
			<div class="clear"></div>
		</div>
	<?php } ?>
	
	<a class="show-overlay" href="#modalSaveChoices" id="finalDialog" style="display:none;"> </a>
	<a class="show-overlay" href="#modalPreEval" id="showPreEval" style="display:none;"> </a>
	<div style="width:120px;float:right;" id="topOfPage">
		<a href="#" style="float:right; margin-right: 4px;margin-bottom: -15px;">^ <span style="color: #999;"><?php echo __('Go To Top') ?></span></a>
	</div>

</div>

<div class="clear"></div>

<div style="display:none;">
	<div id="modalProgress" style="width:200px;height:35px;text-align:center;font-size:16px;color:#00467F;line-height:35px;">
		Working <span id="progress1" class="progressDot" style="display:none;">.</span> <span id="progress2" class="progressDot" style="display:none;">.</span> <span id="progress3" class="progressDot" style="display:none;">.</span>
	</div>
	
	<div id="modalSaveChoices" style="height:220px;overflow:hidden;">
		<div class="box-heading grey-line">
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
	
	<div id="modalPreEval" style="overflow:hidden;">
		<div class="box-heading grey-line">
			<span class="icon icon-star"></span>
			<h2 class="page-subtitle label-text"><?php echo __('Due Date 2') ?></h2>
		</div>

		<br />
		<p class="blue textAlignCenter" style="font-size:15px;width:390px;margin-left:45px;margin-right:45px;">
			<?php
			$warning_message = __('Your students are currently completing the collaboration (Due Date 2) which is set to expire {due_date_2}. However, you may begin evaluating the assignments immediately, you just won\'t have access to the metrics section until Due Date 2 is over.  We\'ll send you an email notifying you when that happens.');
			$warning_message = str_replace('{due_date_2}',date_format(date_create($challenge[0]['Challenge']['responses_due']),'m/d/Y'),$warning_message);
			echo $warning_message;
			?>
		</p>
		<br /><br /><br />
		<div class="exitSaveOptions" style="width:475px;margin-left:13px;">
			<a style="float:left;cursor:pointer;width:180px;" onclick="jQuery.fancybox.close();" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Begin Evaluating') ?></span></a>
			<a style="float:right;cursor:pointer;width:240px;" href="/" class="btn3 btn-savecontinue aligncenter"><span class="inner"><?php echo __('I\'ll come back later') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	if($(window).height() >= $(document).height()) {
		$('#topOfPage').hide();
		$('#parentGototop').width(120)
	}
	
	<?php if($_SESSION['User']['user_type'] != 'P' && !$completed){ ?>
		if(!$('.userNav .active').parent().next().find('a').length && !$('.userNav .active').parents('ul').first().parent().next().find('.userNav').first().length){
			$('#finishedEvalBtn').show().parent().width($('#finishedEvalBtn').parent().width() + 170);
		}
	<?php }if(date_create($challenge[0]['Challenge']['responses_due']) > date_create() && $challenge[0]['Challenge']['collaboration_type'] != 'NONE' && !@$_REQUEST['notips'] && !@$complete_eval && $_SESSION['User']['user_type'] == 'L'){ ?>
		$('#showPreEval').click();
	<?php } ?>
	
	<?php if(@$_REQUEST['highlight'] && @$_REQUEST['comment_id']){ ?>
		$('#commentMarker_<?php echo @$_REQUEST['comment_id']; ?>').click();
	<?php } ?>
	
	<?php if(!$user_id){ ?>
		$("#sidemenu2 li:first-child a.sidemenu2-title").trigger("click");
	<?php }if($user_id==='0'){ ?>
		window.location = $("#sidemenu2 li:first-child li:first-child a").attr('href');
	<?php } ?>
		
	$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge[0]['Challenge']['id']; ?>/1',function(){
		$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
	});
	
	<?php if(!@$complete_eval){ ?>
		if(!$('.question-item').length) $('#puentes-answer-questions').html('<?php echo __('This user has not submitted responses') ?>');
	
		<?php if(!$completed){ ?>
			annotaterInit(".textvalue p");
			$('.question-item').each(function(){
				$(this).height($(this).height());
			});
			$('#puentes-answer-questions').height($('#puentes-answer-questions').height());
		<?php }else{ ?>
			if((!$('.userNav .active').parent().next().find('a').length && !$('.userNav .active').parents('ul').first().parent().next().find('.userNav').first().length) || $('#instructor_comment_nav').hasClass('active') || $('#collab_comment_nav').hasClass('active')) $('#nextStudentBtn').hide();
		<?php } ?>
	
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
	<?php } ?>
});

<?php if(!@$complete_eval && !@$completed){ ?>
	var currentAnnotation = null;
	var responses = new Array();
	<?php if($responseCount){
		foreach($challenge[0]['Question'] as $k=>$q){
			// if($_SESSION['User']['user_type'] == 'P' && $q['id'] != $question_id) continue; ?>
			responses.push({text:'<?php echo preg_replace("/\s+/"," ",str_replace("'","\\'",str_replace("\n",' ',str_replace("\n\n","\n",str_replace("\r","\n",str_replace("\xA0",' ',html_entity_decode(strip_tags(str_replace("</"," </",$q['Response'][0]['response_body']))))))))); ?>'.trim(),id:<?php echo $q['Response'][0]['id']; ?>});
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
				//lastPos = responses[responseIdx].text.substr(0).indexOf(' ') + 1;
				lastPos = 0;
			}else lastPos = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
		
			if(i + 1 == start && !r_id){
				if(start == end){
					end = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
					start = lastPos;
					r_id = responses[responseIdx].id;
					break;
				}else{
					start = lastPos;
					r_id = responses[responseIdx].id;
				}
			}else if(i + 1 == end){
				end = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
				if(end == -1) end = responses[responseIdx].text.length;
				break;
			}
		}
		start = parseInt(start);
		
		if(end - start < 0) end = responses[responseIdx].text.length;
		else if(end - start == 0 && responseIdx) end = start + responses[responseIdx].text.substr(lastPos).indexOf(' ');
		
		if(!r_id && responseIdx) r_id = responses[responseIdx].id;
		else if(!r_id) r_id = responses[0].id;
		
		if(end == 0) end = responses[responseIdx].text.indexOf(' ');
	
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
		options.form = '<div class="answer-comment-box"><textarea name="comment" class="comment-textarea"></textarea><div class="vote"><ul><li class="voteneutral"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(2);return false;">General</a></li><li class="voteup"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(1);return false;">Like</a></li><li class="votedown"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(0);return false;">Dislike</a></li></ul></div><div class="comment-submit"><img src="/images/loadingWheel.gif" style="display:none;" /><a href="#" onclick="if($(\'.jQueryTextAnnotaterDialogForm input.comment-type\').val() == \'N\'){ alert(\'You must select Like or Dislike to save a comment.\'); }else{ saveAnnotation(); }return false;" class="btn1"><span>Comment</span></a></div><a href="#" class="removeAnnotationBtn deleteComment" style="float: right;color: #000;text-decoration: underline;padding-top: 2px;">Remove this comment</a><div class="clear"></div><div class="callout-corner"></div><a href="#" class="close removeAnnotationBtn" onclick="$(\'.jQueryTextAnnotaterDialog\').hide();return false;"></a><input type="hidden" name="type" class="comment-type" value="2" /><input type="hidden" name="id" class="comment-id" value="" /></div>';
		options.annotateCharacters = false; 
		options.formDeleteAnnotationButton = '.removeAnnotationBtn';

		jQuery(cssSelector).textAnnotate(options);

		//annotation saved
		jQuery(cssSelector).textAnnotate('bind', 'saveForm', function(data){
			currentAnnotation = data;
		});
	
		jQuery(cssSelector).textAnnotate('bind', 'removeAnnotation', function(removedAnnotation){
			if(removedAnnotation[0].formValues) $.ajax({url:'/comments/delete/' + removedAnnotation[0].formValues[2].value});
		});
	
		jQuery(cssSelector).textAnnotate('bind', 'addAnnotation', function(addedAnnotation){
			setTimeout(function(){
				$('.jQueryTextAnnotaterDialogForm input.comment-type').val('2');
				$('.jQueryTextAnnotaterDialogForm input.comment-id').val('');
				$('.vote .votedown').addClass('inactive');
				$('.vote .voteup').addClass('inactive');
				$('.vote .voteneutral').removeClass('inactive');
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
					$('.vote .votedown').addClass('inactive');
					$('.vote .voteup').addClass('inactive');
					$('.vote .voteneutral').removeClass('inactive');
				}else if($('.jQueryTextAnnotaterDialogForm input.comment-type').val() == '0'){
					$('.vote .votedown').removeClass('inactive');
					$('.vote .voteup').addClass('inactive');
					$('.vote .voteneutral').addClass('inactive');
				}else if($('.jQueryTextAnnotaterDialogForm input.comment-type').val() == '1'){
					$('.vote .votedown').addClass('inactive');
					$('.vote .voteneutral').addClass('inactive');
					$('.vote .voteup').removeClass('inactive');
				}else{
					$('.vote .votedown').addClass('inactive');
					$('.vote .voteneutral').removeClass('inactive');
					$('.vote .voteup').addClass('inactive');
				}
			},25);
		});
		
		jQuery(cssSelector).textAnnotate('bind', 'beforeHideDialog', function(data){
			
			// if there's no id for this comment and no content, delete it; otherwise, save it
			if($('.jQueryTextAnnotaterDialogForm input.comment-id').val() == '' && $('.jQueryTextAnnotaterDialogForm textarea').val() == ''){
	//		$('.answer-comment-box .close').click();
			}else if($('.jQueryTextAnnotaterDialogForm input.comment-id').val() == ''){
		/*	saveAnnotation();
				setTimeout(function(){
					$('.answer-comment-box .close').click();
				},10); */
			}
			
		});
	
		<?php if($js_comments){ ?>
			jQuery(cssSelector).textAnnotate('addAnnotations', <?php echo json_encode($js_comments); ?>);
		<?php } ?>
	}
<?php } ?>

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
		// $('#finalDialog').click();
		window.location = '/dashboard/';
	}
}

function firstStudent(){
	window.location = $('.userNav').first().find('a').attr('href');
}

function progressIndicator(){
	var currentDot = 0;
	setInterval(function(){
		if(currentDot == 3){
			currentDot = 0;
			$('.progressDot').hide();
		}else $('#progress' + ++currentDot).show();
	},500);
}

if($('#studentsummary').html() == 'Summary'){
	$('#nextStudentBtn').hide();
}
</script>