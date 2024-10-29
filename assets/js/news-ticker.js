(function ($, elementor) {
    'use strict';
    let afeb_widgetNewsTicker = function ($scope, $) {

        let init = function ($scope, $) {
            let newsticker = $scope.find('.afeb-news-ticker-wrapper');
            if (!newsticker.length) return;

            let settings = newsticker.data('settings');
            let options = {
                slidesPerView: 1,
                observeParents: true,
                spaceBetween: 60,
                navigation: {
                    nextEl: `.afeb-swiper-news-ticker-${settings.id} .afeb-items-swiper-button-next`,
                    prevEl: `.afeb-swiper-news-ticker-${settings.id} .afeb-items-swiper-button-prev`
                },
                breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 15 },
                    768: { slidesPerView: 1, spaceBetween: 30 },
                    1024: { slidesPerView: 1, spaceBetween: 60 }
                }
            };

            if (settings.loop) options.loop = settings.loop;
            if (settings.autoPlay) {
                options.autoplay = {
                    delay: settings.transitionDuration,
                    disableOnInteraction: false,
                }
            }

            new Swiper(`.afeb-swiper-news-ticker-${settings.id}`, options);
        }

        init($scope, $);
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/afeb_news_ticker.default', afeb_widgetNewsTicker);
    });

}(jQuery, window.elementorFrontend));