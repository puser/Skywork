<div id="viewRequestsGroup" class="groupMemberModal">
	<div class="box-heading">
		<h2 class="label-text alignleft"><?php echo __('Accept/Decline Request for') ?> <?php echo $status[0]['Class']['group_name']; ?></h2> &nbsp;&nbsp;
		<div class="clear"></div>
	</div>
	
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
			<?php foreach($status as $k=>$s){ ?>
			<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onclick="select_listed_user(<?php echo $s['User']['id']; ?>,$(this));">
				<td><?php echo $s['User']['firstname']; ?></td>
				<td><?php echo $s['User']['lastname']; ?></td>
				<td><?php echo $s['User']['email']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<div class="viewGroupMembersButtons">
		<a href="#" onclick="process_selected_requests(<?php echo $status[0]['Class']['id']; ?>,'a');jQuery.fancybox.close();return false;" class="btn1 btnSimple aligncenter"><span style="width:80px;" class="inner"><?php echo __('Allow to Join') ?></span></a>
		<a href="#" onclick="process_selected_requests(<?php echo $status[0]['Class']['id']; ?>,'d');jQuery.fancybox.close();return false;" class="btn2 btnSimple aligncenter"><span class="inner"><?php echo __('Decline') ?></span></a>
	</div>
</div>