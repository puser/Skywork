<div id="modal-adduser-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		<span class="icon icon5-people-blue"></span>
		<h2><?php echo __('Register Student(s)') ?></h2>
	</div>
	<div class="modal-box-content">
		<div style="line-height:25px;color:#567AA9;"><?php echo __('Register your student(s) manually here. Add your students and send an automated email notification by clicking ‘Add.’ If they’re new to Skywork, that email will contain a temporary password.') ?></div>
		<br />
		
		<ul class="fieldset2">
			<li>
				<label><?php echo __('Email') ?>&nbsp;*</label>
				<input type="text" id="emailAddr" size="75" style="width:400px;margin-left:-20px;" />
			</li>
		</ul>
		<br /><br />
		<div class="clear"></div>
		<div style="width: 354px; margin: 0 auto; ">			
			<a href="/classes/invite_member/<?php echo $class['ClassSet']['id']; ?>/student/" id="registerAnotherLink" class="btn2 fancybox ajax" style="margin-left:16px; width: 160px; float: left;" onclick="class_invite_student(<?php echo $class['ClassSet']['id']; ?>);"><span><?php echo __('Add & register another') ?></span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); location.reload(); return false; "><span><?php echo __('Close') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript"> 
$('#registerAnotherLink').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>