<div id="startbridge-information" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-pen"></span>
		<h2><?php echo __('Bridge Information') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content information-fields-1">
		<ul class="fieldset">
			<li>
				<p class="label"><?php echo __('Name of Bridge') ?></p>
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
				<div class="col2">
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
			<li id="add_document">
				<p class="label"><?php echo __('Document') ?></p>
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
				<p class="label"><?php echo __('Video Embed Code') ?></p>
				<textarea name="video_embed" style="width: 350px;height: 90px;"><?php echo (@$challenge['Attachment'][0]['type'] == 'C' ? $challenge['Attachment'][0]['file_location'] : '' ); ?></textarea>
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
			<p><?php echo __('Write the essay topic in one or two words:') ?></p>
			<p>
				<input type="text" class="checkdefault" default="Essay Topic" value="<?php echo @$challenge['Question'][0]['section']; ?>" name="challenge[Question][0][section]" style="width:155px;padding:5px 7px;" />
			</p>
			<p><?php echo __('Write a description of this essay topic:') ?></p>
			<p>
				<textarea class="checkdefault" default="Write description here" name="challenge[Question][0][question]" style="width:550px;height:75px;padding:5px 7px;"><?php echo @$challenge['Question'][0]['question']; ?></textarea>
			</p>
		</div>
		
		<p class="input">
			<input type="checkbox" name="challenge[Challenge][allow_attachments]" value="1"<?php if(@$challenge['Challenge']['allow_attachments']){ ?> checked="checked"<?php } ?> />
			<?php echo __('Allow students to attach documents, photos, etc.') ?>
		</p>
		<p class="label"><?php echo __('Anonymous') ?></p>
		<p class="input">
			<input type="checkbox" name="challenge[Challenge][anonymous]" value="1"<?php if(@$challenge['Challenge']['anonymous']) echo ' checked="checked"'; ?> />
			<?php echo __('Apply as anonymous (Assignment won\'t display names)') ?>
		</p>
	</div>
	
</div>

<div style="width: 120px; margin: 0 auto; ">
	<a onclick="$('#challenge_data').submit();" class="btn2"><span><?php echo __('Save &amp; Next') ?></span></a>
</div>

<input type="hidden" name="next_step" value="people" />

<script type="text/javascript">
$('#answers_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date(),onSelect:function(){
	d = $('#answers_due').datepicker('getDate');
	d.setDate(d.getDate()+1);
	$('#responses_due').datepicker('setDate',d);
}});
$('#responses_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});

if($('#response_types').val() == 'E') $('#compose_questions').remove();
else $('#compose_essay').remove();

if($('#challenge_type').val() == 'VID') $('#add_document').remove();
else $('#add_youtube').remove();
</script>