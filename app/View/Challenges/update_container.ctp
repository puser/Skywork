<div id="sidebarleft">
	<h1>Start a Bridge</h1>
	<div id="sidemenu">
		<ul>
			<li id="menu_challenge" class="active"><a class="icon icon-docinspect" href="startbridge-challenge.html">Challenges</a></li>
			<li id="menu_assignment"><a class="icon icon-docopen" href="startbridge-assignment.html">Assignment</a></li>
			<li id="menu_collaboration"><a class="icon icon-cycle" href="startbridge-collaborate.html">Collaborate</a></li>
			<li id="menu_information"><a class="icon icon-pen" href="startbridge-information.html">Information</a></li>
			<li id="menu_people"><a class="icon icon-envelope" href="startbridge-sendtoclass.html">Send to Class</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">

	<div class="actionmenu">
		<ul>
			<li class="action-save"><a href="#" >Save</a></li>
			<li class="action-exit"><a href="#" >Exit</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<form id="challenge_data">
		<input type="hidden" name="id" id="id" value="<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>" />
		<input type="hidden" name="challenge_type" id="challenge_type" />
		<input type="hidden" name="responses_type" id="responses_type" />
		
		<span id="edit_content"> </span>
	</form>
	
</div>

<div class="clear"></div>

<script type="text/javascript">
$(function(){
	render_update_challenge('challenge',<?php echo (@$challenge ? $challenge['Challenge']['id'] : '0'); ?>);
});
</script>