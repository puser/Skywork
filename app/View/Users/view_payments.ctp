<div id="sidebarleft">
	<h1><?php echo __('My Account') ?></h1>
	<div id="sidemenu">
		<ul>
			<li><a class="icon icon-calendar" href="/users/view/"><?php echo __('My Account') ?></a></li>
			<li class="active"><a class="icon icon-pay" href="/users/view/payments/"><?php echo __('Pay Plan') ?></a></li>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div id="myaccount-box" class="box-startbridge box-white rounded">
		<div class="box-head">
			<span class="icon2 icon2-pay"></span>
			<h2><?php echo __('Purchase Plan') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="box-content">
			<form id="userData">
				<ul id="payments-accordion" class="accordion">
					<li class="alternate">
						<div class="accordion-trigger">
							<a class="btn1"><span><?php echo __('Select') ?></span></a>
							<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;"></div>
							<p><?php echo __('Standard Account (Free!)') ?></p>
							<div class="clear"></div>
						</div>
						<div class="accordion-content">
							<ul>
								<li><?php echo __('Create and/or participate in up to two assignments per month.') ?></li>
								<li><?php echo __('You and your students get up to 200MB of total storage per month.') ?></li>
								<li><?php echo __('Your challenges (videos, documents, etc.) can be up to 5MB.') ?></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="accordion-trigger">
							<a class="btn1" id="premium_select"><span><?php echo __('Select') ?></span></a>
							<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;"></div>
							<p><?php echo __('Premium Account - $9.99/month') ?></p>
							<div class="clear"></div>
						</div>
						<div class="accordion-content">
							<ul>
								<li><?php echo __('Create and/or participate in up to six assignments per month.') ?></li>
								<li><?php echo __('You and your students get up to 2 GB of storage in total storage.') ?></li>
								<li><?php echo __('Your challenges (videos, documents, etc.) can be up to 25 MB.') ?></li>
							</ul>
						</div>
					</li>
					<li class="alternate">
						<div class="accordion-trigger">
							<a class="btn1" id="platinum_select"><span><?php echo __('Select') ?></span></a>
							<div style="width: 64px;height: 12px;float:right;background: transparent url(/images/check_selected.png);margin: 6px 12px 0;display:none;"></div>
							<p><?php echo __('Platinum Account - $19.99/month') ?></p>
							<div class="clear"></div>
						</div>
						<div class="accordion-content">
							<ul>
								<li><?php echo __('Create and/or participate in unlimited assignments per month.') ?></li>
								<li><?php echo __('You and your students get up to 100GB in total storage.') ?></li>
								<li><?php echo __('Your challenges (videos, documents, etc.) are unlimited size.') ?></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="accordion-trigger">
							<a class="btn1 show-overlay" href="#modal-referral"><span><?php echo __('Referral') ?></span></a>
							<p><?php echo __('Institutional Package') ?></p>
							<p style="display:none;color:#C1272D;">Think your Institution should pay for this? Send a referral here!</p>
							<div class="clear"></div>
						</div>
						<div class="accordion-content">
							<ul>
								<li><?php echo __('Create and/or participate in unlimited assignments per month.') ?></li>
								<li><?php echo __('You and your students get unlimited storage.') ?></li>
								<li><?php echo __('Your challenges (videos, documents, etc.) are unlimited size.') ?></li>
							</ul>
						</div>
					</li>
				</ul>
			</form>
		</div>
	</div>
	<div class="clear"></div>
	
	<div id="payment_summary" class="box-startbridge box-white rounded" style="margin-top:15px;min-height:0;">
		<div class="box-head">
			<span class="icon2 icon2-dollar"></span>
			<h2><?php echo __('Payment Method') ?></h2>
			<div class="clear"></div>
		</div>
		<div class="box-content">
			<p>Payments &nbsp;&nbsp;<a href="/users/update_payment/PREMIUM/" id="edit_payment_method" class="show-overlay">edit</a></p>
			<?php if($user['User']['card_token']){ ?>
				<span style="font-size:12px;"><?php echo $user['User']['card_type']; ?> ending in <?php echo substr($user['User']['card_token'],-4); ?></span><br /><br />
				Next Payment is
				<?php
				$pmyt = date_create($user['User']['last_payment']);
				date_add($pmyt,date_interval_create_from_date_string('1 month'));
				echo date_format($pmyt,'F j, Y');
				?>
			<?php }else{ ?>
				<span style="font-size:12px;">No payment method has been added yet.<br /><br /></span>
			<?php } ?>
		</div>
	</div>
	
	<!--
	<div class="clear"></div>
	<div style="width: 95px; margin: 0 auto; ">
		<a href="#" class="btn2 btn-savecontinue aligncenter" style="width: 80px; float: left;" onclick="if($('.accordion>li:last .accordion-content').is(':visible')){ $('#showReferral').click(); }return false;"><span style="width:64px;" class="inner"><?php echo __('Save') ?></span></a>
		<span id="savedNotify" style="display:none;">
			<p style="display:block;text-align:center;color:#ff0000;"><?php echo __('Saved!') ?></p>
		</span>
	</div>
	-->
	
</div>
<div class="clear"></div>


<div style="display: none; ">
	<div id="modal-referral">
		<div class="modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon3 icon-refer"></span>
				<h2><?php echo __('Send a Referral') ?></h2>
			</div>
			<div class="modal-box-content">
				<form action="" method="post">	
					<p>To</p>
					<input type="text" style="width:585px;padding:5px;" value="Enter emails here separated by a comma" /><br /><br />
					<p>Subject</p>
					<input type="text" style="width:585px;padding:5px;" value="Puentes - Assignments. On Demand." /><br /><br />
					<p>Email Body</p>
					<textarea style="width:585px;padding:5px;height:150px;">I'd like to send my recommendation for Puentes - Assignments. On Demand. I've been using it lately and it's really useful!</textarea>
				</form>
				<div class="clear"></div>
				<div style="width: 140px; margin: 0 auto; ">
					<a class="btn2" style="width: 100%" href="/users/view/payments/"><span><?php echo __('Finish and Send') ?></span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('.accordion-trigger a').click(function(){
	$(".accordion-trigger").each(function(){ $(this).find('div').first().hide(); });
	$(this).parent().find('a').first().hide();
	$(this).parent().find('div').first().show();
		
	if($(this).parent().parent().index('.accordion>li') == 1 || $(this).parent().parent().index('.accordion>li') == 2){
		$('#payment_summary').show();
		$('#edit_payment_method').click();
	}else $('#payment_summary').hide();
});

$(".accordion-trigger").click(function(){
	if($(this).parent().hasClass('open')) return false;
	
	$("li.open .accordion-content", $(this).closest("ul.accordion")).slideUp(300); 
	$("li", $(this).closest("ul.accordion")).removeClass("open"); 
	$(this).closest("li").addClass("open"); 
	$(".accordion-content", $(this).closest("li")).slideDown(300); 
		
	//$(".accordion-trigger").each(function(){ $(this).find('a').first().show(); });
	//$(".accordion-trigger").each(function(){ $(this).find('div').first().hide(); })
		
	if($(this).parent().index('.accordion>li') == 3){
		$(this).find('p').first().hide();
		$(this).find('p').last().show();
	}else{
		$('.accordion>li:last').find('p').first().show();
		$('.accordion>li:last').find('p').last().hide();
	}
});

<?php if($user['User']['account_tier'] == 'PLATINUM'){ ?>
	$('#platinum_select').click();
	$('#platinum_select').hide();
	$('#platinum_select').parent().find('div').first().show();
	$('#payment_summary').show();
<?php }elseif($user['User']['account_tier'] == 'PREMIUM'){ ?>
	$('#premium_select').click();
	$('#premium_select').hide();
	$('#premium_select').parent().find('div').first().show();
	$('#payment_summary').show();
<?php }else{ ?>
	$(".accordion-trigger p").first().click();
<?php } ?>
</script>