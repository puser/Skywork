<div id="home-studentwork" class="rounded box-white width50 alignright">
	
	<div class="box-head ">
		<span class="icon5 icon5-star"></span>
		<h2 class="page-subtitle">Student Work</h2>
		<span class="due-date">Due Date 2: <?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?></span>
		<div class="clear"></div>
	</div>
	
	<div class="box-content">
		
		<table id="students-highest-quality" class="table-type-1">
			<thead>
				<tr>
					<th class="col1"><span class="blue">Students with highest quality work</span></th>
					<th class="col2" width="30%"><select >
							<option value="">According to You and Groups</option>
							<option value="">According to You</option>
							<option value="">According to Groups</option>
						</select>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idx = 0;
				foreach($quality as $k=>$q){
					$idx++;
					?>
					<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
						<td class="col1"><?php echo $idx; ?>. <?php echo $k; ?></td>
						<td class="col2"></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<a href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>" class="studentwork-more" id="students-highest-quality-more">
			<img src="/images/arrow-right-red.png" /> <span>More Info</span>
		</a>
		
		<table id="students-active-questions" class="table-type-1">
			<thead>
				<tr>
					<th class="col1" width="70%"><span class="blue">Most active questions:</span></th>
					<th class="col2" width="10%"><img src="/images/icons/icon-like-19x21.png" /></th>
					<th class="col3" width="10%"><img src="/images/icons/icon-like2-20x20.png" /></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idx = 0;
				foreach($activity as $k=>$a){
					$idx++;
					?>
					<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
						<td class="col1"><?php echo $idx; ?>. <?php echo $k; ?></td>
						<td class="col2"><?php echo $a[1]; ?></td>
						<td class="col3"><?php echo $a[0]; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<a href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>" class="studentwork-more" id="students-active-questions-more"><img src="/images/arrow-right-red.png" /> <span>More Info</span></a>
		
	</div>
</div><!-- #home-leaderboard -->