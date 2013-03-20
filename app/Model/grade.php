<?php
class Grade extends AppModel{
	var $name = 'Grade';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'User' =>
													array(	'className' => 'User',
																	'foreignKey'=> 'user_id' ),
													'Challenge' =>
													array(	'className'	=> 'Challenge',
																	'foreignKey'=> 'challenge_id' ));
}
?>