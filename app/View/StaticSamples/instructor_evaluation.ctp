<style type="text/css">
.activeMarker {
	width:8px;
	display:inline-block;
	position:absolute;
	opacity:.6;
	cursor:pointer;
}
.inactiveMarker {
	width:3px;
	display:inline-block;
	position:absolute;
	opacity:.7;
	cursor:pointer;
}
.markerContainer {
	width:3px;
	display:inline-block;
	position:relative;
	top:-13px;
}
.activeDetail {
	background-color:#feffbd !important;
}
.annotated[annotatelevel="0"],.annotated[annotatelevel="1"],.annotated[annotatelevel="2"] {
	padding-right:3px;
	margin-right:-3px;
}
#activeFlag {
	background-color:#ff8d8d;
}
.commentHover {
	background-color:#eee !important;
}
</style>


<div id="sidebarleft">

	<h1>Evaluation</h1>
	<div id="sidemenu2">
		<ul>
			<li id="groupNav">
				<a href="#" class="sidemenu2-title"><?php echo __('Students') ?></a>
				<ul>
					<li class="userNav"><a class="active" href="/static_samples/instructor_evaluation/">James Buchanan</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Martin Buren</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Millard Fillmore</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">William Harrison</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">James Monroe</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Franklin Pierce</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">James Polk</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">Zach Taylor</a></li>
					<li class="userNav"><a href="/static_samples/instructor_evaluation/">John Tyler</a></li>
				</ul>
			</li>
		</ul>
		<ul>
			<li>
				<a style="font-size:13px;padding-left:30px;width:136px;background-image:url(/images/icons/greencheck_menu_16.png);background-position:4px 8px;background-repeat:no-repeat;" href="/static_samples/instructor_done/"><?php echo __('I\'m Done!') ?></a>
			</li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div class="alignleft page-toptitle">Assignment Example: Presidents of the United States of America</div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-video"><a href="/pages/tutorial/?vid=evaluate_assignment" class="iframe" id="tutorialVideo" style="padding:0 0 0 25px;" data-fancybox-type="iframe"><?php echo __('Video') ?></a></li>
			<li class="action-exit"><a href="/"><?php echo __('Exit') ?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded" style="min-height:30px;">
		<div class="question-item" style="overflow:hidden;">
			<div class="box-head">
				<span class="icon2 icon2-listcountgreen">1</span>
					<h2>Question 1</h2>
					<div class="clear"></div>
				</div>
				<div class="box-content">
					<ul class="fieldset2">
						<li>
							<p class="label-text ">
								<span class="black6">
									Explain the document in depth.
								</span>
							</p>
							<div class="textvalue">
								<p id="responseBody">
									Lorem ipsum dolor sit amet, sed at aperiam alterum. Ea nihil placerat pro, ut usu utroque legendos, ea errem ancillae vix. Mel eu partem iuvaret, vocibus docendi eos ad. Sumo aliquid moderatius ea mei, eu lorem deleniti nam. Eirmod temporibus eos et, an sit magna aliquando vituperata.<br /><br />

									Vocibus accusata omittantur has an, duo elit ludus urbanitas in. Eu movet tritani quo, illud congue consetetur has eu. Congue partiendo eos ne, dico singulis mei cu. Est ut perfecto percipitur. Nec quidam impetus appellantur eu, est at aliquam efficiendi, suas summo euripidis duo at. Inani pericula dissentiet ne pri. Te partem adolescens ius.<br /><br />

									Mel recusabo accusamus cu. Aliquid aliquam volumus vel id, eu eum vitae dolorem. Modo evertitur in has. Tota consulatu intellegat te sea. Dico verear partiendo sed ei, ne summo consul aliquip per. Ea per appareat verterem, no dolor moderatius eos.<br /><br />

									At est amet graeco officiis, ne eam scripserit accommodare, sit vocent quaeque consetetur ne. Accumsan honestatis eu quo. Prima admodum eam ut, intellegam contentiones definitionem eos an. Quem tibique electram eos in. Velit melius minimum id pri.<br /><br />

									Nominati atomorum neglegentur et vim. His populo tractatos temporibus te. Ne libris epicuri voluptaria cum, delicata intellegebat mel in. Sint nullam et ius, an nec graeci noster intellegam.
								</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	
		<div class="clear"></div>
		<div style="width:120px;float:right;" id="topOfPage">
			<a href="#" style="float:right; margin-right: 4px;margin-bottom: -15px;">^ <span style="color: #999;"><?php echo __('Go To Top') ?></span></a>
		</div>
		
	</div>
</div>

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	if($(window).height() >= $(document).height()) {
		$('#topOfPage').hide();
		$('#parentGototop').width(120)
	}
	
	annotaterInit(".textvalue p");
	$('.question-item').each(function(){
		$(this).height($(this).height());
	});
	$('#puentes-answer-questions').height($('#puentes-answer-questions').height());
	
	$('#groupNav a').click();
});

var currentAnnotation = null;
var responses = new Array();

function saveAnnotation(){
	$('.comment-submit img').show();
	$('.comment-submit a').hide();
	
	$('.answer-comment-box textarea').click();
	
	setTimeout(function(){
		$('.comment-submit img').hide();
		$('.comment-submit a').show();
	
		$('.jQueryTextAnnotaterDialog').hide();
		$('.answer-comment-box .close').removeClass('removeAnnotationBtn').click();
		currentAnnotation = null;
	},5);
}

	function annotaterInit(cssSelector) {

	var options = {};
	options.form = '<div class="answer-comment-box"><textarea name="comment" class="comment-textarea"></textarea><div class="vote"><ul><li class="voteneutral"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(2);return false;">General</a></li><li class="voteup"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(1);return false;">Like</a></li><li class="votedown"><a href="#" onclick="$(this).parent().removeClass(\'inactive\');$(this).parent().siblings().addClass(\'inactive\');$(\'.comment-type\').val(0);return false;">Dislike</a></li></ul></div><div class="comment-submit"><img src="/images/loadingWheel.gif" style="display:none;" /><a href="#" onclick="if($(\'.jQueryTextAnnotaterDialogForm input.comment-type\').val() == \'N\'){ alert(\'You must select Like or Dislike to save a comment.\'); }else{ saveAnnotation(); }return false;" class="btn1"><span>Comment</span></a></div><a href="#" class="removeAnnotationBtn deleteComment" style="float: right;color: #000;text-decoration: underline;padding-top: 2px;">Remove this comment</a><div class="clear"></div><div class="callout-corner"></div><a href="#" class="close removeAnnotationBtn" onclick="$(\'.jQueryTextAnnotaterDialog\').hide();return false;"></a><input type="hidden" name="type" class="comment-type" value="2" /><input type="hidden" name="id" class="comment-id" value="" /></div>';
	options.annotateCharacters = false; 
	options.formDeleteAnnotationButton = '.removeAnnotationBtn';

	jQuery(cssSelector).textAnnotate(options);

	//annotation saved
	jQuery(cssSelector).textAnnotate('bind', 'saveForm', function(data){
		currentAnnotation = data;
	});

	jQuery(cssSelector).textAnnotate('bind', 'removeAnnotation', function(removedAnnotation){
		if(removedAnnotation[0].formValues) $.ajax({url:'/comments/delete/' + removedAnnotation[0].formValues[2].value});
	});

	jQuery(cssSelector).textAnnotate('bind', 'addAnnotation', function(addedAnnotation){
		setTimeout(function(){
			$('.jQueryTextAnnotaterDialogForm input.comment-type').val('2');
			$('.jQueryTextAnnotaterDialogForm input.comment-id').val('');
			$('.vote .votedown').addClass('inactive');
			$('.vote .voteup').addClass('inactive');
			$('.vote .voteneutral').removeClass('inactive');
		},75);
	});

	jQuery(cssSelector).textAnnotate('bind', 'beforeShowDialog', function(data){
		setTimeout(function(){
			if($('.jQueryTextAnnotaterDialogForm textarea').val() != ''){
				$('.answer-comment-box').height(110);
				$('.answer-comment-box').css('top','-145px');
				$('.deleteComment').show();
				$('.comment-submit .btn1 span').html('Save');
				$('.answer-comment-box .close').removeClass('removeAnnotationBtn');
			}else{
				$('.answer-comment-box').height(90);
				$('.answer-comment-box').css('top','-125px');
				$('.deleteComment').hide();
				$('.comment-submit .btn1 span').html('Comment');
				$('.answer-comment-box .close').addClass('removeAnnotationBtn');
			}
		
			if($('.jQueryTextAnnotaterDialogForm textarea').val() == ''){
				$('.vote .votedown').addClass('inactive');
				$('.vote .voteup').addClass('inactive');
				$('.vote .voteneutral').removeClass('inactive');
			}else if($('.jQueryTextAnnotaterDialogForm input.comment-type').val() == '0'){
				$('.vote .votedown').removeClass('inactive');
				$('.vote .voteup').addClass('inactive');
				$('.vote .voteneutral').addClass('inactive');
			}else if($('.jQueryTextAnnotaterDialogForm input.comment-type').val() == '1'){
				$('.vote .votedown').addClass('inactive');
				$('.vote .voteneutral').addClass('inactive');
				$('.vote .voteup').removeClass('inactive');
			}else{
				$('.vote .votedown').addClass('inactive');
				$('.vote .voteneutral').removeClass('inactive');
				$('.vote .voteup').addClass('inactive');
			}
		},25);
	});
	
	jQuery(cssSelector).textAnnotate('bind', 'beforeHideDialog', function(data){
		
		// if there's no id for this comment and no content, delete it; otherwise, save it
		if($('.jQueryTextAnnotaterDialogForm input.comment-id').val() == '' && $('.jQueryTextAnnotaterDialogForm textarea').val() == ''){
//		$('.answer-comment-box .close').click();
		}else if($('.jQueryTextAnnotaterDialogForm input.comment-id').val() == ''){
	/*	saveAnnotation();
			setTimeout(function(){
				$('.answer-comment-box .close').click();
			},10); */
		}
		
	});

	jQuery(cssSelector).textAnnotate('addAnnotations', [[{"elementId":"textAnnotate_78","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]},{"elementId":"textAnnotate_79","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]},{"elementId":"textAnnotate_80","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]},{"elementId":"textAnnotate_81","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]},{"elementId":"textAnnotate_82","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]},{"elementId":"textAnnotate_83","formValues":[{"name":"comment","value":"To leave comments and corrections, simply highlight by clicking and dragging the cursor along the desired area."},{"name":"type","value":"2"},{"name":"id","value":""}]}]]);
}

$('#tutorialVideo').fancybox({
	'hideOnOverlayClick' : true,
	'showCloseButton' : true,
	'centerOnScroll' : true,
	'width' : 660,
	'height' : 505
});
</script>