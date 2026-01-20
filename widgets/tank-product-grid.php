<?php
namespace TANKEL\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
//use Elementor\WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Tank_Product_Grid extends Widget_Base {

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
		return 'tank-product-grid';
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
		return __( 'Tank Product Grid', 'tank-plugin' );
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
		return 'eicon-posts-grid';
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
 	    return [ 'tank-woocommerce' ];
 	}
	
	/**
	 * A list of scripts that the widgets is depended in
	 **/
	public function get_script_depends() {
		return [ 
			'elementor-shop-lazy',
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
				'label' => __( 'Product Options', 'tank-plugin' ),
			]
		);
		
		$this->add_control(
			'categoryname', [
				'label' => __( 'Include Category', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Optional.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		
		
		$this->add_control(
			'postcount', [
				'label' => __( 'Number of posts to show', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '9' , 'tank-plugin' ),
				'description' => __( 'Optional.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'post_column', [
				'label' => __( 'Column', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '3' , 'tank-plugin' ),
				'description' => __( 'Optional.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'post_orderby',
			[
				'label' => __( 'Orderby', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => 'Date',
					'popularity' => 'Popularity',
					'rand' => 'Randomly',
					'rating' => 'Rating',
					'title' => 'Title',
				],
				'default' => 'date',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'post_visibility',
			[
				'label' => __( 'Visibility', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'visible' => 'Visible',
					'featured' => 'Featured',
				],
				'default' => 'visible',
				'label_block' => true,
			]
		);
		
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_title',
			[
				'label' => __( 'Product Title', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-product-title' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-product-title',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_price',
			[
				'label' => __( 'Product Price', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-product-price, {{WRAPPER}} .tt-product-price del' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .tt-product-price, {{WRAPPER}} .tt-product-price del',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_button',
			[
				'label' => __( 'Add To Cart Button', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-product-adc-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-product-btn::after' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}}  .tt-product-adc-btn',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'pro_star',
			[
				'label' => __( 'Star Ratting', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'star_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce .star-rating::before, {{WRAPPER}} .woocommerce .star-rating span::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
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
		<?php echo do_shortcode('[products limit="'.esc_attr($settings['postcount']).'" paginate="false" columns="'.esc_attr($settings['post_column']).'" orderby="'.esc_attr($settings['post_orderby']).'" category="'.esc_attr($settings['categoryname']).'" visibility="'.esc_attr($settings['post_visibility']).'" ]');?>
        <?php
		

	}

}