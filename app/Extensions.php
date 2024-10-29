<?php

namespace AFEB;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Extensions Class
 * 
 * @class Extensions
 * @version 1.0.3
 */
class Extensions extends Base
{
    /**
     * "Vertex Addons for Elementor" Extensions URL
     */
    const AFEB_EXTENSIONS_URL = self::AFEB_URL . '/extensions/';

    /**
     * "Vertex Addons for Elementor" PFX
     */
    const PFX = 'PV_';

    /**
     * Initialize "Vertex Addons for Elementor" Extensions
     * 
     * @since 1.0.3
     */
    public function init()
    {
        $this->register_extensions();
    }

    /**
     * All extensions list
     * 
     * @since 1.0.3
     * 
     * @return array
     */
    public function extensions()
    {
        return apply_filters('afeb/extensions/list', [
            'Custom_Cssjs' => [
                'title' => esc_html__('Custom CSS/JS', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Wrapper_Link' => [
                'title' => esc_html__('Wrapper Link', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Going_Up' => [
                'title' => esc_html__('Scroll to Top', 'addons-for-elementor-builder'),
                'status' => 1
            ]
        ]);
    }

    /**
     * Register all extensions
     * 
     * @since 1.0.3
     * 
     */
    public function register_extensions()
    {
        $extensions = array_replace_recursive($this->extensions(), get_option('afeb-extensions-status', []));
        foreach ($extensions as $extension_key => $extension) {
            if (isset($extension['status']) && $extension['status'] == 1) {
                $prefix = !isset($extension['pro']) ? '\AFEB\Extensions\\' : '\AFEB\PRO\Extensions\\';
                $extension_key = $prefix . str_replace('_', '', $extension_key);
                if (class_exists($extension_key)) new $extension_key();
            }
        }
        do_action('afeb/extensions/after_register_extensions');
    }
}
