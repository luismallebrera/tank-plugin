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
class Tank_Portfolio_Slider extends Widget_Base {

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
		return 'tank-portfolio-slider';
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
		return __( 'Tank Portfolio Slider', 'tank-plugin' );
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
			'elementor-portfolio-slider',
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
			'title_alignment_opt',
			[
				'label' => __( 'Title Alignment', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'psc-center' => 'Center',
					'psc-left' => 'Left',
				],
				'default' => 'psc-center',
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
					'psc-stroke-off' => 'Disable',
					'psc-stroke' => 'Enable',
				],
				'default' => 'psc-stroke-off',
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
			'slider_speed',
			[
				'label' => __( 'Slider Speed', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '900',
				'description' => __( 'Default: 900', 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_direction',
			[
				'label' => __( 'Slider Direction', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'horizontal' => 'Horizontal',
					'vertical' => 'Vertical',
				],
				'default' => 'horizontal',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_effect',
			[
				'label' => __( 'Slider Effect', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'slide' => 'Slide',
					'fade' => 'Fade',
					'cube' => 'Cube',
					'coverflow' => 'Coverflow',
					'flip' => 'Flip',
				],
				'default' => 'slide',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slider_parallax',
			[
				'label' => __( 'Slider Parallax Effect', 'tank-plugin' ),
				'description' => __( 'If you want to use fade effect, then disable parallax effect.', 'tank-plugin' ),
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
			'slider_nav_hide',
			[
				'label' => __( 'Slider Pagination & Navigation', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable slider naviagtion.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Enable',
					'st2' => 'Disable',
				],
				'default' => 'st1',
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
				'condition' => [
					'slider_nav_hide' => 'st1',
				],
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
					'{{WRAPPER}} .tt-ps-caption-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} body.psi-light-image-on .tt-portfolio-slider-caption.psc-stroke .tt-ps-caption-title: {{VALUE}};',
					'{{WRAPPER}} .tt-portfolio-slider-caption.psc-stroke .tt-ps-caption-title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tt-ps-caption-title a',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Category Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-ps-caption-category' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-info-overlay .portfolio-list-item.pli-image-is-light .pli-category' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .tt-ps-caption-category',
			]
		);
		
		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Pagination Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-ps-nav-arrow' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-ps-nav-pagination-fraction' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tt-ps-nav-pagination-bullets .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tt-ps-nav-pagination-bullets .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .tt-ps-nav-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background-color: {{VALUE}};',
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
		<div class="tt-portfolio-slider cursor-drag-mouse-down" <?php if ( $settings['slider_autoplay_speed'] ) { ?>data-autoplay="<?php echo esc_attr($settings['slider_autoplay_speed']); ?>"<?php } ;?> data-speed="<?php echo esc_attr($settings['slider_speed']); ?>" data-mousewheel="<?php echo esc_attr($settings['slider_mousewheel']); ?>" data-keyboard="<?php echo esc_attr($settings['slider_keyboard']); ?>" data-simulate-touch="<?php echo esc_attr($settings['slider_grab_cursor']); ?>" data-grab-cursor="<?php echo esc_attr($settings['slider_grab_cursor']); ?>" data-pagination-type="<?php echo esc_attr($settings['slider_pagination']); ?>" data-parallax-mouse-move="true" data-direction="<?php echo esc_attr($settings['slider_direction']); ?>" data-effect="<?php echo esc_attr($settings['slider_effect']); ?>" data-parallax="<?php echo esc_attr($settings['slider_parallax']); ?>" >
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
				$tank_categories.='';
				$tank_categories.=esc_attr($tank_item->name . '  ');
				$tank_categories.='';
				}
				if (has_post_thumbnail( $post->ID ) ):
				$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
				$if_img_light ='';
				$cover_opaity ='';
				//cover color
				if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
				$if_img_light ='psi-image-is-light';
				}
				else {
				$cover_opaity ='cover-opacity-3';
				}
				?>
					<div class="swiper-slide <?php echo esc_attr($if_img_light);?> <?php echo esc_attr($tank_class);?>" data-url="<?php the_permalink();?>" data-title="<?php the_title();?>" data-category="<?php echo esc_attr($tank_categories);?>">
					<div class="tt-portfolio-slider-item <?php echo esc_attr($cover_opaity);?>" data-swiper-parallax="50%">
					<?php if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){ ?>
					<video class="tt-bg-video" loop playsinline muted preload="metadata" poster="<?php echo esc_url($tank_image[0]);?>">
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
					<img class="tt-psi-image swiper-lazy" src="<?php echo (TANK_THEME_URL) ;?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
					<?php } else { ?>
					<img class="tt-psi-image " src="<?php echo esc_url($tank_image[0]);?>"  alt="<?php the_title();?>">
					<?php } ;?>
					<?php }; ?>
					</div>
					</div>
				<?php
				endif;
				endwhile;
				wp_reset_postdata();
				?>
				</div>
			</div>
		
		
		
			<div class="tt-portfolio-slider-caption <?php echo esc_attr($settings['title_stroke']); ?> <?php echo esc_attr($settings['title_alignment_opt']); ?>">
				<div class="tt-ps-caption-inner">
					<h2 class="tt-psc-elem tt-ps-caption-title"><a href="" data-cursor="<?php echo do_shortcode($settings['text1']); ?>"></a></h2>
						<div class="tt-psc-elem tt-ps-caption-category"></div>
				</div> <!-- /.tt-ps-caption-inner -->
			</div>
			<?php if( $settings['slider_nav_hide'] != 'st2' ) { ?>
			<div class="tt-portfolio-slider-navigation tt-swiper-nav ">
				<div class="tt-ps-nav-prev">
					<div class="tt-ps-nav-arrow tt-ps-nav-arrow-prev magnetic-item"></div>
				</div>
				<div class="tt-ps-nav-next">
					<div class="tt-ps-nav-arrow tt-ps-nav-arrow-next magnetic-item"></div>
				</div>
				<div class="tt-ps-nav-pagination"></div>
			</div>
			<?php } ;?>
		</div>
        <?php
		

	}

}