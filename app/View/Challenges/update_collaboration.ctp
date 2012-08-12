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
					<p><?php echo __('Rate each other\'s work') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<p><img src="/images/icons/icon-poll-29x17.png" /> <?php echo __('Once students complete their Assignments, students then use a Likert scale to rate and rank each other\'s work.') ?></p>
				</div>
			</li>
		</ul>
		
		<a onclick="$.bbq.pushState({view:'info',state:{type:'collaboration',val:'NONE'}});"><?php echo __('I want to skip the student collaboration') ?></a>
	</div>
</div>