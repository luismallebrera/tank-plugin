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
class Tank_Portfolio_Interactive extends Widget_Base {

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
		return 'tank-portfolio-interactive';
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
		return __( 'Tank Portfolio Interactive', 'tank-plugin' );
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
			'elementor-portfolio-scrolling-text',
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
					'pi-compact-off' => 'Interactive',
					'pi-compact' => 'Interactive Compact',
				],
				'default' => 'pi-compact-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'title_hover_opt',
			[
				'label' => __( 'Title Hover Effect', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable title hover effect.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pi-force-scroll' => 'Enable',
					'pi-force-scroll-off' => 'Disable',
				],
				'default' => 'pi-force-scroll',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'title_hover_speed_opt', [
				'label' => __( 'Title Scroll Speed', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '3' , 'tank-plugin' ),
				'description' => __( 'Default: 3', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'title_hover_opt' => 'pi-force-scroll',
				],
			]
		);
		
		$this->add_control(
			'title_stroke',
			[
				'label' => __( 'Title Stroke', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable text stroke effect.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pi-stroke-off' => 'Disable',
					'pi-stroke' => 'Enable',
				],
				'default' => 'pi-stroke-off',
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
		
		$this->add_control(
			'bottom_border',
			[
				'label' => __( 'Bottom Border', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable bottom border.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pi-borders' => 'Enable',
					'pi-borders-off' => 'Disable',
				],
				'default' => 'pi-borders',
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
					'{{WRAPPER}} .pi-item-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pi-item-hover-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-interactive.pi-stroke .pi-item-title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pi-item-title',
				'selector' => '{{WRAPPER}} .pi-item-hover-title',
			]
		);
		
		$this->add_control(
			'serial_title_color',
			[
				'label' => __( 'Serial Numbery Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-interactive.pi-compact .portfolio-interactive-item::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .portfolio-interactive-item::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'serial_title_typography',
				'selector' => '{{WRAPPER}} .portfolio-interactive-item::before',
			]
		);
		
		$this->add_control(
			'bordere_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-interactive.pi-borders .portfolio-interactive-item' => 'border-color: {{VALUE}};',
				],
				'default' =>'',
				'condition' => [
					'bottom_border' => 'pi-borders',
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
		<div class="portfolio-interactive <?php echo esc_attr($settings['port_list_layout']); ?> <?php echo esc_attr($settings['bottom_border']); ?> <?php echo esc_attr($settings['title_stroke']); ?> <?php echo esc_attr($settings['title_hover_opt']); ?>">
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
			$tank_categories.='<div class="pi-item-category"><a href="'.get_category_link($tank_item->term_id).'">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</a></div>';
		}
		if (has_post_thumbnail( $post->ID ) ):
		$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tank_blog' );
		?>
		<div class="portfolio-interactive-item anim-skewinup hide-br <?php echo esc_attr($tank_class);?>" data-scroll-speed=" <?php echo esc_attr($settings['title_hover_speed_opt']); ?>">
		<a href="<?php the_permalink();?>" class="pi-item-title-link">
		<?php if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) { ?>
		<h2 class="pi-item-title"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true));?></h2>
		<div class="pi-item-hover-title"><?php echo do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true))?></div>
		<?php }
		else { ?>
		<h2 class="pi-item-title"><?php the_title()?></h2>
		<div class="pi-item-hover-title"><?php the_title()?></div>
		<?php } ;?>
		</a>
		<div class="pi-item-category-wrap">
		<?php echo do_shortcode($tank_categories);?>
		</div>
		<figure class="pi-item-image cover-opacity-2">
		<?php if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){ ?>
		<video class="pi-item-video" loop muted preload="metadata" poster="<?php echo esc_url($tank_image[0]);?>">
		<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) { ?>
			<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true));?>" type="video/mp4">
		<?php } ?>
		<?php if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) { ?>
			<source src="<?php echo esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true));?>" type="video/webm">
		<?php }; ?>
		</video>
		<?php }
		else { ?>
		<img src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
		<?php } ; ?>
		</figure>
		</div>
		<?php
		endif;
		endwhile;
		wp_reset_postdata();
		?>
		</div>
		<?php if( $settings['post_serial'] == 'st2' ) { ?>
		<style>.portfolio-interactive-item::before{display:none;}</style>
		<?php } ;?>
		
        <?php
		

	}

}