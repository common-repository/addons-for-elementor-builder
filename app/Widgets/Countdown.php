<?php

namespace AFEB\Widgets;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use AFEB\Helper;
use AFEB\STRS;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Countdown Widget Class
 * 
 * @class Countdown
 * @version 1.0.0
 */
class Countdown extends Widget_Base
{
    /**
     * @var Assets
     */
    private $assets;

    /**
     * @var ControlsHelper
     */
    private $CHelper;

    /**
     * Countdown Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->countdown_style();
        $this->assets->countdown_script();
    }

    /**
     * Get widget name
     *
     * @since 1.0.0
     *
     * @return string Widget name
     */
    public function get_name()
    {
        return 'afeb_countdown';
    }

    /**
     * Get widget title
     *
     * @since 1.0.0
     *
     * @return string Widget title
     */
    public function get_title()
    {
        return esc_html__('CountDown', 'addons-for-elementor-builder');
    }

    /**
     * Get widget icon
     *
     * @since 1.0.0
     *
     * @return string Widget icon
     */
    public function get_icon()
    {
        return 'afeb-iconsvg-countdown';
    }

    /**
     * Get widget categories
     *
     * @since 1.0.0
     *
     * @return array Widget categories
     */
    public function get_categories()
    {
        return ['afeb_basic'];
    }

    /**
     * Get widget keywords
     *
     * @since 1.0.0
     *
     * @return array Widget keywords
     */
    public function get_keywords()
    {
        return ['countdown', 'countdown', esc_html__('CountDown', 'addons-for-elementor-builder')];
    }

    /**
     * Register Countdown widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', __('Timer', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->dtm_pckr($obj, 'du_dte', __('Due Date', 'addons-for-elementor-builder'), gmdate('Y-m-d H:i:s', strtotime('+1 month')));
            $this->CHelper->slct2($obj, 'cd_itms', esc_html__('Items', 'addons-for-elementor-builder'), [
                'day' => esc_html__('Day', 'addons-for-elementor-builder'),
                'hour' => esc_html__('Hour', 'addons-for-elementor-builder'),
                'minute' => esc_html__('Minute', 'addons-for-elementor-builder'),
                'second' => esc_html__('Second', 'addons-for-elementor-builder')
            ], ['day', 'hour', 'minute', 'second']);
            $this->CHelper->res_chse($obj, 'dsply', 'Display', [
                'block' => ['title' => esc_html__('Block', 'addons-for-elementor-builder'), 'icon'  => 'eicon-gallery-grid'],
                'inline-block' => ['title' => esc_html__('Inline', 'addons-for-elementor-builder'), 'icon'  => 'eicon-form-vertical']
            ], ['{{WRAPPER}} .afeb-countdown .afeb-countdown-timer.afeb-c4 li > section > *' => 'display: {{VALUE}}']);
            $this->CHelper->res_talmnt($obj, 'cd_almnt', '{{WRAPPER}} .afeb-countdown');
            $this->CHelper->chse($obj, 'drct', 'Direction', [
                'left' => ['title' => esc_html__('Left', 'addons-for-elementor-builder'), 'icon'  => 'eicon-h-align-right'],
                'right' => ['title' => esc_html__('Right', 'addons-for-elementor-builder'), 'icon'  => 'eicon-h-align-left']
            ], [], 0);
        });
        /**
         *
         * Translation Section
         *
         */
        $this->CHelper->add_cnt_sctn($this, 'cs2', 'Translation', function ($obj) {
            $this->CHelper->txt($obj, 'day', __('Day', 'addons-for-elementor-builder'), esc_html__('Day', 'addons-for-elementor-builder'), esc_html__('e.g. Day', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'hour', __('Hour', 'addons-for-elementor-builder'), esc_html__('Hour', 'addons-for-elementor-builder'), esc_html__('e.g. Hour', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'minute', __('Minute', 'addons-for-elementor-builder'), esc_html__('Minute', 'addons-for-elementor-builder'), esc_html__('e.g. Minute', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'second', __('Second', 'addons-for-elementor-builder'), esc_html__('Second', 'addons-for-elementor-builder'), esc_html__('e.g. Second', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'plus', __('Apostrophe s', 'addons-for-elementor-builder'), esc_html__('s', 'addons-for-elementor-builder'));
        });
        /**
         *
         * Actions Section
         *
         */
        $this->CHelper->add_cnt_sctn($this, 'cs3', 'Expire Actions', function ($obj) {
            $this->CHelper->slct2($obj, 'tmr_act', 'Actions After Timer Expires', [
                'hide-element' => esc_html__('Hide Element', 'addons-for-elementor-builder'),
                'message' => esc_html__('Display Message', 'addons-for-elementor-builder')
            ]);
            $this->CHelper->dvdr($obj, 'hes', ['tmr_act' => 'hide-element']);
            $this->CHelper->txt($obj, 'he_slctr', __('CSS Selector to Hide Element', 'addons-for-elementor-builder'), '', sprintf('%s #element-id', __('e.g.', 'addons-for-elementor-builder')), 1, ['tmr_act' => 'hide-element']);
            $this->CHelper->dvdr($obj, 'dmt', ['tmr_act' => 'message']);
            $this->CHelper->wysiwyg($obj, 'dsply_msg_txt', __('Display Message', 'addons-for-elementor-builder'), '', '', 1, ['tmr_act' => 'message']);
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * Timer Styles
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss1', __('Timer', 'addons-for-elementor-builder'), function ($obj) {
            $number_slctr = '{{WRAPPER}} .afeb-countdown-number';
            $label_slctr = '{{WRAPPER}} .afeb-countdown-label';
            $em_slctr = '{{WRAPPER}} .afeb-countdown-end-message, {{WRAPPER}} .afeb-countdown-end-message>*';
            $this->CHelper->clr($obj, 'tmr_clr', $number_slctr, __('Timer Color', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'txt_clr', $label_slctr, esc_html__('Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'em_clr', $em_slctr, __('End Message Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'tmr_typo', $number_slctr, __('Timer Typography', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'ttl_typo', $label_slctr, __('Text Typography', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'em_typo', $em_slctr, __('End Message', 'addons-for-elementor-builder'));
        });
        /**
         *
         * Box Styles
         *
         */
        $cdown_slctr = '{{WRAPPER}} .afeb-countdown';
        $this->CHelper->add_stl_sctn($this, 'ss2', esc_html__('Box', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_grp_ctrl($obj, 'bx_bg', $opt[0]);
            $this->CHelper->res_pad($obj, 'bx_pad', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'bx_rdus', $opt[0]);
            $this->CHelper->bx_shdo($obj, 'bx_shdo', $opt[0]);
        }, [$cdown_slctr]);
    }

    /**
     * Render Countdown widget output on the frontend
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->countdown($settings);
    }

    /**
     * Render attributes
     *
     * @since 1.0.4
     * 
     * @param array $settings
     */
    protected function render_attrs($settings = [])
    {
        $this->add_render_attribute(
            [
                'countdown' => [
                    'class' => 'afeb-countdown',
                    'data-settings' => [
                        wp_json_encode([
                            'mmDate' => esc_attr(strtotime($settings['du_dte'])) . '000',
                            'hideElement' => esc_attr($settings['he_slctr']),
                            'displayMessage' => trim($settings['dsply_msg_txt'] . '') ? wp_kses_post($settings['dsply_msg_txt']) : 0
                        ])
                    ]
                ]
            ]
        );

        echo wp_kses_post($this->get_render_attribute_string('countdown'));
    }

    /**
     * Display the Countdown
     *
     * @since 1.0.0
     */
    private function countdown($settings = [])
    {
        $items = array_flip($settings['cd_itms']);
        $items = $settings['drct'] == 'right' ? array_reverse($items) : $items;
        if (count($items) > 0) {

?>
            <div <?php $this->render_attrs($settings); ?>>
                <ul class="afeb-countdown-timer afeb-c<?php echo count($items); ?>">
                    <?php foreach ($items as $key => $value) : ?>
                        <li class="afeb-countdown-<?php echo esc_attr($key); ?>s">
                            <section>
                                <div class="afeb-countdown-number"></div>
                                <span class="afeb-countdown-label">
                                    <?php echo esc_html($settings[$key]);
                                    echo trim($settings['plus']) ? esc_html($settings['plus']) : ''; ?>
                                </span>
                            </section>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
<?php
        } else {
            echo wp_kses(
                Helper::front_notice(STRS::msgs('use_pro'), 'error'),
                Helper::allowed_tags(['div'])
            );
        }
    }
}
