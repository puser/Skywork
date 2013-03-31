<!DOCTYPE html>
<html>
<head>
	<title>Contact Us - Frequently Asked Questions | Skywork</title>
	
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
			<span class="user-logout icon-key" style="margin-right:0;"><a id="overlayLoginLink2" href="#" style="color:#567aa9;font-size:12px;">Sign in</a></span>
		
			<div id="overlayLoginForm" class="rounded" style="text-align:left;top:20px;right:0px;">
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
				<a href="#" onclick="check_login();" class="btn2 alignright" id="overlaySubmitLoginLink"><span class="inner">Sign In</span></a>

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
					
					<form action="/users/contact/" method="post">
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
								<option value="A question">A question</option>
								<option value="A comment">A comment</option>
								<option value="A complaint">A complaint</option>
								<option value="General feedback">General feedback</option>
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
						<a href="#" class="toggle">Is my class information private?</a>
						<div class="toggle-content">
							<p>Yes, absolutely. Your privacy is of absolute importance to Skywork. Please visit our Privacy Policy for more information. If you have any other questions, shoot us an email via the "Contact Us" form.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Can I use Skywork if our school/institution uses applications like Blackboard and/or others?</a>
						<div class="toggle-content">
							<p>There are lots of free services that are used by Instructors all over the country. Unless your school or college licenses with us, Skywork is an independent service from your institution, and signing up is extremely easy.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Why am I not getting Skywork emails?</a>
						<div class="toggle-content">
							<p>There may be a chance that your emails are going to your spam folder. To avoid this, add info@puentesonline to your safe list. If you are still experiencing problems, please feel free to reach out to us at info@puentesonline.com</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">What is typical troubleshooting for Skywork?</a>
						<div class="toggle-content">
							<p>If you or one of your students experiences some inexplicable issue with Skywork, try these simple troubleshooting methods:</p>
							<ol class="list-arabic">
								<li>Refresh the page (make sure you save any unfinished work first)</li>
								<li>Update your Internet browser to the latest version</li>
								<li>Quit the browser and restart (this is worst case scenario, but it sometimes works)</li>
							</ol>
							<p>If none of these methods work, let us know and we will get back to you ASAP.</p>
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
							<p>Go to the "classes" section found on the top of the application. Then navigate to the "connections" section. There you will find a button labeled "Find an Instructor." Simply add their email address and begin searching.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How often do you update the application?</a>
						<div class="toggle-content">
							<p>We are constantly updating the application to make it better. Therefore, it is important to receive feedback from you, our users. We want to continue providing the best quality product we possibly can.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">Who created Skywork?</a>
						<div class="toggle-content">
							<p>Skywork was originally created by Sean Daly. The first commercially viable product was created in collaboration with Benjamin Rawn and Wifredo Fernandez.</p>
						</div>
					</li>
					<li>
						<a href="#" class="toggle">How do I unsubscribe?</a>
						<div class="toggle-content">
							<p>First off, we would be sad to see you go. But if you must, please send us an email at <a href="mailto:info@puentesonline.com">info@puentesonline.com</a> with UNSUBSCRIBE in the subject. Be sure to include your username, and feel free to add an explanation with why you are leaving us.</p>
						</div>
					</li>
				</ul>
			</div>
			
		</div>
			
		</div>
		
		<?php echo $this->element('footer'); ?><br /><br />
		
	</div>
	
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