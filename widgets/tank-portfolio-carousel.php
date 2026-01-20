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
class Tank_Portfolio_Carousel extends Widget_Base {

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
		return 'tank-portfolio-carousel';
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
		return __( 'Tank Portfolio Carousel', 'tank-plugin' );
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
 	    return [ 'tank-addons' ];
 	}
	
	/**
	 * A list of scripts that the widgets is depended in
	 **/
	public function get_script_depends() {
		return [ 
			'elementor-portfolio-carousel',
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
		
		$this->add_control(
			'img_lazy_load',
			[
				'label' => esc_html__( 'Lazy Load', 'tank-plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'tank-plugin' ),
				'label_off' => esc_html__( 'Off', 'tank-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => __( 'Portfolio Styles', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_hover_opt',
			[
				'label' => __( 'Image Hover Effect', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pci-hover-off' => 'Disable',
					'pci-hover' => 'Enable',
				],
				'default' => 'pci-hover-off',
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'title_alignment_opt',
			[
				'label' => __( 'Title Alignment', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pci-caption-center' => 'Center',
					'pci-caption-left' => 'Left',
				],
				'default' => 'pci-caption-center',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'title_stroke',
			[
				'label' => __( 'Title Stroke', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable text stroke effect.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pci-caption-stroke-off' => 'Disable',
					'pci-caption-stroke' => 'Enable',
				],
				'default' => 'pci-caption-stroke-off',
				'label_block' => true,
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
			'slider_mousewheel',
			[
				'label' => __( 'Mouse Wheel', 'tank-plugin' ),
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
			'slider_keyboard',
			[
				'label' => __( 'Keyboard Navigation', 'tank-plugin' ),
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
			'slider_grab_cursor',
			[
				'label' => __( 'Grab Cursor', 'tank-plugin' ),
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
			'slider_pagination',
			[
				'label' => __( 'Pagination Style', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable text stroke effect.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fraction' => 'Fraction',
					'bullets' => 'Bullets',
					'progressbar' => 'Progress Bar',
				],
				'default' => 'fraction',
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
					'{{WRAPPER}} .tt-pci-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pci-caption-stroke.pci-caption-center .tt-pci-caption-front .tt-pci-title' => '-webkit-text-stroke-color: {{VALUE}};',
					'{{WRAPPER}} .pci-caption-stroke .tt-pci-caption-back .tt-pci-title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-pci-title',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Category Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-pci-category' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-info-overlay .portfolio-list-item.pli-image-is-light .pli-category' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .tt-pci-category',
			]
		);
		
		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Pagination Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-pc-arrow' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-pc-pagination-fraction' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-pc-pagination-bullets .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tt-pc-pagination-bullets .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .tt-pc-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Pagination Typography(Fraction)', 'tank-plugin' ),
				'name' => 'cat_pagination_typography',
				'selector' => '{{WRAPPER}} .tt-pc-pagination-fraction',
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
		$hide_br_opt='';
		if( $settings['title_alignment_opt'] == 'pci-caption-center' ) {
		$hide_br_opt='hide-br';
		}
		?>
<div class="tt-portfolio-carousel <?php echo esc_attr($settings['title_stroke']); ?> <?php echo esc_attr($settings['title_alignment_opt']); ?>  cursor-drag-mouse-down pc-scale-down <?php echo esc_attr($settings['img_hover_opt']); ?> <?php echo esc_attr($hide_br_opt);?>"  data-mousewheel="<?php echo esc_attr($settings['slider_mousewheel']); ?>" data-keyboard="<?php echo esc_attr($settings['slider_keyboard']); ?>" data-simulate-touch="<?php echo esc_attr($settings['slider_grab_cursor']); ?>" data-grab-cursor="<?php echo esc_attr($settings['slider_grab_cursor']); ?>" data-pagination-type="<?php echo esc_attr($settings['slider_pagination']); ?>" <?php if ( $settings['slider_autoplay_speed'] ) { ?>data-autoplay="<?php echo esc_attr($settings['slider_autoplay_speed']); ?>"<?php } ;?>>
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					global $post;
					$paged=(get_query_var('paged'))?get_query_var('paged'):1;
					$loop = new \WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
					while ( $loop->have_posts() ) : $loop->the_post();
					$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category', array('exclude' => $settings['categoryname_exclude']));	
					$tank_class = ""; 
					$tank_categories = ""; 
					foreach ($tank_portfolio_category as $tank_item) {
					$tank_class.=esc_attr($tank_item->slug . ' ');
					$tank_categories.='<a class="tt-pci-category" href="'.get_category_link($tank_item->term_id).'">';
					$tank_categories.=esc_attr($tank_item->name . '  ');
					$tank_categories.='</a>';
					}
					if (has_post_thumbnail( $post->ID ) ):
					$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dtank_portfolio_image_gallery_cars' );
					$if_img_light ='';
					$cover_opaity ='';
					//cover color
					if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
					$if_img_light ='pci-image-is-light';
					$cover_opaity ='cover-opacity-4';
					}
					else {
					$cover_opaity ='cover-opacity-3';
					}
					?>
						<div class="swiper-slide">
						<div class="tt-portfolio-carousel-item <?php echo esc_attr($if_img_light);?>" >
						<figure class="tt-pci-image-wrap <?php echo esc_attr($cover_opaity);?>">
						<?php if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){ ?>
						<video class="tt-pci-video" loop playsinline muted preload="metadata" poster="<?php echo esc_url($tank_image[0]);?>">
						<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) { ?>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true));?>" type="video/mp4">
						<?php }; ?>
						<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) { ?>
							<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true));?>" type="video/webm">
						<?php }; ?>
						</video>
						<?php }
						else { ?>
						<?php if ( 'yes' === $settings['img_lazy_load'] ) { ?>
						<img class="tt-pci-image swiper-lazy" src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
						<?php } else { ?>
						<img class="tt-pci-image" src="<?php echo esc_url($tank_image[0]);?>"  alt="<?php the_title();?>">
						<?php } ;?>
						<?php }; ?>
						</figure>
						
						<div class="tt-pci-caption-front">
						<div class="tt-pci-caption">
						<div class="tt-pci-caption-inner">
						<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
						<h2 class="tt-pci-title"><a href="<?php the_permalink();?>" class="" data-cursor="<?php echo do_shortcode($settings['text1']); ?>"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?></a></h2>
						<?php }
						else { ?>
						<h2 class="tt-pci-title"><a href="<?php the_permalink();?>" class="" data-cursor="<?php echo do_shortcode($settings['text1']); ?>"><?php the_title();?></a></h2>
						<?php }; ?>
						<div class="tt-pci-categories">
						<?php echo do_shortcode($tank_categories);?>
						</div>
						</div>
						</div>
						</div>
						<div class="tt-pci-caption tt-pci-caption-back">
						<div class="tt-pci-caption-inner">
						<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
						<h2 class="tt-pci-title"><a href="<?php the_permalink();?>" class="" data-cursor="<?php echo do_shortcode($settings['text1']); ?>"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?></a></h2>
						<?php }
						else { ?>
						<h2 class="tt-pci-title"><a href="<?php the_permalink();?>" class="" data-cursor="<?php echo do_shortcode($settings['text1']); ?>"><?php the_title();?></a></h2>
						<?php }; ?>
						<div class="tt-pci-categories">
						<?php echo do_shortcode($tank_categories);?>
						</div>
						</div>
						</div>
						</div>
						</div>
					<?php
					endif;
					endwhile;
					wp_reset_postdata();?>
				</div>
			</div>
		
		
			<div class="tt-pc-navigation tt-swiper-nav">
				<div class="tt-pc-nav-prev">
					<div class="tt-pc-arrow tt-pc-arrow-prev magnetic-item"></div>
				</div>
				<div class="tt-pc-nav-next">
					<div class="tt-pc-arrow tt-pc-arrow-next magnetic-item"></div>
				</div>
				<div class="tt-pc-pagination"></div>
			</div>
		</div>
        <?php
		

	}

}