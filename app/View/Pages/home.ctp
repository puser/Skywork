<style type="text/css">
#fancybox-close {
	position:absolute;display:block;width:29px;height:29px;background:url(/images/exit_lg.png) top left no-repeat;top:-15px;right:-20px;
}
.signupError {
  position: absolute;
  padding-top: 5px;
  color: #ff0000;
}
</style>

<?php if(@$_SESSION['User']['id']){ ?>
<script type="text/javascript"> window.location = '/dashboard/'; </script>
<?php }else{ ?>
<div id="body-wrap">
	<div id="homeSlider" class="form-fields-wrap round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content" style="height:180px;">
					<img src="/images/home-layer1.png" id="homeLayer1" style="display:none;position:absolute;top:0;left:60px;" />
					<img src="/images/home-layer2.png" id="homeLayer2" style="display:none;position:absolute;top:0;left:60px;" />
					<img src="/images/home-layer3.png" id="homeLayer3" style="display:none;position:absolute;top:0;left:60px;" />
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #answerQuestionsFormThemes-->
	
	<a href="#joinModal" style="text-align:center;display: block;" class="show-overlay" onclick="$('#fancybox-close').show();" id="joinBtn">
		<span style="margin-top:35px;width:235px;height:56px;background:url(/images/join-btn.png) no-repeat;display:inline-block;"></span>
	</a>
</div>

<?php if(@$user){ ?>
<style type="text/css">
#fancybox-content div { overflow:hidden !important; }
</style>
<a href="#addNewUserModal" visible="false" id="inviteTrigger" class="add-link show-overlay"></a>
<a href="#resetPasswordModal" visible="false" id="resetTrigger" class="add-link show-overlay"></a>
<?php } ?>
<div style="display:none;">
	
	<div id="joinModal" style="height:345px;overflow:hidden">
		<div class="box-heading joinTabs">

			<div class="caseclub-tabs">
				<ul >
					<li class="caseclub-tab tab-instructor<?php if(!@$_REQUEST['signup_error'] || @$_REQUEST['signup_type'] == 'L') echo ' active'; ?>">
						<a href="#" onclick="join_show_instructor();return false;"><?php echo __('I\'m an Instructor') ?></a>
					</li>
					<li class="caseclub-tab tab-student<?php if(@$_REQUEST['signup_type'] == 'P') echo ' active'; ?>">
						<a href="#" onclick="join_show_student();return false;"><?php echo __('I\'m a Student') ?></a>
					</li>
					<li class="caseclub-tab tab-collaborator<?php if(@$_REQUEST['signup_type'] == 'C') echo ' active'; ?>">
						<a href="#" onclick="join_show_collaborator();return false;"><?php echo __('I\'m a Collaborator') ?></a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
		</div><br />
		
		<form id="instructorJoinData" action="/users/login/" method="POST" <?php if(@$_REQUEST['signup_type'] && @$_REQUEST['signup_type'] != 'L') echo 'style="display:none;"'; ?>>
			<input type="hidden" name="user_type" value="L" />
			<ul class="fieldset2 joinForms">
				<li>
					<label><?php echo __('Beta-Test Key') ?></label>
					<input type="text" name="betakey" />
				</li>
				<li>
					<label><?php echo __('Preferred Email') ?><span class="small">(Username)</span></label>
					<input type="text" name="login" />
				</li>
				<li>
					<label style="color:#8bc53f;"><?php echo __('Choose a Password') ?></label>
					<input type="password" name="password" />
				</li>
				<li >
					<label style="color:#8bc53f;"><?php echo __('Confirm Password') ?></label>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<?php if(@$_REQUEST['signup_error'] == 'email' && @$_REQUEST['signup_type'] == 'L'){ ?>
				<div class="signupError">Email already exists in system!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'pass' && @$_REQUEST['signup_type'] == 'L'){ ?>
					<div class="signupError">Passwords do not match!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'key' && @$_REQUEST['signup_type'] == 'L'){ ?>
					<div class="signupError">The beta key you provided is invalid.</div>
			<?php } ?>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#instructorJoinData').submit();return false;" class="btn2 modalActionButton modalActionButtonSave"><span class="inner"><?php echo __('Log In') ?></span></a>
			</div>
		</form>
		
		<form id="studentJoinData" action="/users/login/" method="POST" <?php if(@$_REQUEST['signup_type'] != 'P') echo 'style="display:none;"'; ?>>
			<input type="hidden" name="user_type" value="P" />
			<ul class="fieldset2 joinForms">
				<li>
					<label><?php echo __('Class Token') ?></label>
					<input type="text" name="classtoken" />
				</li>
				<li>
					<label><?php echo __('Instructor\'s Email') ?></label>
					<input type="text" name="instructor_email" />
				</li>
				<li>
					<label><?php echo __('Preferred Email') ?><span class="small">(Username)</span></label>
					<input type="text" name="login" />
				</li>
				<li>
					<label style="color:#8bc53f;"><?php echo __('Choose a Password') ?></label>
					<input type="password" name="password" />
				</li>
				<li >
					<label style="color:#8bc53f;"><?php echo __('Confirm Password') ?></label>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<?php if(@$_REQUEST['signup_error'] == 'token'){ ?>
				<div class="signupError">Class token/Instructor Email combination not recognized!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'email' && @$_REQUEST['signup_type'] == 'P'){ ?>
				<div class="signupError">Email already exists in system!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'pass' && @$_REQUEST['signup_type'] == 'P'){ ?>
					<div class="signupError">Passwords do not match!</div>
			<?php } ?>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#studentJoinData').submit();return false;" class="btn2 modalActionButton modalActionButtonSave"><span class="inner"><?php echo __('Log In') ?></span></a>
			</div>
		</form>
		
		<form id="collaboratorJoinData" action="/users/login/" method="POST" <?php if(@$_REQUEST['signup_type'] != 'C') echo 'style="display:none;"'; ?>>
			<input type="hidden" name="user_type" value="C" />
			<ul class="fieldset2 joinForms">
				<li>
					<label><?php echo __('Beta-Test Key') ?></label>
					<input type="text" name="betakey" />
				</li>
				<li>
					<label><?php echo __('Preferred Email') ?><span class="small">(Username)</span></label>
					<input type="text" name="login" />
				</li>
				<li>
					<label style="color:#8bc53f;"><?php echo __('Choose a Password') ?></label>
					<input type="password" name="password" />
				</li>
				<li >
					<label style="color:#8bc53f;"><?php echo __('Confirm Password') ?></label>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<?php if(@$_REQUEST['signup_error'] == 'email' && @$_REQUEST['signup_type'] == 'C'){ ?>
				<div class="signupError">Email already exists in system!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'pass' && @$_REQUEST['signup_type'] == 'C'){ ?>
					<div class="signupError">Passwords do not match!</div>
			<?php }elseif(@$_REQUEST['signup_error'] == 'key' && @$_REQUEST['signup_type'] == 'C'){ ?>
					<div class="signupError">The beta key you provided is invalid.</div>
			<?php } ?>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#collaboratorJoinData').submit();return false;" class="btn2 modalActionButton modalActionButtonSave"><span class="inner"><?php echo __('Log In') ?></span></a>
			</div>
		</form>
	</div>

	<?php if(@$user){ ?>	
	<div id="addNewUserModal" style="height:245px;overflow:hidden">
		<div class="box-heading">

			<div class="caseclub-tabs">
				<ul >
					<li class="caseclub-tab tab-basics<?php if(!@$force_existing){ ?> active<?php } ?>">
						<a href="#"<?php if(!@$force_existing){ ?> onclick="invited_show_new();return false;"<?php }else{ ?> onclick="alert('Your email address already exists in the system. Please log in with your current details.');return false;"<?php } ?>><?php echo __('I\'m a new user') ?></a>
					</li>
					<li class="caseclub-tab tab-questions<?php if(@$force_existing){ ?> active<?php } ?>">
						<a href="#" style="width:145px;" onclick="invited_show_existing();return false;"><?php echo __('I already have an account') ?></a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
		</div><br /><br />
		
		<form id="inviteData" action="/users/login/" method="POST"<?php if(@$force_existing){ ?> style="display:none;"<?php } ?>>
			<input type="hidden" name="token" value="<?php echo $user['User']['invite_token']; ?>" />
			<input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>" />
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<label><?php echo __('Preferred Email') ?></label>
					<input type="text" name="email" />
				</li>
				<li>
					<label><?php echo __('Choose a Password') ?></label>
					<input type="password" name="password" />
				</li>
				<li >
					<label><?php echo __('Confirm Password') ?></label>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#inviteData').submit();return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter" style="width:250px;"><span class="inner"><?php echo __('Save and Continue') ?></span></a>
			</div>
		</form>
		
		<form id="existingInviteData" action="/users/login/" method="POST"<?php if(!@$force_existing){ ?> style="display:none;"<?php } ?>>
			<input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>" />
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<label><?php echo __('Email') ?></label>
					<input type="text" name="login" />
				</li>
				<li>
					<label><?php echo __('Password') ?></label>
					<input type="password" name="password" />
				</li>
			</ul>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#existingInviteData').submit();return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter" style="width:200px;"><span class="inner"><?php echo __('Log In') ?></span></a>
			</div>
		</form>
	</div><!-- #addNewUserModal -->
	
	<div id="resetPasswordModal" style="width:380px;height:170px;overflow:hidden;">
		<div class="box-heading">
			<span class="icon icon-key"></span>
			<h2 class="page-subtitle label-text"><?php echo __('New Password') ?></h2>
		</div><br />
		<form id="passwordResetData" action="/users/password_reset/<?php echo $user['User']['invite_token']; ?>" method="POST">
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<span class="label alignleft" style="width:130px;display:block;"><?php echo __('New Password') ?></span>
					<input type="password" name="new_password" id="pwdR1" style="width:200px;" />
				</li>
				<li>
					<span class="label alignleft" style="width:130px;display:block;"><?php echo __('Confirm Password') ?></span>
					<input type="password" name="password" id="pwdR2" style="width:200px;" />
				</li>
			</ul><br />
			<div class="modalActionButtons">
				<a href="#" onclick="if($('#pwdR1').val() != $('#pwdR2').val()){ alert('The passwords you entered do not match!'); }else{ $('#passwordResetData').submit(); }return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter" style="width:150px;"><span class="inner"><?php echo __('Save and Continue') ?></span></a>
			</div>
		</form>
	</div>
	<?php } ?>
</div>
<?php if(@$_REQUEST['signup_error']){ ?>
<script type="text/javascript">$(function(){ setTimeout(function(){ $('#joinBtn').click(); },225); });</script>
<?php }elseif(@$user){ ?>
<script type="text/javascript">
<?php if(!@$reset_password){ ?>
$(function(){ $('#inviteTrigger').click(); });
<?php }else{ ?>
$(function(){ $('#resetTrigger').click(); });
<?php } ?>
</script> 
<?php } ?>
<script type="text/javascript">
var zIdx = 0;
function fadeIn2(){
	zIdx++;
	$('#homeLayer2').fadeIn('slow',function(){
		$('#homeLayer1').hide();
		$('#homeLayer1').css('z-index',zIdx);
		setTimeout("fadeIn3()",1800);
	});
}
function fadeIn3(){
	zIdx++;
	$('#homeLayer3').fadeIn('slow',function(){
		$('#homeLayer2').hide();
		$('#homeLayer2').css('z-index',zIdx);
		setTimeout("fadeIn1()",1800);
	});
}
function fadeIn1(){
	zIdx++;
	$('#homeLayer1').fadeIn('slow',function(){
		$('#homeLayer3').hide();
		$('#homeLayer3').css('z-index',zIdx);
		setTimeout("fadeIn2()",1800);
	});
}
$(function(){
	fadeIn2();
});

$('#overlayLoginForm input').keydown(function (e){
    if(e.keyCode == 13){
		check_login();
	}
});
</script>
<?php } ?>