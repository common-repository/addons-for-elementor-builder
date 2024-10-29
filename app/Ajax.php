<?php

namespace AFEB;

use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" General Ajax Class
 * 
 * @class Ajax
 * @version 1.0.4
 */
class Ajax extends Base
{
    /**
     * Initialize "Vertex Addons for Elementor" Ajax
     * 
     * @since 1.0.4
     */
    public function init()
    {
        $this->actions();
    }

    /**
     * Ajax Class Actions
     * 
     * @since 1.0.4
     */
    public function actions()
    {
        add_action('wp_ajax_afeb_gup_ext_render_icon', [$this, 'gup_render_icon']);
        add_action('wp_ajax_nopriv_afeb_gup_ext_render_icon', [$this, 'gup_render_icon']);
    }

    /**
     * Render icon of GoingUp extension on the frontend
     *
     * @since 1.0.4
     */
    public function gup_render_icon()
    {
        check_ajax_referer('afeb_ajax_nonce', 'nonce');
        $data = isset($_POST['data']) && is_array($_POST['data']) ? map_deep($_POST['data'], 'sanitize_text_field') : [
            'library' => 'fa-regular',
            'value' => "far fa-arrow-alt-circle-up"
        ];

        if (empty($data)) wp_send_json_error();
        ob_start();
        echo wp_kses(Icons_Manager::render_icon($data), Helper::allowed_tags(['svg']));

        wp_send_json_success(str_replace('</svg>1', '</svg>', ob_get_clean()), 200);
    }
}
