<div class="head"><div class="tl"></div><div class="tr"></div></div>
<div class="body">
	<div class="body-r">
		<div class="content">
			<div class="box-heading">
				<span class="icon icon-star"></span>
				<?php if(@$_REQUEST['permitStats']){ ?>
					<select style="margin-left: 50px;margin-top: 9px;" onchange="if($(this).val()) flip_details(<?php echo $challenge['Challenge']['id']; ?>,'stats');">
						<option value="">Leaderboard</option>
						<option value="stats">My Statistics</option>
					</select>
				<?php }else{ ?>
					<h2 class="page-subtitle">Leaderboard</h2>
				<?php } ?>
			</div>
			
			<div id="leaderboard-current-standings" class="caseclub-table">
				<div class="cl-head">
					<ul>
						<li class="col1"><a style="text-decoration:none !important;">Current Top 10</a> <?php echo date_format(date_create(),'m/d/Y'); ?></li>

						<li class="col6">
							<a href="#">Score </a>
							<a href="#" class="tooltip-q">
								<span class="tooltip-q-text">Agree vs Disagree Ratio</span>
							</a>
						</li>
					</ul>
					<div class="clear"></div>

				</div>
				<div class="cl-body">
					<?php if(!$users) echo "Not enough data exists to display details for this challenge."; ?>
					<ul>
						<?php
						$k = 0;
						$current = false;
						foreach($users as $n=>$r){
							$k++;
							if($n == $_SESSION['User']['firstname'].' '.$_SESSION['User']['lastname']) $current = true;
							// elseif($challenge['Challenge']['challenge_type'] == 'A') $n = 'Anonymous User #'.($current ? $k - 1 : $k);
							?>						
						<li<?php if($k%2){ ?> class="alternate"<?php } ?>>
							<div class="col1 alignleft"><?php echo $k; ?>. <?php echo $n; ?></div>
							<div class="col6 alignleft score-count"> <?php echo ($r * 5); ?> </div>
							<div class="clear"></div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div><!-- #leaderboard-current-standings -->
			
		</div>
	</div>
</div>
<div class="foot"><div class="fl"></div><div class="fr"></div></div>