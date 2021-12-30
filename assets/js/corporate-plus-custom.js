function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function deleteCookie(cname) {
    createCookie(name, "", -1);
}
jQuery(document).ready(function($){
	document.addEventListener("DOMContentLoaded", function() {
	  var div, n,
		v = document.getElementsByClassName("custom-yt-player");
	  for (n = 0; n < v.length; n++) {
		div = document.createElement("div");
		div.setAttribute("data-id", v[n].dataset.id);
		div.innerHTML = labnolThumb(v[n].dataset.id,v[n].dataset.img);
		div.onclick = labnolIframe;
		v[n].appendChild(div);
	  }
	});
	
	if ($('input[name="SUBURL"]').length > 0 ) {
		$('input[name="SUBURL"]').attr("value",window.location.href);
	}

	function labnolThumb(id,img) {
	  if (img != undefined) {
		var thumb = '<img src="'+img+'" alt="Wim Hof video image">';
	  } else {
		var thumb = '<img src="https://i.ytimg.com/vi/ID/maxresdefault.jpg" alt="Revuze image">';
	  }
	  var play = '<div class="play"></div>';
	  return thumb.replace("ID", id) + play;
	}

	function labnolIframe() {
	  var iframe = document.createElement("iframe");
	  var embed = "https://www.youtube.com/embed/ID?autoplay=1";
	  iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
	  iframe.setAttribute("frameborder", "0");
	  iframe.setAttribute("allowfullscreen", "1");
	  this.parentNode.replaceChild(iframe, this);
	}
	$('input[name="SUBURL"]').val(window.location.href);
	
    $('#at-banner-slider a').click(function(e) {
        window.location.href = $(this).attr('href');
    })
    function homeFullScreen() {

        var homeSection = $('#at-banner-slider');
        var windowHeight = $(window).outerHeight();

        if (homeSection.hasClass('home-fullscreen')) {

            $('.home-fullscreen').css('height', windowHeight);
        }
    }
    //make slider full width
   // homeFullScreen();

    //window resize
    $(window).resize(function () {
        //homeFullScreen();
    });

    $(window).load(function () {
        $('.at-featured-text-slider').show().bxSlider({
            auto: true,
            pager: false,
            mode: 'fade',
            prevText: '<i class="fa fa-angle-left fa-3x"></i>',
            nextText: '<i class="fa fa-angle-right fa-3x"></i>',
            onSliderLoad: function(currentIndex) {
                $('.at-featured-text-slider').children().eq(currentIndex + 1).addClass('active');
            },
            onSlideAfter: function($slideElement){
                $('.at-featured-text-slider').children().removeClass('active');
                $slideElement.addClass('active');
            }
        });

        /*image slider*/
        $('.image-slider-container').each(function(){
            var at_featured_img_slider = $(this);
            at_featured_img_slider.show().bxSlider({
                auto: true,
                pager: false,
                mode: 'fade',
                prevText: '<i class="fa fa-angle-left fa-3x"></i>',
                nextText: '<i class="fa fa-angle-right fa-3x"></i>',
                onSlideBefore: function($slideElement) {
                    $('.image-slider-wrapper .bx-controls').hide();
                },
                onSlideAfter: function($slideElement){
                    $('.image-slider-wrapper .bx-controls').show();
                    at_featured_img_slider.stopAuto();
                    at_featured_img_slider.startAuto();
                }
            });
        });

        /*parallax*/
        jQuery('.at-parallax,.inner-main-title').each(function() {
            jQuery(this).parallax('center', 0.2, true);
        });

        /*parallax scolling*/
        $('a[href*="#"]').click(function(event){
            event.preventDefault();
            console.log($(this).attr('href').length);
            if ($(this).attr('href').length > 2) {
                $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top - $('.at-navbar').height()+1
            }, 1000);      
            }
                  
        });

        /*bootstrap sroolpy*/
        $("body").scrollspy({target: ".navbar-fixed-top", offset: $('.at-navbar').height() + 70 } );
    });

    function stickyMenu() {
        var scrollTop = $(window).scrollTop();
        var offset = 0;

        if ( scrollTop > offset ) {
            $('#navbar').addClass('navbar-small');
            $('.navbar-header .custom-logo-link img').attr('src', '/wp-content/uploads/2021/05/Logo.svg');
            $('.sm-up-container').show();
            $('.scroll-wrap').hide();
        }
        else {
            $('#navbar').removeClass('navbar-small');
            if (!$('#navbar').hasClass('header-white') && !$('#navbar').hasClass('header-orange')) {            
            	$('.navbar-header .custom-logo-link img').attr('src', '/wp-content/uploads/2021/05/Logo_White.svg');
            }
            $('.sm-up-container').hide();
            $('.scroll-wrap').show();
        }
    }
	
	$('#navbar').on('mouseover',function() {
		if ($(window).scrollTop() < 2)  {
			$('#navbar').addClass('navbar-small');
			$('.navbar-header .custom-logo-link img').attr('src', '/wp-content/uploads/2021/05/Logo.svg');
		}
		
	})
	$('#navbar').on('mouseout',function() {
		if ($(window).scrollTop() < 2)  {
			$('#navbar').removeClass('navbar-small');
			if (!$('#navbar').hasClass('header-white') && !$('#navbar').hasClass('header-orange')) {            
				$('.navbar-header .custom-logo-link img').attr('src', '/wp-content/uploads/2021/05/Logo_White.svg');
			}
		}
	})
    //What happen on window scroll
    stickyMenu();
    $(window).on("scroll", function (e) {
        setTimeout(function () {
            stickyMenu();
        }, 300)
    });
});

(function($) {
    $(document).ready(function(){
//     if ($('#navbar').hasClass('header-white')) {
//     	$('.navbar-header .custom-logo-link img').attr('src', '/wp-content/uploads/2021/05/Logo.svg');
// 		$('.navbar-header .custom-logo-link img').attr('data-lazy-src', '/wp-content/uploads/2021/05/Logo.svg');
//     }
    if ($('.video-button').length > 0 ) {
    	$('.video-button a').append('<span>Watch Video</span>')
    }
    
		$('.vc_tta-panel-heading a').click(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var grandParent = $(this).closest('.vc_row');
            grandParent.find('.vc_tta-tabs-list li.vc_active').removeClass('vc_active');
            $(this).parent().addClass('vc_active');
            grandParent.find('.vc_tta-panel.vc_active').removeClass('vc_active');
            $($(this).attr('href')).toggleClass('vc_active');
        });
        $('.product-section-tabs .vc_tta-tabs-list li a,.big-tabs .vc_tta-tabs-list li a').click(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var grandParent = $(this).closest('.vc_row');
            grandParent.find('.vc_tta-tabs-list li.vc_active').removeClass('vc_active');
            $(this).parent().addClass('vc_active');
            grandParent.find('.vc_tta-panel.vc_active').removeClass('vc_active');
            $($(this).attr('href')).addClass('vc_active');
        });

        
        
        $('.navbar-toggle').click(function(e) {
            e.preventDefault();
            $(this).closest('.navbar').toggleClass('menu-opened');
        });
        if ($(window).width() < 1025) {
            $('.menu-item-has-children > a').after('<a class="open-submenu"><i class="fa fa-chevron-down"></i></a>');
            setTimeout(function() {
                $('.menu-item-has-children > a.open-submenu').click(function(e) {
                    e.preventDefault();
                    console.log('submenu-open clicked');
                    $(this).parent().find('.sub-menu').toggleClass('submenu-opened');
                })
            },100)
        }
        
    })
    $(window).resize(function() {
    setTimeout(function() {
        if ($(window).width() < 1025) {
                if ($('.open-submenu').length < 1) {
                $('.menu-item-has-children > a').each(function() {
                    $(this).after('<a class="open-submenu"><i class="fa fa-chevron-down"></i></a>');
                })
                setTimeout(function() {
                    $('.menu-item-has-children > a.open-submenu').click(function(e) {
                        e.preventDefault();
                        $(this).parent().find('.sub-menu').toggleClass('submenu-opened');
                    })
                },100)
            }
        } else {
            $('.menu-item-has-children .open-submenu').remove();
        }
        },100)
    })
	
	$('.blog-loadmore').click(function(e){
 		e.preventDefault();
		
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : loadmore_params.current_page
		};
 		console.log(loadmore_params.posts);
		$.ajax({ // you can also use $.post here
			url : loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				console.log(data);
				if( data ) { 
					
					button.text( 'More posts' ).prev().before(data); // insert new posts
					loadmore_params.current_page++;
 
					if ( loadmore_params.current_page == loadmore_params.max_page ) {
						$('#main').append(data);
						button.remove(); // if last page, remove the button
					}
						
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			},
			error: function( data ) {
				console.log('error');
			}
		});
	});
	
	$(".range-wrap input[type=range]").on('mousemove change', function (e) {
		var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
		var percent = val * 100;

		$(this).css('background-image',
			'-webkit-gradient(linear, left top, right top, ' +
			'color-stop(' + percent + '%, #FF8C2E), ' +
			'color-stop(' + percent + '%, #DBDBFF)' +
			')');
		$(this).closest('.range-wrap').find('input[type=text]').val($(this).val());
		$(this).closest('.range-wrap').find('.range-value').text($(this).val());
		$(this).closest('.range-wrap').find('.range-value').css({
			'left' : percent + '%',
			'transform' : 'translate('+ -percent +'%)',
		});
		$(this).css('background-image',
			'-moz-linear-gradient(left center, #FF8C2E 0%, #FF8C2E ' + percent + '%, #F5D0CC ' + percent + '%, #DBDBFF 100%)');
	});
	$(".range-wrap input[type=text]").on('change input' , function() {
		$(this).closest('.range-wrap').find('input[type=range]').val($(this).val());
		$(this).closest('.range-wrap').find('.range-value').text($(this).val());
		$(".range-wrap input[type=range]").trigger('change');
	})
	
})(window.jQuery);


