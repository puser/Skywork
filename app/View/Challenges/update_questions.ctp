<div id="leftcol" class="alignleft">
	<h1 class="page-title">Create Challenge</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="contracttemplate"><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update/">Basics</a></li>
			<li class="pen2 active"><a>Questions</a></li>
			<li class="people2 "><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_people/">People</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">

	<div class="caseclub-links-wrap">
		<div class="alignright caseclub-links">
			<a href="#" onclick="save_challenge();return false;" class="caseclub-save">Save</a>
			<a href="#modalExitChoices" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>

	<div id="createChallengeQueationsForm" class="form-fields-wrap form-fields-disabled round round-white">

		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-pen2"></span>
						<h2 class="page-subtitle">Questions</h2>
					</div>

					<form id="challengeData" method="POST" action="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_people">
						<input type="hidden" name="challenge[Challenge][id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
						<ol class="fieldset2">
							<?php 
							$questions = @$challenge['Question'] ? $challenge['Question'] : @$template['Question'];
							if(@$questions){
								foreach($questions as $k=>$question){ ?>
									<li>
										<input type="hidden" class="hChallengeId" name="question[<?php echo $k; ?>][challenge_id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
										<!-- <input type="hidden" class="hQuestionId" name="question[<?php echo $k; ?>][id]" value="<?php echo $question['id']; ?>" /> -->
										<span class="fieldsetNumberList"><?php echo ($k+1); ?>.</span>
										<p><input type="text" value="<?php echo $question['section']; ?>" class="inputtext" name="question[<?php echo $k; ?>][section]"/></p>
										<input type="text" value="<?php echo $question['question']; ?>" class="fullwidth input" name="question[<?php echo $k; ?>][question]"/>
									</li>
								<?php }
							}else{
								for($i=0;$i<4;$i++){ ?>
									<li>
										<input type="hidden" class="hChallengeId" name="question[<?php echo $i; ?>][challenge_id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
										<span class="fieldsetNumberList"><?php echo ($i+1); ?>.</span>
										<p><input type="text" value="" class="inputtext" name="question[<?php echo $i; ?>][section]"/></p>
										<input type="text" value="" class="fullwidth input" name="question[<?php echo $i; ?>][question]"/>
									</li>
								<?php }
							} ?>
						</ol>
						<br />
						<a href="#" class="add-link" onclick="add_question();return false">Add another question</a>
						<br />
						<ul class="fieldset2">
							<li>

								<p class="label">Attachments</p>
								<span class="label2">
									Allow attachments in challenge?  
									<input type="radio" name="challenge[Challenge][allow_attachments]" value="1"<?php if($challenge['Challenge']['allow_attachments'] || (!@$challenge['Question'] && @$template['Challenge']['allow_attachments'])){ ?> checked="checked"<?php } ?>> Yes
									<input type="radio" name="challenge[Challenge][allow_attachments]" value="0"<?php if((@$challenge['Question'] && !$challenge['Challenge']['allow_attachments']) || (!@$challenge['Question'] && !@$template['Challenge']['allow_attachments'])){ ?> checked="checked"<?php } ?>> No
								</span>
							</li>
						</ul>
					</form>

				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #createChallengeQueationsForm-->
	
	<span id="fieldValidate" style="display:none;">
		<p class="textAlignCenter red">* You must fill in at least one question.</p><br /><br />
	</span>

	<a href="#" onclick="if(!($('.inputtext').first().val() && $('.fullwidth.input').first().val())){ $('#fieldValidate').show(); }else{ $('#challengeData').submit(); }return false;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Save and Continue</span></a>
	
</div><!-- #maincol-->
<div class="clear"></div>


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
			<a href="#" onclick="$('#challengeData').attr('action','/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/dashboard/').submit();return false;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>
			<a href="/dashboard/" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>

		</div>
	</div><!-- #modalExitChoices -->

</div>