document.addEventListener('DOMContentLoaded', function(){

	
	
	let productText = document.querySelectorAll('.product-analysis .product-name');	


	productText.forEach(item => {
		if(item.innerText.length > 90){
			item.innerText = item.innerText.slice(0, 108) + '...';
		}
	});


	const isRTL = $('html').attr('dir') == 'rtl';
	const isMobile = $(window).width() < 992;

	if (isRTL) {
		$('.wpcf7').attr('dir','rtl');
	} else{
		$('.wpcf7').attr('dir','ltr');
	}

	function is_touch_device() {
		try {
			document.createEvent("TouchEvent");
			return true;
		} catch (e) {
			return false;
		}
	}

	if(is_touch_device()){
		$('body').addClass('touch');
	} else{
		$('body').addClass('no-touch');
	}


	function getMaxOfArray(numArray) {
		return Math.max.apply(null, numArray);
	}

	$('.checkbox a').click(e => e.stopPropagation());

	$('.pagination-wrapper').each(function(i, el){
		$(el).find('.next').parent().addClass('next');
		$(el).find('.prev').parent().addClass('prev');
	});

	$('.fancybox').fancybox();

	// Page Nav Highlighting
	if ($('.navigation-box').length > 0) {
		// Cache selectors
		let topMenu = $('.navigation-box');

		let lastId,
			topMenuHeight = 0,
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind to scroll
		$(window).scroll(function() {
			let fromTop = $(this).scrollTop() + $(window).height() * 0.5;

			let cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop){
					// if ($(this).offset().top + $(this).outerHeight() > $(window).scrollTop() + $(window).height()) {
						return this;
					// }
				}
			});

			cur = cur[cur.length - 1];
			let id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				menuItems.removeClass("active");
				menuItems.filter("[href='#" + id + "']").addClass("active");
			}
		});
	}

	// Single product
	if ($('body').hasClass('single-products') && $('.container__product').length > 0) {
		function setNavigationPosition() {
			$('.single-products-content > .navigation').css({
				left: $('.container__product').eq(0).offset().left - $('.single-products-content > .navigation').outerWidth()
			});
		}

		setNavigationPosition();

		$(window).resize(setNavigationPosition);
	}

	// Single product
	if ($('.product-page-section').length > 0) {
		const nav = $('.product-page-section .navigation-box');
		const container = $('.product-page-section > .container');

		$(window).scroll(function(){
			if ($(window).width() < 1400) {
				return false;
			}

			const navParams = {
				top: nav.offset().top,
				height: nav.height()
			};

			const containerParams = {
				top: container.offset().top - $('.header').outerHeight() - 15,
				height: container.height(),
				bottom: (container.offset().top + container.outerHeight() - nav.outerHeight())
			}

			if ( $(window).scrollTop() < containerParams.top ) {
				nav.css({
					'transform': `translateY(0px)`
				});
			}

			else if ( $(window).scrollTop() > containerParams.bottom ) {
				nav.css({
					'transform': `translateY(${ containerParams.height - navParams.height }px)`
				});
			}

			else if ( $(window).scrollTop() > containerParams.top && $(window).scrollTop() < containerParams.bottom) {
				nav.css({
					'transform': `translateY(${ $(window).scrollTop() - containerParams.top }px)`
				});
			}
		});
	}

	// keep-me-posted-modal
	let isShowedOnScroll = false;
	let isShowedOnClose = false;

	// $(window).scroll(function(){
	// 	if (!isShowedOnScroll) {
	// 		if ($(window).scrollTop() > 1000) {
	// 			showModal('#keep-me-posted-modal');
	// 			isShowedOnScroll = true;
	// 		}
	// 	}
	// });

	// $(document).on('mouseleave', function(){
	// 	if (!isShowedOnClose) {
	// 		showModal('#popUp');
	// 		isShowedOnClose = true;
	// 	}
	// });

	$(document).on('mousemove', function(e){
		if (e.pageX > ($('.header-inner').offset().left + $('.header-inner').width() + 20) && e.pageY <= 150) {
			if (!isShowedOnClose) {
				showModal('#popUp');
				isShowedOnClose = true;
			}
		}
	});

	// Tabs
	function goToTab(tabId, handler){
		if (handler == undefined) {
			handler = false;
		}

		let dest = $( tabId );
		dest.stop().fadeIn(300).siblings().hide(0);

		$('[data-tab="'+tabId+'"]').addClass('current').siblings().removeClass('current');
	}

	$("[data-tab]").click(function(e){
		e.preventDefault();
		let dest = $(this).data('tab');

		goToTab(dest, $(this));

		// $(dest).find('.slick-slider').slick('setPosition');
	});

	$(".tabs-nav").each(function(i, el){
		$(el).find('[data-tab]').eq(0).click();
	});

	$('.tabs-select').on('change', function(){
		goToTab($(this).val());
	});

	// Accordions
	const toggleAccordion = (el) => {
		let closeText = 'Close accordion';
		let openText = 'Open accordtion';

		let btn = $(el).find('> .ac-header > .ac-opener');

		$(el).find('> .ac-content').stop().slideToggle(300);
		$(el).toggleClass('opened');

		if ( $(el).find('.slick-slider').length > 0 ) {
			$(el).find('.slick-slider').slick('setPosition');
		}

		if ( btn.attr('aria-expanded') == 'false' ) {
			btn.attr({
				'aria-expanded': 'true',
				'aria-label': closeText
			});
		} else{
			btn.attr({
				'aria-expanded': 'false',
				'aria-label': openText
			});
		}
	}

	$('.accordion, .js-accordion').each(function(i, el){
		$(el).find('> .ac-header, > .ac-header > .ac-opener').click(function(e){
			e.preventDefault();
			e.stopPropagation();

			toggleAccordion( $(el) );
		});

		if ($(el).hasClass('opened-on-load')) {
			$(el).find('.ac-header').trigger('click');
		}
	});

	// Sliders
	function equalSlideHeight(slider){
		$(slider).on('setPosition', function () {
			$(this).find('.slick-slide').height('auto');
			var slickTrack = $(this).find('.slick-track');
			var slickTrackHeight = $(slickTrack).height();
			$(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
		});
	}

	let arrowsButtons = {
		prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M.62 14.15l10.6 10.59c.4.41.88.61 1.47.61.6 0 1.08-.2 1.48-.61l1.23-1.22a2.13 2.13 0 000-2.96l-7.9-7.9 7.88-7.88a2.13 2.13 0 000-2.96L14.15.6a2 2 0 00-1.47-.6 2 2 0 00-1.47.6L.6 11.19a2.09 2.09 0 00.02 2.96z"/></svg></button>',
		nextArrow: '<button type="button" class="slick-next" aria-label="Next"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M15.38 11.2L4.78.63C4.38.2 3.9 0 3.3 0c-.6 0-1.08.2-1.48.62L.6 1.83a2.13 2.13 0 000 2.96l7.9 7.9-7.88 7.89a2.13 2.13 0 000 2.96l1.23 1.21c.4.4.9.6 1.47.6a2 2 0 001.47-.6L15.4 14.17c.4-.42.6-.91.6-1.5a2.09 2.09 0 00-.62-1.46z"/></svg></button>'
	}

	$('.testimonials-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		...arrowsButtons
	});

	$('.top-ranked-products-component').each(function(i, cmp){
		const slider = $(cmp).find('.top-categories-slider');
		slider.slick({
			infinite: true,
			slidesToShow: slider.data('slides-count') ? +slider.data('slides-count') : 4,
			slidesToScroll: 1,
			arrows: true,
			prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M.62 14.15l10.6 10.59c.4.41.88.61 1.47.61.6 0 1.08-.2 1.48-.61l1.23-1.22a2.13 2.13 0 000-2.96l-7.9-7.9 7.88-7.88a2.13 2.13 0 000-2.96L14.15.6a2 2 0 00-1.47-.6 2 2 0 00-1.47.6L.6 11.19a2.09 2.09 0 00.02 2.96z"/></svg></button>',
			nextArrow: '<button type="button" class="slick-next" aria-label="Next"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M15.38 11.2L4.78.63C4.38.2 3.9 0 3.3 0c-.6 0-1.08.2-1.48.62L.6 1.83a2.13 2.13 0 000 2.96l7.9 7.9-7.88 7.89a2.13 2.13 0 000 2.96l1.23 1.21c.4.4.9.6 1.47.6a2 2 0 001.47-.6L15.4 14.17c.4-.42.6-.91.6-1.5a2.09 2.09 0 00-.62-1.46z"/></svg></button>',
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2,
						arrows:false
					}
				}
			]
		});
	});

	// Scroll to anchor
	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();

		if ($.attr(this, 'href') === '#') {
			return false;
		}

		let offset = 66;

		if ($(window).width() < 992) {
			offset = 60;
		}

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - offset
		}, 500);
	});

	// Menu opener
	$('.menu-opener').click(function(e){
		e.preventDefault();

		$('.menu-opener').toggleClass('active');
		$('.mobile-top-nav').toggleClass('opened');
		$('.header').toggleClass('nav-opened');
	});

	$('.mobile-top-nav').each(function(i, el){
		$(el).find('.menu-item-has-children > a').click(function(e){
			e.preventDefault();

			$(this).toggleClass('opened').siblings('.sub-menu').stop().slideToggle(300);
		});


	});

	// Sticky Header
	function stickyHeader(){
		let header = document.querySelector('.header');

		if (!!header) {
			window.scrollY > 0
			? header.classList.add('sticky')
			: header.classList.remove('sticky');
		};
	}


	window.addEventListener('scroll', stickyHeader);
	setTimeout(stickyHeader, 100);

	// Sticky Nav
	function stickyNav(){
		const nav = document.querySelector('.navigation-box');

		let offset = 200;

		if ($(window).width() < 576) {
			offset = 0;
		}

		if (!!nav) {
			window.scrollY > offset
			? nav.classList.add('sticky')
			: nav.classList.remove('sticky');
		};
	}


	window.addEventListener('scroll', stickyNav);
	setTimeout(stickyNav, 100);

	// Modals
	$('.modal').css('display','block');

	$('.modal-dialog').click(e => e.stopPropagation());
	$('.modal').click(function(e){
		hideModal( $(this) );
		$('.video-modal .modal-video').html('<div id="modal-video-iframe"></div>');
	});

	$('.modal-close, .js-modal-close').click(function(e){
		e.preventDefault();

		hideModal( $(this).closest('.modal') );
		$('.video-modal .modal-video').html('<div id="modal-video-iframe"></div>');
	});

	$('[data-modal]').click(function(e){
		e.preventDefault();
		e.stopPropagation();

		hideModal('.modal');

		if ($(this).data('modal-tab') != undefined) {
			goToTab($(this).data('modal-tab'));
		}

		showModal( $(this).data('modal') );
	});

	$('[data-video-modal]').click(function(e) {
		e.preventDefault();
		e.stopPropagation();

		let videoId = $(this).data('video-modal');
		let videoType = $(this).data('video-type');

		if (videoType == 'youtube') {
			$('#modal-video-iframe').removeClass('vimeo youtube mp4').addClass('youtube').append('<div class="video-iframe" id="' + videoId + '"></div>');
			createVideo(videoId, videoId);
		} else if (videoType == 'vimeo') {
			$('#modal-video-iframe').removeClass('vimeo youtube mp4').addClass('vimeo').html('<iframe class="video-iframe" allow="autoplay" src="https://player.vimeo.com/video/' + videoId + '?playsinline=1&autoplay=1&transparent=1&app_id=122963">');
		} else if (videoType == 'mp4'){
			$('#modal-video-iframe').removeClass('vimeo youtube mp4').addClass('vimeo').html(`<video src="${videoId}" playsinline autoplay controls></video>`);
		}

		hideModal('.modal');

		showModal("#video-modal");
	});

	var player;

	function createVideo(videoBlockId, videoId) {
		player = new YT.Player(videoBlockId, {
			videoId: videoId,
			playerVars: {
				// 'autoplay':1,
				'autohide': 1,
				'showinfo': 0,
				'rel': 0,
				'loop': 1,
				'playsinline': 1,
				'fs': 0,
				'allowsInlineMediaPlayback': true
			},
			events: {
				'onReady': function(e) {
					// e.target.mute();
					// if ($(window).width() > 991) {
					setTimeout(function() {
						e.target.playVideo();
					}, 200);
					// }
				}
			}
		});
	}

	if (getInternetExplorerVersion() !== -1) {
		$('#lock-screen').addClass('visible');
	}
});


function getScrollWidth() {
	// create element with scroll
	let div = document.createElement('div');

	div.style.overflowY = 'scroll';
	div.style.width = '50px';
	div.style.height = '50px';

	document.body.append(div);
	let scrollWidth = div.offsetWidth - div.clientWidth;

	div.remove();

	return scrollWidth;
}

let bodyScrolled = 0;

function showModal(modal) {
	$(modal).addClass('visible');
	bodyScrolled = $(window).scrollTop();
	$('body, .header').addClass('modal-visible')
		.scrollTop(bodyScrolled)
		.css('padding-right', getScrollWidth());
}

function hideModal(modal) {
	$(modal).removeClass('visible');
	bodyScrolled = $(window).scrollTop();
	$('body, .header').removeClass('modal-visible')
		.scrollTop(bodyScrolled)
		.css('padding-right', 0);
}

function getInternetExplorerVersion() {
	var rv = -1;
	if (navigator.appName == 'Microsoft Internet Explorer') {
		var ua = navigator.userAgent;
		var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null)
			rv = parseFloat(RegExp.$1);
	} else if (navigator.appName == 'Netscape') {
		var ua = navigator.userAgent;
		var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null)
			rv = parseFloat(RegExp.$1);
	}
	return rv;
}


$('.switch-tabs-block').each(function(i, el){
	$(el).find('.left-btn').click(function(e){
		e.preventDefault();

		if ($(this).hasClass('monthly')) {
			$(el).find('.block-middle').removeClass('right');
		} else{
			$(el).find('.block-middle').addClass('right');
		}
	});

	$(el).find('.block-middle').click(function(e){
		e.preventDefault();

		if ($(this).hasClass('right')) {
			$(el).find('.left-btn').eq(0).trigger('click');
		} else{
			$(el).find('.left-btn').eq(1).trigger('click');
		}
	});
});
