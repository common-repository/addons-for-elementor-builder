<?php

namespace AFEB\Widgets;

use AFEB\Assets;
use AFEB\Controls\CHelper;
use AFEB\Helper;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" NewsTicker Widget Class
 * 
 * @class NewsTicker
 * @version 1.0.0
 */
class NewsTicker extends Widget_Base
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
     * NewsTicker Constructor
     * 
     * @since 1.0.0
     */
    public function __construct($data = [], $args = [])
    {
        parent::__construct($data, $args);
        $this->assets = new Assets();
        $this->CHelper = new CHelper();
        $this->assets->swiper_style();
        $this->assets->swiper_script();
        $this->assets->newsticker_style();
        $this->assets->newsticker_script();
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
        return 'afeb_news_ticker';
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
        return esc_html__('News ticker', 'addons-for-elementor-builder');
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
        return 'afeb-iconsvg-news-ticker';
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
        return ['news ticker', 'news', esc_html__('News ticker', 'addons-for-elementor-builder')];
    }

    /**
     * Register NewsTicker widget controls
     *
     * @since 1.0.0
     */
    public function register_controls()
    {
        $this->CHelper->add_cnt_sctn($this, 'cs1', esc_html__('News ticker', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->txt($obj, 'title', esc_html__('Title', 'addons-for-elementor-builder'), esc_html__('Lates News', 'addons-for-elementor-builder'), esc_html__('e.g. Lates News', 'addons-for-elementor-builder'));
            $allCategories = get_categories();
            $categoryList = [];
            foreach ($allCategories as $item) $categoryList[$item->term_id] = $item->name;
            $this->CHelper->slct2($obj, 'category_ids', __('Categories', 'addons-for-elementor-builder'), $categoryList, [key($categoryList)]);
            $allTags = get_terms(['taxonomy' => 'post_tag', 'hide_empty' => false]);
            $tagsList = [];
            if ($allTags) foreach ($allTags as $item) $tagsList[$item->term_id] = $item->name;
            $this->CHelper->slct2($obj, 'tags_ids', __('Taxonomy', 'addons-for-elementor-builder'), $tagsList);
        });
        /**
         *
         * Settings
         *
         */
        $this->CHelper->add_cnt_sctn($this, 'cs2', __('Settings', 'addons-for-elementor-builder'), function ($obj) {
            $this->CHelper->num($obj, 'posts_count', __('Number of Posts', 'addons-for-elementor-builder'), 1, null, null, 4);
            $this->CHelper->chse($obj, 'posts_order', __('Sort', 'addons-for-elementor-builder'), [
                'ASC' => ['title' => esc_html__('Ascending', 'addons-for-elementor-builder'), 'icon' => 'eicon-sort-up'],
                'DESC' => ['title' => esc_html__('Descending', 'addons-for-elementor-builder'), 'icon' => 'eicon-sort-down']
            ], [], 1, 'DESC');
            $this->CHelper->sh_swtchr($obj, 'show_date', __('Show Date', 'addons-for-elementor-builder'), 1);
        });
        do_action('afeb/widget/content/after_render_content_section', $this);
        /**
         *
         * General Styles
         *
         */
        $swip_head_slctr = '{{WRAPPER}} .afeb-items-swiper-head';
        $new_tcr_slctr = '{{WRAPPER}} .afeb-news-ticker-wrapper';
        $this->CHelper->add_stl_sctn($this, 'ss1', esc_html__('Box', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $selector = [$opt[0] => 'min-height: {{SIZE}}{{UNIT}}', '{{WRAPPER}} .afeb-swiper-news-ticker' => 'min-height: {{SIZE}}{{UNIT}}'];
            $this->CHelper->res_sldr($obj, 'box_height', __('Height', 'addons-for-elementor-builder'), $selector, ['px' => ['min' => 0, 'max' => 1000, 'step' => 1]], ['px']);
            $selector = [$opt[0] => 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}}', $opt[1] => CHelper::FILL_BR_RADIUS];
            $this->CHelper->brdr_rdus($obj, 'box_radius', $selector, [], [], __('Box Border Radius', 'addons-for-elementor-builder'));
        }, [$swip_head_slctr, $new_tcr_slctr]);
        /**
         *
         * Head Styles
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss2', __('Head', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_clr($obj, 'head_backcolor', $opt[0]);
            $this->CHelper->clr($obj, 'head_color', $opt[0]);
            $this->CHelper->typo($obj, 'head_typography', $opt[0]);
            $this->CHelper->res_pad($obj, 'head_padding', $opt[0]);
            $selector = [$opt[0] => 'width: {{SIZE}}{{UNIT}}'];
            $this->CHelper->res_sldr($obj, 'title_meta_width', __('Title/Meta Width', 'addons-for-elementor-builder'), $selector);
        }, [$swip_head_slctr]);
        /**
         *
         * Title Styles
         *
         */
        $this->CHelper->add_stl_sctn($this, 'ss3', esc_html__('Title', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_clr($obj, 'meta_backcolor', $opt[0]);
            $selector = '{{WRAPPER}} .afeb-swiper-title > a';
            $this->CHelper->clr($obj, 'title_color', $selector);
            $this->CHelper->typo($obj, 'title_typography', $selector);
        }, [$new_tcr_slctr]);
        /**
         *
         * Date Styles
         *
         */
        $date_slctr = '{{WRAPPER}} .afeb-swiper-date';
        $this->CHelper->add_stl_sctn($this, 'ss4', __('Date', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_clr($obj, 'date_backcolor', $opt[0]);
            $this->CHelper->clr($obj, 'date_color', $opt[0]);
            $this->CHelper->typo($obj, 'date_typography', $opt[0]);
        }, [$date_slctr]);
        /**
         *
         * BTN Styles
         *
         */

        $nav_slctr = '{{WRAPPER}} .afeb-swiper-news-ticker div[class^="afeb-items-swiper-button"] i';
        $this->CHelper->add_stl_sctn($this, 'ss5', __('Navigation', 'addons-for-elementor-builder'), function ($obj, $opt) {
            $this->CHelper->bg_clr($obj, 'btn_backcolor', $opt[0]);
            $this->CHelper->clr($obj, 'btn_color', $opt[0]);
            $this->CHelper->brdr_rdus($obj, 'btn_radius', $opt[0]);
        }, [$nav_slctr]);
    }

    /**
     * Render attributes
     *
     * @since 1.0.4
     * 
     * @param array $settings
     * @param string $wid
     */
    protected function render_attrs($settings = [], $wid = '')
    {
        $this->add_render_attribute(
            [
                'news_ticker' => [
                    'class' => 'afeb-news-ticker-wrapper',
                    'data-settings' => [wp_json_encode(Helper::get_array(['id' => esc_attr($wid)], 'nt_attr', $settings))]
                ]
            ]
        );

        echo wp_kses_post($this->get_render_attribute_string('news_ticker'));
    }

    /**
     * Render NewsTicker widget output on the frontend
     *
     * @since 1.0.0
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $wid = $this->get_id();
        $categoryIds = $settings['category_ids'];
        $tags_id = $settings['tags_ids'];
        $taxQuery = [];
        if ($categoryIds) {
            $taxQuery[] = [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categoryIds,
            ];
        }
        if ($tags_id) {
            $taxQuery[] = [
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tags_id,
            ];
        }
        if (!empty($taxQuery)) {
            $taxQuery['relation'] = 'AND';
        }
        $args = [
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_count'] ?? 4,
            'order' => $settings['posts_order'] ?? 'DESC',
            'tax_query' => $taxQuery,
        ];
        $posts = new \WP_Query($args);
        $count = 0;
?>
        <div <?php $this->render_attrs($settings, $wid); ?>>
            <h2 class="afeb-items-swiper-head">
                <?php echo esc_html($settings['title']); ?>
            </h2>
            <div class="swiper afeb-swiper-news-ticker afeb-swiper-news-ticker-<?php echo esc_attr($wid); ?>">
                <div class="swiper-wrapper">
                    <?php if ($posts->have_posts()) : ?>
                        <?php while ($posts->have_posts()) :
                            $posts->the_post();
                            $count++;
                            $postDate = get_the_date(get_option('date_format'));
                            $item_id = uniqid(); ?>
                            <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr($item_id); ?>">
                                <div class="afeb-swiper-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                <?php if ($settings['show_date'] == 'yes') : ?>
                                    <div class="afeb-swiper-date"><?php echo esc_html($postDate); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e('Sorry,no posts were found for display.', 'addons-for-elementor-builder'); ?></p>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <?php if ($count > 1) : ?>
                    <div class="items-swiper-nav">
                        <div class="afeb-items-swiper-button-prev ltr"><i class="fa fa-chevron-left"></i></div>
                        <div class="afeb-items-swiper-button-next ltr"><i class="fa fa-chevron-right"></i></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
