	
	
	$(document).ready(function(){

		// Toggle Nav 
		$('.toggle-nav').click(function(){
			$(this).next('nav').toggleClass('open');
		});

		// Nav dropdowns
		$('nav ul li').on('mouseenter', function(){

			var $children 	= $(this).children('ul');

			$children.slideDown();

		});

		$('nav ul li').on('mouseleave', function(){

			var $children 	= $(this).children('ul');

			$children.stop().hide();

		});

		// Cookies
		var $news = $('#news').text();	

		if($.cookie('news_cookie') != $news || $.cookie('news_cookie') == '') {
			$.removeCookie("news_cookie", { path: '/' });
			$('#news').show();
		}

		if ($.cookie('news_cookie') == $news){
			$('#news').hide();
		}

		$('#news .close').click(function(){
			$('#news').slideUp();
			$.cookie('news_cookie', $news, { expires: 365, path: '/' })
			return false;
		});

		var $cookies = $('#cookies').text();

		if($.cookie('cookies') != $cookies || $.cookie('cookies') == '') {
			$.removeCookie("cookies", { path: '/' });
			$('#cookies').show();
		}

		if ($.cookie('cookies') == $cookies){
			$('#cookies').hide();
		}

		$('#cookies .close').click(function(){
			$('#cookies').slideUp();
			$.cookie('cookies', $cookies, { expires: 365, path: '/' });
			return false;
		});

		// Run modal box
		$('[data-toggle="modal"]').modalBox();
		
		// Run slider if HTML is there
		if($('.slideshow').length > 0){

			 $(".slideshow").owlCarousel({
				 
				navigation : true, // Show next and prev buttons
				pagination : false,
				 
				slideSpeed : 300,
				paginationSpeed : 400,
				autoPlay: true,
				 
				items : 1,
				itemsDesktop : false,
				itemsDesktopSmall : false,
				itemsTablet: false,
				itemsMobile : false
				 
			});

			// var owl = $("#secondary-banner").data('owlCarousel');

			// owl.stop();

		}

		// Tabs
		$('.tabs-nav a').click(function(){

			var $this = $(this),
				href = $this.attr('href');

			if(!$this.hasClass('active')) {
				$this.parents('.tabs').find('.tabs-nav li').removeClass('active');
				$this.parents('.tabs').find('.tabs-pane').removeClass('active');
				$this.parents('.tabs').find(href).addClass('active');
				$this.parents('li').addClass('active');
			}

			return false;

		});

		// Teams
		$('.team').each(function(){

			var $this 		= $(this),
				parent 		= $this.parents('.teams'),
				close 		= parent.find('.close');

			$this.click(function(){

				parent.addClass('one');
				$this.addClass('in');

			});

			close.click(function(){

				parent.removeClass('one');
				$this.removeClass('in');

			});

		});

		// Days
		$('.day').each(function(){

			var $this 		= $(this),
				parent 		= $this.parents('.days'),
				close 		= parent.find('.close');

			$this.click(function(){

				parent.addClass('one');
				$this.addClass('in');

			});

			close.click(function(){

				parent.removeClass('one');
				$this.removeClass('in');

			});

		});
			
	});
	

	// Simple modal box, as we dont want any confliction with other ones on the site.
	$.fn.modalBox = function(options){
	  
	  	// Defaults fixed or not
		var defaults = {
			fixed: false
		};

		// Set some variables
		var options = $.extend(defaults, options);	
		var $window = $(window);
			/*widget 	= $('.aftersales-widget'),
			widgetO = widget.offset();
			widgetT = widgetO.top;

		// On window resize check that the dialog box isnt stretching the body
		$window.resize(function() {

			var onScreen = isOnScreen(widget);
			
			if(onScreen == false) {
				$('body,html').scrollTop(widgetT);
			}

		});*/

		// Loop through each modal link
		$(this).each( function(){

			// Set some more variables
			var $this 			= $(this),
				href 	 		= $this.attr('href'),
				modalBox 		= $(href),
				modalBoxHeight 	= modalBox.outerHeight(),
				modalBg 		= $('.modal-overlay'),
				dismissModal 	= modalBox.find('[data-dismiss="modal"]'),
				fixed 			= defaults.fixed || $this.attr('data-fixed'), // If data attr or plugin option set fixed
				topPadding		= 35;
				windowAnimate	= $window.scrollTop() + topPadding;
				windowPos		= $window.scrollTop() - modalBoxHeight;

			// Click on modal link
			$this.click( function(){

				showModal();

				return false;

			});

			// Click on close modal
			dismissModal.click( function(){

				closeModal();

				return false;

			});

			// When scolling keep modal in view
			$window.scroll(function() {

				fixedModal();

			});			

			// Fixed modal
			function fixedModal(){

				// If modal has fixed class then scroll to the top of viewport
				if (modalBox.hasClass('modal-fixed') && modalBox.hasClass('modal-in')) {

			        modalBox.stop().animate({
		                top: $window.scrollTop() + topPadding
		            }, 500, function() {
						// Animation complete.
					});
				    
				}

			}

			// Show modal
			function showModal(){

				// Update window top variables
				windowAnimate	= $window.scrollTop() + topPadding;
				windowPos		= $window.scrollTop() - modalBoxHeight - 200;

				// If modal is visible
				if (!modalBox.is(':visible')) {

					// If fixed seeting is true then add class
					if (fixed == 'true' || fixed == true) {
						modalBox.addClass('modal-fixed');
					} else {
						modalBox.removeClass('modal-fixed');
					}

					// Stop all animations and slide in modal
					modalBox.stop().addClass('modal-in').show().css({'top':windowPos + 'px'}).animate({
						top: windowAnimate + 'px'
					}, 500, function() {
						// Animation complete.
					});

					// Show backdrop
					modalBg.fadeIn();

				}

			}

			// Close modal
			function closeModal(){

				// Update window variables
				windowPos		= $window.scrollTop() - modalBoxHeight - 200;

				// Find any visible modal and slide up
				$('.modal-box:visible').removeClass('modal-in').stop().animate({
					top: windowPos + 'px'
				}, 500, function() {
					$(this).css({'top':'0px'}).hide();
				});

				// Hide backdrop
				modalBg.fadeOut();

			}

		});	 

		// Detect if element is on screen 
		function isOnScreen(el){
		    
		    var win = $(window),
		    	$this = el;
		    
		    var viewport = {
		        top : win.scrollTop(),
		        left : win.scrollLeft()
		    };
		    viewport.right = viewport.left + win.width();
		    viewport.bottom = viewport.top + win.height();
		    
		    var bounds = $this.offset();
		    bounds.right = bounds.left + $this.outerWidth();
		    bounds.bottom = bounds.top + $this.outerHeight();
		    
		    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
		    
		};	
	  
	};

