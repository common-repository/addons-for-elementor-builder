<?php

namespace AFEB;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Assets Class
 * 
 * @class Assets
 * @version 1.0.0
 */
class Assets extends Base
{
    /**
     * Initialize "Vertex Addons for Elementor" Assets
     * 
     * @since 1.0.0
     */
    public function init()
    {
        $this->actions();
    }

    /**
     * Assets Class Actions
     * 
     * @since 1.0.0
     */
    public function actions()
    {
        if (is_admin()) {
            add_action('admin_enqueue_scripts', function () {
                $this->common_style();
                $this->backend_style();
                $this->elementor_element_manager_styles();
                $this->backend_script();
            });
        } else {
            add_action('wp_enqueue_scripts', function () {
                $this->common_style();
                $this->fontawesome_style();
            });
        }

        add_action('elementor/editor/after_enqueue_styles', [$this, 'elementor_editor_styles']);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_script']);
    }

    /**
     * Styles of Backend
     * 
     * @since 1.0.0
     */
    public function backend_style()
    {
        $handle = 'afeb-backend-style';
        wp_register_style($handle, $this->assets_url('css/backend.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Scripts of Backend
     * 
     * @since 1.0.0
     */
    public function backend_script()
    {
        $handle = 'afeb-backend-script';
        wp_register_script($handle, $this->assets_url('js/backend.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of WordPress Color Picker Module
     * 
     * @since 1.0.7
     */
    public function wp_color_picker_style()
    {
        wp_enqueue_style('wp-color-picker');
    }

    /**
     * Script of WordPress Color Picker Module
     * 
     * @since 1.0.7
     */
    public function wp_color_picker_script()
    {
        wp_enqueue_script('wp-color-picker');
    }

    /**
     * Common style for Frontend and Backend
     * 
     * @since 1.0.0
     */
    public function common_style()
    {
        $handle = 'afeb-common-style';
        wp_register_style($handle, $this->assets_url('css/common.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Normalize style for Backend
     * 
     * @since 1.0.0
     */
    public function normalize_style()
    {
        $handle = 'afeb-normalize-style';
        wp_register_style($handle, $this->assets_url('css/normalize.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Fontawesome Package
     * 
     * @since 1.0.0
     */
    public function fontawesome_style()
    {
        $handle = 'afeb-fontawesome-style';
        wp_register_style($handle, $this->assets_url('packages/font-awesome/fontawesome.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Elementor editor style
     * 
     * @since 1.0.0
     */
    public function elementor_editor_styles()
    {
        wp_register_style('afeb-elementor-editor-styles', $this->assets_url('css/elementor-editor.min.css'), [], AFEB_VERSION);
        wp_enqueue_style('afeb-elementor-editor-styles');

        wp_register_style('afeb-elementor-widget-icons-styles', $this->assets_url('css/widgets/widgets-icons.min.css'), [], AFEB_VERSION);
        wp_enqueue_style('afeb-elementor-widget-icons-styles');
    }

    /**
     * Elementor widget manager page style
     * 
     * @since 1.0.0
     */
    public function elementor_element_manager_styles()
    {
        wp_register_style('afeb-element-manager-styles', $this->assets_url('css/element-manager.min.css'), [], AFEB_VERSION);
        wp_enqueue_style('afeb-element-manager-styles');

        wp_register_style('afeb-elementor-widget-icons-styles', $this->assets_url('css/widgets/widgets-icons.min.css'), [], AFEB_VERSION);
        wp_enqueue_style('afeb-elementor-widget-icons-styles');
    }

    /**
     * Component script for Backend
     * 
     * @since 1.0.0
     */
    public function component_script()
    {
        $handle = 'afeb-component-script';
        wp_register_script($handle, $this->assets_url('js/global/component.min.js'), [
            'jquery',
            'jquery-ui-accordion',
        ], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Accordion widget
     * 
     * @since 1.0.0
     */
    public function accordion_style()
    {
        $handle = 'afeb-accordion-style';
        wp_register_style($handle, $this->assets_url('css/widgets/accordion.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Accordion widget
     * 
     * @since 1.0.0
     */
    public function accordion_script()
    {
        $handle = 'afeb-accordion-script';
        wp_register_script($handle, $this->assets_url('js/accordion.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Alert Box widget
     * 
     * @since 1.0.0
     */
    public function alert_box_style()
    {
        $handle = 'afeb-alert-box-style';
        wp_register_style($handle, $this->assets_url('css/widgets/alert-box.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * RTL Style of Alert Box widget
     * 
     * @since 1.0.0
     */
    public function rtl_alert_box_style()
    {
        $handle = 'rtl-afeb-alert-box-style';
        wp_register_style($handle, $this->assets_url('css/widgets/rtl/alert-box.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }


    /**
     * Script of Alert Box widget
     * 
     * @since 1.0.0
     */
    public function alert_box_script()
    {
        $handle = 'afeb-alert-box-script';
        wp_register_script($handle, $this->assets_url('js/alert-box.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Breadcrumb widget
     * 
     * @since 1.0.0
     */
    public function breadcrumb_style()
    {
        $handle = 'afeb-breadcrumb-style';
        wp_register_style($handle, $this->assets_url('css/widgets/breadcrumb.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style sheet for custom header CSS
     * 
     * @since 1.0.4
     */
    public function custom_header_style()
    {
        $handle = 'afeb-custom-header-style';
        wp_register_style($handle, $this->assets_url('css/custom-header.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * JS file for custom header JS
     * 
     * @since 1.0.4
     */
    public function custom_header_script()
    {
        $handle = 'afeb-custom-header-script';
        wp_register_script($handle, $this->assets_url('js/globalcustom-header.js'), ['jquery'], AFEB_VERSION, []);
        wp_enqueue_script($handle);
    }

    /**
     * Style sheet for custom footer CSS
     * 
     * @since 1.0.4
     */
    public function custom_footer_style()
    {
        $handle = 'afeb-custom-footer-style';
        wp_register_style($handle, $this->assets_url('css/custom-footer.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * JS file for custom footer JS
     * 
     * @since 1.0.4
     */
    public function custom_footer_script()
    {
        $handle = 'afeb-custom-footer-script';
        wp_register_script($handle, $this->assets_url('js/global/custom-footer.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Countdown widget
     * 
     * @since 1.0.0
     */
    public function countdown_style()
    {
        $handle = 'afeb-countdown-style';
        wp_register_style($handle, $this->assets_url('css/widgets/countdown.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Countdown widget
     * 
     * @since 1.0.0
     */
    public function countdown_script()
    {
        $handle = 'afeb-countdown-script';
        wp_register_script($handle, $this->assets_url('js/countdown.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Dynamic Hook scripts
     * 
     * @since 1.0.0
     */
    public function dynamic_hook_script()
    {
        $handle = 'afeb-dynamic-hook-script';
        wp_register_script($handle, $this->assets_url('js/global/dynamic-hook.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Dynamic Select scripts
     * 
     * @since 1.0.7
     */
    public function dynamic_select_script()
    {
        $handle = 'afeb-dynamic-select-script';
        wp_register_script($handle, $this->assets_url('js/dynamic-select.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Editor scripts
     * 
     * @since 1.0.0
     */
    public function editor_script()
    {
        $handle = 'afeb-editor-script';
        wp_register_script($handle, $this->assets_url('js/editor.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Fancy Text widget
     * 
     * @since 1.0.0
     */
    public function fancy_text_style()
    {
        $handle = 'afeb-fancy-text-style';
        wp_register_style($handle, $this->assets_url('css/widgets/fancy-text.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Fancy Text widget
     * 
     * @since 1.0.0
     */
    public function fancy_text_script()
    {
        $handle = 'afeb-fancy-text-script';
        wp_register_script($handle, $this->assets_url('js/fancy-text.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Going Up extension
     * 
     * @since 1.0.0
     */
    public function going_up_style()
    {
        $handle = 'afeb-going-up-style';
        wp_register_style($handle, $this->assets_url('css/extensions/going-up.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Going Up extension
     * 
     * @since 1.0.0
     */
    public function going_up_script()
    {
        $handle = 'afeb-going-up-script';
        wp_register_script($handle, $this->assets_url('js/going-up.min.js'), ['jquery'], AFEB_VERSION, [], true);
        $this->localize_script($handle);
        wp_enqueue_script($handle);
    }

    /**
     * Grid Gallery Style
     * 
     * @since 1.0.7
     */
    public function grid_gallery_style()
    {
        $handle = 'afeb-grid-gallery-style';
        wp_register_style($handle, $this->assets_url('css/widgets/grid-gallery.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Hotspot widget
     * 
     * @since 1.0.0
     */
    public function hotspot_style()
    {
        $handle = 'afeb-hotspot';
        wp_register_style($handle, $this->assets_url('css/widgets/hotspot.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Font Icon Picker Package
     * 
     * @since 1.0.7
     */
    public function icon_picker_style()
    {
        $handle = 'afeb-hotspot';
        wp_register_style($handle, $this->assets_url('packages/font-iconpicker/fonticonpicker.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Font Icon Picker Package
     * 
     * @since 1.0.7
     */
    public function icon_picker_script()
    {
        $handle = 'afeb-icon-picker-script';
        wp_register_script($handle, $this->assets_url('packages/font-iconpicker/fonticonpicker.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Info Box widget
     * 
     * @since 1.0.0
     */
    public function info_box_style()
    {
        $handle = 'afeb-info-box-style';
        wp_register_style($handle, $this->assets_url('css/widgets/information-box.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Light Gallery Script
     * 
     * @since 1.0.7
     */
    public function light_gallery_script()
    {
        $handle = 'afeb-light-gallery-script';
        wp_register_script($handle, $this->assets_url('packages/light-gallery/light-gallery.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Localizes a registered script with data for a JavaScript variable
     * 
     * @since 1.0.4
     * 
     * @param string $handle
     * @param string $key
     * @param int $index
     */
    public function localize_script($handle = '', $key = 'AFEB', $index = 0)
    {
        if (!function_exists('wp_create_nonce'))
            require_once(ABSPATH . '/wp-includes/pluggable.php');

        $options = [
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('afeb_ajax_nonce')
            ]
        ];

        wp_localize_script($handle, $key, $options[$index]);
    }

    /**
     * Style of LRForm widget
     * 
     * @since 1.0.3
     */
    public function lrform_style()
    {
        $handle = 'afeb-lrform-style';
        wp_register_style($handle, $this->assets_url('css/widgets/login-register.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of LRForm widget
     * 
     * @since 1.0.0
     */
    public function lrform_script()
    {
        $handle = 'afeb-lrform-script';
        wp_register_script($handle, $this->assets_url('js/login-register.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of MegaMenu widget
     * 
     * @since 1.0.7
     */
    public function megamenu_style()
    {
        $handle = 'afeb-megamenu-style';
        wp_register_style($handle, $this->assets_url('css/widgets/mega-menu.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of MegaMenu widget
     * 
     * @since 1.0.7
     */
    public function megamenu_script()
    {
        $handle = 'afeb-megamenu-script';
        wp_register_script($handle, $this->assets_url('js/mega-menu.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Newsticker widget
     * 
     * @since 1.0.0
     */
    public function newsticker_style()
    {
        $handle = 'afeb-newsticker-style';
        wp_register_style($handle, $this->assets_url('css/widgets/news-ticker.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Newsticker widget
     * 
     * @since 1.0.0
     */
    public function newsticker_script()
    {
        $handle = 'afeb-newsticker-script';
        wp_register_script($handle, $this->assets_url('js/news-ticker.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of NoticeBox widget
     * 
     * @since 1.0.0
     */
    public function notice_box_style()
    {
        $handle = 'afeb-notice-box-style';
        wp_register_style($handle, $this->assets_url('css/widgets/notice-box.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of PriceBox widget
     * 
     * @since 1.0.0
     */
    public function price_box_style()
    {
        $handle = 'afeb-price-box-style';
        wp_register_style($handle, $this->assets_url('css/widgets/price-box.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Pro Version control
     * 
     * @since 1.0.4
     */
    public function pro_version_style()
    {
        $handle = 'afeb-pro-version-style';
        wp_register_style($handle, $this->assets_url('css/pro-version.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Search Input widget
     * 
     * @since 1.0.0
     */
    public function search_form_style()
    {
        $handle = 'afeb-search-form-style';
        wp_register_style($handle, $this->assets_url('css/widgets/search-form.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Sound Player widget
     * 
     * @since 1.0.0
     */
    public function sound_player_style()
    {
        $handle = 'afeb-sound-player-style';
        wp_register_style($handle, $this->assets_url('css/widgets/sound-player.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Sound Player widget
     * 
     * @since 1.0.0
     */
    public function sound_player_script()
    {
        $handle = 'afeb-sound-player-script';
        wp_register_script($handle, $this->assets_url('js/sound-player.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Script of Howler Package
     * 
     * @since 1.0.0
     */
    public function howler_script()
    {
        $handle = 'afeb-howler-script';
        wp_register_script($handle, $this->assets_url('packages/howler/howler.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Swiper Package
     * 
     * @since 1.0.0
     */
    public function swiper_style()
    {
        $handle = 'afeb-swiper-style';
        wp_register_style($handle, $this->assets_url('packages/swiper-bundle/swiper-bundle-min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Swiper Package
     * 
     * @since 1.0.0
     */
    public function swiper_script()
    {
        $handle = 'afeb-swiper-script';
        wp_register_script($handle, $this->assets_url('packages/swiper-bundle/swiper-bundle-min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Tabs widget
     * 
     * @since 1.1.1
     */
    public function tabs_style()
    {
        $handle = 'afeb-tabs-style';
        wp_register_style($handle, $this->assets_url('css/widgets/tabs.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Tabs widget
     * 
     * @since 1.1.1
     */
    public function tabs_script()
    {
        $handle = 'afeb-tabs-script';
        wp_register_script($handle, $this->assets_url('js/tabs.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Testimonial Carousel widget
     * 
     * @since 1.0.0
     */
    public function testimonial_carousel_style()
    {
        $handle = 'afeb-testimonial-carousel-style';
        wp_register_style($handle, $this->assets_url('css/widgets/testimonial-carousel.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Testimonial Carousel widget
     * 
     * @since 1.0.0
     */
    public function testimonial_carousel_script()
    {
        $handle = 'afeb-testimonial-carousel-script';
        wp_register_script($handle, $this->assets_url('js/testimonial-carousel.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Tilt Package
     * 
     * @since 1.0.7
     */
    public function tilt_style()
    {
        $handle = 'afeb-tilt-style';
        wp_register_style($handle, $this->assets_url('packages/tilt-js/tilt.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Tilt Package
     * 
     * @since 1.0.7
     */
    public function tilt_script()
    {
        $handle = 'afeb-tilt-script';
        wp_register_script($handle, $this->assets_url('packages/tilt-js/tilt.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }

    /**
     * Style of Timeline widget
     * 
     * @since 1.0.0
     */
    public function timeline_style()
    {
        $handle = 'afeb-timeline-style';
        wp_register_style($handle, $this->assets_url('css/widgets/timeline.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Style of Wrapper Link extension
     * 
     * @since 1.0.3
     */
    public function wrapper_link_style()
    {
        $handle = 'afeb-wrapper-link-style';
        wp_register_style($handle, $this->assets_url('css/extensions/wrapper-link.min.css'), [], AFEB_VERSION);
        wp_enqueue_style($handle);
    }

    /**
     * Script of Wrapper Link extension
     * 
     * @since 1.0.3
     */
    public function wrapper_link_script()
    {
        $handle = 'afeb-wrapper-link-script';
        wp_register_script($handle, $this->assets_url('js/wrapper-link.min.js'), ['jquery'], AFEB_VERSION, [], true);
        wp_enqueue_script($handle);
    }
}
