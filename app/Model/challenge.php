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
																'dependent'	=> true ),
												'Group' =>
												array(	'className'	=> 'Group',
																'foreignKey'=> 'challenge_id',
																'dependent'	=> true ));
									
	var $hasAndBelongsToMany = array(	'ClassSet'	=>
																		array(	'className'	=> 'ClassSet',
																						'joinTable'	=> 'challenges_classes',
																						'foreignKey'=> 'challenge_id',
																						'associationForeignKey'=> 'class_id',
																						'unique'		=> true ),
																		'Collaborator'	=>
																		array(	'className'	=> 'User',
																						'joinTable'	=> 'challenges_collaborators',
																						'foreignKey'=>	'challenge_id',
																						'associationForeignKey'=> 'user_id',
																						'unique'		=> true));
}
?>