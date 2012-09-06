<div id="viewRequestsGroup" class="groupMemberModal" style="width:460px;height:190px;">
	<div class="modal-box-head">
		<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><?php echo __('Accept/Decline Request for') ?> <?php echo $status[0]['Class']['group_name']; ?></h2>
	</div>
	
	<div class="modal-box-content">
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
		
		<br /><br />
		<div style="width: 215px; margin: 0 auto; ">
			<a href="#" class="btn2" style="width: 110px; float: left;" onclick="process_selected_requests(<?php echo $status[0]['Class']['id']; ?>,'a');jQuery.fancybox.close();return false;"><span><?php echo __('Allow to Join') ?></span></a>
			<a href="#" class="btn3" style="width: 80px; float: right;" onclick="process_selected_requests(<?php echo $status[0]['Class']['id']; ?>,'d');jQuery.fancybox.close();return false;"><span><?php echo __('Decline') ?></span></a>
			<div class="clear"></div>
		</div>
	</div>

</div>