<div id="acceptDeclineGroup" class="groupMemberModal">
	<div class="box-heading">
		<h2 class="label-text alignleft"><?php echo __('Accept/Decline') ?> <?php echo $class['ClassSet']['group_name']; ?></h2> &nbsp;&nbsp;
		<div class="clear"></div>
	</div>
	
	<?php if($class['Owner']){ ?>
		<table class="simpletable groupmemberlist">
			<thead>
				<tr>
					<th width="150"><a href="#"><?php echo __('First Name') ?></a></th>
					<th width="150"><a href="#"><?php echo __('Last Name') ?></a></th>
					<th width="180"><a href="#"><?php echo __('Email') ?></a></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr class="alternate">
					<td><?php echo $class['Owner']['firstname']; ?></td>
					<td><?php echo $class['Owner']['lastname']; ?></td>
					<td><?php echo $class['Owner']['email']; ?></td>
				</tr>
			</tbody>
		</table>
	<?php }else{ ?><br /><br /><?php } ?>
	
	<div class="viewGroupMembersButtons" style="text-align:center;">
		<a href="#" onclick="process_selected_requests(<?php echo $class['ClassSet']['id']; ?>,'a');jQuery.fancybox.close();return false;" class="btn1 btnSimple aligncenter" style="width:150px;display:inline-block;"><span class="inner"><?php echo __('Accept') ?></span></a>
		<a href="#" onclick="process_selected_requests(<?php echo $class['ClassSet']['id']; ?>,'d');jQuery.fancybox.close();return false;" class="btn2 btnSimple aligncenter" style="width:150px;display:inline-block;"><span class="inner"><?php echo __('Decline') ?></span></a>
	</div>
</div>