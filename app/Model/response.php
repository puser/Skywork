<?php
class Response extends AppModel{
	var $name = 'Response';
	var $useTable = 'challenge_responses';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Question' =>
													array(	'className'	=> 'Question',
																	'foreignKey'=> 'question_id' ),
													'User' =>
													array(	'className'	=> 'User',
																	'foreignKey'=> 'user_id' ));
	
	var $hasMany = array(	'ResponseComment' =>
												array(	'className'	=> 'ResponseComment',
																'foreignKey'=> 'response_id',
																'dependent'	=> true ));
}
?>