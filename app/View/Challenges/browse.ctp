<div class="clear" style="padding-top:40px;"></div>

<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
	<div id="startbridge" class="rounded box-white">
		<a href="/challenges/update/" class="btn1"><span><?php echo __('Begin') ?></span></a>
		<a href="/challenges/update/"><h2><?php echo __('Start a Bridge') ?></h2></a> 
		<div class="clear"></div>
	</div>
<?php } ?>

<div id="bridgelist" class="rounded box-white" style="overflow:hidden;margin-left:25px;position:relative;">
	<div class="box-head" style="width:944px;">
		<h2><?php echo __('My Portfolio') ?></h2>
		<div class="filterbox">
			<select class="cat" onchange="window.location = '/challenges/browse/'+$(this).val();" id="statusFilter">
				<option value="" onclick="window.location = '/challenges/browse/';"><?php echo __('All') ?></option>
				<option value="c"<?php if($status=='c') echo ' selected="selected";'; ?>><?php echo __('Completed') ?></option>
				<option value="d"<?php if($status=='d') echo ' selected="selected";'; ?>><?php echo __('Draft') ?></option>
				<option value="n"<?php if($status=='n') echo ' selected="selected";'; ?>><?php echo __('New') ?></option>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="box-content">
		<table id="bridgetable" style="width:954px;">
			<thead>
				<tr>
					<th class="col1"><a href="/dashboard/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Case Name') ?></a></th>
					<th class="col2"><a href="/dashboard/?sort=answer_date&dir=<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Due Date 1') ?> <span class="tooltip" title="<?php echo __('Students answer questions or write essay') ?>"></span></span></th>
					<th class="col3"><a href="/dashboard/?sort=response_date&dir=<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Due Date 2') ?> <span class="tooltip" title="<?php echo __('Time for feedback and collaboration') ?>"></span></a></span></th>
					<th class="col4"><a href="/dashboard/?sort=edit_date&dir=<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Last Edit') ?></a></th>
					<th class="col5"><a href="/dashboard/?sort=creator&dir=<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Creator') ?></a></th>
					<th class="col6"><a href="#"><?php echo __('Status') ?></a></th>
					<th style="width:20px;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$now = date_create();
				$now->setTime(0,0);
				foreach($challenges as $k=>$challenge){ ?>
				<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?>>
					<td>
						<a href="/challenges/<?php echo ($challenge['Challenge']['status'] == 'D' ? 'update' : 'view') . '/' . $challenge['Challenge']['id'] . ($challenge['Challenge']['status'] == 'D' ? '#view=info' : ''); ?>"<?php if($_SESSION['User']['user_type']=='L' && date_create($challenge['Challenge']['answers_due']) > $now && $challenge['Challenge']['status'] != 'D'){ ?> onclick="$('#date1_exp_warning').html('<?php echo date_format(date_create($challenge['Challenge']['answers_due']),'m/d/Y'); ?>');$('#date2_exp_warning').html('<?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?>');$('#duedate_warning_link').click();return false;"<?php }elseif(@$challenge['Users']){ ?> onclick="<?php if(date_create($challenge['Challenge']['responses_due']) > $now && $_SESSION['User']['user_type']=='L'){ ?>window.location = '/responses/view/<?php echo $challenge['Challenge']['id']; ?>';<?php }else{ ?>show_user_list($(this).parent(),<?php echo $challenge['Challenge']['id']; ?>,<?php echo ($_SESSION['User']['user_type'] == 'L' ? '1' : '0'); ?>,<?php echo (date_create($challenge['Challenge']['responses_due']) < $now ? '1' : '0'); ?>);<?php } ?>return false;"<?php }elseif(date_create($challenge['Challenge']['answers_due']) < $now){ ?> onclick="alert('None of this challenge\'s other participants have met the response deadline.');return false;"<?php } ?>>
							<?php echo $challenge['Challenge']['name']; ?>
						</a>
					</td>
					<td><?php echo date_format(date_create($challenge['Challenge']['answers_due']),'m/d/Y'); ?></td>
					<td><?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?></td>
					<td><?php echo date_format(date_create($challenge['Challenge']['date_modified']),'m/d/Y'); ?></td>
					<td><?php echo @$challenge['User']['firstname'].' '.@$challenge['User']['lastname']; ?></td>
					<td>
						<?php if(date_create($challenge['Challenge']['answers_due']) >= $now){ ?>
							<?php if($challenge['Challenge']['status'] == 'D'){ ?><?php echo __('Building') ?>
							<?php }elseif(@$challenge['Status'][0]['status']=='D'){ ?><?php echo __('In Use') ?>
							<?php }elseif(!@$challenge['Status'] || @$challenge['Status'][0]['status']=='N'){ ?><?php echo __('New') ?><?php } ?>
						<?php } ?>
					</td>
					<td>
						<?php if($_SESSION['User']['id'] == $challenge['Challenge']['user_id']){ ?>
							<div class="remove-class" style="height:10px;">
								<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" class="remove-class-icon"></a>
								<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" class="remove-class-link icon-close rounded2"><?php echo __('Delete') ?></a>
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
			</tbody>
		</table>
		<?php if(!$challenges){ ?><?php echo __('You do not yet have access to any bridges.') ?><?php } ?>
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
	<a href="#modal-duedate-warning" class="show-overlay" id="duedate_warning_link"> </a>
	<div id="modal-duedate-warning" class="modal-wrapper" style="width: 600px;" >
		<div class="modal-box-head">
			<h2><?php echo __('Due Date 1') ?></h2>
		</div>
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;line-height:25px;">
				<?php
				$warning_msg = __('Your students are currently completing the assignment. Due Date 1 expires {date1}. You will then have until {date2} to complete Due Date 2.');
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
</div>