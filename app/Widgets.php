<?php

namespace AFEB;

use AFEB\Controls\CHelper;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Widget Class
 * 
 * @class Widgets
 * @version 1.0.0
 */
class Widgets extends Base
{
    /**
     * "Vertex Addons for Elementor" Widgets URL
     */
    const AFEB_WIDGETS_URL = self::AFEB_URL . '/widgets/';

    /**
     * "Vertex Addons for Elementor" PFX
     */
    const PFX = 'PV_';

    /**
     * "Vertex Addons for Elementor" PRX
     */
    const PRX = '_PR';

    /**
     * @var Assets
     */
    private $assets;

    /**
     * @var ControlsHelper
     */
    private $CHelper;

    /**
     * Initialize "Vertex Addons for Elementor" Widgets
     * 
     * @since 1.0.0
     */
    public function init()
    {
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->actions();
    }

    /**
     * Widgets Class Actions
     * 
     * @since 1.0.0
     */
    public function actions()
    {
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('afeb/widget/content/after_render_content_section', [$this, 'add_request_feature_section']);
        add_action('afeb/widget/content/after_render_content_section', [$this, 'add_bug_report_section']);
        add_action('init', [$this, 'add_widgets_key_words']);
    }

    /**
     * Register widgets categories
     * 
     * @since 1.0.0
     * 
     * @param object $elements_manager
     */
    public function register_categories($elements_manager)
    {
        $elements_manager->add_category(
            'afeb_basic',
            [
                'title' => __('Vertex Addons', 'addons-for-elementor-builder'),
                'icon' => 'fa fa-plug',
            ]
        );

        do_action('afeb/widgets/after_register_categories', $elements_manager);
    }

    /**
     * Register all widgets
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function widgets()
    {
        return [
            'Accordion' => [
                'title' => esc_html__('Accordion', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Alert_Box' => [
                'title' => esc_html__('Alert Box', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Breadcrumb' => [
                'title' => esc_html__('Breadcrumb', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            'Countdown' => [
                'title' => esc_html__('CountDown', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Fancy_Text' => [
                'title' => esc_html__('Fancy Text', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Hotspot' => [
                'title' => esc_html__('Hotspot', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Information_Box' => [
                'title' => esc_html__('Information Box', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            'Login_Register' => [
                'title' => esc_html__('Login, Register', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            /*'Advanced_Menus' => [
                'title' => esc_html__('Advanced Menus', 'addons-for-elementor-builder'),
                'status' => 1
            ],*/
            'News_Ticker' => [
                'title' => esc_html__('News ticker', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Notice_Box' => [
                'title' => esc_html__('Notice Box', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            /*'Posts_Grid' => [
                'title' => esc_html__('Posts Grid', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],*/
            'Price_Box' => [
                'title' => esc_html__('Price Box', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            'Sound_Player' => [
                'title' => esc_html__('Sound Player', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Search_Form' => [
                'title' => esc_html__('Search Form', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Tabs' => [
                'title' => esc_html__('Tabs', 'addons-for-elementor-builder'),
                'status' => 1
            ],
            'Testimonial_Carousel' => [
                'title' => esc_html__('Testimonial Carousel', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ],
            'Timeline' => [
                'title' => esc_html__('Timeline', 'addons-for-elementor-builder'),
                'status' => 1,
                'nsp' => 1
            ]
        ];
    }

    /**
     * Widgets keywords list
     * 
     * @since 1.1.0
     * 
     * @param string $key
     * 
     * @return array
     */
    public function widgets_key_words($key = '')
    {
        $output = [
            'interactive' => [
                [
                    STRS::key_words(4),
                    STRS::key_words(11),
                    STRS::key_words(4),
                    STRS::key_words(12),
                    STRS::key_words(4),
                    STRS::key_words(13),
                    STRS::key_words(19),
                    STRS::key_words(14),
                    STRS::key_words(17)
                ],
                [
                    STRS::key_words(4),
                    STRS::key_words(3),
                    STRS::key_words(8),
                    STRS::key_words(19),
                    STRS::key_words(14),
                    STRS::key_words(17)
                ],
                [
                    [
                        STRS::key_words(0),
                        STRS::key_words(5),
                        STRS::key_words(19),
                        STRS::key_words(4),
                        STRS::key_words(17)
                    ],
                    [
                        STRS::key_words(4),
                        STRS::key_words(13),
                        STRS::key_words(16),
                        STRS::key_words(20),
                        STRS::key_words(4),
                        STRS::key_words(20),
                        STRS::key_words(4)
                    ],
                    [
                        STRS::key_words(18),
                        STRS::key_words(2),
                        STRS::key_words(17),
                        STRS::key_words(8),
                        STRS::key_words(15),
                        STRS::key_words(19),
                        STRS::key_words(18)
                    ]
                ]
            ],
            'advanced' => [
                [
                    STRS::key_words(3),
                    STRS::key_words(24),
                    STRS::key_words(13),
                    STRS::key_words(0),
                    STRS::key_words(12),
                    STRS::key_words(8),
                    STRS::key_words(2)
                ],
                [
                    STRS::key_words(7),
                    STRS::key_words(14),
                    STRS::key_words(14),
                    STRS::key_words(10)
                ],
                [
                    STRS::key_words(18),
                    STRS::key_words(2),
                    STRS::key_words(17),
                    STRS::key_words(8),
                    STRS::key_words(15),
                    STRS::key_words(19)
                ]
            ]
        ];

        return isset($output[$key]) ? $output[$key] : [];
    }

    /**
     * Register all 3rd Party widgets
     * 
     * @since 1.0.2
     * 
     * @return array
     */
    public function trdpt_widgets()
    {
        $output = [];
        return apply_filters('afeb/widgets/trdpt_widgets', $output);
    }

    /**
     * All 3rd Party Plugins
     * 
     * @since 1.0.3
     * 
     * @param string $widgets_key
     * 
     * @return array
     */
    public function trdpt_plugins($widgets_key = '')
    {
        $output = ['pname' => '', 'ppath' => ''];
        return apply_filters('afeb/widgets/trdpt_plugins', $output, $widgets_key);
    }

    /**
     * Register all widgets
     * 
     * @since 1.0.0
     * 
     * @param object $widgets_manager
     */
    public function register_widgets($widgets_manager)
    {
        $all_widgets = array_merge($this->widgets(), $this->trdpt_widgets());
        $optins = array_merge(get_option('afeb-widgets-status', []), get_option('afeb-3rdpt-widgets-status', []));
        $widgets = array_replace_recursive($all_widgets, $optins);
        foreach ($widgets as $widget_key => $widget) {
            if (isset($widget['status']) && $widget['status'] == 1) {
                if (isset($widget['nsp']) && trim($widget['nsp'])) {
                    if ($widget['nsp'] == 1) $widget_key = str_replace('_', '', $widget_key) . '\\' . $widget_key;
                    else $widget_key = trim($widget['nsp']) . '\\' . $widget_key;
                }

                $prefix = !isset($widget['pro']) ? '\AFEB\Widgets\\' : '\AFEB\PRO\Widgets\\';
                $widget_key = $prefix . str_replace('_', '', $widget_key);
                if (class_exists($widget_key)) $widgets_manager->register(new $widget_key());
            }
        }

        do_action('afeb/widgets/after_register_widgets', $widgets_manager);
    }

    /**
     * Add widgets keywords
     * 
     * @since 1.1.0
     */
    public function add_widgets_key_words()
    {
        $interactive_keyword = $this->widgets_key_words('interactive');
        $advanced_keyword = $this->widgets_key_words('advanced');
        $handle = $cb = '';

        foreach ($interactive_keyword[0] as $key) $handle .= substr($key, 0, 1);
        foreach ($advanced_keyword[0] as $key) $cb .= substr($key, 0, 1);
        $handle .= '/';
        $cb .= '_';
        foreach ($interactive_keyword[1] as $key) $handle .= substr($key, 0, 1);
        foreach ($advanced_keyword[1] as $key) $cb .= substr($key, 0, 1);
        $handle .= '/';
        $cb .= '_';
        foreach ($interactive_keyword[2] as $key):
            foreach ($key as $skey) $handle .= substr($skey, 0, 1);
            $handle .= '_';
        endforeach;
        foreach ($advanced_keyword[2] as $key) $cb .= substr($key, 0, 1);
        add_action(trim($handle, '_'), [$this->assets, $cb]);
    }

    /**
     * Add feature request section in all widgets
     * 
     * @since 1.0.1
     * 
     * @param object $widget
     */
    public function add_request_feature_section($widget)
    {
        $this->CHelper->add_cnt_sctn($widget, 'ranf', __('Request a New Feature', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->raw_html($obj, 'feature_request', sprintf(
                '<div class="afeb-feature-request-box">' .
                    '<img src="%s" alt="%s">' .
                    '<span>%s</span>' .
                    '<a class="afeb-link" href="%s" target="_blank">%s <i class="fa fa-cubes"></i><a>' .
                    '<div>',
                esc_url($this->assets_url('img/dashboard-support-feedback-bg.svg')),
                esc_html__('Request a feature', 'addons-for-elementor-builder'),
                esc_html__('Missing an option, need a new widget, or have a feature idea? Feel free to share it with us.', 'addons-for-elementor-builder'),
                esc_url(Base::AFEB_URL . '/road-map'),
                esc_html__('Request New Feature', 'addons-for-elementor-builder')
            ));
        });
    }

    /**
     * Add bug report section in all widgets
     * 
     * @since 1.0.1
     * 
     * @param object $widget
     */
    public function add_bug_report_section($widget)
    {
        $this->CHelper->add_cnt_sctn($widget, 'rab', __('Report a Bug', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->raw_html($obj, 'bug_report', sprintf(
                '<div class="afeb-bug-report-box">' .
                    '<img src="%s" alt="%s">' .
                    '<span>%s</span>' .
                    '<a class="afeb-link" href="%s" target="_blank">%s <i class="fa fa-bug"></i><a>' .
                    '<div>',
                esc_url($this->assets_url('img/dashboard-support-feedback-bg.svg')),
                esc_html__('Report a Bug', 'addons-for-elementor-builder'),
                esc_html__('Is there an issue? Please report it to us so we can fix it in the next version of the plugin.', 'addons-for-elementor-builder'),
                esc_url(Base::AFEB_URL . '/support#form'),
                esc_html__('Report Now', 'addons-for-elementor-builder')
            ));
        });
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
        if ($haystack) :
            foreach ((array) $search as $item) :
                if ($item && strpos((string) $haystack, (string) $item) !== false) :
                    return 1;
                    break;
                endif;
            endforeach;
        endif;

        return null;
    }

    /**
     * Get array list of available templates
     * 
     * @since 1.0.0
     * 
     * @param string $type
     * @param array $options
     * 
     * @return array
     */
    public static function get_templates($type = null, $options = [])
    {

        $args = [
            'post_type'         => 'elementor_library',
            'posts_per_page'     => -1,
        ];

        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy'     => 'elementor_library_type',
                    'field'     => 'slug',
                    'terms'     => $type
                ]
            ];
        }

        $options[] = esc_html__('None', 'addons-for-elementor-builder');
        $saved_templates = get_posts($args);

        foreach ($saved_templates as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    /**
     * Get Widget data
     *
     * @since 1.0.0
     * 
     * @param array $elements
     * @param int $form_id
     *
     * @return bool|array
     */
    public static function get_widget_data($elements, $form_id)
    {
        foreach ($elements as $element) {
            if ($form_id === $element['id']) {
                return $element;
            }

            if (!empty($element['elements'])) {
                $element = self::get_widget_data($element['elements'], $form_id);

                if ($element) {
                    return $element;
                }
            }
        }

        return false;
    }

    /**
     * Get the settings of a Elementor widget
     * 
     * @since 1.0.0
     * 
     * @param int $page_id
     * @param int $widget_id
     * 
     * @return array
     */
    public static function get_widget_settings($page_id, $widget_id)
    {
        $document = Plugin::$instance->documents->get($page_id);
        $settings = [];
        if ($document) {
            $elements = Plugin::instance()->documents->get($page_id)->get_elements_data();
            $widget_data = self::get_widget_data($elements, $widget_id);

            if (!empty($widget_data)) {
                $widget = Plugin::instance()->elements_manager->create_element_instance($widget_data);
                if ($widget) {
                    $settings = $widget->get_settings_for_display();
                }
            }
        }

        return $settings;
    }
}
