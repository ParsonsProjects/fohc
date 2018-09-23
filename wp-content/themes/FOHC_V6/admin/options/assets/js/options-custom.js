/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		$(Othis).children('div').css('backgroundColor', '#' + hex);
		$(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
	
	// Switches option sections
	$('.group').hide();
	var activetab = '';
	if (typeof(localStorage) != 'undefined' ) {
		activetab = localStorage.getItem("activetab");
	}
	if (activetab != '' && $(activetab).length ) {
		$(activetab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	
	if (activetab != '' && $(activetab + '-tab').length ) {
		$(activetab + '-tab').addClass('tab-active');
	}
	else {
		$('.nav-tabs li:first a').addClass('tab-active');
	}
	$('.nav-tabs li a').click(function(evt) {
		$('.nav-tabs li a').removeClass('tab-active');
		$(this).addClass('tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});
	
	});
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	$('.group .showhidden input:checkbox').click(showHidden);
	$('.group .showhidden input:checkbox').each(showHidden);
				
	function showHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().next().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().next().addClass('hidden')
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	// Toggle slide open + close
	// var toggle = $('.toggle').hide().parents('div.postbox').addClass('closed').find('.close_options').hide();
	
	/* $('div.group').each( function(){
		//$(this).find('div.postbox').first().removeClass('closed').find('.inside').show().parents('div.postbox').find('.close_options').show();
		
		$(this).find('.edit_options').on('click', function(){
			
			var postbox = $(this).parents('div.postbox');
				group	= $(this).parents('div.group');
			
			if( postbox.hasClass('closed') ){
				group.children('div.postbox').addClass('closed');
				group.find('.toggle').slideUp();
				group.find('.close_options').hide();
				postbox.find('.toggle').slideDown();
				postbox.removeClass('closed');
				postbox.find('.close_options').show();
			} else {
				group.find('.close_options').hide();
				postbox.find('.toggle').slideUp();
				group.children('div.postbox').addClass('closed');
			}
			return false;
		});
		
		$(this).find('.close_options').on('click', function(){
			if( ! $(this).parents('div.postbox').hasClass('closed') ){
				$(this).parents('div.postbox').find('.toggle').slideUp();
				$(this).parents('div.postbox').addClass('closed');
				$(this).hide();
			}
		});
	
	}); */
	
});