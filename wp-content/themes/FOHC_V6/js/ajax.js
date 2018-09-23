jQuery(document).ready( function() {

   // Declined leave reason
   $('#decline_event').click( function(){

      $('.btns').hide();
      $('.declined_reason').show();

      $('.declined_reason .cancel').click(function(){

         $('.declined_reason').hide();
         $('.btns').show();

         return false;

      });

      return false;

   });

   $('#get-directions').click( function() {

      $(this).next().toggle();

      return false;

   });

   $(".user_attendance").click( function() {

      // Some vars
      var   $this             = $(this),
            user_id           = $this.attr('data-user_id'),
            post_id           = $this.attr('data-post_id'),
            attendance        = $this.attr('data-attendance'),
            total_count       = $this.attr('data-total'),
            nonce             = $this.attr('data-nonce'),
            declined_reason   = $('#declined_reason_input'),
            meet_location     = $this.attr('id');

      // If declined and textarea empty do not submit
      if($this.attr('id') == 'declined_event_submit' && declined_reason.val() == '') {

         // Show error fields
         declined_reason.parents('.control-group').addClass('error').find('.alert-danger').show();

         return false;

      }

      $('body').append('<div class="loading-bg"><div>');
      
      // Everything ok submit ajax
      $.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {
            action          : "user_attendance", 
            post_id         : post_id, 
            user_id         : user_id, 
            attendance      : attendance, 
            total           : total_count, 
            declined_reason : declined_reason.val(), 
            meet_location   : meet_location, 
            nonce           : nonce
         },
         success: function(response) {
            // If success
            if(response.type == "success") {

               // Some vars back from the ajax call
               var   $accepted_count   = response.accepted_count,
                     $declined_count   = response.declined_count,
                     $total_count      = response.total_count,
                     $inactive_count   = ($declined_count + $accepted_count) - $total_count,
                     $inactive_count   = Math.abs($inactive_count),
                     $declined_percent = Math.floor(($declined_count / $total_count) * 100),
                     $accepted_percent = Math.floor(($accepted_count / $total_count) * 100),
                     $inactive_percent = Math.floor(($inactive_count / $total_count) * 100);

               var   accepted_el = $('.accepted_count'),
                     declined_el = $('.declined_count'),
                     inactive_el = $('.inactive_count'),
                     accepted_el_no = accepted_el.find('.no'),
                     declined_el_no = declined_el.find('.no'),
                     inactive_el_no = inactive_el.find('.no'),
                     accepted_el_percent = accepted_el.find('.percent'),
                     declined_el_percent = declined_el.find('.percent'),
                     inactive_el_percent = inactive_el.find('.percent'),
                     user_feedback = $('.user_feedback');

               // If user accepted
               if(response.feedback == "accepted") {

                  user_feedback.removeClass('alert-danger').addClass('alert alert-info').text('You are attending'); // Alert the user with their status
                  $('.users_invited #user_' + user_id).find('.user_status').text('Accepted');

               }

               // If user declined
               if(response.feedback == "declined") {

                  user_feedback.removeClass('alert-info').addClass('alert alert-danger').text('You have declined'); // Alert the user with their status
                  $('.users_invited #user_' + user_id).find('.user_status').text('Declined');

               }

               accepted_el.width($accepted_percent + '%');
               declined_el.width($declined_percent + '%');
               accepted_el_no.text($accepted_count); 
               declined_el_no.text($declined_count);
               accepted_el_percent.text($accepted_count + ' (' + $accepted_percent + '%)');
               declined_el_percent.text($declined_count + ' (' + $declined_percent + '%)');

               if($accepted_count == '0') {
                  accepted_el_no.text(''); 
                  accepted_el_percent.text('');
               }

               if($declined_count == '0') {
                  declined_el_no.text(''); 
                  declined_el_percent.text('');
               }

               // Change active count
               inactive_el.css('width', $inactive_percent + '%');
               inactive_el_no.text($inactive_count);
               inactive_el_percent.text($inactive_count + ' (' + $inactive_percent + '%)');

               $('.loading-bg').fadeOut('normal', function(){ 
                  $(this).remove();
               });

               // $('.btns').remove();

            } else {

               $('.user_feedback .status').addClass('alert alert-danger').text('Your attendance could not be added'); // Alert the user that it didnt work

            }

         }
      });   

      return false;

   });

});