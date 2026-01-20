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
class Tank_Product_Carousel extends Widget_Base {

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
		return 'tank-product-carousel';
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
		return __( 'Tank Product Carousel', 'tank-plugin' );
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
		return 'eicon-slider-push';
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
			'elementor-product-carousel',
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
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Optional.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'postoffset', [
				'label' => __( 'Post Offset', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Optional.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => __( 'Carousel Settings', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'slider_autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => __( 'e.x: 5000 <br>Disabled after user first interactions.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_number_count',
			[
				'label' => __( 'Number of slide to show', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '4',
				'description' => __( 'Default 4.', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_loop',
			[
				'label' => __( 'Slider Loop', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => 'Enable',
					'false' => 'Disable',
				],
				'default' => 'true',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Arrow Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-prc-arrow' => 'color: {{VALUE}};',
				],
				'default' =>'',
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
		<?php
		global $product, $tank_image, $post;
		$args = array(
			'post_type' => 'product',
			'product_cat'=> $settings['categoryname'],
			'posts_per_page'=> $settings['postcount'],
			'offset' => $settings['postoffset']
			);
		$loop = new \WP_Query( $args );
?>
<?php if ( $loop->have_posts() ) { ?>
<div class="woocommerce">
	
		<div class="tt-el-product-carousel tt-cart-carousel tt-featured-products-carousel ttp-fixed-height prc-nav-outside " data-space-between="30" data-loop="<?php echo esc_attr($settings['slider_loop']); ?>" data-simulate-touch="true" <?php if ( $settings['slider_autoplay_speed'] ) { ?>data-autoplay="<?php echo esc_attr($settings['slider_autoplay_speed']); ?>"<?php } ;?>  data-slides-per-view="<?php echo esc_attr($settings['slider_number_count']); ?>">
			
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php 
						global $tank_pro_hover_image;
						if( function_exists( 'rwmb_meta' ) ) { ?>
							<?php $tank_pro_hover_image = rwmb_meta( 'tank_product_hover_image','type=image&size=tank_shop_thumb' ); ?>
					<?php } ;?>
					<div class="swiper-slide">
						<div <?php wc_product_class( 'tt-product', $product ); ?>>
							<div class="tt-product-image-holder">
								<a href="<?php the_permalink();?>" class="tt-product-image-wrap">
															
									<?php if (has_post_thumbnail( $post->ID ) ) { ?>
										<?php $tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tank_shop_thumb' );?>
										<figure class="tt-product-image">
											<img class="swiper-lazy" src="<?php echo TANK_THEME_URL ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title_attribute ();?>" />
										</figure> <!-- /.tt-product-image -->
																								
										<figure class="tt-product-hover-image">
										<?php if ( ! empty( $tank_pro_hover_image ) ) { ?>
										<?php foreach ( $tank_pro_hover_image as $waggytails_back_images ){ ?>
											<img class="swiper-lazy" src="<?php echo TANK_THEME_URL ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url(($waggytails_back_images['url']));?>" alt="<?php echo esc_attr(($waggytails_back_images['title']));?>" />
										<?php } ;?>
										<?php } else { ?>
											<img class="swiper-lazy" src="<?php echo TANK_THEME_URL ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title_attribute ();?>" />
										<?php } ;?>
										</figure> <!-- /.tt-product-hover-image -->

										<?php 
											/**
											 * Hook: woocommerce_before_shop_loop_item_title.
											 *
											 * @hooked woocommerce_show_product_loop_sale_flash - 10
											 * @hooked woocommerce_template_loop_product_thumbnail - 10
											 */
											do_action( 'woocommerce_before_shop_loop_item_title' );
										?>
									<?php } ;?>
								</a> <!-- /.tt-product-image-wrap -->

								<div class="tt-product-additional-buttons">
																
									<div class="tt-pr-addit-btn-wrap">
										<?php if( class_exists( 'YITH_WCWL' ) ) { ?>
											<?php echo do_shortcode('[yith_wcwl_add_to_wishlist already_in_wishslist_text="" browse_wishlist_text=""]');?>
										<?php } ;?>
									</div>
								</div> <!-- /.tt-product-additional-buttons -->
							</div> <!-- /.tt-product-image-holder -->

							<div class="tt-product-info">
								<?php
								/**
								* Hook: woocommerce_before_shop_loop_item.
								*
								* @hooked woocommerce_template_loop_product_link_open - 10
								*/
								do_action( 'woocommerce_before_shop_loop_item' );
								?>	
								<h3 class="tt-product-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>

								<?php

								/**
								 * Hook: woocommerce_shop_loop_item_title.
								 *
								 * @hooked woocommerce_template_loop_product_title - 10
								 */
								do_action( 'woocommerce_shop_loop_item_title' );

								/**
								 * Hook: woocommerce_after_shop_loop_item_title.
								 *
								 * @hooked woocommerce_template_loop_rating - 5
								 * @hooked woocommerce_template_loop_price - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item_title' );

								/**
								 * Hook: woocommerce_after_shop_loop_item.
								 *
								 * @hooked woocommerce_template_loop_product_link_close - 5
								 * @hooked woocommerce_template_loop_add_to_cart - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item' );
								?>
							</div> <!-- /.tt-product-info -->
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="tt-prc-nav-prev">
				<div class="tt-prc-arrow tt-prc-arrow-prev magnetic-item"></div>
			</div>
			<div class="tt-prc-nav-next">
			<div class="tt-prc-arrow tt-prc-arrow-next magnetic-item"></div>
			</div>
		</div>
	
</div>
<?php } 
wp_reset_postdata();
?>
        <?php
		

	}

}