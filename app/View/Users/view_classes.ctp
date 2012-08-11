<div id="sidebarleft">
	<h1><?php echo __('My Account') ?></h1>
	<div id="sidemenu">
		<ul>
			<li><a class="icon icon-calendar" href="/users/view/"><?php echo __('My Account') ?></a></li>
			<li class="active"><a class="icon icon-class" href="#"><?php echo __('Classes') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div id="classes-box" class="box-startbridge box-white rounded">
		<div class="box-head">
			
			<div class="box-actions">
				<ul>
					<?php if($_SESSION['User']['user_type'] != 'P'){ ?>
						<li><a class="icon4 icon4-plus modal-link" href="#modal-addclass"><?php echo __('Create Class') ?></a></li>
						<li><a class="icon4 icon4-plus modal-link" href="#modal-joinsharedclass"><?php echo __('Join shared class') ?></a></li>
					<?php }else{ ?>
						<li><a class="icon4 icon4-plus modal-link" href="#modal-joinstudentclass"><?php echo __('Join class') ?></a></li>
					<?php } ?>
				</ul>
			</div>
			
			<span class="icon2 icon2-class" style="width:56px;"></span>
			<h2><?php echo __('Edit Classes') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="box-content">
			<table class="table-type-1" id="table-classes">
				<thead>
					<tr>
						<th><a href="/users/view/classes/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Class Name') ?></a></th>
						<th><a href="/users/view/classes/?sort=modified&dir=<?php echo (@$_REQUEST['sort']=='modified'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort<?php echo (@$_REQUEST['sort']=='modified'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Last Edit') ?></a></th>
						<th><a href="#" class="sortdown"><?php echo __('Students') ?></a></th>
						<th><a href="/users/view/classes/?sort=owner&dir=<?php echo (@$_REQUEST['sort']=='owner'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>" class="sort<?php echo (@$_REQUEST['sort']=='owner'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>"><?php echo __('Creator') ?></a></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$ex_groups = array();
					foreach($user['ClassSet'] as $k=>$g){
						$ex_groups[$g['ClassSet']['id']] = 1;
						?>
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.deleteChallenge').show();" onmouseout="$(this).find('.deleteChallenge').hide();">
						<td>
							<?php if(array_search($g['ClassSet']['id'],$requested_groups) !== false){ ?>
							<a href="/classes/view_request/<?php echo $g['ClassSet']['id']; ?>" class="show-overlay" id="viewGroupLink<?php echo $g['ClassSet']['id']; ?>" onclick="$('#inviteUserGroup').val(<?php echo $g['ClassSet']['id']; ?>);">
							<?php }else{ ?>
							<a <?php if($_SESSION['User']['id']==$g['Owner']['id']){ ?>href="/classes/view_members/<?php echo $g['ClassSet']['id']; ?>" class="show-overlay" <?php }else echo 'href="#"'; ?> id="viewGroupLink<?php echo $g['ClassSet']['id']; ?>" onclick="$('#inviteUserGroup').val(<?php echo $g['ClassSet']['id']; ?>);">
							<?php } ?>
								<?php echo (array_search($g['ClassSet']['id'],$requested_groups) !== false || array_search($g['ClassSet']['id'],$pending_groups) !== false ? '<span class="red">*</span> ' : '') . $g['ClassSet']['group_name']; ?>
							</a>
						</td>
						<td><?php echo date_format(date_create($g['ClassSet']['date_created']),'m/d/Y'); ?></td>
						<td><?php echo count($g['User']); ?></td>
						<td><?php echo "{$g['Owner']['firstname']} {$g['Owner']['lastname']}"; ?></td>
						<td>
							<?php if($g['Owner']['id']==$_SESSION['User']['id']){ ?>
							<div class="item-actions">
								<a href="#" class="item-actions-icon"></a>
								<div class="item-actions-popup rounded2">
									<ul>
										<li><a href="/classes/view_members/<?php echo $g['ClassSet']['id']; ?>/view_sharing" class="icon3 icon3-plus modal-link"><?php echo __('Share Class') ?></a></li>
										<li><a href="#modal-viewtoken" onclick="view_token(<?php echo $g['ClassSet']['id']; ?>,'<?php echo $g['ClassSet']['group_name']; ?>','<?php echo ($g['ClassSet']['auth_token'] ? $g['ClassSet']['auth_token'] : '[ no token set ]'); ?>');" class="icon3 icon3-token modal-link"><?php echo __('View Token') ?></a></li>
										<li><a href="/classes/update/<?php echo $g['ClassSet']['id']; ?>" class="icon3 icon3-pen modal-link"><?php echo __('Edit Class') ?></a></li>
										<li><a href="/classes/view_members/<?php echo $g['ClassSet']['id']; ?>" class="icon3 icon3-sm_green modal-link"><?php echo __('Edit Students') ?></a></li>
										<li><a href="#modalDeleteChoices" onclick="$('#deleteGroupLink').attr('href','/classes/delete/<?php echo $g['ClassSet']['id']; ?>/');" class="icon3 icon3-close modal-link"><?php echo __('Delete Class') ?></a></li>
									</ul>
								</div>
							</div>
							<?php } ?>
						</td>
					</tr>
					<?php }if(@$invites){
						foreach($invites as $k=>$g){
							$ex_groups[$g['ClassSet']['id']] = 1;
							?>
							<tr<?php if(!(($k+count($user['ClassSet']))%2)){ ?> class="alternate"<?php } ?>>
								<td>
									<a href="/classes/view_members/<?php echo $g['ClassSet']['id']; ?>/view_invite" class="show-overlay">
										<?php echo '<span class="red">*</span> ' . $g['ClassSet']['group_name']; ?>
									</a>
								</td>
								<td><?php echo date_format(date_create($g['ClassSet']['date_created']),'m/d/Y'); ?></td>
								<td><?php echo count($g['User']); ?></td>
								<td><?php echo "{$g['Owner']['firstname']} {$g['Owner']['lastname']}"?></td>
								<td></td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #myaccountGroupsForm-->
	
	<!--<a href="#" class="btn1 btn-savecontinue aligncenter"<?php if($saved){ ?> style="display:none;"<?php } ?> id="saveGroupsBtn" onclick="$('#newGroupForm').submit();$(this).hide();$('#savedNotify').show();return false;">
		<span class="inner"><?php echo __('Save') ?></span>
	</a>-->
	<span id="savedNotify" style="display:none;">
		<p style="display:block;text-align:center;color:#ff0000;"><?php echo __('Saved!') ?></p>
	</span>
	
</div><!-- #maincol-->

<div class="clear"></div>




<script type="text/javascript">
			
	jQuery(document).ready(function($) {
		$(".modal-link").fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true,
			'width' : 500
		}); 
	}); 
	
</script>

<div style="display: none;">
	
	<div id="modal-addclass">
		<a style="display:none;" href="#modal-newtoken" class="btn2 modal-link" id="showGenerateToken"> </a>
		<form id="create_class">
			<input type="hidden" name="class[ClassSet][owner_id]" value="<?php echo $user['User']['id']; ?>" />
			<input type="hidden" name="class[User][][user_id]" value="<?php echo $user['User']['id']; ?>" />
			<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
				<div class="modal-box-head">
					<span class="icon icon-plus"></span>
					<h2><?php echo __('Create Class') ?></h2>
				</div>
				<div class="modal-box-content">
					<p><?php echo __('Please enter the details below to create a new class:') ?></p>
					<ul class="fieldset2">
						<li>
							<label><?php echo __('Class Name') ?></label>
							<input type="text" size="50" id="createClassName" name="class[ClassSet][group_name]" />
							<div class="clear"></div>
						</li>
						<li class="radioinput">
							<span class="label"><?php echo __('Make this class searchable') ?></span>
							<div class="input">
								<input type="radio" name="class[ClassSet][public]" value="1" id="make_class_searchable_yes" checked="checked" /> <label for="make_class_searchable_yes"><?php echo __('Yes') ?></label>
								<input type="radio" name="class[ClassSet][public]" value="0" id="make_class_searchable_no" /> <label for="make_class_searchable_no"><?php echo __('No') ?></label>
							</div>
							<div class="clear"></div>
						</li>
					</ul>
					<div class="clear"></div>
					<p class="small"><?php echo __('Instructors will be able to search and request to join your class. For security purposes, they must know your email address and you will always be able to Accept or Reject their request.') ?></p>
					<div class="clear"></div>
					<div style="width: 250px; margin: 0 auto; ">
						<a href="#" onclick="create_class();" class="btn2" style="width: 120px; float: left;" ><span><?php echo __('Generate Token') ?></span></a>
						<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div id="modal-joinsharedclass">
		<div id="modal-joinsharedclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon icon-class-color"></span>
				<h2><?php echo __('Request to Join Shared Class(es)') ?></h2>
			</div>
			<div class="modal-box-content">
				<br />
				<p><?php echo __('Please enter the Professors\' email:') ?></p>
				<ul class="fieldset2">
					<li>
						<label><?php echo __('Email') ?></label>
						<input type="text" size="50" id="queryEmail" />
					</li>
				</ul>
				<div id="sharedSearchResults"> </div>
				<div class="clear"></div>
				<div style="width: 200px; margin: 0 auto; ">
					<a href="#" class="btn2" style="width: 80px; float: left;" onclick="load_search_results();" ><span><?php echo __('Continue') ?></span></a>
					<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="modal-joinstudentclass">
		<form id="join_token_class" action="/classes/join_with_token" method="POST">
			<div id="modal-joinstudentclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
				<div class="modal-box-head">
					<span class="icon icon-class-color"></span>
					<h2><?php echo __('Join Your Class') ?></h2>
				</div>
				<div class="modal-box-content">
					<br />
					<ul class="fieldset2">
						<li>
							<label><?php echo __('Teacher Email') ?></label>
							<input type="text" size="50" name="joinTeacherEmail" />
						</li>
						<li>
							<label><?php echo __('Class Token') ?></label>
							<input type="text" size="50" name="joinClassToken" />
						</li>
					</ul>
					<div class="clear"></div>
					<div style="width: 200px; margin: 0 auto; ">
						<a href="#" class="btn2" style="width: 80px; float: left;" onclick="$('#join_token_class').submit();" ><span><?php echo __('Join') ?></span></a>
						<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<form id="join_token_class">
	</div>
	
	<div id="modal-deleteclass">
		
		<div id="modal-deleteclass-box" class="modal-wrapper" style="width: 600px;" >
			
			<div class="modal-box-head">
				<span class="icon5 icon5-close"></span>
				<h2><span><?php echo __('Delete') ?></span></h2>
			</div>
			<div class="modal-box-content">
				<p class="modal-notice" style="margin: 50px 0; "><?php echo __('Are you sure you want to delete?') ?></p>
				<div style="width: 250px; margin: 0 auto; margin-bottom: 20px; ">
					<div style="width: 100px; float: left;">
						<a href="#" class="btn2" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Yes, Delete') ?></span></a>
					</div>
					<div style="width: 100px; float: right;">
						<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<div id="modal-viewtoken">
		
		<div id="modal-viewtoken-box" class="modal-wrapper" style="width: 600px;">
			<div class="modal-box-head">
				<div class="box-actions">
					<ul>
						<li><a class="icon4 icon4-plus modal-link" href="#modal-newtoken" ><?php echo __('Generate new') ?></a></li>
					</ul>
				</div>
				<span class="icon icon-token"></span>
				<h2 id="tokenClassName"><?php echo __('Token') ?></h2>
			</div>
			<div class="modal-box-content">
				<p class="modal-notice" style="margin: 50px auto; " id="token_value"> </p>
				<div style="width: 80px; margin: 0 auto; ">
					<a href="/users/view/classes/" class="btn3" onclick="jQuery.fancybox.close();"><span><?php echo __('Close') ?></span></a>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<div id="modal-newtoken">
		
		<div id="modal-newtoken-box" class="modal-wrapper" style="width: 600px;" >
			<a style="display:none;" href="#modal-viewtoken" class="btn2 modal-link" id="showNewToken"> </a>
			<input type="hidden" id="newTokenClassID" />
			<div class="modal-box-head">
				<span class="icon icon-token"></span>
				<h2><?php echo __('New Token') ?></h2>
			</div>
			<div class="modal-box-content">
				<p class="modal-notice" style="width: 400px; margin: 40px auto;"><?php echo __('Generating a new token will allow students to enter this class with the new token. Are you sure you want to generate a new token?') ?></p>
				<div style="width: 250px; margin: 0 auto; ">
					<div style="width: 100px; float: left; ">
						<a class="btn2" href="#" onclick="update_token();"><span><?php echo __('Generate') ?></span></a>
					</div>
					<div style="width: 100px; float: right; ">
						<a class="btn3" href="#" onclick="jQuery.fancybox.close(); return false;"><span><?php echo __('Cancel') ?></span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
	
</div>


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
					<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> onclick="select_listed_group(<?php echo $g['ClassSet']['id']; ?>,$(this));">
						<td><?php echo $g['ClassSet']['group_name']; ?></td>
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
	
	<div id="modalDeleteChoices" style="width:450px;height:180px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Delete') ?></h2>
		</div>
		
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><?php echo __('Are you sure you want to delete?') ?></div>	
			<br />
			<div style="width: 200px; margin: 0 auto; ">
				<a href="#" class="btn2" style="width: 80px; float: left;" id="deleteGroupLink"><span><?php echo __('Yes, Delete') ?></span></a>
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div><!-- #modalExitChoices -->
	
	<div id="modalDeleteMember" style="width:450px;height:180px;">
		<div class="modal-box-head">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Delete') ?></h2>
		</div>

		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><?php echo __('Are you sure you want to delete?') ?></div>
			<br />
			
			<div style="width: 200px; margin: 0 auto;" class="exitSaveOptions">
				<a href="#" class="btn2 modal-link" id="deleteMemberLink" style="width: 80px; float: left;" id="deleteGroupLink"><span><?php echo __('Yes, Delete') ?></span></a>
				<a href="#" class="btn3 modal-link" style="width: 80px; float: right;" onclick="$('#deleteMemberLink').unbind();return false;"><span><?php echo __('Cancel') ?></span></a>
				<div class="clear"></div>
			</div>
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