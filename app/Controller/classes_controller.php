<?php
class ClassesController extends AppController{
	var $name = 'Classes';
	var $uses = array('User','Challenge','ClassSet','Status','UserClass');
	
	function update($id = NULL){
		$this->checkAuth();
			
		if(@$_REQUEST['class']['ClassSet']['group_name']){
			$this->ClassSet->save($_REQUEST['class']);
			if(!isset($_REQUEST['class']['ClassSet']['id'])) die($this->ClassSet->id);
			else $this->redirect('/users/view/classes/');
		}
		else{
			$this->layout = 'ajax';
			$this->set('class',$this->ClassSet->findById($id));
		}
	}
	
	function update_token($id){
		$this->checkAuth();
		
		$token = sha1(time().rand(1000,10000));
		$token = substr($token,0,3).'-'.substr($token,4,3).'-'.substr($token,8,3).'-'.substr($token,11,1);
		$this->ClassSet->save(array('ClassSet'=>array('id'=>$id,'auth_token'=>$token)));
		
		die($token);
	}
	
	function view_members($class_id,$view='view_students'){
		$this->checkAuth();
		
		// * TODO * : ensure that the search_visible logic is implemented correctly 
		// $this->ClassSet->hasAndBelongsToMany['User']['conditions'] = 'User.search_visible = 1 && (User.user_type = "' . ($view == 'view_students' ? 'P" || "C' : 'L') . '")';
		$this->ClassSet->hasAndBelongsToMany['User']['conditions'] = '(User.user_type = "' . ($view == 'view_students' ? 'P" || User.user_type = "C' : 'L') . '")';
		$this->ClassSet->hasAndBelongsToMany['User']['order'] = 'User.last_login ASC';
		$this->set('class',$this->ClassSet->findById($class_id));
		$this->set('invited',$this->Status->find('all',array('conditions'=>("Status.class_id = $class_id && Status.challenge_id IS NULL && Status.status = 'P' && User.user_type = " . ($view == 'view_students' ? "'P'": "'L'")))));
		$this->render($view,'ajax');
	}
	
	function invite_member($id,$type){
		$this->checkAuth();
		$this->set('class',$this->ClassSet->findById($id));
		$this->render('create_' . $type,'ajax');
	}
	
	function search_shared($query){
		$this->checkAuth();
		$this->layout = 'ajax';
		$this->User->hasAndBelongsToMany['ClassSet']['conditions'] = 'ClassSet.public = 1';
		$this->set('user',$this->User->findByEmail($query));
	}
	
	function join_with_token(){
		$this->checkAuth();
		$group = $this->ClassSet->findByAuthToken($_REQUEST['joinClassToken']);
		if($group){
			$group_update = array('ClassSet'=>array('id'=>$group['ClassSet']['id']));
			$group_update['User'] = array($_SESSION['User']['id']);
			foreach($group['User'] as $u) if($u['id'] != $_SESSION['User']['id']) $group_update['User'][] = $u['id'];
			$this->ClassSet->save($group_update);
		}
		$this->redirect('/users/view/classes');
	}
	
	function request_join(){
		$this->checkAuth();
		
		foreach(@$_REQUEST['groups'] as $group_id){
			$group = $this->ClassSet->findById($group_id);
		
			// create pending status
			$status = array('Status' =>
											array(	'user_id'		=> $_SESSION['User']['id'],
															'class_id'	=> $group_id,
															'status'		=> 'R' ));
			$this->Status->save($status);
			
			if($group['Owner']['notify_groups']){
				// notify group leader
				$message = "{$group['Owner']['firstname']},\n\n{$_SESSION['User']['firstname']} requested to join your class {$group['ClassSet']['group_name']}, on Puentes Online - the world's first feedback learning system.";
				$message .= "\n\n<a href='http://puentesonline.com/users/view/groups/'>Click here to Accept or Decline</a>";
				$message .= "\n\nSincerely,\n\nThe Puentes Team";
		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Puentes <noreply@puentesonline.com>' . "\r\n";
		
				// send invite email
				mail("{$group['Owner']['firstname']} {$group['Owner']['lastname']} <{$group['Owner']['email']}>","{$_SESSION['User']['firstname']} {$_SESSION['User']['lastname']} requested to join your class",nl2br($message),$headers);
			}
		}
		die();
	}
	
	function view_request($group_id){
		$this->checkAuth();
		$this->layout = 'ajax';
				
		$this->set('status',$this->Status->find('all',array('conditions'=>array('Status.class_id'=>$group_id,'Status.status'=>'R'))));
	}
	
	function process_requests($group_id,$action){
		$this->checkAuth();
		$group = $this->ClassSet->findById($group_id);
		
		if(!@$_REQUEST['users']){
			$_REQUEST['users'][] = $_SESSION['User']['id'];
			$remove_status = 'P';
		}else $remove_status = 'R';
		
		foreach($_REQUEST['users'] as $u){
			if($action == 'a'){
				// set the status to 'C'; we'll use this record to determine which bridges are visible to the user based on the timestamp
				$s = $this->Status->find('first',array('conditions'=>array('Status.user_id'=>$u,'Status.class_id'=>$group_id,'Status.challenge_id IS NULL')));
				$this->Status->id = $s['Status']['id'];
				$this->Status->saveField('status','C');
				
				$group_update = array('ClassSet'=>array('id'=>$group_id));
				$group_update['User'] = array($u);
				foreach($group['User'] as $u) if(array_search($u['id'],$group_update['User']) === false) $group_update['User'][] = $u['id'];
				$this->ClassSet->save($group_update);
			}else $this->Status->deleteAll(array('Status.status'=>$remove_status,'Status.user_id'=>$u,'Status.class_id'=>$group_id,'Status.challenge_id IS NULL'));
		}
		die();
	}
	
	function remove_member($class_id,$user_id){
		$this->checkAuth();
		
		$this->UserClass->deleteAll(array('UserClass.user_id'=>$user_id,'UserClass.class_id'=>$class_id),false);
		die();
	}
	
	function delete($id){
		$this->checkAuth();
		$group = $this->ClassSet->findById($id);
		if($group['Owner']['id'] != $_SESSION['User']['id']) return false;
		
		$this->ClassSet->delete($id);
		$this->redirect('/users/view/classes/');
	}
}
?>