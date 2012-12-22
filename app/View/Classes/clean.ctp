<div id="modal-cleanconfirm" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		<span class="icon5 icon5-close"></span>
		<h2><?php echo __('Remove All') ?></h2>
	</div>
	<div class="modal-box-content">
		<div style="line-height:25px;color:#567AA9;"><?php echo __('Click Remove All to remove all of your students from this class. They will still have access to the assignments they have completed.') ?></div>
		<br />
		
		<div style="colo:#666;font-size:13px;">
			Instructors use "Remove All" at the end of a semester or trimester.<br /><br />
			After your students have been removed, simply generate a new token or add your new students manually.
		<br /><br />
		<div class="clear"></div>
		<div style="width: 354px; margin: 0 auto; ">
			<a href="/classes/clean/<?php echo $class_id; ?>" class="btn2" style="width: 160px; float: left;"><span><?php echo __('Remove All') ?></span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>