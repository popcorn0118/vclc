/* =================================
   首頁最新消息
 * ================================== */

jQuery(window).on('load', function () {

    const $newsSlider = jQuery('.js-news-slider');

    if ($newsSlider.length && typeof jQuery.fn.slick !== 'undefined') {

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

    }


    /* =================================
       首頁服務項目
     * ================================== */

    const $servicesSlider = jQuery('.js-services-slider');

    if ($servicesSlider.length && typeof jQuery.fn.slick !== 'undefined') {

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

    }


    /* =================================
       關於我們(專業團隊、事務所環境) - 拖曳捲動
     * ================================== */

    document.querySelectorAll('.js-drag-scroll').forEach((slider) => {

        let isDragging = false;
        let startX = 0;
        let startScrollLeft = 0;

        slider.addEventListener('mousedown', (e) => {

            isDragging = true;
            slider.classList.add('is-dragging');

            startX = e.pageX;
            startScrollLeft = slider.scrollLeft;

        });

        window.addEventListener('mousemove', (e) => {

            if (!isDragging) return;

            e.preventDefault();

            slider.scrollLeft = startScrollLeft - (e.pageX - startX);

        });

        window.addEventListener('mouseup', () => {

            if (!isDragging) return;

            isDragging = false;
            slider.classList.remove('is-dragging');

        });

        slider.addEventListener('mouseleave', () => {

            if (!isDragging) return;

            isDragging = false;
            slider.classList.remove('is-dragging');

        });

    });



    /* =================================
        關於我們影片 - 播放結束顯示 Poster
    * ================================== */

    const $video = jQuery('#about-video video.elementor-video');

    if ($video.length) {
        const video = $video[0];
        $video.on('ended', function () {

            // 關閉 autoplay，避免 load() 後立即再播放
            video.autoplay = false;
            video.removeAttribute('autoplay');

            // 回到影片初始狀態，重新顯示 Poster
            video.load();
        });
    }

});