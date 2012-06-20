<?php
class Group extends AppModel{
	var $name = 'Group';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Owner' =>
							array(	'className'	=> 'User',
									'foreignKey'=> 'owner_id' ));
										
	var $hasAndBelongsToMany = array(	'User' =>
										array(	'className' => 'User',
												'joinTable'	=> 'users_groups',
												'foreignKey'=> 'group_id',
												'associationForeignKey'=> 'user_id',
												'unique'	=> true ),
										'Challenge'	=>
										array(	'className'	=> 'Challenge',
												'joinTable'	=> 'challenges_groups',
												'foreignKey'=> 'group_id',
												'associationForeignKey'=> 'challenge_id',
												'unique'	=> true ));
}
?>