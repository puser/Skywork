<div id="modal-addprofessor-box" class="modal-wrapper" style="width: 600px;" >
	<form id="addSharedProfessor">
		<div class="modal-box-head">
			<span class="icon icon-class-color"></span>
			<h2>Add Professor to Shared Class</h2>
		</div>
		<div class="modal-box-content">
			<p>Please enter the information below before adding to your class:</p>
			<ul class="fieldset2">
				<li>
					<label>First Name</label>
					<input type="text" size="50" id="firstName" />
				</li>
				<li>
					<label>Last Name</label>
					<input type="text" size="50" id="lastName" />
				</li>
				<li>
					<label>Email</label>
					<input type="text" size="50" id="emailAddr" />
				</li>
				<li>
					<label>Permissions</label>
					<div class="input-wrap">
						<p>This Professor can add my class to a Bridge:</p>
						<p><input type="radio" id="permissions" value="L" checked="checked" /> Only if (s)he requests and I accept</p>
						<p><input type="radio" id="permissions" value="U" /> Without request</p>
					</div>
					<div class="clear"></div>
				</li>
			</ul>
			<br /><br />
			<div class="clear"></div>
			<div style="width: 230px; margin: 0 auto; ">
				<a href="#" class="btn2" style="width: 140px; float: left;" onclick="class_invite_professor(<?php echo $class['ClassSet']['id']; ?>);jQuery.fancybox.close(); return false; "><span>Send Notification</span></a>
				<a href="#" class="btn3" style="width: 60px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
				<div class="clear"></div>
			</div>
		</div>
	</form>
</div>