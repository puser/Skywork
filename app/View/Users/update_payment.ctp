<div id="modal-cardinfo">
	<div class="modal-wrapper" style="width: 600px;" >
		<div class="modal-box-head">
			<span class="icon3 icon2-dollar"></span>
			<h2><?php echo __('Payment Method') ?></h2>
		</div>
		<div class="modal-box-content" id="processing_content" style="display:none;text-align:center;">
			<br /><br />Processing... Please wait.<br /><br />
		</div>	
		<div class="modal-box-content" id="cardinfo_content">
			
			<div style="line-height:25px;color:#567AA9;"><?php echo __('Please provide your credit card details below (all fields are required):') ?></div>
			<br />
			<form action="/users/process_payment/" method="POST" id="cardinfo_form">
				<input type="hidden" name="account_tier" value="<?php echo $tier; ?>" />
				<ul class="fieldset2">
					<li>
						<label><?php echo __('Cardholder Name') ?></label>
						<input type="text" name="card_name" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('Billing Address') ?></label>
						<input type="text" name="street" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('City') ?></label>
						<input type="text" name="city" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('Zip/Postal Code') ?></label>
						<input type="text" name="zip" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('State/Province') ?></label>
						<input type="text" name="state" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('Country') ?></label>
						<input type="text" name="country" size="75" style="width:400px;margin-left:-20px;" />
					</li>
					<li>
						<label><?php echo __('Card Number') ?></label>
						<input type="text" name="card_num" size="75" style="width:400px;margin-left:-20px;"/>
					</li>
					<li>
						<label><?php echo __('Expiration Date (format as MMYY)') ?></label>
						<input type="text" name="card_expiry" size="75" style="width:400px;margin-left:-20px;"/>
					</li>
					<li style="clear:both;">
						<label><?php echo __('CVV Code') ?></label>
						<input type="text" name="card_code" size="75" style="width:400px;margin-left:-20px;"/>
					</li>
				</ul>
			</form>
			
			<div class="clear"></div>
			<div style="width: 170px; margin: 0 auto; ">
				<a href="#" class="btn2" style="width: 80px; float:left" onclick="submit_payment_info();return false;"><span><?php echo __('Save') ?></span></a>
				<a href="#" class="btn3" style="width: 80px; float: right;" onclick="jQuery.fancybox.close();return false;"><span><?php echo __('Cancel') ?></span></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function submit_payment_info(){
	$('#cardinfo_content').hide();
	$('#processing_content').show();
	$.ajax({url:'/users/update_payment/',data:$('#cardinfo_form').serialize(),type:'POST',success:function(r){
		if(r == 'success'){
			$('#processing_content').html('<br /><br />Your card details were accepted and the payment was processed successfully. This page will reload momentarily...<br /><br />');
			setTimeout(function(){
				window.location = '/users/view/payments/';
			},3200);
		}else{
			$('#processing_content').html('<br /><br />There was an error processing your payment:<br /><br />' + r + '<br /><br />');
		}
	}});
}
</script>