<?php
class CommentLibrary extends AppModel{
	var $name = 'CommentLibrary';
	var $useTable = 'comment_libraries';
	var $primaryKey = 'id';
	
	var $hasMany = array(	'Comment' =>
												array(	'className'	=> 'LibraryComment',
																'foreignKey'=> 'library_id',
																'dependent'	=> true ));
	
	var $belongsTo = array(	'Owner' =>
													array(	'className'	=> 'User',
																	'foreignKey'=> 'owner_id' ));
																	
	var $hasAndBelongsToMany = array(	'LibUser' =>
																		array(	'className'	=> 'User',
																						'joinTable'	=> 'comment_libraries_users',
																						'foreignKey'=> 'library_id',
																						'associationForeignKey' => 'user_id',
																						'unique'		=> true ));
}
?>