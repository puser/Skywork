<div style="width:580px;height:280px;">
	<div class="modal-box-head">
		<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;">
			<span class="icon5 icon5-question" style="margin:0;height:22px;"></span><?php echo __('Accept/Reject Request for a Bridge') ?>
		</h2>
	</div>
	
	<div class="modal-box-content">
		<div style="text-align:center;margin:20px;font-size:12px;">
			<?php
			$message = __("{name} has added your class(es) to a bridge with Due Date 1: {date1} and\nDue Date 2: {date2}. These are the class(es) that have been added:\n\n{classes}\n\nYou can accept or reject this request. If you reject, you will have the opportunity to write a response.");
			$message = str_replace('{name}',$challenge['User']['firstname'].' '.$challenge['User']['lastname'],$message);
			$message = str_replace('{date1}',date_format(date_create($challenge['Challenge']['answers_due']),'m/d/Y'),$message);
			$message = str_replace('{date2}',date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'),$message);
			$message = str_replace('{classes}','<strong>'.$status['Class']['group_name'].'</strong>',$message);
			echo nl2br($message);
			?>
		</div>	
		<br />
		<div style="width: 200px; margin: 0 auto; ">
			<a href="/challenges/instructor_confirm/<?php echo $challenge['Challenge']['id']; ?>/C" class="btn2 acceptLinks" style="width: 90px; float: left;"><span><?php echo __('Accept') ?></span></a>
			<a href="/challenges/instructor_confirm/<?php echo $challenge['Challenge']['id']; ?>/R" class="btn3 acceptLinks" style="width: 90px; float: right;"><span><?php echo __('Reject') ?></span></a>
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