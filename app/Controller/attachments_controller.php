<?php
class AttachmentsController extends AppController{
	var $name = 'Attachments';
	
	function view($id,$challenge_id=NULL){
		$this->checkAuth();
		if($id == 'case' && $challenge_id) $attachment = $this->Attachment->find('first',array('conditions'=>array('Challenge.id'=>$challenge_id,'Attachment.type'=>'C')));
		else $attachment = $this->Attachment->findById($id);
		$this->set('attachment',$attachment);
	}
	
	function update($challenge_id=NULL){
		$this->checkAuth(true);
		$this->layout = 'ajax';
		
		if($challenge_id == 'save'){
			if(@$_FILES['attachment']){
				foreach($_FILES['attachment']['name'] as $k=>$n){
					if(!$_FILES['attachment']['tmp_name'][$k]) continue;
					$filename = md5(uniqid(rand())).strrchr($n,'.');
					if(!move_uploaded_file($_FILES['attachment']['tmp_name'][$k],$_SERVER['DOCUMENT_ROOT'].'/dev/app/webroot/uploads/'.$filename)){
						print_r($_FILES);
						die("<br>Upload error<br>");
					}
					$attachments[] = array(	'challenge_id'	=> @$_REQUEST['attachment'][$k]['challenge_id'],
											'user_id'		=> $_SESSION['User']['id'],
											'file_location'	=> $filename,
											'name'			=> @$_REQUEST['attachment'][$k]['name'],
											'type'			=> @$_REQUEST['attachment'][$k]['type'] );
				}
				if(@$attachments) $this->Attachment->saveAll($attachments);
				
			}
		
			// delete files
			if(@$_REQUEST['remove_attachment']){
				foreach($_REQUEST['remove_attachment'] as $aid) $this->Attachment->delete($aid);
			}
		
			$this->redirect('/challenges/view/'.$_REQUEST['challenge_id']);
			return true;
			
		}
		
		$attachments = $this->Attachment->find('all',array(	'conditions'=> array(	'Attachment.challenge_id'	=> $challenge_id,
																					'Attachment.user_id'		=> $_SESSION['User']['id'],
																					'Attachment.type'			=> 'R' ),
															'order'		=> "Attachment.name" ));
		$this->set('attachments',$attachments);
		$this->set('challenge_id',$challenge_id);
	}
}
?>