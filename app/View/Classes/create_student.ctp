<div id="modal-adduser-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		<span class="icon icon5-people-blue"></span>
		<h2>Add a User to Puentes</h2>
	</div>
	<div class="modal-box-content">
		<ul class="fieldset2">
			<li>
				<label>First Name</label>
				<input type="text" id="firstName" size="50" />
			</li>
			<li>
				<label>Last Name</label>
				<input type="text" id="lastName" size="50" />
			</li>
			<li>
				<label>Email</label>
				<input type="text" id="emailAddr" size="50" />
			</li>
		</ul>
		<br /><br />
		<div class="clear"></div>
		<div style="width: 200px; margin: 0 auto; ">
			<a href="#" class="btn2" style="width: 80px; float: left;" onclick="class_invite_student(<?php echo $class['ClassSet']['id']; ?>); jQuery.fancybox.close(); return false; "><span>Add</span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>