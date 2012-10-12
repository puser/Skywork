<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
	
	<div class="modal-box-head">
		<span class="icon icon-customize"></span>
		<h2><span><?php echo __('Customize') ?></span></h2>
	</div>
	<div class="modal-box-content" style="font-size:13px;">
		<p>The words below are currently set to create a red flag when they appear too many times in a bridge. Select a word from the list to <strong>edit that word</strong>, or click <strong>Add another</strong> to add a new word to the list.</p>
		
		<div style="border:1px solid #999;padding:5px;min-height:75px;margin:10px 0;">
			<?php foreach($words as $w){ ?>
				<a class="editWordBtn" href="/word_flags/update/<?php echo $w['WordFlag']['word']; ?>"><?php echo $w['WordFlag']['word']; ?></a>,&nbsp;
			<?php } ?>
		</div>
		
		<br />
		Add a word to this list:<br />
		<input type="text" style="margin-bottom:10px;" id="wordInput" value="<?php echo @$word; ?>" /><br />
		
		Create a red flag when a student has written this word the following number of times in a bridge:<br />
		<input type="text" style="width:25px;" id="countInput" value="<?php echo @$count; ?>" /><br /><br />
		
		<div style="width: 210px; margin: 0 auto 20px auto; ">
			<div style="width: 95px; float: left;">
				<a href="" class="btn2" style="width: 100%" id="addWordBtn" onclick="$(this).attr('href','/word_flags/update/'+$('#wordInput').val()+'/'+$('#countInput').val());">
					<span><?php echo __('Add to list') ?></span>
				</a>
			</div>
			<div style="width: 80px; float: right;">
				<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
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