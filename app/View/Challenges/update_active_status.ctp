<div id="sidebarleft">
	<h1><?php echo __('Edit Assignment') ?></h1>
	<div id="sidemenu">
		<ul>
			<li><a class="icon icon-status active"><?php echo __('Status') ?></a></li>
			<li><a class="icon icon-pen" href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_active/"><?php echo __('Status') ?></a></li>
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
			<p>
				Your students are currently completing Due Date 1 and have until <?php echo date_format(date_create($challenge['Challenge']['answers_due']),'g:ia, l, m/d/Y'); ?>
				to complete the assignment. However, you may edit certain parts of the Assignment 
				and then resend it.
			</p>
			
			<p>
				These are the class(es) involved in this assignment:<br />
				<?php foreach($challenge['ClassSet'] as $k=>$c) echo ($k ? ', ' : '') . $c['group_name']; ?>
			</p>
				
			These are your students who have started the assignment:
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td align="left">Student Name</td>
						<td align="center">Questions Answered</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($challenge['ClassSet'] as $c){
						foreach($c['User'] as $u){ ?>
							<tr>
								<td align="left"><?php echo $u['firstname'] . ' ' . $u['lastname']; ?></td>
								<td align="center">0</td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>
				
		</div>
	</div>
	
</div>

<div class="clear"></div>