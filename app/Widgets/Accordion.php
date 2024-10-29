<?php

namespace AFEB\Widgets;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" Accordion Widget Class
 * 
 * @class Accordion
 * @version 1.0.0
 */
class Accordion extends Widget_Base
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
     * Accordion Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->accordion_style();
        $this->assets->accordion_script();
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
        return 'afeb_accordion';
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
        return esc_html__('Accordion', 'addons-for-elementor-builder');
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
        return 'afeb-iconsvg-accordion';
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
        return ['accordion', esc_html__('Accordion', 'addons-for-elementor-builder')];
    }

    /**
     * Register Accordion widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', esc_html__('Accordion', 'addons-for-elementor-builder'), function ($obj) {
            $image_slctr = '{{WRAPPER}} {{CURRENT_ITEM}} .afeb-image';
            $items = new Repeater();

            $this->CHelper->icn($items, 'itm_ic', 'fa fa-trophy', 'fa-solid', '', 1);
            $this->CHelper->cstm_clr($items, 'mn_itm_ic_clr', "$image_slctr,
             {{WRAPPER}} {{CURRENT_ITEM}} .afeb-image > svg", 'color: {{VALUE}};fill: {{VALUE}}', __('Main Icon Color', 'addons-for-elementor-builder'), '#37B7C3');
            $this->CHelper->bg_clr($items, 'mn_itm_ic_bg_clr', $image_slctr, __('Main Icon Background Color', 'addons-for-elementor-builder'), '#EBF4F6');
            $this->CHelper->icn($items, 'itm_opn_ic', 'fa fa-chevron-down', 'fa-solid', __('Close Icon', 'addons-for-elementor-builder'), 1);
            $this->CHelper->icn($items, 'itm_cls_ic', 'fa fa-chevron-up', 'fa-solid', __('Open Icon', 'addons-for-elementor-builder'), 1);
            $this->CHelper->txt_area($items, 'itm_ttl', esc_html__('Title', 'addons-for-elementor-builder'), esc_html__('Lorem Ipsum', 'addons-for-elementor-builder'));
            $this->CHelper->wysiwyg($items, 'itm_dsc', esc_html__('Description', 'addons-for-elementor-builder'), CHelper::$LIM);
            $this->CHelper->rptr($obj, 'accrdn', $items->get_controls(), [
                [
                    'itm_ic' => ['library' => 'solid', 'value' => 'fa fa-shopping-basket'],
                    'mn_itm_ic_clr' => '#6A1B9A',
                    'mn_itm_ic_bg_clr' => '#E1BEE7',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('How do I add items to my cart?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ],
                [
                    'itm_ic' => ['library' => 'solid', 'value' => 'fa fa-user-circle'],
                    'mn_itm_ic_clr' => '#4527A0',
                    'mn_itm_ic_bg_clr' => '#D1C4E9',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('How do I create an account on the website?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ],
                [
                    'itm_ic' => ['library' => 'regualr', 'value' => 'fa fa-wallet'],
                    'mn_itm_ic_clr' => '#283593',
                    'mn_itm_ic_bg_clr' => '#C5CAE9',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('How can I track my order after I make a purchase?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ],
                [
                    'itm_ic' => ['library' => 'regular', 'value' => 'fa fa-thumbs-up'],
                    'mn_itm_ic_clr' => '#1565C0',
                    'mn_itm_ic_bg_clr' => '#BBDEFB',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('Is there an option for guest checkout?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ],
                [
                    'itm_ic' => ['library' => 'regular', 'value' => 'fa fa-edit'],
                    'mn_itm_ic_clr' => '#0277BD',
                    'mn_itm_ic_bg_clr' => '#B3E5FC',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('What are the terms for buying and returning goods?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ],
                [
                    'itm_ic' => ['library' => 'solid', 'value' => 'fa fa-money-bill-alt'],
                    'mn_itm_ic_clr' => '#00838F',
                    'mn_itm_ic_bg_clr' => '#B2EBF2',
                    'itm_opn_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-down'],
                    'itm_cls_ic' => ['library' => 'solid', 'value' => 'fa fa-chevron-up'],
                    'itm_ttl' => __('What payment methods are accepted on the website?', 'addons-for-elementor-builder'),
                    'itm_dsc' => CHelper::$LIM,
                ]
            ]);
        });
        /**
         *
         * Items
         *
         */
        $this->CHelper->add_cnt_sctn($this, 'cs2', esc_html__('Items', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->yn_swtchr($obj, 'def_act_itm', __('Default Active Item', 'addons-for-elementor-builder'));
            $this->CHelper->num($obj, 'def_itm_num', __('Item Number', 'addons-for-elementor-builder'), 1, null, null, 1, '', 0, ['def_act_itm' => 'yes']);
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * Main Icon Style
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss1', __('Main Icon', 'addons-for-elementor-builder'), function ($obj) {
            $image_slctr = '{{WRAPPER}} .afeb-accordion .afeb-items .afeb-item .afeb-image';
            $this->CHelper->icn($obj, 'mn_ic', '', '', '', 1);
            $selector = [$image_slctr => 'font-size: {{SIZE}}{{UNIT}}', "$image_slctr > svg" => 'width: {{SIZE}}{{UNIT}}'];
            $this->CHelper->sldr($obj, 'mn_ic_size', __('Size', 'addons-for-elementor-builder'), $selector, [], CHelper::BDSU);
            $selector = [$image_slctr => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}'];
            $this->CHelper->sldr($obj, 'mn_icn_wdt', __('Main Icon Width', 'addons-for-elementor-builder'), $selector, [], CHelper::BDSU);
            $selector = [$image_slctr => 'border-radius: {{SIZE}}{{UNIT}}'];
            $this->CHelper->sldr($obj, 'mn_ic_brdr_rdus', __('Border Radius', 'addons-for-elementor-builder'), $selector, [], CHelper::BDSU);
        });
        /**
         *
         * Icon Style
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss2', __('Open / Close Icons', 'addons-for-elementor-builder'), function ($obj) {
            $giocn_slctr = '{{WRAPPER}} .afeb-accordion .afeb-items .afeb-item .afeb-title-section .afeb-icon';
            $icon_slctr = "$giocn_slctr.afeb-for-";
            $this->CHelper->icn($obj, 'mn_ic_opn_md', '', '', __('Close Icon', 'addons-for-elementor-builder'), 1);
            $this->CHelper->icn($obj, 'mn_ic_cls_md', '', '', __('Open Icon', 'addons-for-elementor-builder'), 1);
            $selector = $icon_slctr . 'open, ' . $icon_slctr . 'open > svg';
            $this->CHelper->cstm_clr($obj, 'itms_ic_cls_md', $selector, 'color: {{VALUE}};fill: {{VALUE}}', __('Close Mode Icon Color', 'addons-for-elementor-builder'));
            $selector = $icon_slctr . 'close, ' . $icon_slctr . 'close > svg';
            $this->CHelper->cstm_clr($obj, 'itms_ic_opn_md', $selector, 'color: {{VALUE}};fill: {{VALUE}}', __('Open Mode Icon Color', 'addons-for-elementor-builder'));
            $selector = [$giocn_slctr . '>i' => 'font-size: {{SIZE}}{{UNIT}}', $giocn_slctr . '>svg' => 'width: {{SIZE}}{{UNIT}}'];
            $this->CHelper->sldr($obj, 'ic_size', __('Icon Size', 'addons-for-elementor-builder'), $selector, ['min' => 10, 'max' => 50]);
        });
        /**
         *
         * Texts Style
         *
         */
        $item_slctr = '{{WRAPPER}} .afeb-accordion .afeb-items .afeb-item';
        $this->CHelper->add_stl_sctn($this, 'ss3', __('Texts', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $ts_slctr = ' .afeb-title-section .afeb-title';
            $title_slctr = $opt[0] . $ts_slctr;
            $this->CHelper->clr($obj, 'ttl_clr', $opt[0], __('Open Mode Icon Color', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'ttl_clr_hvr', $opt[0] . ":hover $ts_slctr, " . $opt[0] . ".afeb-open $ts_slctr", __('Title Color On Hover', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'dsc_clr', $opt[0] . ' .afeb-description', __('Description Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'ttl_typo', $title_slctr, __('Title Typography', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'dsc_typo', $opt[0] . ' .afeb-description', __('Description Typography', 'addons-for-elementor-builder'));
        }, [$item_slctr]);
        /**
         *
         * Items Styles
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss4', 'Items', function ($obj, $opt) {
            $obj->start_controls_tabs('itms_stl_tbs');
            /**
             * Normal Tab
             */
            $this->CHelper->add_tb($obj, 't1', __('Normal', 'addons-for-elementor-builder'), function ($obj, $opt) {
                $this->CHelper->bg_clr($obj, 'itms_bg_clr', $opt[0]);
                $this->CHelper->brdr($obj, 'itm_brdr_nrm', $opt[0]);
            }, [$opt[0]]);
            /**
             * Hover Tab
             */
            $this->CHelper->add_tb($obj, 't2', __('Hover', 'addons-for-elementor-builder'), function ($obj, $opt) {
                $this->CHelper->bg_clr($obj, 'itms_bg_clr_hvr', $opt[0] . ':hover, ' . $opt[0] . '.afeb-open');
                $this->CHelper->brdr($obj, 'itm_brdr_nrm_hvr', $opt[0] . ':hover');
            }, [$opt[0]]);
            $obj->end_controls_tabs();

            $this->CHelper->dvdr($obj, 'bg_clr');
            $this->CHelper->sldr($obj, 'itms_rdus', __('Border Radius', 'addons-for-elementor-builder'), [$opt[0] => 'border-radius: {{SIZE}}{{UNIT}}'], ['min' => 10, 'max' => 50]);
            $this->CHelper->mar($obj, 'itms_mar', $opt[0]);
            $this->CHelper->pad($obj, 'itms_pad', $opt[0]);
        }, [$item_slctr]);
    }

    /**
     * Render Accordion widget output on the frontend.
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $active_item_number = $settings['def_itm_num'];
?>
        <div class="afeb-accordion">
            <div class="afeb-items">
                <?php
                $count = 1;
                foreach ($settings['accrdn'] as $item) :
                    $classes = [];
                    $classes[] = 'afeb-item';
                    $classes[] = sprintf('elementor-repeater-item-%s', $item['_id']);
                    $classes[] = $active_item_number == $count ? 'afeb-open' : '';
                ?>
                    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
                        <div class="afeb-title-section">
                            <div class="afeb-image">
                                <?php
                                if (!empty($settings['mn_ic']['value'])) Icons_Manager::render_icon($settings['mn_ic']);
                                else Icons_Manager::render_icon($item['itm_ic']);
                                ?>
                            </div>
                            <div class="afeb-title"><?php echo esc_html($item['itm_ttl']); ?></div>
                            <div class="afeb-icon afeb-for-open">
                                <?php
                                if (!empty($settings['mn_ic_opn_md']['value'])) Icons_Manager::render_icon($settings['mn_ic_opn_md']);
                                else Icons_Manager::render_icon($item['itm_opn_ic']);
                                ?>
                            </div>
                            <div class="afeb-icon afeb-for-close">
                                <?php
                                if (!empty($settings['mn_ic_cls_md']['value'])) Icons_Manager::render_icon($settings['mn_ic_cls_md']);
                                else Icons_Manager::render_icon($item['itm_cls_ic']);
                                ?>
                            </div>
                        </div>
                        <div class="afeb-description" <?php echo $active_item_number == $count ? 'style="display: block"' : ''; ?>>
                            <?php echo wp_kses_post($item['itm_dsc']); ?>
                        </div>
                    </div>
                <?php
                    $count++;
                endforeach;
                ?>
            </div>
        </div>
<?php
    }
}
