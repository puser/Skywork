<div class="modal-wrapper" style="width: 600px;" >
	<div class="modal-box-head">
		
		<div class="box-actions">
			<ul>
				<li><a class="icon4 icon4-plus" id="createProfessorLink" href="/classes/create_professor/<?php echo $class['ClassSet']['id']; ?>" >Add a professor</a></li>
			</ul>
		</div>
		
		<span class="icon5 icon5-shake"></span>
		<h2><?php echo $class['ClassSet']['group_name']; ?> - Shared</h2>
	</div>
	<div class="modal-box-content">
		
		<table class="table-type-1">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($class['User'] as $k=>$u){ ?>
				<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="groupMemberRow<?php echo $u['id']; ?>">
					<td><?php echo $u['firstname']; ?></td>
					<td><?php echo $u['lastname']; ?></td>
					<td><?php echo $u['email']; ?></td>
					<td>
						<?php if($class['Owner']['id'] == $_SESSION['User']['id'] && $_SESSION['User']['id'] != $u['id']){ ?>
							<a href="#modalDeleteMember" onclick="$('#deleteMemberLink').click(function(){ delete_class_member(<?php echo $class['ClassSet']['id'].",".$u['id']; ?>);$('#deleteMemberLink').unbind(); });return false;" id="deleteMemberLink"><img src="/images/icon-x.png" /></a>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<br /><br /><br /><br />
		<div class="clear"></div>
		<div style="width: 80px; margin: 0 auto; ">
			<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
		</div>
	</div>
</div>

<script type="text/javascript"> 
$('#createProfessorLink,#deleteMemberLink').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>