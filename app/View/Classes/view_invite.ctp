<div id="acceptDeclineGroup" class="groupMemberModal">
	<div class="box-heading">
		<h2 class="label-text alignleft">Accept/Decline <?php echo $class['ClassSet']['group_name']; ?></h2> &nbsp;&nbsp;
		<div class="clear"></div>
	</div>
	
	<?php if($class['User']){ ?>
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
				<?php foreach($class['User'] as $k=>$u){ ?>
				<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?>>
					<td><?php echo $u['firstname']; ?></td>
					<td><?php echo $u['lastname']; ?></td>
					<td><?php echo $u['email']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php }else{ ?><br /><br /><?php } ?>
	
	<div class="viewGroupMembersButtons" style="text-align:center;">
		<a href="#" onclick="process_selected_requests(<?php echo $class['ClassSet']['id']; ?>,'a');jQuery.fancybox.close();return false;" class="btn1 btnSimple aligncenter" style="width:150px;display:inline-block;"><span class="inner">Accept</span></a>
		<a href="#" onclick="process_selected_requests(<?php echo $class['ClassSet']['id']; ?>,'d');jQuery.fancybox.close();return false;" class="btn2 btnSimple aligncenter" style="width:150px;display:inline-block;"><span class="inner">Decline</span></a>
	</div>
</div>