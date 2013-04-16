<?php
class WordFlagsController extends AppController {
	var $name = 'WordFlags';
	var $uses = array('WordFlag','User','Challenge','Response');
	
	function view($type='WORD'){
		$this->checkAuth();
		$this->layout = 'ajax';
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.flag_type = "'.$type.'" && WordFlag.user_id = '.$_SESSION['User']['id'])));
		$this->set('type',$type);
	}
	
	function update($word=NULL,$count=NULL,$type='WORD'){
		$this->checkAuth();
		$this->layout = 'ajax';
		if(@$_REQUEST['type']) $type = $_REQUEST['type'];
		
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.flag_type = "'.$type.'" && WordFlag.user_id = '.$_SESSION['User']['id'])));
		$this->set('type',$type);
		
		if($word && $count){
			if(@$_REQUEST['id']) $this->WordFlag->id = $_REQUEST['id'];
			$this->WordFlag->save(array('flag_type'=>$type,'word'=>$word,'count'=>$count,'user_id'=>$_SESSION['User']['id']));
			if(@$_REQUEST['addnew']) $this->redirect('/word_flags/update/?type=' . $type);
			elseif(@$_REQUEST['viewnext']) $this->redirect('/word_flags/update/' . $_REQUEST['viewnext'] . '?type=' . $type);
			else $this->redirect('/word_flags/view/' . $type);
		}elseif($word){
			$this->set('count',$this->WordFlag->field('count',array('flag_type'=>$type,'word'=>$word,'user_id'=>$_SESSION['User']['id'])));
			$this->set('word',$word);
			$this->set('word_id',$this->WordFlag->field('id',array('flag_type'=>$type,'word'=>$word,'user_id'=>$_SESSION['User']['id'])));
		}
	}
	
	function delete($id,$type){
		$this->checkAuth();
		$this->WordFlag->delete($id);
		$this->redirect('/word_flags/view/' . $type);
	}
	
	function browse($user_id,$challenge_id,$type='all',$word_search=NULL){
		$this->checkAuth();
		$this->Challenge->Question->hasMany['Response']['conditions'] = 'Response.user_id = ' . $user_id;
		$challenge = $this->Challenge->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id),'recursive'=>2));
		
		$flag_redirects = array();
		$flag_types = array();
		
		if(@$_REQUEST['redirect']) $_SESSION['flag_redirect'] = $_REQUEST['redirect'];
		
		// find all matches for flags of specified type(s); prepare redirect schedule
		if($type == 'WORD' || $type == 'PHRASE' || $type == 'EXPL' || $type == 'all'){
			$conditions = 'WordFlag.user_id = '.$_SESSION['User']['id'];
			if($type != 'all') $conditions .= ' && WordFlag.flag_type = "' . $type . '"';
			if($word_search) $conditions .= ' && WordFlag.word = "' . $word_search . '"';
			$flags = $this->WordFlag->find('all',array('conditions'=>$conditions));
			
			$word_counts = array();
			$flagged_words = array();
			$flagged_comments = array();
			foreach($challenge['Question'] as $q){
				if(!@$q['Response'][0]) continue;
				
				$r = $q['Response'][0];
				foreach($flags as $f){
					if(strstr($r['response_body'],$f['WordFlag']['word']) !== false){
						@$flagged_words[$f['WordFlag']['word']][] = array($r['id'],$r['question_id'],$r['user_id'],substr_count(strtoupper($r['response_body']),strtoupper($f['WordFlag']['word'])));
						@$word_counts[$f['WordFlag']['word']] += substr_count(strtoupper($r['response_body']),strtoupper($f['WordFlag']['word']));
					}
				}	
				
				$this->Response->hasMany['Comment']['conditions'] = 'Comment.user_id = ' . $user_id;
				$responses = $this->Response->find('all',array('conditions'=>array('Response.question_id'=>$r['question_id'],'Response.user_id != '.$user_id)));
				foreach($responses as $response){
					foreach($response['Comment'] as $c){
						foreach($flags as $f){
							if(strstr($c['comment'],$f['WordFlag']['word']) !== false){
								@$flagged_comments[$f['WordFlag']['word']][] = array($c['id'],$response['Response']['id'],$response['Response']['user_id'],substr_count(strtoupper($c['comment']),strtoupper($f['WordFlag']['word'])));
								@$word_counts[$f['WordFlag']['word']] += substr_count(strtoupper($c['comment']),strtoupper($f['WordFlag']['word']));
							}
						}
					}
				}
			}
			
			foreach($flags as $f){
				if(@$word_counts[$f['WordFlag']['word']] >= $f['WordFlag']['count']){
					if(@$flagged_words[$f['WordFlag']['word']]){
						foreach($flagged_words[$f['WordFlag']['word']] as $k=>$r){ 
							for($i = 0;$i < $r[3];$i++){
								$flag_redirects[] = '/responses/view/'.$challenge['Challenge']['id'].'/'.$r[2].'?ajax=1&highlight='.$f['WordFlag']['word'].'&pos='.($i + 1).'&response_id='.$r[0];
								$flag_types[] = ($f['WordFlag']['flag_type'] == 'WORD' ? 'Word Overuse' : ($f['WordFlag']['flag_type'] == 'EXPL' ? 'Explicit Language' : 'Phrase Flag'));
							}
						}
					}
					
					if(@$flagged_comments[$f['WordFlag']['word']]){
						foreach(@$flagged_comments[$f['WordFlag']['word']] as $k=>$r){
							for($i = 0;$i < $r[3];$i++){
								$flag_redirects[] = '/responses/view/'.$challenge['Challenge']['id'].'/'.$r[2].'?ajax=1&highlight='.$f['WordFlag']['word'].'&pos='.($i + 1).'&comment_id='.$r[0];
								$flag_types[] = ($f['WordFlag']['flag_type'] == 'WORD' ? 'Word Overuse' : ($f['WordFlag']['flag_type'] == 'EXPL' ? 'Explicit Language' : 'Phrase Flag'));
							}
						}
					}
				}
			}
		}
		
		if($type == 'MAX' || $type == 'all'){
			foreach($challenge['Question'] as $q){
				if(!@$q['Response'][0]) continue;
				
				$r = $q['Response'][0];
				if(str_word_count($r['response_body']) > $challenge['Challenge']['max_response_length'] && $challenge['Challenge']['max_response_length']){
					$flag_redirects[] = '/responses/view/'.$challenge['Challenge']['id'].'/'.$user_id.'?ajax=1';
					$flag_types[] = 'Assignment Maximum';
				}
			}
		}
		
		$this->set('challenge_id',$challenge_id);
		$this->set('flag_types',$flag_types);
		$this->set('flag_redirects',$flag_redirects);
		$this->set('username',$this->User->field('concat_ws(" ",User.firstname,User.lastname)',array('User.id'=>$user_id)));
		
		$this->set('next_user',@$_REQUEST['next_user'] ? '/word_flags/browse/' . $_REQUEST['next_user'] . '/' . $challenge_id : '');
		$this->set('prev_user',@$_REQUEST['prev_user'] ? '/word_flags/browse/' . $_REQUEST['prev_user'] . '/' . $challenge_id : '');
	}
}
?>