<?php
class ResponsesController extends AppController{
	var $name = 'Responses';
	var $uses = array('Response','Question','Status');
	
	// view another user's response for a question; view own answer for a question
	function view($question_id,$user_id=NULL){
		$this->checkAuth(@$_REQUEST['ajax'] ? true : false);
		
		$this->Question->hasMany['Response']['conditions'] = "Response.user_id = " . ($user_id ? $user_id : $_SESSION['User']['id']);
		$question = $this->Question->find('all',array('conditions'=>"Question.id = $question_id",'recursive'=>2));
		$this->set('question',$question);
		
		$q_num = $this->Question->find('count',array('conditions'=>array("Question.id < {$question['Question']['id']}","Question.challenge_id = {$question['Question']['challenge_id']}"))) + 1;
		$this->set('q_num',$q_num);
		
		$neighbors = $this->Question->find('neighbors',array(	'field'		=> 'id',
																'value'		=> $question['Question']['id'],
																'conditions'=> array("Question.challenge_id = {$question['Question']['challenge_id']}","Question.question != ''")));
		$this->set('next_id',@$neighbors['next']['Question']['id']);
		if(@$_REQUEST['ajax']){
			$this->set('ajax',true);
			$this->layout = 'ajax';
		}
		
		if(!$user_id){
			$this->set('response',$this->Response->find('first',array('conditions'=>array('Question.id'=>$question_id,'User.id'=>$_SESSION['User']['id']),'recursive'=>2)));
			$this->render('view_all');
		}else{
			$this->set('own_response',$this->Response->find('first',array(	'conditions'=>array(	'Response.user_id'		=> $_SESSION['User']['id'],
																									'Response.response_id'	=> $question['Response'][0]['id'] ),
																			'recursive'	=> -1 )));
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
		}else die('0');
	}
}
?>