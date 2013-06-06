<!DOCTYPE html>
<html>
<head>
	<title>Skywork</title>
	
	<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" media="screen" />
	<link type="text/css" rel="stylesheet" media="all" href="/css/style_skywork.css" />
	
	<link rel="icon" type="image/jpeg" href="<?php echo $this->Html->url('/img/favi.jpg', true); ?>">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/jquery.mousewheel.min.js"></script>
	
	<script type="text/javascript" src="/js/cco_ajax.js?v=7" ></script>
	<script type="text/javascript" src="/js/skywork.js"></script>
	
	<script type="text/javascript">
		
		jQuery(document).ready(function() {
			colors = ["page-skyblue", "page-paleblue", "page-purple", "page-brown", "page-green"];
			index = Math.floor((Math.random()*5)+1);
			$bodycolor = colors[index]; 
			console.log(index); 
			$("body").addClass($bodycolor); 

			$('.flatform li.submit').hover(
				function(e) {
					$(this).addClass('checked');
					$(this).attr('text', $(this).find('input').attr('value'));
					$(this).find('input').val('');
				},
				function(e) {
					$(this).removeClass('checked');
					$(this).find('input').val($(this).attr('text'));
				}
			);
		}); 
		
	</script>
	
</head>
<body class="page page-login ">
	
	<?php if(@$_SESSION['User']['id']){ ?>
	<script type="text/javascript"> window.location = '/dashboard/'; </script>
	<?php }else{ ?>
	
	<section id="header">
		<div class="inner">
			<div id="logo">
				<a href="http://getskywork.com"></a>
			</div>
			<nav id="mainmenu">
				<ul>
					<li><a href="http://getskywork.com">About</a></li>
				</ul>
			</nav>
		</div>
	</section>
	
	<section class="splitbg">
		<div class="leftpane"></div>
		<div class="rightpane"></div>
		
		<div id="userform" class="floatingcontent">
			
			<div class="tabs">
				<ul>
					<li class="active"><a href="#" id="signup-form-tab" >Log In</a></li>
					<li><a href="#" id="login-form-tab">Sign Up</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<div id="login-form" class="user-form" style="display: none;">
				<form id="studentJoinData" method="post" class="flatform">
					
					<ul>
						<li>
							<input type="text" name="classtoken" value="class token" onfocus="if($(this).val() == 'class token'){ $(this).val(''); }" onblur="if(!$(this).val()){ $(this).val('class token'); }" />
						</li>
						<li>
							<input type="email" name="login" value="your email" onfocus="if($(this).val() == 'your email'){ $(this).val(''); }" onblur="if(!$(this).val()){ $(this).val('your email'); }" />
							<span class="notif warning"></span>
						</li>
						<li>
							<input type="text" name="tmppwd" value="choose password" onfocus="$(this).parent().hide();$(this).parent().next().show();$('#signupPass').focus();" />
							<span class="notif warning"></span>
						</li>
						<li style="display:none;"><input type="password" name="password" id="signupPass" onblur="if(!$(this).val()){ $(this).parent().hide();$(this).parent().prev().show(); }" /></li>
						<li class="submit"><input type="submit" value="sign up" onclick="check_signup_valid();" /></li>
						
					</ul>
				</form>
				
				<span class="forgot-password" id="emailError2"> &nbsp; </span>
				
			</div>
			
			<div id="signup-form" class="user-form" >
				<form id="loginBoxForm" method="POST" action="/dashboard/" class="flatform">
					
					<ul>
						<li>
							<input type="text" name="loginUser" id="loginUser" value="email" onfocus="if($(this).val() == 'email'){ $(this).val(''); }" onblur="if(!$(this).val()){ $(this).val('email'); }" />
							<span class="notif warning"></span>
						</li>
						<li>
							<input type="text" value="password" onfocus="$(this).parent().hide();$(this).parent().next().show();$('#loginPass').focus();" />
						</li>
						<li style="display:none;">
							<input type="password" name="loginPass" id="loginPass" onblur="if(!$(this).val()){ $(this).parent().hide();$(this).parent().prev().show(); }" />
							<span class="notif warning"></span>
						</li>
						<li class="submit"><input type="submit" onclick="check_login();return false;" value="log in" /></li>
					</ul>
					
				</form>
				
				<span class="red" id="loginError"> &nbsp; </span>
				<p><a class="forgot-password" href="#" onclick="send_password_reset();return false;">forgot your password?</a></p>
			</div>
			
			
		</div>
		
		
	</section>
	
	<span id="siteseal" style="position:absolute;bottom:0;right:3px;"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=PWTxJe4ZNlWlKlFkyKVHp7SdX0N4R35nZSyPdHGIvEuALrfg1H71"></script></span>
	
	<script type='text/javascript'>
	
	function check_signup_valid(){
		if(!$('input[type=email]').first().get(0).validity.valid){
			$('input[type=email]').first().next().show();
			return false;
		}else{
			$('input[type=email]').first().next().hide();
			return true;
		}
	}
	
	$(document).ready(function(e){
	    $('#studentJoinData').submit(function(){
				if(check_signup_valid()){
					$.ajax({url:'/users/login/',data:$('#studentJoinData').serialize(),success:function(r){
						if(r == 'duplicate') $('#emailError2').html('Email already exists in system');
						else if(r == 'bad_token') $('#emailError2').html('Class token not recognized!');
						else window.location = '/users/view/';
					}});
				}
				return false;
			});
	});
	</script>
	
	<?php } ?>
	
</body>
</html>