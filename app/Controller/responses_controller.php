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
												'Question' 	=> array('Response'	=> array(	'conditions'	=> "Response.user_id = " . ($user_id && $user_id != 'complete_eval' ? $user_id : $_SESSION['User']['id']),
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
		}elseif($user_id == 'complete_eval') $this->set('complete_eval',true);
		
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
	
	function submit_evaluation($challenge_id){
		// send student emails
		$challenge = $this->Challenge->find('first',array('conditions'=>'Challenge.id = {$challenge_id}','recursive'=>2));
		foreach($challenge['ClassSet'] as $g){
			foreach($g['User'] as $u){
				if(@$sent_users[$u['id']]) continue;
				else $sent_users[$u['id']] = 1;
			
				$message = __("{firstname},\n\nYour instructor has completed evaluation of your assignment, {bridge_name}, and it is ready for your viewing!\n\nClick here to check it out:\nhttp://puentesonline.com/\n\nSincerely,\nThe Puentes Team");
				$message = str_replace('{firstname}',$u['firstname'],$message);
				$message = str_replace('{bridge_name}',$challenge['Challenge']['name'],$message);

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Puentes <noreply@puentesonline.com>' . "\r\n";
				
				mail("{$u['firstname']} {$u['lastname']} <{$u['email']}>",'Your Assignment is Ready for Viewing',nl2br($message),$headers);
			}
		}
		
		// set eval_complete on challenge record
		$this->Challenge->id = $challenge_id;
		$this->Challenge->saveField('eval_complete','1');
		
		$this->redirect('/dashboard/');
	}
}
?>