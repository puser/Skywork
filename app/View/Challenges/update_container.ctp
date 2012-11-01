<div id="sidebarleft">
	<h1><?php echo __('Start a Bridge') ?></h1>
	<div id="sidemenu">
		<ul>
			<li id="menu_challenge" class="active"><a class="icon icon-docinspect" onclick="$.bbq.pushState({view:'challenge'});"><?php echo __('Step 1') ?></a></li>
			<li id="menu_assignment"><a class="icon icon-docopen" onclick="$.bbq.pushState({view:'assignment'});"><?php echo __('Step 2') ?></a></li>
			<li id="menu_collaboration"><a class="icon icon-cycle" onclick="$.bbq.pushState({view:'collaboration'});"><?php echo __('Step 3') ?></a></li>
			<li id="menu_info"><a class="icon icon-pen" onclick="$.bbq.pushState({view:'info'});"><?php echo __('Information') ?></a></li>
			<li id="menu_people"><a class="icon icon-envelope" onclick="$.bbq.pushState({view:'people'});"><?php echo __('Send to Class') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">

	<div class="actionmenu">
		<ul>
			<li class="action-save"><a onclick="save_challenge('quiet');"><?php echo __('Save') ?></a></li>
			<li class="action-exit"><a href="#modalExitChoices" class="show-overlay"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<form id="challenge_data" method="POST" action="/challenges/update/<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>/" enctype="multipart/form-data">
		<input type="hidden" name="challenge[Challenge][id]" id="id" value="<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>" />
		<input type="hidden" name="challenge[Challenge][challenge_type]" id="challenge_type" value="<?php echo (@$challenge ? $challenge['Challenge']['challenge_type'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][response_types]" id="response_types" value="<?php echo (@$challenge ? $challenge['Challenge']['response_types'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][collaboration_type]" id="collaboration_type" value="<?php echo (@$challenge ? $challenge['Challenge']['collaboration_type'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][status]" value="<?php echo (@$challenge ? @$challenge['Challenge']['status'] : 'D'); ?>" id="challengeStatus" />
		<input type="hidden" name="challenge[Challenge][user_id]" value="<?php echo (@$challenge ? @$challenge['Challenge']['user_id'] : @$_SESSION['User']['id']); ?>" />
		
		<span id="edit_content"> </span>
	</form>
	
</div>

<div class="clear"></div>

<div style="display: none;">
	<div id="modalExitChoices" style="width:440px;height:190px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Exit') ?></h2>
		</div>

		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><p class="caseclubFont18 blue textAlignCenter"><?php echo __('Would you like to save before returning to Home?') ?></p></div>
			<br />
			<div style="width: 335px; margin: 0 auto; ">
				<a onclick="$('#challenge_data').attr('action','/challenges/update/0/dashboard/').submit();return false;" style="float:left;width:130px;" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Yes, Save Current') ?></span></a>
				<a href="/dashboard/" class="btn3 btn-savecontinue aligncenter" style="float:left;width:130px;"><span class="inner"><?php echo __('No, Don\'t Save') ?></span></a>
				<a onclick="jQuery.fancybox.close(); return false; " style="display:inline-block;padding-left:10px;padding-top:7px;"><?php echo __('Cancel') ?></a>
			</div>
		</div>
	</div><!-- #modalExitChoices -->
</div>

<script type="text/javascript">
$(function(){
	setup_challenge_hashchange();
	if(!$.bbq.getState('view')) $.bbq.pushState({view:'<?php echo (@$ini_view ? $ini_view : 'challenge'); ?>'});
	else $(window).trigger('hashchange');
});
</script>