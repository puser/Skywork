<div id="home-studentwork" class="rounded box-white width50 alignright" style="overflow:hidden;">
	
	<div class="box-head ">
		<span class="icon5 icon5-star"></span>
		<h2 class="page-subtitle">Group Activity</h2>
		<div class="clear"></div>
	</div>
	
	<div class="box-content">
		
		
		<table id="students-active-questions" class="table-type-1">
			<thead>
				<tr>
					<th class="col1" width="70%">Group Members <span style="color: #666666; margin-left: 30px;"><?php echo date_format(date_create(),'m/d/Y'); ?></span></th>
					<th class="col2" width="10%"><img src="/images/icons/icon-like-19x21.png" /></th>
					<th class="col3" width="10%">
						<div class="tooltip-wrap">
							<img src="/images/icons/icon-like2-20x20.png" />
							<a href="#" title="this is a tooltip" class="tooltip-mark tooltip-mark-question"></a>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!$users){ ?>
				<tr><td colspan="3">Not enough data exists to display details for this challenge</td></tr>
			<?php }
			$k = 0;
			$current = false;
			foreach($users as $n=>$r){
				$k++;
				if($n == $_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']) $current = true;
				// elseif($challenge['Challenge']['challenge_type'] == 'A') $n = 'Anonymous User #'.($current ? $k - 1 : $k);
				?>
				<tr<?php if($k%2){ ?> class="alternate"<?php } ?>>
					<td class="col1"><?php echo $k; ?>. <?php echo $n; ?></td>
					<td class="col2"><?php echo ($r[1]); ?></td>
					<td class="col3"><?php echo ($r[0]); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
	</div>
</div><!-- #home-leaderboard -->