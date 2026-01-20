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
class Tank_Portfolio_Hover_Carousel extends Widget_Base {

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
		return 'tank-portfolio-hover-carousel';
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
		return __( 'Tank Portfolio Hover Carousel', 'tank-plugin' );
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
		return 'eicon-slides';
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
			'elementor-portfolio-car-hover',
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
				'label' => __( 'Portfolio Options', 'tank-plugin' ),
			]
		);
		
		$this->add_control(
			'port_cover_opacity',
			[
				'label' => __( 'Cover Opacity', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'cover-opacity-0' => 'Opacity 0',
					'cover-opacity-0-5' => 'Opacity 0.5',
					'cover-opacity-1' => 'Opacity 1',
					'cover-opacity-1-5' => 'Opacity 1.5',
					'cover-opacity-2' => 'Opacity 2',
					'cover-opacity-2.5' => 'Opacity 2.5',
					'cover-opacity-3' => 'Opacity 3',
					'cover-opacity-3-5' => 'Opacity 3.5',
					'cover-opacity-4' => 'Opacity 4',
					'cover-opacity-4-5' => 'Opacity 4.5',
					'cover-opacity-5' => 'Opacity 5',
					'cover-opacity-5-5' => 'Opacity 5.5',
					'cover-opacity-6' => 'Opacity 6',
					'cover-opacity-6-5' => 'Opacity 6.5',
				],
				'default' => 'cover-opacity-4',
				'label_block' => true,
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
			'categoryname_exclude', [
				'label' => __( 'Exclude Category Information', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Exclude category information from the post list by the category ID e.x: 6 <br>For multiple category ID e.x: 6 7', 'tank-plugin' ),
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
		
		
		
		$this->add_control(
			'text1', [
				'label' => __( 'View Project', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View[br]Project' , 'tank-plugin' ),
				'description' => __( 'Translet Option.<br> e.x:View[br]Project', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_item',
			[
				'label' => __( 'Portfolio Items', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-portfolio-hover-carousel .swiper-slide.active .tt-phc-item-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-phc-item-title' => '-webkit-text-stroke-color: {{VALUE}};',
					' body.tt-light-bg-on {{WRAPPER}} .tt-portfolio-hover-carousel .swiper-slide.active .tt-phc-item-title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-phc-item-title',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Category Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-phc-category' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .tt-phc-category',
			]
		);
		
		$this->add_control(
			'serial_number_color',
			[
				'label' => __( 'Serial Number Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-phc-item::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'serial_number_typography',
				'selector' => '{{WRAPPER}} .tt-phc-item::before',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_carousel_opt',
			[
				'label' => __( 'Pagination', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Pagination Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-phc-counter' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-phc-counter-separator::before' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'selector' => '{{WRAPPER}} .tt-phc-counter',
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
		<div class="tt-portfolio-hover-carousel cursor-drag-mouse-down" data-loop="true" data-simulate-touch="true" data-grab-cursor="true">

			<!-- Begin swiper container -->
			<div class="swiper">
				<!-- Begin swiper wrapper (required) -->
				<div class="swiper-wrapper">
					<!-- Begin swiper slide 
					======================== -->
					<?php
					global $post;
					$paged=(get_query_var('paged'))?get_query_var('paged'):1;
					$loop = new \WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
					$tank_counter=1;
					while ( $loop->have_posts() ) : $loop->the_post();
					$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category', array('exclude' => $settings['categoryname_exclude']));	
					$tank_class = ""; 
					$tank_categories = ""; 
					foreach ($tank_portfolio_category as $tank_item) {
						$tank_class.=esc_attr($tank_item->slug . ' ');
						$tank_categories.='<div class="tt-phc-category">';
						$tank_categories.=esc_attr($tank_item->name . '  ');
						$tank_categories.='</div>';
					}
					if (has_post_thumbnail( $post->ID ) ):
					$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
					?>
					<div class="swiper-slide" data-slide="<?php echo esc_attr($tank_counter);?>">
						<!-- Begin portfolio hover carousel item 
						========================================= -->
						<a href="<?php the_permalink();?>" class="tt-phc-item" data-number="0<?php echo esc_attr($tank_counter);?>" data-cursor="<?php echo do_shortcode($settings['text1']); ?>">
							<h2 class="tt-phc-item-title">
							<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
								<?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?>
							<?php } else { ?>
								<?php the_title();?>
							<?php } ;?>
							</h2> <!-- You may need to adjust the font size to suit your needs. -->
							<div class="tt-phc-categories">
								<?php echo do_shortcode($tank_categories);?>
							</div> <!-- /.tt-phc-categories -->
						</a>
						<!-- End portfolio hover carousel item -->
					</div> 
					<!-- End swiper slide -->
					<?php
					endif;
					$tank_counter++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<!-- End swiper wrapper -->
			</div>
			<!-- End swiper container -->


			<!-- Begin portfolio hover carousel images 
			=========================================== 
			* IMPORTANT: Make sure the items match the slides (data-slide="*") in the "tt-portfolio-hover-carousel" above!!!
			-->
			<div class="tt-portfolio-hover-carousel-images">
				<div class="phc-images-inner">
					<!-- Add class "phc-image-is-light" if you use a very light image -->
					<!-- Add class "cover-opacity-*" to set an image overlay if needed. For example "cover-opacity-2". More info in the file "helper.css" (no effect with class "phc-image-is-light"). -->
					<?php
					global $post;
					$paged=(get_query_var('paged'))?get_query_var('paged'):1;
					$loop = new \WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
					$tank_counter=1;
					while ( $loop->have_posts() ) : $loop->the_post();
					$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category', array('exclude' => $settings['categoryname_exclude']));	
					$tank_class = ""; 
					$tank_categories = ""; 
					foreach ($tank_portfolio_category as $tank_item) {
						$tank_class.=esc_attr($tank_item->slug . ' ');
						$tank_categories.='<div class="tt-phc-category">';
						$tank_categories.=esc_attr($tank_item->name . '  ');
						$tank_categories.='</div>';
					}
					if (has_post_thumbnail( $post->ID ) ):
					$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
					$if_img_light ='';
					//cover color
					if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
					$if_img_light ='phc-image-is-light';
					}
					?>
					<div class="phc-image <?php echo esc_attr($if_img_light);?> <?php echo esc_attr($settings['port_cover_opacity']); ?> " data-slide="<?php echo esc_attr($tank_counter);?>">
						<?php if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){ ?>
						<video class="phc-video" loop playsinline muted preload="metadata" poster="<?php echo esc_url($tank_image[0]);?>">
						<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) { ?>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true));?>" type="video/mp4">
						<?php }; ?>
						<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) { ?>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true));?>" type="video/webm">
						<?php }; ?>
						</video>
						<?php } else { ?>
						<img src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
						<?php } ;?>
					</div>
					<?php
					endif;
					$tank_counter++;
					endwhile;
					wp_reset_postdata();
					?>
				</div> <!-- /.phc-images-inner -->
			</div>
			<!-- End portfolio hover carousel images -->


			<!-- Begin portfolio hover carousel counter 
			============================================ 
			* IMPORTANT: Make sure the items match the slides (data-slide="*") in the "tt-portfolio-hover-carousel" above!!!
			-->
			<div class="tt-phc-counter tt-swiper-nav">
				<div class="tt-phc-count">
					<?php
					global $post;
					$paged=(get_query_var('paged'))?get_query_var('paged'):1;
					$loop = new \WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
					$tank_counter=1;
					while ( $loop->have_posts() ) : $loop->the_post();
					if (has_post_thumbnail( $post->ID ) ):
					$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
					?>
					<span data-slide="<?php echo esc_attr($tank_counter);?>"><?php echo esc_html($tank_counter);?></span>
					<?php
					endif;
					$tank_counter++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="tt-phc-counter-separator"></div>
			</div>
			<!-- End portfolio hover carousel navigation -->

		</div>
		<!-- End portfolio hover carousel -->
        <?php
		

	}

}