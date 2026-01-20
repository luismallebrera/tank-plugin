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
class Tank_Informations extends Widget_Base {

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
		return 'tank-informations';
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
		return __( 'Tank List Item', 'tank-plugin' );
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
			'list_bullet',
			[
				'label' => __( 'Bullet', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'list-styled' => 'Disable',
					'list-styled-off' => 'Enable',
				],
				'default' => 'list-styled',
				'label_block' => true,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'World Brand Design Awards' , 'tank-plugin' ),
				'description' => __( 'e.x: World Brand Design Awards.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'srt_content', [
				'label' => __( 'Short Content', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Donec fringilla tortor at eros.' , 'tank-plugin' ),
				'description' => __( 'e.x: Donec fringilla tortor at eros.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'custom_url', [
				'label' => __( 'Custom URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'button_target', [
				'label' => __( 'Link Target', 'tank-plugin' ),
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
		
		$this->add_control(
			'tanklists',
			[
				'label' => __( 'Information Item', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('World Brand Design Awards', 'tank-plugin'),
						'srt_content' => __('Donec fringilla tortor at eros.', 'tank-plugin'),
						'custom_url' => __('#', 'tank-plugin'),
					],
					[
						'title' => __('Product Design Awards', 'tank-plugin'),
						'srt_content' => __('Cras quis hendrerit nulla.', 'tank-plugin'),
						'custom_url' => __('#', 'tank-plugin'),
					],
				],
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
					'{{WRAPPER}} .tt-link' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-link',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_social_txt',
			[
				'label' => __( 'Short Content', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_social_txt_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-gray' => 'color: {{VALUE}}!important;',
				],
				
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_social_txt_typography',
				'selector' => '{{WRAPPER}} .text-gray',
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
        
		<ul class="<?php echo esc_attr($settings['list_bullet']); ?> ">
		
			<?php foreach( $settings['tanklists'] as $tanklist ) {?>
            <li class="anim-fadeinup">
			<?php if ( $tanklist['title'] ) { ?>
			<h5 class="no-margin"><a href="<?php echo esc_url($tanklist['custom_url']); ?>" class="tt-link" target="<?php echo esc_attr($tanklist['button_target']); ?>" rel="noopener"><?php echo esc_html($tanklist['title']); ?></a></h5>
			<?php } ;?>
			<?php if ( $tanklist['srt_content'] ) { ?>
			<p class="text-gray"><?php echo do_shortcode($tanklist['srt_content']); ?></p>
			<?php } ;?>
			</li>
			<?php } ; ?>
		</ul>
        
        <!-- accordion end --> 							
		

        <?php
		
	}
	protected function content_template() {}

}