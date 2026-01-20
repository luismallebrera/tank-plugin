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
class Tank_Img_Carousel extends Widget_Base {

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
		return 'tank-img-carousel';
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
		return __( 'Tank Image & Video Carousel', 'tank-plugin' );
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
		return 'eicon-slider-push';
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
			'elementor-img-carousel',
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
			'slide_type', [
				'label' => __( 'Slide Type', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Image',
					'st2' => 'Video',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'img_lazy_load',
			[
				'label' => esc_html__( 'Lazy Load', 'candore-plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'candore-plugin' ),
				'label_off' => esc_html__( 'Off', 'candore-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$repeater->add_control(
			'image', [
				'label' => __( 'Image', 'tank-plugin' ),
				'description' => __( 'Upload Slide Image/ Video Poster Image', 'tank-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-1.jpg',
				],
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'mp4_url', [
				'label' => __( 'MP4 Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x: https://yoursite.com/fashion-week.mp4 <br> Required.', 'tank-plugin' ),
				'condition' => [
					'slide_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'webm_url', [
				'label' => __( 'WEBM Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x:  https://yoursite.com/fashion-week.wbem <br> Required.', 'tank-plugin' ),
				'condition' => [
					'slide_type' => 'st2',
				],
			]
		);

		$this->add_control(
			'tankimgcarousels',
			[
				'label' => __( 'Image & Video Carousel', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => __('https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-1.jpg', 'endor-plugin'),
					],
					[
						'image' => __('https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-2.jpg', 'endor-plugin'),
					],
					
					[
						'image' => __('https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-3.jpg', 'endor-plugin'),
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
			'shifted_layout',
			[
				'label' => __( 'Shifted Layout', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable shifted layout.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'cc-shifted' => 'Enable',
					'cc-shifted-off' => 'Disable',
				],
				'default' => 'cc-shifted',
				'label_block' => true,
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
        <div class="tt-content-carousel <?php echo esc_attr($settings['shifted_layout']); ?>  cursor-drag cc-scale-down cc-hide-pagination cc-hide-navigation" data-loop="<?php echo esc_attr($settings['slider_loop']); ?>" data-simulate-touch="true"  data-speed="<?php echo esc_attr($settings['slider_speed']); ?>"  <?php if ( $settings['slider_autoplay_speed'] ) { ?>data-autoplay="<?php echo esc_attr($settings['slider_autoplay_speed']); ?>"<?php } ;?>>
			<div class="swiper">
				<div class="swiper-wrapper">
				<?php foreach( $settings['tankimgcarousels'] as $tankimgcarousel ) {?>
				<div class="swiper-slide">
					<div class="tt-content-carousel-item">
						<figure class="cover-opacity-1 ">
						<?php if( $tankimgcarousel['slide_type'] == 'st2' ) { ?>
						<video class="tt-cc-video" loop playsinline muted preload="metadata" poster="<?php echo esc_url($tankimgcarousel['image']['url']); ?>">
						<?php if ( $tankimgcarousel['mp4_url'] ) { ?>
						<source src="<?php echo esc_url($tankimgcarousel['mp4_url']); ?>" type="video/mp4">
						<?php } ;?>
						<?php if ( $tankimgcarousel['webm_url'] ) { ?>
						<source src="<?php echo esc_url($tankimgcarousel['webm_url']); ?>" type="video/webm">
						<?php } ;?>
						</video>
						<?php } else { ?>
						<?php if ( 'yes' === $settings['img_lazy_load'] ) { ?>
						<img class="tt-cc-image tt-cc-image-parallax swiper-lazy" src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tankimgcarousel['image']['url']); ?>" alt="<?php echo esc_attr($tankimgcarousel['image']['alt']); ?>">
						<?php } else { ?>
						<img class="tt-cc-image tt-cc-image-parallax " src="<?php echo esc_url($tankimgcarousel['image']['url']); ?>"  alt="<?php echo esc_attr($tankimgcarousel['image']['alt']); ?>">
						<?php } ;?>
						<?php } ;?>
						</figure>
					</div>
				</div>
				<?php } ;?>
					
				</div>
			</div>
		<!-- Begin content carousel navigation -->
		<div class="tt-cc-nav-prev">
			<div class="tt-cc-nav-arrow magnetic-item"></div>
		</div>
		<div class="tt-cc-nav-next">
			<div class="tt-cc-nav-arrow magnetic-item"></div>
		</div>
		<!-- End content carousel navigation -->
		<div class="tt-cc-pagination hide-cursor"></div>
        </div>
        <!-- accordion end --> 							
		

        <?php
		
	}
	protected function content_template() {}

}