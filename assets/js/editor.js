jQuery(document).ready(function ($) {
    elementor.on("panel:init", function () {
        let afeb_extensionGoingup = function (newValue) {
            let attrs = this.model.attributes;
            let data = {
                afeb_gup_ic: attrs.afeb_gup_ic,
                afeb_gup_ttl_sh: attrs.afeb_gup_ttl_sh,
                afeb_gup_ttl: attrs.afeb_gup_ttl
            }

            $("#elementor-preview-iframe")[0].contentWindow.postMessage(data);
        }
        let changeHandler = ['afeb_gup_ic', 'afeb_gup_ttl_sh', 'afeb_gup_ttl'];
        $.each(changeHandler, function (i, value) {
            elementor.settings.page.addChangeCallback(value, afeb_extensionGoingup);
        });
    });
});