(function ($, elementor) {
    'use strict';
    let afeb_widgetCountdown = function ($scope, $) {
        let fill_zero = function (number) {
            return number < 10 ? '0' + number : number;
        }

        let init = function ($scope, $) {
            let countdown = $scope.find('.afeb-countdown');
            if (!countdown.length) return;

            let settings = countdown.data('settings');
            let count_down_date = new Date(parseInt(settings.mmDate)).getTime();
            let interval = setInterval(function () {
                let current_time = new Date().getTime();
                let distance = parseInt(count_down_date) - parseInt(current_time);
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                let count_down_timer = countdown.find('.afeb-countdown-timer');

                count_down_timer.find(' > .afeb-countdown-days .afeb-countdown-number').text(fill_zero(days));
                count_down_timer.find(' > .afeb-countdown-hours .afeb-countdown-number').text(fill_zero(hours));
                count_down_timer.find(' > .afeb-countdown-minutes .afeb-countdown-number').text(fill_zero(minutes));
                count_down_timer.find(' > .afeb-countdown-seconds .afeb-countdown-number').text(fill_zero(seconds));

                if (distance < 0) {
                    clearInterval(interval);
                    if (settings.displayMessage != 0) {
                        count_down_timer.html(settings.displayMessage);
                    }
                    settings.hideElement.hide();
                }
            }, 1000);
        }

        init($scope, $);
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/afeb_countdown.default', afeb_widgetCountdown);
    });

}(jQuery, window.elementorFrontend));