(function ($, elementor) {
    'use strict';
    let afeb_widgetTCarousel = function ($scope, $) {

        let init = function ($scope, $) {
            let tcarousel = $scope.find('.afeb-testimonial-carousel');
            if (!tcarousel.length) return;

            let settings = tcarousel.data('settings');
            let options = {
                slidesPerView: settings.slides_per_view,
                spaceBetween: 20,
                breakpoints: {
                    640: {
                        slidesPerView: settings.mobile_per_view,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: settings.tablet_per_view,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: settings.slides_per_view,
                        spaceBetween: 20,
                    }
                }
            };

            if (settings.show_pagination) {
                options.pagination = {
                    el: `.afeb-testimonial-carousel-${settings.id} .afeb-tc-swiper-pagination`,
                    clickable: true,
                }
                if (settings.pagination_type !== 'default') {
                    options.pagination.type = settings.pagination_type;
                }
            }

            if (settings.navigation) {
                options.navigation = {
                    nextEl: `.afeb-testimonial-carousel-${settings.id} .afeb-tc-swiper-button-next`,
                    prevEl: `.afeb-testimonial-carousel-${settings.id} .afeb-tc-swiper-button-prev`,
                }
            }

            if (settings.loop) options.loop = settings.loop;
            if (settings.autoPlay) {
                options.autoplay = {
                    delay: settings.transitionDuration,
                    disableOnInteraction: false,
                }
            }

            new Swiper(`.afeb-testimonial-carousel-${settings.id}`, options);
        }

        init($scope, $);
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/afeb_testimonial_carousel.default', afeb_widgetTCarousel);
    });

}(jQuery, window.elementorFrontend));