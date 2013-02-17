<div id="modal-importclass-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		<a href="#" onclick="$('#createClassLink').click();" style="float:right;color:#C1272D;font-size:13px;margin-top:15px;">Cancel &amp; Go Back</a>
		
		<span class="icon icon-plus"></span>
		<h2><?php echo __('Create Class') ?></h2>
	</div>
	<div class="modal-box-content">
		<p style="color:#567AA9;"><?php echo __('Please read these instructions before uploading your excel spreadsheet:') ?></p>
		<p style="line-height:28px;font-size:14px;">
			<?php echo __('Before uploading an excel spreadsheet, make sure all emails are in Column A*. Emails must have an @ symbol and an ending: .com, .org, .edu, .net, etc. Once you have browsed and attached the .csv file, click on Upload & Send. Puentes will generate an automated email to your students. That email will contain a temporary password. Your students will then sign into Puentes using that password.') ?>
		</p>
		<p style="font-size:11px;"><?php echo __('*Note: You may put their First Names in Column B and Last Names in Column C, but this is not required.') ?></p>
		<br />
		<p style="color:#567AA9;"><?php echo __('Here is an example of a spreadsheet that would successfully upload:') ?></p>
		<img src="/images/csv_sample.png" style="padding-left:47px;padding-bottom:10px;" />
		<br />
		
		<div style="text-align:center;">
			<iframe src="/users/import_class/<?php echo $class_id; ?>/1" style="width:355px;height:100px;border:none;padding-top:10px;padding-left:5px;padding-bottom:10px;" border="0" id="frame_import" />
		</div>
		<div class="clear"></div>
	</div>
</div>