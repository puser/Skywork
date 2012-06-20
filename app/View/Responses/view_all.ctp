<?php if(!@$ajax){ ?>
<div id="leftcol" class="alignleft">
	<div class="discuss-comment-author">
		<h1 class="page-title">View Agree, Disagree </h1>
	</div>
	
	<div id="caseclubmenu" class="no-icon">
		<ul>
			<?php foreach($question['Challenge']['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if($q['id']==$question['Question']['id']){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>">
				<a href="#<?php echo $q['id']; ?>"><?php echo $q['section']; ?></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">
	<div class="caseclub-tabs-wrap">
		<div class="caseclub-tabs alignleft">
			<ul >
				<li class="caseclub-tab tab-agreed<?php if(!@$_GET['type'] || @$_GET['type'] == 'agree'){ ?> active<?php } ?>" id="agreeTab"><a href="#" onclick="switch_response_view('agree');return false;"><span class="green">Agreed</span></a></li>
				<li class="caseclub-tab tab-disagreed<?php if(@$_GET['type'] == 'disagree'){ ?> active<?php } ?>" id="disagreeTab"><a href="#" onclick="switch_response_view('disagree');return false;"><span class="red">Disagreed</span></a></li>
				<li class="caseclub-tab tab-theme<?php if(@$_GET['type'] == 'response'){ ?> active<?php } ?>" id="ownTab"><a href="#" onclick="switch_response_view('own');return false;">My Answer</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="alignright caseclub-links">
			<a href="#modalExitChoices" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="answerQuestionsFormThemes" class="form-fields-wrap round round-white">
		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body" style="min-height:479px;">
			<div class="body-r" id="mainResponseBody">
<?php } ?>
				<div class="content">
					<div class="box-heading">
						<span class="icon icon-listcountgreen"><?php echo $q_num; ?></span>
						<h2 class="page-subtitle"><?php echo $question['Question']['section']; ?></h2>
						
						<div class="vertical-navigation">
						<!--	<a href="#" class="next">2</a> -->
						</div>
					</div>
					<form action="" method="post">
						<ul class="fieldset2">
							<li>
								<p class="label-text caseQuestion"><span class="black6"><?php echo $question['Question']['question']; ?></span></p>
								<br />
								<div id="agreeResponses"<?php if(@$_GET['type'] && @$_GET['type'] != 'agree'){ ?> style="display:none;"<?php } ?> class="mcs_containers">
									<div class="customScrollBox">
										<div class="horWrapper">
										<div class="container">
											<div class="content" style="min-height:250px;height:auto;">
												<div class="caseclubAnswerBlock">
												<?php foreach($response['Responses'] as $r){
													if($r['response_type'] != 'A') continue;
													@$agrees++; ?>
													<p class="label-text"><?php echo (@$r['User'] ? @$r['User']['firstname'].' '.@$r['User']['lastname'] : '[ unknown user ]'); ?></p>
													<p><?php echo ($r['response_body']?str_replace("\\",'',stripslashes($r['response_body'])):' [ No details provided ]'); ?></p>
												<?php }if(!@$agrees) echo "There are no agreements for your response to this question."; ?>
												</div>
											</div>
										</div>
										<div class="dragger_container">
											<div class="dragger"></div>
										</div>
										</div>
									</div>
								</div>
									
								<div id="disagreeResponses"<?php if(@$_GET['type'] != 'disagree'){ ?> style="display:none;"<?php } ?> class="mcs_containers">
									<div class="customScrollBox">
										<div class="horWrapper">
										<div class="container">
											<div class="content" style="min-height:250px;height:auto;">
												<div class="caseclubAnswerBlock">
												<?php foreach($response['Responses'] as $r){
													if($r['response_type'] != 'D') continue;
													@$disagrees++; ?>
													<p class="label-text"><span class="red"><?php echo (@$r['User'] ? @$r['User']['firstname'].' '.@$r['User']['lastname'] : '[ unknown user ]'); ?></span></p>
													<p><?php echo ($r['response_body']?str_replace("\\",'',stripslashes($r['response_body'])):' [ No details provided ]'); ?></p>
												<?php }if(!@$disagrees) echo "There are no disagreements for your response to this question."; ?>
												</div>
											</div>
										</div>
										<div class="dragger_container">
											<div class="dragger"></div>
										</div>
										</div>
									</div>
								</div>
									
								<div id="ownResponses"<?php if(@$_GET['type'] != 'response'){ ?> style="display:none;"<?php } ?> class="mcs_containers">
									<div class="customScrollBox">
										<div class="horWrapper">
										<div class="container">
											<div class="content" style="min-height:250px;height:auto;">
												<div class="caseclubAnswerBlock">
													<p><?php echo str_replace("\\",'',stripslashes($response['Response']['response_body'])); ?></p>
												</div>
											</div>
										</div>
										<div class="dragger_container">
											<div class="dragger"></div>
										</div>
										</div>
									</div>
								</div><!-- #mcs_container-->
							</li>
						</ul>
					</form>
				</div>
<?php if(!@$ajax){ ?>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #answerQuestionsFormThemes-->
</div><!-- #maincol-->
<div class="clear"></div>

<div style="display: none;">
	<div id="modalExitChoices">
		<div class="box-heading">
			<span class="icon icon-warning"></span>
			<h2 class="page-subtitle label-text">Exit</h2>
		</div>
		<br />
		<p class="caseclubFont18 blue textAlignCenter">Are you sure you want to exit?</p>
		<br /><br /><br />
		<div class="exitSaveOptions">
			<a href="/challenges/browse/" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes</span></a>
			<a href="#" onclick="jQuery.fancybox.close(); return false;" class="btn2 btn-savecontinue aligncenter"><span class="inner">Cancel</span></a>
		</div>
	</div><!-- #modalExitChoices -->
</div>

<script type="text/javascript">
$(document).ready(function(){
	setup_view_hashchange(<?php echo $question['Question']['id']; ?>);
});
</script>
<?php } ?>