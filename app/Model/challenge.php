<?php
class Challenge extends AppModel{
	var $name = 'Challenge';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'User' =>
							array(	'className' => 'User',
									'foreignKey'=> 'user_id' ));
									
	var $hasMany = array(	'Question' =>
							array(	'className'	=> 'Question',
									'foreignKey'=> 'challenge_id',
									'order'		=> 'Question.id',
									'dependent'	=> true ),
							'Attachment' =>
							array(	'className'	=> 'Attachment',
									'foreignKey'=> 'challenge_id',
									'order'		=> 'Attachment.type DESC,Attachment.name',
									'dependent'	=> true ),
							'Status' =>
							array(	'className'	=> 'Status',
									'foreignKey'=> 'challenge_id',
									'dependent'	=> true ));
									
	var $hasAndBelongsToMany = array(	'Group'	=>
										array(	'className'	=> 'Group',
												'joinTable'	=> 'challenges_groups',
												'foreignKey'=> 'challenge_id',
												'associationForeignKey'=> 'group_id',
												'unique'	=> true ));
}
?>