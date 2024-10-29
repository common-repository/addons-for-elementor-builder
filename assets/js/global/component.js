
if (afeb === undefined) var afeb = {};

jQuery(document).ready(function ($) {
    afeb.Component = {
        init: function () {
            let self = afeb.Component;

            self.accordion();
        },
        accordion: function () {
            afeb.Component.accordionInit = function (object) {
                let self = $(object);

                $(self).accordion({
                    active: self.data('active') || 0,
                    animate: self.data('animate') || {},
                    classes: self.data('classes') || {},
                    collapsible: self.data('collapsible') || true,
                    disabled: self.data('disabled') || false,
                    event: self.data('event') || 'click',
                    header: self.data('header') || '> li > :first-child,> :not(li):even',
                    heightStyle: self.data('height-style') || 'auto',
                    icons: '',
                });
            }

            let accordion = $('.afeb-component-accordion');
            accordion.each(function () {
                afeb.Component.accordionInit($(this));
            });
        }
    }

    afeb.Component.init();
});