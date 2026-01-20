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
class Tank_Form extends Widget_Base {

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
		return 'tank-form';
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
		return __( 'Tank Contact Form', 'tank-plugin' );
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
		return 'eicon-form-horizontal';
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
			'form_shortcode',
			[
				'label' => __( 'Form Shortcode', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => 'e.x: [contact-form-7 id="5" title="Contact form 1"]',
				'default' => '',
				'label_block' => true,
			]
		);
		
		


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_form_label',
			[
				'label' => __( 'Lable', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'lable_color',
			[
				'label' => __( 'Lable Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} form label' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'lable_typography',
				'selector' => '{{WRAPPER}} form label',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_form_input',
			[
				'label' => __( 'Input', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => __( 'Text Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} textarea, {{WRAPPER}} input[type="text"], {{WRAPPER}} input[type=email]' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'input_border_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} textarea, {{WRAPPER}} input[type="text"], {{WRAPPER}} input[type=email]' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typo',
				'selector' => '{{WRAPPER}} textarea, {{WRAPPER}} input[type="text"], {{WRAPPER}} input[type=email]',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_form_placeholder',
			[
				'label' => __( 'Placeholder', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input::-webkit-input-placeholder, {{WRAPPER}} textarea::-webkit-input-placeholder, {{WRAPPER}} input[type="email"]::-webkit-input-placeholder, {{WRAPPER}} input[type="text"]::-webkit-input-placeholder' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} input:-moz-placeholder, {{WRAPPER}} textarea:-moz-placeholder, {{WRAPPER}} input[type="text"]:-moz-placeholder, {{WRAPPER}} input[type="email"]:-moz-placeholder' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Chrome Placeholder', 'tank-plugin' ),
				'name' => 'placeholder_typography_webkit',
				'selector' => '{{WRAPPER}} input::-webkit-input-placeholder, {{WRAPPER}} textarea::-webkit-input-placeholder',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Mozila Placeholder', 'tank-plugin' ),
				'name' => 'placeholder_typography_moz',
				'selector' => '{{WRAPPER}} input:-moz-placeholder, {{WRAPPER}} textarea:-moz-placeholder',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_form_select',
			[
				'label' => __( 'Select', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'otp_select_color',
			[
				'label' => __( 'Text Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select, .wpcf7-form select' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'select_border_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select, .wpcf7-form select' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'otp_select_opt_color',
			[
				'label' => __( 'Options Text Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select option' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'otp_select_opt_backcolor',
			[
				'label' => __( 'Options Background Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select option' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'opt_seelct_typo',
				'selector' => '{{WRAPPER}} select, .wpcf7-form select',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_form_button',
			[
				'label' => __( 'Button', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} button, {{WRAPPER}} .tt-btn-light-outline:hover > *, {{WRAPPER}} .tt-btn-light-outline > *::after' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-btn-light-outline' => 'box-shadow: inset 0 0 0 2px {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typo',
				'selector' => '{{WRAPPER}} button, {{WRAPPER}} .tt-btn-light-outline > *::after',
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

		<!-- =========== Start of Title============ -->
		<div class="tank-form-wrapper">
           <?php echo do_shortcode($settings['form_shortcode']); ?>
		</div>										
		
	    
	        <!-- =========== End of Title ============ -->

        <?php
		//wp_register_script( 'mailchimp-validate', '//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js', array('jquery'), null, true );

	}

}