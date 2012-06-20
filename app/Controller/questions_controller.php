<?php
class QuestionsController extends AppController{
	var $name = 'Questions';
	
	// view a challenge's questions
	function view($id){
		$this->checkAuth(true);
		$this->layout = 'ajax';
		
		$this->Question->hasMany['Response']['conditions'] = "Response.user_id = {$_SESSION['User']['id']}";
		$this->Question->hasMany['Response']['limit'] = 1;
		$this->Question->hasMany['Response']['order'] = 'Response.id DESC';
		$question = $this->Question->findById($id);
		$this->set('question',$question);
		
		$q_num = $this->Question->find('count',array('conditions'=>array("Question.id < {$question['Question']['id']}","Question.challenge_id = {$question['Question']['challenge_id']}"))) + 1;
		$this->set('q_num',$q_num);
		
		$neighbors = $this->Question->find('neighbors',array(	'field'		=> 'id',
																'value'		=> $question['Question']['id'],
																'conditions'=> array("Question.challenge_id = {$question['Question']['challenge_id']}","Question.question != ''")));
		$this->set('next_id',@$neighbors['next']['Question']['id']);
	}
	
	// create or edit a challenge's questions
	function update($challenge_id=NULL){
		$this->checkAuth();
		$this->layout = 'ajax';
		
		if(@$_REQUEST['question']){
			$this->Question->saveAll($_REQUEST['question']);
			die($challenge_id);
		}else{
			$challenge = $this->Question->Challenge->findById($challenge_id);
			$this->set('challenge_id',$challenge_id);
			$this->set('challenge',$challenge);
		}
	}
}
?>