<div class="box-head">
	<span class="icon2 icon2-listcountgreen"><?php echo $q_num; ?></span>
	<h2 ><?php echo ($question['Challenge']['response_types'] == 'E' ? 'Essay' : 'Question ' . $q_num); //stripslashes($question['Question']['section']); ?></h2>
	<div class="clear"></div>
</div>
<div class="box-content">
	<form id="responseData">
		<input type="hidden" name="question_id" id="question_id" value="<?php echo $question['Question']['id']; ?>" />
		<input type="hidden" id="challenge_id" value="<?php echo $question['Challenge']['id']; ?>" />
		<?php if(@$question['Response'][0]){ ?><input type="hidden" name="id" value="<?php echo $question['Response'][0]['id']; ?>" /><?php } ?>
		<input type="hidden" id="next_id" value="<?php echo (@$next_id ? $next_id : ($question['Challenge']['allow_attachments'] ? 'attachments' : 'dashboard')); ?>" />
		
		<ul class="fieldset2">
			<li>
				<p class="label-text ">
					<span class="black6">
						<?php echo stripslashes($question['Question']['question']); ?>
					</span>
				</p>
				<textarea class="niceTextarea" name="response_body" rows="10" style="font-family:Helvetica, Arial, sans-serif;font-size: 12px;width:735px;"><?php echo str_replace("\\",'',stripslashes(@$question['Response'][0]['response_body'])); ?></textarea>
			</li>
		</ul>
	</form>
</div>

<script type="text/javascript">
String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};

function limitText(limitField){
	limitNum = <?php echo (@$question['Challenge']['max_response_length'] ? $question['Challenge']['max_response_length'] : '1000000'); ?>;
	spaces = limitField.val().trim().match(/ /g);
	if(limitField.val() && (spaces ? spaces.length : 0) + 1 > limitNum){
		<?php if($question['Challenge']['max_response_length'] && $question['Challenge']['allow_exceeded_length'] != 1){ ?>
			do{
				limitField.val(limitField.val().substr(0,limitField.val().lastIndexOf(' ')));
			}while((spaces ? spaces.length : 0) + 1 > limitNum);
		<?php } ?>
	}
	
	if(!limitField.val()) $('#currentWordCount').html('0');
	else{
		if(spaces) $('#currentWordCount').html(spaces.length + 1);
		else $('#currentWordCount').html('1');
	}
}
	
$textAreaOrigHeight = 264;
$("textarea.niceTextarea").keyup(function(){ 
	expandtext(this); 

	<?php if($question['Challenge']['max_response_length'] || $question['Challenge']['min_response_length'] > 1){ ?>
		limitText($(this));
	<?php } ?>
});

<?php if($question['Challenge']['max_response_length']){ ?>
	$("textarea.niceTextarea").keydown(function(){
		limitText($(this));
	});
<?php } ?>

limitText($('textarea.niceTextarea'));
</script>