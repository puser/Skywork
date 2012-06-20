<?php
class Attachment extends AppModel{
	var $name = 'Attachment';
	var $primaryKey = 'id';
	
	var $belongsTo = array(	'Challenge' =>
							array(	'className' => 'Challenge',
									'foreignKey'=> 'challenge_id' ));
}
?>