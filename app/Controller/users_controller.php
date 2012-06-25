<?php
class UsersController extends AppController{
	var $name = 'Users';
	var $uses = array('User','Class','Status','State');
	
	// view account settings
	function view($show=NULL,$saved=false){
		$this->checkAuth();
		
		if(@$_REQUEST['sort']=='name') $sort = 'Class.group_name';
		elseif(@$_REQUEST['sort']=='created') $sort = 'Class.date_created';
		elseif(@$_REQUEST['sort']=='modified') $sort = 'Class.date_created';
		elseif(@$_REQUEST['sort']=='owner') $sort = 'Class.owner_id';
		else $sort = 'Class.group_name';
		
		if(@$_REQUEST['dir']=='a') $sort .= ' DESC';
		else $sort .= ' ASC';
		
		$this->User->hasAndBelongsToMany['Class']['order'] = $sort;
		
		$user = $this->User->find('first',array('conditions'=>"User.id = {$_SESSION['User']['id']}",'recursive'=>2));
		$this->set('user',$user);
		
		if($show=='classes'){
			$current_groups = $requested_groups = $pending_groups = array();
			$pending_invites = $this->Status->find('all',array('conditions'=>array('Status.challenge_id IS NULL','Status.status'=>'P','Status.user_id'=>$_SESSION['User']['id'])));
			foreach($pending_invites as $i) $pending_groups[] = $i['Class']['id'];
			if($pending_groups){
				$this->set('invites',$this->Class->find('all',array('conditions'=>'Class.id IN ('.implode(',',$pending_groups).')','recursive'=>2)));
			}
			
			$this->Status->hasMany['Class']['conditions'] = "Class.owner_id = {$_SESSION['User']['id']}";
			$pending_requests = $this->Status->find('all',array('conditions'=>array('Status.challenge_id IS NULL','Status.status'=>"R")));
			foreach($pending_requests as $r){
				if($r['Class']) $requested_groups[] = $r['Class']['id'];
			}
			
			foreach($user['Class'] as $g) $current_groups[] = $g['id'];
			if($current_groups) $conditions = array('Class.id NOT IN ('.implode(',',$current_groups).')');
			else $conditions = array();
			
			$this->set('saved',$saved);
			$this->set('requested_groups',$requested_groups);
			$this->set('pending_groups',$pending_groups);
			$this->set('groups',$this->Class->find('all',array('conditions'=>$conditions)));
			$this->render('view_classes');
		}else $this->set('states',$this->State->find('all'));
	}
	
	// save updated account settings
	function update(){
		$this->checkAuth();
		
		if($_REQUEST['new_pass1']){
			if($_REQUEST['new_pass1']==$_REQUEST['new_pass2']){
				$_REQUEST['password'] = sha1($_REQUEST['new_pass1'].$this->salt);
				unset($_REQUEST['new_pass1'],$_REQUEST['new_pass2']);
			}
		}
		
		if(!@$_REQUEST['search_visible']) $_REQUEST['search_visible'] = 0;
		$this->User->save($_REQUEST);
		$this->redirect('/users/view/');
	}
	
	// terminate account (self)
	function delete(){
		$this->checkAuth();
		$this->User->delete($_SESSION['User']['id']);
		$this->Session->delete('User');
		$this->redirect('/');
	}
	
	// send an email invitation
	function invite($group_id,$user_id=NULL,$fname=NULL,$lname=NULL,$email=NULL,$type=NULL,$inviter=NULL){
		$this->checkAuth();
		$invite_token = NULL;
		$send_invite = true;
		$group = $this->Class->findById($group_id);
		
		// check for existing user. if new user, create user record
		if(!$user_id){
			$user = $this->User->findByEmail($email);
			if(!$user || !$email){
				$invite_token = sha1(time().$this->salt);
				$user = array(	'User' =>
								array(	'invite_token'	=> $invite_token,
										'firstname'		=> $fname,
										'lastname'		=> $lname,
										'login'			=> $email,
										'email'			=> $email,
										'user_type'		=> $type ));
				$this->User->save($user);
			}elseif($user){
				$this->User->id = $user['User']['id'];
				if(!$user['User']['notify_groups']) $send_invite = false;
			}
		}else{
			$user = $this->User->findById($user_id);
			if(!$user['User']['notify_groups']) $send_invite = false;
		}
		
		// if user is re-invited with a new type, apply the new type to their record
		if(@$user['User']['id'] && $type && $type != $user['User']['user_type']) $this->User->updateAll(array('User.user_type' => "'".$type."'"),array('User.id' => $user['User']['id']));
		
		// create 'pending' status
		$status = array('Status' =>
						array(	'user_id'		=> $this->User->id,
								'group_id'		=> $group_id,
								'status'		=> 'P' ));
		$this->Status->save($status);
		
		if($send_invite){
			// build invite url & message body
			$invite_url = 'http://caseclubonline.com/users/accept_invitation/0/'.$group_id.'/'.$this->User->id.'/'.$invite_token;
			$message = "{$fname},\n\n{$group['Owner']['firstname']} requested you to join a new group, {$group['Class']['group_name']}, on Case Club Online.";
			$message .= "\n\n<a href='$invite_url'>Click here to join this group!</a>";
			$message .= "\n\nSincerely,\n\nCase Club Online Team";
		
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: noreply@caseclubonline.com' . "\r\n";
		
			// send invite email
			mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>","{$group['Owner']['firstname']} {$group['Owner']['lastname']} asks you to join",nl2br($message),$headers);
		}
		
		die($this->User->id);
	}
	
	// accept an email invitation
	function accept_invitation($challenge_id,$group_id,$user_id,$token=NULL){
		$user = $this->User->findById($user_id);
		if(!$user) $this->render('login_landing');
		$this->set('user',$user);
		$this->set('challenge_id',$challenge_id);
		$this->set('group_id',$group_id);
		if(!@$user['User']['invite_token']) $this->set('force_existing',true);
		if((@$user['User']['invite_token'] && $user['User']['invite_token'] == $token) || !@$user['User']['invite_token']) $this->render('/Pages/home');
		else $this->render('/Pages/home');
	}
	
	// send a "forgot password" email
	function send_password_reset($login){
		$user = $this->User->findByLogin($login);
		if($user){
			$reminder_token = sha1(time().$this->salt);
			$message = "{$user['User']['firstname']},\n\nSomeone (probably you), forgot the password to Case Club Online. Click on the link below to create a new password.";
			$message .= "\n\nhttp://caseclubonline.com/users/password_reset/".$reminder_token."\n\nSincerely,\nCase Club Online Team";
			mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>","New Password (CaseClubOnline)",$message,'From: noreply@caseclubonline.com');
			
			$this->User->id = $user['User']['id'];
			$this->User->saveField('invite_token',$reminder_token);
			die('1');
		}else die('0');
	}
	
	// reset password
	function password_reset($token=NULL){
		if(!$token) $this->redirect('/');
		$user = $this->User->findByInviteToken($token);
		if(!$user) $this->redirect('/');
		
		if(@$_REQUEST['new_password']){
			$this->User->id = $user['User']['id'];
			$this->User->saveField('invite_token','');
			$this->User->saveField('password',sha1($_REQUEST['new_password'].$this->salt));
			$this->Session->write('User',$user['User']);
			$this->redirect('/dashboard/');
		}else{
			$this->set('reset_password',true);
			$this->set('user',$user);
			$this->render('/Pages/home');
		}
	}
	
	// authenticate
	function login($ajax=false){
		if(@$_REQUEST['login']){
			$user = $this->User->findByLogin($_REQUEST['login']);
			if(!empty($user['User']['password']) && $user['User']['password'] == sha1($_REQUEST['password'].$this->salt)){
				
				// if user is responding to an invite but already exists with a different email,
				// update all statuses for invited user to match actual user, and delete invited user
				if(@$_REQUEST['user_id'] && @$_REQUEST['user_id'] != $user['User']['id']){
					$this->Status->updateAll(array('Status.user_id' => $user['User']['id']),array('Status.user_id' => $_REQUEST['user_id']));
					$this->User->delete($_REQUEST['user_id']);
				}

				// if users is responding to an invitation for a challenge, automatically add the user to the relevant group
				$user_update = array('User'=>array('id'=>$user['User']['id']));
				
				if(@$_REQUEST['group_id'] && $_REQUEST['challenge_id']){
					$user_update['Class'] = array($_REQUEST['group_id']);
					foreach($user['Class'] as $g) if(array_search($g['id'],$user_update['Class']) === false) $user_update['Class'][] = $g['id'];
				}
				$this->User->save($user_update);
				
				$this->Session->write('User',$user['User']);
				if($ajax) die('1');
				elseif(@$_REQUEST['group_id'] && !@$_REQUEST['challenge_id']) $this->redirect('/users/view/groups/');
				else $this->redirect('/dashboard/');
			}elseif($ajax) die('0');
			else{
				$this->set('error',true);
				$this->redirect('/');
			}
			
		}elseif(@$_REQUEST['token']){
			$user = $this->User->findByInviteToken($_REQUEST['token']);
			if(@$user['User']['invite_token'] == $_REQUEST['token']){
				
				$user_update = array(	'User' =>
										array(	'id'			=> $user['User']['id'],
												'invite_token'	=> NULL,
												'email'			=> @$_REQUEST['email'],
												'login'			=> @$_REQUEST['email'],
												'password'		=> sha1($_REQUEST['password'].$this->salt) ));
				
				// if users is responding to an invitation, add the user to the relevant group
				if(@$_REQUEST['group_id'] && $_REQUEST['challenge_id']) $user_update['Class'] = array($_REQUEST['group_id']);
				
				$this->User->save($user_update);
				$this->Session->write('User',$user['User']);
				if($ajax) die('1');
				elseif(@$_REQUEST['group_id'] && !@$_REQUEST['challenge_id']) $this->redirect('/users/view/groups/');
				else $this->redirect('/dashboard/');
			}elseif($ajax) die('0');
			else $this->set('error',true);
		}elseif($ajax) die('0');
		else $this->redirect('/');
	}
	
	function check_login(){
		if(@$_SESSION['User']['id']) $this->redirect('/pages/home/');
		else $this->redirect('/dashboard/');
	}
	
	// deauthenticate
	function logout(){
		$this->Session->delete('User');
		$this->redirect('/');
	}
	
	function session_logout(){
		$this->layout = 'ajax';
	}
}
?>