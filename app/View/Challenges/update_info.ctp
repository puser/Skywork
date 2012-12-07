<style type='text/css'>
.remove-class:hover a.remove-class-icon { background: url('/images/arrow-down-purple.png') no-repeat center center !important; }
.remove-class:hover,.remove-class.open,.remove-class { border:0 !important;height:16px; }
.remove-class.open:hover a.remove-class-icon,.remove-class.open a.remove-class-icon{ background:transparent url('/images/arrow-up-purple.png') no-repeat center center !important; }
#min_length_input{ display:inline-block; }
</style>

<div id="HelpDialog" style="display:none;text-align:center;"> </div>
<div id="startbridge-information" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-pen"></span>
		<h2><?php echo __('Assignment Information') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content information-fields-1">
		<ul class="fieldset">
			<li>
				<p class="label"><?php echo __('Name of Assignment') ?></p>
				<input type="text" class="checkdefault" value="<?php echo (@$challenge ? @$challenge['Challenge']['name'] : ''); ?>" name="challenge[Challenge][name]" id="challengeName" default="<?php echo __('Type name here') ?>" size="60" />
			</li>
			<li class="cols2">
				<div class="col1">
					<p class="label"><?php echo __('Due Date 1') ?> <a href="#" class="tooltip-mark-question" title="<?php echo __('Students answer questions or write essay') ?>" ></a></p>
					<div class="date-input">
						<input type="text" value="<?php echo (@$challenge['Challenge']['answers_due']?substr($challenge['Challenge']['answers_due'],0,10):date('Y-m-d')); ?>" name="challenge[Challenge][answers_due]" id="answers_due" />
						<a onclick="$('#answers_due').datepicker('show');return false;" class="datepicker"></a>
					</div>
					<p class="label" style="clear:both;margin-top:10px;"><?php echo __('Due Date 1 Time Deadline:') ?></p>
					<div class="date-input">
						<input name="answers_due_hour" style="width:20px;" value="<?php echo (@$challenge ? (substr($challenge['Challenge']['answers_due'],11,2) > 12 ? substr($challenge['Challenge']['answers_due'],11,2) - 12 : substr($challenge['Challenge']['answers_due'],12,2)) : '08'); ?>" /> :
						<input name="answers_due_minute" style="width:20px;" value="<?php echo (@$challenge ? substr($challenge['Challenge']['answers_due'],14,2) : '00'); ?>"  />
						<select name="answers_due_meridian">
							<option value="AM" <?php echo (@$challenge && substr($challenge['Challenge']['answers_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
							<option value="PM" <?php echo (!@$challenge || substr($challenge['Challenge']['answers_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
						<select>
						<span style="position:relative;top: 2px;left: 6px;">EST</span>
					</div>
				</div>
				<div class="col2" id="duedate2_input">
					<p class="label"><?php echo __('Due Date 2') ?> <a href="#" class="tooltip-mark-question" title="<?php echo __('Time for feedback and collaboration') ?>"></a></p>
					<div class="date-input">
						<input type="text" value="<?php echo (@$challenge['Challenge']['responses_due']?substr($challenge['Challenge']['responses_due'],0,10):date_format(date_add(date_create(),new DateInterval('P1D')),'Y-m-d')); ?>" name="challenge[Challenge][responses_due]" id="responses_due" />
						<a onclick="$('#responses_due').datepicker('show');return false;" class="datepicker"></a>
					</div>
					<p class="label" style="clear:both;margin-top:10px;"><?php echo __('Due Date 2 Time Deadline:') ?></p>
					<div class="date-input">
						<input name="responses_due_hour" style="width:20px;" value="<?php echo (@$challenge['Challenge']['responses_due'] ? (substr($challenge['Challenge']['responses_due'],11,2) > 12 ? substr($challenge['Challenge']['responses_due'],11,2) - 12 : substr($challenge['Challenge']['responses_due'],12,2)) : '08'); ?>" /> :
						<input name="responses_due_minute" style="width:20px;" value="<?php echo (@$challenge['Challenge']['responses_due'] ? substr($challenge['Challenge']['responses_due'],14,2) : '00'); ?>"  />
						<select name="responses_due_meridian">
							<option value="AM" <?php echo (@$challenge && substr($challenge['Challenge']['responses_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
							<option value="PM" <?php echo (!@$challenge || substr($challenge['Challenge']['responses_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
						<select>
						<span style="position:relative;top: 2px;left: 6px;">EST</span>
					</div>
				</div>
				<div class="clear"></div>
			</li>
			<li style='border-bottom: 1px solid #E6E6E6; margin-top: -13px; width: 758px; margin-left: -9px;'>&nbsp;</li><br/>
			<li id="add_document" style='padding-top:10px'>
				<p class="label"><?php echo __('Upload the Assignment: Document') ?></p>
				<!-- <a href="#" class="icon-add"> Add document</a> -->
				
				<div id="curCaseFile" style="font-size:12px;">
					<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>
						<?php echo __('Current Document:') ?> 
						<a href="/uploads/<?php echo $challenge['Attachment'][0]['file_location']; ?>" target="_blank">
							<?php echo @$challenge['Attachment'][0]['name']; ?>
						</a>&nbsp;&nbsp;
						(<a href="#" onclick="remove_attachment('curCaseFile',<?php echo $challenge['Attachment'][0]['id']; ?>);return false;"><?php echo __('Remove Document') ?></a>)<br /><br />
					<?php } ?>
				</div>
				
				<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?><?php echo __('Replace current document:') ?> <?php } ?>
				<input type="file" name="attachment[0]" />
				<input type="hidden" name="attachment[0][type]" value="C" />
				
			</li>
			<li id="add_youtube">
				<p class="label"><?php echo __('Video Embed Code') ?> <span class="action-preview" style="margin-left: 180px; font-size: 13px;"><a href="#" onclick="$('#HelpDialog').dialog('open');return false;"><?php echo __('Help?') ?></a></span></p>
				<textarea name="video_embed" style="width: 350px;height: 90px;"><?php echo (@$challenge['Attachment'][0]['type'] == 'C' ? $challenge['Attachment'][0]['file_location'] : '' ); ?></textarea>
			</li>
			<li id="add_offline">
				<p class="lable"><?php echo __('Offline Challenge') ?></p>
				<p class="input"> </p>
			</li>
		</ul>
	</div>
	
	<div class="box-content">
		<span  id="compose_questions">
			<p><?php echo __('Write the questions for your Assignment here:') ?></p>
			<ol class="fieldset">
				<?php 
				if(@$challenge['Question']){
					foreach(@$challenge['Question'] as $k=>$question){ ?>
						<li>
							<p><!-- <input type="text" class="checkdefault assignment-section-title" value="<?php echo $question['section']; ?>" name="challenge[Question][<?php echo $k; ?>][section]" /> --> &nbsp;<a href="#" class="tooltip-mark-question" title="<?php echo __('One or two words summarizing this question') ?>"></a></p>
							<input type="text" class="checkdefault" value="<?php echo $question['question']; ?>" name="challenge[Question][<?php echo $k; ?>][question]" size="60"/>
							<input type="hidden" name="challenge[Question][<?php echo $k; ?>][id]" value="<?php echo $question['id']; ?>" />
						</li>
					<?php }
				}else{
					for($i=0;$i<2;$i++){ ?>
						<li>
							<p><!-- <input type="text" class="checkdefault assignment-section-title" default="<?php echo __('Section Title') ?>" value="" name="challenge[Question][<?php echo $i; ?>][section]" /> --></p>
							<input type="text" class="checkdefault" default="<?php echo __('Type name here') ?>" value="" name="challenge[Question][<?php echo $i; ?>][question]" size="60"/>
						</li>
					<?php }
				} ?>
			</ol>
			<p><a href="#" onclick="add_question();return false" class="icon-add"><?php echo __('Add another') ?></a></p>
		</span>
		
		<span id="compose_essay">
			<!-- 
			<p><?php echo __('Write the essay topic in one or two words:') ?></p>
			<p>
				<input type="text" class="checkdefault" default="Essay Topic" value="<?php echo @$challenge['Question'][0]['section']; ?>" name="challenge[Question][0][section]" style="width:155px;padding:5px 7px;" />
			</p>
			-->
			<p><?php echo __('Write a description of this essay topic:') ?></p>
			<p>
				<textarea class="checkdefault" default="Write description here" name="challenge[Question][0][question]" style="width:550px;height:75px;padding:5px 7px;"><?php echo @$challenge['Question'][0]['question']; ?></textarea>
				<?php if(@$challenge['Question'][0]['question']['id']){ ?>
					<input type="hidden" name="challenge[Question][0][id]" value="<?php echo $question['id']; ?>" />
				<?php } ?>
			</p>
		</span>
	</div>
	
	<div style="padding:10px;">
		<p class="input">
			<input type="checkbox" name="challenge[Challenge][allow_attachments]" value="1"<?php if(@$challenge['Challenge']['allow_attachments']){ ?> checked="checked"<?php } ?> />
			<?php echo __('Allow students to attach documents, photos, etc.') ?>
		</p>
		
		<br />
		<p class="label" style="font-size:13px;"><?php echo __('Assignment Length (Min / Max)') ?></p>
		<p class="input">
			<input type="checkbox" id="min_length" onchange="setTimeout('check_min_length()',10);" checked="checked" disabled />&nbsp;
			<span id="min_length_input" style="display:none;padding-bottom:5px;">
				<input type="text" name="challenge[Challenge][min_response_length]" style="width:40px;" value="<?php echo (@$challenge['Challenge']['min_response_length'] > 0 ? $challenge['Challenge']['min_response_length'] : 1); ?>" />&nbsp;
				<strong>Minimum</strong> words required for each question to be considered complete.
			</span>
			<span id="min_length_disabled">No minimum words required for each question</span><br />
		
			<input type="checkbox" id="max_length" onchange="setTimeout('check_max_length()',10);" <?php if(@$challenge['Challenge']['max_response_length']) echo 'checked="checked"'; ?> />&nbsp;
			<span id="max_length_input" style="display:none;">
				<input type="text" name="challenge[Challenge][max_response_length]" style="width:40px;" value="<?php echo @$challenge['Challenge']['max_response_length']; ?>" />&nbsp;
				<strong>Maximum</strong> words allowed for each question.<br />
				<input type="checkbox" style="margin-left:30px;" <?php if(@$challenge['Challenge']['allow_exceeded_length']) echo ' checked="checked"'; ?> onchange="$('#maxLengthHidden').val($(this).attr('checked') ? '1' : '0');" />
				<span style="display:inline-block;width:15px;height:13px;background:url(/images/icons/icon-flag-15x30.png) top left no-repeat;padding-right:3px;vertical-align:middle;"> </span>
				Allow students to pass maximum; create a flag when they do.
			</span>
			<span id="max_length_disabled">No maximum word count for each question</span><br />
		</p>
		<input type="hidden" name="challenge[Challenge][allow_exceeded_length]" id="maxLengthHidden" value="<?php echo @$challenge['Challenge']['allow_exceeded_length']; ?>" />
		
		<br />
		<div class="label" style="font-size:15px;border-top:1px solid #ccc;cursor:pointer;padding-top:20px;padding-bottom:18px;" onclick="$(this).next().slideToggle();$(this).find('.remove-class').toggleClass('open');">
			<?php echo __('Advanced Options') ?>
			<div class="remove-class" style="display:inline-block;">
				<a class="remove-class-icon" href="#" style="padding-top:5px;" onclick="return false;"></a>
			</div>
		</div>
		<div id="advanced_options" style="display:none;">
			<p class="label anonymous_input" style="font-size:13px;"><?php echo __('Anonymous') ?></p>
			<p class="input anonymous_input">
				<input type="checkbox" name="challenge[Challenge][anonymous]" value="1"<?php if(@$challenge['Challenge']['anonymous']) echo ' checked="checked"'; ?> />
				<?php echo __('Apply as anonymous (Assignment won\'t display names)') ?>
			</p>
			
			<br />
			<p class="label" style="font-size:13px;"><?php echo __('Quality Scales') ?></p>
			<p class="input">
				<input type="checkbox" onchange="if(!$(this).attr('checked')){ $('.scaleCustom').attr('checked',''); }else{ $('.scaleCustom').attr('checked','checked'); }" />
				<?php echo __('Use Quality Scales (Rate the quality of your students\' work on a scale from High Quality to Poor Quality during Due Date 2.)') ?>
				<span style="font-size:9px;">&nbsp;Note: this is recommended if used over multiple bridges</span>
				<div class="clear"></div>
				
				<div style="padding:0 0 0 22px;">
					<input class="scaleCustom" type="checkbox" name="challenge[Challenge][instructor_ratings]" value="1"<?php if(@$challenge['Challenge']['instructor_ratings']) echo ' checked="checked"'; ?> />
					<?php echo __('Allow instructor ratings: only the instructor may rate the quality of their students.') ?>
					<div class="clear"></div>
					
					<input class="scaleCustom" type="checkbox" name="challenge[Challenge][student_ratings]" value="1"<?php if(@$challenge['Challenge']['student_ratings']) echo ' checked="checked"'; ?> />
					<?php echo __('Allow student ratings: students may rate the quality of work for the other students in their group.') ?>
				</div>
			</p>
		</div>
	</div>	
</div>

<div style="width: 120px; margin: 0 auto; ">
	<a id="info_save" onclick="$('#challenge_data').submit();" class="btn2"><span><?php echo __('Save &amp; Next') ?></span></a>
</div>

<input type="hidden" name="next_step" value="people" />

<script type="text/javascript">
$('#answers_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date(),onSelect:function(){
	d = $('#answers_due').datepicker('getDate');
	d.setDate(d.getDate()+1);
	$('#responses_due').datepicker('setDate',d);
	$('#responses_due').datepicker("option","minDate",$('#answers_due').datepicker('getDate'));
}});
$('#responses_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});

if($('#response_types').val() == 'E') $('#compose_questions').remove();
else $('#compose_essay').remove();

if($('#challenge_type').val() == 'VID'){
	$('#add_document').remove();
	$('#add_offline').remove();
}else if($('#challenge_type').val() == 'OFFLINE'){
	$('#add_document').remove();
	$('#add_youtube').remove();
	$('#add_offline .input').html($('#offline_challenge_val').val());
}else{
	$('#add_youtube').remove();
	$('#add_offline').remove();
}

if($('#collaboration_type').val() == 'NONE'){
	$('#duedate2_input').remove();
	$('.anonymous_input').remove();
}

function check_max_length(){
	if($('#max_length').attr('checked')){
		$('#max_length_input').show();
		$('#max_length_disabled').hide();
	}else{
		$('#max_length_input').hide();
		$('#max_length_disabled').show();
		$('#max_length_input input').val('');
	}
}

function check_min_length(){
		if($('#min_length').attr('checked')){
			$('#min_length_input').show();
			$('#min_length_disabled').hide();
		}else{
			$('#min_length_input').hide();
			$('#min_length_disabled').show();
			$('#min_length_input input').val('');
		}
}

check_max_length();
check_min_length();

$('#HelpDialog').load('/challenges/viewpdf/Help.pdf',function(){
	$("#HelpDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
});
</script>