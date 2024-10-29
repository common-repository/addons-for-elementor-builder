<?php

namespace AFEB\Widgets;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" FancyText Widget Class
 * 
 * @class FancyText
 * @version 1.0.0
 */
class FancyText extends Widget_Base
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
     * @var HTMLTag
     */
    private $HTML_TG;

    /**
     * FancyText Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->fancy_text_style();
        $this->assets->fancy_text_script();
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
        return 'afeb_fancy_text';
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
        return esc_html__('Fancy Text', 'addons-for-elementor-builder');
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
        return 'afeb-iconsvg-fancy-text';
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
        return ['fancy_text', 'fancy text', esc_html__('Fancy Text', 'addons-for-elementor-builder')];
    }

    /**
     * Register FancyText widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', esc_html__('Fancy Text', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->txt($obj, 'prfx_txt', __('Prefix Text', 'addons-for-elementor-builder'), esc_html__('This is the ', 'addons-for-elementor-builder'));
            $items = new Repeater();
            $this->CHelper->txt($items, 'txt', __('Text', 'addons-for-elementor-builder'), esc_html__('First string', 'addons-for-elementor-builder'));
            $this->CHelper->rptr($obj, 'fnctxt', $items->get_controls(), [['txt' => __('First string', 'addons-for-elementor-builder')]], 'txt');
            $this->CHelper->txt($obj, 'sfx_txt', 'Suffix Text', 'of the sentence.');
        });
        $this->CHelper->add_cnt_sctn($this, 'cs2', __('Settings', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->talmnt($obj, 'almnt');
            $this->CHelper->slct($obj, 'efct', esc_html__('Effect', 'addons-for-elementor-builder'), [
                'type' => esc_html__('Typing', 'addons-for-elementor-builder'),
                'rotate-1' => esc_html__('Rotate', 'addons-for-elementor-builder'),
                'falling' => esc_html__('Falling', 'addons-for-elementor-builder')
            ], 'type');
            $this->CHelper->slct($obj, 'ft_crsr', esc_html__('Cursor', 'addons-for-elementor-builder'), [
                '_' => esc_html__('Underline', 'addons-for-elementor-builder'),
                '|' => esc_html__('Pipe', 'addons-for-elementor-builder'),
                'custom' => esc_html__('Custom', 'addons-for-elementor-builder')
            ], '_', ['efct' => 'type']);
            $this->CHelper->txt($obj, 'ft_cstm_crsr_dai', __('Custom Cursor', 'addons-for-elementor-builder'), '', '', 0, ['efct' => 'type', 'ft_crsr' => 'custom']);
            $this->CHelper->num($obj, 'ft_intrupt_tim', __('Interruption Time', 'addons-for-elementor-builder'), 100, 5000, 1, 1500, '', 0, ['efct' => 'type']);
            $this->CHelper->num($obj, 'ft_rtt_1_intrupt', __('Interruption Time', 'addons-for-elementor-builder'), 1000, 8000, 1, 3000, '', 0, ['efct' => 'rotate-1']);
            $this->CHelper->num($obj, 'ft_flng_intrupt_tim', __('Interruption Time', 'addons-for-elementor-builder'), 100, 5000, 1, 1500, '', 0, ['efct' => 'falling']);
            $this->HTML_TG = [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
                'span' => 'Span',
                'div' => 'Div',
                'p' => 'P'
            ];
            $this->CHelper->slct($obj, 'html_tg', __('HTML tag', 'addons-for-elementor-builder'), $this->HTML_TG, 'h2');
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * Content Styles
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss1', __('Content', 'addons-for-elementor-builder'), function ($obj) {
            $fancy_slctr = '{{WRAPPER}} .afeb-fancy-prefix-text';
            $suffix_slctr = '{{WRAPPER}} .afeb-fancy-suffix-text';
            $this->CHelper->clr($obj, 'prfx_clr', $fancy_slctr, __('Prefix Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'prfx_typo', $fancy_slctr, __('Prefix Text Typography', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'txt_clr', '{{WRAPPER}} .afeb-fancy-text-wrapper', __('Fluid Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'txt_typo', '{{WRAPPER}} .afeb-fancy-text *', __('Fluid Text Typography', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'sfx_clr', $suffix_slctr, __('Suffix Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'sfx_typo', $suffix_slctr, __('Suffix Text Typography', 'addons-for-elementor-builder'));
        });
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
        $classes = [];
        $classes[] = 'afeb-fancy-text-element';
        $classes[] = 'afeb-fancy-text-box-' . (trim($settings['almnt']) ? esc_attr($settings['almnt']) : 'center');
        $classes[] = str_replace('_', ' ', $settings['efct']);
        $this->add_render_attribute(
            [
                'fancy_text' => [
                    'class' => implode(' ', $classes),
                    'data-settings' => [
                        wp_json_encode([
                            'crsr' => $settings['ft_crsr'] != 'custom' ? esc_attr($settings['ft_crsr']) : substr($settings['ft_cstm_crsr_dai'], 0, 1),
                            'intrupt_tim' => isset($settings['ft_intrupt_tim']) ? intval($settings['ft_intrupt_tim']) : 200,
                            'rtt_1_intrupt' => isset($settings['ft_rtt_1_intrupt']) ? intval($settings['ft_rtt_1_intrupt']) : 3000,
                            'flng_intrupt_tim' => isset($settings['ft_flng_intrupt_tim']) ? intval($settings['ft_flng_intrupt_tim']) : 1500
                        ])
                    ]
                ]
            ]
        );

        echo wp_kses_post($this->get_render_attribute_string('fancy_text'));
    }

    /**
     * Render FancyText widget output on the frontend
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $tg = strtolower($settings['html_tg']);
?>
        <<?php echo esc_attr($this->HTML_TG[$tg]); ?> <?php $this->render_attrs($settings); ?>>
            <span class="afeb-fancy-prefix-text"><?php echo esc_html($settings['prfx_txt']); ?></span>
            <span class="afeb-fancy-text">
                <?php
                $i = 1;
                foreach ($settings['fnctxt'] as $item) {
                    $visible = ($i !== 1) ? 'is-hidden' : 'is-visible';
                    echo '<b class="' . esc_attr($visible) . '">' . esc_html($item['txt']) . '</b>';
                    $i++;
                }
                ?>
            </span>
            <span class="afeb-fancy-suffix-text"><?php echo esc_html($settings['sfx_txt']); ?></span>
        </<?php echo esc_attr($this->HTML_TG[$tg]); ?>>
<?php
    }
}
