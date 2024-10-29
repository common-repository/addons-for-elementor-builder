<?php

namespace AFEB;

use AFEB\Handler\Widgets\LoginRegisterHandler;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" General Handler Class
 * 
 * @class Handler
 * @version 1.0.3
 */
class Handler extends Base
{
    /**
     * @var LoginRegisterHandler
     */
    protected $lr_widget_handler;

    /**
     * Initialize "Vertex Addons for Elementor" Handler
     * 
     * @since 1.0.3
     */
    public function init()
    {
        $this->lr_widget_handler = new LoginRegisterHandler();
        $this->lr_widget_handler->init();
    }
}
