<div id="assignmentDialog" style="display:none;text-align:center;"> </div>

<div id="sidebarleft">
	<h1><?php echo __('Metrics Section') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li><a class="icon icon4-student" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Students') ?></a></li>
			<li><a class="icon icon4-question" href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Question Activity') ?></a></li>
			<li><a class="icon icon4-graph" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/0/1"><?php echo __('Charting') ?></a></li>
			<li class="active"><a class="icon" href="/metrics/view_flags/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Red Flags') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo $challenge['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-notes"><a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/0"><?php echo __('Summary') ?></a></li>
			<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;"><?php echo __('Assignment') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<!-- <span class="icon2"></span> -->
				<h2 style="color:#ff0000;"><?php echo __('Red Flags') ?></h2>
				<a href="#modal-customize" class="modal-link customize-link"><?php echo __('Customize') ?></a>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-students-analysis" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" width="30%"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
							<th class="col2" width="63%"><a href="#" class="sort"><?php echo __('Incidents') ?></a></th>
							<th class="col5" width="7%"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="alternate" onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">15</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
						<tr onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">10</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
						<tr class="alternate" onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">3</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
						<tr onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">1</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
						<tr class="alternate" onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">1</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
						<tr onmouseover="$(this).find('.table-toggle-button').show();" onmouseout="$(this).find('.table-toggle-button').hide();">
							<td class="col1">Student Lastname</td>
							<td class="col2">1</td>
							<td class="col5">
								<ul class="table-toggle-button" style="display:none;">
									<li class="value-false active"></li>
									<li class="value-true"></li>
								</ul>
							</td>
						</tr>
					</tbody>
					
				</table>
			</div>
		</div>
		
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 80px; margin: 0 auto;">
		<a href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/" class="btn2"><span><?php echo __('Next') ?></span></a>
	</div>

</div>

<div class="clear"></div>



<script type="text/javascript">

	jQuery(document).ready(function($){
	
		$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
			$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
		});
	
		$(".modal-link").fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true,
			'width' : 500
		}); 
		
	}); 
	
</script>