<?php
class ClassSet extends AppModel{
	var $name = 'Class';
	var $primaryKey = 'id';
	var $useTable = 'classes';
	
	var $belongsTo = array(	'Owner' =>
														array(	'className'	=> 'User',
																		'foreignKey'=> 'owner_id' ));
										
	var $hasAndBelongsToMany = array(	'User' =>
																		array(	'className' => 'User',
																						'joinTable'	=> 'users_classes',
																						'foreignKey'=> 'class_id',
																						'associationForeignKey'=> 'user_id',
																						'unique'	=> true ),
																		'Challenge'	=>
																		array(	'className'	=> 'Challenge',
																						'joinTable'	=> 'challenges_classes',
																						'foreignKey'=> 'class_id',
																						'associationForeignKey'=> 'challenge_id',
																						'unique'	=> true ));
}
?>