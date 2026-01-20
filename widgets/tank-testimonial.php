<?php
namespace TANKEL\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Tank_Testimonial extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tank-testimonial';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Tank Testimonial Carousel', 'tank-plugin' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	 public function get_categories() {
 	    return [ 'tank-addons' ];
 	}
	
	/**
	 * A list of scripts that the widgets is depended in
	 **/
	public function get_script_depends() {
		return [ 
			'elementor-testimonial',
		 ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'tank-plugin' ),
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'title', [
				'label' => __( 'Client Name', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '- Wironimo' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		
		$repeater->add_control(
			'testi_content', [
				'label' => __( 'Content', 'tank-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('"One of the best template I have ever had. I love it! Its fully customizable, well coded, fast and responsive - fitting for all kind of devices."', 'tank-plugin'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tanktestimonials',
			[
				'label' => __( 'Testimonial', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('- Wironimo', 'tank-plugin'),
					],
					[
						'title' => __('- Gneto', 'tank-plugin'),
					],
					
				],
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_settings',
			[
				'label' => __( 'Carousel Settings', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'car_width',
			[
				'label' => __( 'Carousel Width', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ts-full-width-off' => 'Default',
					'ts-full-width' => 'Full Width',
				],
				'default' => 'ts-full-width-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => __( 'e.x: 5000 <br>Disabled after user first interactions.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_speed',
			[
				'label' => __( 'Slider Speed', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '900',
				'description' => __( 'Default: 900', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_loop',
			[
				'label' => __( 'Slider Loop', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'false' => 'Disable',
					'true' => 'Enable',
				],
				'default' => 'false',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_pagination',
			[
				'label' => __( 'Slider Pagination', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ts-hide-pagination-off' => 'Enable',
					'ts-hide-pagination' => 'Disable',
				],
				'default' => 'ts-hide-pagination-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'section_slider_pagination_color',
			[
				'label' => __( 'Slider Pagination Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-ts-pagination-bullets .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tt-ts-pagination-bullets .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_pagination' => 'ts-hide-pagination-off',
				],
				
			]
		);
		
		$this->add_control(
			'section_slider_pagination_size',
			[
				'label' => esc_html__( 'Slider Pagination Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tt-ts-pagination-bullets .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				
				'condition' => [
					'slider_pagination' => 'ts-hide-pagination-off',
				],
			]
		);
		
		$this->add_control(
			'slider_navigation',
			[
				'label' => __( 'Slider Navigation', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ts-hide-navigation' => 'Disable',
					'ts-hide-navigation-off' => 'Enable',
				],
				'default' => 'ts-hide-navigation',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'section_slider_navigation_color',
			[
				'label' => __( 'Slider Navigation Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-ts-nav-arrow' => 'color: {{VALUE}};',
				],
				'condition' => [
					'slider_navigation' => 'ts-hide-navigation-off',
				],
				
			]
		);
		
		$this->add_control(
			'section_slider_navigation_width',
			[
				'label' => esc_html__( 'Slider Navigation Arrow Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tt-ts-nav-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				
				'condition' => [
					'slider_navigation' => 'ts-hide-navigation-off',
				],
			]
		);
		
		$this->add_control(
			'slider_con_align',
			[
				'label' => __( 'Text Alignment', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text-center' => 'Center',
					'text-left' => 'Left',
				],
				'default' => 'text-center',
				'label_block' => true,
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title Options', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-testimonials-slider .tt-ts-subtext' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-testimonials-slider .tt-ts-subtext',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_counter',
			[
				'label' => __('Content Options', 'tank-plugin'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_style_counter_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-testimonials-slider .tt-ts-text' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_counter_typography',
				'selector' => '{{WRAPPER}} .tt-testimonials-slider .tt-ts-text',
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        ?>

		<!-- accordion-->                            
        <div class="tt-testimonials-slider <?php echo esc_attr($settings['car_width']); ?> <?php echo esc_attr($settings['slider_con_align']); ?> cursor-drag ts-scale-down <?php echo esc_attr($settings['slider_navigation']); ?> <?php echo esc_attr($settings['slider_pagination']); ?> anim-fadeinup" data-loop="<?php echo esc_attr($settings['slider_loop']); ?>" data-simulate-touch="true" data-speed="<?php echo esc_attr($settings['slider_speed']); ?>" <?php if ( $settings['slider_autoplay_speed'] ) { ?>data-autoplay="<?php echo esc_attr($settings['slider_autoplay_speed']); ?>"<?php } ;?>>
			<div class="swiper el">
				<div class="swiper-wrapper">
					<?php foreach( $settings['tanktestimonials'] as $tanktestimonial ) {?>
					<div class="swiper-slide font-alter">
						<div class="tt-ts-item">
						<?php if ( $tanktestimonial['testi_content'] ) { ?>
							<div class="tt-ts-text">
								<?php echo do_shortcode($tanktestimonial['testi_content']); ?>
							</div>
						<?php } ;?>
						<?php if ( $tanktestimonial['title'] ) { ?>
							<div class="tt-ts-subtext"><?php echo esc_html($tanktestimonial['title']); ?></div>
						<?php };?>
						</div>
					</div> 
					<?php } ; ?>
				</div>
			</div>
			<!-- Testimonials slider navigation (arrows) -->
				<div class="tt-ts-nav-prev">
					<div class="tt-ts-nav-arrow magnetic-item"></div>
				</div>
				<div class="tt-ts-nav-next">
					<div class="tt-ts-nav-arrow magnetic-item"></div>
				</div>
				<!-- Testimonials slider pagination -->
				<div class="tt-ts-pagination hide-cursor"></div>
        </div>
        <!-- accordion end --> 							
		

        <?php
		
	}
	protected function content_template() {}

}