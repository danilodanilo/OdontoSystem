$(document).ready(function() {

 		$.preloadCssImages();
	
		$(".dropdown ul").parent("li").addClass("parent");
		$(".dropdown li:first-child").addClass("first");
		$(".dropdown li:last-child").addClass("last");
		$(".dropdown li:only-child").removeClass("last").addClass("only");	
		$(".dropdown .current-menu-item, .dropdown .current-menu-ancestor").prev().addClass("current-prev");		

		$("ul.tabs").tabs("> .tabcontent", {
			tabs: 'li', 
			effect: 'fade'
		});
		
	$(".recent_posts li:odd").addClass("odd");
	$(".popular_posts li:odd").addClass("odd");
	$(".widget-container li:even").addClass("even");

// cols
	$(".row .col:first-child").addClass("alpha");
	$(".row .col:last-child").addClass("omega"); 	


// toggle content
	$(".toggle_content").hide(); 
	
	$(".toggle").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	
	$(".toggle").click(function(){
		$(this).next(".toggle_content").slideToggle(300,'easeInQuad');
	});
	
	$(".table-pricing tr:even").addClass("even");

// gallery
	$(".gl_col_2 .gallery-item::nth-child(2n)").addClass("nomargin");
	
// pricing
	$(".table-pricing td.table-row-title:even").addClass("even");

// buttons	
	if (!$.browser.msie) {
		$(".button_styled").hover(function(){
			$(this).stop().animate({"opacity": 0.8});
		},function(){
			$(this).stop().animate({"opacity": 1});
		});
		$(".button_link").hover(function(){
			$(this).stop().animate({"opacity": 0.8});
		},function(){
			$(this).stop().animate({"opacity": 1});
		});
	}

});
// scroll to top
$(function () {  
     $(window).scroll(function () {  
         if ($(this).scrollTop() != 0) {  
             $('.link-top').fadeIn();  
         } else {  
             $('.link-top').fadeOut();  
         }  
     });  
     $('.link-top').click(function () {  
         $('body,html').animate({  
             scrollTop: 0  
         },  
         1500);  
     });  
 });
