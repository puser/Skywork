<?php
class Comment extends AppModel{
	var $name = 'Comment';
	var $useTable = 'response_comments';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Question' =>
													array(	'className'	=> 'Question',
																	'foreignKey'=> 'question_id' ),
													'User' =>
													array(	'className'	=> 'User',
																	'foreignKey'=> 'user_id' ));
}
?>