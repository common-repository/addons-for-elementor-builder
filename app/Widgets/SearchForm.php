<?php

namespace AFEB\Widgets;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" SearchForm Widget Class
 * 
 * @class SearchForm
 * @version 1.0.0
 */
class SearchForm extends Widget_Base
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
     * SearchForm Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->search_form_style();
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
        return 'afeb_search_form';
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
        return esc_html__('Search Form', 'addons-for-elementor-builder');
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
        return 'afeb-iconsvg-search-form';
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
        return ['search_form', 'searchform', esc_html__('Search Form', 'addons-for-elementor-builder')];
    }

    /**
     * Register SearchForm widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', esc_html__('Search Form', 'addons-for-elementor-builder'), function ($obj) {
            $post_types = get_post_types(['public' => true], 'objects');
            unset($post_types['attachment']);
            $types = ['all' => __('All', 'addons-for-elementor-builder')];
            foreach ($post_types as $post_type) $types[$post_type->name] = $post_type->labels->singular_name;
            $this->CHelper->slct($obj, 'ptyp', __('Post Type', 'addons-for-elementor-builder'), $types);
            $this->CHelper->txt($obj, 'plcdr', __('Place Holder', 'addons-for-elementor-builder'), esc_html__('Search...', 'addons-for-elementor-builder'));
            $this->CHelper->txt($obj, 'btn_txt', __('Button Text', 'addons-for-elementor-builder'), esc_html__('Search', 'addons-for-elementor-builder'));
            $this->CHelper->icn($obj, 'btn_ic', 'fa fa-search', 'fa-solid', __('Button Icon', 'addons-for-elementor-builder'), 1);
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * Button Style
         *
         */
        $btn_slctr = '{{WRAPPER}} .afeb-search-form-btn';
        $this->CHelper->add_stl_sctn($this, 'ss1', esc_html__('Button', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $obj->start_controls_tabs('btn_stl_tbs');
            /**
             * Normal Tab
             */
            $this->CHelper->add_tb($obj, 't1', __('Normal', 'addons-for-elementor-builder'), function ($obj, $opt) {
                $this->CHelper->bg_grp_ctrl($obj, 'btn_background', $opt[0]);
                $this->CHelper->clr($obj, 'btn_clr', $opt[0]);
                $this->CHelper->typo($obj, 'btn_typography', $opt[0]);
                $this->CHelper->pad($obj, 'btn_padd', $opt[0]);
                $this->CHelper->brdr($obj, 'btn_brdr', $opt[0]);
                $this->CHelper->brdr_rdus($obj, 'btn_rdus', $opt[0]);
                $this->CHelper->bx_shdo($obj, 'btn_bx_shdo', $opt[0]);
            }, [$opt[0]]);
            /**
             * Hover Tab
             */
            $this->CHelper->add_tb($obj, 't2', __('Hover', 'addons-for-elementor-builder'), function ($obj, $opt) {
                $this->CHelper->bg_grp_ctrl($obj, 'button_background_hover', $opt[0]);
                $this->CHelper->clr($obj, 'btn_clr_hvr', $opt[0]);
                $this->CHelper->pad($obj, 'btn_pad_hvr', $opt[0]);
                $this->CHelper->brdr_rdus($obj, 'btn_rdus_hvr', $opt[0]);
                $this->CHelper->bx_shdo($obj, 'btn_bx_shdo_hvr', $opt[0]);
            }, [$opt[0] . ':hover']);
            $obj->end_controls_tabs();
        }, [$btn_slctr]);
        /**
         *
         * Icon Style
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss2', esc_html__('Icon', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $icon = $opt[0] . '> i, ' . $opt[0] . '> svg';
            $this->CHelper->bg_grp_ctrl($obj, 'ic_bg', $opt[0]);
            $this->CHelper->clr($obj, 'ic_clr', $icon);
            $range = ['px' => ['min' => 20, 'max' => 50]];
            $this->CHelper->sldr($obj, 'ic_size', __('Size', 'addons-for-elementor-builder'), [$icon => 'width: {{SIZE}}{{UNIT}}'], $range);
            $range = ['px' => ['min' => -200, 'max' => 200]];
            $this->CHelper->sldr($obj, 'ic_vp', __('Vertical Position', 'addons-for-elementor-builder'), [$opt[0] => 'top: {{SIZE}}{{UNIT}}'], $range);
            $this->CHelper->sldr($obj, 'ic_hp', __('Horizontal Position', 'addons-for-elementor-builder'), [$opt[0] => 'left: {{SIZE}}{{UNIT}}'], $range);
            $this->CHelper->pad($obj, 'ic_pad', $opt[0]);
            $this->CHelper->brdr($obj, 'ic_brdr', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'ic_rdus', $opt[0]);
        }, [$btn_slctr . ' .afeb-search-form-icon']);
        /**
         *
         * InputBox Style
         *
         */
        $input_box_slctr = '{{WRAPPER}} .afeb-search-form';
        $input_slctr = $input_box_slctr . ' input[type=text]';
        $input_holder_slctr = $input_slctr . '::placeholder';
        $this->CHelper->add_stl_sctn($this, 'ss3', __('Input Box', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_grp_ctrl($obj, 'box_bg', $opt[0]);
            $this->CHelper->clr($obj, 'bx_txt_clr', $opt[1] . ',' . $opt[2], esc_html__('Text Color', 'addons-for-elementor-builder'));
            $this->CHelper->clr($obj, 'plcdr_txt_clr', $opt[2], __('Place Holder Color', 'addons-for-elementor-builder'));
            $this->CHelper->typo($obj, 'inpt_typo', $opt[1]);
            $this->CHelper->typo($obj, 'plcdr_typo', $opt[2], __('Placeholder Typography', 'addons-for-elementor-builder'));
            $this->CHelper->res_pad($obj, 'bx_pad', $opt[0]);
            $this->CHelper->brdr($obj, 'bx_brdr', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'bx_rdus', $opt[0]);
        }, [$input_box_slctr, $input_slctr, $input_holder_slctr]);
    }

    /**
     * Render SearchForm widget output on the frontend
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $btn_text = $settings['btn_txt'];
        $place_holder = $settings['plcdr'];
        $post_type = $settings['ptyp'];
?>
        <div class="afeb-search-form">
            <form action="<?php echo esc_url(home_url()); ?>" method="get">
                <input type="text" name="s" placeholder="<?php echo esc_attr($place_holder); ?>" autocomplete="off" />
                <button type="submit" class="afeb-search-form-btn">
                    <?php echo esc_html($btn_text); ?>
                    <div class="afeb-search-form-icon">
                        <?php Icons_Manager::render_icon($settings['btn_ic']); ?>
                    </div>
                </button>
                <?php if (!empty($post_type) && $post_type !== 'all') : ?>
                    <input type="hidden" name="post_type" value="<?php echo esc_attr($settings['ptyp']); ?>">
                <?php endif; ?>
            </form>
        </div>
<?php
    }
}
