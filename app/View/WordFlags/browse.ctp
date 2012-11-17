<style type="text/css">
#browserNav {
	position:fixed;
	width:1010px;
	margin:5px;
	background:#e6e6e6;
	top:0;
	z-index:1000;
	height:26px;
	border:3px solid #aaaaaa;
	border-radius: 5px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
}
#browserNav .left {
	background:#e6e6e6 url(/images/flag_spacer.png) top right no-repeat;
	float:left;
	width:180px;
	text-align:center;
	height:26px;
	line-height:26px;
}
#browserNav .right {
	float:right;
	background:#ecf4fb;
	text-align:center;
	height:26px;
	width:830px;
	line-height:26px;
	position:relative;
}
#flagBackBtn {
	width:10px;
	height:14px;
	display:block;
	position:absolute;
	left:40px;
	top:5px;
	background:url(/images/flag_back.png) top left no-repeat;
}
#flagFwdBtn {
	width:10px;
	height:14px;
	display:block;
	position:absolute;
	right:40px;
	top:5px;
	background:url(/images/flag_fwd.png) top left no-repeat;
}
#flagCloseBtn {
	top:-5px;
	right:10px;
	position:absolute;
}
#flagFwdBtn.returnMetrics {
	background:url(/images/flag_close.png) top left no-repeat;
	width:15px;
	height:14px;
	right:55px;
}

#flagRewindBtn {
	width:14px;
	height:14px;
	display:block;
	position:absolute;
	left:40px;
	top:5px;
	background:url(/images/flag_ff_back.png) top left no-repeat;
}

#flagFastFwdBtn {
	width:14px;
	height:14px;
	display:block;
	position:absolute;
	right:22px;
	top:5px;
	background:url(/images/flag_ff_fwd.png) top left no-repeat;
}
</style>

<div id="browserNav">
	<div class="left">
		<div style="display:inline-block;width:15px;height:13px;background:url(/images/icons/icon-flag-15x30.png) top left no-repeat;padding-right:6px;"></div>
		Red Flag Wizard
	</div>
	<div class="right">
		<a id="flagRewindBtn" href="<?php echo $prev_user; ?>" style="display:none;"> </a>
		<a id="flagBackBtn" href="#" onclick="current_flag--;show_flag(flag_redirects[current_flag]);"> </a>
		(<span id="currentFlag">1</span> of <?php echo count($flag_redirects); ?>)
		<?php echo $username; ?>,
		<span id="currentFlagType"></span>
		<a id="flagMetricsBtn" href="/metrics/view/flags/"> </a>
		<a id="flagFwdBtn" href="#" onclick="current_flag++;show_flag(flag_redirects[current_flag]);"> </a>
		<a id="flagFastFwdBtn" href="<?php echo $next_user; ?>" style="display:none;"> </a>
		<a id="flagCloseBtn" onclick="close_nav();" href="#"><strong>x</strong></a>
	</div>
</div>
<div id="summaryContent"> </div>
<div id="inlineFlagIcon" style="background:url('/images/icons/icon-flag-15x30.png') top left no-repeat;width:15px;height:13px;position:fixed;margin-left:200px;"> </div>

<script type="text/javascript">
var current_flag = 0;

var flag_redirects = new Array;
<?php foreach($flag_redirects as $r){ ?>flag_redirects.push('<?php echo $r; ?>');<?php } ?>

var flag_types = new Array;
<?php foreach($flag_types as $r){ ?>flag_types.push('<?php echo $r; ?>');<?php } ?>

$(document).ready(function(){
	show_flag('<?php echo $flag_redirects[0]; ?>');
});

function show_flag(url){
	if(current_flag > <?php echo (count($flag_redirects) - 1); ?>) window.location = '/metrics/view_flags/<?php echo $challenge_id; ?>';
	else{
		$('#inlineFlagIcon').hide();
		$('#wrapper').css('margin-top',0);
		$('#summaryContent').html('');
		$('#summaryContent').load(url,function(){
			setTimeout(function(){
				new_height = $(window).height()-(-$('#activeFlag').offset().top + 150);
				$('#wrapper').css('margin-top',-$('#activeFlag').offset().top + 150);
				$('#wrapper').height(new_height);
				$('#inlineFlagIcon').show();
				$('#inlineFlagIcon').css('top',$('#activeFlag').offset().top);
			},25);
		});
		$('#wrapper').css({'overflow':'hidden','position':'relative'});
		
		$('#currentFlag').html(current_flag+1);
		$('#currentFlagType').html(flag_types[current_flag]);
	
		if(current_flag == <?php echo (count($flag_redirects) - 1); ?>){
			$('#flagFwdBtn').addClass('returnMetrics');
			<?php if($next_user){ ?>
				$('#flagFastFwdBtn').show();
			<?php } ?>
		}else{
			$('#flagFwdBtn').removeClass('returnMetrics');
			$('#flagFastFwdBtn').hide();
		}
	
		if(!current_flag){
			$('#flagBackBtn').hide();
			<?php if($prev_user){ ?>
				$('#flagRewindBtn').show();
			<?php } ?>
		}else{
			$('#flagBackBtn').show();
			$('#flagRewindBtn').hide();
		}
	}
}

function close_nav(){
	$('#browserNav').hide();
	$('#wrapper').css({'height':'auto','margin-top':0});
	
	$('#wrapper').append('<a id="flagReturnBtn">Back to Wizard</a>');
	$('#inlineFlagIcon').css({'top':$('#activeFlag').offset().top,'position':'absolute'});
	$('#flagReturnBtn').css({'position':'absolute','top':$('#activeFlag').offset().top,'margin-left':'110px'});
	
	$('#flagReturnBtn').click(function(){
		$('#browserNav').show();
		show_flag(flag_redirects[current_flag]);
		$('#flagReturnBtn').remove();
		$('#inlineFlagIcon').css('position','fixed');
	});
}
</script>