jQuery(document).ready(function($){


	
	/**
	 * Slider
	 */
	//wenSlider2("#slider");
	
	
	/**
	 * Our Team Effect
	 */
	$("#ourteam .team > ul > li").mouseenter(function(){
		
		$(this).addClass("active"); 
		$(this).closest(".team").addClass("hasactive"); 
	
	}).mouseleave(function() {
		
		$(this).removeClass("active"); 
		$(this).closest(".team").removeClass("hasactive"); 
	
	}); 
	
	
	
	/**
	 * Try Skywork Form
	 */
	$("#tryskywork-submit").click(function() {
		
		$(".tryskywork-link, .tryskywork-form").hide();
		
		$.ajax({url:'/sendmsg.php',data:{name:$('#signupname').val(),email:$('#signupemail').val()}});
		
		$(".trythankyou").show(); 
		
		return false;
	
	}); 

	
	
	/**
	 * User Form
	 */
	$("#login-form-tab").click(function(){
		if(!$(this).closest("li").hasClass("active")) {
			$("li", $(this).closest(".tabs")).removeClass("active");
			$(this).closest("li").addClass("active");
			
			$(".user-form").hide(); 
			$("#login-form").show(); 
			
		}
	});
	
	
	$("#signup-form-tab").click(function(){
		if(!$(this).closest("li").hasClass("active")) {
			$("li", $(this).closest(".tabs")).removeClass("active");
			$(this).closest("li").addClass("active");
			
			$(".user-form").hide(); 
			$("#signup-form").show(); 
			
		}
	});
	
}); 



/**
  * WenSlider2
  */

function wenSlider2($obj) {
	
	$this = jQuery($obj); 
	
	if($this) {
		$boxSlider = $this.closest(".slides"); 
		$slides = jQuery('.slide', $this);
		$slides.css({opacity: 0, position: "absolute", top: 0, zIndex: 1}); 
		
		jQuery(".slide:eq(0)", $this).css({zIndex: 100}).animate({opacity: 1}, 2000, function(){
			jQuery(this).addClass("current");
		}); 
		$slidebgCurrent = jQuery(".slide:eq(0) .slide-bg", $this).text();
		jQuery(".slider-bg:eq(0)").css({"background-image": "url('" + $slidebgCurrent + "')", zIndex: 1}).animate({opacity: 1}, 2000, function(){
			jQuery(this).addClass("current");
		});
		jQuery(".slider-menu li:first", $this).addClass("activemenu");
		
		var total    = $slides.length;
		var i             	= 0;
		var altSliderBg = 1;
		
		if(total > 1) {
		
			homeSliderInterval = setInterval(function() {
				
				var $current 	=  jQuery('.slide.current', $this);
				idx_current		= $current.index(); 
				idx_current		= idx_current == -1 ? 0 : idx_current; 
				
				$next			= (idx_current == total-1) ? jQuery('.slide:first', $this) : $current.next();
				jQuery('.slide.current', $this).css({ top: $boxSlider.height() }); 
				
				jQuery(".slider-menu li:eq(" + idx_current + ")", $this).removeClass("activemenu"); 
				jQuery(".slider-menu li:eq(" + $next.index() + ")", $this).addClass("activemenu"); 
				
				$current.css({opacity: 1, zIndex: 99 }).animate({opacity: 0}, 2000);
				$next.css({zIndex: 100}).animate({opacity: 1}, 2000);
				
				$current.removeClass("current"); 
				$next.addClass("current"); 
				
				$slidebgCurrent = jQuery(".slide-bg", $current).text();
				$slidebgNext = jQuery(".slide-bg", $next).text();				
				
				$sliderBgCurrent = jQuery(".slider-bg.current");
				altSliderBg = $sliderBgCurrent.index();
				$sliderBgNext = (altSliderBg == 1) ? jQuery(".slider-bg:nth-child(1)") : jQuery(".slider-bg:nth-child(2)"); 
				
				$sliderBgCurrent.css({ "background-image": "url('" + $slidebgCurrent + "')", opacity: 1, zIndex: 0});
				$sliderBgNext.css({ "background-image": "url('" + $slidebgNext + "')", opacity: 0, zIndex: 1}).animate({opacity: 1}, 2000);
				
				$sliderBgCurrent.removeClass("current"); 
				$sliderBgNext.addClass("current"); 
				
			}, 10000); 
		
		}
		
		
		jQuery(".slider-menu li", $this).bind("click", function() {
			clearInterval(homeSliderInterval);
			
			var idx_menu 	= jQuery(this).index(); 
			
			var $current 	=  jQuery('.slide.current', $this);
			idx_current		= $current.index(); 
			idx_current		= idx_current == -1 ? 0 : idx_current; 
			
			if(idx_menu != idx_current) {
				$next			= jQuery('.slide:eq(' + idx_menu + ')', $this);
				jQuery('.slide.current', $this).css({ top: $boxSlider.height() }); 
				
				jQuery(".slider-menu li:eq(" + idx_current + ")", $this).removeClass("activemenu"); 
				jQuery(".slider-menu li:eq(" + $next.index() + ")", $this).addClass("activemenu"); 
				
				$current.css({opacity: 1, zIndex: 99 }); 
				$next.css({zIndex: 100}).animate({opacity: 1}, 500, function() {
					$current.css({opacity: 0}); 
					
				});
				$current.removeClass("current"); 
				$next.addClass("current"); 
			}
			
		}); 
	}
	
	else {
		
	}
}