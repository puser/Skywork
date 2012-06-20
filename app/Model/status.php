<?php
class Status extends AppModel{
	var $name = 'Status';
	var $useTable = 'user_invite_statuses';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'User'	=> 
							array(	'className'	=> 'User',
									'foreignKey'=> 'user_id' ),
							'Challenge' =>
							array(	'className'	=> 'Challenge',
									'foreignKey'=> 'challenge_id' ),
							'Group' =>
							array(	'className'	=> 'Group',
									'foreignKey'=> 'group_id' ));
}
?>