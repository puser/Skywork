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
																						'unique'		=> true ),
																		'Group' =>
																		array(	'className'	=> 'Group',
																						'joinTable'	=> 'users_groups',
																						'foreignKey'=> 'user_id',
																						'associationForeignKey' => 'group_id',
																						'unique'		=> false ),
																		'Bridges' =>
																		array(	'className'	=> 'Challenge',
																						'joinTable'	=> 'challenges_collaborators',
																						'foreignKey'=> 'user_id',
																						'associationForeignKey' => 'challenge_id',
																						'unique'		=> true ));
																						
	public function afterFind($results, $primary = false){
		if(isset($results['firstname'])) $results['firstname'] = $results['firstname'] || $results['lastname'] ? $results['firstname'] : $results['email'];
		else{
			foreach($results as $k => $v){
				if(@isset($results[$k]['User']['firstname'])) $results[$k]['User']['firstname'] = $v['User']['firstname'] || $v['User']['lastname'] ? $v['User']['firstname'] : $v['User']['email'];
				elseif(@isset($results[$k]['firstname'])) $results[$k]['firstname'] = $v['firstname'] || $v['lastname'] ? $v['firstname'] : @$v['email'];
			}
		}
		return $results;
	}
}
?>