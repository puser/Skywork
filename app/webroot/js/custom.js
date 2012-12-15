jQuery(function($) {

	$(".htmlselect a.dropdown-link").click(function(){
		$(".selectoptions", $(this).closest(".htmlselect")).slideToggle(400);
		return false;
	});
	
	$("ul li:first-child").addClass("first-child");
	$("ul li:last-child").addClass("last-child");
	
	
	/**
	 * Overlay
	 */
	$("#create-challenge-now, .show-overlay").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true
	});
	
	
	/**
	 * Modal: Exit
	 */
	$(".caseclub-withdraw").attr("href", "#modalExitChoices").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true
	});
	
	
	/**
	 * Scrollbar
	 */
	$(".mcs_containers").each(function(){ $(this).mCustomScrollbar("vertical",350,"easeOutCirc",1.05,"auto","yes","yes",15); });
	
	
	/**
	 * Graph 
	 */
	$(".graph1 .bars-q1 .bar-agree").height(70);
	$(".graph1 .bars-q1 .bar-disagree").height(190);
	$(".graph1 .bars-q2 .bar-agree").height(190);
	$(".graph1 .bars-q2 .bar-disagree").height(70);
	$(".graph1 .bars-q3 .bar-agree").height(120);
	$(".graph1 .bars-q3 .bar-disagree").height(120);
	
	
	/** 
	 * Sidemenu 2
	 */ 
	$("a.sidemenu2-title").click(function(){
		$("li.active ul", $(this).closest("#sidemenu2")).slideUp(300, function(){
			$(this).closest("li").removeClass("active"); 
		}); 
		$("ul", $(this).closest("li")).slideDown(300, function(){
			$(this).closest("li").addClass("active"); 
		}); 
	
	}); 
	
	
	
	/**
	 * Login Form
	 */
	$("#overlayLoginLink,#overlayLoginLink2").click(function(){
		if($(this).hasClass("activeForm")) {
			$("#overlayLoginForm").css("display", "none");
			$(this).removeClass("activeForm");
		}
		
		else {
			$("#overlayLoginForm").css("display", "block");
			$(this).addClass("activeForm");
			$('#loginUser').focus();
			
			$(document).keyup(function(e) {
			  if (e.keyCode == 27) { 
			  	$("#overlayLoginForm").css("display", "none");
				$(this).removeClass("activeForm");
			  } 
			});
		}
	
	});
	
});

/**
 * Extend Textarea
 */
$textAreaOrigHeight = 264;
$("textarea.niceTextarea").keyup(function(){ 
	expandtext(this); 
});




function expandtext(textArea){
//	console.log("hehe");
//	console.log(textArea.scrollHeight, textArea.offsetHeight);
	curScroll = $(window).scrollTop();
	
	while (
		textArea.rows > 1 &&
		textArea.offsetHeight > $textAreaOrigHeight
	){
		textArea.rows--;
	}
	
	var h=0;
	while (textArea.scrollHeight > textArea.offsetHeight && h!==textArea.offsetHeight)
	{
		h = textArea.offsetHeight;
		textArea.rows++;
	}
	$(window).scrollTop(curScroll);
}