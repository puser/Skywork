<div style="width:580px;">
	<div class="modal-box-head">
		<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;">
			<span class="icon5 icon5-question" style="margin:0;height:22px;"></span><?php echo __('Accept/Reject Request for a Bridge') ?>
		</h2>
	</div>
	
	<div class="modal-box-content">
		<div style="text-align:center;margin:20px;font-size:12px;">
			<?php echo __("You have chosen to reject this bridge. Please provide an explanation and click Send Rejection.\n").($_SESSION['User']['id'] != $challenge['User']['id'] && !$final ? __("If you want to reconsider your decision, click on Back to Accept/Reject.") : ''); ?><br /><br />
			<textarea id="rejectDetails" style="width:100%;height:150px;"></textarea>
		</div>	
		<br />
		<div style="width: <?php echo ($_SESSION['User']['id'] != $challenge['User']['id'] && !$final ? '275' : '140'); ?>px; margin: 0 auto; ">
			<?php if($_SESSION['User']['id'] != $challenge['User']['id'] && !$final){ ?>
				<a href="/challenges/instructor_confirm/<?php echo $challenge['Challenge']['id']; ?>/P" style="width:140px;float:right;font-size:13px;line-height:33px;" class="acceptLinks"><?php echo __('Back to Accept/Reject') ?></a>
			<?php } ?>
			<a onclick="window.location='/challenges/instructor_confirm/<?php echo $challenge['Challenge']['id']; ?>/R/?detail='+($('#rejectDetails').val() || '(no details provided)');" class="btn3" style="width:120px;float:left;"><span><?php echo __('Send Rejection') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript"> 
$('.acceptLinks').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>