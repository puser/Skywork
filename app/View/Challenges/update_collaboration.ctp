<div id="startbridge-assignment" class="box-startbridge box-white rounded">
	<div class="box-head">
		<span class="icon2 icon2-cycle"></span>
		<h2><?php echo __('Students Collaborate') ?></h2>
		<div class="clear"></div>
	</div>
	<div class="box-content">
		<p><?php echo __('How will students collaborate on their Assignment?') ?></p>
		<ul id="challenges-accordion" class="accordion">
			<li>
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'info',state:{type:'collaboration',val:'RATE'}});"><span><?php echo __('Select') ?></span></a>
					<div style="width: 21px;height: 24px;float:right;background: transparent url(/images/icon_greencheck.png);margin: 6px 12px 0;display:none;" id="rate_active"></div>
					<p><?php echo __('Rate each other\'s work') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<p><img src="/images/icons/icon-poll-29x17.png" /> <?php echo __('Once students complete their Assignments, students then use a Likert scale to rate and rank each other\'s work.') ?></p>
				</div>
			</li>
		</ul>
		<p>Would you like to skip the student collaboration?</p><br/>
		<a onclick="$.bbq.pushState({view:'info',state:{type:'collaboration',val:'NONE'}});"><u><?php echo __('Skip the student collaboration (you will still be able to grade)') ?></u></a>
	</div>
</div>

<script type="text/javascript">
if($('#collaboration_type').val()=='RATE') $('#rate_active').show();
setTimeout(function(){
	$("ul.accordion li:first-child .accordion-trigger p").trigger("click"); 
},50);
</script>