<?php
class User extends AppModel{
	var $name = 'User';
	var $primaryKey = 'id';
	
	var $hasMany = array(	'Challenge' =>
												array(	'className'	=> 'Challenge',
																'foreignKey'=> 'user_id',
																'dependent' => false ),
												'Attachment' =>
												array(	'className'	=> 'Attachment',
																'foreignKey'=> 'user_id',
																'dependent'	=> false ),
												'Status' =>
												array(	'className'	=> 'Status',
																'foreignKey'=> 'user_id',
																'dependent'	=> true ),
												'Response' =>
												array(	'className'	=> 'Response',
																'foreignKey'=> 'user_id',
																'dependent'	=> true ),
												'Comment' =>
												array(	'className'	=> 'Comment',
																'foreignKey'=> 'user_id',
																'dependent'	=> true ));
																
	var $hasAndBelongsToMany = array(	'ClassSet' =>
																		array(	'className'	=> 'ClassSet',
																						'joinTable'	=> 'users_classes',
																						'foreignKey'=> 'user_id',
																						'associationForeignKey' => 'class_id',
																						'unique'	=> true ),
																		'Group' =>
																		array(	'className'	=> 'Group',
																						'joinTable'	=> 'users_groups',
																						'foreignKey'=> 'user_id',
																						'associationForeignKey' => 'group_id',
																						'unique'		=> false ));
}
?>