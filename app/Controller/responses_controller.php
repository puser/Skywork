<?php
class ResponsesController extends AppController{
	var $name = 'Responses';
	var $uses = array('Response','Question','Status','Challenge','User');
	
	// view another user's response for a question; view own answer for a question
	function view($challenge_id,$user_id=NULL,$question_id=NULL){
		$this->checkAuth(@$_REQUEST['ajax'] ? true : false);
		
		$this->Challenge->id = $challenge_id;
		$completed = $this->Challenge->field('if(responses_due < NOW(),1,0)');
			
		$this->Challenge->Behaviors->attach('Containable');
		$contains = array(	'Collaborator',
												'ClassSet'	=> array('User'),
												'Group'			=> array('User'),
												'Question' 	=> array('Response'	=> array(	'conditions'	=> "Response.user_id = " . ($user_id ? $user_id : $_SESSION['User']['id']),
																																	'Responses'		=> array(	'conditions'	=> ($completed ? '' : "Responses.user_id = " . $_SESSION['User']['id'])),
																																	'Comment' 	 	=> array(	'conditions'	=> ($completed ? '' : "Comment.user_id = ". $_SESSION['User']['id']), 
																																													'order' => 'Comment.segment_start DESC',
																																													'User' ))));
												
		$challenge = $this->Challenge->find('all',array('conditions'=>"Challenge.id = $challenge_id",'contain'=>$contains));
	
		if($completed){
			foreach($challenge[0]['Question'] as $k=>$q){
				foreach((@$q['Response'][0]['Responses'] ? @$q['Response'][0]['Responses'] : array()) as $r) @$challenge[0]['Question'][$k]['response_total'] += $r['response_body'];
				@$challenge[0]['Question'][$k]['response_total'] = round(@$challenge[0]['Question'][$k]['response_total']/count($q['Response'][0]['Responses']));
			}
		}
				
		if($_SESSION['User']['user_type'] == 'P'){
			foreach($challenge[0]['Group'] as $k=>$g){
				$user_group = false;
				foreach($g['User'] as $u){
					if($u['id'] == $_SESSION['User']['id']){
						$user_group = true;
						break;
					}
				}
				if(!$user_group) unset($challenge[0]['Group'][$k]);
			}
			
			$this->set('user',$this->User->findById($user_id));
			$this->set('question_id',$question_id ? $question_id : @$challenge[0]['Question'][0]['id']);
		}elseif(!$user_id){
			if(@$challenge[0]['Group'][0]['User'][0]['id']) $redirect_user = $challenge[0]['Group'][0]['User'][0]['id'];
			else{ 
				foreach($challenge[0]['ClassSet'] as $cs){
					foreach($cs['User'] as $u){
						if($u['user_type'] == 'P'){
							$redirect_user = $u['id'];
							break;
						}
					}
					if(@$redirect_user) break;
				}
			}
			$this->redirect('/responses/view/'.$challenge_id.'/'.($redirect_user ? $redirect_user : 'error'));
		}
		
		$this->set('challenge',$challenge);
		$this->set('user_id',$user_id);
		$this->set('completed',$completed);
			
		if(@$_REQUEST['ajax']){
			$this->set('ajax',true);
			$this->layout = 'ajax';
		}
	}
	
	// create or update own answer to a question or own response to another user's answer
	function update(){
		$this->checkAuth();
		if(@$_REQUEST['question_id'] || @$_REQUEST['response_id'] || count(@$_REQUEST['responses'])){
			if(count(@$_REQUEST['responses'])){
				foreach($_REQUEST['responses'] as $k=>$r) $_REQUEST['responses'][$k]['user_id'] = $_SESSION['User']['id'];
				$this->Response->saveAll($_REQUEST['responses']);
			}else{
				$_REQUEST['user_id'] = $_SESSION['User']['id'];
				if(@$_REQUEST['response_id']) $this->Response->deleteAll(array('Response.response_id' => $_REQUEST['response_id'],'Response.user_id' => $_SESSION['User']['id']));
				$this->Response->save($_REQUEST);
			}
				
			// if user is has responded to all questions, set status to C
			if(@$_REQUEST['question_id']){
				$this->Question->hasMany['Response']['conditions'] = 'Response.user_id = '.$_SESSION['User']['id'];
				$q = $this->Question->find('first',array('conditions'=>'Question.id = '.$_REQUEST['question_id'],'recursive'=>2));
				
				if(count($q['Response']) >= count($q['Challenge']['Question'])){
					$s = $this->Status->find('first',array('conditions'=>array('Status.user_id'=>$_SESSION['User']['id'],'Status.challenge_id'=>$q['Challenge']['id'])));
					
					if($s['Status']['status'] != 'C'){
						$this->Status->id = $s['Status']['id'];
						$this->Status->saveField('status','C');
					}
				}
			}
			
			die($this->Response->id);
		}else{
			echo '0';
			die();
		}
	}
}
?>