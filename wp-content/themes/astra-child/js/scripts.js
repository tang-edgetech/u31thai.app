$(document).ready(function() {
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