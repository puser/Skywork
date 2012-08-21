<?php
class AppController extends Controller{
	var $salt = '3908123BAA90E1FF2C';
	
	public function beforeFilter() {
		Configure::write('Config.language', @$this->Session->read('User.language') ? $this->Session->read('User.language') : 'eng');
  }
	
	function checkAuth($ajax = false){
		if(!$this->Session->check('User')){
			if($ajax) header('Location: /users/session_logout/');
			else header('Location: /login/');
			exit();
		}
	}
}
?>