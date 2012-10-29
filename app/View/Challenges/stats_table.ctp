<div id="home-studentwork" class="rounded box-white width50 alignright" style="overflow:hidden;">
	
	<div class="box-head" style="padding-bottom:4px;">
		<span class="icon5 icon5-star"></span>
		<h2 class="page-subtitle"><?php echo __('Student Work') ?></h2>
		<span class="due-date"><?php echo __('Due Date 2:') ?> <?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?></span>
		<div class="clear"></div>
	</div>
	
	<div class="box-content">
		
		<?php
		$now = date_create();
		$now->setTime(0,0);
		if($quality){ ?>
			<table id="students-highest-quality" class="table-type-1">
				<thead>
					<tr>
						<th class="col1"><span class="blue"><?php echo __('Students with highest quality work') ?></span></th>
						<th class="col2" width="30%">
							<select onchange="selection = $(this).val();$('#home-leaderboard .box-content').fadeOut('normal',function(){ $('#home-leaderboard').load('/challenges/view/<?php echo $challenge['Challenge']['id']; ?>/stats?filter_quality='+selection,function(){ $('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});$('#home-studentwork').width(470); }); });">
								<option value=""><?php echo __('According to You and Groups') ?></option>
								<option value="I"<?php if(@$_REQUEST['filter_quality'] == 'I') echo ' selected="selected"'; ?>><?php echo __('According to You') ?></option>
								<option value="G"<?php if(@$_REQUEST['filter_quality'] == 'G') echo ' selected="selected"'; ?>><?php echo __('According to Groups') ?></option>
							</select>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$idx = 0;
					foreach($quality as $k=>$q){
						$idx++;
						if($idx > 8) break;
						?>
						<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
							<td class="col1"><?php echo $idx; ?>. <?php echo $k; ?></td>
							<td class="col2"></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?>
				<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
					<a href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>" class="studentwork-more" id="students-highest-quality-more" style="display: block;text-align: center;padding-top: 10px;">
						<img src="/images/graph-tiny.png" class="graphIcon" style="position: relative;top: 5px;" />
						<span style="display: inline-block;padding: 2px 10px 0;" class="metrics-arrow-hide"><?php echo __('Go To Metrics') ?></span><img class="metrics-arrow-hide" src="/images/arrow-right-red.png" />
					</a>
				<?php }else{ ?>
					<a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/0" class="studentwork-more" id="students-highest-quality-more" style="display: block;text-align: center;padding-top: 10px;">
						<img src="/images/graph-tiny.png" class="graphIcon" style="position: relative;top: 5px;" />
						<span style="display: inline-block;padding: 2px 10px 0;"><?php echo __('Go To Summary') ?></span><img src="/images/arrow-right-red.png" />
					</a>
				<?php } ?>
			<?php } ?>
		<?php } ?>
		
		<!-- DEPRECIATED PER v1.1.1b
		
		<table id="students-active-questions" class="table-type-1">
			<thead>
				<tr>
					<th class="col1" width="70%"><span class="blue"><?php echo __('Most active questions:') ?></span></th>
					<th class="col2" width="10%"><img src="/images/icons/icon-like-19x21.png" /></th>
					<th class="col3" width="10%">
						<div class="tooltip-wrap">
							<img src="/images/icons/icon-like2-20x20.png" />
							<a href="#" title="<?php echo __('Likes vs dislikes for their work') ?>" class="tooltip-mark tooltip-mark-question"></a>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idx = 0;
				foreach($activity as $k=>$a){
					$idx++;
					if($idx > 6) break;
					?>
					<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
						<td class="col1"><?php echo $idx; ?>. <?php echo $k; ?></td>
						<td class="col2"><?php echo $a[1]; ?></td>
						<td class="col3"><?php echo $a[0]; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?>
		<a href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>" class="studentwork-more" id="students-active-questions-more">
			<img src="/images/arrow-right-red.png" /> <span><?php echo __('More Info') ?></span>
		</a>
		<?php } ?>
		-->
		
	</div>
</div><!-- #home-leaderboard -->