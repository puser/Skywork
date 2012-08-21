<div class="box-head">
	<span class="icon2 icon2-listcountgreen"><?php echo $q_num; ?></span>
	<h2 ><?php echo stripslashes($question['Question']['section']); ?></h2>
	<div class="clear"></div>
</div>
<div class="box-content">
	<form id="responseData">
		<input type="hidden" name="question_id" id="question_id" value="<?php echo $question['Question']['id']; ?>" />
		<input type="hidden" id="challenge_id" value="<?php echo $question['Challenge']['id']; ?>" />
		<?php if(@$question['Response'][0]){ ?><input type="hidden" name="id" value="<?php echo $question['Response'][0]['id']; ?>" /><?php } ?>
		<input type="hidden" id="next_id" value="<?php echo (@$next_id ? $next_id : ($question['Challenge']['allow_attachments'] ? 'attachments' : 'dashboard')); ?>" />
		
		<ul class="fieldset2">
			<li>
				<p class="label-text ">
					<span class="black6">
						<?php echo stripslashes($question['Question']['question']); ?>
					</span>
				</p>
				<textarea class="niceTextarea" name="response_body" rows="10" style="font-family:Helvetica, Arial, sans-serif;font-size: 12px;"><?php echo str_replace("\\",'',stripslashes(@$question['Response'][0]['response_body'])); ?></textarea>
			</li>
		</ul>
	</form>
</div>
