<div id="startbridge-sendtoclass" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-envelope"></span>
		<h2>Send to Class</h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<ul class="fieldset">
			<li>
				<p class="label">Select Class(es) you would like to invite:</p>
				<select style="width: 150px;">
					<option value="" >Class 1</option>
					<option value="" >Class 2</option>
				</select>
				<a href="startbridge-sendtoclass-2.html" class="add-class">Add &gt;</a>
			</li>
			<li>
				<a href="#" class="icon-add">Add another</a>
			</li>
		</ul>
		<br /><br />
		<p>Invite an individual:</p>
		<table class="table-type-1">
			<thead>
				<tr>
					<th width="20%">First Name</th>
					<th  width="20%">Last Name</th>
					<th width="30%">Email</th>
					<th width="20%">Already in Case Club?</th>
					<th  width="10%">Class</th>
				</tr>
			</thead>
			<tbody>
				<tr class="alternate">
					<td>John</td>
					<td>Smith</td>
					<td>johnsmith@gmail.com</td>
					<td>Send Invite</td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<a href="#" class="icon-add">Add another</a>
					
		
	</div>
	
</div>





<div id="leftcol" class="alignleft">
	<h1 class="page-title">Create Challenge</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="contracttemplate"><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update/">Basics</a></li>
			<li class="pen2"><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_questions/">Questions</a></li>
			<li class="people2 active"><a>People</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">

	<div class="caseclub-links-wrap">
		<div class="alignright caseclub-links">
			<a href="#" onclick="save_challenge('ajax');return false;" class="caseclub-save">Save</a>
			<a href="#modalExitChoices" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>

	<div id="createChallengePeopleForm" class="form-fields-wrap round round-white">

		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-people2"></span>
						<h2 class="page-subtitle">People</h2>
					</div>

					<form id="challengeData" action="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/dashboard/" method="post">
						<input type="hidden" name="challenge[Challenge][id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
						<input type="hidden" name="challenge[Challenge][status]" value="D" id="challengeStatus" />
						<ul class="fieldset2">
							<li>
								<p class="label"><!-- <span class="red">*</span> -->Invite a group to challenge</p>

								<?php if($challenge['Class'] || @$template['Class']){ ?>
									<table class="simpletable">
										<thead>
											<tr>
												<th width="400"><a href="#">Group Name</a></th>
												<th width="100"> </th>
											</tr>
										</thead>
										<tbody>
											<?php
											$ex_groups = array();
											$group_set = $challenge['Class'] ? $challenge['Class'] : $template['Class'];
											foreach($group_set as $k=>$g){
												$ex_groups[] = $g['id'];
												?>
											<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="challengeGroup<?php echo $g['id']; ?>">
												<td>
													<?php echo $g['group_name']; ?>
													<input type="hidden" name="challenge[Group][]" value="<?php echo $g['id']; ?>" />
												</td>
												<td><a href="#" onclick="remove_challenge_group(<?php echo $g['id']; ?>);return false;">Remove Group</a></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
								<br />
								<select name="challenge[Group][]" onchange="challenge_select_group($(this).val(),$(this).children('[selected]').html());">
									<option value=""> -- </option>
									<?php
									foreach($groups as $group){
										if(in_array($group['Class']['id'],$ex_groups)) continue;
										?>
									<option value="<?php echo $group['Class']['id']; ?>"><?php echo $group['Class']['group_name']; ?></option>
									<?php } ?>
								</select>
							</li>
						</ul>
						<a href="#" class="add-link" onclick="$('#challengeData').attr('action','/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_people/').submit();return false;">Add another group</a>
						<br />
						
						<ul class="fieldset2">
							<li style="padding-bottom:0;">
								<p class="label-text" style="margin-bottom:0px;"> <!-- <span class="red">*</span> -->Invite an individual</p>
								<?php if(@$queued_users){ ?>
								<table class="simpletable">
									<thead>
										<tr>
											<th width="100"><a href="#">First Name</a></th>
											<th width="100"><a href="#">Last Name</a></th>

											<th width="250"><a href="#">Email</a></th>
											<th width="180"><a href="#">Already in Case Club?</a></th>
											<th width="100"><a href="#">Group</a></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($queued_users as $k=>$qu){ ?>
										<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onmouseover="$('#userQueueDelete<?php echo $qu['User']['id']; ?>').show();" onmouseout="$('#userQueueDelete<?php echo $qu['User']['id']; ?>').hide();">
											<td><?php echo $qu['User']['firstname']; ?></td>
											<td><?php echo $qu['User']['lastname']; ?></td>
											<td><?php echo $qu['User']['email']; ?></td>
											<td><?php echo ($qu['User']['invite_token'] ? 'Send Invite' : 'Existing User'); ?></td>
											<td style="position:relative;">
												<?php echo @$qu['Class']['group_name']; ?>
												<a href="/challenges/remove_queued_invite/<?php echo $qu['User']['id']; ?>/<?php echo $challenge['Challenge']['id']; ?>/" style="position:absolute;right:20px;top:8px;display:none;" id="userQueueDelete<?php echo $qu['User']['id']; ?>">
													<img src="/images/icon-x.png" style="position:absolute;">
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php } ?>
							</li>
						</ul>
						<br />
						<a href="#addNewUserModal"<?php if(!$challenge['Class']){ ?> onclick="alert('Please add at least one group to this challenge to continue');return false;"  class="add-link"<?php }else{ ?> class="add-link show-overlay"<?php } ?> id="inviteNewUserLink">Add an individual</a>
						<br /><br />
						<ul class="fieldset2"><li><p class="label-text"> Other</p></li></ul>
						<input type="checkbox" name="challenge[Challenge][challenge_type]" value="A"<?php if($challenge['Challenge']['challenge_type']=='A') echo ' checked="checked"'; ?> /> Make all answers &amp; responses anonymous
					</form>

				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #createChallengePeopleForm-->

	<span id="fieldValidate" style="display:none;">
		<p class="textAlignCenter red">* You must invite at least one group/individual</p>
	</span>
	<br /><br />
	<a href="#" <?php if($challenge['Class'] || @$template['Class']){ ?>style="display:none;"<?php } ?> onclick="$('#fieldValidate').show();return false;" class="btn1 btn-savecontinue aligncenter" id="create-challenge-validate"><span class="inner">Save and Finish</span></a>
	<a href="#saveAndFinish" <?php if(!$challenge['Class'] && !@$template['Class']){ ?>style="display:none;"<?php } ?> class="btn1 btn-savecontinue aligncenter" id="create-challenge-now"><span class="inner">Save and Finish</span></a>
	
	
</div><!-- #maincol-->
<div class="clear"></div>


<div style="display: none;">
	<div id="modalExitChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text">Exit</h2>
		</div>

		<br />
		<p class="caseclubFont18 blue textAlignCenter">Would you like to save before returning to Home?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" onclick="$('#challengeData').submit();return false;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>
			<a href="/dashboard/" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>

		</div>
	</div><!-- #modalExitChoices -->

	<div id="addNewUserModal" style="height:345px;">
		<div class="box-heading">

			<span class="icon icon-userblack"></span>
			<h2 class="page-subtitle">Add a new User to Challenge</h2> 
			
			<div class="clear"></div>
		</div>
		<ul class="fieldset2">
			<li>
				<span class="label alignleft">First Name</span>
				<input type="text" id="inviteFName" />

			</li>
			<li >
				<span class="label alignleft">Last Name</span>
				<input type="text" id="inviteLName" />
			</li>
			<li >
				<span class="label alignleft">E-mail</span>
				<input type="text" id="inviteEmail" />
			</li>
			<li >
				<span class="label alignleft">Group</span>
				<select id="inviteGroup">
					<?php foreach($challenge['Class'] as $k=>$g){ ?>
					<option value="<?php echo $g['id']; ?>"><?php echo $g['group_name']; ?></option>
					<?php } ?>
				</select>
			</li>
			<li>
				<br />
				<div style="float:left;width:370px;">
					<span class="label">What kind of user is this new member?</span><br />
					<span class="label subtext" style="color:#666;font-size:13px;">Checking leader gives ability to create groups.</span>
				</div>
				<div style="float:left;width:165px;font-size:13px;">
					<input type="radio" style="width:20px;" name="inviteUserType" id="inviteUserU" value="P" checked="checked" /> User
					<input type="radio" style="width:20px;margin-left:25px;" name="inviteUserType" id="inviteUserL" value="L" /> Leader
				</div>
			</li>
		</ul>
		<div class="modalActionButtons">
			<a href="#" onclick="challenge_invite_user(<?php echo $challenge['Challenge']['id']; ?>);return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Add</span></a>
			<a href="#" onclick="jQuery.fancybox.close();return false;" class="btn2 modalActionButton aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #addNewUserModal -->
	
	<div id="saveAndFinish">
		<div class="box-heading">
			<h2 class="label-text">Save and Finish</h2>

		</div>
		<br /><br />
		<p class="caseclubFont18 blue textAlignCenter">Save, Finish and Return to Home?</p>
		<br /><br /><br />
		<div class="modalActionButtons">
			<a href="#congratulations-html" onclick="save_challenge_final();" class="show-overlay btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Yes</span></a>
			<a href="#"  onclick="jQuery.fancybox.close(); return false; " class="btn2 modalActionButton aligncenter"><span class="inner">Cancel</span></a>

		</div> 
	</div><!-- #saveAndFinish -->
	
	
	<div id="congratulations-html">
		<div class="box-heading">
			<h2 class="label-text">Done!</h2>
		</div>
		<div class="congratulations-stars textAlignCenter">
			<span class="icon icon-star"></span>
			<span class="icon icon-star"></span>

			<span class="icon icon-star"></span>
			<div class="clear"></div>
		</div>
		<br /><br /><br />
		<p class="textAlignCenter"><a href="#" class="aligncenter caseclubFont18" onclick="jQuery.fancybox.close(); return false; ">Now Sending...</a></p>
	</div>
	
</div>
</div>