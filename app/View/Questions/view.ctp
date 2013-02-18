<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode: "exact",
		elements: "response_body",
		theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;",
    content_css: "/css/mce_content.css",
    language: false, // Prevents language packs from loading

    theme: function(editor, target) {
        // Generate UI
        var editorContainer = $(target).after(
            '<div>' +
                '<div style="padding: 2px;position: absolute;width: 735px;top: 8px;" class="control_container">' +
                    '<input type="checkbox" id="italic" data-mce-command="italic" /><label for="italic"><img src="/images/mce_controls/italic.png" /></label>' +
										'<input type="checkbox" id="bold" data-mce-command="bold" /><label for="bold"><img src="/images/mce_controls/bold.png" /></label>' +
										'<input type="checkbox" id="underline" data-mce-command="underline" /><label for="underline" class="underlineLabel"><img src="/images/mce_controls/underline.png" /></label>' +
										'<input type="checkbox" id="fontsize" data-mce-command="fontsize" data-mce-value="16px" /><label for="fontsize" class="sizeLabel"></label>' +
                '</div>' +
                '<div></div>' +
            '</div>'
        ).next();

        // Bind events for each button
				$("input[type=checkbox]", editorContainer).hide();
        $("button,input", editorContainer).click(function(e) {
            e.preventDefault();

						$(this).next().toggleClass('active');

            // Execute editor command based on data parameters
            editor.execCommand(
                $(this).attr('data-mce-command'),
                false,
                $(this).attr('data-mce-value')
            );
        });

        // Register state change listeners
        editor.onInit.add(function() {
            $("input", editorContainer).each(function(i, button) {
                editor.formatter.formatChanged($(button).attr('data-mce-command'), function(state) {
                    $(button).attr('checked', state);//.button('refresh');

										if($(button).attr('checked')) $(button).next().addClass('active');
										else $(button).next().removeClass('active');
                });
            });
        });

        // Set editor container with to target width
        editorContainer.css('width', '735px');

        // Return editor and iframe containers
        return {
            editorContainer: editorContainer[0],
            iframeContainer: editorContainer.children().eq(-1),

            // Calculate iframe height: target height - toolbar height
            iframeHeight: $(target).height() - editorContainer.first().outerHeight()
        };
    }
});

tinyMCE.DOM.setStyle(tinyMCE.DOM.get("response_body" + '_ifr'), 'height', '264px');
tinyMCE.DOM.setStyle(tinyMCE.DOM.get("response_body" + '_ifr'), 'width', '735px');
</script>

<span id="saveNotify"></span>

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
				<textarea class="niceTextarea" id="response_body" name="response_body" rows="10" style="font-family:Helvetica, Arial, sans-serif;font-size: 12px;width:735px;"><?php echo str_replace("\\",'',stripslashes(@$question['Response'][0]['response_body'])); ?></textarea>
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

setInterval(function(){
	$('#saveNotify').html('(Saving...)').show();
	save_response('auto');
	setTimeout(function(){
		$('#saveNotify').html('Saved');
		setTimeout(function(){
			$('#saveNotify').hide();
		},2000);
	},2000);
},30000);
</script>