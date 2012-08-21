<div id="startbridge-assignment" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-docopen"></span>
		<h2><?php echo __('Select Assignment') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<p><?php echo __('What is the Assignment?') ?></p>
		<ul id="challenges-accordion" class="accordion">
			<li class="alternate">
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'collaboration',state:{type:'assignment',val:'Q'}});"><span><?php echo __('Select') ?></span></a>
					<div style="width: 21px;height: 24px;float:right;background: transparent url(/images/icon_greencheck.png);margin: 6px 12px 0;display:none;" id="question_active"></div>
					<p><?php echo __('Answer Questions') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<p><?php echo __('The Instructor writes a series of (n) questions. Students then answer the questions assigned by the Instructor.') ?></p>
				</div>
			</li>
			<li>
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'collaboration',state:{type:'assignment',val:'E'}});"><span><?php echo __('Select') ?></span></a>
					<div style="width: 21px;height: 24px;float:right;background: transparent url(/images/icon_greencheck.png);margin: 6px 12px 0;display:none;" id="essay_active"></div>
					<p><?php echo __('Write an Essay') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<?php echo __('The Instructor assigns and essay topic to students.') ?>
				</div>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">
if($('#response_types').val()=='Q') $('#question_active').show();
else if($('#response_types').val()=='E') $('#essay_active').show();
setTimeout(function(){
	if($('#response_types').val() == 'E') $("ul.accordion li:last-child .accordion-trigger p").trigger("click"); 
	else $("ul.accordion li:first-child .accordion-trigger p").trigger("click"); 
},50);
</script>