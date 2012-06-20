<div id="leftcol" class="alignleft">
	<h1 class="page-title">My Account</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="myaccount active"><a href="#">My Account</a></li>
			<?php if($_SESSION['User']['user_type']=='L'){ ?><li class="template "><a href="/challenges/update/0/template_basics/">Template</a></li><?php } ?>
			<li class="people2 "><a href="/users/view/groups/">Group(s)</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">


	<div class="caseclub-links-wrap">
		
		<div class="clear"></div>
	</div>
	
	<div id="myaccountform" class="form-fields-wrap form-fields-disabled round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">

						<span class="icon icon-userblack"></span>
						<h2 class="page-subtitle">My Account</h2>
					</div>
					<form id="userData">
						<input type="hidden" name="id" value="<?php echo $user['User']['id']; ?>" />
						<ul class="fieldset2">
							<li><span class="field-separator">Personal Info</span></li>
							<li><span class="label alignleft" >First Name</span> <input type="text" size="40" name="firstname" value="<?php echo $user['User']['firstname']; ?>" /></li>

							<li><span class="label alignleft" >Last Name</span> <input type="text" size="40" name="lastname" value="<?php echo $user['User']['lastname']; ?>" /></li>
							<li><span class="label alignleft" >E-mail</span> <input type="text" size="40" name="email" value="<?php echo $user['User']['email']; ?>" />
							<a href="#emailPreferences" class="show-overlay">Preferences</a></li>
							
							<li><span class="label alignleft">City</span> <input type="text" size="15" class="width15" name="city" value="<?php echo $user['User']['city']; ?>" /></li>
							<li><span class="label alignleft">State</span> 
								<select name="state">
									<?php foreach($states as $state){ ?>
										<option value="<?php echo $state['State']['abbreviation']; ?>" <?php if($user['User']['state'] == $state['State']['abbreviation']) echo 'selected="selected"'; ?>><?php echo $state['State']['state']; ?></option>
									<?php } ?>
								</select>
							</li>
							
							<li><span class="field-separator">Change Password</span></li>
							<li><span class="label alignleft">Type Password</span> <input type="password" size="40" name="new_pass1" /></li>

							<li><span class="label alignleft">Re-type Password</span> <input type="password" size="40" name="new_pass2" /></li>
							<li><span class="field-separator">&nbsp;</span></li>
							<li>
								<span class="label-text alignleft" >Allow people to search for me?</span> 
								<input type="checkbox" id="show-animations-yes" name="search_visible" value="1" <?php if($user['User']['search_visible']) echo 'checked="checked"'; ?> /> 
							</li>
							<li><span class="label alignleft" >Language</span> 
								<select >

									<option value="English" selected="selected">English</option>
								</select>
							</li>

							
							<li><span class="field-separator">Account Termination</span></li>
							<li>
								<a href="#terminateAccount" onclick="$('.terminateInputField').val('');" class="btn2 btn-terminate show-overlay"><span class="inner">Terminate My Account </span></a>
							</li>
						</ul>
						
						<input type="hidden" name="notify_groups" value="<?php echo $user['User']['notify_groups']; ?>" />
						<input type="hidden" name="notify_challenges" value="<?php echo $user['User']['notify_challenges']; ?>" />
						<input type="hidden" name="notify_expiration" value="<?php echo $user['User']['notify_expiration']; ?>" />
						<input type="hidden" name="notify_responses" value="<?php echo $user['User']['notify_responses']; ?>" />
					</form>
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #myaccountform-->
	
	<a href="#" class="btn1 btn-savecontinue aligncenter" onclick="save_user();return false;"><span class="inner">Save</span></a>
	<span id="savedNotify" style="display:none;">
		<p class="textAlignCenter red">Saved!</p>
	</span>
	
</div><!-- #maincol-->
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