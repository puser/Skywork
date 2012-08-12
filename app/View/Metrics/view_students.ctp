<div id="assignmentDialog" style="display:none;"> </div>

<div id="sidebarleft">
	<h1><?php echo __('Metrics Section') ?></h1>
	<div id="sidemenu" >
		<ul>
			<li class="active">
				<a class="icon icon4-student" href="#"><?php echo __('Students') ?></a>
				<ul>
					<li id="groupNavAll"><a href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/" class="active"><?php echo __('All Students') ?></a></li>
					<?php if($challenge['Group']){
						foreach($challenge['Group'] as $k=>$g){ ?>
							<li id="groupNav<?php echo $g['id']; ?>">
								<a href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/<?php echo $g['id']; ?>"><?php echo __('Group') ?> <?php echo ($k + 1); ?></a>
							</li>
						<?php }
					} ?>
				</ul>
			</li>
			<li ><a class="icon icon4-question" href="/metrics/view_questions/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Question Activity') ?></a></li>
			<li ><a class="icon icon4-graph" href="/metrics/view_students/<?php echo $challenge['Challenge']['id']; ?>/0/1"><?php echo __('Charting') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle" style="margin-left: 20px; "><?php echo $challenge['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-notes"><a href="/responses/view/<?php echo $challenge['Challenge']['id']; ?>/"><?php echo __('Summary') ?></a></li>
			<li class="action-preview"><a href="#" onclick="$('#assignmentDialog').dialog('open');return false;"><?php echo __('Assignment') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="metrics-section-box" class="box-startbridge box-metrics-section box-white rounded">
		<div class="question-item">
			<div class="box-head">
				<span class="icon2 icon2-people-green"></span>
				<h2><?php echo __('Student Analysis:') ?> <?php echo __('All Students') ?></h2>
				<a href="#modal-customize" class="modal-link customize-link"><?php echo __('Customize') ?></a>
				<div class="clear"></div>
			</div>
			<div class="box-content">
				<table id="metrics-students-analysis" class="table-type-1">
					<thead>
						<tr>
							<th class="col1" width="20%"><a href="#" class="sort"><?php echo __('Student Name') ?></a></th>
							<th class="col2" width="23%"><a href="#" class="sort"><?php echo __('Completion Level') ?></a></th>
							<th class="col3" width="23%"><a href="#" class="sort"><?php echo __('Average Quality Level') ?></a></th>
							<th class="col4" width="23%"><a href="#" class="sort"><?php echo __('Students Activity Level') ?></a></th>
							<th class="col5" width="7%"></th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$idx = 0;
						foreach($challenge['ClassSet'] as $c){
							foreach($c['User'] as $u){
								$idx++;
								?>
								<tr<?php if($idx % 2){ ?> class="alternate"<?php } ?>>
									<td class="col1"><a class="modal-link" href="#modal-collaborators"><?php echo "{$u['firstname']} {$u['lastname']}"; ?></a></td>
									<td class="col2">
										<div class="activity-level activity-level-blue">
											<span style="width: <?php echo ($u['completion'] * 100); ?>%"></span>
										</div>
										<div class="activity-level-percentage"><?php echo round($u['completion'] * 100); ?>%</div>
										<div class="clear"></div>
									</td>
									<td class="col3">
										<div class="activity-level activity-level-red">
											<span style="width: <?php echo ($quality[$u['id']][0] ? (100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0); ?>%"></span>
										</div>
										<div class="activity-level-percentage"><?php echo ($quality[$u['id']][0] ? round(100 - ((($quality[$u['id']][1] / ($quality[$u['id']][0] ? $quality[$u['id']][0] : 1)) / 5) * 100)) : 0); ?>%</div>
										<div class="clear"></div>
									</td>
									<td class="col4">
										<div class="activity-level">
											<span style="width: <?php echo ((((($u['keystrokes'] - $min_keystrokes) / $max_keystrokes) + (($u['comments'] - $min_comments) / $max_comments)) / 2) * 100); ?>%"></span>
										</div>
										<div class="activity-level-percentage">
											<?php echo round((((($u['keystrokes'] - $min_keystrokes) / $max_keystrokes) + (($u['comments'] - $min_comments) / $max_comments)) / 2) * 100); ?>%
										</div>
										<div class="clear"></div>
									</td>
									<td class="col5">
										<ul class="table-toggle-button">
											<li class="value-false active"></li>
											<li class="value-true"></li>
										</ul>
									</td>
								</tr>
							<?php }
						} ?>
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

<div style="display: none;">
	<div id="modal-customize">
		
		<div id="modal-customize-box" class="modal-wrapper" style="width: 600px;" >
			
			<div class="modal-box-head">
				<span class="icon icon-customize"></span>
				<h2><span><?php echo __('Customize') ?></span></h2>
			</div>
			<div class="modal-box-content">
				
				<ul style="width: 550px; margin: 0 auto;">
					<li style="margin-bottom: 20px">
						<p>1. Select Date Range: (Select dropdown or enter dates manually)</p>
						<p><select >
								<option value="">- Select Date Range - </option>
								<option value="">Date Range 1</option>
							</select> -or-
						</p>
						<p>
							From
							<span class="date-input-wrap" >
								<input type="text" value="" size="20" /> 
								<a href="#" class="datepicker"></a> 
							</span>	
							to 
							<span class="date-input-wrap" >
								<input type="text" value="" size="20" /> 
								<a href="#" class="datepicker"></a>
							</span>
						</p>
					</li>
					<li style="margin-bottom: 40px;">
						<p>2. View quality of students' work based on:</p>
						<p>
							<select >
								<option value="">- Select Ordering Type - </option>
								<option value="">Ordering Option 1</option>
							</select>
						</p>
					</li>
				</ul>
				
				<div style="width: 210px; margin: 0 auto 20px auto; ">
					<div style="width: 80px; float: left;">
						<a href="#" class="btn2" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Run') ?></span></a>
					</div>
					<div style="width: 80px; float: right;">
						<a href="#" class="btn3" style="width: 100%" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function($){
		
		$("#metrics-students-analysis").tablesorter({ 
				sortList: [[0,0]],
				cssDesc: 'sortup',
				cssAsc: 'sortdown',
        textExtraction: function(node){ 
					return $(node).children('a').length ? $(node).children('a').html() : ($(node).children('div').length ? $(node).children('.activity-level').children('span').first().css('width') : $(node).html());
        } 
    });

		$("#metrics-students-analysis").bind("sortEnd",function() { 
			$('#metrics-students-analysis tbody tr').removeClass('alternate');
			var idx = 0;
			$('#metrics-students-analysis tbody tr').each(function(){
				if(++idx % 2) $(this).addClass('alternate');
			});
		});
	
		$('#assignmentDialog').load('/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>/1',function(){
			$("#assignmentDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
		});
		
		$(".table-toggle-button li").click(function(){
			if(!$(this).hasClass("active")) {
				$(".table-toggle-button li").removeClass("active"); 
				$(this).addClass("active");
				if($(this).hasClass("value-true")) $(".activity-level-percentage").show(); 
				else $(".activity-level-percentage").hide(); 
			}
		}); 
		
		$(".modal-link").fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true,
			'width' : 500
		}); 
		
	}); 
	
</script>