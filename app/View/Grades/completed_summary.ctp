<div style="float:left;width: 290px;padding: 15px;">
	<p><?php echo __('Comments and Corrections') ?></p>
	
	<table width="100%" style="font-size:13px;">
		<?php
		$k = 1;
		foreach($challenge['Question'] as $q){
			foreach($q['Response'] as $r){
				foreach($r['Comment'] as $c){ ?>
				<tr <?php if($k % 2){ ?>class="alternate"<?php } ?> onmouseover="$(this).find('.studentwork-more,.remove-class').show();" onmouseout="$(this).find('.studentwork-more').hide();if(!$(this).find('.remove-class').hasClass('open')){ $(this).find('.remove-class').hide(); }">
					<td class="col1" width="70%" align="left" style="padding:8px;"><?php echo substr($c['comment'],0,25); ?> ...</td>
					<td width="30%" class="col5" style="padding:8px;">
						<a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $grade['User']['id']; ?>?notips=1" class="studentwork-more userLevelLink" id="students-highest-quality-more" style="display:none;margin-left:0;">
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
<div style="float:right;width: 290px;padding: 20px;border: 2px dashed #ccc;">
		<p>Grade &nbsp; <input type="text" disabled="disabled" name="grade[grade]" value="<?php echo @$grade['Grade']['grade']; ?>" style="border: none;border-bottom: 1px solid #ccc;width: 50px;margin-left: 10px;font-size: 14px;" /></p>
		<textarea disabled="disabled" name="grade[comments]" onfocus="if($(this).hasClass('inactive')){ $(this).removeClass('inactive').val(''); }" class="inactive" style="width: 278px;height: 180px;margin: 15px 0;background: url('/images/textarea-lines.png') repeat;border: 0;line-height: 26px;"><?php echo ($grade ? $grade['Grade']['comments'] : ''); ?></textarea>
	
		<a href="#" onclick="window.location = $('#instructor_comment_nav a').attr('href');" class="btn2">
			<span><?php echo __('Go to Assignment') ?></span>
		</a>
</div>
<div class="clear"></div>