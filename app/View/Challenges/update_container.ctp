<div id="sidebarleft">
	<h1>Start a Bridge</h1>
	<div id="sidemenu">
		<ul>
			<li id="menu_challenge" class="active"><a class="icon icon-docinspect" onclick="$.bbq.pushState({view:'challenge'});">Challenges</a></li>
			<li id="menu_assignment"><a class="icon icon-docopen" onclick="$.bbq.pushState({view:'assignment'});">Assignment</a></li>
			<li id="menu_collaboration"><a class="icon icon-cycle" onclick="$.bbq.pushState({view:'collaborate'});">Collaborate</a></li>
			<li id="menu_info"><a class="icon icon-pen" onclick="$.bbq.pushState({view:'info'});">Information</a></li>
			<li id="menu_people"><a class="icon icon-envelope" onclick="$.bbq.pushState({view:'people'});">Send to Class</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">

	<div class="actionmenu">
		<ul>
			<li class="action-save"><a href="#">Save</a></li>
			<li class="action-exit"><a href="#">Exit</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<form id="challenge_data" method="POST" action="/challenges/update/<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>/">
		<input type="hidden" name="id" id="id" value="<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>" />
		<input type="hidden" name="challenge[Challenge][challenge_type]" id="challenge_type" value="<?php echo (@$challenge ? $challenge['Challenge']['challenge_type'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][response_types]" id="response_types" value="<?php echo (@$challenge ? $challenge['Challenge']['response_types'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][collaboration_type]" id="collaboration_type" value="<?php echo (@$challenge ? $challenge['Challenge']['collaboration_type'] : ''); ?>" />
		<input type="hidden" name="challenge[Challenge][status]" value="<?php echo (@$challenge ? @$challenge['Challenge']['status'] : 'D'); ?>" />
		<input type="hidden" name="challenge[Challenge][user_id]" value="<?php echo (@$challenge ? @$challenge['Challenge']['user_id'] : @$_SESSION['User']['id']); ?>" />
		
		<span id="edit_content"> </span>
	</form>
	
</div>

<div class="clear"></div>

<script type="text/javascript">
$(function(){
	setup_challenge_hashchange();
	if(!$.bbq.getState('view')) $.bbq.pushState({view:'<?php echo (@$ini_view ? $ini_view : 'challenge'); ?>'});
	else $(window).trigger('hashchange');
});
</script>