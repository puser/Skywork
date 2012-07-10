<div id="modal-splitclass">
	<div class="modal-splitclass modal-wrapper" style="width: 600px; " >
		<div class="modal-box-head">
			
			<div class="box-actions">
				<ul>
					<li>
						<div class="custom-select">
							<div class="custom-select-value"><?php echo $challenge['ClassSet'][0]['group_name']; ?></div> 
							<div class="custom-select-options">
								<ul>
									<?php foreach($challenge['ClassSet'] as $c){ ?>
									<li><input type="checkbox" disabled="disabled" checked="checked" /> <?php echo $c['group_name']; ?></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
			
			<span class="icon5 icon5-flash"></span>
			<h2>Split class into groups</h2>
		</div>
		<div class="modal-box-content">
			<?php if(!$group_count){ ?>
				Number of Students per Group <div class="input-roller"><input type="text" value="1" size="2"/> <span class="roll-up"></span><span class="roll-down" ></span></div> &nbsp;&nbsp;&nbsp;
				<a href="/challenges/split_groups/<?php echo $challenge['Challenge']['id']; ?>/1" class="show-overlay" id="run_split">Go</a>
			
				<br /><br /><br /><br /><br /><br />
				<div class="clear"></div>
				<div style="width: 80px; margin: 0 auto; ">
					<a href="#" class="btn3" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
				</div>
			<?php }else{ ?>
				<div class="table-split" style="width: <?php echo ceil(count($students) * 145); ?>px; margin: 0 auto;">
					<?php foreach($students as $k=>$group){ ?>
						<ul class="connectedSortable" id="group_<?php echo $k; ?>" style="min-height:20px;width:130px;float:left;border:1px solid #333;margin-right:10px;">
							<?php foreach($group as $j=>$user){ ?>
								<li style="padding:4px;font-size:13px;" id="user_<?php echo $user['id']; ?>"><?php echo $user['firstname'].' '.$user['lastname']; ?></li>
							<?php } ?>
						</ul>
					<?php } ?>
				<br /><br />
				<div class="clear"></div>
				<div style="width: 175px; margin: 0 auto; ">
					<a href="#" class="btn2" style="width:80px;float:left;" onclick="save_groups(<?php echo $challenge['Challenge']['id']; ?>); jQuery.fancybox.close(); return false; "><span>Add</span></a>
					<a href="#" class="btn3" style="width:80px;float:left;" onclick="jQuery.fancybox.close(); return false; "><span>Cancel</span></a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<style type="text/css">
.connectedSortable li {
	border-top:1px solid #333;
}
.connectedSortable li:first-child {
	border-top:none;
}
</style>

<script type="text/javascript">
$(function() {
	$(".connectedSortable").sortable({
		connectWith: ".connectedSortable"
	}).disableSelection();

	$(".custom-select .custom-select-value").click(function() {
		parent = $(this).closest(".custom-select");
		if(parent.hasClass("open")) 
			parent.removeClass("open");
		else
			parent.addClass("open");
	});

	$(".input-roller .roll-up").click(function() {
		val = $("input", $(this).closest(".input-roller")).val();
		val++;
		$("input", $(this).closest(".input-roller")).val(val);
		$('#run_split').attr('href','/challenges/split_groups/<?php echo $challenge['Challenge']['id']; ?>/' + val);
	}); 

	$(".input-roller .roll-down").click(function() {
		val = $("input", $(this).closest(".input-roller")).val();
		if(val > 0) val--;
		$("input", $(this).closest(".input-roller")).val(val);
		$('#run_split').attr('href','/challenges/split_groups/<?php echo $challenge['Challenge']['id']; ?>/' + val);
	});

	$(".show-overlay").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true
	});
});
</script>