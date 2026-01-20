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
class Tank_Social_Icons extends Widget_Base {

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
		return 'tank-social-icons';
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
		return __( 'Tank Social Media', 'tank-plugin' );
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
		return 'eicon-social-icons';
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
		
		$this->add_control(
			'sec_title',
			[
				'label' => __( 'Section Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Follow',
				'description' => __( 'e.x: Follow', 'tank-plugin' ),
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
					'no-padding-bottom' => 'None',
					'padding-bottom-5' => '5px',
					'padding-bottom-10' => '10px',
					'padding-bottom-15' => '15px',
					'padding-bottom-20' => '20px',
					'padding-bottom-25' => '25px',
					'padding-bottom-30' => '30px',
					'padding-bottom-40' => '40px',
					'padding-bottom-50' => '50px',
					'padding-bottom-60' => '60px',
				],
				'default' => 'no-padding-bottom',
				'label_block' => true,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'button_type', [
				'label' => __( 'Button Type', 'tank-plugin' ),
					'description' => __( 'Select Yes For 1st Accordion Item.', 'tank-plugin' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'st1' => 'Text',
						'st2' => 'Icon',
				],
				'default' => 'st2',
				'label_block' => true,
			]
		);
	
		$repeater->add_control(
			'media_name', [
				'label' => __( 'Social Media Name', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Fb.' , 'tank-plugin' ),
				'description' => __( 'e.x: Fb.', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'button_type' => 'st1',
				],
			]
		);
		
		$repeater->add_control(
			'icon_class', [
				'label' => __( 'Icon Class', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'fab fa-facebook' , 'tank-plugin' ),
				'description' => __( 'e.x: fab fa-facebook <br>Use <a href="https://fontawesome.com/icons" target="_blank">Fontawesome</a> Icon Class. Only free icons.', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'button_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'media_url', [
				'label' => __( 'Social Media URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'tanksocialicons',
			[
				'label' => __( 'Social Media', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
				],
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Section Title', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-sec-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .social-sec-title',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label' => __( 'Social Media Icon Options', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_icon-color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-buttons > ul > li a' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_social_txt',
			[
				'label' => __( 'Social Media Text Options', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_social_txt_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-txt' => 'color: {{VALUE}};',
				],
				
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_social_txt_typography',
				'selector' => '{{WRAPPER}} .social-txt',
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
        
		<ul class="tt-contact-info <?php echo esc_attr($settings['bottom_padding']); ?>">
		<li class="anim-fadeinup">
		<?php if ( $settings['sec_title'] ) { ?>
		<h6 class="no-margin-bottom margin-top-40 social-sec-title"><?php echo esc_html($settings['sec_title']); ?></h6>
		<?php } ;?>
		<div class="social-buttons">
		<ul>
			<?php foreach( $settings['tanksocialicons'] as $tanksocialicon ) {?>
            <li><a href="<?php echo esc_url($tanksocialicon['media_url']); ?>" class="magnetic-item" target="_blank" rel="noopener">
			<?php if( $tanksocialicon['button_type'] == 'st2' ) { ?>
			<i class="<?php echo esc_attr($tanksocialicon['icon_class']); ?>"></i>
			<?php } else { ?>
			<span class="social-txt"><?php echo esc_attr($tanksocialicon['media_name']); ?></span>
			<?php } ;?>
			</a></li>
			<?php } ; ?>
		</ul>
		</div>
        </li>
        </ul>
        
        <!-- accordion end --> 							
		

        <?php
		
	}
	protected function content_template() {}

}