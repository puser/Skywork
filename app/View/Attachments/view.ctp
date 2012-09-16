<?php if(!$ajax){ ?>
<br />
<div id="preview-full-width" class="box-white rounded">
	<div class="box-head">
		<div style="width: 80px; float: left;">
			<?php if(@$_REQUEST['fromEmail']){ ?>
				<a style="cursor:pointer;" href="/challenges/view/<?php echo $attachment['Challenge']['id']; ?>" class="btn3"><span><?php echo __('Go to Questions') ?></span></a>
			<?php }else{ ?>
				<a style="cursor:pointer;" onclick="window.history.go(-1);" class="btn3"><span><?php echo __('Back') ?></span></a>
			<?php } ?>
		</div>
		<div class="assignment-name alignright">
			<span class="icon-preview"><?php echo __('Assignment') ?></span><br />
			<!-- <a href="#">Having trouble viewing?</a> -->
		</div>
		<div class="clear"></div>
		
	</div>
	<div class="box-content">
<?php } ?>

		<div id="preview-contract" <?php if($ajax){ ?>style="margin-left:-11px;display:inline-block;"<?php }else{ ?>style="text-align:center;"<?php } ?>>
			<?php
			if($attachment['Challenge']['challenge_type'] == 'VID') echo stripslashes($attachment['Attachment']['file_location']);
			else{ ?>
			<iframe src="http://docs.google.com/viewer?url=http%3A%2F%2Fpuentesonline.com%2Fuploads%2F<?php echo $attachment['Attachment']['file_location']; ?>&embedded=true" width="735" height="500" />
			<?php } ?>
		</div>
			
<?php if(!$ajax){ ?>	
	</div>
</div>
<div class="clear">&nbsp;</div>
<?php } ?>