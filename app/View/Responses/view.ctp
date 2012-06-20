<?php if(!@$ajax){ ?>
<div id="leftcol" class="alignleft">
	<div class="discuss-comment-author">
		<h1 class="page-title">Agree, Disagree </h1>

		<span class="commentAuthorName georgia"><?php echo ($question['Challenge']['challenge_type'] == 'A' ? 'Anonymous' : "{$question['Response'][0]['User']['firstname']} {$question['Response'][0]['User']['lastname']}"); ?></span>
	</div>
	
	<div id="caseclubmenu" class="no-icon">
		<ul>
			<?php foreach($question['Challenge']['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if($q['id']==$question['Question']['id']){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>">
				<a id="respNav_<?php echo $q['id']; ?>" style="cursor:pointer;"><?php echo $q['section']; ?></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">

	<div class="caseclub-links-wrap">
		<div class="alignleft caseclub-location"><?php echo $question['Challenge']['name']; ?></div>
		<div class="alignright caseclub-links">

			<a href="#modalCaseChoices" class="caseclub-preview" onclick="check_updated_for_case();">See Case</a>
			<a style="cursor:pointer;" onclick="if($('#responseValue').val()){ save_second_response(); }" class="caseclub-save">Save</a>
			<a href="#" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="answerQuestionsFormThemes" class="form-fields-wrap round round-white">

		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body" style="min-height:400px;">
			<div class="body-r" id="mainResponseBody">
<?php } ?>
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-listcountgreen"><?php echo $q_num; ?></span>
						<h2 class="page-subtitle"><?php echo stripslashes($question['Question']['section']); ?></h2>
						
						<div class="okay-state alignright agreeAction" style="display:none;"><span class="okay inner">Agree</span></div>
						<div class="okay-state alignright disagreeAction" style="display:none;"><span class="notokay inner">Disagree</span></div>
						
						<div class="action-buttons" id="chooseResponse">
							<div class="action-button action-buttons-notokay alignright">
								<a href="#" onclick="$.bbq.pushState({'select':'disagree'});return false;" class="btn2"><span class="inner">Disagree</span></a>
							</div>
							<div class="action-button action-buttons-okay alignright">
								<a href="#" onclick="$.bbq.pushState({'select':'agree'});return false;" class="btn1"><span class="inner">Agree</span></a>
							</div>
						</div>
					</div>
					<form id="responseData">
						<input type="hidden" id="currentID" value="<?php echo @$own_response['Response']['id']; ?>" name="id" />
						<input type="hidden" id="responseValue" value="" name="response_type" />
						<input type="hidden" id="responseID" name="response_id" value="<?php echo $question['Response'][0]['id']; ?>" />
						<ul class="fieldset2">
							<li>
								<p class="label-text caseQuestion">Question <?php echo $q_num; ?> <span class="black6"><?php echo stripslashes($question['Question']['question']); ?></span></p>
								<br />
								<div class="caseclubAnswerBlock georgia" style="overflow:hidden;">
									<?php echo str_replace("\\",'',stripslashes(nl2br($question['Response'][0]['response_body']))); ?>
								</div>
							</li>
						</ul>
						
						<div class="responseActions" style="display:none;">
							<br /><br />
							<div class="comments-field fieldset2 disagreeAction" style="display:none;">
								<a class="label-comments">Add a comment (Required) <span class="red">*</span></a>
								<textarea class="input-textarea-fullwidth"><?php echo (@$own_response['Response']['response_type'] == 'D' ? str_replace("\\",'',stripslashes($own_response['Response']['response_body'])) : ''); ?></textarea>
								<br />
							</div>
						
							<br /><br />
							<div class="comments-field fieldset2 agreeAction" style="display:none;">
								<a class="label-comments">Add a comment (Optional)</a>
								<input type="text" class="fullwidth" value="<?php echo (@$own_response['Response']['response_type'] == 'A' ? str_replace("\\",'',htmlentities($own_response['Response']['response_body'])) : ''); ?>" />
							</div>
						</div>
						
					</form>
				</div>
				<script type="text/javascript">
				var next_q_id = '<?php echo $next_id; ?>';
				
				$.bbq.pushState({'select':'<?php echo (@$own_response['Response']['response_type'] == 'A' ? 'agree' : (@$own_response['Response']['response_type'] == 'D' ? 'disagree' : 'reconsider')); ?>'});
				
				$(document).ready(function(){
					$('#finalSaveBtn').unbind('click');
					<?php if($next_id){ ?>
						$('#finalSaveBtn').bind('click',function(){ save_second_response('next');return false; });
						$('#finalSaveBtn').attr('href','#');
					<?php }else{ ?>
						$('#finalSaveBtn').attr('href','#modalSaveChoices');
					
						$('#finalSaveBtn').fancybox({
							'hideOnOverlayClick' : false,
							'showCloseButton' : false,
							'centerOnScroll' : true,
							'enableEscapeButton' : false
						});
					<?php } ?>
				});
				</script>
<?php if(!@$ajax){ ?>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #answerQuestionsFormThemes-->
	
	<form id="tempResponseData" style="display:none;">
		
	</form>
	
	<p class="textAlignCenter red" id="fieldValidate" style="display:none;">* You must complete this section</p>
	<br /><br />
	
	<div class="caseclub-actions responseActions" style="display:none;">
		<div class="alignleft">
			<a href="#" onclick="$.bbq.pushState({'select':'reconsider'});return false;" class="btn2 reconsider"><span class="inner">Reconsider</span></a>
		</div>
		<div class="alignright">
			<a href="#" class="btn1" id="finalSaveBtn">
				<span class="inner">Save and Continue</span>
			</a>
		</div>
		<div class="clear"></div>

	</div>

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
			<a href="#" onclick="jQuery.fancybox.close();if($('#responseValue').val()){ save_second_response('/dashboard/'); }else window.location = '/dashboard/';" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>
			<a href="/dashboard/" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>

		</div>
	</div><!-- #modalExitChoices -->
	
	<div id="modalCaseChoices">
		<div class="box-heading">
			<span class="icon icon-save"></span>
			<h2 class="page-subtitle label-text">Save</h2>
		</div>

		<br />
		<p class="caseclubFont18 blue textAlignCenter">Save current work before continuing?</p>
		<br /><br /><br />
		<div class="exitSaveOptions" style="width:450px;margin-left:10px;">
			<a onclick="jQuery.fancybox.close();if($('#responseValue').val()){ save_second_response('/attachments/view/case/<?php echo $question['Challenge']['id']; ?>'); }else window.location = '/attachments/view/case/<?php echo $question['Challenge']['id']; ?>';" style="cursor:pointer;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes</span></a>
			<a href="/attachments/view/case/<?php echo $question['Challenge']['id']; ?>" class="btn2 btn-savecontinue aligncenter"><span class="inner">No</span></a>
		</div>
	</div>

	<div id="modalSaveChoices" style="height:220px;overflow:hidden;">
		<div class="box-heading">
			<span class="icon icon-star"></span>
			<h2 class="page-subtitle label-text">Congratulations!</h2>
		</div>

		<br />
		<p class="blue textAlignCenter" style="font-size:15px;width:390px;margin-left:45px;margin-right:45px;">You have completed all sections. You have until the next Due Date to edit any information you wish. Would you like to go to Home?</p>
		<br /><br /><br />
		<div class="exitSaveOptions" style="width:475px;margin-left:13px;">
			<a style="float:left;cursor:pointer;width:180px;" onclick="jQuery.fancybox.close();save_second_response('/dashboard/');" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save and Go Home</span></a>
			<a style="float:right;cursor:pointer;width:240px;" onclick="jQuery.fancybox.close();save_second_response('/responses/view/<?php echo $question['Question']['id'].'/'.$question['Response'][0]['User']['id']; ?>');return false;" class="btn2 btn-savecontinue aligncenter"><span class="inner">Save, but Continue to Edit Answers</span></a>
			<div class="clear"></div>
		</div>
	</div>

</div>

<script type="text/javascript">
if(!$.bbq.getState('q_id')) $.bbq.pushState({'q_id':<?php echo $question['Question']['id']; ?>,'select':'<?php echo (@$own_response['Response']['response_type'] == 'A' ? 'agree' : (@$own_response['Response']['response_type'] == 'D' ? 'disagree' : '')); ?>'});
setup_second_response_hashchange('<?php echo (@$own_response['Response']['response_type'] == 'A' ? 'agree' : (@$own_response['Response']['response_type'] == 'D' ? 'disagree' : '')); ?>',<?php echo $question['Question']['id']; ?>,<?php echo $question['Response'][0]['User']['id']; ?>);

$('.caseclub-preview').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});

var responseEdited = false;
$('[name="response_body"]').change(function(){ responseEdited = true; });

function check_updated_for_case(){
	if(!responseEdited){
		$('#fancybox-overlay').remove();
		$('#fancybox-wrap').remove();
		jQuery.fancybox.close();
		window.location = '/attachments/view/case/<?php echo $question['Challenge']['id']; ?>';
	}
}
</script>
<?php } ?>