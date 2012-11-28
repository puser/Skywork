<div>
	<a href="#modalSessionEnd" visible="false" id="exitTrigger"><?php echo __('Logged Out') ?></a>
	<div style="display: none;">
		<div id="modalSessionEnd">
			<div class="box-heading" style="border-bottom: 1px solid #E6E6E6;">
				<span class="icon icon-key"></span>
				<h2 class="page-subtitle label-text"><?php echo __('Logged Out') ?></h2>
			</div>

			<br />
			<p class="caseclubFont18 blue textAlignCenter" style="width:490px; text-align: center;"><?php echo __('Your current Puentes session has ended.') ?></p>
			<br /><br /><br />
			<div class="exitSaveOptions">
				<a href="/" class="btn2 btn-savecontinue aligncenter background: url('/images/btn2-right.png') no-repeat right top;"><span class="inner"><?php echo __('Go to Homepage') ?></span></a>
			</div>
		</div><!-- #modalExitChoices -->
	</div>
	<script type="text/javascript">
	$("#exitTrigger").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true
	});
	$(function(){ $('#exitTrigger').click(); });
	</script>
</div>