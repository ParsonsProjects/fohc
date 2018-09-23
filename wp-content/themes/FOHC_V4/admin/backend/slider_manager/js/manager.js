jQuery(document).ready(function($) {
	
	// Toggle slide open + close
	var toggle = $('.toggle').hide().parents('li.slide').addClass('closed');;
	
	$('.edit_slide').on('click', function(){
		if( $(this).parents('li.slide').hasClass('closed') ){
			$('li.slide').addClass('closed');
			$('.toggle').slideUp();
			$(this).parents('li.slide').find('.toggle').slideDown();
			$(this).parents('li.slide').removeClass('closed');
		} else {
			$(this).parents('li.slide').find('.toggle').slideUp();
			$(this).parents('li.slide').addClass('closed');
		}
		return false;
	});

	// Change slide title
	$('#manager_wrap ul li.slide').each( function(){
		$(this).find('.slide_title').keyup(function(){
			if( $(this).val() ) {
				$(this).parents('li.slide').find('h3 span').text($(this).val());
			} else { 
				$(this).parents('li.slide').find('h3 span').text('No Title');
			}
		});
	});
	
	// Add new slide	
	$('#manager_wrap #add-li').on('click', function(){
		
		//var cloneIndex = $(".slide").length+1;
		var ul = $('#manager_wrap ul');
		
		ul.find('li:first').clone(true)
		.appendTo(ul).each( function(){
			$(this).addClass('closed');
			$(this).find('input').attr('value','');
			$(this).find('input.slide_title').attr('value','Slide Title');
			$(this).find('img').attr('src','');
			$(this).find('textarea').text('');
			$(this).find('h3 span').text('Slide Title');
			$(this).find('.custom_upload_image_button').text('Choose Image');
		});
		
		//cloneIndex++;		
		return false;
	});
	
	// slide delete button
	$('#manager_form_wrap li.slide .remove_slide').on('click', function() {
		if($('#manager_form_wrap li.slide').size() == 1) {
			alert('Sorry, you need at least one slide');	
		}
		else {
			$(this).parents('li.slide').slideUp(300, function() {
				$(this).remove();	
			})	
		}
		return false;
	});
	
	// jQuery UI sortable
	$("#manager_form_wrap").sortable({
			placeholder: 'slide-highlight'
	});
	
	
	// Upload image
	upload();
	
	function upload() {
		
		$('.custom_upload_image_button').on('click', function() {
		formfield 	= $(this).parents('li.slide').find('.slide_id'); // ID
		preview		= $(this).parents('li.slide').find('.custom_preview_image'); // URL
		imagename 	= $(this).parents('li.slide').find('.slide_src'); // NAME
		uploadbtn	= $(this).parents('li.slide').find('.custom_upload_image_button'); // UPLOAD BTN
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = $('img',html).attr('src'); // URL
			classes = $('img', html).attr('class'); // CLASS
			filename = imgurl.replace(/.*\// , ''); // NAME
			id = classes.replace(/(.*?)wp-image-/, ''); // ID
			formfield.val(id); // ID
			preview.attr('src',imgurl); // URL
			imagename.val(imgurl); // NAME
			tb_remove();
			uploadbtn.text('Change Image');
		}
		return false;
		});
	
		$('.custom_clear_image_button').on('click', function() {
			var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
			$(this).parents('li.slide').find('.slide_id').val('');
			$(this).parents('li.slide').find('.custom_preview_image').attr('src','');
			$(this).parents('li.slide').find('.slide_src').val('');
			$(this).siblings('.regular-text').attr('value', '');
			$(this).parents('li.slide').find('.custom_upload_image_button').text('Choose Image');
			return false;
		});
		
	}
	
});