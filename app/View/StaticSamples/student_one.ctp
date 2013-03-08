<div id="sidebarleft">
	<h1><?php echo __('Answer Questions') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li><a class="no-icon" href="/static_samples/student_attachment/"><?php echo __('Assignment') ?></a></li>
			<li class="active"><a class="no-icon" href="/static_samples/student_one/">Question 1</a></li>
			<li><a class="no-icon" href="/static_samples/student_two/">Question 2</a></li>
			<li><a class="no-icon" href="/static_samples/student_three/">Question 3</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle">Assignment Example: Presidents of the United States of America</div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-video"><a href="/pages/tutorial/?vid=answer_questions" class="iframe" id="tutorialVideo" style="padding:0 0 0 25px;" data-fancybox-type="iframe"><?php echo __('Video') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded">
		<div id="questionContent">
			
			<div class="box-head">
				<span class="icon2 icon2-listcountgreen">1</span>
				<h2>Question 1</h2>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<form id="responseData">
					<ul class="fieldset2">
						<li>
							<p class="label-text ">
								<span class="black6">
									What are the main issues addressed in the document?
								</span>
							</p>
							<textarea class="niceTextarea" name="response_body" rows="10" style="font-family:Helvetica, Arial, sans-serif;font-size: 12px;">Note: This is not an actual assignment from the instructor. This is what an assignment would look like.
							</textarea>
						</li>
					</ul>
				</form>
			</div>
			
		</div>
		
		<div style="text-align:right"><?php echo __('Counter') ?>: <span id="currentWordCount">0</span></div>
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 80px; margin: 0 auto;">
		<a href="/static_samples/student_two/" class="btn2"><span><?php echo __('Next') ?></span></a>
	</div>

</div>

<div class="clear"></div>

<script type="text/javascript">
function limitText(limitField){
	limitNum = 1000000;
	
	if(!limitField.val()) $('#currentWordCount').html('0');
	else $('#currentWordCount').html(limitField.val().match(/ /g).length + 1);
}
	
$textAreaOrigHeight = 264;
$("textarea.niceTextarea").keyup(function(){ 
	expandtext(this); 

	limitText($(this));
});

limitText($('textarea.niceTextarea'));
</script>

<script type="text/javascript">
$('#tutorialVideo').fancybox({
	'hideOnOverlayClick' : true,
	'showCloseButton' : true,
	'centerOnScroll' : true,
	'width' : 660,
	'height' : 505
});
</script>