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
class Tank_Blockquote extends Widget_Base {

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
		return 'tank-blockquote';
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
		return __( 'Tank Blockquote', 'tank-plugin' );
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
		return 'eicon-blockquote';
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
			'title',
			[
				'label' => __( 'Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Steve Jobs',
				'description' => __( 'e.x: Steve Jobs', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'block-content',
			[
				'label' => __( 'Content', 'tank-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '"Hello, we going manor who did. Do ye is considered occasion directly that. May ecstatic did surprise elegance the ignorant age. Own her miss cold. It so numerous if outlived possession."',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Content', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'text_animation',
			[
				'label' => __( 'Text Animation', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'anim-fadeinup' => 'Enable',
					'anim-fadeinup-off' => 'Disable',
				],
				'default' => 'anim-fadeinup',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'text_align',
			[
				'label' => __( 'Text Align', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text-left' => 'Left',
					'text-center' => 'Center',
					'text-right' => 'Right',
				],
				'default' => 'text-left',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote' => 'color: {{VALUE}};',
					'{{WRAPPER}} blockquote.open-quote::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} blockquote',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title_ft',
			[
				'label' => __( 'Title', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_f_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} blockquote footer' => 'color: {{VALUE}};',
					'{{WRAPPER}} blockquote footer::before' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_f_typography',
				'selector' => '{{WRAPPER}} blockquote footer',
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
		<blockquote class="open-quote <?php echo esc_attr($settings['text_animation']); ?> <?php echo esc_attr($settings['text_align']); ?>">
			<?php echo do_shortcode($settings['block-content']); ?>
			<?php if ( $settings['title'] ) { ?>
				<footer><?php echo do_shortcode($settings['title']); ?></footer>
			<?php } ;?>
		</blockquote>
		
        <?php
		

	}

}