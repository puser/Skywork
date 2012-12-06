<div id="sidebarleft">
	<h1><?php echo __('Edit Assignment') ?></h1>
	<div id="sidemenu">
		<ul>
			<li class="active"><a class="icon icon-status active"><?php echo __('Status') ?></a></li>
			<li><a class="icon icon-pen" href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_active/"><?php echo __('Information') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">

	<div class="actionmenu">
		<ul>
			<li class="action-exit"><a href="/dashboard/"><?php echo __('Cancel & Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="startbridge-information" class="box-startbridge box-white rounded">
		<div class="box-head">
			<span class="icon2 icon2-status"></span>
			<h2><?php echo __('Status of the Assignment') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="box-content information-fields-1">
			<p style="color:#336D9B;line-height:25px;">
				Your students are currently completing Due Date 1 and have until <strong><?php echo date_format(date_create($challenge['Challenge']['answers_due']),'g:ia, l, m/d/Y'); ?></strong>
				to complete the assignment. However, you may edit certain parts of the Assignment 
				and then resend it.
			</p><br />
			
			<p style="line-height:25px;">
				These are the class(es) involved in this assignment:<br />
				<span style="color:#336D9B;"><?php foreach($challenge['ClassSet'] as $k=>$c) echo ($k ? ', ' : '') . $c['group_name']; ?></span>
			</p><br />
				
			These are your students who have started the assignment:
			<table cellpadding="0" cellspacing="0" id="bridgetable" style="font-size:14px;margin-top:18px;">
				<thead>
					<tr>
						<td align="left" width="300"><a>Student Name</a></td>
						<td align="center" width="150"><a>Questions Answered</a></td>
					</tr>
				</thead>
				<tbody>
					<?php
					$k = 1;
					foreach($challenge['ClassSet'] as $c){
						foreach($c['User'] as $u){
							if($u['user_type'] != 'P') continue;
							$k++; ?>
							<tr <?php if(!($k%2)){ ?> class="alternate"<?php } ?>>
								<td align="left"><?php echo $u['firstname'] . ' ' . $u['lastname']; ?></td>
								<td align="center"><?php echo (@$user_responses[$u['id']] ? $user_responses[$u['id']] : 0); ?> of <?php echo count($challenge['Question']); ?></td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>
				
		</div>
	</div>
	
</div>

<div class="clear"></div>