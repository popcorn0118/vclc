/* =================================
   首頁最新消息
 * ================================== */

jQuery(window).on('load', function () {

    const $newsSlider = jQuery('.js-news-slider');

    if (!$newsSlider.length) return;

    if (typeof jQuery.fn.slick === 'undefined') return;

    $newsSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        infinite: false,
        adaptiveHeight: false,
        responsive: [
            {
                breakpoint: 921,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                }
            }
        ]
    });



/* =================================
   首頁服務項目
 * ================================== */

    const $servicesSlider = jQuery('.js-services-slider');

    if (!$servicesSlider.length) return;

    if (typeof jQuery.fn.slick === 'undefined') return;

    $servicesSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        infinite: false,
        adaptiveHeight: false,
        responsive: [
            {
                breakpoint: 921,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });

});