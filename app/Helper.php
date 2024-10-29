<?php

namespace AFEB;

use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Helper Class
 * 
 * @class Helper
 * @version 1.0.0
 */
class Helper extends Base
{
    /**
     * Print the admin notice
     * 
     * @since 1.0.0
     * 
     * @param string $message
     * @param string $type
     * @param boolean $dismissible
     */
    public static function admin_notice($message = '', $type = 'success', $dismissible = false)
    {
        $html_message = sprintf('<div class="notice notice-%s %s">%s</div>', esc_attr($type), $dismissible == true ? 'is-dismissible' : '', wpautop($message));
        echo wp_kses_post($html_message);
    }

    /**
     * The front notice template
     * 
     * @since 1.0.0
     * 
     * @param string $msg
     * @param string $type
     */
    public static function front_notice($msg, $type = 'success')
    {
        $type = 'afeb-' . $type;
        return '<div class="afeb-alert ' . esc_attr($type) . '">' . wp_kses_post($msg) . '</div>';
    }

    /**
     * Get PRO Badge
     * 
     * @since 1.0.2
     * 
     * @param bool $link
     * 
     * @return string
     */
    public static function pro_badge($link = true)
    {
        return $link ? '<a href="" target="_blank" class="afeb-pro-badge"><span>' . esc_html__('PRO', 'addons-for-elementor-builder') . '</span></a>' :
            '<span class="afeb-pro-badge"><span>' . esc_html__('PRO', 'addons-for-elementor-builder') . '</span></span>';
    }

    /**
     * Checks if a plugin is installed or not
     * 
     * @since 1.0.2
     * 
     * @param string $plugin
     * @param string $plugin_path
     */
    public static function is_plugin_installed($plugin, $plugin_path)
    {
        $installed = get_plugins();
        return isset($installed[$plugin_path]);
    }

    /**
     * Check if elementor edit mode or not
     * 
     * @since 1.0.3
     * 
     * @param string $plugin
     * @param string $plugin_path
     */
    public static function is_edit_mode()
    {
        if (isset($_REQUEST['elementor-preview'])) return true;
        return false;
    }

    /**
     * Returns the general Elementor site settings
     * 
     * @since 1.0.4
     * 
     * @param string $setting_id
     * 
     * @return string
     */
    public function get_elementor_settings($setting_id)
    {
        global $afeb_elementor_settings;
        $return = '';
        if (!isset($afeb_elementor_settings['kit_settings'])) {
            $kit = Plugin::$instance->documents->get(Plugin::$instance->kits_manager->get_active_id(), false);
            $afeb_elementor_settings['kit_settings'] = $kit->get_settings();
        }

        if (isset($afeb_elementor_settings['kit_settings'][$setting_id]))
            $return = $afeb_elementor_settings['kit_settings'][$setting_id];

        return apply_filters('afeb/elementor/settings/' . $setting_id, $return);
    }

    /**
     * Filters text content and strips out disallowed HTML
     * 
     * @since 1.0.0
     * 
     * @param string $text
     * 
     * @return string
     */
    public static function kses($text)
    {
        return trim($text) ? wp_kses($text, self::allowed_tags(), array_merge(wp_allowed_protocols(), ['data'])) : '';
    }

    /**
     * List of allowed html tag for wp_kses
     *
     * @since 1.0.0
     * 
     * @param array $exclude_all_except
     * @param array $extra
     * 
     * @return array
     */
    public static function allowed_tags($exclude_all_except = [], $extra = [])
    {
        $allowed_tags = [
            'a' => [
                'class' => [],
                'href' => [],
                'target' => []
            ],
            'div' => [
                'class' => [],
                'id' => []
            ],
            'img'     => [
                'alt' => [],
                'class' => [],
                'src' => [],
                'title' => []
            ],
            'span' => [
                'class' => []
            ],
            'svg' => [
                'class' => [],
                'xmlns' => [],
                'viewBox' => []
            ]
        ];
        if (count($extra) > 0) $allowed_tags = array_merge_recursive($allowed_tags, $extra);
        if (count($exclude_all_except) > 0) {
            foreach ($exclude_all_except as $tag_key => $tag_value) {
                unset($exclude_all_except[$tag_key]);
                $exclude_all_except[$tag_value] = $allowed_tags[$tag_value];
            }

            $allowed_tags = $exclude_all_except;
        }

        return apply_filters('afeb/kses/allowed_tags', $allowed_tags);
    }

    /**
     * applies the callback to the element of the given array recursively
     * 
     * @since 1.0.0
     * 
     * @param callback $callback
     * @param array $array
     * @param string $seperator
     * @param string $path
     * 
     * @return array
     */
    public static function array_map_recursive($callback, $array, $seperator = '_', $path = '')
    {
        $output = [];

        if (!trim($seperator)) {
            $seperator = '_';
        }
        if (!isset($array_base)) {
            $array_base = $array;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $path .= "{$key}$seperator";
                $check_path = $this->check_array_path($array_base, $path, $seperator);

                if (!$check_path['success']) {
                    $invalid_path = explode($seperator, substr($path, 0, -1));
                    $index = (array_search($check_path['value'], $invalid_path) - 1);
                    unset($invalid_path[$index]);
                    $path = implode($seperator, $invalid_path) . $seperator;
                }

                $output[$key] = $this->array_map_recursive($callback, $value, $seperator, $path);
            } else {
                $output[$key] = $callback($value, $key, "{$path}{$key}");
            }
        }

        return $output;
    }

    /**
     * Validate an array path
     * 
     * @since 1.0.0
     * 
     * @param array $array
     * @param string $path
     * @param string $seperator
     * 
     * @return array
     */
    public function check_array_path($array, $path = '', $seperator = '_')
    {
        $i = 1;
        $path = explode($seperator, $path);

        if (!trim(end($path))) {
            $path = array_slice($path, 0, (count($path) - 1));
        }

        foreach ($path as $path_key => $path_value) {
            if (isset($array[$path_value])) {
                if ($i == count($path)) {
                    return array(
                        'success' => true,
                        'value' => $path_value
                    );
                } else if (is_array($array[$path_value])) {
                    $array = $array[$path_value];
                } else {
                    return [
                        'success' => false,
                        'value' => $path_value
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'value' => $path_value
                ];
            }

            $i++;
        }
    }

    /**
     * Fetch a filtered list of user roles
     * 
     * @since 1.0.5
     * 
     * @return bool
     */
    public function get_user_roles()
    {
        $user_roles[''] = __('Default', 'addons-for-elementor-builder');
        if (function_exists('get_editable_roles')) {
            $wp_roles = get_editable_roles();
            $roles = $wp_roles ? $wp_roles : [];
            if (!empty($roles) && is_array($roles)) {
                foreach ($wp_roles as $role_key => $role) {
                    if ($role_key === 'administrator') continue;
                    $user_roles[$role_key] = $role['name'];
                }
            }
        }

        return apply_filters('afeb/user-roles', $user_roles);
    }

    /**
     * Is it good?
     * 
     * @since 1.0.5
     * 
     * @param string $input
     * 
     * @return bool
     */
    public static function hpv($input)
    {
        return (strpos($input, Widgets::PFX) === false);
    }

    /**
     * Prepare array
     * 
     * @since 1.0.2
     * 
     * @param array $array
     * @param string $name
     * @param array $extra
     * @param int $setter
     * @param array $get_array
     * 
     * @return int|string
     */
    public static function get_array($array = [], $name = '', $extra = [], $setter = 1, $get_array = [])
    {
        if ($setter == 1) foreach ($array as $i => $v) $get_array[is_int($i) ? sprintf("%s2{$i}", Widgets::PFX) : $i] = $v;
        else $get_array = $array;

        return apply_filters($name, $get_array, $extra);
    }

    /**
     * Retrieves the terms in a given taxonomy or list of taxonomies
     * 
     * @since 1.0.5
     * 
     * @param string $id
     * 
     * @return string
     */
    public static function get_page_as_element($id = '')
    {
        $id = intval($id);
        $status = get_post_status($id);

        if (! $status || $status === 'inherit' || is_page($id)) return;

        // Elementor
        if (get_post_meta($id, '_elementor_edit_mode', true) && did_action('elementor/loaded'))
            return \Elementor\Plugin::instance()->frontend->get_builder_content($id, (isset($_GET['elementor-preview']) ? false : true));

        $output = get_post_field('post_content', $id);

        return $output;
    }

    /**
     * Retrieves the terms in a given taxonomy or list of taxonomies
     * 
     * @since 1.0.2
     * 
     * @return array
     */
    public static function terms()
    {
        $terms = [];
        foreach (get_terms() as $term) {
            $taxonomy = get_taxonomy($term->taxonomy);
            if (isset($taxonomy->object_type)) {
                $terms[$term->term_id] = $term->name . ' (' . $taxonomy->object_type[0] . ')';
            }
        }
    }

    /**
     * Check if string contains specific values
     * 
     * @since 1.0.0
     * 
     * @param string $haystack
     * @param array $search
     * 
     * @return int|null
     */
    public static function contains($haystack = '', $search = [])
    {
        if ($haystack):
            foreach ((array) $search as $item):
                if ($item && strpos((string) $haystack, (string) $item) !== false):
                    return 1;
                    break;
                endif;
            endforeach;
        endif;

        return null;
    }

    /**
     * Limit words of string
     * 
     * @since 1.0.7
     * 
     * @param string $string
     * @param int $length
     * @param string $read_more
     * 
     * @return string
     */
    public function limit_words($string = '', $length = 12, $read_more = null)
    {
        $read_more_link = $this->get_string_between($string, '<a', '</a>', true);
        if (isset($read_more_link[0])):
            $read_more_link = $read_more_link[0];
            $string = str_replace($read_more_link, '', $string);
        endif;

        $count = count((array) preg_split('~[^\p{L}\p{N}\']+~u', $string)) - 1;
        $length--;

        if ($count > $length):
            $string = wp_strip_all_tags($string);
            $string = preg_replace('/((\w+\W*){' . $length . '}(\w+))(.*)/u', '${1}', $string) . ' ...';
        endif;

        if ($read_more) $string .= $read_more_link;
        return str_replace(['... ', 'Array'], '', $string);
    }

    /**
     * Get string between two string
     * 
     * @since 1.0.7
     * 
     * @param string $string
     * @param string $start
     * @param string $end
     * @param bool $match
     * 
     * @return string
     */
    public function get_string_between($string = '', $start = '', $end = '', $match = false)
    {
        if ($string):
            if ($match):
                preg_match_all('~' . preg_quote($start, '~') . '(.*?)' . preg_quote($end, '~') . '~s', $string, $matches);
                return $matches[0];
            endif;

            $array = explode($start, $string);

            if (isset($array[1])):
                $array = explode($end, $array[1]);
                return $array[0];
            endif;
        endif;
    }

    /**
     * Get All Users
     * 
     * @since 1.0.7
     * 
     * @return array
     */
    public static function get_users()
    {
        $users = [];

        if (!current_user_can('edit_posts')) return $users;
        foreach (get_users() as $key => $user) $users[$user->data->ID] = $user->data->user_nicename;

        wp_reset_postdata();

        return $users;
    }

    /**
     * Gets a list of post type object for group control query post types
     * 
     * @since 1.0.7
     * 
     * @return array
     */
    public static function get_post_types()
    {
        $post_types = get_post_types(['public' => true], 'objects');
        $post_types = array_column($post_types, 'label', 'name');

        $exclude = [
            'elementor_library' => '',
            'attachment' => ''
        ];

        return array_diff_key($post_types, $exclude);
    }

    /**
     * Returns email content wrapped in email template
     * 
     * @since 1.0.0
     * 
     * @param string $email_content
     */
    public static function email_content($email_content)
    {
        ob_start();
?>
        <div class="afeb-email-body" style="padding: 100px 0; background-color: #ebebeb;">
            <table class="afeb-email" border="0" cellpadding="0" cellspacing="0" style="width: 40%; margin: 0 auto; background: #fff; padding: 30px 30px 26px; border: 0.4px solid #d3d3d3; border-radius: 11px; font-family: 'Segoe UI', sans-serif; ">
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <?php echo wp_kses_post($email_content); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
<?php
        return wp_kses_post(ob_get_clean());
    }

    /**
     * Sending an email
     *
     * @since 1.0.0
     * 
     * @param string $email
     * @param string $subject
     * @param string $message
     * @param mixed  $header
     * @param array  $attachment
     */
    public static function send_email($email, $subject, $message, $header, $attachment)
    {
        $message = self::email_content($message);
        wp_mail($email, $subject, $message, $header, $attachment);
    }

    /**
     * Add a filter hook
     * 
     * @since 1.0.2
     * 
     * @param array $items
     * @param string $hook
     * @param object|array $args
     * 
     * @return array
     */
    public static function fhook($items = [], $hook = '', $args = [])
    {
        $output = [];
        $chars = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $num = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
        $rand_prx_key = [$chars[wp_rand($num[sqrt(225)], 15)], $chars[wp_rand($num[sqrt(441)], 21)]];
        $rand_sfx_key = [$chars[wp_rand($num[sqrt(225)], 15)], $chars[wp_rand($num[sqrt(289)], 17)], $chars[wp_rand($num[sqrt(196)], 14)]];
        $items = apply_filters($hook, $items, $args);
        $count = 0;
        foreach ($items as $key => $value) {
            if (strpos($key, sprintf('%s_', implode($rand_prx_key))) === false) $output[$key] = $value;
            else $output[$key] = $value . sprintf(' (%s) ', implode($rand_sfx_key));
            $count++;
        }
        return $output;
    }

    /**
     * Returns all navigation menu list
     * 
     * @since 1.0.7
     * 
     * @return array
     */
    public function get_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $items = ['default' => esc_html__('Select Menu', 'addons-for-elementor-builder')];
        foreach ($menus as $menu) $items[$menu->slug] = $menu->name;

        return $items;
    }

    /**
     * Returns all navigation menu list
     * 
     * @since 1.0.7
     *
     * @param string $string
     * @param boolean $remove_breaks
     * 
     * @return string
     */
    public static function strip_all_tag($string = '', $remove_breaks = false)
    {
        return wp_strip_all_tags($string, $remove_breaks);
    }
}
