<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
	
	<div class="modal-box-head">
		<span class="icon icon-customize"></span>
		<h2><span><?php echo __('Customize') ?></span></h2>
	</div>
	<div class="modal-box-content" style="font-size:13px;">
		<p>The <?php echo ($type != 'PHRASE' ? 'words' : 'phrases'); ?> below are currently set to create a red flag when they appear <?php echo ($type != 'EXPL' ? 'too many times' : ''); ?> in a bridge. Select a <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> from the list to <strong>edit that <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?></strong>, or click <strong>Add another</strong> to add a new <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> to the list.</p>
		
		<div style="border:1px solid #999;padding:5px;min-height:75px;margin:10px 0;">
			<?php foreach($words as $w){ ?>
				<a class="editWordBtn" href="/word_flags/update/<?php echo $w['WordFlag']['word']; ?>"><?php echo $w['WordFlag']['word']; ?></a>,&nbsp;
			<?php } ?>
		</div>
		
		<br />
		<div style="border:3px dashed #ccc;padding:10px;">
			Add a <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> to this list:<br />
			<input type="text" style="margin-bottom:10px;" id="wordInput" value="<?php echo @$word; ?>" /><br />
		
			<?php if($type == 'EXPL'){ ?>
				<input type="hidden" id="countInput" value="1" /><br />
			<?php }else{ ?>
				Create a red flag when a student has written this <?php echo ($type != 'PHRASE' ? 'word' : 'phrase'); ?> the following number of times in a bridge:<br />
				<input type="text" style="width:25px;" id="countInput" value="<?php echo @$count; ?>" />
			<?php } ?>
		</div>
		
		<div style="width: 380px; margin: 15px auto 20px auto; ">
			<div style="width: 175px; float: left; margin-right:15px;	">
				<a href="" class="btn2" style="width: 100%" id="addWordBtn" onclick="$(this).attr('href','/word_flags/update/'+$('#wordInput').val()+'/'+$('#countInput').val()+'/<?php echo $type; ?>?addnew=1');">
					<span><?php echo __('Add to list &amp; add another') ?></span>
				</a>
			</div>
			<div style="width: 95px; float: left; margin-right:15px;	">
				<a href="" class="btn2" style="width: 100%" id="addWordBtn" onclick="$(this).attr('href','/word_flags/update/'+$('#wordInput').val()+'/'+$('#countInput').val()+'/<?php echo $type; ?>');">
					<span><?php echo __('Add to list') ?></span>
				</a>
			</div>
			<div style="width: 80px; float: right; padding-top:7px;">
				<a href="#" onclick="jQuery.fancybox.close(); return false; "><?php echo __('Cancel') ?></a>
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