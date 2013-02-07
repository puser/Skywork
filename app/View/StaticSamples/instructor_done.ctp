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


<div id="sidebarleft">

	<h1>Evaluation</h1>
	<div id="sidemenu2">
		<ul>
			<li id="groupNav">
				<a href="#" class="sidemenu2-title"><?php echo __('Students') ?></a>
				<ul>
					<li class="userNav"><a class="active" href="/static_samples/instructor_evaluation/">James Buchanan</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Martin Buren</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Millard Fillmore</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">William Harrison</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">James Monroe</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Franklin Pierce</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">James Polk</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Zach Taylor</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">John Tyler</a></li>
				</ul>
			</li>
		</ul>
		<ul>
			<li>
				<a style="font-size:13px;padding-left:30px;width:136px;background-image:url(/images/icons/greencheck_menu_16.png);background-position:4px 8px;background-repeat:no-repeat;" href="/static_samples/instructor_done/"><?php echo __('I\'m Done!') ?></a>
			</li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div class="alignleft page-toptitle">Example Assignment: Presidents of the United States of America</div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded" style="min-height:30px;line-height:25px;">
		<div class="box-head">
			<span class="icon2 icon2-greencheck" style="height:33px;"></span>
			<h2><?php echo __('Evaluation of Completed Assignment') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="box-content" style="font-size:12pt;margin-left: 120px;">
			
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
					<a href="#" class="btn2"><span><?php echo __('Send to Students') ?></span></a>
				</div>
			</div>
			<a style="float:right;font-size:14px;" href="/static_samples/instructor_evaluation/"><?php echo __('Continue Evaluating Students') ?></a>
			
		</div>
		<br /><br />
		<div class="clear"></div>
	</div>
</div>

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	if($(window).height() >= $(document).height()) {
		$('#topOfPage').hide();
		$('#parentGototop').width(120)
	}
	
	annotaterInit(".textvalue p");
	$('.question-item').each(function(){
		$(this).height($(this).height());
	});
	$('#puentes-answer-questions').height($('#puentes-answer-questions').height());
	
	$('#groupNav a').click();
});
</script>