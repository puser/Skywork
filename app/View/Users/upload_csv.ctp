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
	<script type="text/javascript" src="/js/cco_ajax.js?v=7" ></script>
	
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
<body class="page page-home" style="background:#fff;">
	<?php if(@$result){ ?>
		
		<script type="text/javascript">
			<?php if($result == 'success'){ ?>
				parent.upload_success();
			<?php elseif($result == 'none'){ ?>
				parent.upload_failure(<?php echo $class_id; ?>);
			<?php }else{ ?>
				parent.upload_partial('<?php echo $result; ?>','<?php echo $pending; ?>',<?php echo $class_id; ?>);
			<?php } ?>
		</script>
		
	<?php }else{ ?>
		
		<form method="POST" id="csvForm" action="/users/import_class/<?php echo $class_id; ?>" enctype="multipart/form-data">
			<input type="file" name="import" /> &nbsp; <img src="/images/loadingWheel.gif" style="display:none;" />
		</form>
	
		<div style="width: 180px; margin: 0 auto;text-align:center; ">			
			<a href="#" class="btn2" style="width: 160px;" onclick="$('#csvForm img').show();$('#csvForm').submit();"><span><?php echo __('Upload & Send') ?></span></a>
			<div class="clear"></div>
		</div>
		
	<?php } ?>
</body>
</html>