<!DOCTYPE html>
<html>
<head>
	<title>Home | Puentes</title>
	
	<link href="/favicon.ico" type="image/x-icon" rel="icon" /><link href="./favicon.ico" type="image/x-icon" rel="shortcut icon" />
	
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/style.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/style_corp.css" />
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
	
<?php if(@$_SESSION['User']['id']){ ?>
<script type="text/javascript"> window.location = '/dashboard/'; </script>
<?php }else{ ?>
	
	<div id="wrapper">

		<div id="header" class="round round-main">
			<div class="content rounded-top">
			
				<div id="logo"><a href="/"></a></div>
				<div id="topmenu">
					<span class="user-home icon-home"><a href="/">Main</a></span>
					<span class="user-logout icon-key"><a id="overlayLoginLink2" href="#">Login</a></span>
				
					<div id="overlayLoginForm" class="rounded" style="text-align:left;top:22px;right:0px;">
						<form id="loginBoxForm" method="POST" action="/dashboard/">
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
						</form>

						<a id="overlayForgotPasswordLink" href="#" onclick="send_password_reset();"><?php echo __('I forgot my password') ?></a>
						<a href="#" onclick="check_login();" class="btn1 alignright" id="overlaySubmitLoginLink"><span class="inner"><?php echo __('Log in') ?></span></a>
						<div class="clear"></div>
					</div>
				</div>

			
			</div>
		</div><!-- #header -->
	
		<div id="body">
		
			<div id="corpsite-home">
		
				<div id="home-header">
					<div id="home-header-introtext">
						<div class="slide slide-1">
							<span class="line1">End paper overload.</span>
						</div>
						<div class="slide slide-1">
							<span class="line1">Students learn more, you work less.</span>
						</div>
						<div class="slide slide-1">
							<span class="line1">Any other assignment is just an assignment.</span>
						</div>
					</div>
			
					<a href="#joinModalInstructor" id="sign-up-free" class="btn-green-simple show-overlay" >It's Free! Sign up</a>
				</div>
				<div class="clear"></div>
			
				<div id="home-slider">
					<div class="slides">
						<div class="slide" style="width:720px;">
							<div class="slide-content">
								<img src="/slides/slide-2.jpg" />
							</div>
							<div class="slide-info" style="cursor:pointer;" onclick="window.location='/pages/about/';">
								<p>Learn how Puentes <br />can help you and <br /> your classroom<br /><br />
								<img src="/images/corp/slide-description.png" /></p>
							</div>
						</div>
					</div>
					<div class="control">
						<a class="arrow" href="/pages/about/" style="width:83px;"></a>
					</div>
				</div>
			
			
				<div id="home-tabs" style = "margin-left: 48px;"
>
				
					<div class="tabs" >
						<div class="tab" id="tab-quick-explain">
							<span class="icon"></span>
							<div class="text">
								&nbsp;&nbsp;Quick Explanation
							</div>
							<span class="indicator"></span>
						</div>
						<div class="tab" id="tab-second-section">
							<span class="icon"></span>
							<div class="text">
								&nbsp;&nbsp;Puentes	Bridges
							</div>
							<span class="indicator"></span>
						</div>
						<div class="tab" id="tab-ten-reasons">
							<span class="icon"></span>
							<div class="text">
								Reasons to join Puentes
							<span class="indicator"></span>
						</div>
					</div>
					<div class="clear"></div>
				
					<div class="tabs-content" >
						<div class="tab-content" id="tab-quick-explain-content">
							<p>Puentes takes the pain out of paper assignments. Rather than giving out assignments and receiving reams of paper back from students, Puentes takes the assignment process digital. Now, you can easily create, assign, receive, grade and store all assignments through one easy-to-use portal.</p>
						</div>
						<div class="tab-content " id="tab-second-section-content">
							<p>
								<strong>Don’t just create assignments. Create Bridges.</strong><br />
								Puentes (Bridges in Spanish), allows you to connect with other Instructors through like-minded assignments. Bring students together by subject matter to make their assignments relevant, actionable and memorable. Connect students in the same town, city, or or in another country. Whether in Rome, GA or Rome, Italy,  Paris, TX or Paris, France.   Puentes makes learning relevant. No matter where you are.  
							</p>
							<p>
								The process is the same, however, once students complete their assignment, they collaborate on answers. Connect your sections that are learning the same material and would have never spoken otherwise, or simply have your students work with other students in other cities in the world.
							</p>
						</div>
						<div class="tab-content " id="tab-ten-reasons-content" style="text-align:center;">
							<ol style="list-style:none;">
								<li>Assignments on Puentes are so much easier than paper!</li>
								<li>The grading process simpler, more organized and easy to store. </li>
								<li>Align your assignments with Common Core standards.</li>
								<li>Your students take part in a cross-cultural experience.</li>
								<li>It's green!</li>
								<li>Less expensive than other applications</li>
								<li>Students will never again say "My dog ate my homework."</li>
								<li>It's fun</li>
								<li>It's simple</li>
								<li>It's built specifically for Instructors</li>
							</ol>
						</div>
					</div>
					<div class="clear"></div>
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
	
	<?php if(@$user){ ?>
	<style type="text/css">
	#fancybox-content div { overflow:hidden !important; }
	</style>
	<a href="#addNewUserModal" visible="false" id="inviteTrigger" class="add-link show-overlay"></a>
	<a href="#resetPasswordModal" visible="false" id="resetTrigger" class="add-link show-overlay"></a>
	<?php } ?>
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
	</script>
	<?php } ?>
	<script type='text/javascript'>
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