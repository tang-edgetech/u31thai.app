$(document).ready(function() {
	$(document).on('click', '#change-language', function (e) {
		e.preventDefault();
		var $button = $(this),
			$body = $('body'),
			$overlay = $('.pll-popup-overlay'),
			$popup = $('.pll-popup');
		setTimeout(function() {
			$button.prop('disabled', false);
		});
		if( $body.hasClass('pll-popup-opened') ) {
			$body.removeClass('pll-popup-opened');
		}
		else {
			$body.addClass('pll-popup-opened');
			$overlay.addClass('active');
			setTimeout(function() {
				$popup.addClass('active');
			}, 150);
			setTimeout(function() {
				$overlay.addClass('show');
			}, 250);
			setTimeout(function() {
				$popup.addClass('show');
			}, 350);
		}
	});
	
	$(document).on('click', '.pll-popup-overlay.active.show', function(e) {
		e.preventDefault();
		var $overlay = $(this),
			$body = $('body'),
			$popup = $('.pll-popup');
		if( $body.hasClass('pll-popup-opened') ) {
			$popup.removeClass('show');
			setTimeout(function() {
				$overlay.removeClass('show');
			}, 150);
			setTimeout(function() {
				$popup.removeClass('active');
			}, 250);
			setTimeout(function() {
				$overlay.removeClass('active');
			}, 350);
		}
	});
	
    if( $('.main-menu-slider')[0] ) {
        $('.main-menu-slider').each(function() {
            var $slider = $(this),
                $swiper = $slider.children('.swiper');
            new Swiper($swiper[0], {
                slidesPerView: 'auto',
                spaceBetween: 10,
                loop: false,
                speed: 600,
                slidesOffsetBefore: 20,
                slidesOffsetAfter: 20,
            });
        });
    }
    
    if( $('.hero-banner-slider')[0] ) {
        $('.hero-banner-slider').each(function() {
            var $slider = $(this),
                $swiper = $slider.children('.swiper'),
                $swiper_id = $swiper.attr('data-swiper-id');
            new Swiper($swiper[0], {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                },
                speed: 600,
                navigation: {
                    nextEl: '.hero-swiper-' + $swiper_id + ' .hero-nav-next',
                    prevEl: '.hero-swiper-' + $swiper_id + ' .hero-nav-prev',
                },
                pagination: {
                    el: '.hero-swiper-' + $swiper_id + ' .herobanner-pagination',
                    clickable: true,
                }
            });
        });
    }
});