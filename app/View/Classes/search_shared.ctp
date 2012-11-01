<?php if(@$user['ClassSet']){ if($user['User']['user_type'] == 'L'){?>
<br />
<p><?php echo __('Select the Classes you would like to join:') ?></p>
<ul class="fieldset2">
	<li>
		<label><?php echo __('Class(es)') ?></label>
		<div class="classes-options">
			<ul id="joinAGroup">
				<?php foreach($user['ClassSet'] as $c){ ?>
					<li><input type="checkbox" name="groups[]" value="<?php echo $c['id']; ?>" /> <?php echo $c['group_name']; ?></li>
				<?php } ?>
			</ul>
		</div>
		<div class="clear"></div>
	</li>
</ul>
<br /><br />
<div class="clear"></div>
<?php }else{ ?><div style="text-align:center;margin:20px;"><?php echo __('Instructor not found') ?></div>
<?php } }elseif(!@$user){ ?><div style="text-align:center;margin:20px;"><?php echo __('Instructor not found') ?></div>
<?php }else{ ?><div style="text-align:center;margin:20px;"><?php echo __('This instructor has restricted access to their classes') ?></div><?php } ?>