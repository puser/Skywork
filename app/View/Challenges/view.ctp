<div id="leftcol" class="alignleft">
	<h1 class="page-title">Answer Questions</h1>
	<div id="caseclubmenu" class="no-icon">

		<ul>
			<?php foreach($challenge['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if(!$k){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>"><a href="#<?php echo $q['id']; ?>"><?php echo stripslashes($q['section']); ?></a></li>
			<?php }if($challenge['Challenge']['allow_attachments']){ ?>
			<li id="questionNavAttach"><a href="#attachments">Attach File(s)</a></li>
			<?php } ?>
		</ul>
	</div>

</div>		
<div id="maincol" class="alignright">

	<div class="caseclub-links-wrap">
		<div class="alignleft caseclub-location"><?php echo stripslashes($challenge['Challenge']['name']); ?></div>
		<div class="alignright caseclub-links">
			<?php if(@$challenge['Attachment'][0]['type']=='C'){ ?><a href="/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>" class="caseclub-preview">See Case</a><?php } ?>
			<a href="#" onclick="save_response();return false;" class="caseclub-save">Save</a>
			<a href="#modalExitChoices" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="answerQuestionsFormThemes" class="form-fields-wrap round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body" id="questionWrapperBody" style="overflow:hidden; min-height: 400px;">
			<div class="body-r">
				<div class="content" id="questionContent">

				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #answerQuestionsFormThemes-->
	
	<p class="textAlignCenter red" id="fieldValidate" style="display:none;">* You must complete this section</p>
	<br /><br />
	<a href="#" onclick="save_response('ajax');return false;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Save and Continue</span></a>
	
</div><!-- #maincol-->
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
			<h2 class="page-subtitle label-text">Exit</h2>
		</div>
		<br />
		<p class="caseclubFont18 blue textAlignCenter">Would you like to save before returning to Home?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" onclick="if(!$('.niceTextarea:first').val()){ window.location='/dashboard/'; }else{ save_response('/dashboard/'); }" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>
			<a href="/dashboard/" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>
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