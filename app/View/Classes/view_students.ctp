<div id="modal-editclass-box" class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		
		<div class="box-actions">
			<ul>
				<?php if($_SESSION['User']['id'] == $class['Owner']['id']){ ?>
					<li><a class="icon4 icon4-plus ajax-modal-link" href="#modal-adduser" >Add a new Student</a></li>
					<li><a class="icon4 icon4-remove ajax-modal-link" href="#" >Clean class</a></li>
				<?php } ?>
			</ul>
		</div>
		
		<form id="updateClassName" method="POST" action="/classes/update/">
			<h2><input type="text" name="class[ClassSet][group_name]" value="<?php echo $class['ClassSet']['group_name']; ?>" /> Students</h2>
			<input type="hidden" name="class[ClassSet][id]" value="<?php echo $class['ClassSet']['id']; ?>" />
		</form>
	</div>
	<div class="modal-box-content">
		
		<?php if(!count($class['User'])){ ?>
			<div style="text-align:center;margin:20px;">There are no students in this class.</div>
		<?php }else{ ?>
			<table class="table-type-1">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>City</th>
						<th>State</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($class['User'] as $k=>$u){ ?>
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="groupMemberRow<?php echo $u['id']; ?>">
						<td><?php echo $u['firstname']; ?></td>
						<td><?php echo $u['lastname']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo $u['city']; ?></td>
						<td><?php echo $u['state']; ?></td>
						<td>
							<?php if($class['Owner']['id'] == $_SESSION['User']['id'] && $_SESSION['User']['id'] != $u['id']){ ?>
								<a href="#modalDeleteMember" onclick="$('#deleteMemberLink').click(function(){ delete_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#deleteMemberLink').unbind(); });return false;" id="deleteMemberLink"><img src="/images/icon-x.png" /></a>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
		<br /><br /><br /><br />
		<div class="clear"></div>
		<div style="width: 200px; margin: 0 auto; ">
			<a href="#" class="btn2" style="width: 80px; float: left;" onclick="$('#updateClassName').submit(); "><span>Save</span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script type="text/javascript"> 
$('#inviteNewUserLink,#deleteMemberLink').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>