<?php
class AppController extends Controller{
	var $salt = '3908123BAA90E1FF2C';
	
	public function beforeFilter() {
		Configure::write('Config.language', @$this->Session->read('User.language') ? $this->Session->read('User.language') : 'eng');
  }
	
	function checkAuth($ajax = false){
		if(!(stristr($_SERVER['SERVER_NAME'],'edge') || stristr($_SERVER['SERVER_NAME'],'staging')) && stristr($_SERVER['SERVER_NAME'],'puentes')){
			header('Location: http://doskywork.com' . $_SERVER['REQUEST_URI']);
			exit();
		}
		
		if(@$_SERVER['HTTPS'] != 'on' && !(stristr($_SERVER['SERVER_NAME'],'edge') || stristr($_SERVER['SERVER_NAME'],'staging')) && stristr($_SERVER['HTTP_HOST'],'puentes')){
			header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
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