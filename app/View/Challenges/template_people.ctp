<div id="leftcol" class="alignleft">
	<h1 class="page-title">My Account</h1>
	<div id="caseclubmenu">

		<ul>
			<li class="myaccount"><a href="/users/view/">My Account</a></li>
			<li class="template active"><a href="#">Template</a></li>
			<li class="people2 "><a href="/users/view/groups/">Group(s)</a></li>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">
	
	<div class="caseclub-tabs">
		<ul >
			<li class="caseclub-tab tab-basics "><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_basics/"><img src="/images/icon-contracttemplate-16.png" /> Basics</a></li>
			<li class="caseclub-tab tab-questions "><a href="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_questions/"><img src="/images/icon-pen2-16.png" /> Questions</a></li>
			<li class="caseclub-tab tab-people active"><a href="#"><img src="/images/icon-people2-16.png" /> People</a></li>
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
						<h2 class="page-subtitle">People</h2>
					</div>
					<form id="challengeData" action="/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_people/" method="post">
						<input type="hidden" name="challenge[Challenge][id]" value="<?php echo $challenge['Challenge']['id']; ?>" />
						<ul class="fieldset2">
							<li>
								<p class="label"><span class="red">*</span> Invite group to challenge</p>

								<?php if($challenge['Group']){ ?>
									<table class="simpletable">
										<thead>
											<tr>
												<th width="400"><a href="#">Group Name</a></th>
												<th width="100"> </th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$ex_groups = array();
											foreach($challenge['Group'] as $k=>$g){
												$ex_groups[] = $g['id']; ?>
											<tr<?php if(!($k%2)){ ?> class="alternate"<?php } ?> id="challengeGroup<?php echo $g['id']; ?>">
												<td>
													<?php echo $g['group_name']; ?>
													<input type="hidden" name="challenge[Group][]" value="<?php echo $g['id']; ?>" />
												</td>
												<td><a href="#" onclick="remove_challenge_group(<?php echo $g['id']; ?>);return false;">Remove Group</a></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
								<br />
								<select name="challenge[Group][]">
									<option value=""> -- </option>
									<?php
									foreach($groups as $group){
										if(in_array($group['Group']['id'],$ex_groups)) continue;
										?>
									<option value="<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['group_name']; ?></option>
									<?php } ?>
								</select>
							</li>
						</ul>
						<a href="#" class="add-link" onclick="$('#challengeData').attr('action','/challenges/update/<?php echo $challenge['Challenge']['id']; ?>/template_people/').submit();return false;">Add another group</a>
						<br />
					
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