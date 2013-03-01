function check_login(){
	$.ajax({url:'/users/login/ajax',data:{'login':$('#loginUser').val(),'password':$('#loginPass').val()},type:'POST',success:function(r){
		if(r == 1){
			$('#loginBoxForm').submit();
			//window.location = '/dashboard/';
		}else{
			$('#loginError').html('Email and password combination do not match!');
			$('.errorNotification').show();
			$('#overlayLoginForm').height('164px');
			return false;
		}
	}});
}

function send_password_reset(){
	if(!$('#loginUser').val()){
		$('#loginError').html('Please specify your email address in the field above.');
		$('.errorNotification').show();
		$('#overlayLoginForm').height('164px');
		return false;
	}
	$.ajax({url:'/users/send_password_reset/'+$('#loginUser').val(),type:'POST',success:function(r){
		if(r == 1){
			$('#loginError').html('<span style="text-decoration:underline;">Email sent to inbox for new password!</span>');
			$('.errorNotification').show();
			$('#overlayLoginForm').height('164px');
		}else{
			$('#loginError').html('<span style="text-decoration:underline;">Email not recognized in records!</span>');
			$('.errorNotification').show();
			$('#overlayLoginForm').height('164px');
		}
	}});
}

function init_pagination(){
	$('.pagination-prev').hide();
	$('.pagination li a').click(function(){
		show_page($(this));
		return false;
	});
	$('.pagination-prev').click(function(){
		show_page($('.pagination li.active').prev().children('a'));
		return false;
	});
	$('.pagination-next').click(function(){
		show_page($('.pagination li.active').next().children('a'));
		return false;
	});
}

function show_page(e){
	var pagenum = parseInt(e.html());
	
	$('.pagination li.active').removeClass('active');
	e.parent().addClass('active');
	
	$('.listingPage').hide()
	$('#listingPage'+(pagenum-1)).show();
	
	if(pagenum == 1){
		$('.pagination-prev').hide();
		$('.pagination-next').show();
	}else if(pagenum == $('.pagination li').length){
		$('.pagination-next').hide();
		$('.pagination-prev').show();
	}else{
		$('.pagination-prev').show();
		$('.pagination-next').show();
	}
}

function add_question(){
	var newQ = $('.fieldset:last li:last').clone();
	
	$(newQ).find('input:first').attr('name','challenge[Question]['+$('.fieldset:last li').length+'][section]');
	$(newQ).find('input:last').attr('name','challenge[Question]['+$('.fieldset:last li').length+'][question]');
	$(newQ).find('input').val('');
	
	$('.fieldset:last').append(newQ);
}

function add_attachment(){
	var newA = $('.attachment_fields:first').clone();
	$(newA).children('input').each(function(){ $(this).attr('name',$(this).attr('name').replace('attachment[1]','attachment['+($('.attachment_fields').length+1)+']')); });
	$('.attachment_fields:last').after(newA);
}

function remove_attachment(e,id){
	$('#'+e).fadeOut('normal',function(){
		$('#'+e).append('<input type="hidden" name="remove_attachment[]" value="'+id+'" />');
	});
}

function save_user(){
	$.ajax({url:'/users/update/',data:$('#userData').serialize(),type:'POST'});
	$('.btn-savecontinue').hide();
	$('#cancel_changes').hide();
	
	var newpass = $('#new_pass1').val();
	var repass = $('#new_pass2').val();
    if(!(newpass=='' && repass== '') && (newpass=='' || repass== '' || newpass != repass )){
		$('#passwordError').show();
        $('.btn-savecontinue').show();
        $('#cancel_changes').show();
		return false;
	} else {
        setTimeout("$('#passwordError').hide()",10);
        $('#savedNotify').show();
	    setTimeout("$('.btn-savecontinue').show();$('#savedNotify').hide();window.location='/users/view/';",2000);
	    $('.user-name a').html($('input[name="firstname"]').val() + ' ' + $('input[name="lastname"]').val());
	 }
}

function switch_state(){
	var country = $('#country').val();
	if(country == 'US'){
		$('#state_select').show();
		$('#other_state').val('');
		$('#state_input').hide();
	}else{
		$('#other_state').val('');
		$('#state_input').show();
		$('#us_state').val('');
		$('#state_select').hide();
	}
}

function cancel_changes(){
	$('#passwordError').hide()
	$('#cancel_changes').hide();
	$('#change_password').hide();
	$('#show_change_password').show();
	$('#new_pass1').val('');
	$('#new_pass2').val('');
}

function show_question(q_id){
	$('li.active').removeClass('active');
	$('#questionNav'+q_id).addClass('active');
	$('#questionWrapperBody').height($('#questionContent').height()+1);
	$('#questionContent').fadeOut('normal',function(){
		$.ajax({url:'/questions/view/'+q_id,success:function(r){
			$('#questionContent').html(r);
			$('#questionContent').fadeIn();
			
			$textAreaOrigHeight = 264;
			$("textarea.niceTextarea").keyup(function(){ 
				expandtext(this); 
			});
			$("textarea.niceTextarea").each(function(){ expandtext(this); });
			$('#questionWrapperBody').css('height','auto');
		}});
	});
}

function show_response(q_id,u_id){
	$('#leftcol li.active').removeClass('active');
	$('#questionNav'+q_id).addClass('active');
	
	// add temp data to page
	if($('#responseID').val()) set_response_temp_fields();
	
	$('#leftcol li').each(function(){
		if($(this).index() < $('#questionNav'+q_id).index()) $(this).children('a').click(function(){ $.bbq.pushState({'q_id':$(this).attr('id').replace('respNav_',''),'select':''});return false; });
		else $(this).children('a').unbind('click');
	});
	
	$('#mainResponseBody').fadeOut('normal',function(){
		$.ajax({url:'/responses/view/'+q_id+'/'+u_id+'?ajax=1',success:function(r){
			$('#mainResponseBody').html(r);
			$('#mainResponseBody').fadeIn();
			
			$(window).trigger('hashchange');
		}});
	});
}

function show_question_responses(q_id){
	$('#leftcol li.active').removeClass('active');
	$('#questionNav'+q_id).addClass('active');
	$('#mainResponseBody').fadeOut('normal',function(){
		$.ajax({url:'/responses/view/'+q_id+'?ajax=1&type='+($('.tab-agreed').hasClass('active') ? 'agree' : ($('.tab-disagreed').hasClass('active') ? 'disagree' : 'response')),success:function(r){
			$('#mainResponseBody').html(r);
			$('#mainResponseBody').fadeIn();
			
			$(".mcs_containers").each(function(){ $(this).mCustomScrollbar("vertical",350,"easeOutCirc",1.05,"auto","yes","yes",15); });
		}});
	});
}

function save_response(redirect){
	if($('.attachmentType').length){
		$('#responseData').submit();
		return false;
	}
	
	if(!redirect.search('attachments') && !$('.niceTextarea:first').val()){
		$('#fieldValidate').show();
		return false;
	}
	
	$.ajax({url:'/responses/update/',data:$('#responseData').serialize(),type:'POST',success:function(r){
		if(redirect == 'ajax'){
			if($('#next_id').val() == 'attachments') add_attachments($('#challenge_id').val());
			else if($('#next_id').val() == 'dashboard') window.location = '/dashboard/';
			else window.location = '#' + $('#next_id').val();
		}else if(redirect) window.location = redirect;
		else{ /* */ }
	}});
}

function save_second_response(redirect){
	if($('textarea[name="response_body"]').length && !$('[name="response_body"]').val()){
		$('#fieldValidate').show();
		return false;
	}
	
	if($('#tempResponseData input').length){
		set_response_temp_fields();
		response_data = $('#tempResponseData').serialize();
	}else response_data = $('#responseData').serialize();
	$('#tempResponseData').html('');
	
	$.ajax({url:'/responses/update/',data:response_data,type:'POST',success:function(r){
		if(redirect=='next') $.bbq.pushState({'q_id':next_q_id,'select':''});
		else if(redirect) window.location = redirect;
		else if(!$('input[name="id"]').val()) $('input[name="id"]').val(r);
		// else $('#responseID').val(r);
	}});
}

function set_response_temp_fields(){
	var i = $('#tempResponseData input').length;
	var rid = $('#responseID').val();
	var className = 'tempResponse'+rid;
	
	$('.'+className).remove();
	
	$('#tempResponseData').append('<input type="hidden" name="responses['+i+'][response_type]" value="'+$('#responseValue').val()+'" class="'+className+'" />');
	$('#tempResponseData').append('<input type="hidden" name="responses['+i+'][response_id]" value="'+rid+'" class="'+className+'" />');
	$('#tempResponseData').append('<input type="hidden" name="responses['+i+'][response_body]" value="'+$('<div/>').text($('[name="response_body"]').val()).html().replace(/"/g,'&quot;')+'" class="'+className+'" />');
	if($('#currentID').val()) $('#tempResponseData').append('<input type="hidden" name="responses['+i+'][id]" value="'+$('#currentID').val()+'" class="'+className+'" />');
}

function add_attachments(c_id){
	$('li.active').removeClass('active');
	$('#questionNavAttach').addClass('active');
	$('#questionWrapperBody').height($('#questionContent').height());
	$('#questionContent').fadeOut('normal',function(){
		$.ajax({url:'/attachments/update/'+c_id,success:function(r){
			$('#questionContent').html(r);
			$('#attachmentStepNumber').html($('#caseclubmenu li').length);
			$('#questionContent').fadeIn();
		}})
	});
}

function add_response_attachment(){
	var newA = $('ol.fieldset2 li:last').clone();
	$(newA).children('input').each(function(){ $(this).attr('name',$(this).attr('name').replace('attachment[0]','attachment['+($('ol.fieldset2 li').length)+']')); });
	$(newA).find('input[type=text]').val('').after($(newA).find('a').length ? '' : '&nbsp;&nbsp;&nbsp;(<a onclick="$(this).parents(\'li\').remove();return false;">Remove</a>)');
	$(newA).children('p').children('input').each(function(){ $(this).attr('name',$(this).attr('name').replace('attachment[0]','attachment['+($('ol.fieldset2 li').length)+']')); });
	$(newA).children('.fieldsetNumberList').html(($('ol.fieldset2 li').length+1)+'.');
	
	$('ol.fieldset2').append(newA);
}

function show_edit_existing(e,cid){
	e = e.parents('tr');
	var prevOpen = $('tr.opened').length;
	$('.viewAllRequests').hide();
	
	if(e.hasClass('opened')){
		$('.pagination').show();
		
		e.removeClass('opened');
		
		$('#home-leaderboard').animate({width:0},function(){ $('#home-leaderboard').hide(); });
		$('#bridgelist').animate({width:954},function(){ $('.graphIcon').show();$('#bridgetable td,#bridgetable th').fadeIn(); });
		
		$('#bridgetable .col1').animate({width:390},'fast');
		$('#thinListBorder').hide();
	}else{
		$('.pagination').hide();
		
		$('tr.opened').next().children('div.alignleft').removeClass('colgroup');
		$('tr.opened').removeClass('opened').next().slideUp();
		
		e.addClass('opened');
		
		$('#bridgetable .col1').animate({width:465},'fast');
		$('#thinListBorder').show();
		$('#bridgetable td:not(:first-child),#bridgetable th:not(".col1")').hide();
		
		e.find('.viewAllRequests').show();
		
		$.ajax({url:'/challenges/update_active_interstitial/'+cid,success:function(r){
			$('#bridgelist').css({'float':'left'});
			$('#bridgelist').animate({width:450});
			if(prevOpen){
				$("#home-leaderboard .box-content").fadeOut('slow',function(){
					$('#home-leaderboard').html(r).find('.box-content').hide();
					$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
					//$("#home-leaderboard .content").hide();
					$("#home-leaderboard .box-content").fadeIn('slow');
					$('#home-studentwork').width(470);
				});
			}else{
				$('#home-leaderboard').html(r);
				$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
				$('#home-leaderboard').show();
				$('#home-studentwork').width(470);
				$('#home-leaderboard').animate({width:475});
			}
		
			setTimeout(function(){
				$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
			},500);
		}});
	}
}

function show_user_list(e,cid,view,metrics){
	e = e.parents('tr');
	var prevOpen = $('tr.opened').length;
	$('.viewAllRequests').hide();
	
	if(e.hasClass('opened')){
		$('.pagination').show();
		
		e.next().slideUp('normal',function(){
			e.removeClass('opened');
		});
		
		$('#home-leaderboard').animate({width:0},function(){ $('#home-leaderboard').hide(); });
		$('#bridgelist').animate({width:954},function(){ $('.graphIcon').show();$('#bridgetable td,#bridgetable th').fadeIn(); });
		
		$('#bridgetable .col1').animate({width:390},'fast');
		$('#thinListBorder').hide();
	}else{
		$('.metrics-arrow-hide').hide();
		$('.graphIcon').hide();
		$('.pagination').hide();
		
		$('tr.opened').next().children('div.alignleft').removeClass('colgroup');
		$('tr.opened').removeClass('opened').next().slideUp();
		
		e.addClass('opened');
		if(!e.find('.graphIcon').length && !(view && metrics)) e.next().slideDown();
		
		$('#bridgetable .col1').animate({width:465},'fast');
		$('#thinListBorder').show();
		$('#bridgetable td:not(:first-child),#bridgetable th:not(".col1")').hide();
		
		e.find('.viewAllRequests').show();
				
		$.ajax({url:'/challenges/view/'+cid+'/'+(view ? 'stats' : 'leaderboard')+'/',success:function(r){
			$('#bridgelist').css({'float':'left'});
			$('#bridgelist').animate({width:450});
			if(prevOpen){
				$("#home-leaderboard .box-content").fadeOut('slow',function(){
					$('#home-leaderboard').html(r).find('.box-content').hide();
					$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
					//$("#home-leaderboard .content").hide();
					$("#home-leaderboard .box-content").fadeIn('slow');
					$('#home-studentwork').width(470);
				});
			}else{
				$('#home-leaderboard').html(r);
				$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
				$('#home-leaderboard').show();
				$('#home-studentwork').width(470);
				$('#home-leaderboard').animate({width:475});
			}
			
			setTimeout(function(){
				$('#home-studentwork').css({height:$('#bridgelist').height(),minHeight:$('#bridgelist').height()});
			},500);
		}});
	}
}

function response_agree(){
	$('#chooseResponse').hide();
	$('.agreeAction').show();
	$('.responseActions').show();
	
	$('.agreeAction').children('input').attr('name','response_body');
	$('#responseValue').val('A');
}

function response_disagree(){
	$('#chooseResponse').hide();
	$('.disagreeAction').show();
	$('.responseActions').show();
	
	$('.disagreeAction').children('textarea').attr('name','response_body');	
	$('#responseValue').val('D');
}

function response_reconsider(){
	$('.responseActions').hide();
	$('.disagreeAction').hide();
	$('.agreeAction').hide();
	$('#chooseResponse').show();
	
	$('#responseValue').val('');
	$('.disagreeAction').children('textarea').attr('name','');	
	$('.agreeAction').children('input').attr('name','');
}

function join_show_instructor(){
	$('#joinModal form').hide();
	$('#instructorJoinData').show();
	$('#joinModal .caseclub-tab').removeClass('active');	
	$('.tab-instructor').addClass('active');
}

function join_show_collaborator(){
	$('#joinModal form').hide();
	$('#collaboratorJoinData').show();
	$('#joinModal .caseclub-tab').removeClass('active');	
	$('.tab-collaborator').addClass('active');
}

function join_show_student(){
	$('#joinModal form').hide();
	$('#studentJoinData').show();
	$('#joinModal .caseclub-tab').removeClass('active');	
	$('.tab-student').addClass('active');
}

function invited_show_new(){
	$('#inviteData').show();
	$('#existingInviteData').hide();
	$('.tab-basics').addClass('active');
	$('.tab-questions').removeClass('active');
}

function invited_show_existing(){
	$('#inviteData').hide();
	$('#existingInviteData').show();
	$('.tab-basics').removeClass('active');
	$('.tab-questions').addClass('active');
}

function remove_challenge_group(id,c_id){
	$('#challengeGroup'+id).remove();
	$.ajax({url:'/challenges/clear_groups/' + c_id});
	save_challenge('update_people');
}

function create_group(){
	$('.add-link.add-link-creategroup').hide();
	$('#new_group_form').show();
}

function create_class(){
	if($('#createClassName').val() == ''){
		$('#warning').show();
	}else{
		$.ajax({url:'/classes/update/',data:$('#create_class').serialize(),type:'POST',success:function(r){
			$('#newTokenClassID').val(r);
			$('#tokenClassName').html($('#createClassName').val() + ' Token');
			$('#showGenerateToken').click();
		}});
	}
}

function create_class_import(){
	if($('#createClassName').val() == ''){
		$('#warning').show();
	}else{
		$.ajax({url:'/classes/update/',data:$('#create_class').serialize(),type:'POST',success:function(r){
			$('#showImportUpload').attr('href','/users/import_class/' + r).click();
		}});
	}
}

function create_class_manual(){
	if($('#createClassName').val() == ''){
		$('#warning').show();
	}else{
		$.ajax({url:'/classes/update/',data:$('#create_class').serialize(),type:'POST',success:function(r){
			$('#showAddManual').attr('href','/classes/invite_member/' + r + '/student/');
			$('#showAddManual').click();
		}});
	}
}

function update_token(){
	$.ajax({url:'/classes/update_token/' + $('#newTokenClassID').val(),success:function(r){
		$('#token_value').html(r);
		$('#showNewToken').click();
	}});
}

function view_token(id,name,token){
	$('#token_value').html(token);
	$('#tokenClassName').html(name);
	$('#newTokenClassID').val(id);
}

function show_group_members(g_id){
	$('.simpletable.groupmemberlist').remove();
	$('#inviteUserGroup').val(g_id);
	$.ajax({url:'/groups/view_members/'+g_id,success:function(r){
		$('.viewGroupMembersButtons').before(r);
	}});
}

function delete_class_member(g_id,u_id){

	$('#groupMemberRow'+u_id).fadeOut();
	//jQuery.fancybox.close();
	$.ajax({url:'/classes/remove_member/'+g_id+'/'+u_id,success:function(r){
		$("#edit_student_"+g_id).trigger('click');
	}});
}

function resend_class_member(c_id,u_id){
	$.ajax({url:'/users/invite/'+c_id+'/'+u_id+'/'});
	jQuery.fancybox.close();
}

function class_invite_professor(c_id){
	$.ajax({url:'/users/invite/'+c_id+'/0/'+$('#firstName').val()+'/'+$('#lastName').val()+'/'+$('#emailAddr').val()+'/L/'+$('#permissions').val()});
}

function class_invite_student(c_id){
	$.ajax({url:'/users/invite/'+c_id+'/0/'+($('#firstName').val() ? $('#firstName').val() : '0')+'/'+($('#lastName').val() ? $('#lastName').val() : '0')+'/'+$('#emailAddr').val()+'/P/'});
}

function load_search_results(){
	if($('#sharedSearchResults input').length) jQuery.fancybox.close();
	else{
		$('#sharedSearchResults').load('/classes/search_shared/' + $('#queryEmail').val());
		$('#searchClassesContinue').click(function(){
			add_selected_groups();
			$('#searchClassesContinue').unbind('click');
		});
	}
}

function group_invite_user(){
	var uType = $('#inviteUserU').attr('checked') ? 'P' : 'L';
	show_group_delayed();
	$.ajax({url:'/users/invite/'+$('#inviteUserGroup').val()+'/0/'+$('#inviteUserFirst').val()+'/'+$('#inviteUserLast').val()+'/'+$('#inviteUserEmail').val()+'/'+uType,success:function(){
		$('.inviteField').val('');
	}});
}

function select_listed_group(id,e){
	if(!e.hasClass('groupPicked')) $('#joinAGroup').append('<input type="hidden" id="addSelectedGroup'+id+'" value="'+id+'" name="groups[]" class="addSelectedGroupInput" />');
	else $('#addSelectedGroup'+id).remove();
	e.toggleClass('groupPicked');
}

function add_selected_groups(){
	$.ajax({url:'/classes/request_join/',data:$('#joinAGroup input').serialize(),type:'POST',success:function(){
		$('.addSelectedGroupInput').remove();
	}});
}

function select_listed_user(id,e){
	if(!e.hasClass('groupPicked')) $('#viewRequestsGroup').append('<input type="hidden" id="addSelectedUser'+id+'" value="'+id+'" name="users[]" class="addSelectedUserInput" />');
	else $('#addSelectedUser'+id).remove();
	e.toggleClass('groupPicked');
}

function process_selected_requests(g_id,action){
	$.ajax({url:'/classes/process_requests/'+g_id+'/'+action,data:$('#viewRequestsGroup input').serialize(),type:'POST',success:function(){
		$('.addSelectedUserInput').remove();
		window.location = '/users/view/classes/';
	}});
}

function switch_response_view(tab){
	$('.mcs_containers').hide();
	$('#'+tab+'Responses').show();
	
	$('.caseclub-tab').removeClass('active');
	$('#'+tab+'Tab').addClass('active');
	
	$(".mcs_containers").each(function(){ $(this).mCustomScrollbar("vertical",350,"easeOutCirc",1.05,"auto","yes","yes",15); });
}

function flip_details(cid,view){
	$('#home-leaderboard').css({height:$('#caseclub-list').height()});
	$.ajax({url:'/challenges/view/'+cid+'/'+view+'/',data:{'permitStats':1},success:function(r){
		$("#home-leaderboard .content").fadeOut('slow',function(){
			$("#home-leaderboard .content").html($(r).find('.content').hide());

			$("#home-leaderboard .content").height($('#caseclub-list .content').height());
			$("#home-leaderboard .content").fadeIn();
			
			if(view == 'stats') drawChart();
		});
		/*
		$("#home-leaderboard").flip({
			direction:(view == 'stats' ? 'lr' : 'rl'),
			content:r,
			onEnd:function(){
				$("#home-leaderboard .content").height($('#caseclub-list .content').height());
				$('#home-leaderboard').css('background-color','transparent');
			} 
		});
		*/
	}});
}

function challenge_select_group(gid,name){
	if(gid){
		$('#create-challenge-validate').hide();
		$('#create-challenge-now').show();
		
		$('.tmpGroupAdd').remove();
		$('#inviteGroup').append('<option class="tmpGroupAdd" value="'+gid+'">'+name+'</option>');
		$('#inviteNewUserLink').attr('onclick',"");
		$('#inviteNewUserLink').fancybox({
			'hideOnOverlayClick' : false,
			'showCloseButton' : false,
			'centerOnScroll' : true	
		});
	}else{
		if(!$('input[name="challenge[Group][]"]').length){
			$('#create-challenge-validate').css('display','block');
			$('#create-challenge-now').hide();
		}
		
		$('.tmpGroupAdd').remove();
		$('#inviteNewUserLink').attr('onclick',"alert('Please add at least one group to this challenge to continue');return false;");
	}
}

function setup_response_hashchange(ini_id,challenge_id){
	$(window).bind('hashchange',function(e){
		var qid = $.param.fragment();
		$('#counter_container').show();
		if(qid == 'attachments'){
			add_attachments(challenge_id);
			$('#counter_container').hide();
		}else if(qid) show_question(qid);
		else show_question(ini_id);
	});
	$(window).trigger('hashchange');
}

function setup_second_response_hashchange(ini,q_id,u_id){
	var response_q_id = q_id;
	$(window).bind('hashchange',function(e){
		var state = $.bbq.getState('select');
		var question = $.bbq.getState('q_id');
		
		if(question && question != response_q_id) show_response(question,u_id);
		else{		
			if(state == 'agree') response_agree();
			else if(state == 'disagree') response_disagree();
			else if(state == 'reconsider') response_reconsider();
			else if(ini == 'agree') response_agree();
			else if(ini == 'disagree') response_disagree();
			else response_reconsider();
		}
		response_q_id = question;
	});
	$(window).trigger('hashchange');
}

function setup_view_hashchange(ini){
	$(window).bind('hashchange',function(e){
		var qid = $.param.fragment();
		if(qid) show_question_responses(qid);
	});
	$(window).trigger('hashchange');
}

function disable_user_email(){
	$('#notify_groups').attr('checked',false);
	$('#notify_challenges').attr('checked',false);
	$('#notify_expiration').attr('checked',false);
	$('#notify_responses').attr('checked',false);
}

function enable_user_email(){
	$('#notify_groups').attr('checked',true);
	$('#notify_challenges').attr('checked',true);
	$('#notify_expiration').attr('checked',true);
}

function set_email_prefs(){
	$('input[name="notify_groups"]').val($('#notify_groups').attr('checked') ? 1 : 0);
	$('input[name="notify_challenges"]').val($('#notify_challenges').attr('checked') ? 1 : 0);
	$('input[name="notify_expiration"]').val($('#notify_expiration').attr('checked') ? 1 : 0);
	$('input[name="notify_responses"]').val($('#notify_responses').attr('checked') ? 1 : 0);
}

function show_group_delayed(){
	setTimeout("$('#viewGroupLink'+$('#inviteUserGroup').val()).click();",600);
}

function save_group_name(){
	var form_data = $('#updateGroupName').serialize();
	jQuery.fancybox.close();
	
	$.ajax({url:'/groups/update/',data:form_data,type:'POST'});
}



function invite_collaborator(c_id){
	var uType = $('#inviteUserU').attr('checked') ? 'P' : 'L';
	$.ajax({url:'/challenges/queue_invite/'+c_id+'/0/0/'+$('#firstName').val()+'/'+$('#lastName').val()+'/'+$('#emailAddr').val()+'/C',success:function(r){
		jQuery.fancybox.close();
		// window.location = '/challenges/update/' + c_id + '/update_people/';
		render_update_challenge('people');
	}});
}

function save_challenge(redirect){
	if(redirect == 'update_people') $.ajax({url:'/challenges/clear_groups/' + $('#id').val()});
	$.ajax({url:'/challenges/update/0/' + (redirect != 'ajax' ? redirect : ''),data:$('#challenge_data').serialize(),type:'POST',success:function(r){
		if(redirect == 'ajax') return true;
		else if(redirect != 'quiet') $('#edit_content').html(r);
	}});
}

function save_challenge_final(){
	$('#challengeStatus').val('C');
    var chk = document.getElementById('sendmail');
    chk.style.display="none";
	var chk1 = document.getElementById('mailsent');
    chk1.style.display="";
	/*
	$.ajax({url:'/challenges/update/0/ajax',data:$('#challengeData').serialize(),type:'POST',success:function(r){
		setTimeout('window.location = "/dashboard/";',1000);
	}});
	*/
	window.location = '/challenges/update/0/dashboard?' + $('#challenge_data').serialize();
}

function render_update_challenge(view){
	$('#sidemenu li').removeClass('active');
	$('#menu_' + view).addClass('active');
	
	// TODO: if id, serialize & save form
	$('#edit_content').load('/challenges/update/' + ($('#id').val() ? $('#id').val() : '0') + '/update_' + view,function(){
		$(".accordion-trigger p").click(function(){
			$("li.open .accordion-content", $(this).closest("ul.accordion")).slideUp(300); 
			$("li", $(this).closest("ul.accordion")).removeClass("open"); 
			$(this).closest("li").addClass("open"); 
			$(".accordion-content", $(this).closest("li")).slideDown(300); 
		});
	});
}

function set_challenge(type){
	$('#challenge_type').val(type);
}

function set_assignment(type){
	$('#response_types').val(type);
}

function set_collaboration(type){
	$('#collaboration_type').val(type);
}

function setup_challenge_hashchange(){
	$(window).bind('hashchange',function(e){
		var view = $.bbq.getState('view');
		var state = $.bbq.getState('state');
		
		if(state) eval('set_' + state.type + '("' + state.val + '")');
		render_update_challenge(view);
	});
}

function save_groups(c_id){
	$.ajax({url:'/challenges/clear_groups/' + c_id,success:function(){
		$('.connectedSortable').each(function(){
			$.ajax({url:'/challenges/save_groups/' + c_id,data:$(this).sortable('serialize')});
		});
		jQuery.fancybox.close();
		render_update_challenge('people');
	}});
}

function delete_queued_invite(u_id,c_id){
	$.ajax({url:'/challenges/remove_queued_invite/' + u_id + '/' + c_id,success:function(){
		render_update_challenge('people');
	}});
}

function set_stat_session(v){
	$.ajax({url:'/metrics/set_detail_session/' + v});
}

function show_comment(rid,pid,cid,color,e){
	$('#responseBody' + rid + '_' + pid).parent().find('p').first().hide();
	$('#responseBody' + rid + '_' + pid).show();
	$('.comment_detail_' + pid).show().removeClass('activeDetail');
	$('#commentDetail_' + cid).addClass('activeDetail');
	
	$('.commentHighlight').css('background-color','#ccc');
	$('#commentHighlight_' + cid).css('background-color',color);
	if(e) $(e).parent().hide();
	
	setTimeout(function(){ $(document).click(function(){ hide_all_comments();$(document).unbind('click'); }); },15);
}

function hide_all_comments(){
	$('.textvalue p').hide();
	$('.textvalue p:first-child').show();
	$('.question-comments').hide();
}

function hide_comment(rid,cid,e){
	$(e).parent().hide();
	$('#responseBody' + rid).show();
	$('.comment_detail_' + cid).hide();
}

function hide_comments(rid,e){
	$('#responseBody' + rid).show();
	$(e).hide();
	$('.question-comments').hide();
}


