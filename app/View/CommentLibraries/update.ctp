<style type="text/css">
#updateLibForm {
	padding:0 15px;
}
#updateLibForm p {
	line-height:25px;
}
#updateLibForm h2 {
	font-size:22px;
}
#updateLibForm h3 {
	font-size:18px;
	color:#00467E;
	font-weight:normal;
	padding-top:15px;
}
</style>

<form id="updateLibForm" action="/comment_libraries/update/" method="POST">
	<input type="hidden" name="library[CommentLibrary][id]" value="<?php echo $library['CommentLibrary']['id']; ?>" />
	<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 550px;" >
		<div class="modal-box-head">
			<span class="icon icon-pen"></span>
			<h2 style="padding-top:9px;margin-bottom:5px;"><?php echo __('Edit') ?></h2>
		</div>
		<div class="modal-box-content" id="updateMeta"<?php if(@$_REQUEST['showComments']){ ?> style="display:none;"<?php } ?>>
			<h3><?php echo __('Library Name') ?></h3>
			<input type="text" name="library[CommentLibrary][name]" value="<?php echo $library['CommentLibrary']['name']; ?>" style="width:300px;" />
			
			<h3><?php echo __('Sharing') ?></h3>
			<p><?php echo __('Please enter the email addresses of the people you would like to share this commenting library with, separated by a comma:') ?></p>
			<?php
			$sharing = '';
			foreach($library['LibUser'] as $k=>$u){
				if($u['id'] != $_SESSION['User']['id']) $sharing .= ($sharing ? ', ' : '') . $u['login'];
			}
			?>
			<textarea style="width:98%;height:100px;" name="sharing"><?php echo $sharing; ?></textarea>
			
			<h3><?php echo __('On/Off') ?></h3>
			<p>
				<input type="radio" name="user_active" value="1" <?php if($active) echo 'checked="checked"'; ?> />&nbsp; <?php echo __('On: Activate this commenting library when I’m grading'); ?><br />
				<input type="radio" name="user_active" value="0" <?php if(!$active) echo 'checked="checked"'; ?> />&nbsp; <?php echo __('Off: Deactivate this commenting library when I’m grading'); ?><br />
			</p>
		
			<br />
			<div class="clear"></div>
			<div style="width: 370px; margin: 15px auto 20px auto; ">
				<div style="width: 135px; float: left; margin-right:15px;	">
					<a href="#" class="btn2" style="width: 100%" onclick="$('#updateLibForm	').submit();return false;">
						<span><?php echo __('Save') ?></span>
					</a>
				</div>
				<div style="width: 90px; float: left; margin-right:15px;	">
					<a href="#" class="btn3 " style="width: 100%" onclick="jQuery.fancybox.close();return false;">
						<span><?php echo __('Cancel') ?></span>
					</a>
				</div>
			</div>	
			<div style="width: 120px; float: right; padding-top:7px;font-size:14px;">
				<a href="#" onclick="$('#updateComments').show();$('#updateMeta').hide();"><?php echo __('Edit Comments') ?> &gt;</a>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="modal-box-content" id="updateComments"<?php if(!@$_REQUEST['showComments']){ ?> style="display:none;"<?php } ?>>
			<p><?php echo __('Write your comments') ?></p>
			<?php foreach($library['Comment'] as $k=>$c){ ?>
				<div onmouseover="$('.remove-class-link',this).show();" onmouseout="$('.remove-class-link',this).hide();">
					<input style="width:95%;margin:4px 0;" name="library[LibraryComment][][comment]" value="<?php echo $c['comment']; ?>" />
					<a href="#" onclick="$(this).parent().remove();return false;" class="remove-class-link icon3-close" style="width:13px;height:13px;display:inline-block;float:right;margin-top:8px;display:none;"> </a>
				</div>
			<?php } ?>
			<div>
				<input style="width:95%;margin:4px 0;" name="library[LibraryComment][][comment]" onfocus="$(this).before($('<div />').append($(this).clone().attr('onfocus','')).html());$(this).prev().focus();" />
			</div>
			
			<div class="clear"></div>
			<div style="width: 160px; margin: 15px auto 20px auto; ">
				<div style="width: 135px; float: left; margin-right:15px;	">
					<a href="#" class="btn2" style="width: 100%" onclick="$('#updateLibForm').submit();return false;">
						<span><?php echo __('Save and Finish') ?></span>
					</a>
				</div>
			</div>	
			<div style="width: 120px; float: right; padding-top:7px;font-size:14px;">
				<a href="#" onclick="$('#updateComments').hide();$('#updateMeta').show();"><?php echo __('Go Back') ?></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>