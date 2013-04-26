<?php
class CommentsController extends AppController{
	var $name = 'Comments';
	
	function save($r_id = NULL,$all = false){
		$this->checkAuth(@$_REQUEST['ajax'] ? true : false);
		if(@$_SERVER['REQUEST_METHOD'] == 'GET'){
			// return json object with existing comments
			$conditions = array('Response.id' => $r_id);
			if(!$all) $conditions['User.id'] = $_SESSION['User']['id'];
			$comments = $this->Comment->find('all',array('conditions'=>$conditions));
			$json = array();
			foreach($comments as $c){
				$json[] = array(	'id'			=> $c['Comment']['id'],
													'text'		=> $c['Comment']['comment'],
													'user_id'	=> $c['User']['id'],
													'ranges'	=> array(array(	'start'				=> $c['Comment']['segment_start'],
																										'startOffset'	=> $c['Comment']['start_offset'],
																										'end'					=> $c['Comment']['segment_length'],
																										'endOffset'		=> $c['Comment']['length_offset'] )));
			}
			
			die(str_replace("\/","/",json_encode($json)));
		}elseif(@$_SERVER['REQUEST_METHOD'] == 'DELETE'){
			// delete comment
			$comment = json_decode(file_get_contents('php://input'));
			$this->Comment->delete($comment->id);
			die();
		}else{
			// save comment data
			$comment = json_decode(file_get_contents('php://input'));
			
			$c = array();
			$c['comment'] = $comment->text;
			$c['segment_start'] = $comment->ranges[0]->start;
			$c['start_offset'] = $comment->ranges[0]->startOffset;
			$c['segment_length'] = $comment->ranges[0]->end;
			$c['length_offset'] = $comment->ranges[0]->endOffset;
			$c['response_id'] = $comment->response_id;
			$c['user_id'] = $_SESSION['User']['id'];
			$c['type'] = $comment->type;
			
			$this->Comment->save($c);
			$comment->id = $this->Comment->id;
			die(str_replace("\/","/",json_encode($comment)));
		}
		
		$_REQUEST['comment']['user_id'] = $_SESSION['User']['id'];
		$this->Comment->save($_REQUEST['comment']);
		die($this->Comment->id);
	}
	
	function delete($id){
		$this->checkAuth();
		$this->Comment->delete($id);
		die();
	}
}
?>


