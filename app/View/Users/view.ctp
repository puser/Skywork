<div id="sidebarleft">
	<h1>My Account</h1>
	<div id="sidemenu">
		<ul>
			<li class="active"><a class="icon icon-calendar" href="#">My Account</a></li>
			<li><a class="icon icon-class" href="/users/view/classes/">Classes</a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div id="myaccount-box" class="box-startbridge box-white rounded">
		<div class="box-head">
			<span class="icon2 icon2-calendar"></span>
			<h2>My Account</h2>
			<div class="clear"></div>
		</div>
		<div class="box-content">
			<form id="userData">
				<input type="hidden" name="id" value="<?php echo $user['User']['id']; ?>" />
				<p>Personal Info</p>
				<ul class="fieldset2">
					<li><label>First Name</label> <input type="text" size="60" name="firstname" value="<?php echo $user['User']['firstname']; ?>" /></li>
					<li><label>Last Name</label> <input type="text" size="60" name="lastname" value="<?php echo $user['User']['lastname']; ?>" /></li>
					<li>
						<label>E-mail</label>
						<input type="text" size="60" name="email" value="<?php echo $user['User']['email']; ?>" />
						<a href="#emailPreferences" class="show-overlay modal-link" style="color: #666666; font-size: 12px; ">Preferences</a>
					</li>
					<li><label>City</label> <input type="text" size="20" class="width15" name="city" value="<?php echo $user['User']['city']; ?>" /></li>
					<li>
						<label>State</label> 
						<select name="state" style="width: 120px;">
							<?php foreach($states as $state){ ?>
								<option value="<?php echo $state['State']['abbreviation']; ?>" <?php if($user['User']['state'] == $state['State']['abbreviation']) echo 'selected="selected"'; ?>><?php echo $state['State']['state']; ?></option>
							<?php } ?>
						</select>
					</li>
					<li>
						<label>Language</label> 
						<select style="width: 120px;">
							<option value="English" selected="selected">English</option>
						</select>
					</li>
				</ul>
				<br /><br />
				<p>Change Password</p>
				<ul class="fieldset2">	
					<li><label>Type Password</label> <input type="password" size="60" name="new_pass1" /></li>
					<li><label>Re-type Password</label> <input type="password" size="60" name="new_pass2" /></li>
				</ul>
				<br /><br /><br />
				<p style="font-size: 12px; color: #777777; margin-bottom: 20px; ">Allow other Professors to search for my classes <input type="checkbox" id="show-animations-yes" name="search_visible" value="1" <?php if($user['User']['search_visible']) echo 'checked="checked"'; ?> /></p>

				<p>Terminate my Account</p>
				<a href="#terminateAccount" onclick="$('.terminateInputField').val('');" class="btn3" style="width: 120px;"><span>Terminate</span></a>

				<input type="hidden" name="notify_groups" value="<?php echo $user['User']['notify_groups']; ?>" />
				<input type="hidden" name="notify_challenges" value="<?php echo $user['User']['notify_challenges']; ?>" />
				<input type="hidden" name="notify_expiration" value="<?php echo $user['User']['notify_expiration']; ?>" />
				<input type="hidden" name="notify_responses" value="<?php echo $user['User']['notify_responses']; ?>" />
			</form>
		</div>
	</div>
	<div class="clear"></div>
	
	<a href="#" class="btn1 btn-savecontinue aligncenter" onclick="save_user();return false;"><span class="inner">Save</span></a>
	<span id="savedNotify" style="display:none;">
		<p style="display:block;text-align:center;color:#ff0000;">Saved!</p>
	</span>
	
</div>
<div class="clear"></div>


<div style="display: none; ">

	<div id="emailPreferences">
		<div class="box-heading">
			<span class="icon icon-envelope"></span>
			<h2 class="page-subtitle">My Email Preferences</h2>
		</div>

		
		<ul class="fieldset2">
			<li class="alternate">
				<input type="radio" onclick="enable_user_email();"<?php if($user['User']['notify_responses'] || $user['User']['notify_challenges'] || $user['User']['notify_expiration'] || $user['User']['notify_groups']){ ?> checked="checked"<?php } ?> name="enable_email"> Send me email
			</li>
			<li >
				<input type="checkbox" id="notify_groups"<?php if($user['User']['notify_groups']){ ?> checked="checked"<?php } ?> disabled="disabled"> Groups &nbsp;&nbsp;
				<input type="checkbox" id="notify_challenges"<?php if($user['User']['notify_challenges']){ ?> checked="checked"<?php } ?> disabled="disabled"> Challenges &nbsp;&nbsp;
				
				<input type="checkbox" id="notify_expiration"<?php if($user['User']['notify_expiration']){ ?> checked="checked"<?php } ?>> Expiration &nbsp;&nbsp;
				<!-- <input type="checkbox" id="notify_responses"<?php if($user['User']['notify_responses']){ ?> checked="checked"<?php } ?>> Question Responses &nbsp;&nbsp; -->
			</li>
			<li class="alternate">
				<input type="radio" onclick="disable_user_email();"<?php if(!($user['User']['notify_responses'] || $user['User']['notify_challenges'] || $user['User']['notify_expiration'] || $user['User']['notify_groups'])){ ?> checked="checked"<?php } ?> name="enable_email"> Never send me an email
			</li>
		</ul>

		<a href="#"  onclick="set_email_prefs();jQuery.fancybox.close();save_user();return false;" class="btn1 aligncenter"><span class="inner">Save</span></a>
	</div>
	
	<div id="terminateAccount">
		<div class="box-heading">
			<h2 class="label-text"><span class="red">Warning!</span></h2>
		</div>
		<div class="terminateNote">You have clicked to Terminate your account. All data that has been stored will be permanently deleted. Are you sure you want to Terminate your account?</div>

		<div class="terminateVerify">
			<div class="terminateVerifyNote">If you are sure you want to permanently delete your account, please type TERMINATE into the box below.</div>
			<input type="text"  class="terminateInputField"/>
		</div>
		
		<div class="terminateButtons">
			<a href="#" onclick="if($('.terminateInputField').val()!='TERMINATE'){ return false; }else{ window.location = '/users/delete/'; }" class="terminateAccountButton terminateAccountButtonTerminate">Terminate My Account</a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; " class="btn2 terminateAccountButton"><span class="inner">Cancel</span></a>

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