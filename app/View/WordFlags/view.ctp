<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
	
	<div class="modal-box-head">
		<span class="icon icon-customize"></span>
		<h2><span><?php echo __('Customize') ?></span></h2>
	</div>
	<div class="modal-box-content">
		<p style="font-size:13px;">The <?php echo ($type != 'PHRASE' ? 'words' : 'phrases'); ?> below are currently set to create a red flag when they appear <?php echo ($type != 'EXPL' ? 'too many times' : ''); ?> in a bridge. Select a <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> from the list to <strong>edit that <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?></strong>, or click <strong>Add another</strong> to add a new <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> to the list.</p>
		
		<div style="border:1px solid #999;padding:5px;min-height:75px;margin:10px 0;">
			<?php foreach($words as $w){ ?>
				<a class="editWordBtn" href="/word_flags/update/<?php echo $w['WordFlag']['word']; ?>?type=<?php echo $type; ?>"><?php echo ($type == 'EXPL' ? substr($w['WordFlag']['word'],0,1) . str_repeat('*',strlen($w['WordFlag']['word']) - 1) : $w['WordFlag']['word']); ?></a>,&nbsp;
			<?php } ?>
		</div>
		
		<a class="icon4 icon4-plus" id="addWordBtn" href="/word_flags/update/?type=<?php echo $type; ?>" style="padding:5px 5px 5px 25px;background-repeat:no-repeat;background-position:left center;display:block;">
			Add another <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?>
		</a>
		
		<div style="width: 90px; margin: 10px auto 20px auto; ">
			<div style="width: 80px; float: right;">
				<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Close') ?></span></a>
			</div>
			<div class="clear"></div>
	</div>
</div>

<script type="text/javascript"> 
$('#addWordBtn,.editWordBtn').fancybox({
	'hideOnOverlayClick' : false,
	'showCloseButton' : false,
	'centerOnScroll' : true
});
</script>