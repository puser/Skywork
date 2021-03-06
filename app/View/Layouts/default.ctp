<!DOCTYPE html>
<html>
<head>
	<title>Skywork</title>
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" media="screen" />
	<link rel='stylesheet' media="all" href="/js/jquery-ui/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" media="all" href="/js/mcs/jquery.mCustomScrollbar.css" />
	<link rel="stylesheet" href="/js/annotator/annotator.min.css">
	<link rel="icon" type="image/jpeg" href="http://getskywork.com/images/favi.png">
	<link type="text/css" rel="stylesheet" media="all" href="/css/style.css?v=6" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="/js/jquery.flip.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ba-bbq.min.js"></script>
	<script type="text/javascript" src="/js/jquery.atd.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="/css/atd.css" />
	<script type="text/javascript" src="/js/csshttprequest.js"></script>
	<script type="text/javascript" src="/js/mcs/jquery.mCustomScrollbar.js"></script>
	
	<!-- <script type="text/javascript" src="/js/textAnnotater.js?v=2"></script> -->
	<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
	<script src="/js/annotator/annotator-full.min.js"></script>
	
	<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>

	<script type="text/javascript" src="/js/custom.js" ></script>
	<script type="text/javascript" src="/js/cco_ajax.js?v=8" ></script>
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
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
<body class="page page-home <?php if($this->request->params['controller'] == 'users' || $this->request->params['controller'] == 'comment_libraries'){ ?>page-mooc<?php } ?>">
<div id="wrapper">

	<div id="header" class="round round-main <?php if(!@$_SESSION['User']['id']){ ?>corp-website<?php } ?>">
		<div class="content rounded-top">
			<div id="logo"><a <?php if($this->request->params['controller'] == 'challenges' && $this->request->params['action'] == 'view'){ ?>href="#modalExitChoices" class="show-overlay" <?php }else{ ?>href="<?php echo (@$_SESSION['User']['id']?'/dashboard/':'/'); ?> <?php } ?>"></a></div>
			<?php if(@$_SESSION['User']['id']){ ?>
			<div id="topmenu">
				<span class="user-name"><a>
				<?php 
					if($_SESSION['User']['firstname'] != ''){
						echo (strlen($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']) > 17 ? substr($_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname'],0,15).'...' : "{$_SESSION['User']['firstname']} {$_SESSION['User']['lastname']}");
					}else{
						echo $_SESSION['User']['email'];
					}?></a></span>
				<span class="user-home"><a <?php if($this->request->params['controller'] == 'challenges' && $this->request->params['action'] == 'view'){ ?>href="#modalExitChoices" class="show-overlay" <?php }else{ ?>href="<?php echo (@$_SESSION['User']['id']?'/dashboard/':'/'); ?>" <?php } ?>><?php echo __('Home') ?></a></span>
				<span class="user-account"><a <?php if($this->request->params['controller'] == 'challenges' && $this->request->params['action'] == 'view'){ ?>href="#modalExitChoices" class="show-overlay" <?php }else{ ?>href="/users/view/" <?php } ?>><?php echo __('Account') ?></a></span>
				<span class="user-logout" style="padding-right:5px;"><img src="/images/icon-logout.png" style="padding-left:15px;vertical-align:middle;padding-bottom:3px;cursor:pointer;" onmouseover="$(this).next().show();" /><a style="display:none;" href="#logoutModal" class="show-overlay" onmouseout="$(this).hide();"><?php echo __('Logout') ?></a></span>
			</div><!-- #topmenu -->
			<?php }else{ ?>
			<div id="subtitle"><?php echo __('Skywork Online is currently in private beta.') ?></div>
			<a href="#" id="overlayLoginLink" ><?php echo __('Login') ?></a>
			<div id="overlayLoginForm" class="rounded">
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
			<?php } ?>
		</div>
	</div><!-- #header -->
	
	<div id="body">
		<?php echo $content_for_layout ?>
	</div><!-- #body -->


	<div id="modals">
		
		<div style="display: none;">
			<div id="logoutModal" style="width:440px;height:190px;">
				<div class="modal-box-head" style="margin-bottom:30px;">
					<h2 class="page-subtitle label-text" style="margin-bottom:0px;line-height:24px;color:#c95248;"><span class="icon5 icon5-key" style="margin:0;height:24px;width:50px;"></span><?php echo __('Logout') ?></h2>
				</div>

				<div class="modal-box-content">
					<div style="text-align:center;margin:20px;"><p class="caseclubFont18 blue textAlignCenter"><?php echo __('Are you sure you want to logout?') ?></p></div>
					<br />
					<div style="width: 335px; margin: 0 auto; ">
						<a href="/users/logout/" style="float:left;width:130px;margin-right:57px;" class="btn2 btn-savecontinue aligncenter"><span class="inner"><?php echo __('Yes, Logout') ?></span></a>
						<a onclick="jQuery.fancybox.close();return false;" class="btn3 btn-savecontinue aligncenter" style="float:left;width:130px;"><span class="inner"><?php echo __('Cancel') ?></span></a>
					</div>
				</div>
			</div><!-- #logoutModal -->
		</div>

	</div><!-- #modals -->

	<div id="footer">
		<!-- <div class="alignleft" id="logofooter"><a href="/"><img src="/images/logo-footer.png" /></a></div> -->
		<div class="alignright" id="footermenu">
			<ul>
				<li><a href="/challenges/viewpdf/Privacy-Policy.pdf" class="show-overlay"><?php echo __('Privacy Policy') ?></a></li>
				<li><a href="/challenges/viewpdf/Terms-of-Use.pdf" class="show-overlay"><?php echo __('Terms of Use') ?></a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div><!-- #footer -->
</div>

<?php if(!stristr($_SERVER['SERVER_NAME'],'edge') && !stristr($_SERVER['SERVER_NAME'],'staging')){ ?>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-34919643-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
<?php } ?>
</body>
</html>