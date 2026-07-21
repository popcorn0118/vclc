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
       關於我們(專業團隊、事務所環境) - Slick 版本（新版，供客戶選用）
     * ================================== */

    const $aboutSlider = jQuery('.js-about-slider');

    if ($aboutSlider.length && typeof jQuery.fn.slick !== 'undefined') {

        $aboutSlider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            variableWidth: true,
            arrows: true,
            dots: false,
            infinite: false,
            adaptiveHeight: false,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
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


/* =================================
   手機版漢堡選單 - 修正圖示與選單開合不同步的問題

   Astra 內建的手機選單有兩套點擊事件：DOMContentLoaded 就綁定的舊版
   （只切換漢堡鈕的 .toggled class，適用 classic 版型的選單，不適用本站的
   off-canvas 選單）， 以及要等 window load 才會換上、真正負責開合
   #ast-mobile-popup 的新版（但新版不會切換 .toggled class）。
   在影片、圖片等資源下載較久時，window load 明顯延後，使用者容易在
   新版事件生效前點到舊版，導致「圖示變了選單卻打不開」或反過來
   「選單開了圖示卻沒變」。
 * ================================== */

document.addEventListener('DOMContentLoaded', function () {

    // 提前觸發 Astra 內建的選單初始化，不必等到 window load 才換上正確的開合事件。
    document.dispatchEvent(new Event('astLayoutWidthChanged'));

    const mobilePopup = document.getElementById('ast-mobile-popup');
    const menuToggleBtn = document.querySelector('.menu-toggle.main-header-menu-toggle');

    if (mobilePopup && menuToggleBtn) {

        // 讓漢堡鈕的圖示永遠跟著選單「實際開合狀態」走，不受哪一套事件生效影響。
        const syncToggleIcon = function () {
            menuToggleBtn.classList.toggle('toggled', mobilePopup.classList.contains('active'));
        };

        new MutationObserver(syncToggleIcon).observe(mobilePopup, {
            attributes: true,
            attributeFilter: ['class']
        });

    }

});