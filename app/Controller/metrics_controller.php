<?php
class MetricsController extends AppController{
	var $name = 'Metrics';
	var $uses = array('Response','Question','Challenge','Group');
	
	function view_students($challenge_id){
		
		$this->Challenge->Behaviors->attach('Containable');
		$this->Question->Behaviors->attach('Containable');
		$this->Response->Behaviors->attach('Containable');
		$this->Group->Behaviors->attach('Containable');
		
		list($q_ids) = $this->Question->find('first',array(	'conditions'	=> 'Question.challenge_id = '.$challenge_id,
																												'fields'			=> 'GROUP_CONCAT(DISTINCT Question.id SEPARATOR ",") as ids',
																												'group'				=> 'Question.challenge_id',
																												'contain'			=> array()));
																												
		list($r_ids) = $this->Response->find('first',array(	'conditions'	=> 'Response.question_id IN('.$q_ids['ids'].')',
																												'fields'			=> 'GROUP_CONCAT(DISTINCT Response.id SEPARATOR ",") as ids',
																												'group'				=> 'Response.response_id',
																												'contain'			=> array()));
																											
		$group_users = $this->Group->find('all',array(	'conditions'	=> 'Group.challenge_id = '.$challenge_id,
																													'contain'			=> array('User'	=> array('fields' => 'User.id'))));
		$users_groups = array();
		foreach($group_users as $g){
			foreach($g['User'] as $u){
				$users_groups[$u['id']] = $g['Group']['id'];
			}
		}
																													
		$contains = array(	'Group',
												'Question',
												'ClassSet'	=> array('User' => array(	'conditions'	=> 'User.user_type = "P"',
																															'Response'		=> array(	'fields'			=> 'Response.id,Response.response_body,Response.question_id',
																																											'conditions'	=> 'Response.question_id IN('.$q_ids['ids'].') || Response.response_id IN('.$r_ids['ids'].')'),
																															'Comment' 		=> array(	'fields'			=> 'Comment.id',
																															 												'conditions'	=> 'Comment.response_id IN('.$r_ids['ids'].')' ))));
																															
		$challenge = $this->Challenge->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id),'contain'=>$contains));

		$ucount = 0;
		if(!$users_groups){
			foreach($challenge['ClassSet'] as $k=>$c){
				foreach($c['User'] as $i=>$u) $ucount++;
			}	
		}

		$quality = array();
		$max_keystrokes = $min_keystrokes = 0;
		$max_comments = $min_comments = 0;
		foreach($challenge['ClassSet'] as $k=>$c){
			foreach($c['User'] as $i=>$u){
				$users_in_group = $users_groups ? count(array_keys($users_groups,$users_groups[$u['id']])) : $ucount;
				$possible_responses = $users_in_group + (($users_in_group - 1) * count($challenge['Question']));
				$challenge['ClassSet'][$k]['User'][$i]['completion'] = count($u['Response']) / $possible_responses;
				
				if(!@$quality[$u['id']]){
					@$quality[$u['id']][0] = 0;
					@$quality[$u['id']][1] = 0;
				}

				$keystrokes = 0;
				foreach($u['Response'] as $r){
					if($r['question_id']) $keystrokes += strlen($r['response_body']);
					else{
						@$quality[$u['id']][0]++;
						@$quality[$u['id']][1]+=$r['response_body'];
					}
				}
				$max_keystrokes = $keystrokes > $max_keystrokes ? $keystrokes : $max_keystrokes;
				$min_keystrokes = $keystrokes < $min_keystrokes ? $keystrokes : $min_keystrokes;
				$challenge['ClassSet'][$k]['User'][$i]['keystrokes'] = $keystrokes;
				
				$max_comments = count($u['Comment']) > $max_comments ? count($u['Comment']) : $max_comments;
				$min_comments = count($u['Comment']) < $min_comments ? count($u['Comment']) : $min_comments;
				$challenge['ClassSet'][$k]['User'][$i]['comments'] = count($u['Comment']);
			}
		}
	
		$this->set('quality',$quality);
		$this->set('min_keystrokes',$min_keystrokes);
		$this->set('max_keystrokes',$max_keystrokes);
		$this->set('min_comments',$min_comments);
		$this->set('max_comments',$max_comments);
		$this->set('challenge',$challenge);
	}
	
	function view_questions($challenge_id){
		
	}
	
	function chart(){
		
	}
}
?>