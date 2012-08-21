<?php
class MetricsController extends AppController{
	var $name = 'Metrics';
	var $uses = array('Response','Question','Challenge','Group','User');
	
	function view_students($challenge_id=NULL,$group_id=NULL,$chart=false){
		$this->checkAuth();
		
		$this->Challenge->Behaviors->attach('Containable');
		$this->Question->Behaviors->attach('Containable');
		$this->Response->Behaviors->attach('Containable');
		$this->Group->Behaviors->attach('Containable');
		
		if($challenge_id) $challenge_ids = $challenge_id;
		else{
			$cids = $this->Challenge->find('all',array('fields'=>'Challenge.id','conditions'=>'responses_due < NOW()','order'=>'responses_due DESC','limit'=>@$_REQUEST['date_range']));
			$challenge_ids = '';
			foreach($cids as $v) $challenge_ids .= ($challenge_ids ? ',' : '') . $v['Challenge']['id'];
		}
		
		list($q_ids) = $this->Question->find('first',array(	'conditions'	=> 'Question.challenge_id IN('.$challenge_ids.')',
																												'fields'			=> 'GROUP_CONCAT(DISTINCT Question.id SEPARATOR ",") as ids',
																												'group'				=> 'Question.challenge_id',
																												'contain'			=> array()));
																												
		list($r_ids) = $this->Response->find('first',array(	'conditions'	=> 'Response.question_id IN('.$q_ids['ids'].')',
																												'fields'			=> 'GROUP_CONCAT(DISTINCT Response.id SEPARATOR ",") as ids',
																												'group'				=> 'Response.response_id',
																												'contain'			=> array()));
		
		$users_groups = array();
		if($challenge_id){
			$group_users = $this->Group->find('all',array(	'conditions'	=> 'Group.challenge_id = '.$challenge_id,
																														'contain'			=> array('User'	=> array('fields' => 'User.id'))));
			foreach($group_users as $g){
				foreach($g['User'] as $u){
					$users_groups[$u['id']] = $g['Group']['id'];
				}
			}
		}

		$contains = array(	'Group',
												'Question',
												'ClassSet'	=> array('User' => array(	'Response'		=> array(	'Parent' 			=> array( 'fields' => 'Parent.user_id' ),
																																											'conditions'	=> 'Response.question_id IN('.$q_ids['ids'].')' . ($r_ids['ids'] ? ' || Response.response_id IN('.$r_ids['ids'].')' : '')),
																															'Comment' 		=> array(	'fields'			=> 'Comment.id',
																															 												'conditions'	=> 'Comment.response_id IN('.($r_ids['ids'] ? $r_ids['ids'] : '0').')' ))));
																															
		$challenges = $this->Challenge->find('all',array('conditions'=>array('Challenge.id IN('.$challenge_ids.')'),'contain'=>$contains));

		$ucount = 0;
		if(!$users_groups){
			foreach($challenges as $v=>$challenge){
				foreach($challenge['ClassSet'] as $k=>$c){
					if(@$_REQUEST['class_id'] && $_REQUEST['class_id'] != $c['id']){
						unset($challenges[$v]['ClassSet'][$k]);
						continue;
					}
					foreach($c['User'] as $i=>$u) $ucount++;
				}	
			}
		}

		$activity = array();
		$quality = array();
		$max_keystrokes = $min_keystrokes = 0;
		$max_comments = $min_comments = 0;
		foreach($challenges as $v=>$challenge){
			foreach($challenge['ClassSet'] as $k=>$c){
				foreach($c['User'] as $i=>$u){
					$keystrokes = 0;
					foreach($u['Response'] as $r){
						if($r['question_id']) $keystrokes += strlen($r['response_body']);
						else{
							if(@$_REQUEST['quality'] == 'I' && $u['user_type'] != 'L') continue;
							elseif(@$_REQUEST['quality'] == 'S' && $u['user_type'] != 'P') continue;
						
							@$quality[$r['Parent']['user_id']][0]++;
							@$quality[$r['Parent']['user_id']][1]+=$r['response_body'];
						}
					}
				
					if($u['user_type'] != 'P'){
						unset($challenges[$v]['ClassSet'][$k]['User'][$i]);
						continue;
					}
					
					if($group_id && @$users_groups[$u['id']] != $group_id){
						unset($challenges[$v]['ClassSet'][$k]['User'][$i]);
						continue;
					}
				
					@$activity[$u['id']]['keys'] += $keystrokes;
					@$activity[$u['id']]['comments'] += count($u['Comment']);
					@$activity[$u['id']]['challenges']++;
				
					$users_in_group = $users_groups ? count(array_keys($users_groups,@$users_groups[$u['id']])) : $ucount;
					$possible_responses = count(explode(',',$q_ids['ids'])) + (($users_in_group - 1) * count(explode(',',$q_ids['ids'])));
					@$activity[$u['id']]['completion'] += count($u['Response']) / $possible_responses;

					if(!@$quality[$u['id']]){
						@$quality[$u['id']][0] = 0;
						@$quality[$u['id']][1] = 0;
					}
				}
			}
		}
		
		foreach($activity as $a){
			$max_keystrokes = $a['keys'] / count($a['challenges']) > $max_keystrokes ? $a['keys'] / count($a['challenges']) : $max_keystrokes;
			$min_keystrokes = $a['keys'] / count($a['challenges']) < $min_keystrokes ? $a['keys'] / count($a['challenges']) : $min_keystrokes;
		
			$max_comments = $a['comments'] / count($a['challenges']) > $max_comments ? $a['comments'] / count($a['challenges']) : $max_comments;
			$min_comments = $a['comments'] / count($a['challenges']) < $min_comments ? $a['comments'] / count($a['challenges']) : $min_comments;
		}
	
		$this->set('activity',$activity);
		$this->set('quality',$quality);
		$this->set('min_keystrokes',$min_keystrokes);
		$this->set('max_keystrokes',$max_keystrokes);
		$this->set('min_comments',$min_comments);
		$this->set('max_comments',$max_comments);
		$this->set('challenges',$challenges);
		$this->set('user',$this->User->findById($_SESSION['User']['id']));
		$this->set('group_id',$group_id);
		
		if($chart) $this->render('view_chart');
	}
	
	function view_questions($challenge_id){
		$this->checkAuth();
		
		$this->Challenge->Behaviors->attach('Containable');
		$contains = array( 'Question' => array( 'Response' => array( 'User','Comment' )));				
		$challenge = $this->Challenge->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id),'contain'=>$contains));
		
		$max_keystrokes = $min_keystrokes = 0;
		$max_comments = $min_comments = 0;
		foreach($challenge['Question'] as $k=>$q){
			foreach($q['Response'] as $i=>$r){
				$challenge['Question'][$k]['Response'][$i]['positive_comments'] = 0;
				$challenge['Question'][$k]['Response'][$i]['negative_comments'] = 0;
				foreach($r['Comment'] as $c) $challenge['Question'][$k]['Response'][$i][($c['type'] ? 'positive' : 'negative') . '_comments']++;
				
				$max_comments = count($r['Comment']) > $max_comments ? count($r['Comment']) : $max_comments;
				$min_comments = count($r['Comment']) < $min_comments ? count($r['Comment']) : $min_comments;
				
				$max_keystrokes = strlen($r['response_body']) > $max_keystrokes ? strlen($r['response_body']) : $max_keystrokes;
				$min_keystrokes = strlen($r['response_body']) < $min_keystrokes ? strlen($r['response_body']) : $min_keystrokes;
			}
		}
			
		$this->set('challenge',$challenge);
		$this->set('min_keystrokes',$min_keystrokes);
		$this->set('max_keystrokes',$max_keystrokes);
		
		$this->set('min_comments',$min_comments);
		$this->set('max_comments',$max_comments);
	}
	
	function set_detail_session($v=0){
		$this->checkAuth();
		$this->Session->write('show_stats',$v);
		die();
	}
}
?>