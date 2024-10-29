<?php

namespace AFEB;

use AFEB\Controls\DynamicSelect\DynamicSelect;
use AFEB\Controls\ImageSelect;
use AFEB\Controls\ProVersion;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Controls Class
 * 
 * @class Controls
 * @version 1.0.0
 */
class Controls extends Base
{
    /**
     * Initialize "Vertex Addons for Elementor" Controls
     * 
     * @since 1.0.0
     */
    public function init()
    {
        $this->actions();
    }

    /**
     * Controls Class Actions
     * 
     * @since 1.0.0
     */
    public function actions()
    {
        add_action('elementor/controls/register', [$this, 'register_controls']);
    }

    /**
     * Register controls
     * 
     * @since 1.0.0
     * 
     * @param object $controls_manager
     */
    public function register_controls($controls_manager)
    {
        $controls_manager->register(new ImageSelect());
        $controls_manager->register(new ProVersion());
        $controls_manager->register(new DynamicSelect());

        do_action('afeb/widgets/after_register_controls', $controls_manager);
    }
}
