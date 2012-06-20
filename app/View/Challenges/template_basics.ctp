<div id="leftcol" class="alignleft">
	<h1 class="page-title">My Account</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="myaccount"><a href="/users/view/">My Account</a></li>
			<li class="template active"><a href="#">Template</a></li>
			<li class="people2"><a href="/users/view/groups/">Group(s)</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">
	
	<div class="caseclub-tabs">
		<ul >
			<li class="caseclub-tab tab-basics active"><a href="#"><img src="/images/icon-contracttemplate-16.png" /> Basics</a></li>
			<li class="caseclub-tab tab-questions"><a <?php if(@$challenge){ ?>href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_questions/"<?php }else{ ?>href="#" onclick="alert('You must save the template to continue.');return false;"<?php } ?>><img src="/images/icon-pen2-16.png" /> Questions</a></li>
			<li class="caseclub-tab tab-people "><a <?php if(@$challenge){ ?>href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_people/"<?php }else{ ?>href="#" onclick="alert('You must save the template to continue.');return false;"<?php } ?>><img src="/images/icon-people2-16.png" /> People</a></li>
		</ul>
		<div class="clear"></div>
	</div>

	<div id="templateBasicsForm" class="form-fields-wrap form-fields-disabled round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-contracttemplate"></span>
						<h2 class="page-subtitle">Basics</h2>
					</div>
					<form id="challengeData" method="POST" action="/challenges/update/0/template_basics" enctype="multipart/form-data">
						<?php if(@$challenge){ ?>
							<input type="hidden" name="challenge[id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
						<?php } ?>
						<input type="hidden" name="challenge[status]" value="<?php echo (@$challenge?@$challenge['Challenge']['status']:'D'); ?>" />
						<input type="hidden" name="challenge[user_id]" value="<?php echo (@$challenge?@$challenge['Challenge']['user_id']:@$_SESSION['User']['id']); ?>" />
						<input type="hidden" name="challenge[challenge_type]" value="T" />
						<ul class="fieldset2">
							<li>
								<p><span class="label">Name of Challenge</span></p>
								<input type="text" value="<?php echo @$challenge['Challenge']['name']; ?>" class="fullwidth input" name="challenge[name]" id="challengeName" />
							</li>
							<li>
								<div class="fieldsetFieldCol alignleft">

									<p>
										<span class="label">Due Date 1 </span> 
										<a href="#" class="tooltip-q">
											<span class="tooltip-q-text">Members read case/answer questions</span>
										</a>
									</p>
									<input type="text" value="<?php echo @$challenge['Challenge']['answers_due']; ?>" name="challenge[answers_due]" id="answers_due" class="inputtext"/>
									<a href="#" class="inputCalendarButton" onclick="$('#answers_due').datepicker('show');return false;"></a>
								</div>

								<div class="fieldsetFieldCol alignleft">
									<p><span class="label">Due Date 2 </span> 
										<a href="#" class="tooltip-q">
											<span class="tooltip-q-text">Members complete Agree/Disagrees</span>
										</a>
									</p>
									<input type="text" value="<?php echo @$challenge['Challenge']['responses_due']; ?>" name="challenge[responses_due]" id="responses_due" class="inputtext"/>
									<a href="#" class="inputCalendarButton" onclick="$('#responses_due').datepicker('show');return false;"></a>
								</div>

								<div class="clear"></div>
							</li>
							<li>
								<p><span class="label">Attach Challenge/Case</span></p>
							
								<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>
									<table class="simpletable" id="curCaseFile">
										<thead>
											<tr>
												<th width="400"><a href="#">Current Case Name</a></th>
												<th width="100"> </th>
											</tr>
										</thead>
										<tbody>
											<tr class="alternate">
												<td><a href="/uploads/<?php echo $challenge['Attachment'][0]['file_location']; ?>" target="_blank"><?php echo @$challenge['Attachment'][0]['name']; ?></a></td>
												<td><a href="#" onclick="remove_attachment('curCaseFile',<?php echo $challenge['Attachment'][0]['id']; ?>);return false;">Remove Case</a></td>
											</tr>
										</tbody>
									</table><br />
								<?php } ?>
							
								<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>Replace current case: <?php } ?><input type="file" name="attachment[0]" />
								<input type="hidden" name="attachment[0][type]" value="C" />
								<!-- <a href="#" class="add-link">Attach Case</a> -->
							</li>
							<li>
								<p><span class="label">Other Attachments</span></p>
							
								<?php if(count(@$challenge['Attachment']) > 1 || (count(@$challenge['Attachment']) == 1 && @$challenge['Attachment'][0]['type'] != 'C')){ ?>
									<table class="simpletable">
										<thead>
											<tr>
												<th width="400"><a href="#">Attachment Name</a></th>
												<th width="100"> </th>
											</tr>
										</thead>
										<tbody>
											<?php
											$idx_offset = 0;
											foreach($challenge['Attachment'] as $k=>$a){ 
												if($a['type'] == 'C'){
													$idx_offset++;
													continue;
												} ?>
											<tr<?php if(!(($k-$idx_offset)%2)){ ?> class="alternate"<?php } ?> id="curAttached<?php echo $k; ?>">
												<td><a href="/uploads/<?php echo $a['file_location']; ?>" target="_blank"><?php echo $a['name']; ?></a></td>
												<td><a href="#" onclick="remove_attachment('curAttached<?php echo $k; ?>',<?php echo $a['id']; ?>);return false;">Remove File</a></td>
											</tr>
											<?php } ?>
										</tbody>
									</table><br />
								<?php } ?>
							
								<span class="attachment_fields">
									<input type="file" name="attachment[1]" />
									<input type="hidden" name="attachment[1][type]" value="D" /><br />
								</span>
								<a href="#" onclick="add_attachment();return false;" class="add-link">Add another attachment</a>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #templateBasicsForm-->

	<a href="#" onclick="$('#challengeData').submit();$(this).hide();$('#savedNotify').show();return false;" class="btn1 btn-savecontinue aligncenter"><span class="inner">Save as Default</span></a>
	<span id="savedNotify" style="display:none;">
		<p class="textAlignCenter red">Saved!</p>
	</span>

</div>
<div style="display: none;">
	<div id="modalExitChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>

			<h2 class="page-subtitle label-text">Congratulations!</h2>
		</div>
		<br />
		<p class="caseclubFont18 blue textAlignCenter">Would you like to save before returning to Home?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="#" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save Current</span></a>

			<a href="#" class="btn2 btn-savecontinue aligncenter"><span class="inner">No, Don't Save</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false; ">Cancel</a>
		</div>
	</div><!-- #modalExitChoices -->
	
</div>
<div class="clear"></div>

<script type="text/javascript">
$('#answers_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});
$('#responses_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});
</script>