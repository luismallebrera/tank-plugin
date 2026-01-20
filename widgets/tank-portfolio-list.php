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
class Tank_Portfolio_List extends Widget_Base {

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
		return 'tank-portfolio-list';
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
		return __( 'Tank Portfolio List', 'tank-plugin' );
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
		return 'eicon-gallery-group';
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
			'elementor-list-lazy',
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
		
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => __( 'Portfolio Styles', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'port_list_layout',
			[
				'label' => __( 'Layout', 'tank-plugin' ),
				'description' => __( 'Select portfolio list layout.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Classic',
					'st2' => 'Compact',
					'st3' => 'Info overlay',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'port_list_alternative_layout',
			[
				'label' => __( 'Alternative Layout', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable portfolio list alternative layout.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pl-alter-off' => 'Disable',
					'pl-alter' => 'Enable',
				],
				'default' => 'pl-alter-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'port_grid_image_cropp',
			[
				'label' => __( 'Image Cropping', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pli-cropped' => 'Enable',
					'pli-cropped-off' => 'Disable',
				],
				'default' => 'pli-cropped',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'img_hover_opt',
			[
				'label' => __( 'Image Hover Effect', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable image hover effect.<br> Behavior depends on block gap.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pli-hover-off' => 'Disable',
					'pli-hover' => 'Enable',
				],
				'default' => 'pli-hover-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'cap_font_size',
			[
				'label' => __( 'Caption Font Size (Base on theme style)', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pli-info-df' => 'Default',
					'pli-info-sm' => 'SM',
					'pli-info-lg' => 'LG',
					'pli-info-xlg' => 'XLG',
					'pli-info-xxlg' => 'XXLG',
				],
				'default' => 'pli-info-df',
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
					'pli-title-stroke-off' => 'Disable',
					'pli-title-stroke' => 'Enable',
				],
				'default' => 'pli-title-stroke-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'post_serial',
			[
				'label' => __( 'Serial Number', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable posts serial number.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Enable',
					'st2' => 'Disable',
				],
				'default' => 'st1',
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
					'{{WRAPPER}} .pli-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-info-overlay .portfolio-list-item.pli-image-is-light .pli-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-list.pli-title-stroke .pli-title a' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pli-title',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Category Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pgi-category' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pli-info-overlay .portfolio-list-item.pli-image-is-light .pli-category' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .pgi-category',
			]
		);
		
		$this->add_control(
			'serial_title_color',
			[
				'label' => __( 'Serial Numbery Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pli-counter::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'serial_title_typography',
				'selector' => '{{WRAPPER}} .pli-counter::before',
			]
		);
		
		$this->add_control(
			'bordere_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-list:not(.pli-info-overlay).pl-compact .portfolio-list-item' => 'border-color: {{VALUE}};',
				],
				'default' =>'',
				'condition' => [
					'port_list_layout' => 'st2',
				],
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
		$port_layout='';
		$cover_opacity='';
		if( $settings['port_list_layout'] == 'st2' ) {
		$port_layout='pl-compact hide-br';
		}
		else if( $settings['port_list_layout'] == 'st3' ) {
		$port_layout='pli-info-overlay';
		$cover_opacity=' cover-opacity-2';
		}
		else {
		$port_layout='';
		}
		?>
		<div class="portfolio-list  <?php echo esc_attr($port_layout);?> <?php echo esc_attr($settings['port_list_alternative_layout']); ?> <?php echo esc_attr($settings['port_grid_image_cropp']); ?> <?php echo esc_attr($settings['img_hover_opt']); ?>  <?php echo esc_attr($settings['cap_font_size']); ?> <?php echo esc_attr($settings['title_stroke']); ?>">
		<?php
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new \WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category', array('exclude' => $settings['categoryname_exclude']));	
		$tank_class = ""; 
		$tank_categories = ""; 
		if( $settings['port_list_layout'] == 'st3' ) {
			foreach ($tank_portfolio_category as $tank_item) {
			$tank_class.=esc_attr($tank_item->slug . ' ');
			$tank_categories.='<div class="pli-category">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</div>';
			}
		}
		else{
			foreach ($tank_portfolio_category as $tank_item) {
			$tank_class.=esc_attr($tank_item->slug . ' ');
			$tank_categories.='<div class="pgi-category"><a href="'.get_category_link($tank_item->term_id).'">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</a></div>';
			}
		}
		if (has_post_thumbnail( $post->ID ) ):
		if( $settings['port_list_layout'] == 'st2' ) {
		$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tank_blog_image' );
		}
		else {
			$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
		}
		$if_img_light ='';
		if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
		$if_img_light ='pli-image-is-light';
		}
		?>
		<div class="portfolio-list-item <?php echo esc_attr($tank_class);?> <?php echo esc_attr($if_img_light)?>">
		<div class="pli-inner">
			<div class="pli-image-col">
			<a href="<?php the_permalink();?>" class="pli-image-link" data-cursor="<?php echo do_shortcode($settings['text1']); ?>">
			<div class="pli-image-holder">
			<?php if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){ ?>
			<div class="pli-image <?php echo esc_attr($cover_opacity);?>">
			<figure class="pli-video-wrap anim-image-parallax">
			<video class="pli-video" loop muted preload="metadata" poster="<?php echo esc_url($tank_image[0]);?>">
			<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) { ?>
			<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true));?>" type="video/mp4">
			<?php } ;?>
			<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) { ?>
			<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true));?>" type="video/webm">
			<?php } ;?>
			</video>
			</figure>
			</div>
			<?php }
			else { ?>
			<figure class="pli-image <?php echo esc_attr($cover_opacity);?>">
			<img class="anim-image-parallax tt-lazy" src="<?php echo TANK_THEME_URL?>/includes/img/low-qlt-thumb.jpg" data-src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
			</figure>
			<?php } ;?> 
			</div>
			<div class="pli-info-col pli-info-inner">
			<div class="pli-info">
			<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
			<h2 class="pli-title"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?></h2>
			<?php 
			} else { ?>
			<h2 class="pli-title"><?php the_title();?></h2>
			<?php } ;?>
			<div class="pli-categories-wrap">
			<?php echo do_shortcode($tank_categories);?>
			</div>
			</div>
			</div>
			</a>
			</div>
			<div class="pli-info-col pli-info-outer">
			<div class="pli-info">
			<?php if( $settings['post_serial'] != 'st2' ) { ?>
			<div class="pli-counter"></div>
			<?php }; ?>
			<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
			<h2 class="pli-title"><a href="<?php the_permalink();?>"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?></a></h2>
			<?php }
			else { ?>
			<h2 class="pli-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php } ;?>
			<div class="pli-categories-wrap">
			<?php echo do_shortcode($tank_categories);?>
			</div>
			</div>
			</div>
		</div>
		</div>
		<?php
		endif;
		endwhile;
		wp_reset_postdata();
		?>
		</div>
		
        <?php
		

	}

}