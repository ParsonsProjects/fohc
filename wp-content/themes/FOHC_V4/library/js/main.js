// Variables
var dd_menu = 	$('.sub-menu, .children');
var nav_a	=	$('nav a');

// Load functions
jQuery(document).load(function($) { 
	// Make window think its being resized
	$(window).resize();
});

// Resize functions
jQuery(window).resize(function($) {
	
}); 

// Ready functions
jQuery(document).ready(function($) { 

	// Menu

	$('.nav > ul').Touchdown();

	// Inputs
	$(this).find('input[type=text]').addClass("idleField");
	$(this).find('input[type=text]').focus(function() {
		$(this).removeClass("idleField").addClass("focusField");
		if (this.value == this.defaultValue){
			this.value = '';
		}
		if(this.value != this.defaultValue){
			this.select();
		}
	});

	$(this).find('input[type=text]').blur(function() {
		if ($.trim(this.value) == ''){
			$(this).removeClass("focusField").removeClass("completeField");
			this.value = (this.defaultValue ? this.defaultValue : '');
		} 
	});
	
	// Inputs with placeholder text
	/*$("'[placeholder]'").focus(function() {
		var input = $(this);
		if (input.val() == input.attr("'placeholder'")) {
			input.val("''");
			input.removeClass("'placeholder'");
		}
	}).blur(function() {
		var input = $(this);
		if (input.val() == "''" || input.val() == input.attr("'placeholder'")) {
			input.addClass("'placeholder'");
			input.val(input.attr("'placeholder'"));
		}
	}).blur();
	
	$("'[placeholder]'").parents("'form'").submit(function() {
		$(this).find("'[placeholder]'").each(function() {
		var input = $(this);
			if (input.val() == input.attr("'placeholder'")) {
				input.val("''");
			}
		})
	});*/
	
	dd_menu.parent().children('a').each( function() {	
		$(this).addClass('dd-menu').wrapInner('<span />');
	});
	
	// Smooth scrolling
	$('.ss').click( function(){
		var id = $(this).attr('href');
		$('html,body').animate({scrollTop: $(id).offset().top - 10},'slow');
		return false;
	});
	
	$("#fohc-tweets").tweet({
		join_text: "auto",
		username: ["3hillssportsprk", "FolkestoneOpsHC"],
		count: 12,
		avatar_size: 36,
		auto_join_text_default: "said,",
		auto_join_text_ed: "",
		auto_join_text_ing: "were",
		auto_join_text_reply: "replied to",
		auto_join_text_url: "were checking out",
		loading_text: "loading tweets...",
		template: "{avatar}{join}{text}{time}"
	});
	
});

