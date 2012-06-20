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
</div>

<?php if(@$user){ ?>
<style type="text/css">
#fancybox-content div { overflow:hidden !important; }
</style>
<a href="#addNewUserModal" visible="false" id="inviteTrigger" class="add-link show-overlay"></a>
<a href="#resetPasswordModal" visible="false" id="resetTrigger" class="add-link show-overlay"></a>
<div style="display:none;">
	<div id="addNewUserModal" style="height:245px;overflow:hidden">
		<div class="box-heading">

			<div class="caseclub-tabs">
				<ul >
					<li class="caseclub-tab tab-basics<?php if(!@$force_existing){ ?> active<?php } ?>">
						<a href="#"<?php if(!@$force_existing){ ?> onclick="invited_show_new();return false;"<?php }else{ ?> onclick="alert('Your email address already exists in the system. Please log in with your current details.');return false;"<?php } ?>>I'm a new user</a>
					</li>
					<li class="caseclub-tab tab-questions<?php if(@$force_existing){ ?> active<?php } ?>">
						<a href="#" style="width:145px;" onclick="invited_show_existing();return false;">I already have an account</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
		</div>
		
		<form id="inviteData" action="/users/login/" method="POST"<?php if(@$force_existing){ ?> style="display:none;"<?php } ?>>
			<input type="hidden" name="token" value="<?php echo $user['User']['invite_token']; ?>" />
			<input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>" />
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<span class="label alignleft">Preferred Email</span>
					<input type="text" name="email" />
				</li>
				<li>
					<span class="label alignleft">Choose a Password</span>
					<input type="password" name="password" />
				</li>
				<li >
					<span class="label alignleft">Confirm Password</span>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#inviteData').submit();return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Save and Continue</span></a>
			</div>
		</form>
		
		<form id="existingInviteData" action="/users/login/" method="POST"<?php if(!@$force_existing){ ?> style="display:none;"<?php } ?>>
			<input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>" />
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<span class="label alignleft">Email</span>
					<input type="text" name="login" />
				</li>
				<li>
					<span class="label alignleft">Password</span>
					<input type="password" name="password" />
				</li>
			</ul>
			<div class="modalActionButtons">
				<a href="#" onclick="$('#existingInviteData').submit();return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Log In</span></a>
			</div>
		</form>
	</div><!-- #addNewUserModal -->
	
	<div id="resetPasswordModal" style="width:460px;height:220px;overflow:hidden;">
		<div class="box-heading">
			<span class="icon icon-key"></span>
			<h2 class="page-subtitle label-text">New Password</h2>
		</div>
		<form id="passwordResetData" action="/users/password_reset/<?php echo $user['User']['invite_token']; ?>" method="POST">
			<input type="hidden" name="user_id" value="<?php echo $user['User']['id']; ?>" />
			<ul class="fieldset2">
				<li>
					<span class="label alignleft">New Password</span>
					<input type="password" name="new_password" id="pwdR1" />
				</li>
				<li>
					<span class="label alignleft">Confirm Password</span>
					<input type="password" name="password" id="pwdR2" />
				</li>
			</ul>
			<div class="modalActionButtons">
				<a href="#" onclick="if($('#pwdR1').val() != $('#pwdR2').val()){ alert('The passwords you entered do not match!'); }else{ $('#passwordResetData').submit(); }return false;" class="btn1 modalActionButton modalActionButtonSave aligncenter"><span class="inner">Save and Continue</span></a>
			</div>
		</form>
	</div>
</div>
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