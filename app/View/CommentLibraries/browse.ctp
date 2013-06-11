<div id="sidebarleft">
	<h1><?php echo __('My Account') ?></h1>
	<div id="sidemenu">
		<ul>
			<li><a class="icon icon-calendar" href="/users/view/"><?php echo __('My Account') ?></a></li>
			<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
				<li><a class="icon icon-pay" href="/users/view/payments/"><?php echo __('Pay Plan') ?></a></li>
				<li class="active"><a class="icon icon-question" href="/comment_libraries/browse/"><?php echo __('Comments') ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>

<div id="maincolumn">
	<div id="classes-box" class="box-startbridge box-white rounded">
		<div class="box-head">
			
			<div class="box-actions">
				<ul>
					<li><a class="icon4 icon4-plus show-overlay" href="#createLib"><?php echo __('Create') ?></a></li>
				</ul>
			</div>
			
			<span class="icon2 icon2-question" style="width:56px;"></span>
			<h2><?php echo __('Commenting Libraries'); ?></h2>
			<div class="clear"></div>
		</div>
		
		<div class="box-content">
			<table class="table-type-1" id="table-classes">
				<thead>
					<tr>
						<th class="col1" valign="top"><a href="#" class="sort"><?php echo __('Library Name') ?></a></th>
						<th class="col2" valign="top" align="center" width="12%"><a href="#" class="sort"><?php echo __('Sharing') ?></th>
						<th class="col3" valign="top" align="center" width="12%"><a href="#" class="sort"><?php echo __('Last Edit') ?></th>
						<th class="col4" valign="top" align="center" width="12%"><a href="#" class="sort"><?php echo __('Status') ?></th>
						<th class="col7" width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($user['CommentLibrary'] as $k=>$l){ ?>
						<tr<?php if(!($k % 2)){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.deleteChallenge').show();" onmouseout="$(this).find('.deleteChallenge').hide();">
							<td class="col1"><a href="/comment_libraries/update/<?php echo $l['id']; ?>" class="show-overlay"><?php echo $l['name']; ?></a></td>
							<td class="col2"><?php echo (count($l['LibUser']) > 1 ? 'Shared' : ''); ?></td>
							<td class="col3"><?php echo date_format(date_create($l['date_modified']),'m/d/Y'); ?></td>
							<td class="col4"><?php echo (@$l['active'] ? 'Active' : 'Inactive'); ?></td>
							<td class="col7">
								<div class="item-actions">
									<a href="#" class="item-actions-icon"></a>
									<div class="item-actions-popup rounded2">
										<ul>
											<li><a href="/comment_libraries/clone_lib/<?php echo $l['id']; ?>" class="icon3 icon3-customize" style="width:58px;"><?php echo __('Clone') ?></a></li>
											<li><a href="/comment_libraries/update/<?php echo $l['id']; ?>" class="icon3 icon3-pen show-overlay" style="width:58px;"><?php echo __('Edit') ?></a></li>
											<li><a href="#deleteLib" onclick="$('#deleteLink').attr('href','/comment_libraries/delete/<?php echo $l['id']; ?>');" class="icon3 icon3-close show-overlay" style="width:58px;"><?php echo __('Remove') ?></a></li>
										</ul>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div>
	
</div><!-- #maincol-->
<div class="clear"></div>

<div style="display: none;">
	<a href="#createSharing" class="show-overlay" id="setSharingLink"></a>
	<div id="createLib">
		<form id="create_library">
			<input type="hidden" name="library[CommentLibrary][owner_id]" value="<?php echo $user['User']['id']; ?>" />
			<input type="hidden" name="library[User][][user_id]" value="<?php echo $user['User']['id']; ?>" />
			<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
				<div class="modal-box-head">
					<span class="icon icon-plus"></span>
					<h2 style="float:left;padding-top:8px;"><?php echo __('Create a Library') ?></h2>
					<input style="float:right;width:175px;margin-top:7px;" name="library[CommentLibrary][name]" value="Name of Library" id="libName" onfocus="if($(this).val()=='Name of Library'){ $(this).val(''); }" />
					<div class="clear"></div>
				</div>
				<div class="modal-box-content">
					<p><?php echo __('Write your comments') ?></p>
					<?php for($i=0;$i<8;$i++){ ?>
						<div onmouseover="$('.remove-class-link',this).show();" onmouseout="$('.remove-class-link',this).hide();">
							<input style="width:95%;margin:4px 0;" name="library[LibraryComment][][comment]" <?php if($i == 7){ ?>onfocus="$(this).parent().before($('<div />').append($(this).parent().clone().html()));$(this).parent().prev().find('input').attr('onfocus','');$(this).parent().prev().find('input').focus();"<?php } ?> />
							<?php if($i != 7){ ?><a href="#" onclick="$(this).parent().remove();return false;" class="remove-class-link icon3-close" style="width:13px;height:13px;display:inline-block;float:right;margin-top:8px;display:none;"> </a><?php } ?>
						</div>
					<?php } ?>
					
					<br />
					<div align="center" id="warning" style="display:none;font-size:14px;color:#ff0000;"> You must enter a library name </div><br/>
					<div class="clear"></div>
					<div style="width: 155px; margin: 0 auto; ">
						<a href="#" class="btn2" onclick="create_library();" class="btn2" style="width:150px;float:left;"><span><?php echo __('Next Step: Sharing') ?></span></a>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div id="createSharing">
		<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon icon-plus"></span>
				<h2><?php echo __('Sharing') ?></h2>
			</div>
			<div class="modal-box-content">
				<p><?php echo __('Please enter the email addresses of the people you would like to share this commenting library with, separated by a comma:') ?></p>
				<form action="/comment_libraries/update/" method="POST" id="sharingForm">
					<input type="hidden" name="id" id="newLibID" />
					<textarea style="width:98%;height:100px;" name="sharing"></textarea>
				</form>
				
				<br />
				<div class="clear"></div>
				<div style="width: 330px; margin: 15px auto 20px auto; ">
					<div style="width: 135px; float: left; margin-right:15px;	">
						<a href="#" class="btn2" style="width: 100%" onclick="$('#sharingForm').submit();return false;">
							<span><?php echo __('Save and Finish') ?></span>
						</a>
					</div>
					<div style="width: 90px; float: left; margin-right:15px;	">
						<a href="#" class="btn3 " style="width: 100%" onclick="jQuery.fancybox.close();return false;">
							<span><?php echo __('Cancel') ?></span>
						</a>
					</div>
				</div>	
				<div style="width: 80px; float: right; padding-top:7px;">
					<a href="/comment_libraries/update/" id="sharingBack" class="show-overlay"><?php echo __('Go Back') ?></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<div id="deleteLib">
		<div id="modal-addclass-box" class="modal-joinsharedclass-box modal-wrapper" style="width: 600px;" >
			<div class="modal-box-head">
				<span class="icon icon-confirm"></span>
				<h2 style="float:left;"><?php echo __('Remove') ?></h2>
				<div class="clear"></div>
			</div>
			<div class="modal-box-content" style="text-align:center;">
				<h2 style="font-size:18px;color:#00467E;font-weight:normal;">Are you sure you want to remove yourself from this list?</h2>
				<p style="line-height:25px;"><?php echo __('If you are the creator, you will permanently delete this library. If not, you will remove yourself from the owners list. The owner will be able to add you again.') ?></p>
				<br />
				
				<div class="clear"></div>
				<div style="width: 235px; margin: 15px auto 20px auto; ">
					<div style="width: 100px; float: left; margin-right:15px;	">
						<a href="#" class="btn2" style="width: 100%" id="deleteLink">
							<span><?php echo __('Remove') ?></span>
						</a>
					</div>
					<div style="width: 100px; float: left; margin-right:15px;	">
						<a href="#" class="btn3 " style="width: 100%" onclick="jQuery.fancybox.close();return false;">
							<span><?php echo __('Cancel') ?></span>
						</a>
					</div>
				</div>	
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function create_library(){
	if($('#libName').val() == ''){
		$('#warning').show();
	}else{
		$.ajax({url:'/comment_libraries/update/',data:$('#create_library').serialize(),type:'POST',success:function(r){
			$('#newLibID').val(r);
			$('#sharingBack').attr('href','/comment_libraries/update/' + r + '?showComments=1');
			$('#setSharingLink').click();
		}});
	}
}

	jQuery(document).ready(function($){
		
		$("#table-classes").tablesorter({ 
				sortList: [[0,0]],
				cssDesc: 'sortup',
				cssAsc: 'sortdown',
        textExtraction: function(node){ 
					return $(node).children('a').length ? $(node).children('a').html() : ($(node).children('div').length ? $(node).children('.activity-level').children('span').first().css('width') : $(node).html());
        } 
    });

		$("#table-classes").bind("sortEnd",function() { 
			$('#table-classes tbody tr').removeClass('alternate');
			var idx = 0;
			$('#table-classes tbody tr').each(function(){
				if(++idx % 2) $(this).addClass('alternate');
			});
		});
	
	}); 
	
</script>