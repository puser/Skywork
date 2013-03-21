<?php
class ChallengesController extends AppController{
	var $name = 'Challenges';
	var $uses = array('User','Challenge','ClassSet','Status','Response','Group','UsersGroup','Comment','ChallegesClasses');
	
	// view all challenges (dashboard)
	function browse($status=NULL,$page=1){
		$this->checkAuth();
		$this->Challenge->Behaviors->attach('Containable');
		$conditions = array();
		
		$this->Challenge->hasMany['Status']['conditions'] = array("Status.user_id = {$_SESSION['User']['id']}");
		
		if($status == 'd') $conditions[] = 'Challenge.status = "D"';
		elseif($status == 'a') $conditions[] = 'Challenge.answers_due > CURDATE()' . ($_SESSION['User']['user_type'] == 'L' ? ' || (Challenge.responses_due > CURDATE() && Challenge.collaboration_type != "NONE")' : '');
		elseif($status == 'f') $conditions[] = 'Challenge.responses_due < CURDATE() && Challenge.collaboration_type != "NONE"';
		elseif($status == 'e') $conditions[] = '(Challenge.eval_complete = 0 || Challenge.eval_complete IS NULL && ((Challenge.answers_due < CURDATE() && Challenge.collaboration_type = "NONE") || (Challenge.responses_due < CURDATE() && Challenge.collaboration_type != "NONE")))';
		
		if($_SESSION['User']['user_type'] != 'L') $conditions[] = 'Challenge.status != "D"';
		if(@$_SESSION['User']['date_created']) $conditions[] = 'Challenge.answers_due > "'. $_SESSION['User']['date_created'] . '"';
		
		if(@$_REQUEST['sort']=='name') $sort = 'Challenge.name';
		elseif(@$_REQUEST['sort']=='answer_date') $sort = 'Challenge.answers_due';
		elseif(@$_REQUEST['sort']=='response_date') $sort = 'Challenge.responses_due';
		elseif(@$_REQUEST['sort']=='edit_date') $sort = 'Challenge.date_modified';
		elseif(@$_REQUEST['sort']=='creator') $sort = 'User.lastname '.(@$_REQUEST['dir']=='a' || !@$_REQUEST['sort'] ? 'DESC' : 'ASC').',User.firstname';
		else $sort = 'Challenge.date_modified';
		
		if(@$_REQUEST['dir']=='a' || !@$_REQUEST['sort']) $sort .= ' DESC';
		else $sort .= ' ASC';
		
		// get a list of challenge ids that user's classes has access to
		$this->User->hasMany['Status']['conditions'] = 'Status.challenge_id IS NULL';
		$this->User->hasMany['Status']['order'] = 'Status.id ASC';
		$user = $this->User->findById($_SESSION['User']['id']);
		$groups = array();
		foreach(@$user['ClassSet'] as $g){
			if($user['User']['user_type'] != 'L' || $g['owner_id'] == $user['User']['id']) $groups[$g['id']] = 1;
		}
		
		if($groups){
			$full_groups = implode(',',array_keys($groups));
			$cids = $this->Challenge->query('select group_concat(distinct challenge_id separator ",") as g from challenges_classes where class_id in ('.$full_groups.') group by class_id');
			$cs = '';
			foreach($cids as $cid) $cs .= ($cs ? ',' : '') . $cid[0]['g'];
			$cids = $this->Challenge->query('select group_concat(distinct challenge_id separator ",") as g from challenges_collaborators where user_id = '.$_SESSION['User']['id']);
			$cs .= ($cs && $cids[0][0]['g'] ? ',' : '') . $cids[0][0]['g'];
			if($cs){
				$conditions[] = '(Challenge.id IN ('.$cs.') || Challenge.user_id = '.$_SESSION['User']['id'].')';
			}
		}
		
		$challenges = $this->Challenge->find('all',array('conditions'=>$conditions,'order'=>$sort,'contain'=>array('Collaborator'=>array('fields'=>array('Collaborator.id','Collaborator.user_type','Collaborator.firstname','Collaborator.lastname')),'User','Question'=>array('fields'=>array('Question.id')),'Status','ClassSet'=>array('User'=>array('fields'=>array('User.id,User.firstname,User.lastname','User.email'))),'Group'=>array('User'=>array('fields'=>array('User.id,User.firstname,User.lastname,User.email'))))));
		
		$join_dates = array();
		foreach(@$user['Status'] as $s) $join_dates[$s['class_id']] = date_create($s['date_created']);
									
		$now = date_create();
		//$now->setTime(0,0);
		foreach($challenges as $k=>$c){
			$vis = false;
			foreach($c['ClassSet'] as $g){
				if((@$groups[$g['id']] && date_create($c['Challenge']['date_modified']) > @$join_dates[$g['id']]) || $g['owner_id'] == $user['User']['id']){
					$vis = true;
					break;
				}
			}
			foreach($c['Collaborator'] as $u){
				if($u['user_type'] == 'P') @$challenges[$k]['Users'] = is_array($challenges[$k]['Users']) ? array_merge($challenges[$k]['Users'],array("{$u['firstname']} {$u['lastname']}" => $u)) : array("{$u['firstname']} {$u['lastname']}" => $u);
				
				if($u['id'] == $_SESSION['User']['id'] && $c['Challenge']['status'] != 'D'){
					$vis = true;
					// depreciated; collaborator functionality repurposed for former students, etc:
					// $challenges[$k]['collaborator'] = true;
					break;
				}
			}
			
			if(!$vis && $c['User']['id'] != $_SESSION['User']['id']){
				$challenges[$k] = NULL;
				continue;
			}
			
			if(($status == 'd' && $c['Challenge']['status'] != 'D' && !count($c['Status'])) 
				|| ($status == 'n' && (count($c['Status']) && @$c['Status']['status'] != 'N'))
				|| $c['Challenge']['challenge_type'] == 'T'){
				$challenges[$k] = NULL;
				continue;
			}
			
			$answers_due = date_create($c['Challenge']['answers_due']);
			if($answers_due < $now){
				$ulist = $challanges[$k]['Users'] = array();
				
				foreach(($_SESSION['User']['user_type'] == 'P' && $c['Group'] ? $c['Group'] : $c['ClassSet']) as $g){
					$user_group = false;
					$user_buffer = array();
					foreach($g['User'] as $u){
						if(array_search($u['id'],$ulist) !== false) continue;
						if($u['id'] == $_SESSION['User']['id']) $user_group = true;
						
						$check_responses = $this->Challenge->find('first',array('conditions'	=> "Challenge.id = {$c['Challenge']['id']}",
																				'contain'		=> array('Question'=>array('Response'=>array('conditions'=>"Response.user_id = {$u['id']}")))));
						$completed_responses = true;
						$r_ids = array();
						foreach($check_responses['Question'] as $q){
							if(!$q['question']) continue;
							
							if(!@$q['Response'][0]){
								$completed_responses = false;
								break;
							}else $r_ids[] = $q['Response'][0]['id'];
						}
						
						if($completed_responses && count($c['Question'])){
							$ulist[] = $u['id'];
							
							if($r_ids) $r_count = $this->Response->find('count',array('conditions'=>array(	'Response.response_id IN ('.implode(',',$r_ids).')',
																											'Response.user_id'	=> $_SESSION['User']['id'] )));
							else $r_count = array();
							
							if(!$r_count || $r_count >= count($c['Question'])) $u['next_question'] = $c['Question'][0]['id'];
							else $u['next_question'] = $c['Question'][$r_count]['id'];
							if($r_count >= count($c['Question'])) $u['completed_responses'] = true;
							
							$user_buffer["{$u['firstname']} {$u['lastname']}"] = $u;
						}
					}
					if(($_SESSION['User']['user_type'] == 'P' && $c['Group'] && $user_group) || (!($_SESSION['User']['user_type'] == 'P' && $c['Group']))){
						@$challenges[$k]['Users'] = is_array($challenges[$k]['Users']) ? array_merge($challenges[$k]['Users'],$user_buffer) : $user_buffer;
					}
				}
				@ksort($challenges[$k]['Users']);
			}
		}
		
		$challenges = array_filter($challenges);
		
		$limit_reached = $monthly_count = false;
		if($_SESSION['User']['user_type'] == 'L'){
			$monthly_count = $this->Challenge->find('count',array('conditions'=>array('Challenge.user_id'=>$_SESSION['User']['id'],'Challenge.date_modified BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()')));
			if(($user['User']['account_tier'] == 'STANDARD' && $monthly_count >= 2) || ($user['User']['account_tier'] == 'PREMIUM' && $monthly_count >= 6)){
				$limit_reached = true;
				$monthly_count = 0;
			}elseif($user['User']['account_tier'] == 'STANDARD') $monthly_count = 2 - $monthly_count;
			elseif($user['User']['account_tier'] == 'PREMIUM') $monthly_count = 6 - $monthly_count;
			elseif($user['User']['account_tier'] == 'PLATINUM') $monthly_count = false;
		}
		
		$this->set('limit_reached',$limit_reached);
		$this->set('monthly_count',$monthly_count);
		$this->set('challenges',array_slice($challenges,($page - 1) * 10,10));
		$this->set('status',$status);
		$this->set('total',count($challenges));
		$this->set('page',$page);
	}
	
	// view a single challenge or stats/leaderboard
	function view($challenge_id,$view=NULL){
		$this->checkAuth($view);
		$challenge = $this->Challenge->find('first',array('conditions'=>"Challenge.id = {$challenge_id}",'recursive'=>2));
		
		// if this is the first time the user is viewing the challenge, set status to Draft
		$status = $this->Status->find('first',array('conditions'=>"Status.user_id = {$_SESSION['User']['id']} && Status.challenge_id = {$challenge_id}"));
		if(!$status || $status['Status']['status'] == 'N'){
			if($status){
				$this->Status->id = $status['Status']['id'];
				$this->Status->saveField('status','D');
			}else{
				$status = array(	'user_id' 			=> $_SESSION['User']['id'],
													'challenge_id'	=> $challenge_id,
													'status'				=> 'D' );
				$this->Status->save($status);
			}
		}
		
		if($view == 'leaderboard'){
			$users = array();
			foreach(($_SESSION['User']['user_type'] == 'P' && $challenge['Group'] ? $challenge['Group'] : $challenge['ClassSet']) as $g){
				$user_group = false;
				$user_buffer = array();
				foreach($g['User'] as $u){
					if($u['user_type'] != 'L'){
						if($u['id'] == $_SESSION['User']['id']) $user_group = true;
						
						@$user_buffer["{$u['firstname']} {$u['lastname']}"][0] = 0;
						@$user_buffer["{$u['firstname']} {$u['lastname']}"][1] = 0;
						foreach($challenge['Question'] as $q){
							//$this->Response->hasMany['Responses']['conditions'][] = 'Responses.response_type = "A"';
							//$this->Response->hasMany['Responses']['conditions'][] = "Responses.user_id = {$u['id']}";
							$res = $this->Response->find('first',array('conditions'=>array('Question.id'=>$q['id'],'User.id'=>$u['id']),'recursive'=>2));
							
							if(@$res['Comment']){
								foreach($res['Comment'] as $c){
									if(@$c['User']['user_type'] != 'L') @$user_buffer["{$u['firstname']} {$u['lastname']}"][$c['type']]++;
								}
							}
						}
					}
				}
				if(($_SESSION['User']['user_type'] == 'P' && $challenge['Group'] && $user_group) || (!($_SESSION['User']['user_type'] == 'P' && $challenge['Group']))){
					$users = @is_array($users) ? array_merge($users,$user_buffer) : $user_buffer;
				}
			}
			arsort($users);
			$this->set('users',$users);
		}elseif($view == 'stats'){
			// create an index of users
			$bridge_users = array();
			foreach($challenge['ClassSet'] as $c){
				foreach($c['User'] as $u) $bridge_users[$u['id']] = "{$u['firstname']} {$u['lastname']}";
			}
			
			// establish rankings
			$quality = $activity = array();
			foreach($challenge['Question'] as $k=>$q){
				foreach($q['Response'] as $i=>$r){
					$conditions = array('Response.response_id'=>$r['id']);
					if(@$_REQUEST['filter_quality'] == 'I') $conditions['Response.user_id'] = $_SESSION['User']['id'];
					elseif(@$_REQUEST['filter_quality'] == 'G') $conditions['Response.user_id !='] = $_SESSION['User']['id'];
					
					$ratings = $this->Response->find('all',array('fields'=>'Response.response_body','conditions'=>$conditions));
					foreach($ratings as $rating){
						@$quality[$bridge_users[$r['user_id']]]['response_total'] += $rating['Response']['response_body'];
						@$quality[$bridge_users[$r['user_id']]]['response_count']++;
					}
					@$activity[$bridge_users[$r['user_id']].', '.$q['section']][0] = $this->Comment->find('count',array('conditions'=>'Comment.response_id = '.$r['id'].' && Comment.type = 0'));
					@$activity[$bridge_users[$r['user_id']].', '.$q['section']][1] = $this->Comment->find('count',array('conditions'=>'Comment.response_id = '.$r['id'].' && Comment.type = 1'));
				}
			}
			
			uasort($quality,array($this,"quality_sort"));
			uasort($activity,array($this,"activity_sort"));
			
			$this->set('quality',$quality);
			$this->set('activity',$activity);
		}
		
		$this->set('challenge',$challenge);
		
		if($view) $this->render($view == 'stats' ? 'stats_table' : 'leaderboard','ajax');
		else{
			$answers_due = date_create($challenge['Challenge']['answers_due']);
			$now = date_create();
			//$now->setTime(0,0);
			if($answers_due >= $now) $this->render('view');
			else $this->render('view_responses');
		}
	}
	
	// create or update a challenge
	function update($challenge_id=NULL,$view=NULL){
		$this->checkAuth();
		
		$monthly_count = $this->Challenge->find('count',array('conditions'=>array('Challenge.user_id'=>$_SESSION['User']['id'],'Challenge.date_modified BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()')));
		if(($_SESSION['User']['account_tier'] == 'STANDARD' && $monthly_count >= 3) || ($_SESSION['User']['account_tier'] == 'PREMIUM' && $monthly_count >= 7)) $this->redirect('/');
		elseif($_SESSION['User']['account_tier'] == 'STANDARD') $monthly_count = 2 - $monthly_count;
		elseif($_SESSION['User']['account_tier'] == 'PREMIUM') $monthly_count = 6 - $monthly_count;
		elseif($_SESSION['User']['account_tier'] == 'PLATINUM') $monthly_count = false;
		$this->set('monthly_count',$monthly_count);
	
		if($challenge_id) $challenge_record = $this->Challenge->find('first',array('conditions'=>"Challenge.id = ".$challenge_id,'recursive'=>2));
		if(@$_REQUEST['challenge']){
			
			// preprocess date/time inputs
			if(@$_REQUEST['answers_due_hour']){
				$_REQUEST['challenge']['Challenge']['answers_due'] = $_REQUEST['challenge']['Challenge']['answers_due'] . ' ' . ($_REQUEST['answers_due_meridian'] == 'AM' || $_REQUEST['answers_due_hour'] > 11 ? $_REQUEST['answers_due_hour'] : ($_REQUEST['answers_due_hour'] + 12)) . ':' . $_REQUEST['answers_due_minute'];
			}
			if(@$_REQUEST['responses_due_hour']){
				$_REQUEST['challenge']['Challenge']['responses_due'] = $_REQUEST['challenge']['Challenge']['responses_due'] . ' ' . ($_REQUEST['responses_due_meridian'] == 'AM' || $_REQUEST['responses_due_hour'] > 11 ? $_REQUEST['responses_due_hour'] : ($_REQUEST['responses_due_hour'] + 12)) . ':' . $_REQUEST['responses_due_minute'];
			}
			
			if(isset($_REQUEST['challenge']['Challenge']['name']) && !@$_REQUEST['challenge']['Challenge']['allow_exceeded_length']){
				$_REQUEST['challenge']['Challenge']['allow_exceeded_length'] = 0;
			}
			if(isset($_REQUEST['challenge']['Challenge']['name']) && !@$_REQUEST['challenge']['Challenge']['name']){
				$_REQUEST['challenge']['Challenge']['name'] = 'Untitled Bridge';
			}

			$this->Challenge->save($_REQUEST['challenge']);
			$challenge_id = $this->Challenge->id;
			if(@$_REQUEST['challenge']['Question']){
				foreach($_REQUEST['challenge']['Question'] as $k=>$q){
					if(!@$q['question']) unset($_REQUEST['question'][$k]);
					else $_REQUEST['challenge']['Question'][$k]['challenge_id'] = $challenge_id;
				}
				//$this->Challenge->Question->deleteAll(array('challenge_id'=>$challenge_id));
				$this->Challenge->Question->saveAll($_REQUEST['challenge']['Question']);
			}
			$challenge_record = $this->Challenge->find('first',array('conditions'=>"Challenge.id = {$challenge_id}",'recursive'=>2));
			
			// process files/embedded videos
			if(@$_REQUEST['attachment']){
				$attachments[] = array(	'challenge_id'	=> $challenge_id,
										'user_id'		=> $_SESSION['User']['id'],
										'file_location'	=> $_REQUEST['attachment']['file_location'],
										'name'			=> $_REQUEST['attachment']['name'],
										'type'			=> 'C' );
				$this->Challenge->Attachment->saveAll($attachments);
			}elseif(@$_REQUEST['video_embed']){
				if(strpos($_REQUEST['video_embed'],'youtu.be')) $_REQUEST['video_embed'] = '<iframe width="560" height="315" src="http://www.youtube.com/embed/' . substr($_REQUEST['video_embed'],strpos($_REQUEST['video_embed'],'youtu.be') + 8) . '" frameborder="0" allowfullscreen></iframe>';
				elseif(strpos($_REQUEST['video_embed'],'watch?v=')) $_REQUEST['video_embed'] = '<iframe width="560" height="315" src="http://www.youtube.com/embed/' . substr($_REQUEST['video_embed'],strpos($_REQUEST['video_embed'],'watch?v=') + 8) . '" frameborder="0" allowfullscreen></iframe>';
				
				$this->Challenge->Attachment->deleteAll(array('challenge_id'=>$challenge_id,'type'=>'C'));
				$this->Challenge->Attachment->saveAll(array(array('challenge_id'=>$challenge_id,'file_location'=>$_REQUEST['video_embed'],'type'=>'C')));	
			}elseif(@$_REQUEST['offline_challenge']) $this->Challenge->Attachment->saveAll(array(array('challenge_id'=>$challenge_id,'file_location'=>$_REQUEST['offline_challenge'],'type'=>'C')));
			
			/*	TEMPLATES DEPRECIATED FOR PUENTES v1
			// save attachments from template
			if(@$_REQUEST['tmpl_attachment']){
				$tmpl_attachment = $_REQUEST['tmpl_attachment'];
				foreach($tmpl_attachment as $k=>$f){
					$tmpl_attachment[$k]['challenge_id'] = $challenge_id;
					$tmpl_attachment[$k]['user_id'] = $_SESSION['User']['id'];
				}
				$this->Challenge->Attachment->saveAll($tmpl_attachment);
			}
			*/
			
			// delete files
			if(@$_REQUEST['remove_attachment']){
				foreach($_REQUEST['remove_attachment'] as $aid) $this->Challenge->Attachment->delete($aid);
			}
			
			// send invitation emails & perform redirect
			if(@$_REQUEST['challenge']['Challenge']['status'] == 'C'){
				// do we need approval from other instructors?
				$instructors = array();
				foreach($challenge_record['ClassSet'] as $c) $instructors[$c['owner_id']] = is_array(@$instructors[$c['owner_id']]) ? array_merge($instructors[$c['owner_id']],array($c['id'])) : array($c['id']);
				if(count($instructors) > 1){
					$this->Challenge->id = $challenge_record['Challenge']['id'];
					$this->Challenge->saveField('status','D');
					
					foreach($instructors as $i=>$c){
						if($i != $_SESSION['User']['id']) $this->send_instructor_invite($i,$challenge_record['Challenge']['id'],$c);
					}
					
					$this->Status->id = null;
					// create 'accepted' status for owner
					$status = array('Status' =>
													array(	'user_id'			=> $_SESSION['User']['id'],
																	'challenge_id'=> $challenge_record['Challenge']['id'],
																	'status'			=> 'C' ));
					$this->Status->save($status);
					
				}else{
					// send pending invites & alter status records for individual users
					$this->launch_bridge($challenge_record);
				}
				if(!$view) $this->redirect('/challenges/view/'.$this->Challenge->id);
				elseif($view=='ajax') die($this->Challenge->id);
			}
		}
		
		/*	TEMPLATES DEPRECIATED FOR PUENTES v1
		if(!@$challenge_record || ($challenge_record['Challenge']['status'] != 'C' && @$_REQUEST['challenge']['Challenge']['status'] != 'C')){
			$this->set('template',$this->Challenge->find('first',array('conditions'=>array('Challenge.challenge_type'=>'T','Challenge.user_id'=>$_SESSION['User']['id']))));
		}
		*/
		
		if($view=='update_active_status'){
			$user_responses = array();
			foreach($challenge_record['Question'] as $q){
				foreach($q['Response'] as $r) @$user_responses[$r['user_id']]++;
			}
			$this->set('user_responses',$user_responses);
		}
		
		if(@$challenge_record){
			$this->set('challenge',$challenge_record);
		}elseif($view=='template_basics'){
			$this->set('challenge',$this->Challenge->find('first',array('conditions'=>"Challenge.challenge_type = 'T' && User.id = '{$_SESSION['User']['id']}'")));
		}
		if($view=='update_people'||$view=='template_people'){
			if($view=='update_people') $this->set('queued_users',$this->Status->find('all',array('conditions'=>array(	'Status.challenge_id'	=> $challenge_id,
																																																								'Status.status'				=> 'P',
																																																								'Status.class_id IS NULL' ))));

			$groups = $this->ClassSet->find('all',array('conditions'=>'ClassSet.owner_id = '.$_SESSION['User']['id'],'order'=>'ClassSet.group_name'));
			$gids = array();
			foreach($groups as $g) $gids[] = $g['ClassSet']['id'];
			
			$usr_data = $this->User->find('first',array('conditions'=>'User.id = '.$_SESSION['User']['id'],'recursive'=>2));
			foreach($usr_data['ClassSet'] as $c){
				if(!in_array($c['id'],$gids)){
					$groups[] = array('ClassSet' => $c,'Owner' => $c['Owner']);
				}
			}
			$this->set('groups',$groups);
		}
		
		if($view=='dashboard') $this->redirect('/dashboard/');
		elseif($view=='account') $this->redirect('/challenges/update/0/template_basics/');
		elseif($view) $this->render($view,strstr($view,'active') ? 'default' : 'ajax');
		else{
			if(@$_REQUEST['next_step']) $this->set('ini_view',$_REQUEST['next_step']);
			$this->render('update_container');
		}
	}
	
	function update_active_interstitial($id){
		$this->checkAuth();
		$this->set('cid',$id);
		$this->layout = 'ajax';
	}
	
	function launch_bridge($challenge_record){
		$this->checkAuth();
		
		$invited = $this->Status->find('all',array('conditions'=>array('Status.challenge_id'=>$challenge_record['Challenge']['id'],'Status.status'=>'P')));
		$sent_users = array($challenge_record['Challenge']['user_id'] => 1);
		foreach($invited as $i){
			if(@$sent_users[$i['User']['id']] || $i['User']['user_type'] == 'L') continue;
			else $sent_users[$i['User']['id']] = 1;
		
			if($i['User']['notify_challenges']) $this->send_invite($i['User']['id'],$challenge_record['Challenge']['id'],NULL);
			$this->Status->id = $i['Status']['id'];
			$this->Status->saveField('status','N');
		}
		foreach($challenge_record['ClassSet'] as $g){
			foreach($g['User'] as $u){
				if(@$sent_users[$u['id']]) continue;
				else $sent_users[$u['id']] = 1;
			
				if($u['notify_challenges']) $this->send_invite($u['id'],$challenge_record['Challenge']['id'],$g['id'],true);
			}
		}
	}
	
	function split_groups($challenge_id,$group_count = NULL){
		$this->checkAuth();
		
		$this->layout = 'ajax';
		$challenge = $this->Challenge->find('first',array('conditions'=>"Challenge.id = ".$challenge_id,'recursive'=>2));
		
		$students = array();
		foreach($challenge['ClassSet'] as $c){
			foreach($c['User'] as $u){
				if($u['id'] != $c['owner_id']) $students[$u['id']] = $u;
			}
		}
		shuffle($students);
		if($group_count) $students = array_chunk($students,$group_count);
		
		$this->set('challenge',$challenge);
		$this->set('students',$students);
		$this->set('group_count',$group_count);
	}
	
	function save_groups($challenge_id){
		$this->checkAuth();
		$this->Group->save(array('challenge_id' => $challenge_id));
		$group = array();
		foreach($_REQUEST['user'] as $u) $this->UsersGroup->save(array('group_id'=>$this->Group->id,'user_id'=>$u));
		die();
	}
	
	function clear_groups($challenge_id){
		$this->checkAuth();
		die($this->Group->deleteAll(array('Group.challenge_id' => $challenge_id)));
	}
	
	// create invited user, pending final submission
	function queue_invite($challenge_id,$group_id,$user_id=NULL,$fname=NULL,$lname=NULL,$email=NULL,$type=NULL){
		$this->checkAuth();
		$invite_token = sha1(time().$this->salt);
		
		// check for existing user. if new user, create user record
		if(!$user_id){
			$user = $this->User->findByEmail($email);
			if(!$user){
				$this->User->id = NULL;
				$new_user = array(	'User' =>
														array(	'invite_token'	=> $invite_token,
																		'firstname'			=> $fname,
																		'lastname'			=> $lname,
																		'login'					=> $email,
																		'email'					=> $email,
																		'user_type'			=> $type ));
				$this->User->save($new_user);
				
				$status = array(	'Status' =>
													array(	'user_id'				=> $this->User->id,
																	'challenge_id'	=> $challenge_id,
																	'status'				=> 'P' ));
				$this->Status->save($status);
			}
		}
		
		$challenge = $this->Challenge->find('first',array('conditions'=>'Challenge.id = '.$challenge_id,'recursive'=>2));
		if($user){
			$inGroup = false;
			foreach($challenge['ClassSet'] as $c){
				foreach($c['User'] as $u){
					if($u['id'] == $user['User']['id']){
						$inGroup = true;
						break;
					}
				}
			}
			if(!$inGroup){
				$status = array(	'user_id'				=> $user['User']['id'],
													'challenge_id'	=> $challenge_id,
													'status'				=> 'P' );
				$this->Status->save($status);
			}
		}
		if(($user && !$inGroup) || $this->User->id){
			// add to challenge
			$challenge_update = array('Challenge'=>array('id'=>$challenge_id));
			$challenge_update['Collaborator'] = array(@$user ? @$user['User']['id'] : $this->User->id);
			foreach($challenge['Collaborator'] as $u) if(array_search($u['id'],$challenge_update['Collaborator']) === false) $challenge_update['Collaborator'][] = $u['id'];
			$this->Challenge->save($challenge_update);
		}
	
		die();
	}
	
	// remove pending user invitation
	function remove_queued_invite($user_id,$challenge_id){
		$this->checkAuth();
		$user = $this->User->findById($user_id);
		
		// delete the user if he hasn't received an invitation email to set up his account yet
		if($user['User']['invite_token']) $this->User->delete($user_id);
		// otherwise, remove the "pending for" flags
		else $this->Status->deleteAll(array('Status.user_id' => $user_id,'Status.challenge_id' => $challenge_id,'Status.status' => 'P'));
		
		$this->redirect('/challenges/update/'.$challenge_id.'/update_people');
	}
	
	// send an email invitation
	function send_invite($user_id,$challenge_id,$group_id=NULL,$existing=false){
		$this->checkAuth();
				
		$this->User->hasMany['Status']['conditions'][] = 'Status.status = "P"';
		$this->User->hasMany['Status']['conditions'][] = 'Status.challenge_id = '.$challenge_id;
		$user = $this->User->find('first',array('conditions'=>"User.id = {$user_id}",'recursive'=>2));
		$challenge = $this->Challenge->findById($challenge_id);
		
		// build invite url & message body
		if($user['User']['invite_token']){
			$message = __("Hi {firstname_1}!\n\n{firstname_2} {lastname_2} has invited you to collaborate with their classroom on Skywork Online - the world's first feedback learning system. Once you click through the link provided, fill out a preferred email and password. This will be used to sign into puentesonline.com from then on.\n\nYou will be able to provide feedback to {firstname_2}'s students between the dates of:\n\n{duedate_1} and {duedate_2}.\n\nLastly, Skywork is currently in invite-only beta, so you will need a Beta-Test Key. It is: BETATEST\n\nClick here to check it out\n{invite_link}\n\nSincerely,\nThe Skywork Team");
			$message = str_replace('{firstname_1}',$user['User']['firstname'],$message);
			$message = str_replace('{firstname_2}',$challenge['User']['firstname'],$message);
			$message = str_replace('{lastname_2}',$challenge['User']['lastname'],$message);
			$message = str_replace('{invite_link}',"http://puentesonline.com/users/accept_invitation/{$challenge_id}/".(@$user['Status'][0]['class_id'] ? $user['Status'][0]['class_id'] : 0)."/{$user_id}/{$user['User']['invite_token']}/",$message);
			$message = str_replace('{duedate_1}',date_format(date_create($challenge['Challenge']['answers_due']),'l, F j'),$message);
			$message = str_replace('{duedate_2}',date_format(date_create($challenge['Challenge']['responses_due']),'l, F j'),$message);
			
			$subject = __("Invitation from {first_name} {last_name}");
			$subject = str_replace('{first_name}',$challenge['User']['firstname'],$subject);
			$subject = str_replace('{last_name}',$challenge['User']['lastname'],$subject);
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Skywork <noreply@puentesonline.com>' . "\r\n";
		}else{
			$message = __("Hi {firstname_1}!\n\nYour Instructor, {firstname_2} {lastname_2}, would like you to do your assignment online using Skywork - Assignments. On Demand!\n\nYou will have until:\n\n{duedate_1} to complete a series of questions.\n\n");
			if($challenge['Challenge']['responses_due'] && $challenge['Challenge']['responses_due'] != '0000-00-00 00:00:00') $message .= __("{duedate_2} to give feedback to other students.\n\n");
			$message .= __("Login here:\n{bridge_link}\n\nSincerely,\nThe Skywork Team");
			
			$message = str_replace('{firstname_1}',$user['User']['firstname'],$message);
			$message = str_replace('{firstname_2}',$challenge['User']['firstname'],$message);
			$message = str_replace('{lastname_2}',$challenge['User']['lastname'],$message);
			$message = str_replace('{bridge_link}',"http://puentesonline.com/",$message);
			$message = str_replace('{duedate_1}',date_format(date_create($challenge['Challenge']['answers_due']),'l, F j'),$message);
			$message = str_replace('{duedate_2}',date_format(date_create($challenge['Challenge']['responses_due']),'l, F j'),$message);
			
			$subject = __("Invitation from {first_name} {last_name}");
			$subject = str_replace('{first_name}',$challenge['User']['firstname'],$subject);
			$subject = str_replace('{last_name}',$challenge['User']['lastname'],$subject);
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Skywork <noreply@puentesonline.com>' . "\r\n";
		}
		
		// send invite email
		mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>",$subject,nl2br($message),$headers);
	}
	
	function send_instructor_invite($user_id,$challenge_id,$class_id){
		$classes = $this->ClassSet->find('first',array('conditions'=>'ClassSet.id IN('.implode(',',$class_id).')','fields'=>'group_concat(distinct group_name separator ", ") as group_names,Owner.*','group'=>'ClassSet.owner_id'));
		$challenge = $this->Challenge->findById($challenge_id);
		
		$message = __("Hi {firstname_1}!\n\n{firstname_2} {lastname_2} has invited your class(es) ".$classes[0]['group_names']." to an assignment on Skywork - Assignments. On Demand!\n\nYour students will have until {duedate_1} to complete Due Date 1 and until {duedate_2} to complete Due Date 2.\n\Login to Accept or Reject this bridge:\n{link_1}\n\nSincerely,\nThe Skywork Team");
		$message = str_replace('{firstname_1}',$classes['Owner']['firstname'],$message);
		$message = str_replace('{firstname_2}',$_SESSION['User']['firstname'],$message);
		$message = str_replace('{lastname_2}',$_SESSION['User']['lastname'],$message);
		$message = str_replace('{link_1}',"http://puentesonline.com/",$message);
		$message = str_replace('{duedate_1}',date_format(date_create($challenge['Challenge']['answers_due']),'l, F j'),$message);
		$message = str_replace('{duedate_2}',date_format(date_create($challenge['Challenge']['responses_due']),'l, F j'),$message);
		
		$subject = __("Invitation from {first_name} {last_name}");
		$subject = str_replace('{first_name}',$challenge['User']['firstname'],$subject);
		$subject = str_replace('{last_name}',$challenge['User']['lastname'],$subject);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Skywork <noreply@puentesonline.com>' . "\r\n";	
		
		mail("{$classes['Owner']['firstname']} {$classes['Owner']['lastname']} <{$classes['Owner']['email']}>",$subject,nl2br($message),$headers);
		
		// create 'pending' status
		$status = array('Status' =>
										array(	'user_id'			=> $user_id,
														'class_id'		=> array_shift($class_id),
														'challenge_id'=> $challenge_id,
														'status'			=> 'P' ));
		$this->Status->save($status);
	}
	
	function instructor_confirm($challenge_id,$status=NULL){
		$this->layout = 'ajax';
		$challenge = $this->Challenge->find('first',array('conditions'=>'Challenge.id = '.$challenge_id,'recursive'=>2));
		$status_record = $this->Status->find('first',array('conditions'=>array('Status.challenge_id'=>$challenge_id,'Status.user_id'=>$_SESSION['User']['id'])));
		$current_status = $status_record['Status']['status'];
		$this->set('challenge',$challenge);
		$final = false;
		
		if($status){
			$final = true;
			foreach($challenge['Status'] as $s) if(($s['User']['user_type'] == 'L' && $s['status'] == 'P' && $s['User']['id'] != $_SESSION['User']['id']) || ($s['User']['id'] == $_SESSION['User']['id'] && $status == 'P')) $final = false;
			
			if($final && (($status == 'R' && @$_REQUEST['detail']) || $status  != 'R')){
				// if this is the final approval, launch the bridge
				$this->Challenge->id = $challenge['Challenge']['id'];
				$this->Challenge->saveField('status','N');
				$this->launch_bridge($challenge);
			}
			
			$this->Status->id = $status_record['Status']['id'];
			$this->Status->saveField('status',$status);
		
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Skywork <noreply@puentesonline.com>' . "\r\n";
		
			if($status == 'C'){
				// if user accepted, send notification
				foreach($challenge['Status'] as $s){
					if($s['status'] != 'C') continue;
				
					$message = __("Hi {firstname_1}!\n\n{firstname_2} has accepted your request to join {bridge_name} on Skywork.\n\nSincerely,\nThe Skywork Team");
					$message = str_replace('{firstname_1}',$s['User']['firstname'],$message);
					$message = str_replace('{firstname_2}',$status_record['User']['firstname'],$message);
					$message = str_replace('{bridge_name}',$challenge['Challenge']['name'],$message);
			
					mail("{$s['User']['firstname']} {$s['User']['lastname']} <{$s['User']['email']}>",'Accepted Bridge',nl2br($message),$headers);
				}				
			}elseif($status == 'R' && @$_REQUEST['detail']){
				// if user rejected and detail is set, send notifications and redirect
				foreach($challenge['Status'] as $s){
					if($s['status'] != 'C') continue;
				
					$message = __("Hi {firstname_1}!\n\nSorry, {firstname_2} has declined the request to join {bridge_name} on Skywork.\n\n\"{rejection_text}\"\n\nPerhaps some other time!\n\nSincerely,\nThe Skywork Team");
					$message = str_replace('{firstname_1}',$s['User']['firstname'],$message);
					$message = str_replace('{firstname_2}',$status_record['User']['firstname'],$message);
					$message = str_replace('{bridge_name}',$challenge['Challenge']['name'],$message);
					$message = str_replace('{rejection_text}',$_REQUEST['detail'],$message);
			
					mail("{$s['User']['firstname']} {$s['User']['lastname']} <{$s['User']['email']}>",'Declined Bridge',nl2br($message),$headers);
				}
				
				// delete instructor approval statuses,reset to 'draft' mode and redirect to dashboard
				$this->Status->deleteAll(array('Status.challenge_id'=>$challenge['Challenge']['id'],'Status.class_id IS NOT NULL'));
				$this->Status->deleteAll(array('Status.challenge_id'=>$challenge['Challenge']['id'],'Status.user_id'=>$challenge['User']['id']));
				$this->Group->deleteAll(array('Group.challenge_id'=>$challenge['Challenge']['id']));
				$this->Challenge->query('delete from challenges_classes where challenge_id = '.$challenge['Challenge']['id']);
				$this->Challenge->id = $challenge['Challenge']['id'];
				$this->Challenge->saveField('status','D');
				$this->redirect('/dashboard/');
			}
			$current_status = $status_record['Status']['status'] = $status;
		}
		
		$this->set('final',$final);
		$this->set('status',$status_record);
		$this->render($current_status == 'C' ? 'instructor_accepted' : ($current_status == 'R' ? 'instructor_rejected' : 'instructor_confirm'));
	}
	
	function send_expiration_emails(){
		$challenges = $this->Challenge->find('all',array('conditions'=>'timestampdiff(MINUTE,now(),Challenge.answers_due) between 270 and 330 and date_add(Challenge.date_modified, interval 1 day) < Challenge.answers_due','recursive'=>2));
		$sent_users = array();
		
		foreach($challenges as $c){
			foreach($c['ClassSet'] as $g){
				foreach($g['User'] as $u){
					if(@$sent_users[$u['id']]) continue;
					else $sent_users[$u['id']] = 1;
				
					if($u['notify_expiration']){
						
						$message = __("Hi {firstname}!\n\nThe Bridge {bridge_name} is set to expire today at {expiration_time}.\n\nClick here make any final edits!\nhttp://puentesonline.com/\n\nSincerely,\nThe Skywork Team");
						$message = str_replace('{firstname}',$u['firstname'],$message);
						$message = str_replace('{bridge_name}',$c['Challenge']['name'],$message);
						$message = str_replace('{expiration_time}',date_format(date_create($c['Challenge']['answers_due']),'g:ia'),$message);

						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: Skywork <noreply@puentesonline.com>' . "\r\n";
						
						mail("{$u['firstname']} {$u['lastname']} <{$u['email']}>",'Bridge Expiration Notice',nl2br($message),$headers);
					}
				}
			}
		}
		
		die();
	}
	
	function delete($id){
		$this->checkAuth();
		$this->Challenge->delete($id);
		$this->redirect('/dashboard/');
	}
	
	function quality_sort($a,$b){
		if($a['response_total']/$a['response_count'] == $b['response_total']/$b['response_count']) return 0;
		return ($a['response_total']/$a['response_count'] < $b['response_total']/$b['response_count']) ? -1 : 1;
	}
	
	function activity_sort($a,$b){
		if($a[0] + $a[1] == $b[0] + $b[1]) return 0;
		return ($a[0] + $a[1] > $b[0] + $b[1]) ? -1 : 1;
	}

	function viewpdf($type){
		$this->layout = 'ajax';
		$this->set('pdfType',$type);
	}

}
?>