<?php
class GradesController extends AppController{
	var $name = 'Grades';
	var $uses = array('Grade','User','Challenge');

	function update($challenge_id,$user_id){
		$this->checkAuth();
		$this->layout = 'ajax';
		
		if(@$_POST['grade']){
			$this->Grade->save($_REQUEST['grade']);
			die();
		}else{
			$this->Challenge->Behaviors->attach('Containable');
			$contains = array(	'Question' 	=> array('Response'	=> array(	'conditions'	=> "Response.user_id = " . $user_id,
																																		'Comment'			=> array( 'conditions'	=> 'Comment.user_id = Challenge.user_id' ))));
			$this->set('challenge',$this->Challenge->find('first',array('conditions'=>"Challenge.id = $challenge_id",'contain'=>$contains)));
			$this->set('grade',$this->Grade->find('first',array('conditions' => array('Grade.user_id' => $user_id,'Grade.challenge_id' => $challenge_id))));
			$this->set('user',$this->User->findById($user_id));
			$this->set('challenge_id',$challenge_id);
			$this->set('user_id',$user_id);
		}
	}
	
	function challenge_summary($challenge_id,$completed = false){
		$this->checkAuth();
		$this->layout = 'ajax';
		
		$this->Challenge->Behaviors->attach('Containable');
		$contains = array(	'Question' 	=> array('Response'	=> array(	'Comment'	=> array( 'conditions'	=> 'Comment.user_id = Challenge.user_id' ))));
		$challenge = $this->Challenge->find('first',array('conditions'=>"Challenge.id = $challenge_id",'contain'=>$contains));
		$comment_count = array();
		foreach($challenge['Question'] as $q){
			foreach($q['Response'] as $r){
				$comment_count[$r['user_id']] = count($r['Comment']);
			}
		}
		
		$this->set('comment_count',$comment_count);
		$this->set('grades',$this->Grade->find('all',array('conditions' => 'Challenge.id = '.$challenge_id)));
	}
	
	function completed_summary($challenge_id,$user_id){
		$this->checkAuth();
		$this->layout = 'ajax';
		
		$contains = array(	'Question' 	=> array('Response'	=> array(	'conditions'	=> "Response.user_id = " . $user_id,
																																	'Comment'			=> array( 'conditions'	=> 'Comment.user_id = Challenge.user_id' ))));
		$this->set('challenge',$this->Challenge->find('first',array('conditions'=>"Challenge.id = $challenge_id",'contain'=>$contains)));
		$this->set('grade',$this->Grade->find('first',array('conditions' => array('Grade.user_id' => $user_id,'Grade.challenge_id' => $challenge_id))));
		$this->set('user',$this->User->findById($user_id));
	}
}