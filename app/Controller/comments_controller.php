<?php
class CommentsController extends AppController{
	var $name = 'Comments';
	
	function save(){
		$this->checkAuth(@$_REQUEST['ajax'] ? true : false);
		
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
