<?php

namespace AFEB;

use AFEB\Controls\DynamicSelect\DynamicSelectAPI;
use AFEB\Plugin\Hooks;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main "Vertex Addons for Elementor" Class
 * 
 * @class "Vertex Addons for Elementor"
 * @version 1.0.0
 */
final class Vertex_Addons_For_Elementor
{
    /**
     * Plugin Version
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    public $version = '1.1.2';

    /**
     * The single instance of the class
     * 
     * @since 1.0.0
     * 
     * @var AFEB
     */
    protected static $instance = null;

    /**
     * Main "Vertex Addons for Elementor" Instance
     * 
     * Ensures only one instance of "Vertex Addons for Elementor" is loaded or can be loaded
     * 
     * @since 1.0.0
     * 
     * @return AFEB
     */
    public static function instance()
    {
        // Getting an instance of class
        if (is_null(self::$instance)) {
            self::$instance = new self();

            do_action('afeb/loaded');
        }

        return self::$instance;
    }

    /**
     * Disable class cloning and throw an error on object clone
     * 
     * @since 1.0.0
     */
    public function __clone()
    {
        // Cloning instances of class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Forbidden', 'addons-for-elementor-builder'), '1.0.0');
    }

    /**
     * Disable un-serializing of the class
     * 
     * @since 1.0.0
     */
    public function __wakeup()
    {
        // Un-serializing instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Forbidden', 'addons-for-elementor-builder'), '1.0.0');
    }

    /**
     * "Vertex Addons for Elementor" Constructor
     * 
     * Initializing plugin
     * 
     * @since 1.0.0
     */
    protected function __construct()
    {
        $this->constants();
        $this->autoload();
        $this->actions();
        $this->init();
    }

    /**
     * "Vertex Addons for Elementor" constants
     * 
     * Define plugin constants
     * 
     * @since 1.0.0
     */
    private function constants()
    {
        // Plugin Absolute Path
        if (!defined('AFEB_ABSPATH'))
            define('AFEB_ABSPATH', dirname(__FILE__));

        // Plugin Directory Name
        if (!defined('AFEB_DIRNAME'))
            define('AFEB_DIRNAME', basename(AFEB_ABSPATH));

        // Plugin Base Name
        if (!defined('AFEB_BASENAME'))
            define('AFEB_BASENAME', plugin_basename(AFEB_ABSPATH . '/addons-for-elementor-builder.php'));

        // Plugin Version
        if (!defined('AFEB_VERSION'))
            define('AFEB_VERSION', $this->version);

        // Slug of Plugin Lite Version
        if (!defined('AFEBP_PRO_VS'))
            define('AFEBP_PRO_VS', 'addons-for-elementor-builder-pro');
    }

    /**
     * "Vertex Addons for Elementor" Vendor DIR
     * 
     * Libraries needed for the plugin
     * 
     * @since 1.0.0
     */
    public function autoload()
    {
        require_once 'vendor/autoload.php';
    }

    /**
     * Initialize The Plugin
     * 
     * @since 1.0.0
     */
    private function init()
    {
        Hooks::instance();
        $ajax = new Ajax();
        $assets = new Assets();
        $i18n = new I18n();
        $dynamic_select = new DynamicSelectAPI();
        $controls = new Controls();
        $widgets = new Widgets();
        $extensions = new Extensions();
        $handler = new Handler();
        // $advanced_menu = new AdvancedMenu();

        $ajax->init();
        $assets->init();
        $i18n->init();
        $dynamic_select->init();
        $controls->init();
        $widgets->init();
        $extensions->init();
        $handler->init();
        // $advanced_menu->init();

        if (is_admin()) {
            $menus = new Menus();
            $menus->init();
        }

        $rewrite_rules = new RewriteRules();
        $rewrite_rules->flush();
    }

    public function actions()
    {
        $base = new Base();
        add_action('admin_init', [$base, 'redirect_after_activation']);
    }
}

/**
 * Main instance of "Vertex Addons for Elementor"
 * 
 * Returns the main instance of "Vertex Addons for Elementor" to prevent the need to use globals
 *
 * @since 1.0.0
 * @return AFEB
 */
function vertex_addons_for_elementor()
{
    return Vertex_Addons_For_Elementor::instance();
}

// Init the plugin :)
vertex_addons_for_elementor();
