<!DOCTYPE html>
<html>
<head>
	<title>Contact Us - Frequently Asked Questions | Puentes</title>
	
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
		
		<div id="contact-us-page" class="site-page" >
			<h1>Contact Us &amp; FAQ</h1>
			
			<div id="contact-us-form-div" class="width50 alignleft">
			
				
				<h3 style="margin-bottom: 0">Help</h3>
				<p>For help related issues, you may reach out to <a href="mailto:info@puentesonline.com">info@puentesonline.com</a></p>
				
				<div id="contact-us-form">
					
					<p>Let us know your suggestions, comments and/or concerns by filling out the form below. We do review all emails that come in. However, we are not able to respond to all of them.</p>
					
					<form action="" method="post">
					<ul>
						<li>
							<label for="contact-first-name">First Name</label>
							<input type="text" name="first_name" id="contact-first-name" />
						</li>
						<li>
							<label for="contact-last-name">Last Name</label>
							<input type="text" name="last_name" id="contact-last-name" />
						</li>
						<li>
							<label for="contact-email">Email</label>
							<input type="text" name="email" id="contact-email" />
						</li>
						<li>
							<label for="contact-subject">Subject</label>
							<select name="subject" id="contact-subject">
								<option value="">What's on your mind?</option>
								<option>A question</option>
								<option>A comment</option>
								<option>A complaint</option>
								<option>General feedback</option>
							</select>
						</li>
						<li>
							<label for="contact-message">Message</label>
							<textarea name="message" id="contact-message"></textarea>
						</li>
						<li class="submit">
							<input type="submit" value="Send" class="bridge-btn2"/>
							<input type="button" value="Reset" class="bridge-btn4" />
						</li>
					</ul>
					</form>
				</div>
			
			</div>
			
			<div id="faq-div" class="width50 alignright">
				<h3 style="margin-top: 0">FAQ</h3>
				
				<ul class="accordion">
					<li>
						<a href="#" class="toggle">Is my class information private?</a>
						<div class="toggle-content">
							<p>Yes, absolutely. Your privacy is of absolute importance to the company. Please visit our Privacy Policy for more information. Please send us a note using our Contact Us form if you have any other questions.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Can I use Puentes if our school/institution uses applications like Blackboard and/or others?</a>
						<div class="toggle-content">
							<p>There are lots of free services that are used by Instructors all over the country. Unless your school or college licenses with us, Puentes is an independent service from your institution, and signing up is extremely easy. </p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Why am I not getting Puentes emails?</a>
						<div class="toggle-content">
							<p>There may be a chance that your emails are going to your spam folder. To avoid this, add noreply@puentesonline to your safe list.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">What are typical troubleshooting methods for Puentes?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:<br /><br />

							1. Try refreshing the page (make sure you save any unfinished work first)<br />
							2. Try updating your browser to the latest version (Puentes will probably not work its best on Internet Explorer 2004)<br />
							3. Try quitting the browser and restarting (this is worst case scenario, but it sometimes works)<br /><br />

							If none of these methods work, please feel free
							to reach out to us at info@puentesonline.com
							and we will get back to you asap.
							</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">What is a class Token?</a>
						<div class="toggle-content">
							<p>After you create a class, you have the option to create a code (what we call a class Token), which you give to your students. Your students will then sign themselves up to your class using that code through the home page.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How do I connect with other Instructors?</a>
						<div class="toggle-content">
							<p>Go to the Classes section found on the top of the application. Then navigate to the Connections section. There you will find a button labeled “Find an Instructor.” Simply add their email address and search for them.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How often do you update the application?</a>
						<div class="toggle-content">
							<p>There is constant updating and improvements, big and small. Therefore, it is important to receive feedback from you, our users. We want to continue providing the best quality product we possibly can.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Who created Puentes?</a>
						<div class="toggle-content">
							<p>Puentes was originally created by Sean Daly. The first commercially viable product was created by himself, Benjamin Rawn and Wifredo Fernandez.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How do I unsubscribe?</a>
						<div class="toggle-content">
							<p>First off, we would be sad to see you go. But if necessary, send us an email to noreply@puentesonline.com with UNSUBSCRIBE in the subject of the email. Please include your username, and feel free to add an explanation with your reason for leaving us.</p>
						</div>
					</li>
				</ul>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>
			
	
	<div id="footer">
		<div class="alignleft" id="logofooter"></div>
		<div class="alignright" id="footermenu">
			<ul>
				<li><a href="/pages/contact/">Contact Us/FAQ</a></li>
				<li><a href="/pages/privacy/">Privacy Policy</a></li>
				<li><a href="/pages/terms/">Terms and Conditions</a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div><!-- #footer -->
	
</div>
</body>
</html>