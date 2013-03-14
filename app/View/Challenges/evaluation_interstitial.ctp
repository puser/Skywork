<div id="home-studentwork" class="rounded box-white width50 alignright" style="overflow:hidden;">
	
	<div class="box-head" style="padding-bottom:4px;">
		<span class="icon5 icon5-star"></span>
		<h2 class="page-subtitle"><?php echo __('Student Work') ?></h2>
		<div class="clear"></div>
	</div>
	
	<div class="box-content" style="font-size:16px;color:#00467F;margin:25px;line-height:25px;">
		<?php echo nl2br(__("This assignment is now ready for evaluation. Click Go to Assignment to view a Summary page. This will contain all the completed assignments from your class.")) ?><br /><br /><br />
		
		<a href="/challenges/update/<?php echo $cid; ?>/update_active_status/" class="studentwork-more" id="students-highest-quality-more" style="display: block;text-align: center;padding-top: 10px;font-size:12px;">
			<span style="display: inline-block;padding: 2px 10px 0;margin-left:-10px;"><?php echo __('Go to Assignment') ?></span><img src="/images/arrow-right-red.png" />
		</a>
	</div>
</div>