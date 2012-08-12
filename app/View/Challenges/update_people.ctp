<div id="startbridge-sendtoclass" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-envelope"></span>
		<h2><?php echo __('Send to Class') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<ul class="fieldset">
			<li>
				<p class="label"><?php echo __('Select Class(es) you would like to invite:') ?></p>
				
				<?php
				$ex_groups = array();
				if($challenge['ClassSet']){ ?>
				<table class="table-type-1" style="width: 500px; margin-bottom: 10px; ">
					<thead>
						<tr>
							<th width="90%"><?php echo __('Class Name') ?></th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$group_set = $challenge['ClassSet'] ? $challenge['ClassSet'] : $template['ClassSet'];
						foreach($group_set as $k=>$g){
							$ex_groups[] = $g['id'];
							?>
						<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="challengeGroup<?php echo $g['id']; ?>">
							<td<?php if($challenge['Group']){ ?> style="background:url('/images/icons/icon-flash-13x19.png') right no-repeat;"<?php } ?>>
								<?php echo $g['group_name']; ?>
								<input type="hidden" name="challenge[ClassSet][]" value="<?php echo $g['id']; ?>" />
							</td>
							<td>
								<div class="remove-class">
									<a href="#" class="remove-class-icon"></a>
									<a href="#" onclick="remove_challenge_group(<?php echo $g['id']; ?>,<?php echo $challenge['Challenge']['id']; ?>);return false;" class="remove-class-link icon-close rounded2"><?php echo __('Remove') ?></a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table><br />
				<?php } ?>
				
				<select style="width:150px;" name="challenge[ClassSet][]" onchange="save_challenge('update_people');">
					<option value=""> -- </option>
					<?php
					foreach($groups as $group){
						if(in_array($group['ClassSet']['id'],$ex_groups)) continue;
						?>
					<option value="<?php echo $group['ClassSet']['id']; ?>"><?php echo $group['ClassSet']['group_name']; ?></option>
					<?php } ?>
				</select>
				
				<?php if($challenge['ClassSet']){ ?>
					<br /><br /><a href="/challenges/split_groups/<?php echo $challenge['Challenge']['id']; ?>" class="btn4 show-overlay" style="width: 130px;">
						<span><img src="/images/icons/icon-flash-13x19.png" /> <?php echo __('Class Groups') ?></span>
					</a><br />
				<?php } ?>
			</li>
		</ul>
		<br /><br />
		<p><?php echo __('Invite a Collaborator:') ?></p>
		<?php if(@$queued_users){ ?>
			<table class="table-type-1">
				<thead>
					<tr>
						<th width="20%"><?php echo __('First Name') ?></th>
						<th width="20%"><?php echo __('Last Name') ?></th>
						<th width="30%"><?php echo __('Email') ?></th>
						<th width="20%"><?php echo __('Already in Puentes?') ?></th>
						<th> </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($queued_users as $k=>$qu){ ?>
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onmouseover="$('#userQueueDelete<?php echo $qu['User']['id']; ?>').show();" onmouseout="$('#userQueueDelete<?php echo $qu['User']['id']; ?>').hide();">
						<td><?php echo $qu['User']['firstname']; ?></td>
						<td><?php echo $qu['User']['lastname']; ?></td>
						<td><?php echo $qu['User']['email']; ?></td>
						<td><?php echo ($qu['User']['invite_token'] ? __('Send Invite') : __('Existing User')); ?></td>
						<td style="position:relative;">
							<div class="remove-class">
								<a href="#" class="remove-class-icon"></a>
								<a href="#" onclick="delete_queued_invite(<?php echo $qu['User']['id']; ?>,<?php echo $challenge['Challenge']['id']; ?>);" class="remove-class-link icon-close rounded2"><?php echo __('Remove') ?></a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
		
		<a href="/users/invite_collaborator/<?php echo $challenge['Challenge']['id']; ?>"<?php if(!$challenge['ClassSet']){ ?> onclick="alert('<?php echo __('Please add at least one group to this bridge to continue') ?>');return false;" class="icon-add"<?php }else{ ?> class="add-link show-overlay"<?php } ?> id="inviteNewUserLink"><?php echo __('Add an individual') ?></a>
					
	</div>
</div>

<span id="fieldValidate" style="display:none;">
	<p class="textAlignCenter red">* <?php echo __('You must invite at least one group/individual') ?></p>
</span>

<a <?php if($challenge['ClassSet']){ ?>style="display:none;"<?php } ?> onclick="$('#fieldValidate').show();return false;" class="btn1 btn-savecontinue aligncenter" id="create-challenge-validate"><span class="inner"><?php echo __('Save and Finish') ?></span></a>
<a onclick="save_challenge_final();" <?php if(!$challenge['ClassSet']){ ?>style="display:none;"<?php } ?> class="btn1 btn-savecontinue aligncenter" id="create-challenge-now"><span class="inner"><?php echo __('Save and Finish') ?></span></a>


<script type="text/javascript">
$(".show-overlay").fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>