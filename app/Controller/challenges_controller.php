<?php
class ChallengesController extends AppController{
	var $name = 'Challenges';
	var $uses = array('User','Challenge','ClassSet','Status','Response','Group','UsersGroup','Comment');
	
	// view all challenges (dashboard)
	function browse($status=NULL,$page=1){
		$this->checkAuth();
		$this->Challenge->Behaviors->attach('Containable');
		$conditions = array();
		$group = 'Challenge.id ';
		
		$this->Challenge->hasMany['Status']['conditions'] = array("Status.user_id = {$_SESSION['User']['id']}");
		
		if($status == 'd') $this->Challenge->hasMany['Status']['conditions'][] = 'Status.status = "D"';
		elseif($status == 'c') $conditions[] = 'Challenge.status = "C" && Challenge.responses_due < CURDATE()';
		
		if(@$_REQUEST['sort']=='name') $sort = 'Challenge.name';
		elseif(@$_REQUEST['sort']=='answer_date') $sort = 'Challenge.answers_due';
		elseif(@$_REQUEST['sort']=='response_date') $sort = 'Challenge.responses_due';
		elseif(@$_REQUEST['sort']=='edit_date') $sort = 'Challenge.date_modified';
		elseif(@$_REQUEST['sort']=='creator') $sort = 'User.lastname '.(@$_REQUEST['dir']=='a' || !@$_REQUEST['sort'] ? 'DESC' : 'ASC').',User.firstname';
		else $sort = 'Challenge.date_modified';
		
		if(@$_REQUEST['dir']=='a' || !@$_REQUEST['sort']) $sort .= ' DESC';
		else $sort .= ' ASC';
		
		$challenges = $this->Challenge->find('all',array('conditions'=>$conditions,'order'=>$sort,'group'=>$group,'contain'=>array('User','Question','Status','ClassSet'=>array('User'),'Group'=>array('User'))));

		$user = $this->User->findById($_SESSION['User']['id']);
		$groups = array();
		foreach(@$user['ClassSet'] as $g) $groups[$g['id']] = 1;
		
		$now = date_create();
		$now->setTime(0,0);
		foreach($challenges as $k=>$c){
			$vis = false;
			foreach($c['ClassSet'] as $g){
				if(@$groups[$g['id']]){
					$vis = true;
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
				$status = array(	'user_id' 		=> $_SESSION['User']['id'],
									'challenge_id'	=> $challenge_id,
									'status'		=> 'D' );
				$this->Status->save($status);
			}
		}
		
		if($view == 'leaderboard'){
			$users = array();
			foreach(($_SESSION['User']['user_type'] == 'P' && $challenge['Group'] ? $challenge['Group'] : $challenge['ClassSet']) as $g){
				$user_group = false;
				$user_buffer = array();
				foreach($g['User'] as $u){
					if($u['id'] == $_SESSION['User']['id']) $user_group = true;
					
					@$user_buffer["{$u['firstname']} {$u['lastname']}"][0] = 0;
					@$user_buffer["{$u['firstname']} {$u['lastname']}"][1] = 0;
					foreach($challenge['Question'] as $q){
						//$this->Response->hasMany['Responses']['conditions'][] = 'Responses.response_type = "A"';
						//$this->Response->hasMany['Responses']['conditions'][] = "Responses.user_id = {$u['id']}";
						$res = $this->Response->find('first',array('conditions'=>array('Question.id'=>$q['id'],'User.id'=>$u['id'])));
						
						if(@$res['Comment']){
							foreach($res['Comment'] as $c) @$user_buffer["{$u['firstname']} {$u['lastname']}"][$c['type']]++;
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
					$ratings = $this->Response->find('all',array('fields'=>'Response.response_body','conditions'=>'Response.response_id = '.$r['id']));
					foreach($ratings as $rating){
						@$quality[$bridge_users[$r['user_id']]]['response_total'] += $rating['Response']['response_body'];
						@$quality[$bridge_users[$r['user_id']]]['response_count']++;
					}
					$activity[$bridge_users[$r['user_id']].', '.$q['section']][0] = $this->Comment->find('count',array('conditions'=>'Comment.response_id = '.$r['id'].' && Comment.type = 0'));
					$activity[$bridge_users[$r['user_id']].', '.$q['section']][1] = $this->Comment->find('count',array('conditions'=>'Comment.response_id = '.$r['id'].' && Comment.type = 1'));
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
			$now->setTime(0,0);
			if($answers_due >= $now) $this->render('view');
			else $this->render('view_responses');
		}
	}
	
	// create or update a challenge
	function update($challenge_id=NULL,$view=NULL){
		$this->checkAuth();
	
		if($challenge_id) $challenge_record = $this->Challenge->find('first',array('conditions'=>"Challenge.id = ".$challenge_id,'recursive'=>2));
		if(@$_REQUEST['challenge']){
			
			// preprocess date/time inputs
			if(@$_REQUEST['answers_due_hour']){
				$_REQUEST['challenge']['Challenge']['answers_due'] = $_REQUEST['challenge']['Challenge']['answers_due'] . ' ' . ($_REQUEST['answers_due_meridian'] == 'AM' ? $_REQUEST['answers_due_hour'] : $_REQUEST['answers_due_hour'] + 12) . ':' . $_REQUEST['answers_due_minute'];
				$_REQUEST['challenge']['Challenge']['responses_due'] = $_REQUEST['challenge']['Challenge']['responses_due'] . ' ' . ($_REQUEST['responses_due_meridian'] == 'AM' ? $_REQUEST['responses_due_hour'] : $_REQUEST['responses_due_hour'] + 12) . ':' . $_REQUEST['responses_due_minute'];
			}
			
			$this->Challenge->save($_REQUEST['challenge']);
			$challenge_id = $this->Challenge->id;
			if(@$_REQUEST['challenge']['Question']){
				foreach($_REQUEST['challenge']['Question'] as $k=>$q){
					if(!@$q['question']) unset($_REQUEST['question'][$k]);
					else $_REQUEST['challenge']['Question'][$k]['challenge_id'] = $challenge_id;
				}
				$this->Challenge->Question->deleteAll(array('challenge_id'=>$challenge_id));
				$this->Challenge->Question->saveAll($_REQUEST['challenge']['Question']);
			}
			$challenge_record = $this->Challenge->find('first',array('conditions'=>"Challenge.id = {$challenge_id}",'recursive'=>2));
			
			// process files/embedded videos
			if(@$_FILES['attachment']){
				foreach($_FILES['attachment']['name'] as $k=>$n){
					if(!$_FILES['attachment']['tmp_name'][$k]) continue;
					$filename = md5(uniqid(rand())).strrchr($n,'.');
					if(!move_uploaded_file($_FILES['attachment']['tmp_name'][$k],$_SERVER['DOCUMENT_ROOT'].'/uploads/'.$filename)){
						print_r($_FILES);
						die("<br>Upload error<br>");
					}
					$attachments[] = array(	'challenge_id'	=> $challenge_id,
											'user_id'		=> $_SESSION['User']['id'],
											'file_location'	=> $filename,
											'name'			=> $n,
											'type'			=> @$_REQUEST['attachment'][$k]['type'] );
				}
				if(@$attachments) $this->Challenge->Attachment->saveAll($attachments);
			}elseif(@$_REQUEST['video_embed']) $this->Challenge->Attachment->saveAll(array(array('challenge_id'=>$challenge_id,'file_location'=>$_REQUEST['video_embed'],'type'=>'C')));
			// save attachments from template
			if(@$_REQUEST['tmpl_attachment']){
				$tmpl_attachment = $_REQUEST['tmpl_attachment'];
				foreach($tmpl_attachment as $k=>$f){
					$tmpl_attachment[$k]['challenge_id'] = $challenge_id;
					$tmpl_attachment[$k]['user_id'] = $_SESSION['User']['id'];
				}
				$this->Challenge->Attachment->saveAll($tmpl_attachment);
			}
			
			// delete files
			if(@$_REQUEST['remove_attachment']){
				foreach($_REQUEST['remove_attachment'] as $aid) $this->Challenge->Attachment->delete($aid);
			}
			
			// send invitation emails & perform redirect
			if(@$_REQUEST['challenge']['Challenge']['status'] == 'C'){
				// send pending invites & alter status records for individual users
				$invited = $this->Status->find('all',array('conditions'=>array('Status.challenge_id'=>$challenge_id,'Status.status'=>'P')));
				$sent_users = array($challenge_record['Challenge']['user_id'] => 1);
				foreach($invited as $i){
					if(@$sent_users[$i['User']['id']]) continue;
					else $sent_users[$i['User']['id']] = 1;
					
					if($i['User']['notify_challenges']) $this->send_invite($i['User']['id'],$challenge_id,NULL);
					$this->Status->id = $i['Status']['id'];
					$this->Status->saveField('status','N');
				}
				foreach($challenge_record['ClassSet'] as $g){
					foreach($g['User'] as $u){
						if(@$sent_users[$u['id']]) continue;
						else $sent_users[$u['id']] = 1;
						
						if($u['notify_challenges']) $this->send_invite($u['id'],$challenge_id,$g['id'],true);
					}
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
		
		if(@$challenge_record){
			$this->set('challenge',$challenge_record);
		}elseif($view=='template_basics'){
			$this->set('challenge',$this->Challenge->find('first',array('conditions'=>"Challenge.challenge_type = 'T' && User.id = '{$_SESSION['User']['id']}'")));
		}
		if($view=='update_people'||$view=='template_people'){
			if($view=='update_people') $this->set('queued_users',$this->Status->find('all',array('conditions'=>array(	'Status.challenge_id'	=> $challenge_id,
																														'Status.status'			=> 'P' ))));
			$this->set('groups',$this->ClassSet->find('all',array('conditions'=>'ClassSet.owner_id = '.$_SESSION['User']['id'],'order'=>'ClassSet.group_name')));
		}
		if($view=='dashboard') $this->redirect('/dashboard/');
		if($view=='account') $this->redirect('/challenges/update/0/template_basics/');
		elseif($view) $this->render($view,'ajax');
		else{
			if(@$_REQUEST['next_step']) $this->set('ini_view',$_REQUEST['next_step']);
			$this->render('update_container');
		}
	}
	
	function split_groups($challenge_id,$group_count = NULL){
		$this->layout = 'ajax';
		$challenge = $this->Challenge->find('first',array('conditions'=>"Challenge.id = ".$challenge_id,'recursive'=>2));
		
		$students = array();
		foreach($challenge['ClassSet'] as $c){
			foreach($c['User'] as $u){
				if($u['id'] != $c['owner_id']) array_push($students,$u);
			}
		}
		if($group_count) $students = array_chunk($students,$group_count);
		
		$this->set('challenge',$challenge);
		$this->set('students',$students);
		$this->set('group_count',$group_count);
	}
	
	function save_groups($challenge_id){
		$this->Group->save(array('challenge_id' => $challenge_id));
		$group = array();
		foreach($_REQUEST['user'] as $u) $this->UsersGroup->save(array('group_id'=>$this->Group->id,'user_id'=>$u));
		die();
	}
	
	function clear_groups($challenge_id){
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
													array(	'user_id'		=> $this->User->id,
															'group_id'			=> $group_id,
															'challenge_id'	=> $challenge_id,
															'status'				=> 'P' ));
				$this->Status->save($status);
			}
		}
		if($user || $user_id){
			if($user_id){
				$user = $this->User->findById($user_id);
				return false;
			}
			$inGroup = false;
			foreach($user['Class'] as $g){
				if($g['id'] == $group_id){
					$inGroup = true;
					break;
				}
			}
			if(!$inGroup){
				$status = array('user_id'		=> $user['User']['id'],
								'challenge_id'	=> $challenge_id,
								'group_id'		=> $group_id,
								'status'		=> 'P' );
				$this->Status->save($status);
			}
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
			$subject = "Invitation from {$challenge['User']['firstname']} {$challenge['User']['lastname']}";
			$message = "Hi {$user['User']['firstname']}!\n\n";
			$message .= "Thanks for participating in a Challenge with Case Club. {$challenge['User']['firstname']} {$challenge['User']['lastname']} has sent you an invitation to join Case Club Online - a fun way to read and discuss business cases online. Once you click through the link provided, fill out a preferred email and password. This will be used to sign into caseclubonline.com from then on.\n\n";
			$message .= "You will have until\n\n".date_format(date_create($challenge['Challenge']['answers_due']),'l, F jS')." to complete a series of questions.\n\n";
			$message .= date_format(date_create($challenge['Challenge']['responses_due']),'l, F jS')." to respond (Agree/Disagree) to other participants' questions.\n\n";
			$message .= "Click here to check it out\n\n";
			$message .= "http://caseclubonline.com/users/accept_invitation/{$challenge_id}/{$user['Status'][0]['class_id']}/{$user_id}/{$user['User']['invite_token']}";
			$message .= "\n\nSincerely,\n\nCase Club Online Team";
		}else{
			$subject = "New Case from {$challenge['User']['firstname']}";
			$message = "Hi {$user['User']['firstname']}!\n\n";
			$message .= "{$challenge['User']['firstname']} {$challenge['User']['lastname']} has sent you an invitation for a new challenge on Case Club Online starting ".date_format(date_create(),'m/d/Y')." and ending ".date_format(date_create($challenge['Challenge']['responses_due']),'m/d/Y').".";
			if(!$existing) $message .= "\n\n<a href='http://caseclubonline.com/users/accept_invitation/{$challenge_id}/0/{$user_id}'>Click here</a> to check it out.";
			else $message .= "\n\n<a href='http://caseclubonline.com/'>Click here</a> to check it out.";
			$message .= "\n\n<a href='http://caseclubonline.com/attachments/view/case/{$challenge_id}/?fromEmail=1'>Click here</a> to View Case.\n\n";
			$message .= "Sincerely,\n\nCase Club Online Team";
		}
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: noreply@caseclubonline.com' . "\r\n";
		
		// send invite email
		mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>",$subject,nl2br($message),$headers);
	}
	
	function send_expiration_emails(){
		$challenges = $this->Challenge->find('all',array('conditions'=>'Challenge.answers_due = CURDATE()','recursive'=>2));
		$sent_users = array();
		
		foreach($challenges as $c){
			foreach($c['Class'] as $g){
				foreach($g['User'] as $u){
					if(@$sent_users[$u['id']]) continue;
					else $sent_users[$u['id']] = 1;
				
					if($u['notify_expiration']){
						$message = "{$u['firstname']}\n\n";
						$message .= "The Case, {$c['Challenge']['name']}, is set to expire tonight at midnight.\n\n";
						$message .= "Click here to complete now!\n\n";
						$message .= "http://caseclubonline.com/\n\n";
						$message .= "To change email preferences, please visit My Account.\n\n";
						$message .= "Sincerely,\nCase Club Online Team";
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: noreply@caseclubonline.com' . "\r\n";
						
						mail("{$u['firstname']} {$u['lastname']} <{$u['email']}>",'Expiration Notice',nl2br($message),$headers);
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
}
?>