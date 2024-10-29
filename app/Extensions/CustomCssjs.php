<?php

namespace AFEB\Extensions;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use AFEB\Security;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" CustomCssjs Extension Class
 * 
 * @class CustomCssjs
 * @version 1.0.3
 */
class CustomCssjs
{
    /**
     * @var Assets
     */
    private $assets;

    /**
     * @var ControlsHelper
     */
    private $CHelper;

    /**
     * @var Security
     */
    private $security;

    /**
     * CustomCssjs Constructor
     * 
     * @since 1.0.3
     */
    public function __construct()
    {
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->security = new Security();
        $this->actions();
    }

    /**
     * CustomCssjs Class Actions
     * 
     * @since 1.0.3
     */
    public function actions()
    {
        add_action('elementor/documents/register_controls', [$this, 'register_controls'], 10);

        add_action('wp_enqueue_scripts', [$this, 'header_style'], 999);
        add_action('wp_enqueue_scripts', [$this, 'header_script'], 999);
        add_action('wp_enqueue_scripts', [$this, 'footer_script'], 999);
    }

    /**
     * Register CustomCssjs extension controls
     *
     * @since 1.0.3
     * 
     * @param object $obj
     */
    public function register_controls($obj)
    {
        $this->CHelper->add_adv_sctn($obj, 'afeb-ext-as1', esc_html__('Custom CSS/JS', 'addons-for-elementor-builder'), function ($obj) {
            $obj->start_controls_tabs('afeb_icn_tb_cntrl');
            /**
             * CSS
             */
            $this->CHelper->add_tb($obj, 'cstm_cssjs_css_tab', __('CSS', 'addons-for-elementor-builder'), function ($obj) {
                $this->CHelper->cde($obj, 'afeb_cstm_hdr_css', __('CSS', 'addons-for-elementor-builder'), 'css');
            });
            /**
             * JS
             */
            $this->CHelper->add_tb($obj, 'cstm_cssjs_js_tab', __('JS', 'addons-for-elementor-builder'), function ($obj) {
                $this->CHelper->cde($obj, 'afeb_cstm_hdr_js', __('Header JS', 'addons-for-elementor-builder'), 'javascript');
                $this->CHelper->cde($obj, 'afeb_cstm_ftr_js', __('Footer JS', 'addons-for-elementor-builder'), 'javascript');
            });
            $obj->end_controls_tabs();
        });
    }

    /**
     * Add custom style to header
     * 
     * @since 1.0.3
     * 
     * @return array
     */
    public function header_style()
    {
        if (Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode()) return;
        $document = Plugin::instance()->documents->get(get_the_ID());
        if (!$document) return;
        $cstm_css = $this->security->clean_and_sanitize_css($document->get_settings('afeb_cstm_hdr_css'));
        if (!trim($cstm_css)) return;

        $this->assets->custom_header_style();
        wp_add_inline_style('afeb-custom-header-style', esc_html($this->security->clean_and_sanitize_css($cstm_css)));
    }

    /**
     * Add custom script to header
     * 
     * @since 1.0.3
     * 
     * @return array
     */
    public function header_script()
    {
        if (Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode()) return;
        $document = Plugin::instance()->documents->get(get_the_ID());
        if (!$document) return;
        $custom_js = esc_js($document->get_settings('afeb_cstm_hdr_js'));
        if (!trim($custom_js)) return;

        $this->assets->custom_header_script();
        wp_add_inline_script('afeb-custom-header-script', esc_js($custom_js));
    }

    /**
     * Add custom script to footer
     * 
     * @since 1.0.3
     * 
     * @return array
     */
    public function footer_script()
    {
        if (Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode()) return;
        $document = Plugin::instance()->documents->get(get_the_ID());
        if (!$document) return;
        $custom_js = esc_js($document->get_settings('afeb_cstm_ftr_js'));
        if (!trim($custom_js)) return;

        $this->assets->custom_footer_script();
        wp_add_inline_script('afeb-custom-footer-script', esc_js($custom_js));
    }
}
