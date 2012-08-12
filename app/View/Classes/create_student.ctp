<div id="modal-adduser-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		<span class="icon icon5-people-blue"></span>
		<h2><?php echo __('Add a User to Puentes') ?></h2>
	</div>
	<div class="modal-box-content">
		<ul class="fieldset2">
			<li>
				<label><?php echo __('First Name') ?></label>
				<input type="text" id="firstName" size="50" />
			</li>
			<li>
				<label><?php echo __('Last Name') ?></label>
				<input type="text" id="lastName" size="50" />
			</li>
			<li>
				<label><?php echo __('Email') ?></label>
				<input type="text" id="emailAddr" size="50" />
			</li>
		</ul>
		<br /><br />
		<div class="clear"></div>
		<div style="width: 200px; margin: 0 auto; ">
			<a href="#" class="btn2" style="width: 80px; float: left;" onclick="class_invite_student(<?php echo $class['ClassSet']['id']; ?>); jQuery.fancybox.close(); return false; "><span><?php echo __('Add') ?></span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>