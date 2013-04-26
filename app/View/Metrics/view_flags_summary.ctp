<p style="font-size:14px;padding-bottom:5px;">Flags</p>

<table id="metrics-students-analysis" class="table-type-1">
<tbody>
	<?php 
	$k = 0;
	if(@$user_flags[$user_id]){
		foreach(@$user_flags[$user_id] as $f=>$c){
			foreach($c as $word=>$count){
				$k++; ?>
				<tr class="flag_details" <?php if(($k % 2)){ ?>style="background:#eee;"<?php } ?> onmouseover="$(this).find('.studentwork-more').show();" onmouseout="$(this).find('.studentwork-more').hide();">
					<td class="col1" width="122"><?php echo ($f == 'WORD' ? 'Word Overuse' : ($f == 'EXPL' ? 'Explicit Language' : 'Phrase Flag')); ?></td>
					<td class="col3"><?php echo ($f == 'EXPL' ? substr($word,0,1) . str_repeat('*',strlen($word) - 1) : $word); ?></td>
					<td class="col5" align="right" style="width:20px;">
						<a href="/word_flags/browse/<?php echo $user_id; ?>/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $f; ?>/<?php echo $word; ?>?redirect=<?php echo $user_id; ?>" class="studentwork-more" id="students-highest-quality-more" style="display:none;margin-left:0;">
							<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;"></span>
						</a>
					</td>
				</tr>
	<?php }}}if(@$maxwords_flag[$user_id]){ $k++; ?>
		<tr class="flag_details" <?php if(($k % 2)){ ?>style="background:#eee;"<?php } ?> onmouseover="$(this).find('.studentwork-more').show();" onmouseout="$(this).find('.studentwork-more').hide();">
			<td class="col1">Assignment Maximum</td>
			<td class="col3"><?php echo $maxwords_flag[$user_id]['words']; ?> over maximum allowed</td>
			<td class="col5" align="right">
				<a href="/word_flags/browse/<?php echo $user_id; ?>/<?php echo $challenge['Challenge']['id']; ?>/MAX?redirect=<?php echo $user_id; ?>" class="studentwork-more" id="students-highest-quality-more" style="display:none;margin-left:0;">
					<img src="/images/arrow-right-red.png">
				</a>
			</td>
		</tr>
		<?php }if(@$minwords_flag[$user_id]){ $k++; ?>
			<tr class="flag_details" <?php if(($k % 2)){ ?>style="background:#eee;"<?php } ?> onmouseover="$(this).find('.studentwork-more').show();" onmouseout="$(this).find('.studentwork-more').hide();">
				<td class="col1">Assignment Minimum</td>
				<td class="col3"><?php echo $minwords_flag[$user_id]['words']; ?> under minimum allowed</td>
				<td class="col5" align="right">
					<a href="/word_flags/browse/<?php echo $user_id; ?>/<?php echo $challenge['Challenge']['id']; ?>/MIN?redirect=<?php echo $user_id; ?>" class="studentwork-more" id="students-highest-quality-more" style="display:none;margin-left:0;">
						<img src="/images/arrow-right-red.png">
					</a>
				</td>
			</tr>
		<?php } ?>
</tbody>
</table>

<a href="/word_flags/browse/<?php echo $user_id; ?>/<?php echo $challenge['Challenge']['id']; ?>/?redirect=<?php echo $user_id; ?>" style="float:right;padding-right:10px;padding-bottom:15px;color:#cc4f57;">All <img src="/images/arrow-right-red.png" style="padding-left:8px;" /></a>