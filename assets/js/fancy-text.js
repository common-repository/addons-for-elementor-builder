(function ($, elementor) {
    'use strict';
    let afeb_widgetFancyText = function ($scope, $) {
        let type_string = function (target, str, cursor, delay, call_back) {
            target.html(function (_, html) {
                return html + str[cursor];
            });

            if (cursor < str.length - 1) {
                setTimeout(function () {
                    type_string(target, str, cursor + 1, delay, call_back);
                }, delay);
            } else {
                call_back();
            }
        }

        let delete_string = function (target, delay, call_back) {
            let length;
            target.html(function (_, html) {
                length = html.length;
                return html.substr(0, length - 1);
            });
            if (length > 1) {
                setTimeout(function () {
                    delete_string(target, delay, call_back);
                }, delay);
            } else {
                call_back();
            }
        }

        let type_output = function (opts) {
            let defaults = { target: null, type_delay: 100, clear_delay: 20, pause: 1500, items: [] };
            let settings = $.extend(defaults, opts);

            let loop = function (target, idx) {
                type_string(target, settings.items[idx], 0, settings.type_delay, function () {
                    setTimeout(function () {
                        delete_string(target, settings.clear_delay, function () { loop(target, (idx + 1) % settings.items.length) });
                    }, settings.pause);
                });
            };

            settings.target.html('');
            loop(settings.target, 0);
        }

        let hide_visible = function (target) {
            let items = target.find('>b');
            if (items.length > 1) target.find('.is-visible').removeClass('is-visible').addClass('is-hidden').siblings().addClass('is-visible').removeClass('is-hidden');
        }

        let hide_visible_interval = function (delay, target) {
            let hv_interval = setInterval(function () {
                hide_visible(target)
            }, delay);

            return hv_interval;
        }

        let falling_effect = function (opts) {
            let defaults = { target: null, top_offset: -35, delay: 40, pause: 2000, anim: 'swing' };
            let settings = $.extend(defaults, opts);
            let items = settings.target.find('b.is-visible').text().split('').map(str => $('<span>' + str + '</span>'));
            let animation = false;

            settings.target.find('b.is-visible').html(items);
            items.forEach(function (elm, i) {
                elm.css({ top: settings.top_offset, opacity: 0 })
                    .delay(settings.delay * i)
                    .animate({ top: 0, opacity: 1 }, 500, settings.anim, function (e) {
                        if (animation == false) {
                            setTimeout(function () {
                                hide_visible(settings.target);
                                falling_effect({
                                    target: settings.target,
                                    top_offset: settings.top_offset,
                                    delay: settings.delay,
                                    pause: settings.pause,
                                    anim: settings.anim
                                })
                            }, settings.pause + (items.length * settings.delay))
                            animation = true;
                        }
                    });
            });
        }

        let init = function ($scope, $) {
            let fancytextwrapper = $scope.find('.afeb-fancy-text-element');
            if (!fancytextwrapper.length) return;

            let settings = fancytextwrapper.data('settings');
            let fancytext = fancytextwrapper.find('.afeb-fancy-text');
            let options = {
                crsr: settings.crsr ? settings.crsr : '_',
                crsr_spd: settings.crsr_spd ? settings.crsr_spd : 200,
                typ_spd: settings.typ_spd ? settings.typ_spd : 100,
                clr_spd: settings.clr_spd ? settings.clr_spd : 20,
                intrupt_tim: settings.intrupt_tim ? settings.intrupt_tim : 1500,
                rtt_1_intrupt: settings.rtt_1_intrupt ? settings.rtt_1_intrupt : 3000,
                flng_ofst: settings.flng_ofst ? settings.flng_ofst : -35,
                flng_spd: settings.flng_spd ? settings.flng_spd : 40,
                flng_intrupt_tim: settings.flng_intrupt_tim ? settings.flng_intrupt_tim : 1500,
            };

            if (fancytextwrapper.hasClass('type')) {
                let items = fancytext.find('b').toArray().map(elem => elem.innerHTML);
                type_output({ target: fancytext, items: items, type_delay: options.typ_spd, clear_delay: options.clr_spd, pause: options.intrupt_tim });
                fancytext.after('<span class="afeb-fancy-text-cursor"></span>');
                type_output({ target: fancytextwrapper.find('.afeb-fancy-text-cursor'), items: [options.crsr, ' '], delay: 0, pause: options.crsr_spd });
            } else if (fancytextwrapper.hasClass('rotate-1')) {
                hide_visible_interval(settings.rtt_1_intrupt, fancytext);
            } else if (fancytextwrapper.hasClass('falling')) {
                falling_effect({ target: fancytext, top_offset: options.flng_ofst, delay: options.flng_spd, pause: options.flng_intrupt_tim });
            }
        }

        init($scope, $);
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/afeb_fancy_text.default', afeb_widgetFancyText);
    });

}(jQuery, window.elementorFrontend));