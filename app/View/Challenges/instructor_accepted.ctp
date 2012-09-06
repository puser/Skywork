<style type="text/css">
.bridge_share_status li {
    text-align: left;
    height: 14px;
    line-height: 14px;
    padding: 8px;
}
.accept_status {
    float: right;
}
</style>

<div style="width:580px;">
	<div class="modal-box-head">
		<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;">
			<span class="icon5 icon5-question" style="margin:0;height:22px;"></span><?php echo __('Accept/Reject Request for a Bridge') ?>
		</h2>
	</div>
	
	<div class="modal-box-content">
		<div style="text-align:center;margin:20px;font-size:12px;">
			<?php echo __("Below are the names of the Instructors who will be participating in this bridge. Pending means they have not made a decision. All participating Instructors must Accept for the bridge to begin.").($_SESSION['User']['id'] != $challenge['User']['id'] && !$final ? __('To reconsider your decision, click on Back to Accept/Reject.') : ''); ?><br /><br />
			<ul class="bridge_share_status">
			<?php foreach($challenge['Status'] as $k=>$s){ ?>
				<li<?php if($k%2) echo ' style="background:#eee;"'; ?>>
					<?php echo $s['User']['firstname'].' '.$s['User']['lastname']; ?>
					<span class="accept_status" <?php if(($_SESSION['User']['id'] == $s['user_id'] ? $status['Status']['status'] : $s['status']) == 'C') echo 'style="color:green;"'; ?>>
						<?php echo __(($_SESSION['User']['id'] == $s['user_id'] ? $status['Status']['status'] : $s['status']) == 'P' ? 'Pending' : (($_SESSION['User']['id'] == $s['user_id'] ? $status['Status']['status'] : $s['status']) == 'C' ? 'Accepted' : 'Rejected')) ?>
					</span>
				</li>
			<?php } ?>
			</ul>
		</div>	
		<br />
		<div style="width: <?php echo ($_SESSION['User']['id'] != $challenge['User']['id'] && !$final ? '244' : '100'); ?>px; margin: 0 auto; ">
			<a class="btn2" <?php if($final) echo 'href="/dashboard/"'; ?> onclick="jQuery.fancybox.close();" style="width:90px;float:left;"><span><?php echo __('Close') ?></span></a>
			<?php if($_SESSION['User']['id'] != $challenge['User']['id'] && !$final){ ?>
				<a href="/challenges/instructor_confirm/<?php echo $challenge['Challenge']['id']; ?>/P" style="width:140px;float:right;font-size:13px;line-height:33px;" class="acceptLinks"><?php echo __('Back to Accept/Reject') ?></a>
			<?php } ?>
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