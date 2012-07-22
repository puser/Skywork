<!DOCTYPE html>
<html>
<head>
	<title>Puentes</title>
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel='stylesheet' media="all" href="/js/jquery-ui/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" media="all" href="/js/mcs/jquery.mCustomScrollbar.css" />
	
	<link type="text/css" rel="stylesheet" media="all" href="/css/style.css" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>
<!--
	<script src="/js/jquery_1.6.4.js" type="text/javascript"></script>
	<script src="/js/jquery-ui.js" type="text/javascript"></script>
-->
	<script type="text/javascript" src="/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="/js/jquery.flip.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ba-bbq.min.js"></script>
	<script type="text/javascript" src="/js/mcs/jquery.mCustomScrollbar.js"></script>
	<script type="text/javascript" src="/js/textAnnotater.js"></script>

	<script type="text/javascript" src="/js/custom.js" ></script>
	<script type="text/javascript" src="/js/cco_ajax.js" ></script>
	<!--
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	<script type="text/javascript">
	// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});
	</script>
	
	<!--[if lte IE 6]>
		<script type="text/javascript" src="/ie/iepngfix_tilebg.js"></script>
		<style type="text/css">
			.png, #logo a { behavior: url("/ie/iepngfix.htc") }
			#contractmenu li a {margin: 0 0 -17px 0;}
			#maincol {margin-right: 10px;}
			.round .fl, .round .fr {margin-top: -6px;}
			.fieldset1 li, .fieldset2 li {height: 1%; }
			.fieldset1 span, .fieldset2 span {margin-bottom: -10px;}
			.contract-dialog .icon {margin-left: -45px;}
		</style>
	<![endif]-->
	
</head>
<body class="page page-home">
<div id="wrapper">

	<div id="header" class="round round-main <?php if(!@$_SESSION['User']['id']){ ?>corp-website<?php } ?>">
		<div class="content rounded-top">
			<div id="logo"><a href="<?php echo (@$_SESSION['User']['id']?'/dashboard/':'/'); ?>"></a></div>
			<?php if(@$_SESSION['User']['id']){ ?>
			<div id="topmenu">
				<span class="user-name"><a><?php echo (strlen($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']) > 17 ? substr($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname'],0,15).'...' : "{$_SESSION['User']['firstname']} {$_SESSION['User']['lastname']}"); ?></a></span>
				<span class="user-home"><a href="<?php echo (@$_SESSION['User']['id']?'/dashboard/':'/'); ?>">Home</a></span>
				<span class="user-account"><a href="/users/view/">My Account</a></span>
				<span class="user-logout"><a href="#logoutModal" class="show-overlay">Logout</a></span>
			</div><!-- #topmenu -->
			<?php }else{ ?>
			<div id="subtitle">Puentes Online is currently in private beta.</div>
			<a href="#" id="overlayLoginLink" >Login</a>
			<div id="overlayLoginForm" class="rounded">
				<ul class="fieldset2">
					<li>
						<div class="label alignleft">
							<span class="red">*</span> Email
						</div>
						<input type="text" class="inputText" id="loginUser" />
					</li>
					<li>
						<div class="label alignleft">
							<span class="red">*</span> Password
						</div> 
						<input type="password" class="inputText" id="loginPass" />
					</li>
					<li class="errorNotification"><span class="red" id="loginError"> &nbsp; </span></li>
				</ul>
				<div class="clear"></div>

				<a id="overlayForgotPasswordLink" href="#" onclick="send_password_reset();">I forgot my password</a>
				<a href="#" onclick="check_login();" class="btn1 alignright" id="overlaySubmitLoginLink"><span class="inner">Log in</span></a>
				<div class="clear"></div>
			</div>
			<?php } ?>
		</div>
	</div><!-- #header -->
	
	<div id="body">
		<?php echo $content_for_layout ?>
	</div><!-- #body -->


	<div id="modals">
		
		<div style="display: none;">
			<div id="logoutModal">
				<div class="box-heading">
					<span class="icon icon-key"></span>
					<h2 class="page-subtitle label-text">Logout</h2>

				</div>
				<br />
				<p class="caseclubFont18 blue textAlignCenter">Are you sure you want to logout?</p>
				<br /><br /><br />
				<div class="exitSaveOptions">
					<a href="/users/logout/" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Logout</span></a>
					<a href="#" onclick="jQuery.fancybox.close(); return false; " class="btn2 btn-savecontinue aligncenter"><span class="inner">Cancel</span></a>
				</div>
			</div><!-- #logoutModal -->

		</div>

	</div><!-- #modals -->

	<div id="footer">
		<!-- <div class="alignleft" id="logofooter"><a href="/"><img src="/images/logo-footer.png" /></a></div> -->
		<div class="alignright" id="footermenu">
			<ul>
				<li><a href="#">Privacy Policy</a></li>

				<li><a href="#">Terms and Conditions</a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div><!-- #footer -->
</div>
</body>
</html>