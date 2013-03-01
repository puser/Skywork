<!DOCTYPE html>
<html>
<head>
	<title>Puentes</title>
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel='stylesheet' media="all" href="/js/jquery-ui/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" media="all" href="/js/mcs/jquery.mCustomScrollbar.css" />
	<?php echo $this->Html->meta('favicon.ico',    '/favicon.ico',    array('type' => 'icon'));?> 
	<link type="text/css" rel="stylesheet" media="all" href="/css/style.css?v=6" />

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
<body class="page page-home">
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
				<span class="user-home"><a <?php if($this->request->params['controller'] == 'challenges' && $this->request->params['action'] == 'view'){ ?>href="#modalExitChoices" class="show-overlay" <?php }else{ ?>href="/users/view/classes/"<?php } ?>><?php echo __('Classes') ?></a></span>
				<span class="user-account"><a <?php if($this->request->params['controller'] == 'challenges' && $this->request->params['action'] == 'view'){ ?>href="#modalExitChoices" class="show-overlay" <?php }else{ ?>href="/users/view/" <?php } ?>><?php echo __('Account') ?></a></span>
				<span class="user-logout" style="padding-right:5px;"><img src="/images/icon-logout.png" style="padding-left:15px;vertical-align:middle;padding-bottom:3px;cursor:pointer;" onmouseover="$(this).next().show();" /><a style="display:none;" href="#logoutModal" class="show-overlay" onmouseout="$(this).hide();"><?php echo __('Logout') ?></a></span>
			</div><!-- #topmenu -->
			<?php }else{ ?>
			<div id="subtitle"><?php echo __('Puentes Online is currently in private beta.') ?></div>
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

<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('9224-183-10-7731');/*]]>*/</script><noscript><a href="https://www.olark.com/site/9224-183-10-7731/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->
</body>
</html>