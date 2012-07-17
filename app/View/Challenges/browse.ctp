<div class="clear" style="padding-top:40px;"></div>

<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
	<div id="startbridge" class="rounded box-white">
		<a href="/challenges/update/" class="btn1"><span>Begin</span></a>
		<a href="/challenges/update/"><h2>Start a Bridge</h2></a> 
		<div class="clear"></div>
	</div>
<?php } ?>

<div id="bridgelist" class="rounded box-white" style="overflow:hidden;margin-left:25px;">
	<div class="box-head">
		<h2>My Portfolio</h2>
		<div class="filterbox">
			<select class="cat" onchange="window.location = '/challenges/browse/'+$(this).val();" id="statusFilter">
				<option value="" onclick="window.location = '/challenges/browse/';">All</option>
				<option value="c"<?php if($status=='c') echo ' selected="selected";'; ?>>Completed</option>
				<option value="d"<?php if($status=='d') echo ' selected="selected";'; ?>>Draft</option>
				<option value="n"<?php if($status=='n') echo ' selected="selected";'; ?>>New</option>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="box-content">
		<table id="bridgetable" style="width:954px;">
			<thead>
				<tr>
					<th class="col1"><a href="/dashboard/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>">Case Name</a></th>
					<th class="col2"><a href="/dashboard/?sort=answer_date&dir=<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>">Due Date 1 <span class="question"></span></a></th>
					<th class="col3"><a href="/dashboard/?sort=response_date&dir=<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>">Due Date 2 <span class="question"></span></a></th>
					<th class="col4"><a href="/dashboard/?sort=edit_date&dir=<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>">Last Edit</a></th>
					<th class="col5"><a href="/dashboard/?sort=creator&dir=<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort sort<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>">Creator</a></th>
					<th class="col6"><a href="#">Status</a></th>
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
						<a href="/challenges/<?php echo ($challenge['Challenge']['status'] == 'D' ? 'update' : 'view') . '/' . $challenge['Challenge']['id'] . ($challenge['Challenge']['status'] == 'D' ? '#view=info' : ''); ?>"<?php if(@$challenge['Users']){ ?> onclick="show_user_list($(this).parent(),<?php echo $challenge['Challenge']['id']; ?>,<?php echo (date_create($challenge['Challenge']['responses_due']) < $now ? '1' : '0'); ?>);return false;"<?php }elseif(date_create($challenge['Challenge']['answers_due']) < $now){ ?> onclick="alert('None of this challenge\'s other participants have met the response deadline.');return false;"<?php } ?>>
							<?php echo $challenge['Challenge']['name']; ?>
						</a>
					</td>
					<td><?php echo date_format(date_create($challenge['Challenge']['answers_due']),'m/d/Y'); ?></td>
					<td><?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?></td>
					<td><?php echo date_format(date_create($challenge['Challenge']['date_modified']),'m/d/Y'); ?></td>
					<td><?php echo @$challenge['User']['firstname'].' '.@$challenge['User']['lastname']; ?></td>
					<td>
						<?php if(date_create($challenge['Challenge']['answers_due']) >= $now){ ?>
							<?php if($challenge['Challenge']['status'] == 'D'){ ?>Building
							<?php }elseif(@$challenge['Status'][0]['status']=='D'){ ?>In Use
							<?php }elseif(!@$challenge['Status'] || @$challenge['Status'][0]['status']=='N'){ ?>New<?php } ?>
						<?php } ?>
					</td>
					<td>
						<?php if($_SESSION['User']['id'] == $challenge['Challenge']['user_id']){ ?>
							<div class="remove-class" style="height:10px;">
								<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" class="remove-class-icon"></a>
								<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" class="remove-class-link icon-close rounded2">Delete</a>
							</div>
						<?php } ?>
					</td>
				</tr>
				<?php if(@$challenge['Users']){ ?>
				<tr style="display:none;"><td colspan="7" width="500" class="opened">
					<ul class="opened-users">
						<li>You</li>
						<?php
						$user_count = 0;
						$l = 0;
						foreach($challenge['Users'] as $u){ 
							if($u['id']==$_SESSION['User']['id']) continue;
							$user_count++; ?>
							<li class="<?php if(!@$u['completed_responses']){ ?>dot-red<?php }if(!(@$l%2)){ ?> alternate<?php } ?>">
								<a href="/responses/view/<?php echo $u['next_question']; ?>/<?php echo $u['id']; ?>"<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?> onclick="alert('This challenge has expired.');return false;"<?php } ?>>
									<?php echo ($challenge['Challenge']['anonymous'] == 'A' ? 'Anonymous User #'.$user_count : "{$u['firstname']} {$u['lastname']}"); ?>
								</a><!-- <span class="draft">DRAFT</span> -->
							</li>
						<?php @$l++; } ?>
					</ul>
				</td></tr>
				<?php }} ?>
			</tbody>
		</table>
		<?php if(!$challenges){ ?>You do not yet have access to any challenges.<?php } ?>
	</div>
	
	<div class="box-foot">
		<div class="pagination">
			<?php if($total/10 > 1){ ?>
				<?php if($page > 1){ ?>
					<div class="alignleft pagination-prev">
						<a href="#" onclick="window.location = '/challenges/browse/' + ($('#statusFilter').val() || '0') + '/<?php echo ($page-1); ?>'">Previous</a>
					</div>
				<?php }if($page < ceil($total/10)){ ?>
					<div class="alignright pagination-next">
						<a href="#" onclick="window.location = '/challenges/browse/' + ($('#statusFilter').val() || '0') + '/<?php echo ($page+1); ?>'">Next</a>
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
	
	<div class="clear"></div>
</div>

<div id="home-leaderboard" class="alignright round round-white width50" style="display:none;width:0px;height:430px;"> </div>
<div class="clear"></div>