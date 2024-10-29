<?php

/**
 * Plugin Name: Vertex Addons for Elementor
 * Plugin URI: https://vertexaddons.com/
 * Description: Just one plugin instead of a lot!
 * Version: 1.1.2
 * Author: Webilia
 * Author URI: https://webilia.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: addons-for-elementor-builder
 * Domain Path: /i18n/languages/
 * 
 * Requires at least: 6.0
 * Tested up to: 6.6.2
 * Elementor tested up to: 3.24
 */

if (!defined('ABSPATH')) {
    exit;
}

const AFEB_PHP_MIN_VERSION = '7.0';
const AFEB_WP_MIN_VERSION = '5.0';

if (!is_php_version_compatible(AFEB_PHP_MIN_VERSION)) {
    add_action('admin_notices', function () {
        afeb_fail_version('PHP', AFEB_PHP_MIN_VERSION);
    });
} else if (!is_wp_version_compatible(AFEB_WP_MIN_VERSION)) {
    add_action('admin_notices', function () {
        afeb_fail_version('WordPress', AFEB_WP_MIN_VERSION);
    });
} else {
    require_once 'afeb.php';
}

/**
 * "Vertex Addons for Elementor" admin notice for minimum PHP or WP version
 * 
 * @since 1.0.0
 * 
 * @param $name
 * @param $version
 * @return void
 */
function afeb_fail_version($name, $version)
{
    /* translators: %1$s is replaced with "PHP" OR "WordPress" And %2$s replaced with Plug-in compatible version */
    $message = sprintf(esc_html__('Vertex Addons for Elementor requires %1$s version %2$s+', 'addons-for-elementor-builder'), $name, $version);
    $html_message = sprintf('<div class="notice notice-error is-dismissible">%s</div>', wpautop($message));
    echo wp_kses_post($html_message);
}
