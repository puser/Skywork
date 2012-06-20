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
	var $hasAndBelongsToMany = array(	'Group' =>
										array(	'className'	=> 'Group',
												'joinTable'	=> 'users_groups',
												'foreignKey'=> 'user_id',
												'associationForeignKey' => 'group_id',
												'unique'	=> true ));
}
?>