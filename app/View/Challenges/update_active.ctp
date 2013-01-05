<style type='text/css'>
.remove-class:hover a.remove-class-icon { background: url('/images/arrow-down-purple.png') no-repeat center center !important; }
.remove-class:hover,.remove-class.open,.remove-class { border:0 !important;height:16px; }
.remove-class.open:hover a.remove-class-icon,.remove-class.open a.remove-class-icon{ background:transparent url('/images/arrow-up-purple.png') no-repeat center center !important; }
</style>

<div id="sidebarleft">
	<h1><?php echo __('Edit Assignment') ?></h1>
	<div id="sidemenu">
		<ul>
			<li><a class="icon icon-status" href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/update_active_status/"><?php echo __('Status') ?></a></li>
			<li class="active"><a class="icon icon-pen active"><?php echo __('Information') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">

	<div class="actionmenu">
		<ul>
			<li class="action-exit"><a href="/dashboard/"><?php echo __('Cancel & Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<form id="challenge_data" method="POST" action="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/dashboard" enctype="multipart/form-data">
		<input type="hidden" name="challenge[Challenge][id]" id="id" value="<?php echo $challenge['Challenge']['id']; ?>" />

		<div id="HelpDialog" style="display:none;text-align:center;"> </div>
		<div id="startbridge-information" class="box-startbridge box-white rounded">
			<div class="box-head">
				<span class="icon2 icon2-pen"></span>
				<h2><?php echo __('Assignment Information (Edit Mode)') ?></h2>
				<div class="clear"></div>
			</div>
			<div class="box-content information-fields-1">
				<ul class="fieldset">
					<li>
						<p class="label"><?php echo __('Name of Assignment') ?></p>
						<input type="text" class="checkdefault" value="<?php echo $challenge['Challenge']['name']; ?>" name="challenge[Challenge][name]" id="challengeName" default="<?php echo __('Type name here') ?>" size="60" />
					</li>
					<li class="cols2">
						<div class="col1">
							<p class="label"><?php echo __('Due Date 1') ?> <a href="#" class="tooltip-mark-question" title="<?php echo __('Students answer questions or write essay') ?>" ></a></p>
							<div class="date-input">
								<input type="text" value="<?php echo substr($challenge['Challenge']['answers_due'],0,10); ?>" name="challenge[Challenge][answers_due]" id="answers_due" />
								<a onclick="$('#answers_due').datepicker('show');return false;" class="datepicker"></a>
							</div>
							<p class="label" style="clear:both;margin-top:10px;"><?php echo __('Due Date 1 Time Deadline:') ?></p>
							<div class="date-input">
								<input name="answers_due_hour" style="width:20px;" value="<?php echo (substr($challenge['Challenge']['answers_due'],11,2) > 12 ? substr($challenge['Challenge']['answers_due'],11,2) - 12 : substr($challenge['Challenge']['answers_due'],12,2)); ?>" /> :
								<input name="answers_due_minute" style="width:20px;" value="<?php echo substr($challenge['Challenge']['answers_due'],14,2); ?>"  />
								<select name="answers_due_meridian">
									<option value="AM" <?php echo (substr($challenge['Challenge']['answers_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
									<option value="PM" <?php echo (substr($challenge['Challenge']['answers_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
								<select>
								<span style="position:relative;top: 2px;left: 6px;">EST</span>
							</div>
						</div>
						<?php if($challenge['Challenge']['collaboration_type'] != 'NONE'){ ?>
							<div class="col2" id="duedate2_input">
								<p class="label"><?php echo __('Due Date 2') ?> <a href="#" class="tooltip-mark-question" title="<?php echo __('Time for feedback and collaboration') ?>"></a></p>
								<div class="date-input">
									<input type="text" value="<?php echo substr($challenge['Challenge']['responses_due'],0,10); ?>" name="challenge[Challenge][responses_due]" id="responses_due" />
									<a onclick="$('#responses_due').datepicker('show');return false;" class="datepicker"></a>
								</div>
								<p class="label" style="clear:both;margin-top:10px;"><?php echo __('Due Date 2 Time Deadline:') ?></p>
								<div class="date-input">
									<input name="responses_due_hour" style="width:20px;" value="<?php echo (substr($challenge['Challenge']['responses_due'],11,2) > 12 ? substr($challenge['Challenge']['responses_due'],11,2) - 12 : substr($challenge['Challenge']['responses_due'],12,2)); ?>" /> :
									<input name="responses_due_minute" style="width:20px;" value="<?php echo substr($challenge['Challenge']['responses_due'],14,2); ?>"  />
									<select name="responses_due_meridian">
										<option value="AM" <?php echo (substr($challenge['Challenge']['responses_due'],11,2) <= 12 ? 'selected="selected"' : ''); ?>>AM</option>
										<option value="PM" <?php echo (substr($challenge['Challenge']['responses_due'],11,2) > 12 ? 'selected="selected"' : ''); ?>>PM</option>
									<select>
									<span style="position:relative;top: 2px;left: 6px;">EST</span>
								</div>
							</div>
						<?php } ?>
						<div class="clear"></div>
					</li>
					<li style='border-bottom: 1px solid #E6E6E6; margin-top: -13px; width: 758px; margin-left: -9px;'>&nbsp;</li><br/>
					<?php if($challenge['Challenge']['challenge_type'] == 'DOC'){ ?>
						<li id="add_document" style='padding-top:10px'>
							<p class="label"><?php echo __('Upload the Assignment: Document') ?></p>
						
							<div id="curCaseFile" style="font-size:12px;">
								<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?>
									<?php echo __('Current Document:') ?> 
									<a href="/uploads/<?php echo $challenge['Attachment'][0]['file_location']; ?>" target="_blank">
										<?php echo @$challenge['Attachment'][0]['name']; ?>
									</a>&nbsp;&nbsp;
									(<a href="#" onclick="remove_attachment('curCaseFile',<?php echo $challenge['Attachment'][0]['id']; ?>);return false;"><?php echo __('Remove Document') ?></a>)<br /><br />
								<?php } ?>
							</div>

							<?php if(@$challenge['Attachment'][0]['type'] == 'C'){ ?><?php echo __('Replace current document:') ?> <?php } ?>
							<input type="file" name="attachment[0]" />
							<input type="hidden" name="attachment[0][type]" value="C" />

						</li>
					<?php }elseif($challenge['Challenge']['challenge_type'] == 'VID'){ ?>
						<li id="add_youtube">
							<p class="label"><?php echo __('Video Embed Code') ?> <span class="action-preview" style="margin-left: 180px; font-size: 13px;"><a href="#" onclick="$('#HelpDialog').dialog('open');return false;"><?php echo __('Help?') ?></a></span></p>
							<textarea name="video_embed" style="width: 350px;height: 90px;"><?php echo (@$challenge['Attachment'][0]['type'] == 'C' ? $challenge['Attachment'][0]['file_location'] : '' ); ?></textarea>
						</li>
					<?php }else{ ?>
						<li id="add_offline">
							<p class="lable"><?php echo __('Offline Challenge') ?></p>
							<p class="input">
								<input type="text" name="offline_challenge" value="<?php echo (@$challenge['Attachment'][0]['type'] == 'C' ? $challenge['Attachment'][0]['file_location'] : ''); ?>" />
							</p>
						</li>
					<?php } ?>
				</ul>
			</div>

			<div class="box-content">
				<?php if($challenge['Challenge']['response_types'] == 'Q'){ ?>
					<span id="compose_questions">
						<p><?php echo __('Write the questions for your Assignment here:') ?></p>
						<ol class="fieldset">
							<?php 
							if(@$challenge['Question']){
								foreach(@$challenge['Question'] as $k=>$question){ ?>
							<li>
								<input type="text" class="checkdefault" value="<?php echo $question['question']; ?>" name="challenge[Question][<?php echo $k; ?>][question]" size="60"/>
								<input type="hidden" name="challenge[Question][<?php echo $k; ?>][id]" value="<?php echo $question['id']; ?>" />
							</li>
								<?php }
							}else{
								for($i=0;$i<2;$i++){ ?>
							<li>
								<input type="text" class="checkdefault" default="<?php echo __('Type name here') ?>" value="" name="challenge[Question][<?php echo $i; ?>][question]" size="60"/>
							</li>
								<?php }
							} ?>
						</ol>
						<!-- <p><a href="#" onclick="add_question();return false" class="icon-add"><?php echo __('Add another') ?></a></p> -->
					</span>
				<?php }else{ ?>
					<span id="compose_essay">
						<p><?php echo __('Write a description of this essay topic:') ?></p>
						<p>
							<textarea class="checkdefault" default="Write description here" name="challenge[Question][0][question]" style="width:550px;height:75px;padding:5px 7px;"><?php echo @$challenge['Question'][0]['question']; ?></textarea>
							<?php if(@$challenge['Question'][0]['question']['id']){ ?>
								<input type="hidden" name="challenge[Question][0][id]" value="<?php echo @$challenge['Question'][0]['id']; ?>" />
							<?php } ?>
						</p>
					</span>
				<?php } ?>
			</div>
		</div>
		
		<a href="#modalDeleteChoices" class="show-overlay" style="float:right;top:5px;position:relative;">Delete this Assignment</a>
		<div style="width: 180px; margin: 0 auto; ">
			<a href="#modalProgress" id="info_save" onclick="$('#challenge_data').submit();progressIndicator();" class="show-overlay btn2"><span><?php echo __('Resend this Assignment') ?></span></a>
		</div>

		<input type="hidden" name="next_step" value="people" />

		<script type="text/javascript">
		$('#answers_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date(),onSelect:function(){
			d = $('#answers_due').datepicker('getDate');
			d.setDate(d.getDate()+1);
			$('#responses_due').datepicker('setDate',d);
			$('#responses_due').datepicker("option","minDate",$('#answers_due').datepicker('getDate'));
		}});
		$('#responses_due').datepicker({'dateFormat':'yy-mm-dd','minDate':new Date()});

		$('#HelpDialog').load('/challenges/viewpdf/Help.pdf',function(){
			$("#HelpDialog").dialog({ autoOpen: false,minWidth: 740,minHeight: 500 });
		});
		
		function progressIndicator(){
			var currentDot = 0;
			setInterval(function(){
				if(currentDot == 3){
					currentDot = 0;
					$('.progressDot').hide();
				}else $('#progress' + ++currentDot).show();
			},500);
		}
		</script>
		
	</form>
	
</div>

<div class="clear"></div>

<div style="display:none;">
	<div id="modalProgress" style="width:200px;height:35px;text-align:center;font-size:16px;color:#00467F;line-height:35px;">
		Working <span id="progress1" class="progressDot" style="display:none;">.</span> <span id="progress2" class="progressDot" style="display:none;">.</span> <span id="progress3" class="progressDot" style="display:none;">.</span>
	</div>
	<div id="modalDeleteChoices" style="width:460px;height:190px;">
		<div class="modal-box-head">
			<h2 class="page-subtitle label-text" style="line-height:24px;color:#c95248;"><span class="icon5 icon5-close" style="margin:0;height:24px;"></span><?php echo __('Delete') ?></h2>
		</div>
		
		<div class="modal-box-content">
			<div style="text-align:center;margin:20px;"><?php echo __('Are you sure you want to delete this Bridge?') ?></div>	
			<br />
			<div style="width: 200px; margin: 0 auto; ">
				<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" class="btn2" style="width: 95px; float: left;" id="deleteBridgeLink"><span><?php echo __('Yes, Delete') ?></span></a>
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close(); return false; "><span><?php echo __('Cancel') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>