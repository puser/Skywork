<!-- <?php print_r($challenge); ?> -->

<div id="sidebarleft">
	<h1>Instructor Feedback</h1>
	<div id="sidemenu2" >
		<ul>
			<?php if($challenge[0]['Group']){
				foreach($challenge[0]['Group'] as $k=>$g){ ?>
					<li class="">
						<a href="#" class="sidemenu2-title">Group <?php echo ($k + 1); ?></a>
						<ul>
							<?php foreach($g['User'] as $u){
								if($u['id'] == $_SESSION['User']['id']) continue; ?>
								<li><a href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>"><?php echo $u['firstname'].' '.$u['lastname']; ?></a></li>
							<?php } ?>
						</ul>
					</li>
				<?php }
			}else{
				foreach($challenge[0]['ClassSet'] as $c){ ?>
					<li class="">
						<a href="#" class="sidemenu2-title"><?php echo $c['group_name']; ?></a>
						<ul>
							<?php foreach($c['User'] as $u){
								if($u['id'] == $_SESSION['User']['id']) continue; ?>
								<li><a href="/responses/view/<?php echo $challenge[0]['Challenge']['id']; ?>/<?php echo $u['id']; ?>"><?php echo $u['firstname'].' '.$u['lastname']; ?></a></li>
							<?php } ?>
						</ul>
					</li>
				<?php }
			} ?>
		</ul>
	</div>
</div>

<div id="maincolumn">
	
	<div class="alignleft page-toptitle"><?php echo $challenge[0]['Challenge']['name']; ?></div>
	
	<div class="actionmenu">
		<ul>
			<li class="action-preview"><a href="/attachments/view/case/<?php echo $challenge[0]['Challenge']['id']; ?>">Assignment</a></li>
			<li class="action-exit"><a href="/">Exit</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<div id="puentes-answer-questions" class="box-startbridge box-answer-questions box-white rounded">
		<?php foreach($challenge[0]['Question'] as $k=>$q){ ?>
			<div class="question-item">
				<div class="box-head">
					<span class="icon2 icon2-listcountgreen"><?php echo ($k+1); ?></span>
					<h2><?php echo $q['section']; ?></h2>
					<div class="like-scale">
						<ul id="response_scale_<?php echo $q['Response'][0]['id']; ?>">
							<li class="scale1<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 1) echo ' selected'; ?>"><span>Very High Quality</span></li>
							<li class="scale2<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 2) echo ' selected'; ?>"><span>Good Quality</span></li>
							<li class="scale3<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 3) echo ' selected'; ?>"><span>Average Quality</span></li>
							<li class="scale4<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 4) echo ' selected'; ?>"><span>Below Average Quality</span></li>
							<li class="scale5<?php if(@$q['Response'][0]['Responses'][0]['response_body'] == 5) echo ' selected'; ?>"><span>Poor Quality</span></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="box-content">
					<ul class="fieldset2">
						<li>
							<p class="label-text ">
								<span class="black6">
									<?php echo $q['question']; ?>
								</span>
							</p>
							<div class="textvalue">
								<p id="responseBody<?php echo $k; ?>">
									<?php 
									foreach(@$q['Response'][0]['Comment'] as $c){
										$q['Response'][0]['response_body'] = substr($q['Response'][0]['response_body'],0,$c['segment_start']) . '<span style="background-color:#ff0000;">&nbsp;</span>' . substr($q['Response'][0]['response_body'],$c['segment_start']);
									}
									echo nl2br($q['Response'][0]['response_body']);
									?>
								</p>
								
								<div style="display:none;" class="notice-for-edit">
									Highlight a section of the text to add a comment.
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
	
	<div class="clear"></div>
	
	<div style="width: 300px; margin: 0 auto; ">
		<div style="width: 120px; float: left;">
			<a href="/" class="btn2"><span>Next Student</span></a>
		</div>
		<div style="width: 120px; float: right;">
			<a href="#" class="btn3"><span>Top of Page</span></a>
		</div>
		<div class="clear"></div>
	</div>

</div>

<div class="clear"></div>

<div id="modalSaveChoices" style="height:220px;overflow:hidden;display:none">
	<div class="box-heading">
		<span class="icon icon-star"></span>
		<h2 class="page-subtitle label-text">Congratulations!</h2>
	</div>

	<br />
	<p class="blue textAlignCenter" style="font-size:15px;width:390px;margin-left:45px;margin-right:45px;">You have completed all sections. You have until the next Due Date to edit any information you wish. Would you like to go to Home?</p>
	<br /><br /><br />
	<div class="exitSaveOptions" style="width:475px;margin-left:13px;">
		<a style="float:left;cursor:pointer;width:180px;" onclick="jQuery.fancybox.close();save_second_response('/dashboard/');" class="btn1 btn-savecontinue aligncenter"><span class="inner">Yes, Save and Go Home</span></a>
		<a style="float:right;cursor:pointer;width:240px;" onclick="jQuery.fancybox.close();save_second_response('/responses/view/<?php echo $question['Question']['id'].'/'.$question['Response'][0]['User']['id']; ?>');return false;" class="btn2 btn-savecontinue aligncenter"><span class="inner">Save, but Continue to Edit Answers</span></a>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	annotaterInit(".textvalue");
	
	$('.like-scale li').click(function(){
		if(!$(this).parent().find('li selected').length){
			editMessage = $(this).parents('.question-item').find('.notice-for-edit');
			editMessage.fadeIn();
			setTimeout(function(){
				editMessage.fadeOut();
			},2200);
		}else $(this).parent().find('li').removeClass('selected');
		$(this).addClass('selected');
		
		r_parent = $(this).parent();
		response_data = { response_id: r_parent.attr('id').replace('response_scale_',''),response_body: parseInt($(this).attr('class').replace('scale','')) };
		if(r_parent.data('rID')) response_data.id = r_parent.data('rID');
		
		$.ajax({url:'/responses/update/',data:response_data,success:function(r){
			r_parent.data('rID',r);
		}});
	});
});

var currentAnnotation = null;
var responses = new Array();
<?php foreach($challenge[0]['Question'] as $k=>$q){ ?>
	responses.push({text:'<?php echo str_replace("\n",' ',$q['Response'][0]['response_body']); ?>',id:<?php echo $q['Response'][0]['id']; ?>});
<?php } ?>

function saveAnnotation(){
	start = currentAnnotation.annotation[0].elementId.replace('textAnnotate_','');
	end = currentAnnotation.annotation[currentAnnotation.annotation.length - 1].elementId.replace('textAnnotate_','');
	r_id = 0;
	
	lastPos = responseIdx = 0;
	for(i = 0;i < end;i++){
		
		if(responses[responseIdx].text.substr(lastPos).indexOf(' ') == -1){
			responseIdx++;
			lastPos = responses[responseIdx].text.substr(0).indexOf(' ') + 1;
		}else lastPos = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
		
		if(i + 1 + responseIdx == start && !r_id){
			start = lastPos;
			r_id = responses[responseIdx].id;
		}else if(i + 1 + responseIdx == end){
			end = responses[responseIdx].text.substr(lastPos).indexOf(' ') + lastPos + 1;
			if(end == -1) end = responses[responseIdx].text.length;
			break;
		}
	}
	
	if(!r_id) r_id = responses[0].id;
	
	$('.jQueryTextAnnotaterDialog').hide();
	$.ajax({url:'/comments/save/',data:{comment:{response_id:r_id,segment_start:start,segment_length:(end - start),comment:currentAnnotation.formValues[0].value,type:currentAnnotation.formValues[1].value}},success:function(){
		currentAnnotation = null;
	}});
}

function annotaterInit(cssSelector) {

	var options = {};
	options.form = '<div class="answer-comment-box"><textarea name="comment" class="comment-textarea"></textarea><div class="vote"><ul><li class="voteup active"><a href="#" onclick="$(this).parent().addClass(\'active\');$(this).parent().next().removeClass(\'active\');$(\'.comment-type\').val(1);console.log($(\'.comment-type\'));return false;"></a></li><li class="votedown "><a href="#" onclick="$(this).parent().addClass(\'active\');$(this).parent().prev().removeClass(\'active\');$(\'.comment-type\').val(0);console.log($(\'.comment-type\'));return false;"></a></li></ul></div><div class="comment-submit"><a href="#" onclick="saveAnnotation();return false;" class="btn1"><span>Comment</span></a></div><div class="clear"></div><div class="callout-corner"></div><a href="#" class="close" onclick="$(\'.jQueryTextAnnotaterDialog\').hide();return false;"></a><input type="hidden" name="type" class="comment-type" value="1" /></div>';
	options.annotateCharacters = false; 

	jQuery(cssSelector).textAnnotate(options);

	//new annotation added
	jQuery(cssSelector).textAnnotate('bind', 'addAnnotation', function(addedAnnotation){          
//		console.log(addedAnnotation);
	});

	//annotation removed
	jQuery(cssSelector).textAnnotate('bind', 'removeAnnotation', function(removedAnnotation){

	});

	//annotation saved
	jQuery(cssSelector).textAnnotate('bind', 'saveForm', function(data){
		currentAnnotation = data;
	});

	//annotation dialog shown
	//  data.element   : the element under the mouse cursor
	//  data.dialogCSS : the dialog's CSS
	jQuery(cssSelector).textAnnotate('bind', 'beforeShowDialog', function(data){

	});

	 //annotation dialog hidden
	jQuery(cssSelector).textAnnotate('bind', 'beforehidedialog', function(){
  	
	});
	
}
</script>

<style>
  .annotated{
    position: relative;
    background-color:#FFEFD8;
  }

  .annotated[annotateLevel="0"] {
    background-color:#ffaaaa;
  }

  .annotated[annotateLevel="1"] {
    background-color:#ff8888;
  }

  .annotated[annotateLevel="2"] {
    background-color:#ff4444;
  }

  .beingAnnotated {
    background-color:#F90;
  }

  .annotationFocus, .annotationFocus[annotatelevel='0']{
    background-color:#9F0;
  }

  .annotationFocus[annotatelevel='1']{
    background-color:#C2DCAB;
  }

  .annotationFocus[annotatelevel='2']{
    background-color:#D6F0BF;
  }

  .jQueryTextAnnotaterDialog{
    z-index: 999;
    position:absolute;
    display:none;
		border:0 !important;
  }

	.jQueryTextAnnotaterDialogRemoveButton {
		display:none;
	}
</style>