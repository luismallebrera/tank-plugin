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
class Tank_Text_Block extends Widget_Base {

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
		return 'tank-text-block';
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
		return __( 'Tank Text Block', 'tank-plugin' );
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
		return 'eicon-text';
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
			'block-content',
			[
				'label' => __( 'Content', 'tank-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => 'Hello, we going manor who did. Do ye is considered occasion directly that. May ecstatic did surprise elegance the ignorant age. Own her miss cold. It so numerous if outlived possession.',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Settings', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
			'text_alter',
			[
				'label' => __( 'Alternative Font Style', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'font-alter-off' => 'Disable',
					'font-alter' => 'Enable',
				],
				'default' => 'font-alter-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'font_size',
			[
				'label' => __( 'Font Size(Theme Deafult Styles)', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text-df' => 'Default',
					'text-sm' => 'SM',
					'text-lg' => 'LG',
					'text-xlg' => 'XLG',
					'text-xxlg' => 'XXLG',
					'text-xxxlg' => 'XXXLG',
				],
				'default' => 'text-df',
				'label_block' => true,
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
			'font_style',
			[
				'label' => __( 'Font Style(Theme Deafult Styles)', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ft_st_df' => 'Default',
					'font-normal' => 'Normal',
					'font-bold' => 'Bold',
					'font-italic' => 'Italic',
				],
				'default' => 'ft_st_df',
				'label_block' => true,
			]
		);
		

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tank-text-block' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tank-text-block',
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
		<div class="<?php echo esc_attr($settings['font_style']); ?> <?php echo esc_attr($settings['font_size']); ?> <?php echo esc_attr($settings['text_align']); ?> <?php echo esc_attr($settings['text_alter']); ?> tank-text-block">
		<div class="clear <?php echo esc_attr($settings['text_animation']); ?> ">
		<?php echo do_shortcode($settings['block-content']); ?>
		</div>
		</div>
        <?php
		

	}

}