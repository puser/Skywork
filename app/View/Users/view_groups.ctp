<div id="leftcol" class="alignleft">
	<h1 class="page-title">My Account</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="myaccount"><a href="/users/view/">My Account</a></li>
			<?php if($_SESSION['User']['user_type']=='L'){ ?><li class="template "><a href="/challenges/update/0/template_basics/">Template</a></li><?php } ?>
			<li class="people2 active"><a href="#">Group(s)</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">


	<div id="myaccountGroupsForm" class="form-fields-wrap form-fields-disabled round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-people2"></span>
						<h2 class="page-subtitle">My Group(s)</h2>

						<div class="groupsAddLinks alignright">
							<?php if($_SESSION['User']['user_type']=='L'){ ?>
								<a href="#" class="add-link add-link-creategroup alignleft" onclick="create_group();return false;">Create a group</a> 
							<?php } ?>
							<a href="#joinAGroup" class="add-link alignleft show-overlay">Join a group</a> 
						</div>
						<div class="clear"></div>
					</div>
					<form action="/groups/update/" method="post" id="newGroupForm">
						<input type="hidden" name="group[Group][owner_id]" value="<?php echo $user['User']['id']; ?>" />
						<input type="hidden" name="group[User][][user_id]" value="<?php echo $user['User']['id']; ?>" />
						<table class="simpletable">
							<thead>

								<tr>
									<th width="180px">
										<a href="/users/view/groups/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">
											Group Name <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" />
										</a>
									</th>
									<th width="180px">
										<a href="/users/view/groups/?sort=created&dir=<?php echo (@$_REQUEST['sort']=='created'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">
											Date Created <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='created'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" />
										</a>
									</th>
									<th width="180px">
										<a href="/users/view/groups/?sort=modified&dir=<?php echo (@$_REQUEST['sort']=='modified'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">
											Last Edit <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='modified'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" />
										</a>
									</th>
									<th width="180px">
										<a href="/users/view/groups/?sort=owner&dir=<?php echo (@$_REQUEST['sort']=='owner'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">
											Creator <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='owner'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" />
										</a>
									</th>
								</tr>
							</thead>

							<tbody>
								<?php 
								$ex_groups = array();
								foreach($user['Group'] as $k=>$g){
									$ex_groups[$g['id']] = 1;
									?>
								<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.deleteChallenge').show();" onmouseout="$(this).find('.deleteChallenge').hide();">
									<td>
										<?php if(array_search($g['id'],$requested_groups) !== false){ ?>
										<a href="/groups/view_request/<?php echo $g['id']; ?>" class="show-overlay" id="viewGroupLink<?php echo $g['id']; ?>" onclick="$('#inviteUserGroup').val(<?php echo $g['id']; ?>);">
										<?php }else{ ?>
										<a <?php if($_SESSION['User']['id']==$g['Owner']['id']){ ?>href="/groups/view_members/<?php echo $g['id']; ?>" class="show-overlay" <?php }else echo 'href="#"'; ?> id="viewGroupLink<?php echo $g['id']; ?>" onclick="$('#inviteUserGroup').val(<?php echo $g['id']; ?>);">
										<?php } ?>
											<?php echo (array_search($g['id'],$requested_groups) !== false || array_search($g['id'],$pending_groups) !== false ? '<span class="red">*</span> ' : '') . $g['group_name']; ?>
										</a>
									</td>
									<td><?php echo date_format(date_create($g['date_created']),'m/d/Y'); ?></td>
									<td><?php echo date_format(date_create($g['date_created']),'m/d/Y'); ?></td>
									<td style="position:relative;">
										<?php
										echo "{$g['Owner']['firstname']} {$g['Owner']['lastname']}";
										if($g['Owner']['id']==$_SESSION['User']['id']){ ?>
											<div style="display:none;position:absolute;right:20px;top:9px;" class="deleteChallenge">
												<a href="#modalDeleteChoices" onclick="$('#deleteGroupLink').attr('href','/groups/delete/<?php echo $g['id']; ?>/');" class="show-overlay">
													<img src="/images/icon-x.png" style="position:absolute;">
												</a>
											</div>
										<?php } ?>
									</td>
								</tr>
								<?php }if(@$invites){
									foreach($invites as $k=>$g){
										$ex_groups[$g['Group']['id']] = 1;
										?>
										<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?>>
											<td>
												<a href="/groups/view_members/<?php echo $g['Group']['id']; ?>/view_invite" class="show-overlay">
													<?php echo '<span class="red">*</span> ' . $g['Group']['group_name']; ?>
												</a>
											</td>
											<td><?php echo date_format(date_create($g['Group']['date_created']),'m/d/Y'); ?></td>
											<td><?php echo date_format(date_create($g['Group']['date_created']),'m/d/Y'); ?></td>
											<td><?php echo "{$g['Owner']['firstname']} {$g['Owner']['lastname']}"?></td>
										</tr>
									<?php }
								} ?>
								<tr id="new_group_form" style="display:none;">
									<td><input type="text" name="group[Group][group_name]" /></td>
									<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
									<td><?php echo date_format(date_create(),'m/d/Y'); ?></td>
									<td><?php echo "{$user['User']['firstname']} {$user['User']['lastname']}"?></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #myaccountGroupsForm-->
	
	<a href="#" class="btn1 btn-savecontinue aligncenter"<?php if($saved){ ?> style="display:none;"<?php } ?> id="saveGroupsBtn" onclick="$('#newGroupForm').submit();$(this).hide();$('#savedNotify').show();return false;">
		<span class="inner">Save</span>
	</a>
	<span id="savedNotify" style="display:none;">
		<p class="textAlignCenter red">Saved!</p>
	</span>
	
</div><!-- #maincol-->

<div class="clear"></div>



<div style="display: none; ">	
	
	<div id="addNewUserModal">
		<div class="box-heading">
			<span class="icon icon-userblack"></span>
			<h2 class="page-subtitle">Add a new Member to Case Club</h2> 	
			<div class="clear"></div>
		</div>
		<ul class="fieldset2">
			<li>
				<span class="label alignleft">First Name</span>
				<input type="text" id="inviteUserFirst" class="inviteField" />
			</li>
			<li >
				<span class="label alignleft">Last Name</span>
				<input type="text" id="inviteUserLast" class="inviteField" />
			</li>
			<li >
				<span class="label alignleft">E-mail</span>
				<input type="text" id="inviteUserEmail" class="inviteField" />
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
		<input type="hidden" id="inviteUserGroup" value="" />
		<div class="modalActionButtons">
			<a href="#" onclick="group_invite_user();jQuery.fancybox.close();return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Add</span></a>
			<a href="#" onclick="show_group_delayed();jQuery.fancybox.close();return false;" class="btn2 modalActionButton aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #addNewUserModal -->
	
	
	<div id="joinAGroup">

		<div class="box-heading">
			<span class="icon icon-people2"></span>
			<h2 class="page-subtitle alignleft"><span class="green">Join a Group</span></h2> 
			<!--<select class="alignleft">
				<option value="a">A</option>
				<option value="b">B</option>
			</select>-->
			<div class="clear"></div>

		</div>
		<div style="height:210px;overflow-x:hidden;overflow-y:scroll;">
			<table class="simpletable">
				<thead>
					<tr>
						<th width="140" ><a href="#">Group Name</a></th>
						<th width="140" class="textAlignCenter"><a href="#">Leader First Name</a></th>
						<th width="140" class="textAlignCenter"><a href="#">Last Name</a></th>
						<th width="140" class="textAlignCenter"><a href="#"># of Members</a></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($groups as $k=>$g){
						if(@$ex_groups[$g['id']]) continue; ?>
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onclick="select_listed_group(<?php echo $g['Group']['id']; ?>,$(this));">
						<td><?php echo $g['Group']['group_name']; ?></td>
						<td class="textAlignCenter"><?php echo $g['Owner']['firstname']; ?></td>
						<td class="textAlignCenter"><?php echo $g['Owner']['lastname']; ?></td>
						<td class="textAlignCenter"><?php echo count($g['User']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			
		<div class="modalActionButtons">
			<a href="#" onclick="add_selected_groups();jQuery.fancybox.close();return false;" class="btn1 btn-savecontinue modalActionButton modalActionButtonSave aligncenter"><span class="inner">Request to Join</span></a>
			<a href="#" onclick="$('.addSelectedGroupInput').remove();jQuery.fancybox.close();return false;" class="btn2 modalActionButton aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #joinAGroup -->
	
	<div id="modalDeleteChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text">Delete</h2>
		</div>

		<br />
		<p class="caseclubFont18 blue textAlignCenter" style="width:490px;">Are you sure you want to delete?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" id="deleteGroupLink" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Delete</span></a>
			<a href="#" onclick="jQuery.fancybox.close();return false;" class="btn2 btn-savecontinue aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #modalExitChoices -->
	
	<div id="modalDeleteMember">
		<div class="box-heading">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text">Delete</h2>
		</div>

		<br />
		<p class="caseclubFont18 blue textAlignCenter" style="width:490px;">Are you sure you want to delete?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" id="deleteMemberLink" class="btn1 btn-savecontinue aligncenter" onclick="jQuery.fancybox.close();"><span class="inner">Yes, Delete</span></a>
			<a href="#" onclick="$('#deleteMemberLink').unbind();jQuery.fancybox.close();return false;" class="btn2 btn-savecontinue aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #modalExitChoices -->

</div>

<?php if(@$saved){ ?>
<script type="text/javascript">
$('#savedNotify').show();
$('#saveGroupsBtn').hide();
setTimeout('showSaveBtn()',2000);

function showSaveBtn(){
	$('#savedNotify').hide();
	$('#saveGroupsBtn').css('display','block');
}
</script>
<?php } ?>