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
class Tank_Button extends Widget_Base {

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
		return 'tank-button';
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
		return __( 'Tank Button', 'tank-plugin' );
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
		return 'eicon-button';
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
			'button_type',
			[
				'label' => __( 'Button Type', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-btn-df' => 'Default',
					'tt-btn-round' => 'Rounded',
					'tt-btn-link' => 'Link',
				],
				'default' => 'tt-btn-df',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-btn-primary' => 'Primary',
					'tt-btn-light' => 'Light',
					'tt-btn-light-outline' => 'Outline',
					'tt-btn-dark' => 'Dark',
				],
				'condition' =>  ['button_type' => ['tt-btn-df', 'tt-btn-round']],
				'default' => 'tt-btn-primary',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'button_align',
			[
				'label' => esc_html__( 'Button Alignment', 'nui-plugin' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text-left' => [
						'title' => esc_html__( 'Left', 'nui-plugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'text-center' => [
						'title' => esc_html__( 'Left', 'nui-plugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'text-right' => [
						'title' => esc_html__( 'Right', 'nui-plugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'text-left',
				'toggle' => true,
			]
		);
		
		$this->add_control(
			'df_animation',
			[
				'label' => __( 'Button Animation', 'tank-plugin' ),
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
			'df_margin',
			[
				'label' => __( 'Default Margin', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'df-margin' => 'Enable',
					'df-margin-off' => 'Disable',
				],
				'default' => 'df-margin',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Add Button Text',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'btn_target',
			[
				'label' => __( 'Button Target', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'_self' => 'Self',
					'_blank' => 'Blank',
					'_parent' => 'Parent',
					'_top' => 'Top',
				],
				'default' => '_self',
				'label_block' => true,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
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
					'{{WRAPPER}} .tt-btn > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-primary > *::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-link > *::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-light > *::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-light-outline > *::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-dark > *::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-link::after' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_control(
			'button_back_color',
			[
				'label' => __( 'Background Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-btn-primary, .tt-btn-dark, .tt-btn-light' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
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
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-btn > *, {{WRAPPER}} .tt-btn-link > *::after, {{WRAPPER}} .tt-btn-primary > *::after, {{WRAPPER}} .tt-btn-light > *::after, {{WRAPPER}} .tt-btn-light-outline > *::after, {{WRAPPER}} .tt-btn-dark > *::after',
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
		<?php global $hide_style; ?>
		<?php if( $settings['button_type'] != 'tt-btn-link' ) { ?>
		<?php $hide_style=''.esc_attr($settings['button_style']).''; ?>
		<?php } ;?>
		<?php if ( $settings['button_url'] ) { ?>
		<div class="clear <?php echo esc_attr($settings['button_align']); ?>">
		<div class="tt-btn <?php echo esc_attr($settings['button_type']); ?> <?php echo esc_attr($hide_style);?>  <?php echo esc_attr($settings['df_margin']); ?> <?php echo esc_attr($settings['df_animation']); ?>">
		<a href="<?php echo esc_url($settings['button_url']); ?>" target="<?php echo esc_attr($settings['btn_target']); ?>" data-hover="<?php echo esc_attr($settings['button_text']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
		</div>
		</div>
		<?php } ;?>
        <?php
		

	}

}