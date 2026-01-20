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
class Tank_Image extends Widget_Base {
	
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
		return 'tank-image';
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
		return __( 'Tank Image', 'tank-plugin' );
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
		return 'eicon-image';
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
			'elementor-img-lazy',
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
				'label' => __( 'Image', 'tank-plugin' ),
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
			'caption',
			[
				'label' => __( 'Image Caption', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
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
			'fixed_width',
			[
				'label' => __( 'Image Width', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'width-100' => '100%',
					'width-auto' => 'Auto',
				],
				'default' => 'width-100',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'img_animation',
			[
				'label' => __( 'Image Animation', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'anim-fadeinup-off' => 'Disable',
					'anim-fadeinup' => 'Enable',
				],
				'default' => 'anim-fadeinup-off',
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
		<div class="tt-image <?php echo esc_attr($settings['img_animation']); ?> <?php echo esc_attr($settings['fixed_height']); ?>  <?php echo esc_attr($settings['bottom_padding']); ?>">
		<figure class="<?php echo esc_attr($settings['fixed_width']); ?>">
		<?php if ( 'yes' === $settings['img_lazy_load'] ) { ?>
		<img class="<?php echo esc_attr($settings['image_parallax']); ?> tt-lazy" src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php } else { ?>
		<img class="<?php echo esc_attr($settings['image_parallax']); ?> " src="<?php echo esc_url($settings['image']['url']); ?>"  alt="<?php echo esc_attr($settings['image']['alt']); ?>">
		<?php } ;?>
		<?php if ( $settings['caption'] ) { ?>
		<figcaption><?php echo do_shortcode($settings['caption']); ?></figcaption>
		<?php };?>
		</figure>
		</div>
        <?php
	}
	

}