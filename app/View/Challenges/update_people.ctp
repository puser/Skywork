<div id="startbridge-sendtoclass" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-envelope"></span>
		<h2><?php echo __('Send to Class') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<?php if(@$groups){ ?>
			<ul class="fieldset">
				<li>
					<p class="label"><?php echo __('Select Class(es) you would like to invite:') ?></p>
				
					<?php
					$class_user_count = 0;
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
								if($g['id'] == @$_REQUEST['lastClassAdded']){
									unset($group_set[$k]);
									$group_set[] = $g;
								}
							}
							$k = 0;
							foreach($group_set as $g){
								$ex_groups[] = $g['id'];
								$class_user_count += count($g['User']);							
								$instructor = 0;
								foreach($g['User'] as $c):
									if($c['user_type'] == 'L'):
										$instructor++;								
									endif;
								endforeach;
								$class_user_count = $class_user_count - $instructor;							
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
							<?php $k++; } ?>
						</tbody>
					</table><br />
				
						<?php if(count($groups) - count($ex_groups) > 0){ ?>
						<div style="font-size:12px;padding-bottom:5px;">
							<span style="color:#597aa8;"><?php echo __('Create a Bridge?') ?></span> <?php echo __('(Add multiple classes into the same assignment)') ?>
						</div>
				
					<?php }} ?>
				
					<input type="hidden" name="lastClassAdded" id="lastClassAdded" value="" />
					<select style="width:150px;" name="challenge[ClassSet][]" onchange="$('#lastClassAdded').val($(this).val());save_challenge('update_people');">
						<option value=""> -- </option>
						<?php
						foreach($groups as $group){
							if(in_array($group['ClassSet']['id'],$ex_groups)) continue;
							?>
						<option value="<?php echo $group['ClassSet']['id']; ?>"><?php echo $group['ClassSet']['group_name'].($group['ClassSet']['owner_id'] != $_SESSION['User']['id'] ? ' ('.$group['Owner']['firstname'].' '.$group['Owner']['lastname'].')' : ''); ?></option>
						<?php } ?>
					</select>
				
					<?php if($challenge['ClassSet'] && @$challenge['Challenge']['collaboration_type'] != 'NONE'){ ?>
						<br /><br /><a href="/challenges/split_groups/<?php echo $challenge['Challenge']['id']; ?>" class="btn4 show-overlay" style="width: 130px;">
							<span><img src="/images/icons/icon-flash-13x19.png" /> <?php echo __('Class Groups') ?></span>
						</a><br />
					<?php } ?>
				</li>
			</ul>
			<br /><br />

	<!--		<p><?php echo __('Invite a Collaborator:') ?></p> -->

			<?php if(@$queued_users){ ?>
				<table class="table-type-1">
					<thead>
						<tr>
							<th width="20%"><?php echo __('First Name') ?></th>
							<th width="20%"><?php echo __('Last Name') ?></th>
							<th width="30%"><?php echo __('Email') ?></th>
							<th width="20%"><?php echo __('Already in Skywork?') ?></th>
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
			<?php }
		}else{ ?>
			<div style="padding-left:56px;background:url('/images/icon-confirm.png') top left no-repeat;color:#00467E;font-size:18px;line-height:25px;">
				<?php echo __('This is where you would send the assignment to your students. However, you have not created any classes yet. Select the button below to create your first class. Creating your first class will only take a couple of minutes.') ?>
			</div>
		<?php } ?>
	</div>
</div>

<?php if(@$groups){ ?>
	<span id="fieldValidate" style="display:none;">
		<p class="textAlignCenter red" style="margin-left:265px; color:red">* <?php echo __('You must invite at least one group/individual') ?></p>
	</span>

	<?php if(!@$challenge['Group'] && @$challenge['ClassSet'] && @$challenge['Challenge']['collaboration_type'] != 'NONE'){ ?>
		<a href="#modalGroupWarning" class="btn2 btn-savecontinue aligncenter show-overlay"><span class="inner"><?php echo __('Save and Finish') ?></span></a>
	<?php }else{ ?>
		<a <?php if($challenge['ClassSet']){ ?>style="display:none;"<?php } ?> onclick="$('#fieldValidate').show();return false;" class="btn2 btn-savecontinue aligncenter" id="create-challenge-validate"><span class="inner"><?php echo __('Save and Finish') ?></span></a>
		
		<a href="#modalProgress" onclick="save_challenge_final(cid);progressIndicator();" <?php if(!$challenge['ClassSet']){ ?>style="display:none;"<?php } ?> class="btn2 btn-savecontinue aligncenter show-overlay" id="create-challenge-now"><span class="inner"><?php echo __('Save and Finish') ?></span></a>
	<?php }
}else{ ?>
	<a href="/users/view/classes/?create=1" style="width:195px;" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Create my first class now') ?></span></a>
<?php } ?>

<div style="display:none;">
	<div id="modalProgress" style="width:200px;height:35px;text-align:center;font-size:16px;color:#00467F;line-height:35px;">
		Working <span id="progress1" class="progressDot" style="display:none;">.</span> <span id="progress2" class="progressDot" style="display:none;">.</span> <span id="progress3" class="progressDot" style="display:none;">.</span>
	</div>
	
	<div id="modalGroupWarning" style="width:540px;height:260px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><?php echo __('Warning!') ?></h2>
		</div>

		<div class="modal-box-content">
			<?php
			$warning_msg = __("You have not created any groups for this bridge, meaning <strong>each</strong> student will have to give feedback to <strong>every</strong> other student. There are a total of {student_count} students.\n\nWould you like to send this Bridge?");
			$warning_msg = str_replace('{student_count}',$class_user_count,$warning_msg);
			?>
			<div style="text-align:center;margin:20px;"><?php echo nl2br($warning_msg); ?></div>	
			<br />
			<div style="width: 200px; margin: 0 auto; ">
				<a href="#" id="sendmail" class="btn2" style="width: 80px; float: left;" onclick="save_challenge_final(cid);"><span><?php echo __('Send') ?></span></a>
				<a id="mailsent" class="btn2" style="width: 80px; float: left; display:none" ><span><?php echo __('Send') ?></span></a>
				<a href="#" class="btn3" style="width: 100px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Don\'t send yet') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div><!-- #modalExitChoices -->
</div>


<script type="text/javascript">
if($('#collaboration_type').val()=='NONE') $('.btn4').hide();
$(".show-overlay").fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});

function progressIndicator(){
	var currentDot = 0;
	setInterval(function(){
		if(currentDot == 3){
			currentDot = 0;
			$('.progressDot').hide();
		}else $('#progress' + ++currentDot).show();
	},500);
}
</script>