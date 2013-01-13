<div id="sidebarleft">
	<h1><?php echo __('My Account') ?></h1>
	<div id="sidemenu">
		<ul>
			<li class="active"><a class="icon icon-calendar" href="#"><?php echo __('My Account') ?></a></li>
			<li><a class="icon icon-pay" href="/users/view/payments/"><?php echo __('Pay Plan') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div id="myaccount-box" class="box-startbridge box-white rounded">
		<div class="box-head">
			<span class="icon2 icon2-calendar"></span>
			<h2><?php echo __('My Account') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="box-content">
			<form id="userData">
				<input type="hidden" name="id" value="<?php echo $user['User']['id']; ?>" />
				<p><?php echo __('Personal Info') ?></p>
				<ul class="fieldset2">
					<li><label><?php echo __('First Name') ?></label> <input type="text" size="60" name="firstname" value="<?php echo ($user['User']['firstname'] == $user['User']['email'] ? '' : $user['User']['firstname']); ?>" /></li>
					<li><label><?php echo __('Last Name') ?></label> <input type="text" size="60" name="lastname" value="<?php echo $user['User']['lastname']; ?>" /></li>
					<li>
						<label><?php echo __('E-mail') ?></label>
						<input type="text" size="60" name="email" value="<?php echo $user['User']['email']; ?>" />
					</li>
					<li>
						<label><?php echo __('City') ?></label> <input type="text" size="20" class="width15" name="city" value="<?php echo $user['User']['city']; ?>" />
					</li>
					<li>
						<label><?php echo __('Country') ?></label> 
						<select id='country' name="country" style="width: 167px;" onchange="switch_state();">
							<option value="">Select</option>
							<?php foreach($countries as $country){ ?>
								<option value="<?php echo $country['Country']['abbreviation']; ?>" <?php if($user['User']['country'] == $country['Country']['abbreviation']){ echo 'selected="selected"'; } ?>><?php echo $country['Country']['country']; ?></option>
							<?php } ?>
						</select>
					</li>
					<li id='state_select' <?php if($user['User']['country'] != 'US' || $user['User']['country'] == ''){?>style='display:none'<?php } ?>>
						<label><?php echo __('State') ?></label> 
						<select name="US_state" style="width: 120px;" id='US_state'>
							<?php foreach($states as $state){ ?>
								<option value="<?php echo $state['State']['abbreviation']; ?>" <?php if($user['User']['state'] == $state['State']['abbreviation']) echo 'selected="selected"'; ?>><?php echo $state['State']['state']; ?></option>
							<?php } ?>
						</select>
					</li>
					<li id='state_input' <?php if($user['User']['country'] == 'US' || $user['User']['country'] == ''){?>style='display:none'<?php } ?>>
						<label><?php echo __('State/Province') ?></label><input type="text" id='other_state' size="20" class="width15" name="other_state" value="<?php if($user['User']['country'] == 'US'){ echo '';}else{ echo $user['User']['state']; }?>" />
					</li>
				</ul>
				
				<br />
				<p><?php echo __('Institution Info') ?></p>
				<ul class="fieldset2">	
					<li><label><?php echo __('Name of Institution') ?></label> <input type="text" value="<?php echo $user['User']['institution']; ?>" size="60" name="institution" /></li>
					<li>
						<label><?php echo __('Type') ?></label>
						<select name="institution_type">
							<option <?php if($user['User']['institution_type'] == 'High School') echo 'selected="selected"'; ?> value="High School">High School</option>
							<option <?php if($user['User']['institution_type'] == 'University') echo 'selected="selected"'; ?> value="University">University</option>
						</select>
				</ul>
				
				<br />
				<p><?php echo __('System Preferences') ?></p>
				<ul class="fieldset2">	
					<li>
						<label><?php echo __('Language') ?></label> 
						<select name="language" style="width: 120px;">
							<option value="eng"<?php if($user['User']['language']=='eng'){ ?> selected="selected"<?php } ?>><?php echo __('English') ?></option>
							<option value="spa"<?php if($user['User']['language']=='spa'){ ?> selected="selected"<?php } ?>><?php echo __('Spanish') ?></option>
						</select>
					</li>
					<li>
						<label><?php echo __('Email Preferences') ?></label>
						<a href="#modal-preferences" class="show-overlay modal-link" style="color: #666666; font-size: 12px; "><?php echo __('Edit') ?></a>
					</li>
				</ul>
				
				<br />
				<p><?php echo __('Password') ?></p>
				<span id="show_change_password" style='float: left; width: 250px; margin-right: 10px; color: #567AA9; font-size: 13px;'><?php echo __('To change your password click ') ?><a onclick="$('#change_password').show('fast'); $('#cancel_changes').show('fast'); $('#show_change_password').hide();"><u>here</u></a></span>
				<ul class="fieldset2" id="change_password" style='display:none'>	
					<li><label><?php echo __('Type Password') ?></label> <input type="password" size="60" id="new_pass1" name="new_pass1" /></li>
					<li><label><?php echo __('Re-type Password') ?></label> <input type="password" size="60" id="new_pass2" name="new_pass2" /></li>
				</ul><br /><br />
				
				<!--
					<p style="font-size: 12px; color: #777777; margin-bottom: 20px; "><?php echo __('Allow other Professors to search for my classes') ?> <input type="checkbox" id="show-animations-yes" name="search_visible" value="1" <?php if($user['User']['search_visible']) echo 'checked="checked"'; ?> /></p>
				-->
<!--
				<br /><br /><br />
				<p><?php echo __('Terminate my Account') ?></p>
				<a href="#terminateAccount" onclick="$('.terminateInputField').val('');" class="btn3" style="width: 120px;"><span><?php echo __('Terminate') ?></span></a>
-->
				<input type="hidden" name="notify_groups" value="<?php echo $user['User']['notify_groups']; ?>" />
				<input type="hidden" name="notify_challenges" value="<?php echo $user['User']['notify_challenges']; ?>" />
				<input type="hidden" name="notify_expiration" value="<?php echo $user['User']['notify_expiration']; ?>" />
				<input type="hidden" name="notify_responses" value="<?php echo $user['User']['notify_responses']; ?>" />
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<div style="width: 200px; margin: 0 auto; ">
	    <span id="passwordError" style="display:none;">
			<p style="display:block;text-align:center;color:#ff0000;"><?php echo __('Passwords do not match!') ?></p>
		</span>
		<a href="#" class="btn2 btn-savecontinue aligncenter" style="width: 80px; float: left;" onclick="save_user();return false;"><span style="width:64px;" class="inner"><?php echo __('Save') ?></span></a>
		<a href="#" class="btn3" id='cancel_changes' style="width: 80px; float: right; display:none" onclick="cancel_changes(); return false;"><span style="width:100px;"><?php echo __('Cancel Changes') ?></span></a>
		<span id="savedNotify" style="display:none;">
			<p style="display:block;text-align:center;color:#ff0000;"><?php echo __('Saved!') ?></p>
		</span>
		<span id="passwordError" style="display:none;">
			<p style="display:block;text-align:center;color:#ff0000;"><?php echo __('Passwords do not match!') ?></p>
		</span>

	</div>
</div>
<div class="clear"></div>


<div style="display: none; ">

	<div id="modal-preferences">
		<div class="modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon3 icon-envelope"></span>
				<h2><?php echo __('My Email Preferences') ?></h2>
			</div>
			<div class="modal-box-content">
				<form action="" method="post">	
					<ul class="fieldset">
						<li><?php echo __('Check your preferences:') ?></li>
						<li class="alternate">
							<input type="radio" onclick="enable_user_email();"<?php if($user['User']['notify_responses'] || $user['User']['notify_challenges'] || $user['User']['notify_expiration'] || $user['User']['notify_groups']){ ?> checked="checked"<?php } ?> name="enable_email" /> <?php echo __('Send me email') ?>
						</li>
						<li>
							<div class="send-email-preference"><input type="checkbox" id="notify_groups"<?php if($user['User']['notify_groups']){ ?> checked="checked"<?php } ?> disabled="disabled" /> <?php echo __('Classes') ?></div>
							<div class="send-email-preference"><input type="checkbox" id="notify_challenges"<?php if($user['User']['notify_challenges']){ ?> checked="checked"<?php } ?> disabled="disabled" /> <?php echo __('Challenges') ?></div>
							<div class="send-email-preference"><input type="checkbox" id="notify_expiration"<?php if($user['User']['notify_expiration']){ ?> checked="checked"<?php } ?> /> <?php echo __('Due Date Expiration') ?></div>
							<div class="clear"></div>
						</li>
						<li class="alternate">
							<input type="radio" onclick="disable_user_email();"<?php if(!($user['User']['notify_responses'] || $user['User']['notify_challenges'] || $user['User']['notify_expiration'] || $user['User']['notify_groups'])){ ?> checked="checked"<?php } ?> name="enable_email" /> <?php echo __('Never send me email') ?>
						</li>
					</ul>
				</form>
				<div class="clear"></div>
				<div style="width: 80px; margin: 0 auto; ">
					<a href="#" class="btn2" style="width: 100%" onclick="set_email_prefs();jQuery.fancybox.close();save_user();return false;"><span><?php echo __('Save') ?></span></a>
				</div>
			</div>
		</div>
	</div>
	
	<div id="terminateAccount">
		<div class="box-heading">
			<h2 class="label-text"><span class="red"><?php echo __('Warning!') ?></span></h2>
		</div>
		<div class="terminateNote"><?php echo __('You have clicked to Terminate your account. All data that has been stored will be permanently deleted. Are you sure you want to Terminate your account?') ?></div>

		<div class="terminateVerify">
			<div class="terminateVerifyNote"><?php echo __('If you are sure you want to permanently delete your account, please type TERMINATE into the box below.') ?></div>
			<input type="text"  class="terminateInputField"/>
		</div>
		
		<div class="terminateButtons">
			<a href="#" onclick="if($('.terminateInputField').val()!='TERMINATE'){ return false; }else{ window.location = '/users/delete/'; }" class="terminateAccountButton terminateAccountButtonTerminate"><?php echo __('Terminate My Account') ?></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; " class="btn2 terminateAccountButton"><span class="inner"><?php echo __('Cancel') ?></span></a>

		</div>
	</div>
	
</div>
<div style="display: none;">
	<div id="modalExitChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>

			<h2 class="page-subtitle label-text">Congratulations!</h2>
		</div>
		<br />
		<p class="caseclubFont18 blue textAlignCenter">Would you like to save before returning to Home?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>

			<a href="#" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>
		</div>
	</div><!-- #modalExitChoices -->
	
</div>