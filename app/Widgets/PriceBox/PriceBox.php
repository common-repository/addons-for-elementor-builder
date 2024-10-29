<?php

namespace AFEB\Widgets\PriceBox;

use AFEB\Assets;
use AFEB\Base;
use AFEB\Controls\CHelper;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" PriceBox Widget Class
 * 
 * @class PriceBox
 * @version 1.0.0
 */
class PriceBox extends Widget_Base
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
     * PriceBox Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->price_box_style();
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
        return 'afeb_price_box';
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
        return esc_html__('Price Box', 'addons-for-elementor-builder');
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
        return 'afeb-iconsvg-price-box';
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
        return ['pricebox', 'price_box', esc_html__('Price Box', 'addons-for-elementor-builder')];
    }

    /**
     * Register PriceBox widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', esc_html__('Title', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->txt($obj, 'ttl', esc_html__('Title', 'addons-for-elementor-builder'), esc_html__('Monthly account', 'addons-for-elementor-builder'), esc_html__('e.g. Monthly account', 'addons-for-elementor-builder'));
        });
        /**
         *
         * Price Box Content
         *
         */
        $this->CHelper->add_cnt_sctn($this, 'cs2', esc_html__('Price', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->txt($obj, 'tprc', esc_html__('Price', 'addons-for-elementor-builder'), esc_html__('150.000', 'addons-for-elementor-builder'), esc_html__('e.g. 150.000', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'tp_crncy', __('Currency', 'addons-for-elementor-builder'), esc_html__('$', 'addons-for-elementor-builder'), esc_html__('e.g. $', 'addons-for-elementor-builder'));
            $this->CHelper->sh_swtchr($obj, 'tp_spcl', esc_html__('Special Sales', 'addons-for-elementor-builder'), 1);
            $this->CHelper->txt($obj, 'tp_rglr', __('Regular Price', 'addons-for-elementor-builder'), esc_html__('200.000', 'addons-for-elementor-builder'), esc_html__('e.g. 200.000', 'addons-for-elementor-builder'), 0, ['tp_spcl' => 'yes']);
        });
        /**
         *
         * Features Box Content
         * 
         */
        $this->CHelper->add_cnt_sctn($this, 'cs3', esc_html__('Features', 'addons-for-elementor-builder'), function ($obj) {
            $items = new Repeater();
            $this->CHelper->txt($items, 'itm_ttl', esc_html__('Title', 'addons-for-elementor-builder'), esc_html__('Lorem Ipsum', 'addons-for-elementor-builder'), '', 1);
            $this->CHelper->rptr($obj, 'prcbx', $items->get_controls(), [
                ['itm_ttl' => esc_html__('24-hour support', 'addons-for-elementor-builder')],
                ['itm_ttl' => esc_html__('Half price traffic', 'addons-for-elementor-builder')],
                ['itm_ttl' => esc_html__('Online service', 'addons-for-elementor-builder')],
                ['itm_ttl' => esc_html__('Global bandwidth speed', 'addons-for-elementor-builder')]
            ]);
        });
        /**
         *
         * Table Button
         * 
         */
        $this->CHelper->add_cnt_sctn($this, 'cs4', esc_html__('Button', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->sh_swtchr($obj, 'btn_sh', __('Button Show', 'addons-for-elementor-builder'), 1);
            $this->CHelper->txt($obj, 'tbtn_ttl', esc_html__('Title', 'addons-for-elementor-builder'), esc_html__('Order Account', 'addons-for-elementor-builder'), '', 0, ['btn_sh' => 'yes']);
            $this->CHelper->url($obj, 'tbtn_lnk', 1, Base::AFEB_URL, ['btn_sh' => 'yes']);
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * Table Price Title Styles
         *
         */
        $title_slctr = '{{WRAPPER}} .afeb-price-box .afeb-title';
        $this->CHelper->add_stl_sctn($this, 'ss1', esc_html__('Title', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->talmnt($obj, 'tp_ttl_almnt', $opt[0]);
            $this->CHelper->bg_grp_ctrl($obj, 'tp_ttl_bg', $opt[0]);
            $this->CHelper->clr($obj, 'txt_clr', $opt[0]);
            $this->CHelper->typo($obj, 'ttl_typo', '{{WRAPPER}} .afeb-price-box .afeb-head .afeb-title');
            $this->CHelper->mar($obj, 'ttl_mar', $opt[0]);
            $this->CHelper->pad($obj, 'ttl_pad', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'ttl_rdus', $opt[0], CHelper::BDSU);
            $this->CHelper->bx_shdo($obj, 'ttl_bx_shdo', $opt[0]);
        }, [$title_slctr]);
        /**
         *
         * Table Price Value Box Style
         *
         */
        $pr_box_slctr = '{{WRAPPER}} .afeb-price-box .afeb-price';
        $this->CHelper->add_stl_sctn($this, 'ss2', esc_html__('Price', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_grp_ctrl($obj, 'prc_bg', $opt[0]);
            $this->CHelper->clr($obj, 'prc_txt_clr', $opt[0] . ' div', esc_html__('Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'rglr_prc_txt_clr', $opt[0] . ' .afeb-discount', __('Regular Price Color', 'addons-for-elementor-builder'), ['tp_spcl' => 'yes']);
            $this->CHelper->typo($obj, 'prc_typo', $opt[0] . ' .afeb-p');
            $this->CHelper->typo($obj, 'prc_crncy_typo', $opt[0] . ' .afeb-c', esc_html__('Currency Typography', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'rglr_prc_typo', $opt[0] . ' .afeb-discount', __('Regular Price Typography', 'addons-for-elementor-builder'), ['tp_spcl' => 'yes']);
            $this->CHelper->talmnt($obj, 'prc_almnt', $opt[0]);
            $this->CHelper->mar($obj, 'prc_mar', $opt[0]);
            $this->CHelper->pad($obj, 'prc_pad', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'prc_rdis', $opt[0], CHelper::BDSU);
            $this->CHelper->bx_shdo($obj, 'prc_bx_shdo', $opt[0]);
        }, [$pr_box_slctr]);
        /**
         *
         * Items Box Style
         *
         */
        $content_slctr = '{{WRAPPER}} .afeb-price-box .afeb-content';
        $this->CHelper->add_stl_sctn($this, 'ss3', esc_html__('Currency Typography', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_grp_ctrl($obj, 'prc_itms_bg', $opt[0]);
        }, [$content_slctr]);
        /**
         *
         * Items Style
         *
         */
        $fitem_slctr = '{{WRAPPER}} .afeb-price-box .afeb-features .afeb-item';
        $this->CHelper->add_stl_sctn($this, 'ss4', esc_html__('Features', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_grp_ctrl($obj, 'prc_itms_itm_bg', $opt[0]);
            $this->CHelper->clr($obj, 'prc_fturs_itm_clr', $opt[0], esc_html__('Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'prc_fturs_itm_typo', $opt[0]);
            $this->CHelper->talmnt($obj, 'prc_itms_almnt', $opt[0]);
            $this->CHelper->mar($obj, 'prc_fturs_itm_mar', $opt[0]);
            $this->CHelper->pad($obj, 'prc_fturs_itm_pad', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'prc_fturs_itm_rdus', $opt[0], CHelper::BDSU);
            $this->CHelper->bx_shdo($obj, 'prc_fturs_itm_bx_shdo', $opt[0]);
        }, [$fitem_slctr]);
        /**
         *
         * Table Price Buttons Styles
         *
         */
        $btns_slctr = '{{WRAPPER}} .afeb-price-box .afeb-buttons';
        $this->CHelper->add_stl_sctn($this, 'ss5', esc_html__('Button', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $opt[1] = $opt[0] . ' a';
            $this->CHelper->bg_grp_ctrl($obj, 'prc_btn_bg', $opt[1]);
            $this->CHelper->clr($obj, 'prc_btn_clr', $opt[1], esc_html__('Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'prc_btn_typo', $opt[1]);
            $this->CHelper->talmnt($obj, 'prc_btn_almnt', $opt[1]);
            $this->CHelper->mar($obj, 'prc_btn_mar', $opt[0], [], ['top', 'bottom']);
            $this->CHelper->pad($obj, 'prc_btn_pad', $opt[1]);
            $this->CHelper->brdr_rdus($obj, 'prc_btn_rdus', $opt[1], CHelper::BDSU);
            $this->CHelper->bx_shdo($obj, 'prc_btn_shdo', $opt[1]);
        }, [$btns_slctr], ['btn_sh' => 'yes']);
        /**
         *
         * Table Price Box Styles
         *
         */
        $pr_box_slctr = '{{WRAPPER}} .afeb-price-box';
        $this->CHelper->add_stl_sctn($this, 'ss6', esc_html__('Box', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->brdr_rdus($obj, 'prc_bx_rdus', [$opt[0] => CHelper::FILL_BR_RADIUS], CHelper::BDSU);
            $this->CHelper->bx_shdo($obj, 'prc_cntnt_bx_shdo', $opt[0]);
        }, [$pr_box_slctr]);
    }

    /**
     * Render link (a tag) atts
     *
     * @since 1.0.0
     * 
     * @param array $url_data
     */
    protected function render_link_attrs($url_data)
    {
        $target = $url_data['is_external'] ? 'target="_blank"' : '';
        $nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
        $cu_attr = $url_data['custom_attributes'] ?? false;
        $data = 'href="' . esc_url($url_data['url']) . '" ' . $target . ' ' . $nofollow . ' ' . $cu_attr;

        echo esc_attr($data);
    }

    /**
     * Render Price Box widget output on the frontend
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = $settings['prcbx'];
?>
        <div class="afeb-price-box afeb-price-box">
            <div class="afeb-head">
                <?php if (!empty($settings['ttl'])) : ?>
                    <div class="afeb-title"><?php echo esc_html($settings['ttl']); ?></div>
                <?php endif; ?>
                <?php if (!empty($settings['tprc'])) : ?>
                    <div class="afeb-price">
                        <?php if ($settings['tp_spcl'] === 'yes') : ?>
                            <del class="afeb-discount">
                                <?php echo esc_html($settings['tp_rglr'] . ' ' . $settings['tp_crncy']); ?>
                            </del>
                        <?php endif; ?>
                        <div class="afeb-regular">
                            <div class="afeb-p"><?php echo esc_html($settings['tprc']); ?></div>
                            <div class="afeb-c"><?php echo esc_html($settings['tp_crncy']); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="afeb-content">
                <div class="afeb-features">
                    <?php if ($items) : ?>
                        <ul>
                            <?php foreach ($items as $item) : ?>
                                <li class="afeb-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                    <span><?php echo esc_html($item['itm_ttl']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php if ($settings['btn_sh'] === 'yes') : ?>
                    <div class="afeb-buttons">
                        <a <?php $this->render_link_attrs($settings['tbtn_lnk']) ?>><?php echo esc_html($settings['tbtn_ttl']); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
