<?php

namespace AFEB;

use AFEB\Menus\Dashboard;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" General Menus Class
 * 
 * @class Menus
 * @version 1.0.0
 */
class Menus extends Base
{
    /**
     * Menus Slug
     */
    const MENUS_SLUG = 'afeb';

    /**
     * @var Dashboard
     */
    protected $dashboard;

    /**
     * Initialize "Vertex Addons for Elementor" Menus
     * 
     * @since 1.0.0
     */
    public function init()
    {
        $this->dashboard = new Dashboard();
        $this->dashboard->init();

        $this->actions();
        $this->filters();
    }

    /**
     * Menus Class Actions
     * 
     * @since 1.0.0
     */
    public function actions()
    {
        add_action('admin_menu', [$this, 'register_menus'], 1);
    }

    /**
     * Menus Class Filters
     * 
     * @since 1.0.0
     */
    public function filters()
    {
        add_filter('parent_file', [$this, 'parent_taxonomy_sub_menus']);
    }

    /**
     * Registers "Vertex Addons for Elementor" menus and submenus
     * 
     * @since 1.0.0
     */
    public function register_menus()
    {
        $widgets = new Widgets();

        add_menu_page(__('Vertex Addons', 'addons-for-elementor-builder'), __('Vertex Addons', 'addons-for-elementor-builder'), 'manage_options', self::MENUS_SLUG, [$this->dashboard, 'output'], '', '25.3');
        add_submenu_page(self::MENUS_SLUG, esc_html__('Widgets', 'addons-for-elementor-builder'), esc_html__('Widgets', 'addons-for-elementor-builder'), 'manage_options', 'admin.php?page=' . self::MENUS_SLUG . '&tab=widgets', '', '30.3');
        if (count($widgets->trdpt_widgets()) > 0) add_submenu_page(self::MENUS_SLUG, esc_html__('3rd Party Widgets', 'addons-for-elementor-builder'), esc_html__('3rd Party Widgets', 'addons-for-elementor-builder'), 'manage_options', 'admin.php?page=' . self::MENUS_SLUG . '&tab=3rdpt-widgets', '', '40.3');
        add_submenu_page(self::MENUS_SLUG, esc_html__('Extensions', 'addons-for-elementor-builder'), esc_html__('Extensions', 'addons-for-elementor-builder'), 'manage_options', 'admin.php?page=' . self::MENUS_SLUG . '&tab=extensions', '', '50.3');
        // add_submenu_page(self::MENUS_SLUG, esc_html__('Go Pro', 'addons-for-elementor-builder'), esc_html__('Go Pro', 'addons-for-elementor-builder'), 'manage_options', 'admin.php?page=' . self::MENUS_SLUG . '&tab=go-pro', '', '60.3');
    }

    /**
     * Set taxonomy sub menus parent when is active
     * 
     * @since 1.0.0
     * 
     * @param string $parent_file
     * 
     * @return string
     */
    public function parent_taxonomy_sub_menus($parent_file)
    {
        global $submenu_file, $current_screen;
        if ($current_screen->id == 'toplevel_page_' . self::MENUS_SLUG) {
            if (isset($_GET['tab']) && $_GET['tab'] == 'widgets') $submenu_file = 'admin.php?page=afeb&tab=widgets';
            if (isset($_GET['tab']) && $_GET['tab'] == '3rdpt-widgets') $submenu_file = 'admin.php?page=afeb&tab=3rdpt-widgets';
            if (isset($_GET['tab']) && $_GET['tab'] == 'extensions') $submenu_file = 'admin.php?page=afeb&tab=extensions';
            if (isset($_GET['tab']) && $_GET['tab'] == 'go-pro') $submenu_file = 'admin.php?page=afeb&tab=go-pro';

            $parent_file = self::MENUS_SLUG;
        }
        return $parent_file;
    }
}
