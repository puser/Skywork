<div class="box-head">
	<h2><?php echo __('Grades') ?></h2>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="box-content" style="font-size:12pt;margin-left: 120px;">
	<table id="feedback_summary" class="table-type-1">
		<thead>
			<tr>
				<th class="col1" width="30%"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
				<th class="col2" width="35%"><a href="#" class="sort"><?php echo __('Comments & Corrections') ?></a></th>
				<th class="col3" width="26%"><a href="#" class="sort"><?php echo __('Grade') ?></a></th>
				<th class="col5" width="9%"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($grades as $k=>$grade){ ?>
				<tr <?php if($idx % 2){ ?>class="alternate"<?php } ?>>
					<td class="col1"><?php echo "{$grade['User']['firstname']} {$grade['User']['lastname']}"; ?></td>
					<td class="col2"><?php echo $comment_count[$grade['User']['id']]; ?></td>
					<td class="col3"><?php echo $grade['Grade']['grade']; ?></td>
					<td> </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<br /><br />
<div class="clear"></div>