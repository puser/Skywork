<?php
class MetricsController extends AppController{
	var $name = 'Metrics';
	var $uses = array('Response','Question','Challenge','Group','User','WordFlag','Comment');
	
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
																																											'conditions'	=> 'Response.question_id IN('.$q_ids['ids'].')' . ($r_ids['ids'] ? ' || Response.response_id IN('.$r_ids['ids'].')' : ''),
																																											'order'				=> 'Response.id DESC'),
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
					$checked_responses = array();
					foreach($u['Response'] as $r){
						if($r['question_id'] && !in_array($r['question_id'],$checked_responses)){
							$checked_responses[] = $r['question_id'];
							$keystrokes += strlen($r['response_body']);
							if(str_word_count($r['response_body']) >= $challenge['Challenge']['min_response_length']) @$activity[$u['id']]['responses']++;
						}elseif(!in_array($r['question_id'],$checked_responses)){
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
					@$activity[$u['id']]['questions'] += count($challenge['Question']);
				
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
			$max_keystrokes = @$a['keys'] / (@$a['challenges'] ? count($a['challenges']) : 1) > $max_keystrokes ? @$a['keys'] / (@$a['challenges'] ? count($a['challenges']) : 1) : $max_keystrokes;
			$min_keystrokes = @$a['keys'] / (@$a['challenges'] ? count($a['challenges']) : 1) < $min_keystrokes ? @$a['keys'] / (@$a['challenges'] ? count($a['challenges']) : 1) : $min_keystrokes;
		
			$max_comments = @$a['comments'] / (@$a['challenges'] ? count($a['challenges']) : 1) > $max_comments ? @$a['comments'] / (@$a['challenges'] ? count($a['challenges']) : 1) : $max_comments;
			$min_comments = @$a['comments'] / (@$a['challenges'] ? count($a['challenges']) : 1) < $min_comments ? @$a['comments'] / (@$a['challenges'] ? count($a['challenges']) : 1) : $min_comments;
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
				$challenge['Question'][$k]['Response'][$i]['neutral_comments'] = 0;
				foreach($r['Comment'] as $c) $challenge['Question'][$k]['Response'][$i][($c['type'] == 2 ? 'neutral' : ($c['type'] ? 'positive' : 'negative')) . '_comments']++;
				
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
	
	function view_flags($challenge_id){
		$this->checkAuth();
		
		$challenge = $this->Challenge->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id),'recursive'=>2));
		$flags = $this->WordFlag->find('all',array('conditions'=>'WordFlag.user_id = '.$_SESSION['User']['id']));

		$user_flag_total = array();
		$user_text = array();
		$user_flags = array();
		$maxwords_flag = array();
		$checked_responses = array();
		foreach($challenge['Question'] as $q){
			foreach($q['Response'] as $r){
				if(@$checked_responses[$r['user_id'].'_'.$q['id']]) continue;
				else $checked_responses[$r['user_id'].'_'.$q['id']] = 1;
				
				@$user_text[$r['user_id']] .= ' ' . $r['response_body'];
				if(str_word_count($r['response_body']) > $challenge['Challenge']['max_response_length'] && $challenge['Challenge']['max_response_length']){
					@$user_flag_total[$r['user_id']]++;
					if(@$maxwords_flag[$r['user_id']]){
						$maxwords_flag[$r['user_id']]['flags']++;
						$maxwords_flag[$r['user_id']]['words'] += str_word_count($r['response_body']) - $challenge['Challenge']['max_response_length'];
					}else $maxwords_flag[$r['user_id']] = array('words' => str_word_count($r['response_body']) - $challenge['Challenge']['max_response_length'],'flags' => 1);
				}
				
				$comments = $this->Comment->find('all',array('conditions'=>array('Comment.response_id'=>$r['id'])));
				foreach($comments as $c) @$user_text[$c['Comment']['user_id']] .= ' ' . $c['Comment']['comment'];
			}
		}
		
		foreach($user_text as $k=>$t){
			foreach($flags as $f){
				if(substr_count(strtoupper($t),strtoupper($f['WordFlag']['word'])) >= $f['WordFlag']['count']){
					@$user_flag_total[$k] += substr_count(strtoupper($t),strtoupper($f['WordFlag']['word']));
					@$user_flags[$k][$f['WordFlag']['flag_type']][$f['WordFlag']['word']] += substr_count(strtoupper($t),strtoupper($f['WordFlag']['word']));
				}
			}
		}
		
		$this->set('user_flag_total',$user_flag_total);
		$this->set('user_flags',$user_flags);
		$this->set('maxwords_flag',$maxwords_flag);
		$this->set('challenge',$challenge);
	}
	
	function set_detail_session($v=0){
		$this->checkAuth();
		$this->Session->write('show_stats',$v);
		die();
	}
}
?>