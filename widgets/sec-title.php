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
class Sec_Title extends Widget_Base {

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
		return 'sec-title';
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
		return __( 'Section Title', 'tank-plugin' );
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
		return 'eicon-t-letter';
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
			'txt_align',
			[
				'label' => __( 'Text Align', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-heading-center' => 'Center',
					'tt-heading-left' => 'Left',
				],
				'default' => 'tt-heading-center',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'txt_size',
			[
				'label' => __( 'Font Size', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-heading-df' => 'Default',
					'tt-heading-lg' => 'LG',
					'tt-heading-xlg' => 'XLG',
					'tt-heading-xxlg' => 'XXLG',
					'tt-heading-sm' => 'SM',
					'tt-heading-xsm' => 'XSM',
				],
				'default' => 'tt-heading-df',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'txt_stroke',
			[
				'label' => __( 'Text Stroke', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-heading-stroke-none' => 'Disable',
					'tt-heading-stroke' => 'Enable',
				],
				'default' => 'tt-heading-stroke-none',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'txt_padding',
			[
				'label' => __( 'Bottom Padding', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'margin-bottom-10-p' => 'Enable',
					'margin-bottom-off' => 'Disable',
				],
				'default' => 'margin-bottom-10-p',
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Add Title',
				'description' => __( 'e.x: Works<br> For line break use The[br_sm]Story or The[br]Story', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'btn_txt',
			[
				'label' => __( 'Button Text', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Add Button Text',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'btn_url',
			[
				'label' => __( 'Button URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
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
				'label' => __( 'Title', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-heading-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-heading.tt-heading-stroke .tt-heading-title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-heading-title',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label' => __( 'Sub Title', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-heading-subtitle' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .tt-heading-subtitle',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button Text', 'tank-plugin' ),
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
					'{{WRAPPER}} .tt-btn-link::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tt-btn-link > *::after' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .tt-btn > *, {{WRAPPER}} .tt-btn-link > *::after',
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
		<div class="tt-heading <?php echo esc_attr($settings['txt_align']); ?> <?php echo esc_attr($settings['txt_padding']); ?> <?php echo esc_attr($settings['txt_size']); ?> <?php echo esc_attr($settings['txt_stroke']); ?>  anim-fadeinup">
			<?php if ( $settings['sub_title'] ) { ?>
				<h3 class="tt-heading-subtitle text-gray"><?php echo do_shortcode ($settings['sub_title']); ?></h3>
			<?php } ;?>
			<?php if ( $settings['title'] ) { ?>
				<h2 class="tt-heading-title"><?php echo do_shortcode($settings['title']); ?></h2>
			<?php } ;?>
			<?php if ( $settings['btn_url'] ) { ?>
			<div class="tt-btn tt-btn-link margin-top-20">
				<a href="<?php echo esc_url($settings['btn_url']); ?>" target="<?php echo esc_attr($settings['btn_target']); ?>" data-hover="<?php echo esc_attr($settings['btn_txt']); ?>"><?php echo esc_html($settings['btn_txt']); ?></a>
			</div>
			<?php } ;?>
		</div>
        <?php
		

	}

}