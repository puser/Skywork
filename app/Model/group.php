<?php
class Group extends AppModel{
	var $name = 'Group';
	var $primaryKey = 'id';

	var $hasAndBelongsToMany = array(
										'User' => array(
											'className'	=> 'User',
											'joinTable'	=> 'users_groups',
											'foreignKey'=> 'group_id',
											'associationForeignKey' => 'user_id' ));
}
?>