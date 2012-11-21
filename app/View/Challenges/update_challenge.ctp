<div id="startbridge-challenge" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-docinspect"></span>
		<h2><?php echo __('Select a Challenge') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<p><?php echo __('What are you challenging your students to? Please select one of the following and continue.') ?></p>
		<ul id="challenges-accordion" class="accordion">
			<li class="alternate">
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'assignment',state:{type:'challenge',val:'DOC'}});" id="doc_inactive"><span><?php echo __('Select') ?></span></a>
					<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;" id="doc_active"></div>
					<p><?php echo __('Read a Document') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<img src="/images/icons/icon-doc-21x26.png" /> 	<?php echo __('In this challenge, the Instructor assigns a document for students to watch. In the Information section you will browse for your document.') ?>
				</div>
			</li>
			<li>
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'assignment',state:{type:'challenge',val:'VID'}});" id="vid_inactive"><span><?php echo __('Select') ?></span></a>
					<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;" id="vid_active"></div>
					<p><?php echo __('Watch a YouTube video') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<img src="/images/icons/icon-movieclip-23x29.png" /> <?php echo __('In this challenge, the Instructor assigns a YouTube video for students to watch. In the Information section you will copy and paste the YouTube link.') ?>
				</div>
			</li>
		</ul>
	</div><br />
	
	<div class="box-content">
		<p><?php echo __('Is your challenge offline?') ?></p>
		<a id="offlineChallengeLink" onclick="return false;" href="#"><u><?php echo __("I'm assigning my challenge offline (e.g. the reading is in a textbook)") ?></u></a>
		<div id="offlineChallengeInput" style="display:none;">
			<input type="text" value="Describe the Challenge (e.g. Read pages 145 - 173 in your textbook)...">
			<a href="#" onclick="$.bbq.pushState({view:'info',state:{type:'challenge',val:'OFFLINE'}});">
		</div>
	</div>
</div>

<script type="text/javascript">
if($('#challenge_type').val()=='DOC'){
	$('#doc_active').show();
	$('#doc_inactive').hide();
	
	$('#vid_active').hide();
	$('#vid_inactive').show();
}else if($('#challenge_type').val()=='VID'){
	$('#vid_active').show();
	$('#vid_inactive').hide();
	
	$('#doc_inactive').show();
	$('#doc_active').hide();
}

setTimeout(function(){
	if($('#challenge_type').val() == 'VID') $("ul.accordion li:last-child .accordion-trigger p").trigger("click"); 
	else $("ul.accordion li:first-child .accordion-trigger p").trigger("click"); 
},50);
</script>