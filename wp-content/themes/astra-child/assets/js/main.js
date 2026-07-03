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
        dots: true,
        infinite: true,
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
                    slidesToShow: 1
                }
            }
        ]
    });

});