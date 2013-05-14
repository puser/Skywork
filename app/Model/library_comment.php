<?php
class LibraryComment extends AppModel{
	var $name = 'LibraryComment';
	var $useTable = 'comment_library_comments';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'CommentLibrary' =>
													array(	'className'	=> 'CommentLibrary',
																	'foreignKey'=> 'library_id' ));
}
?>