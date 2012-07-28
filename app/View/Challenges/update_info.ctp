<div id="startbridge-information" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-pen"></span>
		<h2>Challenge Information</h2>
		<div class="clear"></div>
	</div>
	<div class="box-content information-fields-1">
		<ul class="fieldset">
			<li>
				<p class="label">Name of Challenge</p>
				<input type="text" class="checkdefault" value="<?php echo (@$challenge ? @$challenge['Challenge']['name'] : ''); ?>" name="challenge[Challenge][name]" id="challengeName" default="Type name here" size="60" />
			</li>
			<li class="cols2">
				<div class="col1">
					<p class="label">Due Date 1 <a href="#" class="tooltip-mark-question" ></a></p>
					<div class="date-input">
						<input type="text" value="<?php echo (@$challenge['Challenge']['answers_due']?substr($challenge['Challenge']['answers_due'],0,10):date('Y-m-d')); ?>" name="challenge[Challenge][answers_due]" id="answers_due" />
						<a onclick="$('#answers_due').datepicker('show');return false;" class="datepicker"></a>
					</div>
					<p class="label" style="clear:both;margin-top:10px;">Due Date 1 Time Deadline:</p>
					<div class="date-input">
						<input name="answers_due_hour" style="width:20px;" value="<?php echo (@$challenge ? (substr($challenge['Challenge']['answers_due'],11,2) > 12 ? substr($challenge['Challenge']['answers_due'],11,2) - 12 : substr($challenge['Challenge']['answers_due'],12,2)) : '08'); ?>" /> :
						<input name="answers_due_minute" style="width:20px;" value="<?php echo (@$challenge ? substr($challenge['Challenge']['answers_due'],14,2) : '00'); ?>"  />
						<select name="answers_due_meridian">
							<option value="AM" <?php echo (@$challenge && substr($challenge['Challenge']['answers_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
							<option value="PM" <?php echo (!@$challenge || substr($challenge['Challenge']['answers_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
						<select>
					</div>
				</div>
				<div class="col2">
					<p class="label">Due Date 2 <a href="#" class="tooltip-mark-question" ></a></p>
					<div class="date-input">
						<input type="text" value="<?php echo (@$challenge['Challenge']['responses_due']?substr($challenge['Challenge']['responses_due'],0,10):date('Y-m-d')); ?>" name="challenge[Challenge][responses_due]" id="responses_due" />
						<a onclick="$('#responses_due').datepicker('show');return false;" class="datepicker"></a>
					</div>
					<p class="label" style="clear:both;margin-top:10px;">Due Date 2 Time Deadline:</p>
					<div class="date-input">
						<input name="responses_due_hour" style="width:20px;" value="<?php echo (@$challenge['Challenge']['responses_due'] ? (substr($challenge['Challenge']['responses_due'],11,2) > 12 ? substr($challenge['Challenge']['responses_due'],11,2) - 12 : substr($challenge['Challenge']['responses_due'],12,2)) : '08'); ?>" /> :
						<input name="responses_due_minute" style="width:20px;" value="<?php echo (@$challenge['Challenge']['responses_due'] ? substr($challenge['Challenge']['responses_due'],14,2) : '00'); ?>"  />
						<select name="responses_due_meridian">
							<option value="AM" <?php echo (@$challenge && substr($challenge['Challenge']['responses_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
							<option value="PM" <?php echo (!@$challenge || substr($challenge['Challenge']['responses_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
						<select>
					</div>
				</div>
				<div class="clear"></div>
			</li>
			<li>
				<p class="label">Document</p>
				<!-- <a href="#" class="icon-add"> Add document</a> -->
				
				<div id="curCaseFile" style="font-size:12px;">
					<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>
						Current Document: 
						<a href="/uploads/<?php echo $challenge['Attachment'][0]['file_location']; ?>" target="_blank">
							<?php echo @$challenge['Attachment'][0]['name']; ?>
						</a>&nbsp;&nbsp;
						(<a href="#" onclick="remove_attachment('curCaseFile',<?php echo $challenge['Attachment'][0]['id']; ?>);return false;">Remove Document</a>)<br /><br />
					<?php } ?>
				</div>
				
				<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>Replace current document: <?php } ?>
				<input type="file" name="attachment[0]" />
				<input type="hidden" name="attachment[0][type]" value="C" />
				
			</li>
		</ul>
	</div>
	
	<div class="box-content">
		<span  id="compose_questions">
			<p>Write the questions for your Assignment here:</p>
			<ol class="fieldset">
				<?php 
				if(@$challenge['Question']){
					foreach(@$challenge['Question'] as $k=>$question){ ?>
				<li>
					<p><input type="text" class="checkdefault assignment-section-title" default="Section Title" value="<?php echo $question['section']; ?>" name="challenge[Question][<?php echo $k; ?>][section]" /> &nbsp;<a href="#" class="tooltip-mark-question" ></a></p>
					<input type="text" class="checkdefault" default="Type name here" value="<?php echo $question['question']; ?>" name="challenge[Question][<?php echo $k; ?>][question]" size="60"/>
				</li>
					<?php }
				}else{
					for($i=0;$i<2;$i++){ ?>
				<li>
					<p><input type="text" class="checkdefault assignment-section-title" default="Section Title" value="" name="challenge[Question][<?php echo $i; ?>][section]" /></p>
					<input type="text" class="checkdefault" default="Type name here" value="" name="challenge[Question][<?php echo $i; ?>][question]" size="60"/>
				</li>
					<?php }
				} ?>
			</ol>
			<p><a href="#" onclick="add_question();return false" class="icon-add">Add another</a></p>
		</span>
		
		<span id="compose_essay">
			<p>Write the essay topic in one or two words:</p>
			<p>
				<input type="text" class="checkdefault" default="Essay Topic" value="<?php echo @$challenge['Question'][0]['section']; ?>" name="challenge[Question][0][section]" style="width:155px;padding:5px 7px;" />
			</p>
			<p>Write a description of this essay topic:</p>
			<p>
				<textarea class="checkdefault" default="Write description here" name="challenge[Question][0][question]" style="width:550px;height:75px;padding:5px 7px;"><?php echo @$challenge['Question'][0]['question']; ?></textarea>
			</p>
		</div>
		
		<p class="input">
			<input type="checkbox" name="challenge[Challenge][allow_attachments]" value="1"<?php if(@$challenge['Challenge']['allow_attachments']){ ?> checked="checked"<?php } ?> />
			Allow students to attach documents, photos, etc.
		</p>
		<p class="label">Anonymous</p>
		<p class="input"><input type="checkbox" name="challenge[Challenge][anonymous]" value="1"<?php if(@$challenge['Challenge']['anonymous']) echo ' checked="checked"'; ?> /> Apply as anonymous (Assignment won't display names)</p>
	</div>
	
</div>

<div style="width: 120px; margin: 0 auto; ">
	<a onclick="$('#challenge_data').submit();" class="btn2"><span>Save &amp; Next</span></a>
</div>

<input type="hidden" name="next_step" value="people" />

<script type="text/javascript">
$('#answers_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});
$('#responses_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});

if($('#response_types').val() == 'E') $('#compose_questions').remove();
else $('#compose_essay').remove();
</script>