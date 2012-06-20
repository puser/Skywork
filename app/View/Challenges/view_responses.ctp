<div id="leftcol" class="alignleft">
	<div class="discuss-comment-author">
		<h1 class="page-title">Agree, Disagree </h1>

		<span class="commentAuthorName georgia">John Doe</span>
	</div>
	
	<div id="caseclubmenu" class="no-icon">
		<ul>
			<?php foreach($challenge['Question'] as $k=>$q){ if(!$q['question']) continue; ?>
			<li class="<?php if(!$k){ ?>active<?php } ?>" id="questionNav<?php echo $q['id']; ?>"><a href="#" onclick="show_response(<?php echo $q['id']; ?>,<?php echo $user_id; ?>);return false;"><?php echo $q['section']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>		
<div id="maincol" class="alignright">

	<div class="caseclub-links-wrap">
		<div class="alignleft caseclub-location">Disney Without its CEO: What next?</div>
		<div class="alignright caseclub-links">

			<?php if(@$challenge['Attachment'][0]['type']=='C'){ ?><a href="/attachments/view/case/<?php echo $challenge['Challenge']['id']; ?>" class="caseclub-preview">See Case</a><?php } ?>
			<a href="#" class="caseclub-save">Save</a>
			<a href="#" class="caseclub-withdraw">Exit</a>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="answerQuestionsFormThemes" class="form-fields-wrap round round-white">

		<div class="head"><span class="tl"></span><span class="tr"></span></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #answerQuestionsFormThemes-->

	<p class="textAlignCenter red">* You must complete this section</p>
	<br /><br />


	<div class="caseclub-actions">
		<div class="alignleft">
			<a href="discuss-themes.html" class="btn2 reconsider"><span class="inner">Reconsider</span></a>
		</div>
		<div class="alignright">
			<a href="discuss-response.html" class="btn1"><span class="inner">Save and Continue</span></a>
		</div>
		<div class="clear"></div>

	</div>

</div><!-- #maincol-->
<div class="clear"></div>