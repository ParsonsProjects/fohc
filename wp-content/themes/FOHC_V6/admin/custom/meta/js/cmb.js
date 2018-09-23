/**
 * Controls the behaviours of custom metabox fields.
 *
 * @author Andrew Norcross
 * @author Jared Atchison
 * @author Bill Erickson
 * @author Justin Sternberg
 * @see    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery, tb_show, tb_remove */

/**
 * Custom jQuery for Custom Metaboxes and Fields
 */
jQuery(document).ready(function ($) {
	'use strict';

	var formfield;

	/**
	 * Initialize timepicker (this will be moved inline in a future release)
	 */
	$('.cmb_timepicker').each(function () {
		$('#' + jQuery(this).attr('id')).timePicker({
			startTime: "00:00",
			endTime: "24:00",
			show24Hours: true,
			separator: ':',
			step: 30
		});
	});

	/**
	 * Initialize jQuery UI datepicker (this will be moved inline in a future release)
	 */
	$('.cmb_datepicker').each(function () {
		$('#' + jQuery(this).attr('id')).datepicker();
		// $('#' + jQuery(this).attr('id')).datepicker({ dateFormat: 'yy-mm-dd' });
		// For more options see http://jqueryui.com/demos/datepicker/#option-dateFormat
	});
	// Wrap date picker in class to narrow the scope of jQuery UI CSS and prevent conflicts
	$("#ui-datepicker-div").wrap('<div class="cmb_element" />');

	/**
	 * Initialize color picker
	 */
	if (typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function') {
		$('input:text.cmb_colorpicker').wpColorPicker();
	} else {
		$('input:text.cmb_colorpicker').each(function (i) {
			$(this).after('<div id="picker-' + i + '" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
			$('#picker-' + i).hide().farbtastic($(this));
		})
		.focus(function () {
			$(this).next().show();
		})
		.blur(function () {
			$(this).next().hide();
		});
	}

	// Stop the user being able to edit and save posts
	var postSatus 	= $('#original_post_status').val(),
		post_id 	= $('#post_ID').val();

	listFilter($("#users_unselected .users_header"), $("#users_unselected ul"));
	listFilter($("#users_selected .users_header"), $("#users_selected ul"));

	function listFilter(header, list) {
		var form = $("<form>").attr({"class":"filterform","action":"#"}),
			input = $("<input>").attr({"class":"filterinput","type":"text","value":"Search"});
		$(form).append(input).appendTo(header);

		$(input)
		  	.change( function () {
				var filter = $(this).val();
				if(filter) {
			  		$(list).find(".user_name:not(:Contains(" + filter + "))").parent().slideUp();
			  		$(list).find(".user_name:Contains(" + filter + ")").parent().slideDown();
				} else {
			  		$(list).find("li").slideDown();
				}
				return false;
		  	})
		.keyup( function () {
			$(this).change();
		});
	}

	listFilter($("#header"), $("#list"));
	
	// User select 
	var users_unselected 	= '#select_users #users_unselected ul',
		users_selected 		= '#select_users #users_selected ul',
		select_user 		= '#select_users .select_user';

	// Select all team members
	$('#taxonomy-event_categories input').click( function(){

		var $this 			= $(this),
			$ID				= $this.val(),
			$teamName		= $this.parents('label').text();

		$("<p>Would you like to add or remove all users from this category into the emailing list?</p>").dialog({
		  width: 500,
		  modal: false,
		  title: "Select " + $teamName,
		  buttons: {
		    'Add Users': function() {
		       $(this).dialog('close');
		       $('#users .in-teams-' + $ID).each(function(){

		       		var user_parent 	= $(this).parents('li.user'),
						user_checkbox 	= user_parent.find('input'),
						re_send_email 	= user_parent.find('.re_send_email');

		       		user_parent.fadeOut(function(){
						$(this).find('.select_user').text('Unselect');
						user_parent.appendTo(users_selected).fadeIn();
						user_checkbox.attr('checked','checked');
						re_send_email.show();
					});

			   });
		    },
		    'Remove Users': function() {
		       $(this).dialog('close');
		       $('#users .in-teams-' + $ID).each(function(){

		       		var user_parent 	= $(this).parents('li.user'),
						user_checkbox 	= user_parent.find('input'),
						re_send_email 	= user_parent.find('.re_send_email');

			       	user_parent.fadeOut(function(){
						$(this).find('.select_user').text('Select');
						user_parent.appendTo(users_unselected).fadeIn();
						user_checkbox.removeAttr('checked');
						re_send_email.hide();
					});

			   });
		    },
		    'Neither': function() {
		       $(this).dialog('close');
		    }
		  }
		});

	});

	$(select_user).click(function(){

		var $this 			= $(this),
			user_parent 	= $this.parents('li.user'),
			user_checkbox 	= user_parent.find('input'),
			re_send_email 	= user_parent.find('.re_send_email');

		if(user_checkbox.is(':checked')) {
			user_parent.fadeOut(function(){
				$this.text('Select');
				user_parent.appendTo(users_unselected).fadeIn();
				user_checkbox.removeAttr('checked');
				re_send_email.hide();
			});
		} else {
			user_parent.fadeOut(function(){
				$this.text('Unselect');
				user_parent.appendTo(users_selected).fadeIn();
				user_checkbox.attr('checked','checked');
				re_send_email.show();
			});
		}

		return false;

	});

	// Re-send email
   	$(".re_send_email").click( function() {

   		var $this            = $(this),
            user_id          = $this.attr('data-user_id'),
            email_type       = $this.attr('data-email_type'),
            nonce		     = $this.attr('data-nonce'),
            spinner			 = $this.parents('.actions').find('.spinner');

        spinner.show();
        $this.addClass('button-disabled');
      
		// Everything ok submit ajax
		$.ajax({
			type : "post",
			dataType : "json",
			url : window.ajaxurl,
			data : {
				action          : "re_send_email", 
				user_id         : user_id,
				email_type 		: email_type,
				'post_id': window.cmb_ajax_data.post_id,
				'nonce': nonce
			},
			success: function(response) {
				// If success
				if(response.type == "success") {
					alert(response.feedback);
				}
				spinner.hide();
				$this.removeClass('button-disabled');
			}
		});   

		return false;

   	});

   	if($('#_event_all_day').is(':checked')) {
		$('.cmb_id__event_start_time #_event_start_time_time').hide();
		$('.cmb_id__event_end_time').hide();
	} else {
		$('.cmb_id__event_start_time #_event_start_time_time').show();
		$('.cmb_id__event_end_time').show();
	}

   	$('#_event_all_day').change(function(){
   		if($(this).is(':checked')) {
   			$('.cmb_id__event_start_time #_event_start_time_time').hide();
   			$('.cmb_id__event_end_time').hide();
   		} else {
   			$('.cmb_id__event_start_time #_event_start_time_time').show();
   			$('.cmb_id__event_end_time').show();
   		}
   	});

});