<div id="sidebarleft">
	<h1><?php echo __('Answer Questions') ?></h1>
	<div id="sidemenu" >
		<ul>
			<?php foreach($challenge['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if(!$k){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>"><a class="no-icon" onclick="save_response();" href="#<?php echo $q['id']; ?>"><?php echo stripslashes($q['section']); ?></a></li>
			<?php }if($challenge['Challenge']['allow_attachments']){ ?>
			<li id="questionNavAttach"><a class="no-icon" onclick="save_response();" href="#attachments"><?php echo __('Attach File(s)') ?></a></li>
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
	<div id="modalExitChoices" style="width:480px;height:230px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Exit') ?></h2>
		</div>
		<?php
		$exit_text = __('You have until {due_date_time}, {due_date_day}, {due_date} to make further edits to you assignment. Would you like to save current edits before returning to Home?');
		$exit_text = str_replace('{due_date_time}','<strong>'.date_format(date_create($challenge['Challenge']['answers_due']),'g:ia').'</strong>',$exit_text);
		$exit_text = str_replace('{due_date_day}',date_format(date_create($challenge['Challenge']['answers_due']),'l'),$exit_text);
		$exit_text = str_replace('{due_date}',date_format(date_create($challenge['Challenge']['answers_due']),'F j'),$exit_text);
		?>
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><p class="caseclubFont18 blue textAlignCenter"><?php echo $exit_text; ?></p></div>
			<br />
			<div style="width: 345px; margin: 0 auto; ">
				<a onclick="if(!$('.niceTextarea:first').val()){ window.location='/dashboard/'; }else{ save_response('/dashboard/'); }" style="float:left;width:130px;" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Yes, Save Current') ?></span></a>
				<a href="/dashboard/" class="btn3 btn-savecontinue aligncenter" style="float:left;width:130px;"><span class="inner"><?php echo __('No, Don\'t Save') ?></span></a>
				<a onclick="jQuery.fancybox.close(); return false; " style="display:inline-block;padding-left:10px;padding-top:7px;"><?php echo __('Cancel') ?></a>
			</div>
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