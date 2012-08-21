<div class="box-head">
	<h2><?php echo __('Attach File(s)') ?></h2>
	<div class="clear"></div>
</div>
<div class="box-content">
	<form id="responseData" method="POST" action="/attachments/update/save" enctype="multipart/form-data">
		<input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
		<ol class="fieldset2">
			<?php foreach($attachments as $k=>$a){ ?>
			<li id="exAttach<?php echo $k; ?>" style="padding-bottom:15px;">
				<a href="/uploads/<?php echo $a['Attachment']['file_location']; ?>" target="_blank"><?php echo $a['Attachment']['name']; ?></a> &nbsp;
				(<a href="#" onclick="remove_attachment('exAttach<?php echo $k; ?>',<?php echo $a['Attachment']['id']; ?>);return false;"><?php echo __('Remove') ?></a>)
			</li>
			<?php } ?>
			<li style="padding-bottom:15px;">
				<input type="hidden" name="attachment[0][type]" value="R" class="attachmentType" />
				<input type="hidden" name="attachment[0][challenge_id]" value="<?php echo $challenge_id; ?>" />
				<p><input type="text" value="Explanation" class="inputtext fullwidth" onclick="if($(this).val()=='Explanation') $(this).val('');" name="attachment[0][name]" /></p>
				<input type="file" name="attachment[0]" />
			</li>
		</ol>
		<br />
		<a href="#" class="add-link" onclick="add_response_attachment();return false;"><?php echo __('Add another attachment') ?></a>
	</form>
</div>