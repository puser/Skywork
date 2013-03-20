<?php
class GradesController extends AppController{
	var $name = 'Grades';
	var $uses = array('Grades');

	function update($challenge_id,$user_id){
		$this->checkAuth();
		
	}
	
	function challenge_summary($challenge_id){
		$this->checkAuth();
		
	}
	
	function view($challenge_id){
		$this->checkAuth();
		
	}
}