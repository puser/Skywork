<div id="modal-editclass-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		
		<div class="box-actions">
			<ul>
				<?php if($_SESSION['User']['id'] == $class['Owner']['id']){ ?>
					<li><a class="icon4 icon4-plus" href="/classes/invite_member/<?php echo $class['ClassSet']['id']; ?>/student/" id="inviteNewUserLink"><?php echo __('Add a new Student') ?></a></li>
					<li><a class="icon4 icon4-remove" href="#" ><?php echo __('Clean class') ?></a></li>
				<?php } ?>
			</ul>
		</div>
		
		<form id="updateClassName" method="POST" action="/classes/update/">
			<h2><?php echo $class['ClassSet']['group_name']; ?> <?php echo __('Students') ?></h2>
			<input type="hidden" name="class[ClassSet][id]" value="<?php echo $class['ClassSet']['id']; ?>" />
		</form>
	</div>
	<div class="modal-box-content">
		
		<?php if(!count($class['User']) && !count($invited)){ ?>
			<div style="text-align:center;margin:20px;"><?php echo __('There are no students in this class.') ?></div>
		<?php }else{ ?>
			<table class="table-type-1">
				<thead>
					<tr>
						<th><?php echo __('First Name') ?></th>
						<th><?php echo __('Last Name') ?></th>
						<th><?php echo __('Email') ?></th>
						<th width="110"><?php echo __('Last Logged In') ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody><!--
					<?php 
					$koffset = 0;
					if(count($invited)){ 
						foreach($invited as $k=>$s){ 
							$koffset++;
							$u = $s['User']; ?>
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="groupMemberRow<?php echo $u['id']; ?>">
						<td><?php echo $u['firstname']; ?></td>
						<td><?php echo $u['lastname']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo __('Waiting for login...'); ?></td>
						<td>
							<?php if($class['Owner']['id'] == $_SESSION['User']['id']){ ?>
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul>
											<li><a href="#modalDeleteMember" onclick="$('#deleteMemberLink').click(function(){ delete_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#deleteMemberLink').unbind(); });return false;" class="deleteStudentMemberLink icon3 icon3-close modal-link"><?php echo __('Remove') ?></a></li>
											<li><a href="#modalResendMember" onclick="$('#resendMemberLink').click(function(){ resend_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#resendMemberLink').unbind(); });return false;" class="deleteStudentMemberLink icon3 icon3-resend modal-link"><?php echo __('Resend') ?></a></li>
										</ul>
									</div>
								</div>
							<?php } ?>
						</td>
					</tr>
					<?php }} ?>
					-->
					<?php if(count($class['User'])){ foreach($class['User'] as $k=>$u){ ?>
					<tr<?php if(!(($k+$koffset)%2)){ ?> class="alternate"<?php } ?> id="groupMemberRow<?php echo $u['id']; ?>">
						<td><?php echo $u['firstname']; ?></td>
						<td><?php echo $u['lastname']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo (strstr($u['last_login'],'0000-00-00') ? __('Waiting for login...') : substr($u['last_login'],0,16)); ?></td>
						<td>
							<?php if($class['Owner']['id'] == $_SESSION['User']['id'] && $_SESSION['User']['id'] != $u['id']){ ?>
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul>
											<li><a href="#modalDeleteMember" onclick="$('#deleteMemberLink').click(function(){ delete_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#deleteMemberLink').unbind(); });return false;" class="deleteStudentMemberLink icon3 icon3-close modal-link"><?php echo __('Remove') ?></a></li>
											<?php if(strstr($u['last_login'],'0000-00-00')){ ?>
												<li><a href="#modalResendMember" onclick="$('#resendMemberLink').click(function(){ resend_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#resendMemberLink').unbind(); });return false;" class="deleteStudentMemberLink icon3 icon3-resend modal-link"><?php echo __('Resend') ?></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							<?php } ?>
						</td>
					</tr>
					<?php }} ?>
				</tbody>
			</table>
		<?php } ?>
		<br /><br /><br /><br />
		<div class="clear"></div>
		<div style="width: 200px; margin: 0 auto; ">
			<a href="#" class="btn2" style="width: 80px; float: left;" onclick="$('#updateClassName').submit(); "><span><?php echo __('Save') ?></span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript"> 
$('#inviteNewUserLink,.deleteStudentMemberLink').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>