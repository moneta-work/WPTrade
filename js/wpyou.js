// SubNavigation
$(function(){
	$(".navi li").hover(function(){
		$(this).find('ul:first').slideDown("fast").css({visibility: "visible",display: "block"});
	},function(){
		$(this).find('ul:first').slideUp("fast").css({visibility: "hidden"});
	});
});
// SubCategories
$(function() {
	$(".widget_categories ul li").hover(function(){
		$(this).find('ul:first').slideDown("fast").css({visibility: "visible",display: "block"});
	},function(){
		$(this).find('ul:first').slideDown("fast").css({visibility: "hidden"});
	});
});
//SearchForm
$(document).ready(function(){				   
	$('.searchInput').focus(
		function() {
			if($(this).val() == 'Keywords') {
				$(this).val('').css({color:"#222"});
			}
		}
	).blur(
		function(){
			if($(this).val() == '') {
				$(this).val('Keywords').css({color:"#787878"});
			}
		}
	);
});
// Menu First li nb
$(function() {
	$(".navi li:first").addClass("nl"); // HeaderMenu First li no border
	$(".footpage li:first").addClass("nb"); // FooterMenu First li no border
});