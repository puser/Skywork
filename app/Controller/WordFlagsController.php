<?php
class WordFlagsController extends AppController {
	var $name = 'WordFlags';
	var $uses = array('WordFlag','User','Challenge');
	
	function view($type='WORD'){
		$this->layout = 'ajax';
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.flag_type = "'.$type.'" && WordFlag.user_id = '.$_SESSION['User']['id'])));
		$this->set('type',$type);
	}
	
	function update($word=NULL,$count=NULL,$type='WORD'){
		$this->layout = 'ajax';
		if(@$_REQUEST['type']) $type = $_REQUEST['type'];
		
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.flag_type = "'.$type.'" && WordFlag.user_id = '.$_SESSION['User']['id'])));
		$this->set('type',$type);
		
		if($word && $count){
			$this->WordFlag->save(array('flag_type'=>$type,'word'=>$word,'count'=>$count,'user_id'=>$_SESSION['User']['id']));
			if(@$_REQUEST['addnew']) $this->redirect('/word_flags/update/?type=' . $type);
			else $this->redirect('/word_flags/view/' . $type);
		}elseif($word){
			$this->set('count',$this->WordFlag->field('count',array('flag_type'=>$type,'word'=>$word,'user_id'=>$_SESSION['User']['id'])));
			$this->set('word',$word);
		}
	}
	
	function browse($user_id,$challenge_id,$type='all'){
		$this->checkAuth();
		$this->Challenge->Question->hasMany['Response']['conditions'] = 'Response.user_id = ' . $user_id;
		$challenge = $this->Challenge->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id),'recursive'=>2));
		
		// find all matches for flags of specified type(s); prepare redirect schedule
		if($type == 'WORD' || $type == 'PHRASE' || $type == 'EXPL' || $type == 'all'){
			$conditions = 'WordFlag.user_id = '.$_SESSION['User']['id'];
			if($type != 'all') $conditions .= ' && WordFlag.flag_type = "' . $type . '"';
			$flags = $this->WordFlag->find('all',array('conditions'=>$conditions));
			
			$word_counts = array();
			$flagged_words = array();
			$flagged_comments = array();
			$flag_redirects = array();
			$flag_types = array();
			foreach($challenge['Question'] as $q){
				$r = $q['Response'][0];
				foreach($flags as $f){
					if(strstr($r['response_body'],$f['WordFlag']['word']) !== false){
						@$flagged_words[$f['WordFlag']['word']][] = array($r['id'],$r['question_id'],$r['user_id'],substr_count($r['response_body'],$f['WordFlag']['word']));
						$word_counts[$f['WordFlag']['word']] += substr_count($r['response_body'],$f['WordFlag']['word']);
					}
				}	
				//foreach($r['Comment'] as $c) @$user_text[$r['User']['id']] .= ' ' . $c['comment'];
			}
			
			foreach($flags as $f){
				if(@$flagged_words[$f['WordFlag']['word']]){
					if($word_counts[$f['WordFlag']['word']] < $f['WordFlag']['count']) unset($flagged_words[$f['WordFlag']['word']]);
					else{
						foreach($flagged_words[$f['WordFlag']['word']] as $k=>$r){ 
							for($i = 0;$i < $r[3];$i++){
								$flag_redirects[] = '/responses/view/'.$challenge['Challenge']['id'].'/'.$r[2].'?ajax=1&highlight='.$f['WordFlag']['word'].'&pos='.($i + 1).'&response_id='.$r[0];
								$flag_types[] = ($f['WordFlag']['flag_type'] == 'WORD' ? 'Word Overuse' : ($f['WordFlag']['flag_type'] == 'EXPL' ? 'Explicit Language' : 'Phrase Flag'));
							}
						}
					}
				}
			}
		}
		
		if($type == 'count' || $type == 'all'){
			/* -- */
		}
		
		$this->set('challenge_id',$challenge_id);
		$this->set('flag_types',$flag_types);
		$this->set('flag_redirects',$flag_redirects);
		$this->set('username',$this->User->field('concat_ws(" ",User.firstname,User.lastname)',array('User.id'=>$user_id)));
	}
}
?>