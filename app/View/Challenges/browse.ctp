<div id="caseclub-list-wrap">

	<h1 class="page-title">Home</h1>
	
	<?php if($_SESSION['User']['user_type'] == 'L'){ ?>
	<div id="create-new-challenge" class="round round-white width50">
		<div class="head"><div class="tl"></div><div class="tr"></div></div>
		<div class="body">
			<div class="body-r">
				<div class="content">
					<span class="icon"><img src="/images/icon-new-doc.png" /></span>
					<span class="page-subtitle"><a href="/challenges/update/">Create New Challenge</span></a>
					<span class="start-button"><a href="/challenges/update/" class="btn1"><span class="inner">START</span></a></span>			
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
	</div><!-- #create-new-challenge -->
	<?php } ?>
	
	<div id="caseclub-list" class="round round-white" style="overflow:hidden;position:relative;">
		<div class="head"><div class="tl"></div><div class="tr"></div></div>
		<div class="body" style="width:984px;">
			<div class="body-r">
				<div class="content">

					<div id="caseclub-list-top" >
						<span class="icon"><img src="/images/icon-briefcase.png" /></span>
						<h2 class="page-subtitle">Challenges</h2>
						<form>
							<div id="caseclub-list-filter">
								<div id="caseclub-list-filter-by-cat" >
									<select class="cat" onchange="window.location = '/challenges/browse/'+$(this).val();">
										<option value="" onclick="window.location = '/challenges/browse/';">All</option>
										<option value="c"<?php if($status=='c') echo ' selected="selected";'; ?>>Completed</option>
										<option value="d"<?php if($status=='d') echo ' selected="selected";'; ?>>Draft</option>
										<option value="n"<?php if($status=='n') echo ' selected="selected";'; ?>>New</option>
									</select>
								</div>
								<div class="clear"></div>
							</div>
						</form>
						<div class="clear"></div>
					</div><!-- #caseclub-list-top -->
					
					<div id="caseclub-list-table" class="caseclub-table">
						<div class="cl-head">
							<ul>
								<li class="col1"><a href="/dashboard/?sort=name&dir=<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">Case Name <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='name'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" /></a></li>
								<li class="col2" >

									<a href="/dashboard/?sort=answer_date&dir=<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">Due Date 1 <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='answer_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" /></a>
									<a href="#tooltip" class="tooltip-q">
										<span class="tooltip-q-text">Members read case/answer questions</span>
									</a>
								</li>
								<li  class="col3">
									<a href="/dashboard/?sort=response_date&dir=<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">Due Date 2 <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='response_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" /></a>

									<a href="#" class="tooltip-q">
										<span class="tooltip-q-text">Members complete Agree/Disagree</span>
									</a>
								</li>
								<li class="col4"><a href="/dashboard/?sort=edit_date&dir=<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">Last Edit <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='edit_date'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" /></a></li>
								<li class="col5"><a href="/dashboard/?sort=creator&dir=<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'d':'a'); ?>">Creator <img src="/images/arrow-<?php echo (@$_REQUEST['sort']=='creator'&&@$_REQUEST['dir']=='a'?'up':'down'); ?>.png" /></a></li>
							</ul>

							<div class="clear"></div>
						</div>
						<div class="cl-body">
							<ul id="listingPage0" class="listingPage">
								<?php
								$idx_offset = 0;
								$pages = 1;
								$now = date_create();
								$now->setTime(0,0);
								foreach($challenges as $k=>$challenge){
									if(!$challenge){
										$idx_offset++;
										continue;
									}elseif($k-$idx_offset && !(($k-$idx_offset)%10)){ $pages++; ?>
										</ul><ul style="display:none;" class="listingPage" id="listingPage<?php echo (($k-$idx_offset)/10); ?>">
									<?php } ?>
								<li<?php if(!(($k-$idx_offset)%2)){ ?> class="alternate"<?php } ?> onmouseover="$(this).find('.deleteChallenge').show();" onmouseout="$(this).find('.deleteChallenge').hide();">
									<div class="col1 alignleft">
										<a href="/challenges/<?php echo ($challenge['Challenge']['status'] == 'D' ? 'update' : 'view'); ?>/<?php echo $challenge['Challenge']['id']; ?>"<?php if(@$challenge['Users']){ ?> onclick="show_user_list($(this).parent(),<?php echo $challenge['Challenge']['id']; ?>,<?php echo (date_create($challenge['Challenge']['responses_due']) < $now ? '1' : '0'); ?>);return false;"<?php }elseif(date_create($challenge['Challenge']['answers_due']) < $now){ ?> onclick="alert('None of this challenge\'s other participants have met the response deadline.');return false;"<?php } ?>>
											<?php echo $challenge['Challenge']['name']; ?>
										</a>
										
										<?php if(date_create($challenge['Challenge']['answers_due']) >= $now){ ?>
											<?php if($challenge['Challenge']['status'] == 'D'){ ?><span class="new">CREATE</span>
											<?php }elseif(@$challenge['Status'][0]['status']=='D'){ ?><span class="new">DRAFT</span>
											<?php }elseif(!@$challenge['Status'] || @$challenge['Status'][0]['status']=='N'){ ?><span class="new">NEW</span><?php } ?>
										<?php } ?>
										
										<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?>
											<a href="/responses/view/<?php echo @$challenge['Question'][0]['id']; ?>" class="alignright viewAllRequests" style="display:none;padding-right:24px;">View All Comments</a>
										<?php } ?>
									</div>
									<div class="col2 alignleft" style="overflow:hidden;"><?php echo date_format(date_create($challenge['Challenge']['answers_due']),'m/d/Y'); ?></div>
									<div class="col3 alignleft"><?php echo date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y'); ?></div>
									<div class="col4 alignleft"><?php echo date_format(date_create($challenge['Challenge']['date_modified']),'m/d/Y'); ?></div>
									<div class="col5 alignleft"><?php echo @$challenge['User']['firstname'].' '.@$challenge['User']['lastname']; ?></div>
									<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?>
										<div class="col6 alignleft"><img src="/images/graph-tiny.png" class="graphIcon" style="position:absolute;" /></div>
									<?php }elseif($challenge['Challenge']['status'] == 'D'){ ?>
										<div class="col6 alignleft deleteChallenge" style="display:none;">
											<a href="/challenges/delete/<?php echo $challenge['Challenge']['id']; ?>/" style="position:relative;left:65px;top:2px;">
												<img src="/images/icon-x.png" style="position:absolute;">
											</a>
										</div>
									<?php } ?>
									<div class="clear"></div>
									<?php if(@$challenge['Users']){ ?>
									<ul class="opened-users" style="display:none;">
										<li>You</li>
										<?php
										$user_count = 0;
										$l = 0;
										foreach($challenge['Users'] as $u){ 
											if($u['id']==$_SESSION['User']['id']) continue;
											$user_count++; ?>
										<li class="<?php if(!@$u['completed_responses']){ ?>dot-red<?php }if(!(@$l%2)){ ?> alternate<?php } ?>">
											<a href="/responses/view/<?php echo $u['next_question']; ?>/<?php echo $u['id']; ?>"<?php if(date_create($challenge['Challenge']['responses_due']) < $now){ ?> onclick="alert('This challenge has expired.');return false;"<?php } ?>>
												<?php echo ($challenge['Challenge']['challenge_type'] == 'A' ? 'Anonymous User #'.$user_count : "{$u['firstname']} {$u['lastname']}"); ?>
											</a><!-- <span class="draft">DRAFT</span> -->
										</li>
										<?php @$l++; } ?>
									</ul>
									<div class="clear"></div>
									<?php } ?>
								</li>
								<?php }if(!$challenges || $idx_offset == count($challenges)){ ?>You do not yet have access to any challenges.<?php } ?>
							</ul>
							<div class="clear"></div>
						</div>
					</div><!-- #caseclub-list-table -->
					
					<div id="caseclub-list-foot">
						<div class="pagination">
							<?php if($pages > 1){ ?>
							<div class="alignleft pagination-prev"><a href="#">Previous</a></div>
							<div class="alignright pagination-next"><a href="#">Next</a></div>
							<div class="aligncenter pagination-pages">

								<ul>
									<?php for($i=0;$i<$pages;$i++){ ?>
									<li<?php if(!$i){ ?> class="active"<?php } ?>><a href="#"><?php echo $i+1; ?></a></li>
									<?php } ?>
								</ul>
							</div>
							<script type="text/javascript"> init_pagination(); </script>
							<?php } ?>
							<div class="clear"></div>
						</div>
					</div><!-- #caseclub-list-foot -->
					
				</div>
			</div>
		</div>
		<div class="foot"><div class="fl"></div><div class="fr"></div></div>
		<div style="position:absolute;right:0px;top:0px;width:10px;background:#fff;height:95%;margin:12px 0;border-right:1px solid #eee;display:none;" id="thinListBorder"> </div>
	</div>
	
	<div id="home-leaderboard" class="alignright round round-white width50" style="display:none;width:0px;height:430px;"> </div>
	
	<div class="clear"></div>
</div><!-- #caseclub-list-wrap -->