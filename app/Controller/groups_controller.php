<?php
class GroupsController extends AppController{
	var $name = 'Groups';
	var $uses = array('User','Challenge','Class','Status');
	
	function update(){
		$this->checkAuth();
		
		if(@$_REQUEST['group']['Class']['group_name']) $this->Group->save($_REQUEST['group']);
		$this->redirect('/users/view/groups/1');
	}
	
	function view_members($group_id,$view='view_members'){
		$this->checkAuth();
		
		$this->Group->hasAndBelongsToMany['User']['conditions'] = 'User.search_visible = 1';
		$this->set('group',$this->Group->findById($group_id));
		$this->render($view,'ajax');
	}
	
	function request_join(){
		$this->checkAuth();
		
		// create pending status
		foreach(@$_REQUEST['groups'] as $group_id){
			$group = $this->Group->findById($group_id);
		
			// create pending status
			$status = array('Status' =>
							array(	'user_id'		=> $_SESSION['User']['id'],
									'group_id'		=> $group_id,
									'status'		=> 'R' ));
			$this->Status->save($status);
			
			if($group['Owner']['notify_groups']){
				// notify group leader
				$message = "{$group['Owner']['firstname']},\n\n{$_SESSION['User']['firstname']} requested to join your group, {$group['Class']['group_name']}, on Case Club Online.";
				$message .= "\n\n<a href='http://caseclubonline.com/users/view/groups/'>Click here to view!</a>";
				$message .= "\n\nSincerely,\n\nCase Club Online Team";
		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: noreply@caseclubonline.com' . "\r\n";
		
				// send invite email
				mail("{$group['Owner']['firstname']} {$group['Owner']['lastname']} <{$group['Owner']['email']}>","{$_SESSION['User']['firstname']} {$_SESSION['User']['lastname']} requested to join",nl2br($message),$headers);
			}
		}
		die();
	}
	
	function view_request($group_id){
		$this->checkAuth();
		$this->layout = 'ajax';
		
		$this->set('status',$this->Status->find('all',array('conditions'=>array('Status.group_id'=>$group_id,'Status.status'=>'R'))));
	}
	
	function process_requests($group_id,$action){
		$this->checkAuth();
		$group = $this->Group->findById($group_id);
		
		if(!@$_REQUEST['users']){
			$_REQUEST['users'][] = $_SESSION['User']['id'];
			$remove_status = 'P';
		}else $remove_status = 'R';
		
		foreach($_REQUEST['users'] as $u){
			$this->Status->deleteAll(array('Status.status'=>$remove_status,'Status.user_id'=>$u,'Status.group_id'=>$group_id,'Status.challenge_id IS NULL'));
			if($action == 'a'){
				$group_update = array('Class'=>array('id'=>$group_id));
				$group_update['User'] = array($u);
				foreach($group['User'] as $u) if(array_search($u['id'],$group_update['User']) === false) $group_update['User'][] = $u['id'];
				$this->Group->save($group_update);
			}
		}
		die();
	}
	
	function remove_member($group_id,$user_id){
		$this->checkAuth();
		
		$this->Group->UsersGroup->deleteAll(array('UsersGroup.user_id'=>$user_id,'UsersGroup.group_id'=>$group_id),false);
		die();
	}
	
	function delete($id){
		$this->checkAuth();
		$group = $this->Group->findById($id);
		if($group['Owner']['id'] != $_SESSION['User']['id']) return false;
		
		$this->Group->delete($id);
		$this->redirect('/users/view/groups/');
	}
}
?>