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
class Tank_Contact_Info extends Widget_Base {

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
		return 'tank-contact-info';
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
		return __( 'Tank Contact Info', 'tank-plugin' );
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
		return 'eicon-bullet-list';
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
					'padding-bottom-50' => '60px',
				],
				'default' => 'no-padding-bottom',
				'label_block' => true,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'content_type', [
				'label' => __( 'Content Type', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
						'st1' => 'Email',
						'st2' => 'Phone',
						'st3' => 'Custom URL',
					],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		
		$repeater->add_control(
			'data_info',
			[
				'label' => __( 'Data Content', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Add Content',
				'description' => __( 'e.x: yourmail@domain.com', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'data_url',
			[
				'label' => __( 'Custom URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'yoursite.com',
				'description' => __( 'e.x: yoursite.com', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'content_type' => 'st3',
				],
			]
		);
		
		$repeater->add_control(
			'data_email',
			[
				'label' => __( 'Email Address', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'yourmail@domain.com',
				'description' => __( 'e.x: yourmail@domain.com', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'content_type' => 'st1',
				],
			]
		);
		
		$repeater->add_control(
			'data_phone',
			[
				'label' => __( 'Phone Number', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+(123)456789000',
				'description' => __( 'e.x: +(123)456789000', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'content_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'button_target', [
				'label' => __( 'Link Target', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'description' => 'Working for content type Custom URL.',
				'options' => [
						'_self' => 'Self',
						'_blank' => 'Blank',
						'_parent' => 'Parent',
						'_top' => 'Top',
					],
				'default' => '_self',
				'label_block' => true,
				'condition' => [
					'content_type' => 'st3',
				],
			]
		);
		
		$this->add_control(
			'contact_info_loop',
			[
				'label' => __( 'Contact Information', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);


		$this->end_controls_section();
		
				
		$this->start_controls_section(
			'section_style_data_con',
			[
				'label' => __( 'Data Content', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sec_data_con_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-contact-info' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-contact-info a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sec_number_typography',
				'selector' => '{{WRAPPER}} .tt-contact-info',
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
		<?php if ( $settings['contact_info_loop'] ) { ?>
		<ul class="tt-contact-info <?php echo esc_attr($settings['bottom_padding']); ?>">
		<?php foreach( $settings['contact_info_loop'] as $contact_info_loops ) { ?>
		<li class="anim-fadeinup">
		<?php if( $contact_info_loops['content_type'] == 'st3' ) { ?>
		<span class="tt-ci-icon"><i class="fas fa-map-marker-alt"></i></span>
		<a href="<?php echo esc_url($contact_info_loops['data_url']); ?>" class="tt-link" target="<?php echo esc_attr($contact_info_loops['button_target']); ?>"><?php echo esc_html($contact_info_loops['data_info']); ?></a>
		<?php } else if( $contact_info_loops['content_type'] == 'st2' ) { ?>
		<span class="tt-ci-icon"><i class="fas fa-phone"></i></span>
		<a href="tel:<?php echo esc_attr($contact_info_loops['data_phone']); ?>" class="tt-link"><?php echo esc_html($contact_info_loops['data_info']); ?></a>
		<?php } else { ?>
		<span class="tt-ci-icon"><i class="fas fa-envelope"></i></span>
		<a href="mailto:<?php echo esc_attr($contact_info_loops['data_email']); ?>" class="tt-link"><?php echo esc_html($contact_info_loops['data_info']); ?></a>
		<?php } ;?>
		</li>
		<?php } ;?>
		</ul>
		<?php } ;?>
		<?php
		
	}
	protected function content_template() {}
}