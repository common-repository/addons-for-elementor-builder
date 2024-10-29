<?php

namespace AFEB;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Security Class
 * 
 * @class Security
 * @version 1.0.6
 */
class Security extends Base
{
    /**
     * Ajax request security check
     * 
     * @since 1.0.6
     * 
     * @param string $nonce
     * @param string|int $nonce_action
     * @param string $capability
     * 
     * @return string
     */
    public function ajax_request_validate($nonce = '', $nonce_action = -1, $capability = 'manage-options')
    {
        if (!wp_verify_nonce(sanitize_text_field(wp_unslash($nonce)), $nonce_action) || current_user_can($capability))
            wp_send_json_error(['message' => __('Ajax request is not valid', 'addons-for-elementor-builder')]);
    }

    /**
     * Cleaning And sanitizing the CSS codes
     *
     * @since 1.0.6
     * 
     * @param string $css
     *
     * @return string
     */
    public function clean_and_sanitize_css($css)
    {
        return wp_strip_all_tags($css);
    }
}
