<!DOCTYPE html>
<html>
<head>
	<title>About | Puentes</title>
	
	<link href="/favicon.ico" type="image/x-icon" rel="icon" /><link href="./favicon.ico" type="image/x-icon" rel="shortcut icon" />
	
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/style.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/style_corp.css" />
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel='stylesheet' media="all" href="/js/jquery-ui/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" media="all" href="/js/mcs/jquery.mCustomScrollbar.css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="/js/jquery.flip.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ba-bbq.min.js"></script>
	<script type="text/javascript" src="/js/mcs/jquery.mCustomScrollbar.js"></script>
	<script type="text/javascript" src="/js/textAnnotater.js?v=2"></script>
	<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="/js/tooltip/jquery.tooltip.js" ></script>

	<script type="text/javascript" src="/js/custom.js" ></script>
	<script type="text/javascript" src="/js/custom_corp.js" ></script>
	<script type="text/javascript" src="/js/cco_ajax.js?v=7" ></script>
	
</head>
<body class="site page page-index">
<div id="wrapper">

	<div id="header" class="round round-main">
		<div class="content rounded-top">
			
			<div id="logo"><a href="/"></a></div>
			<div id="topmenu">
				<span class="user-home icon-home"><a href="/">Main</a></span>
				<span class="user-logout icon-key"><a id="overlayLoginLink2" href="#">Login</a></span>
			
				<div id="overlayLoginForm" class="rounded" style="text-align:left;top:25px;right:0px;">
					<ul class="fieldset2">
						<li>
							<div class="label alignleft">
								<span class="red">*</span> <?php echo __('Email') ?>
							</div>
							<input type="text" class="inputText" id="loginUser" />
						</li>
						<li>
							<div class="label alignleft">
								<span class="red">*</span> <?php echo __('Password') ?>
							</div> 
							<input type="password" class="inputText" id="loginPass" />
						</li>
						<li class="errorNotification"><span class="red" id="loginError"> &nbsp; </span></li>
					</ul>
					<div class="clear"></div>

					<a id="overlayForgotPasswordLink" href="#" onclick="send_password_reset();"><?php echo __('I forgot my password') ?></a>
					<a href="#" onclick="check_login();" class="btn1 alignright" id="overlaySubmitLoginLink"><span class="inner"><?php echo __('Log in') ?></span></a>
					<div class="clear"></div>
				</div>
			</div>
			
		</div>
	</div><!-- #header -->
	
	<div id="body">
		
		<div id="more-info-page" class="site-page" >
		
			<div id="more-info-what-is" class="more-info-div">
				<p style="line-height:33px;"><br /><br />
					<img align="right" src="/images/corp/paper_storm.png" style="padding-left:200px;" width="300" />
					Puentes takes the pain out of paper assignments. Rather than giving out assignments and receiving reams of paper back from students, Puentes takes the assignment process digital. Now, you can easily create, assign, receive, grade and store all assignments through one easy-to-use portal.</p>
			</div>
			
			<div id="more-info-how-does-it-work" class="more-info-div">
				<img src="/images/corp/about_txt.png" style="padding-top:30px;" />
			</div>
			<br />
			<div id="more-info-tell-more" class="more-info-div">
				
				<h3>Tell me more...</h3>
			
				<div class="more-info-special">
					<div class="alignleft polaroid-wrap" style="height:261px;"><img src="/images/corp/puentes_ss1.png" width="420" /></div>
					<div class="alignright more-info-special-content">
						<p class="more-info-special-title">1. Create the assignment:</p>
						<ul>
							<li>Select the kind of assignment you’d like to create</li>
							<li>Fill out some information</li>
							<li>Send to your class.</li>
						</ul>
						<p>
							Upload a document, YouTube video, or assign an offline assignment from a textbook<br />
							Add multiple class sections to the same assignment 
						</p>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="more-info-special">
					<div class="alignright polaroid-wrap" style="height:266px;"><img src="/images/corp/puentes_ss2.png" width="420" /></div>
					<div class="alignleft more-info-special-content">
						<p class="more-info-special-title">2. Students Complete Assignment</p>
						<p>Students complete the assignment by:</p>
						<ul>
							<li>Logging on to Puentes</li>
							<li>Viewing your document or video</li>
							<li>Answering your questions</li>
							<li>Submitting by the Due Date</li>
							<li>Everything is done in the same place!</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="more-info-special">
					<div class="alignleft polaroid-wrap" style="height:206px;"><img src="/images/corp/puentes_ss3.png" width="420" /></div>
					<div class="alignright more-info-special-content">
						<p class="more-info-special-title">3. Grading Made Easy</p>
						<p>Grading with paper is old news - we have developed a way to make grading online really simple.</p>
						<ul>
							<li>Get a snapshot of each student before jumping into comments and corrections</li>
							<li>Grade the assignment</li>
							<li>Student is notified the homework has been graded</li>
							<li>Store grades and archive assignments for future use</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				
			</div>
			
			
			<div id="site-page-signup">
				
				<p><em>End the paper overload</em></p>
				<a href="#joinModalInstructor" class="btn-green-simple show-overlay">Sign-up Now! It's Free!</a>
			
			</div>
			
		</div>
		
	</div>
			
	
	<div id="footer">
		<div class="alignleft" id="logofooter"></div>
		<div class="alignright" id="footermenu">
			<ul>
				<li><a href="/pages/contact">Contact Us/FAQ</a></li>
				<li><a href="/pages/privacy">Privacy Policy</a></li>
				<li><a href="/pages/terms">Terms and Conditions</a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div><!-- #footer -->
	
</div>

<div style="display:none;">
	
	<div id="joinModalInstructor" class="joinModal " >
		<div class="box-heading joinTabs">

			<div class="puentes-tabs">
				<ul >
					<li class="puentes-tab tab-instructor active">
						<a href="#joinModalInstructor" class="show-overlay">I'm an Instructor</a>
					</li>
					<li class="puentes-tab tab-student">
						<a href="#joinModalStudent" class="show-overlay">I'm a Student</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<a href="#" class="modal-top-right-link" onclick="jQuery.fancybox.close(); return false; ">Exit Sign-up</a>
			
			<div class="clear"></div>
		</div><br />
		
		<form id="instructorJoinData" action="" method="post" >
			<h4>Step 1 of 2: Login information</h4>
			<div style="display: block; height: 190px;">
				<input type="hidden" name="user_type" value="L" />
				<input type="hidden" name="betakey" value="BETATEST" />
				<ul class="fieldset2 joinForms" >
					<li>
						<label>Instructor Email</label>
						<input type="text" name="login" id="email1" />
					</li>
					<li>
						<label style="color:#8bc53f;">Choose a Password</label>
						<input type="password" name="password" id="pass1" />
					</li>
				</ul>
				<span  class = "errorEmail" id="emailError1"></span>
			</div>
			<div class="modalActionButtons">
				<a href="#" id="Instructor_Form" class="btn-arrow modalActionButton modalActionButtonSave" ><span class="inner">Step 2 of 2</span></a>
			</div>
		</form>
		
	</div>
	
	
	<div id="joinModalStudent" class="joinModal" style="height: 470px;">
		
		<div class="box-heading joinTabs">

			<div class="puentes-tabs">
				<ul >
					<li class="puentes-tab tab-instructor">
						<a href="#joinModalInstructor" class="show-overlay">I'm an Instructor</a>
					</li>
					<li class="puentes-tab tab-student active">
						<a href="#joinModalStudent" class="show-overlay">I'm a Student</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<a href="#" class="modal-top-right-link" onclick="jQuery.fancybox.close(); return false; ">Exit Sign-up</a>
			
			<div class="clear"></div>
		</div><br />
		
		<form id="studentJoinData" method="post" >
			<h4>Class Information</h4>
			<ul class="fieldset2 joinForms" >
				<li>
					<label>Class Token</label>
					<input type="text" name="classtoken" />
				</li>
				<li>
					<label>Instructor's Email</label>
					<input type="text" name="instructor_email" id="email5"/>
				</li>
			</ul>
				
			<h4>Student Login Information</h4>
			<ul class="fieldset2 joinForms">
				<li>
					<label>Your School Email<span class="small">(Username)</span></label>
					<input type="text" name="login" id="email2" />
				</li>
				<li>
					<label>Confirm School Email</label>
					<input type="text" name="email2_confirm" />
				</li>
				<li >
					<label style="color:#8bc53f;">Confirm Password</label>
					<input type="password" name="password_confirm" />
				</li>
			</ul>
			<span class = "errorEmail" id="emailError2"></span>
			<div class="modalActionButtons">
				<a href="#" id="Student_Form" class="btn-arrow modalActionButton modalActionButtonSave"><span class="inner">Log In</span></a>
			</div>
			
			<input type="hidden" name="user_type" value="P" />
		</form>
		
	</div>
	
	<div id="modalStudentStep2" class="joinModal joinModalStep2">
		
		<div class="box-heading joinTabs">

			<div class="puentes-tabs">
				<ul >
					<li class="puentes-tab tab-instructor">
						<a href="#joinModalInstructor" class="show-overlay" >I'm an Instructor</a>
					</li>
					<li class="puentes-tab tab-student active">
						<a href="#joinModalStudent" class="show-overlay" >I'm a Student</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<a href="#joinModalStudent" class="show-overlay modal-top-right-link" >Back</a>
			
			<div class="clear"></div>
		</div><br />
		
		<h4>Step 2 of 2: Check Your Email</h4>
		<div style="display: block; height: 190px;">
			<p style="font-size: 16px; line-height: 2em; ">Please check your email, where you will receive a confirmation email. Click on the link provided and continue to the website.</p>
		</div>
		<div class="modalActionButtons">
			<a href="/users/view" id="Instructor_Form_Done" class="btn-arrow modalActionButton modalActionButtonSave" onclick="jQuery.fancybox.close(); return false; "><span class="inner">Done</span></a>
		</div>
	</div>
	
	<div id="modalInstructorStep2" class="joinModal joinModalStep2">
		
		<div class="box-heading joinTabs">

			<div class="puentes-tabs">
				<ul >
					<li class="puentes-tab tab-instructor active">
						<a href="#joinModalInstructor" class="show-overlay">I'm an Instructor</a>
					</li>
					<li class="puentes-tab tab-student">
						<a href="#joinModalStudent" class="show-overlay">I'm a Student</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<a href="#joinModalInstructor" class="show-overlay modal-top-right-link" >Back</a>
			
			<div class="clear"></div>
		</div><br />
		
		<h4>Step 2 of 2: Check Your Email</h4>
		<div style="display: block; height: 190px;">
			<p style="font-size: 16px; line-height: 2em; ">Please check your email, where you will receive a confirmation email. Click on the link provided and continue to the website.</p>
		</div>
		<div class="modalActionButtons">
			<a href="/users/view" id="Instructor_Form_Done" class="btn-arrow modalActionButton modalActionButtonSave" onclick="jQuery.fancybox.close(); return false; "><span class="inner">Done</span></a>
		</div>
	</div>
	
	
	
	
	<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

	

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
					<input type="text" name="email" id = "email4"/>
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
			<span  class = "errorEmail" id="emailError4"></span>
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

<a href="#modalInstructorStep2" style="display:none;" id="mInst2" class="show-overlay"> </a>
<a href="#modalStudentStep2" style="display:none;" id="mStu2" class="show-overlay"> </a>

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

$(document).ready(function(e) {
    $('#Student_Form').click(function() {
        var sEmail = $('#email2').val();
		var sEmail1 = $('#email5').val();
		var sub = 1;

		if(!validateEmail(sEmail)){
			$('#emailError2').html('You must enter a valid email address: example@yourschool.edu');
			sub = 0;
		}else if(!validateEmail(sEmail1)){
			$('#emailError2').html('You must enter a valid email address: example@yourschool.edu');
			sub = 0;
		}
		if(sub == 1){
			$.ajax({url:'/users/login/',data:$('#studentJoinData').serialize(),success:function(r){
				if(r == 'duplicate') $('#emailError2').html('Email already exists in system');
				else if(r == 'bad_token') $('#emailError2').html('Class token/Instructor Email combination not recognized!');
				else $('#mStu2').click();
			}});
		}
    });
    $('#Instructor_Form').click(function() {
    var sEmail = $('#email1').val();
    if(!validateEmail(sEmail)) {
    	$('#emailError1').html('You must enter a valid email address: example@yourschool.edu');
			$('#joinModal').height(375);
		}else if(!$('#pass1').val()){
			$('#emailError1').html('You must enter a password');
			$('#joinModal').height(375);
		}else{
			//$('#instructorJoinData').submit();return false;
			$.ajax({url:'/users/login/',data:$('#instructorJoinData').serialize(),success:function(r){
				if(r == 'duplicate'){
					$('#emailError1').html('Email already exists in system');
					$('#joinModal').height(375);
				}else $('#mInst2').click();
			}});
			return false;
		}
    });
    $('#Collaborator_Form').click(function() {
        var sEmail = $('#email3').val();
        if(!validateEmail(sEmail)) {
    		$('#emailError3').html('You must enter a valid email address: example@yourschool.edu');
		}else{
			$('#collaboratorJoinData').submit();return false;
		}
    });
});

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}
</script>

</body>
</html>