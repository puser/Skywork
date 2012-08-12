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
					<a class="btn1" onclick="$.bbq.pushState({view:'assignment',state:{type:'challenge',val:'DOC'}});"><span><?php echo __('Select') ?></span></a>
					<p><?php echo __('Read a Document') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<img src="/images/icons/icon-doc-21x26.png" /> 	<?php echo __('In this challenge, the Instructor assigns a document for students to watch. In the Information section you will browse for your document.') ?>
				</div>
			</li>
			<li>
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'assignment',state:{type:'challenge',val:'VID'}});"><span><?php echo __('Select') ?></span></a>
					<p><?php echo __('Watch a YouTube video') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<img src="/images/icons/icon-movieclip-23x29.png" /> <?php echo __('In this challenge, the Instructor assigns a YouTube video for students to watch. In the Information section you will copy and paste the YouTube link.') ?>
				</div>
			</li>
		</ul>
	</div>
</div>