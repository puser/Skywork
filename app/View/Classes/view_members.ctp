<div id="viewGroupMembers">
	<div class="box-heading">
		<form id="updateGroupName" method="POST" action="/groups/update/">
			<input type="hidden" name="group[Group][id]" value="<?php echo $group['Class']['id']; ?>" />
			<h2 class="label-text alignleft"><input type="text" name="group[Group][group_name]" value="<?php echo $group['Class']['group_name']; ?>" /> Members</h2> &nbsp;&nbsp;
		</form>
		<!--<select class="alignleft">
			<option value="a">A</option>
			<option value="b">B</option>
		</select>-->
		
		<?php if($_SESSION['User']['id'] == $group['Owner']['id']){ ?><a href="#addNewUserModal" id="inviteNewUserLink" class="add-link alignright show-overlay">Add a new user</a><?php } ?>
		<div class="clear"></div>
	</div>

	<table class="simpletable groupmemberlist">
		<thead>
			<tr>
				<th width="120"><a href="#">First Name</a></th>
				<th width="120"><a href="#">Last Name</a></th>
				<th width="150"><a href="#">Email</a></th>
				<th width="80"><a href="#">City</a></th>
				<th width="20"><a href="#">State</a></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($group['User'] as $k=>$u){ ?>
			<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="groupMemberRow<?php echo $u['id']; ?>">
				<td><?php echo $u['firstname']; ?></td>
				<td><?php echo $u['lastname']; ?></td>
				<td><?php echo $u['email']; ?></td>
				<td><?php echo $u['city']; ?></td>
				<td><?php echo $u['state']; ?></td>
				<td>
					<?php if($group['Owner']['id'] == $_SESSION['User']['id'] && $_SESSION['User']['id'] != $u['id']){ ?>
						<a href="#modalDeleteMember" onclick="$('#deleteMemberLink').click(function(){ delete_group_member(<?php echo $group['Class']['id'].",".$u['id']; ?>);$('#deleteMemberLink').unbind(); });return false;" id="deleteMemberLink"><img src="/images/icon-x.png" /></a>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="viewGroupMembersButtons">
		<a href="#"  onclick="$('#updateGroupName').submit();" class="btn1 btnSimple aligncenter"><span class="inner">Save</span></a>
	</div>
</div><!-- #viewGroupMembers -->
<script type="text/javascript"> 
$('#inviteNewUserLink,#deleteMemberLink').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>