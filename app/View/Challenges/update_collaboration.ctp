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
					<a class="btn1" onclick="$.bbq.pushState({view:'info',state:{type:'collaboration',val:'NONE'}});" id="skip_inactive"><span><?php echo __('Select') ?></span></a>
					<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;" id="skip_active"></div>
					<p><?php echo __('This is a standard assignment') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<p><?php echo __('There is no collaboration in a standard assignment. You will be giving your students an assignment, they will complete it by the Due Date you set, and they will return it back to you.') ?></p>
				</div>
			</li>
			<li>
				<div class="accordion-trigger">
					<a class="btn1" onclick="$.bbq.pushState({view:'info',state:{type:'collaboration',val:'RATE'}});" id="rate_inactive"><span><?php echo __('Select') ?></span></a>
					<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;" id="rate_active"></div>
					<p><?php echo __('I would like my students to collaborate') ?></p>
					<div class="clear"></div>
				</div>
				<div class="accordion-content">
					<p><img src="/images/icons/icon-poll-29x17.png" /> <?php echo __('By allowing student collaboration, after students complete their assignments (Due Date 1), they will be able to write comments and give feedback to each other (Due Date 2).') ?></p>
				</div>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">
if($('#collaboration_type').val()=='RATE'){
	$('#rate_active').show();
	$('#rate_inactive').hide();
	
	$('#skip_active').hide();
	$('#skip_inactive').show();
}else if($('#collaboration_type').val() == 'NONE'){
	$('#rate_inactive').show();
	$('#rate_active').hide();
	
	$('#skip_active').show();
	$('#skip_inactive').hide();
}
setTimeout(function(){
	if($('#collaboration_type').val() == 'RATE') $("ul.accordion li:last-child .accordion-trigger p").trigger("click");
	else $("ul.accordion li:first-child .accordion-trigger p").trigger("click");
},50);
</script>