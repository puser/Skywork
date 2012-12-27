<?php
class UsersController extends AppController{
	var $name = 'Users';
	var $uses = array('User','ClassSet','Status','State', 'Country');

	// view account settings
	function view($show=NULL,$saved=false){
		$this->checkAuth();
		
		if(@$_REQUEST['sort']=='name') $sort = 'ClassSet.group_name';
		elseif(@$_REQUEST['sort']=='created') $sort = 'ClassSet.date_created';
		elseif(@$_REQUEST['sort']=='modified') $sort = 'ClassSet.date_created';
		elseif(@$_REQUEST['sort']=='owner') $sort = 'ClassSet.owner_id';
		else $sort = 'ClassSet.group_name';
		
		if(@$_REQUEST['dir']=='a') $sort .= ' DESC';
		else $sort .= ' ASC';
		$this->User->hasAndBelongsToMany['ClassSet']['order'] = $sort;
		
		$user = $this->User->find('first',array('conditions'=>"User.id = {$_SESSION['User']['id']}"));
		$class_ids = '';
		foreach($user['ClassSet'] as $c) $class_ids .= ($class_ids ? ',' : '') . $c['id'];

		if($show == 'classes' || $show == 'connections'){
			$this->ClassSet->Behaviors->attach('Containable');
			$user['ClassSet'] = $class_ids ? $this->ClassSet->find('all',array('conditions'=>"ClassSet.id IN($class_ids)","order"=>$sort,'contain'=>array('User'=>array('conditions'=>'User.user_type = "P"'),'Owner'))) : array();
			$this->set('user',$user);
		
			$current_groups = $requested_groups = $pending_groups = array();
			$pending_invites = $this->Status->find('all',array('conditions'=>array('Status.challenge_id IS NULL','Status.status'=>'P','Status.user_id'=>$_SESSION['User']['id'])));
			foreach($pending_invites as $i){
				if($i['Status']['class_id']) $pending_groups[] = $i['Status']['class_id'];
			}
			if($pending_groups){
				$this->set('invites',$this->ClassSet->find('all',array('conditions'=>'ClassSet.id IN ('.implode(',',$pending_groups).')','recursive'=>2)));
			}
			
			$this->Status->belongsTo['Class']['conditions'] = "Class.owner_id = {$_SESSION['User']['id']}";
			$pending_requests = $this->Status->find('all',array('conditions'=>array('Status.challenge_id IS NULL','Status.status'=>"R")));
			foreach($pending_requests as $r){
				if($r['Class']['id']) $requested_groups[] = $r['Class']['id'];
			}
			
			if($class_ids) $conditions = array('ClassSet.id NOT IN ('.$class_ids.')');
			else $conditions = array();
				
			$this->set('saved',$saved);
			$this->set('requested_groups',$requested_groups);
			$this->set('pending_groups',$pending_groups);
			$this->set('connections',($show == 'connections' ? 1 : 0));
			$this->set('groups',$this->ClassSet->find('all',array('conditions'=>$conditions)));
			$this->render('view_classes');
		}elseif($show == 'payments'){
			$this->set('user',$user);
			$this->render('view_payments');
		}else{
			$this->set('user',$user);
			$this->set('states',$this->State->find('all'));
			$this->set('countries',$this->Country->find('all'));
		}
	}
	
	// save updated account settings
	function update(){
		$this->checkAuth();
		
		if($_REQUEST['new_pass1']){
			if($_REQUEST['new_pass1']==$_REQUEST['new_pass2']){
				$_REQUEST['password'] = sha1($_REQUEST['new_pass1'].$this->salt);
				unset($_REQUEST['new_pass1'],$_REQUEST['new_pass2']);
			}
		}
		
		if(!@$_REQUEST['search_visible']) $_REQUEST['search_visible'] = 0;

		if($_REQUEST['country'] == 'US'){
			$_REQUEST['state'] = $_REQUEST['US_state'];
		}elseif($_REQUEST['country'] != 'US'){
			$_REQUEST['state'] = $_REQUEST['other_state'];
		}

		$this->User->save($_REQUEST);

		if($_REQUEST['firstname']){
			$_SESSION['User']['firstname'] = $_REQUEST['firstname'];
			$_SESSION['User']['lastname'] = $_REQUEST['lastname'];
		}
		if($_REQUEST['language']) $_SESSION['User']['language'] = $_REQUEST['language'];

		$this->redirect('/users/view/');
	}
	
	// terminate account (self)
	function delete(){
		$this->checkAuth();
		$this->User->delete($_SESSION['User']['id']);
		$this->Session->delete('User');
		$this->redirect('/');
	}
	
	function invite_collaborator($id){
		$this->layout = 'ajax';
		$this->set('id',$id);
	}
	
	// send an email invitation
	function invite($class_id,$user_id=NULL,$fname=NULL,$lname=NULL,$email=NULL,$type=NULL,$permissions=NULL){
		$this->checkAuth();
		$invite_token = $tmp_password = NULL;
		$send_invite = true;
		$class = $this->ClassSet->findById($class_id);
		
		// check for existing user. if new user, create user record
		if(!$user_id){
			$user = $this->User->findByEmail($email);
			if(!$user || !$email){
				// $invite_token = sha1(time().$this->salt);
				$tmp_password = substr(sha1(time().rand(1000,10000)),0,5);
				$user = array(	'User' =>
												array(	'invite_token'=> $invite_token,
																'firstname'		=> ($fname == '0' ? NULL : $fname),
																'lastname'		=> ($lname == '0' ? NULL : $lname),
																'login'				=> $email,
																'email'				=> $email,
																'password'		=> sha1($tmp_password.$this->salt),
																'user_type'		=> $type ));
				$this->User->save($user);
			}elseif($user){
				$this->User->id = $user['User']['id'];
				if(!$user['User']['notify_groups']) $send_invite = false;
			}
		}else{
			$user = $this->User->findById($user_id);
			$this->User->id = $user['User']['id'];
			if(!$user['User']['notify_groups']) $send_invite = false;
		}
		
		// if user is re-invited with a new type, apply the new type to their record
		if(@$user['User']['id'] && $type && $type != $user['User']['user_type']) $this->User->updateAll(array('User.user_type' => "'".$type."'"),array('User.id' => $user['User']['id']));
		
		// check for existing invite status
		$status = array();
		if($user_id) $status = $this->Status->find('first',array('conditions'=>array('Status.user_id'=>$user_id,'Status.class_id'=>$class_id,'Status.challenge_id IS NULL')));
		if(!$status){
			// create status
			$status = array('Status' =>
											array(	'user_id'			=> $this->User->id,
															'class_id'		=> $class_id,
															'permissions'	=> $permissions,
															'status'			=> 'C' ));
			$this->Status->save($status);
		}
		
		// add user to the class
		$user_update = array('User'=>array('id'=>$this->User->id));
		$user_update['ClassSet'] = array($class_id);
		if(@$user['ClassSet']){
			foreach($user['ClassSet'] as $g) if(array_search($g['id'],$user_update['ClassSet']) === false) $user_update['ClassSet'][] = $g['id'];
		}
		$this->User->save($user_update);
		
		// build invite url & message body
		$invite_url = 'http://puentesonline.com/users/accept_invitation/0/'.$class_id.'/'.$this->User->id.'/'.$invite_token;
		
		if($send_invite){
			if(!$tmp_password) $message = __("Hi {first_name_1}!\n\n Your instructor, {first_name_2} {last_name_2}, has added you to {classname} on Puentes Online - the world's first feedback learning system.\n\n{begin_link}Sign in now!{end_link}\n\nSincerely,\n\nThe Puentes Team");
			else $message = __("Hi {first_name_1}!\n\n Your instructor, {first_name_2} {last_name_2}, has added you to {classname} on Puentes Online - the world's first feedback learning system.\n\nYour username is your email: <b>{user_email}</b>\nYour temporary password is: <b>{password}</b>\n\n{begin_link}Sign in now!{end_link}\n\nSincerely,\n\nThe Puentes Team");
			$message = str_replace('{first_name_1}',$user['User']['firstname'],$message);
			$message = str_replace('{first_name_2}',$class['Owner']['firstname'],$message);
			$message = str_replace('{last_name_2}',$class['Owner']['lastname'],$message);
			$message = str_replace('{classname}',$class['ClassSet']['group_name'],$message);
			$message = str_replace('{user_email}',$user['User']['login'],$message);
			$message = str_replace('{password}',$tmp_password,$message);
			// $message = str_replace('{begin_link}',"<a href='$invite_url'>",$message);
			$message = str_replace('{begin_link}',"<a href='http://{$_SERVER['HTTP_HOST']}/'>",$message);
			$message = str_replace('{end_link}',"</a>",$message);
		
			$subject = __("{first_name} {last_name} wants you to join their Class");
			$subject = str_replace('{first_name}',$class['Owner']['firstname'],$subject);
			$subject = str_replace('{last_name}',$class['Owner']['lastname'],$subject);
		
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Puentes <noreply@puentesonline.com>' . "\r\n";
	
			// send invite email
			mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>",$subject,nl2br($message),$headers);
		}
		
		die($this->User->id);
	}
	
	// accept an email invitation
	function accept_invitation($challenge_id,$group_id,$user_id,$token=NULL){
		$user = $this->User->findById($user_id);
		if(!$user) $this->render('login_landing');
		$this->set('user',$user);
		$this->set('challenge_id',$challenge_id);
		$this->set('group_id',$group_id);
		if(!@$user['User']['invite_token']) $this->set('force_existing',true);
		if((@$user['User']['invite_token'] && $user['User']['invite_token'] == $token) || !@$user['User']['invite_token']) $this->render('/Pages/home');
		else $this->render('/Pages/home');
	}
	
	// send a "forgot password" email
	function send_password_reset($login){
		$user = $this->User->findByLogin($login);
		if($user){
			$reminder_token = sha1(time().$this->salt);
			
			$message = __("{first_name},\n\nSomeone (probably you), forgot the password on Puentes Online. Click on the link below to create a new password.\n\n{link}\n\nSincerely,\nThe Puentes Team");
			$message = str_replace('{first_name}',$user['User']['firstname'],$message);
			$message = str_replace('{link}',"http://puentesonline.com/users/password_reset/".$reminder_token,$message);
			
			mail("{$user['User']['firstname']} {$user['User']['lastname']} <{$user['User']['email']}>",__("New Password"),$message,'From: Puentes <noreply@puentesonline.com>');
			
			$this->User->id = $user['User']['id'];
			$this->User->saveField('invite_token',$reminder_token);
			echo '1';
			die();
		}else{
			echo '0';
			die();
		}
	}
	
	// reset password
	function password_reset($token=NULL){
		if(!$token) $this->redirect('/');
		$user = $this->User->findByInviteToken($token);
		if(!$user) $this->redirect('/');
		
		if(@$_REQUEST['new_password']){
			$this->User->id = $user['User']['id'];
			$this->User->saveField('invite_token','');
			$this->User->saveField('password',sha1($_REQUEST['new_password'].$this->salt));
			$this->Session->write('User',$user['User']);
			$this->redirect('/dashboard/');
		}else{
			$this->set('reset_password',true);
			$this->set('user',$user);
			$this->render('/Pages/home');
		}
	}
	
	// authenticate
	function login($ajax=false){
		if((@$_REQUEST['betakey'] == 'BETATEST' && @$_REQUEST['user_type'] == 'L') || (@$_REQUEST['betakey'] == 'BETACOLLAB' && @$_REQUEST['user_type'] == 'C')){
			// password verification depreciated for instructors with v1.3 corp site
			// if(!@$_REQUEST['password'] || @$_REQUEST['password'] != @$_REQUEST['password_confirm']) $this->redirect('/login/?signup_error=pass&signup_type='.$_REQUEST['user_type']);
			if(!@$_REQUEST['login'] || $this->User->findByEmail(strtolower($_REQUEST['login']))) die('duplicate');
			
			$new_user = array(	'User' =>
													array(	'email'				=> strtolower($_REQUEST['login']),
																	'login'				=> strtolower($_REQUEST['login']),
																	'user_type'		=> $_REQUEST['betakey'] == 'BETATEST' ? 'L' : 'C',
																	'firstname'		=> '',
																	'lastname'		=> '',
																	'password'		=> sha1($_REQUEST['password'].$this->salt),
																	'last_login'	=> DboSource::expression('NOW()') ));
			
			$user = $this->User->save($new_user);
			if(@$user['User']['id']) $this->Session->write('User',$user['User']);
			else die('There was an error processing your request.');
			
			$this->redirect('/users/view/');
		}elseif(@$_REQUEST['betakey'] && ((@$_REQUEST['betakey'] != 'BETATEST' && @$_REQUEST['user_type'] == 'L') || (@$_REQUEST['betakey'] != 'BETACOLLAB' && @$_REQUEST['user_type'] == 'C'))){
			$this->redirect('/login/?signup_error=key&signup_type='.$_REQUEST['user_type']);
		}elseif(@$_REQUEST['classtoken']){
			$class = $this->ClassSet->findByAuthToken($_REQUEST['classtoken']);
			$instructor = $this->User->findByEmail(@$_REQUEST['instructor_email']);
			if(!@$class['ClassSet']['id'] || @$class['ClassSet']['owner_id'] != $instructor['User']['id']) die('bad_token');
			// password verification depreciated for instructors with v1.3 corp site
			// elseif(!@$_REQUEST['password'] || @$_REQUEST['password'] != @$_REQUEST['password_confirm']) $this->redirect('/login/?signup_error=pass&signup_type='.$_REQUEST['user_type']);
			elseif(!@$_REQUEST['login'] || $this->User->findByEmail(strtolower($_REQUEST['login']))) die('duplicate');
			
			$new_user = array(	'User' =>
													array(	'email'			=> strtolower($_REQUEST['login']),
																	'login'			=> strtolower($_REQUEST['login']),
																	'user_type'	=> $_REQUEST['user_type'],
																	'firstname'	=> '',
																	'lastname'	=> '',
																	'password'	=> sha1($_REQUEST['password'].$this->salt),
																	'last_login'=> DboSource::expression('NOW()') ));
			
			$user = $this->User->save($new_user);
			if(@$user['User']['id']) $this->Session->write('User',$user['User']);
			else die('There was an error processing your request.');
			
			$user_update['ClassSet'] = array($class['ClassSet']['id']);
			$this->User->save($user_update);
			
			$this->redirect('/users/view/');
		}elseif(@$_REQUEST['login']){
			$user = $this->User->findByLogin(strtolower($_REQUEST['login']));
			if(!empty($user['User']['password']) && $user['User']['password'] == sha1($_REQUEST['password'].$this->salt)){
				
				// if user is responding to an invite but already exists with a different email,
				// update all statuses for invited user to match actual user, and delete invited user
				if(@$_REQUEST['user_id'] && @$_REQUEST['user_id'] != $user['User']['id']){
					$this->Status->updateAll(array('Status.user_id' => $user['User']['id']),array('Status.user_id' => $_REQUEST['user_id']));
					$this->User->delete($_REQUEST['user_id']);
				}

				// if users is responding to an invitation for a challenge, automatically add the user to the relevant group
				$user_update = array('User'=>array('id'=>$user['User']['id'],'last_login'=>DboSource::expression('NOW()')));
				
				if(@$_REQUEST['group_id'] && $_REQUEST['challenge_id']){
					$user_update['ClassSet'] = array($_REQUEST['group_id']);
					foreach($user['ClassSet'] as $g) if(array_search($g['id'],$user_update['ClassSet']) === false) $user_update['ClassSet'][] = $g['id'];
				}
				$this->User->save($user_update);
								
				$this->Session->write('User',$user['User']);
				if($ajax){
					echo '1';
					die();
				}
				elseif(@$_REQUEST['group_id'] && !@$_REQUEST['challenge_id']) $this->redirect('/users/view/groups/');
				else $this->redirect('/dashboard/');
			}elseif($ajax){
				echo '0';
				die();
			}else{
				$this->set('error',true);
				$this->redirect('/');
			}
			
		}elseif(@$_REQUEST['token']){
			$user = $this->User->findByInviteToken($_REQUEST['token']);
			if(@$user['User']['invite_token'] == $_REQUEST['token']){
				
				$user_update = array(	'User' =>
															array(	'id'					=> $user['User']['id'],
																			'invite_token'=> NULL,
																			'email'				=> strtolower(@$_REQUEST['email']),
																			'login'				=> strtolower(@$_REQUEST['email']),
																			'password'		=> sha1($_REQUEST['password'].$this->salt),
																			'last_login'	=> DboSource::expression('NOW()') ));
				
				// if users is responding to an invitation, add the user to the relevant group
				if(@$_REQUEST['group_id'] && $_REQUEST['challenge_id']) $user_update['ClassSet'] = array($_REQUEST['group_id']);
				
				$this->User->save($user_update);
				$this->Session->write('User',$user['User']);
				if($ajax){
					echo '1';
					die();
				}
				elseif(@$_REQUEST['group_id'] && !@$_REQUEST['challenge_id']) $this->redirect('/users/view/groups/');
				else $this->redirect('/dashboard/');
			}elseif($ajax){
				echo '0';
				die();
			}
			else $this->set('error',true);
		}elseif($ajax){
			echo '0';
			die();
		}else $this->redirect('/');
	}
	
	function check_login(){
		if(@$_SESSION['User']['id']) $this->redirect('/pages/home/');
		else $this->redirect('/dashboard/');
	}
	
	function update_payment($tier=null){
		if(@$_POST['card_num']){
			// save tier & payment day
			$u['User']['id'] = $_SESSION['User']['id'];
			$u['User']['payment_day'] = date('j');
			$u['User']['account_tier'] = $_REQUEST['account_tier'];
			$this->User->save($u);
			
			$this->process_payment();
		}else{
			$this->layout = 'ajax';
			$this->set('tier',$tier);
		}
	}
	
	function process_payment(){
		$user = $this->User->findById($_SESSION['User']['id']);
		
		// if we have a card token, use this for the transaction; otherwise, use the card number and save the returned token
		if($user['User']['card_token'] && !@$_POST["card_num"]){
			$trxnProperties = array(
				/* PRODUCTION */
			  // "ExactID"=>'A28460-01',
				// "Password"=> "14r0z18j",
			
				/* TESTING */
				"ExactID"=>'AD1689-05',
			  "Password"=> "181jw558",
		
				"Transaction_Type"=>"00",
			  "Customer_Ref"=>$user['User']['id'],
			  "Client_Email"=>$user['User']['email'],
			  "Language"=>'en',
			  "Expiry_Date"=>$user['User']['card_expiry'],
			  "CardHoldersName"=>$user['User']['card_name'],
				"TransarmorToken"=>$user['User']['card_token'],
				"CardType"=>$user['User']['card_type'],
			  "DollarAmount"=> (@$user['User']['account_tier'] == 'PLATINUM' ? 19.99 : 9.99));
		}else{
			$trxnProperties = array(
				/* PRODUCTION */
			  // "ExactID"=>'A28460-01',
				// "Password"=> "14r0z18j",
			
				/* TESTING */
				"ExactID"=>'AD1689-05',
			  "Password"=> "181jw558",
		
				"Transaction_Type"=>"00",
			  "Customer_Ref"=>$user['User']['id'],
			  "Client_Email"=>$user['User']['email'],
			  "Language"=>'en',
			  "Card_Number"=>$_POST["card_num"], // Test #s: VISA="4111111111111111" MasterCard="5500000000000004"
			  "Expiry_Date"=>$_POST["card_expiry"], // format as MMYY
			  "CardHoldersName"=>$_POST["card_name"],
			  "DollarAmount"=> (@$user['User']['account_tier'] == 'PLATINUM' ? 19.99 : 9.99),
			  "VerificationStr1"=>"{$_POST['street']}|{$_POST['zip']}|{$_POST['city']}|{$_POST['state']}|{$_POST['country']}",
			  "VerificationStr2"=>$_POST['card_code'],
			  "CVD_Presence_Ind"=>($_POST['card_code'] ? 1 : 0));
		}
		
		$client = new SoapClientHMAC("https://api.demo.globalgatewaye4.firstdata.com/transaction/v12/wsdl");
		$trxnResult = $client->SendAndCommit($trxnProperties);

		if(@$client->fault){
		    // there was a fault
		    print "<B>FAULT:  Code: {$client->faultcode} <BR />";
		    print "String: {$client->faultstring} </B>";
		    $trxnResult["CTR"] = "There was an error while processing. No TRANSACTION DATA IN CTR!";
		}
		
		//print_r($trxnProperties);
		//print_r($trxnResult);	
		
		if($trxnResult->Transaction_Error || $trxnResult->Transaction_Approved != 1){
			die($trxnResult->EXact_Message);
		}else{
			// if initial payment was successful, save the token & related info
			$u['User']['id'] = $user['User']['id'];
			if($_POST["card_num"]){
				$u['User']['card_name'] = $trxnResult->CardHoldersName;
				$u['User']['card_type'] = $trxnResult->CardType;
				$u['User']['card_expiry'] = $trxnResult->Expiry_Date;
				$u['User']['card_token'] = $trxnResult->TransarmorToken;
			}
			
			$u['User']['last_payment'] = DboSource::expression('NOW()');
			$this->User->save($u);

			// send success email
		}
		
		die('success');
	}
	
	// deauthenticate
	function logout(){
		$this->Session->delete('User');
		$this->redirect('/');
	}
	
	function session_logout(){
		$this->layout = 'ajax';
	}
}

/* for payment transactions */
class SoapClientHMAC extends SoapClient {
  public function __doRequest($request, $location, $action, $version, $one_way = NULL) {
		global $context;
		/* PRODUCTION */
		// $hmackey = "Koyr_iZIq3HcaRqIYx9JHtT82xC1LA3C";
		// $keyid = "13136";
		
		/* TESTING */
		$hmackey = "TuloMl3mBZg4si2~k6sKUGIkh29ch1kU";
		$keyid = "11318";
		
		$hashtime = date("c");
		$hashstr = "POST\ntext/xml; charset=utf-8\n" . sha1($request) . "\n" . $hashtime . "\n" . parse_url($location,PHP_URL_PATH);
		$authstr = base64_encode(hash_hmac("sha1",$hashstr,$hmackey,TRUE));
		if (version_compare(PHP_VERSION, '5.3.11') == -1) {
			ini_set("user_agent", "PHP-SOAP/" . PHP_VERSION . "\r\nAuthorization: GGE4_API " . $keyid . ":" . $authstr . "\r\nx-gge4-date: " . $hashtime . "\r\nx-gge4-content-sha1: " . sha1($request));
		} else {
			stream_context_set_option($context,array("http" => array("header" => "authorization: GGE4_API " . $keyid . ":" . $authstr . "\r\nx-gge4-date: " . $hashtime . "\r\nx-gge4-content-sha1: " . sha1($request))));
		}
    return parent::__doRequest($request, $location, $action, $version, $one_way);
  }
  
  public function SoapClientHMAC($wsdl, $options = NULL) {
		global $context;
		$context = stream_context_create();
		$options['stream_context'] = $context;
		return parent::SoapClient($wsdl, $options);
  }
}
?>