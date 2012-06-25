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
									'dependent'	=> true ));
	var $hasAndBelongsToMany = array(	'Class' =>
										array(	'className'	=> 'Class',
												'joinTable'	=> 'users_classes',
												'foreignKey'=> 'user_id',
												'associationForeignKey' => 'class_id',
												'unique'	=> true ));
}
?>