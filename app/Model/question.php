<?php
class Question extends AppModel{
	var $name = 'Question';
	var $useTable = 'challenge_questions';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Challenge' =>
							array(	'className'	=> 'Challenge',
									'foreignKey'=> 'challenge_id' ));
	
	var $hasMany = array(	'Response' =>
							array(	'className'	=> 'Response',
									'foreignKey'=> 'question_id',
									'dependent'	=> true ));
}
?>