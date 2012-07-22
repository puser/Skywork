<div id="seeCase" class="round round-white">
	<div class="inner-seeCase">
		<div class="body">
			<div class="body-r">
				<div class="content">
					<div class="box-heading">
						<div class="icon icon-preview"></div>
						<h2 class="page-subtitle">See Case</h2>
						<div class="action-buttons">
							<div class="action-button action-buttons-notokay alignright">
								<?php if(@$_REQUEST['fromEmail']){ ?>
									<a href="/challenges/view/<?php echo $attachment['Challenge']['id']; ?>" style="width:120px;" class="btn2"><span style="width:105px;" class="inner">Go to Questions</span></a>
								<?php }else{ ?>
									<a style="cursor:pointer;" onclick="window.history.go(-1);" class="btn2"><span class="inner">Back</span></a>
								<?php } ?>
							</div>

						</div>
					</div>
					<div id="preview-case" style="clear:both;text-align:center;">

						<iframe src="http://docs.google.com/viewer?url=http%3A%2F%2Fcaseclubonline.com%2Fuploads%2F<?php echo $attachment['Attachment']['file_location']; ?>&embedded=true" width="720" height="500" />
						
					</div><!-- #preview-case-->
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div>
</div><!-- #seeCase-->