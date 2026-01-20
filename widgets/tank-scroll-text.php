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
class Tank_Scroll_Text extends Widget_Base {

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
		return 'tank-scroll-text';
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
		return __( 'Tank Scrolling Text', 'tank-plugin' );
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
		return 'eicon-filter';
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
			'elementor-scrolling-text',
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
		
		$this->add_control(
			'text_reverse',
			[
				'label' => __( 'Text Reverse', 'tank-plugin' ),
				'description' => __( 'Reverse scrolling direction.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'scr-text-reverse-off' => 'Disable',
					'scr-text-reverse' => 'Enable',
				],
				'default' => 'scr-text-reverse-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'text_stroke',
			[
				'label' => __( 'Text Stroke', 'tank-plugin' ),
				'description' => __( 'Reverse scrolling direction.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'scr-text-stroke-off' => 'Disable',
					'scr-text-stroke' => 'Enable',
				],
				'default' => 'scr-text-stroke-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'scroll_speed',
			[
				'label' => __( 'Scroll Speed', 'tank-plugin' ),
				'description' => __( 'Default: 15', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '15',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'scroll_content',
			[
				'label' => __( 'Content', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Lets create something awesome together! -',
				'label_block' => true,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Scroll Content', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-scrolling-text-inner' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-scrolling-text.scr-text-stroke .tt-scrolling-text-inner' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-scrolling-text-inner',
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
		<?php if ( $settings['scroll_content'] ) { ?>
		<div class="tt-scrolling-text <?php echo esc_attr($settings['text_stroke']); ?> <?php echo esc_attr($settings['text_reverse']); ?> font-italic" data-scroll-speed="<?php echo esc_attr($settings['scroll_speed']); ?>">
		<div class="tt-scrolling-text-inner " data-text="<?php echo esc_attr($settings['scroll_content']); ?>"><?php echo esc_html($settings['scroll_content']); ?></div>
		</div>
		<?php } ;?>
		

        <?php
		
	}
	protected function content_template() {}

}