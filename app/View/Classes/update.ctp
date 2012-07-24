<div id="modal-addclass">
	<a style="display:none;" href="#modal-newtoken" class="btn2 modal-link" id="showGenerateToken"> </a>
	<form id="update_class" action="/classes/update/" method="POST">
		<input type="hidden" name="class[ClassSet][id]" value="<?php echo $class['ClassSet']['id']; ?>" />
		<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon icon-pen"></span>
				<h2>Edit Class</h2>
			</div>
			<div class="modal-box-content">
				<p>Edit Class Name and Save:</p>
				<ul class="fieldset2">
					<li>
						<label>Class Name</label>
						<input type="text" size="50" id="createClassName" name="class[ClassSet][group_name]" value="<?php echo $class['ClassSet']['group_name']; ?>" />
						<div class="clear"></div>
					</li>
					<li class="radioinput">
						<span class="label">Make this class searchable</span>
						<div class="input">
							<input type="radio" name="class[ClassSet][public]" value="1" id="make_class_searchable_yes" <?php if($class['ClassSet']['public']){ ?>checked="checked" <?php } ?>/> <label for="make_class_searchable_yes">Yes </label>
							<input type="radio" name="class[ClassSet][public]" value="0" id="make_class_searchable_no" <?php if(!$class['ClassSet']['public']){ ?>checked="checked" <?php } ?> /> <label for="make_class_searchable_no">No </label>
						</div>
						<div class="clear"></div>
					</li>
				</ul>
				<div class="clear"></div>
				<p class="small">Instructors will be able to search and request to join your class. For security purposes, they must know your email address and you will always be able to Accept or Reject their request.</p>
				<div class="clear"></div>
				<div style="width: 250px; margin: 0 auto; ">
					<a href="#" onclick="$('#update_class').submit();" class="btn2" style="width: 120px; float: left;" ><span>Save</span></a>
					<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</form>
</div>