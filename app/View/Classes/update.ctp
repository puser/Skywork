<div id="modal-addclass">
	<a style="display:none;" href="#modal-newtoken" class="btn2 modal-link" id="showGenerateToken"> </a>
	<form id="update_class" action="/classes/update/" method="POST">
		<input type="hidden" name="class[ClassSet][id]" value="<?php echo $class['ClassSet']['id']; ?>" />
		<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon icon-pen"></span>
				<h2><?php echo __('Edit Class') ?></h2>
			</div>
			<div class="modal-box-content">
				<p><?php echo __('Edit Class Name and Save:') ?></p>
				<ul class="fieldset2">
					<li>
						<label><?php echo __('Class Name') ?></label>
						<input type="text" size="50" id="createClassName" name="class[ClassSet][group_name]" value="<?php echo $class['ClassSet']['group_name']; ?>" />
						<div class="clear"></div>
					</li>
				</ul>
				<div class="clear"></div>
				<div style="width: 250px; margin: 0 auto; ">
					<a href="#" onclick="$('#update_class').submit();" class="btn2" style="width: 120px; float: left;" ><span><?php echo __('Save') ?></span></a>
					<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</form>
</div>