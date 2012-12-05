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
	
	<span id="edit_content"> </span>
	
</div>

<div class="clear"></div>