<div id="acceptDeclineGroup" class="groupMemberModal">
	<div class="box-heading">
		<h2 class="label-text alignleft">Accept/Decline <?php echo $group['Class']['group_name']; ?></h2> &nbsp;&nbsp;
		<div class="clear"></div>
	</div>
	
	<table class="simpletable groupmemberlist">
		<thead>
			<tr>
				<th width="150"><a href="#">First Name</a></th>
				<th width="150"><a href="#">Last Name</a></th>
				<th width="180"><a href="#">Email</a></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($group['User'] as $k=>$u){ ?>
			<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?>>
				<td><?php echo $u['firstname']; ?></td>
				<td><?php echo $u['lastname']; ?></td>
				<td><?php echo $u['email']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<div class="viewGroupMembersButtons">
		<a href="#" onclick="process_selected_requests(<?php echo $group['Class']['id']; ?>,'a');jQuery.fancybox.close();return false;" class="btn1 btnSimple aligncenter"><span class="inner">Accept</span></a>
		<a href="#" onclick="process_selected_requests(<?php echo $group['Class']['id']; ?>,'d');jQuery.fancybox.close();return false;" class="btn2 btnSimple aligncenter"><span class="inner">Decline</span></a>
	</div>
</div>