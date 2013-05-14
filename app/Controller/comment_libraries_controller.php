<?php
class CommentLibrariesController extends AppController{
	var $name = 'CommentLibraries';
	var $uses = array('CommentLibrary','LibraryComment','User');
	
	function browse(){
		$this->checkAuth();
		
		$this->User->Behaviors->attach('Containable');
		$user = $this->User->find('first',array('contain'=>array('CommentLibrary'=>array('LibUser')),'conditions'=>'User.id = ' . $_SESSION['User']['id']));
		
		foreach($user['CommentLibrary'] as $k=>$l){
			$user['CommentLibrary'][$k]['active'] = 0;
			foreach($l['LibUser'] as $u){
				if($u['CommentLibrariesUser']['active'] && $u['CommentLibrariesUser']['user_id'] == $_SESSION['User']['id']) $user['CommentLibrary'][$k]['active'] = 1;
			}
		}
		$this->set('user',$user);
	}
	
	function update($id=NULL){
		$this->checkAuth();
		if($id){
			$this->set('library',$this->CommentLibrary->find('first',array('conditions'=>array('CommentLibrary.id'=>$id))));
			$this->set('active',$this->CommentLibrary->CommentLibrariesUser->field('active',array('CommentLibrariesUser.library_id'=>$id,'CommentLibrariesUser.user_id'=>$_SESSION['User']['id'])));
			$this->render('update','ajax');
		}else{
			$comments = @$_REQUEST['library']['LibraryComment'];
			unset($_REQUEST['library']['LibraryComment']);
			
			if(@$_REQUEST['library']) $this->CommentLibrary->save($_REQUEST['library']['CommentLibrary']);
			
			if($comments){
				$new_comments = array();
				$this->LibraryComment->deleteAll(array('LibraryComment.library_id'=>$this->CommentLibrary->id));
				foreach($comments as $k=>$c){
					if($c['comment']) $new_comments[$k] = array('library_id' => $this->CommentLibrary->id,'comment' => $c['comment']);
				}
				$this->LibraryComment->saveAll($new_comments);
			}
			
			if(isset($_REQUEST['sharing'])){
				$sharing = explode(',',$_REQUEST['sharing']);
				
				if($sharing){
					$u = array($_SESSION['User']['id']);
					foreach($sharing as $email){
						$uid = $this->User->field('User.id',array('User.login' => trim($email)));
						if($uid) $u[] = $uid;
					}
					unset($_REQUEST['sharing']);
					$this->CommentLibrary->save(array('CommentLibrary'=>$_REQUEST,'LibUser'=>$u));
				}
				
				if(isset($_REQUEST['user_active'])){
					$this->User->CommentLibrariesUser->updateAll(array('active'=>$_REQUEST['user_active']),array('library_id' => $this->CommentLibrary->id,'user_id' => $_SESSION['User']['id']));
				}
				
				$this->redirect('/comment_libraries/browse/');
			}else die($this->CommentLibrary->id);
		}
	}
	
	function clone_lib($id){
		$this->checkAuth();
		$library = $this->CommentLibrary->findById($id);
		unset($library['CommentLibrary']['id']);
		$library['CommentLibrary']['name'] .= ' (Copy)';
		$this->CommentLibrary->save($library);
		$this->redirect('/comment_libraries/browse/');
	}
	
	function delete($id){
		$this->checkAuth();
		$this->User->query('delete from comment_libraries where id = '.$id);
		$this->User->query('delete from comment_libraries_users where library_id = '.$id);
		$this->User->query('delete from comment_library_comments where library_id = '.$id);
		//$this->CommentLibrary->delete($id);
		$this->redirect('/comment_libraries/browse/');
	}
}
?>