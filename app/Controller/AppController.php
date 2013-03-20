<?php
class AppController extends Controller{
	var $salt = '3908123BAA90E1FF2C';
	
	public function beforeFilter() {
		Configure::write('Config.language', @$this->Session->read('User.language') ? $this->Session->read('User.language') : 'eng');
  }
	
	function checkAuth($ajax = false){
		if(@$_SERVER['HTTPS'] != 'on' && !(stristr($_SERVER['SERVER_NAME'],'edge') || stristr($_SERVER['SERVER_NAME'],'staging'))){
			header('Location: https://www.puentesonline.com' . $_SERVER['REQUEST_URI']);
			exit();
		}
		
		if(!$this->Session->check('User')){
			if($ajax) header('Location: /users/session_logout/');
			else header('Location: /login/');
			exit();
		}
	}
}
?>