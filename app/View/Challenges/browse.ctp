<div class="clear" style="padding-top:20px;"></div>

<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
	<div id="startbridge" class="rounded box-white">
		<a href="/challenges/update/" <?php if(@$limit_reached){ ?>onclick="$('#maxbridge_warning_link').click();return false;"<?php } ?> class="btn1"><span><?php echo __('Begin') ?></span></a>
		<a href="/challenges/update/" <?php if(@$limit_reached){ ?>onclick="$('#maxbridge_warning_link').click();return false;"<?php } ?> style="text-decoration:none !important;"><h2><?php echo __('Start an Assignment'); if($monthly_count !== false){ ?> <sup style="color:#ED1C24;font-size:12px;vertical-align:top;top:-6px;position:relative;" alt="Assignments left for this month" title="Assignments left for this month"><?php echo $monthly_count; ?></sup><?php } ?></h2></a> 
		<div class="clear"></div>
	</div>
<?php } ?>

<div id="bridgelist" class="rounded box-white" style="overflow:hidden;margin-left:25px;position:relative;height:450px;">
	<div class="box-head" style="width:944px;">
		<h2><?php echo __('My Portfolio') ?></h2>
		<div class="filterbox">
			<select class="cat" onchange="window.location = '/challenges/browse/'+$(this).val();" id="statusFilter">
				<option value="" onclick="window.location = '/challenges/browse/';"><?php echo __('All') ?></option>
				<option value="a"<?php if($status=='a') echo ' selected="selected";'; ?>><?php echo __('In Use') ?></option>
				<?php if($_SESSION['User']['user_type'] == 'P'){ ?>
					<option value="f"<?php if($status=='f') echo ' selected="selected";'; ?>><?php echo __('Feedback') ?></option>
				<?php }else{ ?>
					<option value="d"<?php if($status=='d') echo ' selected="selected";'; ?>><?php echo __('Create') ?></option>
					<option value="e"<?php if($status=='e') echo ' selected="selected";'; ?>><?php echo __('Evaluate') ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="box-content" style='height:340px'>
		<table id="bridgetable" style="width:938.5px; margin-left:7px;">
			<thead>
				<tr>
					<th class="col1" align='left'><a href="/dashboard/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort <?php if(@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'){echo 'sortup';}
					elseif(@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='d'){echo 'sortdown';}
					else{echo '';} ?>" style="position:relative;"><?php echo __('Assignments') ?></a></th>
					<th class="col6" align='left'><a href="#"><?php echo __('Status') ?></a></th>
					<th class="col2" align='center'><a href="/dashboard/?sort=answer_date&dir=<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort <?php 
					if(@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'){echo 'sortup';}
					elseif(@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='d'){echo 'sortdown';}
					else{echo '';} ?>" style="padding-right:36px;position:relative;"><?php echo __('Due Date') ?></th>
					<!--
					<th class="col3" align='left'><a href="/dashboard/?sort=response_date&dir=<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort <?php 
					if(@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'){echo 'sortup';}
					elseif(@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='d'){echo 'sortdown';}
					else{echo '';} ?>" style="padding-right:15px;position:relative;"><?php echo __('Due Date 2') ?> <span class="tooltip" title="<?php echo __('Time for feedback and collaboration') ?>"></span></a></span></th>
					-->
					<th class="col5" align='left'><a href="/dashboard/?sort=creator&dir=<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort <?php 
					if(@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'){echo 'sortup';}
					elseif(@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='d'){echo 'sortdown';}
					else{echo '';} ?>"><?php echo __('Creator') ?></a></th>
					<th class="col4" align='left'><a href="/dashboard/?sort=edit_date&dir=<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort <?php 
					if(@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'){echo 'sortup';}
					elseif(@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='d'){echo 'sortdown';}
					else{echo '';} ?>"><?php echo __('Last Edit') ?></a></th>
					<th style="width:20px;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$now = date_create();
				foreach($challenges as $k=>$challenge){
					$a_date = date_create($challenge['Challenge']['answers_due']);
					$r_date = $challenge['Challenge']['responses_due'] && $challenge['Challenge']['responses_due'] != '0000-00-00 00:00:00' ? date_create($challenge['Challenge']['responses_due']) : NULL;
					
					if($_SESSION['User']['user_type'] == 'L' && $challenge['Challenge']['status'] == 'D' && @$challenge['Status'][0]['id']){
						$challenge_click = "$('#challenge_accept_link').attr('href','/challenges/instructor_confirm/".$challenge['Challenge']['id']."');$('#challenge_accept_link').click();return false;";
					}elseif(($_SESSION['User']['user_type'] == 'L' || @$challenge['collaborator']) && $a_date > $now && $challenge['Challenge']['status'] != 'D'){
						// $challenge_click = "$('#date1_exp_warning').html('" . date_format($a_date,'m/d/Y') . "');$('#date2_exp_warning').html('" . @date_format($r_date,'m/d/Y') . "');";
						// if(!$r_date) $challenge_click .= "$('#collab_exp_warning').hide();";
						// else $challenge_click .= "$('#collab_exp_warning').show();";
						// $challenge_click .= "$('#duedate_warning_link').click();return false;";
						$challenge_click = "show_edit_existing($(this).parent(),{$challenge['Challenge']['id']});return false;";
					}elseif($_SESSION['User']['user_type'] == 'P' && (($a_date < $now && $challenge['Challenge']['collaboration_type'] == 'NONE') || ($challenge['Challenge']['collaboration_type'] != 'NONE' && date_create($challenge['Challenge']['responses_due']) < $now)) && !$challenge['Challenge']['eval_complete']){
						$challenge_click = "$('#skipcollab_warning_link').click();return false;";
					}elseif(@$challenge['Users']){
						if((!$challenge['Challenge']['eval_complete']) || ($_SESSION['User']['user_type'] == 'P' && $r_date < $now) || ($challenge['Challenge']['collaboration_type'] == 'NONE' && !$challenge['Challenge']['eval_complete'])){
							if($_SESSION['User']['user_type'] == 'P') $challenge_click = "if($(this).parents('tr').first().next().find('li').length > 1){ window.location = $($(this).parents('tr').first().next().find('li')[1]).find('a').attr('href'); }else{ show_feedback($(this).parent(),{$challenge['Challenge']['id']});return false; }";
							//else $challenge_click = "window.location = '/responses/view/{$challenge['Challenge']['id']}';";
							else $challenge_click = "show_feedback($(this).parent(),{$challenge['Challenge']['id']});return false;";
						}else{
							$challenge_click = "show_user_list($(this).parent(),{$challenge['Challenge']['id']}," . ($_SESSION['User']['user_type'] == 'L' ? '1' : '0') . "," . ($r_date < $now ? '1' : '0') . ");";
						}
						$challenge_click .= "return false;";
					}elseif($a_date < $now){
						$challenge_click = "alert('None of this challenge\'s other participants have met the response deadline.');return false;";
					}else $challenge_click = '';
					?>
				<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.remove-class').show();" onmouseout="$(this).find('.remove-class').hide();">
					<td>
						<a href="<?php echo ($challenge['Challenge']['status'] == 'D' ? '/challenges/update' : '/attachments/embedded_view') . '/' . $challenge['Challenge']['id'] . ($challenge['Challenge']['status'] == 'D' ? '#view=info' : ''); ?>" onclick="<?php echo $challenge_click; ?>">
							<?php echo $challenge['Challenge']['name']; ?>
						</a>
					</td>
					<td>
						<span class="true_status">
							<?php if($_SESSION['User']['user_type']=='L' && $challenge['Challenge']['status'] == 'D' && @$challenge['Status'][0]['id']){
								echo ($challenge['Status'][0]['status'] == 'P' || $challenge['User']['id'] == $_SESSION['User']['id'] ? __('Accept?') : ($challenge['Status'][0]['status'] == 'C' ? __('Accepted') : __('Rejected')));
							}else{
								if($challenge['Challenge']['status'] == 'D') echo __('Create');
								elseif(($challenge['Challenge']['collaboration_type'] != 'NONE' && date_create($challenge['Challenge']['responses_due']) < $now) && $_SESSION['User']['user_type'] == 'P' && !$challenge['Challenge']['eval_complete']) echo __('Feedback');
								elseif(($a_date > $now || ($challenge['Challenge']['collaboration_type'] != 'NONE' && date_create($challenge['Challenge']['responses_due']) > $now)) && !$challenge['Challenge']['eval_complete']) echo __('In Use');
								elseif(!$challenge['Challenge']['eval_complete']) echo ($_SESSION['User']['user_type']=='L' ? __('Evaluate') : __('Complete'));
								elseif(!@$challenge['Status'] || @$challenge['Status'][0]['status']=='N') echo __('New');
							} ?>
						</span>
						<span class="feedback_status" style="display:none;">Feedback</span>
					</td>
					<td>
						<div style="position:relative;">
							<span class="disp_date1">
							<?php echo (($a_date < $now && $challenge['Challenge']['collaboration_type'] != 'NONE' && date_create($challenge['Challenge']['responses_due']) > $now) ? date_format($r_date,'m/d/Y g:ia') : date_format($a_date,'m/d/Y g:ia')); ?>
							</span>
							<?php if($a_date > $now && $challenge['Challenge']['collaboration_type'] != 'NONE'){ ?>
								<a href="#" style="display:none;position:absolute;left:-11px;" onclick="$(this).parent().parent().parent().find('.feedback_status').hide();$(this).parent().parent().parent().find('.true_status').show();$(this).parent().find('a').show();$(this).hide();$(this).parent().find('.disp_date1').show();$(this).parent().find('.disp_date2').hide();return false;"><img src="/images/arrow-left.png" /></a>
								<span class="disp_date2" style="display:none;"><?php echo date_format($r_date,'m/d/Y g:ia'); ?></span>
								<a href="#" onclick="$(this).parent().parent().parent().find('.feedback_status').show();$(this).parent().parent().parent().find('.true_status').hide();$(this).parent().find('a').show();$(this).hide();$(this).parent().find('.disp_date2').show();$(this).parent().find('.disp_date1').hide();return false;"><img style="padding-left:3px;" src="/images/arrow-right.png" /></a>
							<?php } ?>
						</div>
					</td>
					<!-- <td><?php echo ($r_date ? date_format($r_date,'m/d/Y g:ia') : ''); ?></td> -->
					<td><?php $name = @$challenge['User']['firstname'].' '.@$challenge['User']['lastname'];							
							if(strlen($name) > 12){
							 echo substr($name,0,12).'...';
							}
							else{
								echo $name;
							} ?></td>
					<td><?php echo date_format(date_create($challenge['Challenge']['date_modified']),'m/d/Y'); ?></td>
					<td>
						<?php if($_SESSION['User']['id'] == $challenge['Challenge']['user_id']){ ?>
							<div style="width:32px;height:10px;">
								<div class="remove-class" style="height:10px;display:none;">
									<a href="#modalDeleteChoices" class="show-overlay remove-class-icon" onclick="$('#deleteBridgeLink').attr('href','/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/');"></a>
									<a href="#modalDeleteChoices" class="show-overlay remove-class-link icon-close rounded2" onclick="$('#deleteBridgeLink').attr('href','/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/');"><?php echo __('Delete') ?></a>
								</div>
							</div>
						<?php } ?>
					</td>
				</tr>
				<?php if(@$challenge['Users']){ ?>
				<tr style="display:none;"><td colspan="7" width="500" class="opened">
					<ul class="opened-users">
						<li><?php echo __('You') ?></li>
						<?php
						$user_count = 0;
						$l = 0;
						foreach($challenge['Users'] as $u){ 
							if($u['id']==$_SESSION['User']['id']) continue;
							$user_count++; ?>
							<li class="<?php if(!@$u['completed_responses']){ ?>dot-red<?php }if(!(@$l%2)){ ?> alternate<?php } ?>">
								<a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $u['id']; ?>">
									<?php echo ($challenge['Challenge']['anonymous'] == 'A' ? __('Anonymous User').' #'.$user_count : "{$u['firstname']} {$u['lastname']}"); ?>
								</a><!-- <span class="draft">DRAFT</span> /responses/view/<?php echo $u['next_question']; ?>/<?php echo $u['id']; ?> -->
							</li>
						<?php @$l++; } ?>
					</ul>
				</td></tr>
				<?php }} ?>
				
				<?php
				$k = @$k ? $k + 1 : 0;
				if($page >= ceil($total/10) && $_SESSION['User']['user_type'] == 'P'){  ?>
					<tr<?php if(!(($k)%2)){ ?> class="alternate"<?php } ?>>
						<td><a href="/static_samples/student_attachment/">Example of an Assignment</a></td>
						<td>In Use</td>
						<td><?php echo date_format(date_create(),'m/d/Y g:ia'); ?></td>
						<td>Your Instructor</td>
						<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
						<td></td>
					</tr>
				<?php }elseif($page >= ceil($total/10)){ ?>
					<tr<?php if(!(($k)%2)){ ?> class="alternate"<?php } ?>>
						<td><a href="/static_samples/student_attachment/">This is what an assignment looks like</a></td>
						<td>In Use</td>
						<td><?php echo date_format(date_create(),'m/d/Y g:ia'); ?></td>
						<td>The Instructor</td>
						<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
						<td></td>
					</tr>
					<tr<?php if(!(($k+1)%2)){ ?> class="alternate"<?php } ?>>
						<td><a href="/static_samples/instructor_evaluation/">This is what grading looks like</a></td>
						<td>Evaluate</td>
						<td><?php echo date_format(date_create(),'m/d/Y g:ia'); ?></td>
						<td>The Instructor</td>
						<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
						<td></td>
					</tr>
					<tr<?php if(!(($k+2)%2)){ ?> class="alternate"<?php } ?>>
						<td><a href="/static_samples/instructor_completed/">This is what a completed assignment looks like</a></td>
						<td>Complete</td>
						<td><?php echo date_format(date_create(),'m/d/Y g:ia'); ?></td>
						<td>The Instructor</td>
						<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
						<td></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php if(!$challenges){ ?><?php echo ($status ? __('No bridges match your search.') : ''); ?><?php } ?>
	</div>
	
	<div class="box-foot">
		<div class="pagination">
			<?php if($total/10 > 1){ ?>
				<?php if($page > 1){ ?>
					<div class="alignleft pagination-prev">
						<a href="#" onclick="window.location = '/challenges/browse/' + ($('#statusFilter').val() || '0') + '/<?php echo ($page-1); ?>'"><?php echo __('Previous') ?></a>
					</div>
				<?php }if($page < ceil($total/10)){ ?>
					<div class="alignright pagination-next">
						<a href="#" onclick="window.location = '/challenges/browse/' + ($('#statusFilter').val() || '0') + '/<?php echo ($page+1); ?>'"><?php echo __('Next') ?></a>
					</div>
				<?php } ?>

				<div class="aligncenter pagination-pages">
					<ul>
						<?php for($i=0;$i<($total/10);$i++){ ?>
						<li<?php if(($i + 1) == $page){ ?> class="active"<?php } ?>>
							<a href="#" onclick="window.location = '/challenges/browse/' + ($('#statusFilter').val() || '0') + '/<?php echo ($i+1); ?>'"><?php echo ($i+1); ?></a>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
			
			<div class="clear"></div>
		</div>
	</div>
	
	<div style="position:absolute;right:0px;top:0px;width:10px;background:#fff;height:95%;margin:12px 0;border-right:1px solid #eee;display:none;" id="thinListBorder"> </div>
	
	<div class="clear"></div>
</div>

<div id="home-leaderboard" class="alignright round round-white width50" style="display:none;width:0px;height:430px;"> </div>
<div class="clear"></div>

<div style="display:none;">
	<a href="#modal-maxbridge" class="show-overlay" id="maxbridge_warning_link"> </a>
	<a href="#modal-duedate-warning" class="show-overlay" id="duedate_warning_link"> </a>
	<a href="#modal-skipcollab-warning" class="show-overlay" id="skipcollab_warning_link"> </a>
	<a href="" class="show-overlay" id="challenge_accept_link"> </a>
	<div id="modal-duedate-warning" class="modal-wrapper" style="width: 600px;" >
		<div class="modal-box-head">
			<h2><?php echo __('Due Date 1') ?></h2>
		</div>
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;line-height:25px;">
				<?php
				$warning_msg = __('Your students are currently completing the assignment.');
				$warning_msg .= ' <div style="display:inline;" id="collab_exp_warning">' . __('Due Date 1 expires {date1}. You will then have until {date2} to complete Due Date 2.') . "</div>";
				$warning_msg = str_replace('{date1}','<span id="date1_exp_warning"> </span>',$warning_msg);
				$warning_msg = str_replace('{date2}','<span id="date2_exp_warning"> </span>',$warning_msg);
				echo $warning_msg;
				?>
			</div>
			
			<br />
			<div class="clear"></div>
			<div style="width: 100px; margin: 0 auto; ">
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Close') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<div id="modal-skipcollab-warning" class="modal-wrapper" style="width: 600px;" >
		<div class="modal-box-head">
			<h2><?php echo __('Due Date 2') ?></h2>
		</div>
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;line-height:25px;">
				<?php echo __('Your Instructor is currently evaluating your assignment. When they are done, you will receive an email. Then you will be able to view your Instructor’s comments and corrections.'); ?>
			</div>
			
			<br />
			<div class="clear"></div>
			<div style="width: 100px; margin: 0 auto; ">
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Close') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<div id="modal-maxbridge" class="modal-wrapper" style="width: 525px;" >
		<div class="modal-box-head">
			<h2><span class="icon5 icon-confirm" style="margin-top:-6px;"></span><?php echo __('Monthly Maximum Reached') ?></h2>
		</div>
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;line-height:25px;">
				<?php echo nl2br(__("You have reached your monthly maximum number of assignments.\n\nPlease click View Upgrades for more information.")); ?>
			</div>
			
			<br />
			<div class="clear"></div>
			<div style="width: 250px; margin: 0 auto; ">
				<a href="/users/view/payments" class="btn2" style="width: 125px; float: left;"><span><?php echo __('View Upgrades') ?></span></a>
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Close') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<div id="modalDeleteChoices" style="width:460px;height:190px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Delete') ?></h2>
		</div>
		
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><?php echo __('Are you sure you want to delete this Bridge?') ?></div>	
			<br />
			<div style="width: 200px; margin: 0 auto; ">
				<a href="#" class="btn2" style="width: 95px; float: left;" id="deleteBridgeLink"><span><?php echo __('Yes, Delete') ?></span></a>
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div><!-- #modalExitChoices -->
</div>

<!-- server time: <?php echo date_format($now,'m/d/Y g:ia'); ?> -->

<script type="text/javascript">
// autorefresh after 1min
setTimeout(function(){
	window.location = '<?php echo $_SERVER['REQUEST_URI']; ?>';
},60000);
</script>
