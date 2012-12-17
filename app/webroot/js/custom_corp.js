jQuery(document).ready(function($) {

	$(".htmlselect a.dropdown-link").click(function(){
		$(".selectoptions", $(this).closest(".htmlselect")).slideToggle(400);
		return false;
	});
	
	$(".htmlselect2 a.dropdown-link").click(function(){
		$(".selectoptions", $(this).closest(".htmlselect2")).slideToggle(100);
		return false;
	});
	
	$("ul li:first-child").addClass("first-child");
	$("ul li:last-child").addClass("last-child");
	
	
	/**
	 * Overlay
	 */
	$(".show-overlay").fancybox({
		'hideOnOverlayClick' : false,
		'showCloseButton' : false,
		'centerOnScroll' : true
	});
	
	
	/**
	 * Tooltips
	 */
	$(".tooltip-mark").tooltip({
		track: true, 
		delay: 0, 
		showURL: false, 
		opacity: 1, 
		fixPNG: true, 
		extraClass: "pretty fancy", 
		top: -15, 
		left: 20 
	});
	
	
	/**
	 * Scrollbar
	 */
	if($("#mcs_container").length)
		$("#mcs_container").mCustomScrollbar("vertical",300,"easeOutCirc",1.05,"auto","yes","yes",15); 
	
	
	
	
	/**
	 * Input Fields - Check Default
	 */
	showDefaultValues = function(obj) {
	
		$default = $(obj).attr('default'); 
		$default = $default == undefined ? '' : $default;
		
		$val = $(obj).val();
		$val = $val == undefined ? '' : $val; 
		
		if( $val == '' || $val == $default) {
			$(obj).val($default); 
			$(obj).addClass("hasdefaultvalues"); 
		}
		
		else {
			$(obj).val($val); 
			$(obj).removeClass("hasdefaultvalues"); 
		}
	}
	
	$(".checkdefault").each(function() {
		
		showDefaultValues($(this));

		$(this).focus(function() {
			$default = $(this).attr('default'); 
			$default = $default == undefined ? '' : $default;
			
			$val = $(this).val();
			$val = $val == undefined ? '' : $val; 
			
			if( $val == '' || $val == $default) {
				$(this).val(''); 
				$(this).removeClass("hasdefaultvalues"); 
			}
			
		}).blur(function() {
			showDefaultValues($(this));
		}); 
		
	}); 
	
	
	
	
	
	/**
	 * Item Actions Popup
	 */
	$(".item-actions a.item-actions-icon").click(function(){
		parent = $(this).closest(".item-actions");
		if(parent.hasClass("open")) 
			parent.removeClass("open");
		else
			parent.addClass("open");
	}); 
	
	$(".remove-class a.remove-class-icon").click(function(){
		parent = $(this).closest(".remove-class");
		if(parent.hasClass("open")) 
			parent.removeClass("open");
		else
			parent.addClass("open");
	}); 
	
	
	/**
	 * Custom Select Box
	 */
	$(".custom-select .custom-select-value").click(function() {
		parent = $(this).closest(".custom-select");
		if(parent.hasClass("open")) 
			parent.removeClass("open");
		else
			parent.addClass("open");
	
	}); 
	
	
	/**
	 * Custom Input Roller
	 */
	$(".input-roller .roll-up").click(function() {
		val = $("input", $(this).closest(".input-roller")).val();
		val++;
		$("input", $(this).closest(".input-roller")).val(val);
	
	}); 
	
	$(".input-roller .roll-down").click(function() {
		val = $("input", $(this).closest(".input-roller")).val();
		if(val > 0) val--;
		$("input", $(this).closest(".input-roller")).val(val);
	
	}); 
	
	
	/**
	 * Button Hover Fix 
	 */
	$(".bridge-btn1").mouseenter(function(){
		$(this).addClass("curvyRedraw");
		DOMObj = this;
		curvyCorners.adjust(DOMObj, 'style.backgroundColor', '#969cba');
		curvyCorners.redraw();
		
	}).mouseleave(function(){
		$(this).removeClass("curvyRedraw");
		DOMObj = this;
		curvyCorners.adjust(DOMObj, 'style.backgroundColor', '#475f8e');
		curvyCorners.redraw();
	});
	
	
	/**
	 * Rounded for IE
	 */
	browser = $.browser;
	if(browser.msie ) {
		
		if(browser.version < 9) {
		
			$(".box-white").each(function(){
				
				$content = '<div class="head"><div class="tl"></div><div class="tr"></div></div><div class="body"><div class="body-r"><div class="content">';
				$content += $(this).html();
				$content += '</div></div></div><div class="foot"><div class="fl"></div><div class="fr"></div></div>';
				
				$(this).html($content);
				//$(this).append($content);
				$(this).addClass("round round-white");
			
			});
			
			$(".rounded-top").each(function() {
				
				$content = '<div class="head"><div class="tl"></div><div class="tr"></div></div><div class="body"><div class="body-r"><div class="content">';
				$content += $(this).html();
				$content += '</div>'; 
				
			}); 
			
		}
		
	}
	
	
	
	/** 
	 * Accordion
	 */ 
	$(".accordion-trigger p").click(function(){
		$("li.open .accordion-content", $(this).closest("ul.accordion")).slideUp(300, function(){
			
		}); 
		$("li", $(this).closest("ul.accordion")).removeClass("open"); 
		$(this).closest("li").addClass("open"); 
		$(".accordion-content", $(this).closest("li")).slideDown(300); 
	
	}); 
	$("ul.accordion li:first-child .accordion-trigger p").trigger("click"); 
	
	
	/**
	 * Extend Textarea
	 */
	$textAreaOrigHeight = 264;
	$("textarea.niceTextarea").keyup(function(){ 
		expandtext(this); 
	});
	
	function expandtext(textArea){
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
	}
	
	
	
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
	$("#sidemenu2 li:first-child a.sidemenu2-title").trigger("click"); 
	
	
	
	
	/**
	 * Home Slider
	 */
	$("#home-slider .control a").hover(function(){
			$("#home-slider .slide .slide-info").animate({ right: 0, opacity: 1 }, 300);
			$(this).addClass("active");  
	},function(){
			$("#home-slider .slide .slide-info").animate({ right: -203, opacity: 0 }, 300);
			$(this).removeClass("active"); 
	}); 
	
	
	/**
	 * Home Tabs
	 */
	$("#home-tabs .tab").each(function() {
		$(this).click(function() {
			
			if(!$(this).hasClass("active")) {
				$("#home-tabs .tab").removeClass("active"); 
				$("#home-tabs .tab-content").removeClass("active").css({opacity: 0}); 
				
				$(this).addClass("active"); 
				$("#" + $(this).attr("id") + "-content").addClass("active").animate({opacity: 1 }, 300); 
			}
			
			else {
				$("#home-tabs .tab").removeClass("active"); 
				$("#home-tabs .tab-content").removeClass("active").css({opacity: 0}); 
			}
			
		
		}); 
	
	}); 
	
	
	/**
	 * Contact Us / FAQ Accordion
	 */
	$("ul.accordion a.toggle").click(function() {
	
		if(!$(this).hasClass("active")) {
			$("ul.accordion li .toggle").removeClass("active"); 
			$("ul.accordion li .toggle-content").css({display: 'none', opacity: 0}); 
			
			$(this).addClass("active"); 
			$(".toggle-content", $(this).closest("li")).css({display: 'block'}).animate({opacity: 1 }, 300); 
		}
		
		else {
			$("ul.accordion li .toggle").removeClass("active"); 
			$("ul.accordion li .toggle-content").css({display: 'none', opacity: 0}); 
		}
		
		return false; 
	
	}); 
	
	
	
	/**
	 * Introtext Slider
	 */
	 
	$("#home-header-introtext").each(function(){
		
		_this = $(this);
		size = _this.children().size();
		curIndex = 0;
		
		$(".slide", _this).css({left: -640}); 
		$(".slide:eq(0)", _this).css({left: 0}); 
		
		sliderIntervalID = setInterval(function(){
				
				curSlide = $(".slide:eq(" + curIndex + ")", _this);
				
				nextIndex = (curIndex+1 == size) ? 0 : curIndex+1;
				nextSlide = $(".slide:eq(" + nextIndex + ")", _this); 
				
				curSlide.animate({left: 640}, 300, function(){
					$(this).css({left: -640}); 
				});
				nextSlide.css({left: -640 }).animate({left: 0}, 300);
			
			if(curIndex < size-1 ) curIndex += 1;
			else curIndex = 0;
			
		}, 3*1000 + 600);
		
	
	}); 
	
});


/**
 * Steps Switcher
 */ 
jQuery.showStep = function($stepCount, $from) {
	jQuery("#croomNewItemStep" + $from).fadeOut(300, function() {
		jQuery("#croomNewItemStep" + $stepCount).fadeIn(300, function() {
			jQuery.fancybox.center();
		}); 
	}); 
	return false; 
}


/**
 * Submit Form
 */
jQuery.submitForm = function() {
	jQuery(this).closest('form').submit(); 
	return false; 
}


/**
 * WenSlide
 */
function wenAnimate(slide, index, thisParent) {
	
	animateLeft = parseInt(jQuery(slide,thisParent).css("left")) - (settings.newsWidth * settings.showItems);
	if (animateLeft + parseInt(jQuery(slide,thisParent).css("width")) > 0) {
		jQuery(slide, thisParent).animate({left: animateLeft}, settings.newsSpeed, function() {
			jQuery(this).css("left",animateLeft);
		});
	} else {
		jQuery(slide, thisParent).animate({left: 0}, settings.newsSpeed, function() {
			jQuery(this).css("left",0);
			jQuery(slide,thisParent).css("left", 0);
		});
	}

}