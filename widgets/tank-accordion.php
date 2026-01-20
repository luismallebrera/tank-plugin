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
class Tank_Accordion extends Widget_Base {

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
		return 'tank-accordion';
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
		return __( 'Tank Accordion', 'tank-plugin' );
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
		return 'eicon-accordion';
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
			'acc_border',
			[
				'label' => __( 'Accordion Border', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-ac-borders' => 'Enable',
					'tt-ac-borders-off' => 'Disable',
				],
				'default' => 'tt-ac-borders',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'acc_width',
			[
				'label' => __( 'Content Section Width', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'max-width-800' => 'Max Width 800px',
					'max-width' => 'Max Width 100%',
				],
				'default' => 'max-width-800',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'acc_font_size',
			[
				'label' => __( 'Accordion Font Size', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-ac-sm' => 'SM',
					'tt-ac-lg' => 'LG',
					'tt-ac-xlg' => 'XLG',
					'tt-ac-xxlg' => 'XXLG',
				],
				'default' => 'tt-ac-sm',
				'label_block' => true,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'active', [
				'label' => __( 'Active', 'tank-plugin' ),
					'description' => __( 'Select Yes For 1st Accordion Item.', 'tank-plugin' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'is-off' => 'No',
						'is-open' => 'Yes',
				],
				'default' => 'is-off',
				'label_block' => true,
			]
		);
	
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'UX / Research' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'sub_title', [
				'label' => __( 'Sub Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mauris mauris ante' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'acc_content', [
				'label' => __( 'Accordion Content', 'tank-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('<p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
											ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
											amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
											odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>

											<div class="tt-btn tt-btn-link">
												<a href="#" data-hover="Read More">Read More</a>
											</div>', 'tank-plugin'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tankaccordions',
			[
				'label' => __( 'Accordion', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('UX / Research', 'tank-plugin'),
					],
					[
						'title' => __('Digital Strategy', 'tank-plugin'),
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
					'{{WRAPPER}} .tt-ac-head-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-accordion-caret::before, {{WRAPPER}} .tt-accordion-caret::after' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-ac-head-title',
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
					'{{WRAPPER}} .tt-accordion-subtext' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .tt-accordion-subtext',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_counter',
			[
				'label' => __('Accordion Content', 'tank-plugin'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_style_counter_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-accordion-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-accordion-content .tt-btn > *' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_counter_typography',
				'selector' => '{{WRAPPER}} .tt-accordion-content',
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
        <div class="tt-accordion <?php echo esc_attr($settings['acc_border']); ?> <?php echo esc_attr($settings['acc_font_size']); ?>">
			<?php foreach( $settings['tankaccordions'] as $tankaccordion ) {?>
            <div class="tt-accordion-item anim-fadeinup">
				<div class="tt-accordion-heading">
				<?php if ( $tankaccordion['title'] ) { ?>
					<h3 class="tt-ac-head-title"><?php echo esc_html($tankaccordion['title']); ?></h3>
				<?php } ;?>
				<?php if ( $tankaccordion['sub_title'] ) { ?>
					<div class="tt-accordion-subtext"><?php echo esc_html($tankaccordion['sub_title']); ?></div>
				<?php } ;?>
						<div class="tt-accordion-caret-wrap">
							<div class="tt-accordion-caret magnetic-item"></div>
						</div>
				</div> <!-- /.tt-accordion-heading -->
				<div class="tt-accordion-content <?php echo esc_attr($settings['acc_width']); ?> <?php echo esc_html($tankaccordion['active']); ?>">
					<?php echo do_shortcode($tankaccordion['acc_content']); ?>
				</div> <!-- /.tt-accordion-content -->
			</div> <!-- /.tt-accordion-item -->
			<?php } ; ?>
        </div>
        <!-- accordion end --> 							
		

        <?php
		
	}
	protected function content_template() {}

}