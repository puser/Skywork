<?php if(@$user['ClassSet']){ ?>
<br />
<p>Select the Classes you would like to join:</p>
<ul class="fieldset2">
	<li>
		<label>Class(es)</label>
		<div class="classes-options">
			<ul>
				<?php foreach($user['ClassSet'] as $c){ ?>
					<li><input type="checkbox" /> <?php echo $c['group_name']; ?></li>
				<?php } ?>
			</ul>
		</div>
		<div class="clear"></div>
	</li>
</ul>
<br /><br />
<div class="clear"></div>
<?php }elseif(!@$user){ ?><div style="text-align:center;margin:20px;">Instructor not found</div>
<?php }else{ ?><div style="text-align:center;margin:20px;">This instructor has restricted access to their classes</div><?php } ?>