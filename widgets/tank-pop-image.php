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
class Tank_Pop_Image extends Widget_Base {
	
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
		return 'tank-pop-image';
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
		return __( 'Tank Popup Image & Video', 'tank-plugin' );
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
		return 'eicon-image-rollover';
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
			'elementor-imgpop-lazy',
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
				'label' => __( 'Image & Video', 'tank-plugin' ),
			]
		);
		
		$this->add_control(
			'popup_type',
			[
				'label' => __( 'Popup Type', 'tank-plugin' ),
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
				'label' => esc_html__( 'Lazy Load', 'tank-plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'tank-plugin' ),
				'label_off' => esc_html__( 'Off', 'tank-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'tank-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'caption',
			[
				'label' => __( 'Image/ Video Caption', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'popup_video_st',
			[
				'label' => __( 'Video Play On Hover', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Disable',
					'st2' => 'Enable',
				],
				'default' => 'st1',
				'label_block' => true,
				'condition' => [
					'popup_type' => 'st2',
				],
			]
		);
		$this->add_control(
			'popup_video_action',
			[
				'label' => __( 'Mouse Leave Action', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pli-image-link' => 'Pause',
					'pli-image-link-stop' => 'Reset',
				],
				'default' => 'pli-image-link',
				'label_block' => true,
				'condition' => [
					'popup_video_st' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'mp4_url',
			[
				'label' => __( 'MP4 Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x: https://yoursite.com/fashion-week.mp4 <br> Required.', 'tank-plugin' ),
				'condition' => [
					'popup_type' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'webm_url',
			[
				'label' => __( 'WEBM Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x:  https://yoursite.com/fashion-week.wbem <br> Required.', 'tank-plugin' ),
				'condition' => [
					'popup_type' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'img_title', [
				'label' => __( 'Image Popup Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'popup_type' => 'st1',
				],
			]
		);
		$this->add_control(
			'img_caption', [
				'label' => __( 'Image Popup Caption', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'popup_type' => 'st1',
				],
			]
		);
		
		$this->add_control(
			'text1',
			[
				'label' => __( 'View /Play', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'View',
				'label_block' => true,
				'description' => __( 'e.x:  Translet Option.<br> e.x:View', 'tank-plugin' ),
			]
		);
		
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Image Options', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fixed_height',
			[
				'label' => __( 'Image Fixed Height', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tti-fixed-height' => 'Enable',
					'tti-fixed-height-off' => 'Disable',
				],
				'default' => 'tti-fixed-height',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'image_parallax',
			[
				'label' => __( 'Image Parallax Effect', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'anim-image-parallax' => 'Enable',
					'anim-image-parallax-off' => 'Disable',
				],
				'default' => 'anim-image-parallax',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'image_overlay',
			[
				'label' => __( 'Image Overlay', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'cover-opacity-0' => 'Default',
					'cover-opacity-0-5' => 'Image Cover 0.5',
					'cover-opacity-1' => 'Image Cover 1',
					'cover-opacity-1-5' => 'Image Cover 1.5',
					'cover-opacity-2' => 'Image Cover 2',
					'cover-opacity-2-5' => 'Image Cover 2.5',
					'cover-opacity-3' => 'Image Cover 3',
					'cover-opacity-3-5' => 'Image Cover 3.5',
					'cover-opacity-4' => 'Image Cover 4',
					'cover-opacity-4-5' => 'Image Cover 4.5',
					'cover-opacity-5' => 'Image Cover 5',
				],
				'default' => 'cover-opacity-0',
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'bottom_padding',
			[
				'label' => __( 'Bottom Padding', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'margin-bottom-df' => 'None',
					'margin-bottom-30' => 'Padding 30px',
					'margin-bottom-40' => 'Padding 40px',
					'margin-bottom-50' => 'Padding 50px',
					'margin-bottom-60' => 'Padding 60px',
					'margin-bottom-70' => 'Padding 70px',
					'margin-bottom-80' => 'Padding 80px',
					'margin-bottom-90' => 'Padding 90px',
					'margin-bottom-100' => 'Padding 100px',
					'margin-bottom-120' => 'Padding 120px',
				],
				'default' => 'margin-bottom-df',
				'label_block' => true,
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_popup_cpation',
			[
				'label' => __( 'Popup Content Title and Background', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_popup_sec_back_color',
			[
				'label' => __( 'Background Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_control(
			'section_popup_cpation_title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html h4' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_popup_cpation_title_typography',
				'selector' => '.lg-sub-html h4',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_popup_cpation_con',
			[
				'label' => __( 'Popup Content Caption', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_popup_cpation_con_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html p' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_popup_cpation_con_typography',
				'selector' => '.lg-sub-html p',
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
		$settings = $this->get_settings();

        ?>
		<div class="tt-image lightgallery <?php echo esc_attr($settings['fixed_height']); ?>  <?php echo esc_attr($settings['bottom_padding']); ?>">
		<?php if( $settings['popup_type'] == 'st2' ) { ?>
		<a href="" class="lg-trigger" data-cursor="<?php echo esc_attr($settings['text1']); ?>" data-html="
				<video class='lg-video-object lg-html5' controls playsinline preload='auto'>
					<?php if ( $settings['mp4_url'] ) { ?>
					<source src='<?php echo esc_url($settings['mp4_url']); ?>' type='video/mp4'>
					<?php } ;?>
					<?php if ( $settings['webm_url'] ) { ?>
					<source src='<?php echo esc_url($settings['webm_url']); ?>' type='video/webm'>
					<?php } ;?>
				</video>">
				
		<?php if( $settings['popup_video_st'] == 'st2' ) { ?>
		<figure class="<?php echo esc_attr($settings['image_overlay']); ?> <?php echo esc_attr($settings['popup_video_action']); ?> ">
		<video class="pgi-video" loop muted preload="metadata" poster="<?php echo esc_url($settings['image']['url']); ?>">
		<?php if ( $settings['mp4_url'] ) { ?>
		<source src="<?php echo esc_url($settings['mp4_url']); ?>" type="video/mp4">
		<?php };?>
		<?php if ( $settings['webm_url'] ) { ?>
		<source src="<?php echo esc_url($settings['webm_url']); ?>" type="video/webm">
		<?php } ;?>
		</video>
		<img class="visiabilty-0 " src="<?php echo esc_url($settings['image']['url']); ?>"  alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php if ( $settings['caption'] ) { ?>
		<figcaption><?php echo do_shortcode($settings['caption']); ?></figcaption>
		<?php };?>
		</figure>
		<?php } else { ?>
		<figure class="<?php echo esc_attr($settings['image_overlay']); ?>">
		<img class="<?php echo esc_attr($settings['image_parallax']); ?> tt-lazy " src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php if ( $settings['caption'] ) { ?>
		<figcaption><?php echo do_shortcode($settings['caption']); ?></figcaption>
		<?php };?>
		</figure>
		<?php } ;?>
		<div class="align-center z-index-2 hide-to-mobile">
					<div class="tt-btn tt-btn-light tt-btn-round anim-fadeinup">
						<div data-hover="<?php echo esc_attr($settings['text1']); ?>"><?php echo esc_attr($settings['text1']); ?></div> <!-- Use short text only! -->
					</div>
				</div>
		</a>
		<?php } else { ?>
		<a data-src="<?php echo esc_url($settings['image']['url']); ?>" class="lg-trigger" data-cursor="<?php echo esc_attr($settings['text1']); ?>"  <?php if ( $settings['img_title'] || $settings['img_caption'] ) { ?>data-sub-html="<h4><?php echo esc_attr($settings['img_title']); ?></h4><br><p><?php echo esc_attr($settings['img_caption']); ?></p>"<?php } ;?>>
		<figure class="<?php echo esc_attr($settings['image_overlay']); ?>">
		<?php if ( 'yes' === $settings['img_lazy_load'] ) { ?>
		<img class="<?php echo esc_attr($settings['image_parallax']); ?> tt-lazy " src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php } else { ?>
		<img class="<?php echo esc_attr($settings['image_parallax']); ?> " src="<?php echo esc_url($settings['image']['url']); ?>"  alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php } ;?>
		<?php if ( $settings['caption'] ) { ?>
		<figcaption><?php echo do_shortcode($settings['caption']); ?></figcaption>
		<?php };?>
		</figure>
		<div class="align-center z-index-2 hide-to-mobile">
					<div class="tt-btn tt-btn-light tt-btn-round anim-fadeinup">
						<div data-hover="<?php echo esc_attr($settings['text1']); ?>"><?php echo esc_attr($settings['text1']); ?></div> <!-- Use short text only! -->
					</div>
				</div>
		</a>
		<?php };?>
		
		</div>
        <?php
		//wp_register_script( 'mailchimp-validate', 'TANK_THEME_URL . '/includes/js/theme.js'', array('jquery'), null, true );
		//wp_register_script('tank-theme', (TANK_THEME_URL . '/includes/js/theme.js'), array('jquery'), '1.0',true);

	}
	

}