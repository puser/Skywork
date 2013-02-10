<div id="home-studentwork" class="rounded box-white width50 alignright" style="overflow:hidden;">
	
	<div class="box-head" style="padding-bottom:4px;">
		<span class="icon5" style="background-image: url('/images/icons/icon-pen-23x23.png');"></span>
		<h2 class="page-subtitle"><?php echo __('Assignment in Progress') ?></h2>
		<div class="clear"></div>
	</div>
	
	<div class="box-content" style="font-size:16px;color:#00467F;margin:25px;line-height:25px;">
		<?php echo nl2br(__("Your students are currently finishing their assignment.\n\nHowever, you may view certain information (such as who has completed the assignment so far) or edit the assignment and send it back to students. To do that, click on the link below.")) ?><br /><br /><br />
		
		<a href="/challenges/update/<?php echo $cid; ?>/update_active_status/" class="studentwork-more" id="students-highest-quality-more" style="display: block;text-align: center;padding-top: 10px;font-size:12px;">
			<span style="display: inline-block;padding: 2px 10px 0;margin-left:-10px;"><?php echo __('Go To Edit Assignment') ?></span><img src="/images/arrow-right-red.png" />
		</a>
	</div>
</div>