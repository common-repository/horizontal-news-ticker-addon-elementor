<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Horizontal News Ticker Widget
 * 
 */
class Elementor_horizontal_news_ticker extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Mk Store Name widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'horizontal_news_ticker';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('H News Ticker', 'horizontal-news-ticker-addon-domain');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-ticker';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['news_ticker', 'ticker', 'horizontal_news_ticker'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        //##################
        //CONTENT SECTION START
        //##################

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Settings', 'horizontal-news-ticker-addon-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'h_news_ticker_head_text',
            [
                'label' => esc_html__('Head Title', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => "Enter title here...",
                'default' => 'Breaking News'
            ]
        );

        $this->add_control(
            'h_news_ticker_animation_style',
            [
                'label' => esc_html__('Animation Style', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => 'Slide',
                    'fade' => 'Fade',
                    'roll' => 'Rolling',
                ],
            ]
        );


        $this->add_control(
            'h_news_ticker_animation_speed',
            [
                'label' => esc_html__('Animation Speed', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
            ]
        );

        $this->add_control(
            'h_news_ticker_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );

        $category_list = get_categories(array('category'));

        $options = array(
            'none' => 'Select'
        );

        foreach ($category_list as $data) {
            $options[$data->term_id] = $data->name;
        }

        $this->add_control(
            'h_news_ticker_category',
            [
                'label' => esc_html__('Post By Category', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => $options,
            ]
        );


        $this->add_control(
            'h_news_ticker_icon',
            [
                'label' => esc_html__('Icon', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        //##################
        //CONTENT SECTION END
        //##################


        //##################
        //STYLE SECTION START
        //##################

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Ticker Style', 'horizontal-news-ticker-addon-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'h_news_ticker_padding',
            [
                'label' => esc_html__('Padding', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .h-news-ticker-title,{{WRAPPER}} .h-news-ticker .ticker_child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        //Head Style Start
        $this->start_controls_section(
            'style_head_style_section',
            [
                'label' => esc_html__('Ticker Head', 'horizontal-news-ticker-addon-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'h_news_ticker_width',
            [
                'label' => esc_html__('Width', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .h-news-ticker-title' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'h_news_ticker_head_text_color',
            [
                'label' => esc_html__('Heading Text Color', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .h-news-ticker-title h6' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'h_news_ticker_head_bg_color',
            [
                'label' => esc_html__('Background Color', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .h-news-ticker-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => 'Head Text Typography',
                'name' => 'h_news_ticker_head_typography',
                'selector' => '{{WRAPPER}} .h-news-ticker .h-news-ticker-title h6',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'h_news_ticker_head_border',
                'label' => esc_html__('Border', 'horizontal-news-ticker-addon-domain'),
                'selector' => '{{WRAPPER}} .h-news-ticker .h-news-ticker-title',
            ]
        );

        $this->add_control(
            'h_news_ticker_head_border_radius',
            [
                'label' => esc_html__('Border Radius', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .h-news-ticker-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        //start the content area
        $this->start_controls_section(
            'style_content_area_style_section',
            [
                'label' => esc_html__('Ticker Content Area', 'horizontal-news-ticker-addon-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'h_news_ticker_content_text_color',
            [
                'label' => esc_html__('Text Color', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .ticker_child ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'h_news_ticker_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .ticker_child' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h_news_ticker_content_typography',
                'selector' => '{{WRAPPER}} .h-news-ticker .ticker_child ul li a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'h_news_ticker_content_border',
                'label' => esc_html__('Border', 'horizontal-news-ticker-addon-domain'),
                'selector' => '{{WRAPPER}} .h-news-ticker .ticker_child',
            ]
        );

        $this->add_control(
            'h_news_ticker_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'horizontal-news-ticker-addon-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .h-news-ticker .ticker_child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        /**
         * Setup query to show the ‘services’ post type with ‘8’ posts.
         * Output the title with an excerpt.
         */

        $settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 8,
            'cat' => $settings['h_news_ticker_category'],
            'order' => 'ASC',
        );

        $loop = new WP_Query($args);


        $h_news_ticker_animation_speed = $settings['h_news_ticker_animation_speed'];
        $h_news_ticker_animation_delay = $settings['h_news_ticker_animation_delay'];
        $h_news_ticker_animation_style = $settings['h_news_ticker_animation_style'];

?>
        <script>
            jQuery(document).ready(() => {
                jQuery.simpleTicker(jQuery("#demo"), {
                    speed: <?php echo esc_html($h_news_ticker_animation_speed); ?>,
                    delay: <?php echo esc_html($h_news_ticker_animation_delay) ?>,
                    easing: 'swing',
                    effectType: '<?php echo esc_html($h_news_ticker_animation_style) ?>'
                });
            });
        </script>


        <div class="h-news-ticker">
            <div class="h-news-ticker-title">
                <h6>
                    <?php echo esc_html($settings['h_news_ticker_head_text']); ?>
                </h6>
            </div>
            <div id="demo" class="ticker_child">
                <ul>
                    <?php
                    while ($loop->have_posts()) : $loop->the_post();
                    ?>
                        <li><a href="<?php echo esc_attr(get_post_permalink()) ?>"><i class="<?php echo esc_attr($settings['h_news_ticker_icon']['library']) ?> <?php echo esc_attr($settings['h_news_ticker_icon']['value']) ?>"></i><?php echo esc_html(get_the_title()) ?></a></li>
                    <?php
                    endwhile;
                    ?>

                </ul>
            </div>

        </div>


<?php
        wp_reset_postdata();
    }
}
