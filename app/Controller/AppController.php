<?php
class AppController extends Controller{
	var $salt = '3908123BAA90E1FF2C';
	
	function checkAuth($ajax = false){
		if(!$this->Session->check('User')){
			if($ajax) header('Location: /users/session_logout/');
			else header('Location: /login/');
			exit();
		}
	}
}
?>