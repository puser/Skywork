<div style="float:left;">
	<p><?php echo __('Comments and Corrections') ?></p>
	
	<table>
		<?php
		$k = 0;
		foreach($challenge['Question'] as $q){
			foreach($q['Response'] as $r){
				foreach($r['Comment'] as $c){ ?>
				<tr <?php if($k % 2){ ?>class="alternate"<?php } ?>>
					<td width="80%" align="left"><?php echo substr($c['comment'],0,25); ?>...</td>
					<td width="20%" class="col5">
						<a href="/responses/view/<?php echo $challenge_id; ?>/<?php echo $grade['User']['id']; ?>?notips=1" class="studentwork-more userLevelLink" id="students-highest-quality-more" style="display:none;margin-left:0;">
							<img src="/images/arrow-right-red.png"> <span style="display:inline;color:#cd5257;"><?php echo __('View'); ?></span>
						</a>
					</td>
				</tr>
				<?php
				$k++;
				}
			}
		} ?>
	</table>
</div>
<div style="float:right;">
	<form id="gradeData">
		<input type="hidden" name="grade[challenge_id]" value="<?php echo $challenge_id; ?>" />
		<input type="hidden" name="grade[user_id]" value="<?php echo $user_id; ?>" />
		<input type="hidden" name="grade[id]" value="<?php echo @$grade['Grade']['id']; ?>" />
		
		<p>Grade &nbsp; <input type="text" name="grade[grade]" value="<?php echo @$grade['Grade']['grade']; ?>" /></p>
		<textarea name="grade[comments]"><?php echo ($grade ? $grade['Grade']['comments'] : __('Additional comments for student')); ?></textarea>
	
		<a href="#" onclick="save_eval();return false;" class="btn2">
			<span><?php echo __('Save, Next Student') ?></span>
		</a>
	</form>
</div>

<script type="text/javascript">
function save_eval(){
	$.ajax({url:'/grades/update/<?php echo $challenge_id . '/' . $user_id; ?>',data:$('#gradeData').serialize(),success:function(){
		$('#nextStudentBtn').click();
	}});
}
</script>