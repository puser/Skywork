<div id="sidebarleft">
	<h1><?php echo __('Answer Questions') ?></h1>
	<div id="sidemenu" >
		<ul>
			<?php foreach($challenge['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if(!$k){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>"><a class="no-icon" href="#<?php echo $q['id']; ?>"><?php echo stripslashes($q['section']); ?></a></li>
			<?php }if($challenge['Challenge']['allow_attachments']){ ?>
			<li id="questionNavAttach"><a href="#attachments"><?php echo __('Attach File(s)') ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle"><?php echo stripslashes($challenge['Challenge']['name']); ?></div>
	
	<div class="actionmenu">
		<ul>
			<?php if(@$challenge['Attachment'][0]['type']=='C'){ ?><li class="action-preview"><a href="/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>"><?php echo __('Assignment') ?></a></li><?php } ?>
			<li class="action-save"><a href="#" onclick="save_response();return false;"><?php echo __('Save') ?></a></li>
			<li class="action-exit"><a href="#modalExitChoices" class="show-overlay"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded">
		<div id="questionContent"> </div>
	</div>
	
	<div class="clear"></div>
	
	<div class="bottom-notification" id="fieldValidate" style="display:none;">
		*<?php echo __('You must complete this section') ?>
	</div>
	
	<div style="width: 80px; margin: 0 auto;">
		<a href="#" class="btn2" onclick="save_response('ajax');return false;"><span><?php echo __('Next') ?></span></a>
	</div>

</div>

<div class="clear"></div>

<div style="display: none;">

	<div id="laststep-html">
		<div class="box-heading">
			<h2 class="label-text">Last Step: </h2>
		</div>
		<ul class="fieldset2">
			<li><span class="label alignleft">Preferred Email</span> <input type="text" value="" class="width15"/></li>
			<li><span class="label alignleft">Password</span> <input type="text" value="" class="width15"/></li>

			<li><span class="label alignleft">Confirm Password</span> <input type="text" value="" class="width15"/></li>
		</ul>
		<br /><br />
		<a href="answerquestions-response.html" class="btn1 btn-savecontinue aligncenter"><span class="inner">Save and Continue</span></a>
	</div>
	
</div>

<div style="display: none;">
	<div id="modalExitChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text"><?php echo __('Exit') ?></h2>
		</div>
		<br />
		<p class="caseclubFont18 blue textAlignCenter"><?php echo __('Would you like to save before returning to Home?') ?></p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" onclick="if(!$('.niceTextarea:first').val()){ window.location='/dashboard/'; }else{ save_response('/dashboard/'); }" class="btn1 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Yes, Save Current') ?></span></a>
			<a href="/dashboard/" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('No, Don\'t Save') ?></span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; "><?php echo __('Cancel') ?></a>
		</div>
	</div><!-- #modalExitChoices -->
</div>

<script type="text/javascript">
$(document).ready(function(){
	setup_response_hashchange(<?php echo $challenge['Question'][0]['id']; ?>,<?php echo $challenge['Challenge']['id']; ?>);
	
	$textAreaOrigHeight = 264;
	$("textarea.niceTextarea").keyup(function(){ 
		expandtext(this); 
	});
});
</script>