<?php
class WordFlagsController extends AppController {
	var $name = 'WordFlags';
	
	function view(){
		$this->layout = 'ajax';
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.user_id = '.$_SESSION['User']['id'])));
	}
	
	function update($word=NULL,$count=NULL){
		$this->layout = 'ajax';
		$this->set('words',$this->WordFlag->find('all',array('conditions'=>'WordFlag.user_id = '.$_SESSION['User']['id'])));
		
		if($word && $count){
			$this->WordFlag->save(array('word'=>$word,'count'=>$count,'user_id'=>$_SESSION['User']['id']));
			$this->redirect('/word_flags/view/');
		}elseif($word){
			$this->set('count',$this->WordFlag->field('count',array('word'=>$word,'user_id'=>$_SESSION['User']['id'])));
			$this->set('word',$word);
		}
	}
}
?>