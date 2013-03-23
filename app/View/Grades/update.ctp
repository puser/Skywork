<div style="float:left;">
	<p><?php echo __('Comments and Corrections') ?></p>
	
	<table>
		<?php foreach(){ ?>
			<tr>
				<td> </td>
				<td> </td>
			</tr>
		<?php } ?>
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