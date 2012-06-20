<?php
class Response extends AppModel{
	var $name = 'Response';
	var $useTable = 'challenge_responses';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Question' =>
							array(	'className'	=> 'Question',
									'foreignKey'=> 'question_id' ),
							//'Response' =>
							//array(	'className'	=> 'Response',
							//		'foreignKey'=> 'response_id' ),
							'User' =>
							array(	'className'	=> 'User',
									'foreignKey'=> 'user_id' ));
	
	var $hasMany = array(	'Responses' =>
							array(	'className'	=> 'Response',
									'foreignKey'=> 'response_id' ));
}

?>