<?php
class CommentsController extends AppController{
	var $name = 'Comments';
	
	function save(){
		$this->checkAuth(@$_REQUEST['ajax'] ? true : false);
		
		if(@$_SERVER['REQUEST_METHOD'] == 'GET'){
			// return json object with existing comments
			die();
		}else{
			// save comment data
			$comment = json_decode(file_get_contents('php://input'));
			
			$c['comment'] = $comment->text;
			$c['segment_start'] = $comment->ranges[0]->startOffset;
			$c['segment_length'] = $comment->ranges[0]->endOffset;
			$c['response_id'] = $comment->response_id;
			$c['user_id'] = $_SESSION['User']['id'];
			$c['type'] = $comment->type;
			
			die(print_r($comment));
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
