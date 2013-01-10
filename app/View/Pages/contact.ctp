<!DOCTYPE html>
<html>
<head>
	<title>Contact Us - Frequently Asked Questions | Puentes</title>
	
	<link href="/favicon.ico" type="image/x-icon" rel="icon" /><link href="./favicon.ico" type="image/x-icon" rel="shortcut icon" />
	
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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

	<div id="header">
		<div id="logo"><a href="/"></a></div>
		<div id="topmenu">
			<span class="user-logout icon-key"><a id="overlayLoginLink2" href="#">Login</a></span>
		
			<div id="overlayLoginForm" class="rounded" style="text-align:left;top:22px;right:0px;">
				<form id="loginBoxForm" method="POST" action="/dashboard/">
					<ul class="fieldset2">
						<li>
							<div class="label alignleft">
								<span class="red">*</span> <?php echo __('Email') ?>
							</div>
							<input type="text" name="loginUser" class="inputText" id="loginUser" />
						</li>
						<li>
							<div class="label alignleft">
								<span class="red">*</span> <?php echo __('Password') ?>
							</div> 
							<input type="password" name="loginPass" class="inputText" id="loginPass" />
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
		
		<div id="mainmenu">
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/pages/about/">Product</a></li>
				<li><a href="http://blog.puentesonline.com/">Blog</a></li>
				<li class="active"><a href="/pages/contact/">Contact</a></li>
			</ul>
		</div>
	</div><!-- #header -->
	
	<div id="body">
		
		<div class="contentmain">
			
			
			<div id="contact-us-form-div" class="width50 alignleft">
			
				<div id="contact-us-form">
					
					<p>Let us know your suggestions, comments and/or concerns by filling out the form below.</p>
					
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
								<option value="">What's on your mind? </option>
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
				<p style="font-size: 18px;">FAQ</p>
				
				<ul class="accordion">
					<li>
						<a href="#" class="toggle">How do I connect with other Instructors?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How do I connect with other Instructors?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Is my class information private?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Can I use Puentes if our school/institution uses applications like Blackboard and/or others?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Why am I not getting Puentes emails?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">What is typical troubleshooting for Puentes?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
							<ol class="list-arabic">
								<li>Try refreshing the page (make sure you save any unfinished work first)</li>
								<li>Try updating your browser to the latest version (Puentes will probably not work its best on Internet Explorer 2004)</li>
								<li>Try quitting the browser and restarting (this is worst case scenario, but it sometimes works)</li>
							</ol>
							<p>If none of these methods work, please feel free to reach out to us at <a href="mailto:info@puentesonline.com">info@puentesonline.com</a> and we will get back to you asap.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How often do you update the application?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Who started Puentes?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Puentes, try these simple methods of troubleshooting:</p>
						</div>
					</li>
				</ul>
			</div>
			
		</div>
			
		</div>
		
	</div>
	
</body>
</html>