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
class Tank_Post_Grid extends Widget_Base {

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
		return 'tank-post-grid';
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
		return __( 'Tank Post Grid', 'tank-plugin' );
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
		return 'eicon-gallery-grid';
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
			'elementor-post-grid',
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
				'label' => __( 'Post Options', 'tank-plugin' ),
			]
		);
		
		$this->add_control(
			'enable_filter',
			[
				'label' => __( 'Post Filter', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Disable',
					'st2' => 'Enable',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'enable_filter_position',
			[
				'label' => __( 'Filter Position', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-cat-fixed-off' => 'Default',
					'ttgr-cat-fixed' => 'Fixed',
				],
				'default' => 'ttgr-cat-fixed-off',
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'port_filter_cat_count', [
				'label' => __( 'Number of categories to show', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Number of categories to show in portfolio filter list. e.x: 5', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'port_filter_cat_exclude', [
				'label' => __( 'Exclude category', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'tank-plugin' ),
				'description' => __( 'Exclude category from the filter list by the category ID e.x: 6 <br>For multiple category ID e.x: 6 7', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
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
		
		$this->add_control(
			'text1', [
				'label' => __( 'Show All', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Show All' , 'tank-plugin' ),
				'description' => __( 'Translet Option.', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'text2', [
				'label' => __( 'Close', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Close' , 'tank-plugin' ),
				'description' => __( 'Translet Option.', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'text3', [
				'label' => __( 'Filter', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Filter' , 'tank-plugin' ),
				'description' => __( 'Translet Option.', 'tank-plugin' ),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'text4', [
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
				'label' => __( 'Post Styles', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'port_grid_layout',
			[
				'label' => __( 'Layout', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Grid Modern',
					'st2' => 'Grid Classic',
					'st3' => 'Grid Creative v.1',
					'st4' => 'Grid Creative v.2',
					'st5' => 'Portrait Mode',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'port_grid_column_shifted',
			[
				'label' => __( 'Shifted Layout', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-shifted-off' => 'Disable',
					'ttgr-shifted' => 'Enable',
				],
				'default' => 'ttgr-shifted-off',
				'label_block' => true,
				'condition' =>  ['port_grid_layout' => ['st2', 'st5']],
			]
		);
		
		$this->add_control(
			'port_grid_column_modern',
			[
				'label' => __( 'Grid Mixed Column', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-layout-1-2' => 'Layout 1-2',
					'ttgr-layout-2-1' => 'Layout 2-1',
					'ttgr-layout-2-3' => 'Layout 2-3',
					'ttgr-layout-3-2' => 'Layout 3-2',
					'ttgr-layout-3-4' => 'Layout 3-4',
					'ttgr-layout-4-3' => 'Layout 4-3',
				],
				'default' => 'ttgr-layout-1-2',
				'label_block' => true,
				'condition' => [
					'port_grid_layout' => 'st1',
				],
			]
		);
		
		$this->add_control(
			'port_grid_column',
			[
				'label' => __( 'Grid Column', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-layouts-1' => '1 Column',
					'ttgr-layout-2' => '2 Column',
					'ttgr-layout-3' => '3 Column',
					'ttgr-layout-4' => '4 Column',
				],
				'default' => 'ttgr-layouts-1',
				'label_block' => true,
				'condition' =>  ['port_grid_layout' => ['st2', 'st5']],
			]
		);
		
		$this->add_control(
			'port_grid_image_cropp',
			[
				'label' => __( 'Image Cropping', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-not-cropped' => 'Disable',
					'ttgr-cropped' => 'Enable',
				],
				'default' => 'ttgr-not-cropped',
				'label_block' => true,
				'condition' => [
					'port_grid_layout' => 'st2',
				],
			]
		);
		
		$this->add_control(
			'cap_po_opt',
			[
				'label' => __( 'Caption Position', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pgi-cap-inside' => 'Inside Image',
					'pgi_cap_outside' => 'Outside Image',
				],
				'default' => 'pgi-cap-inside',
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
					'pgi-hover-off' => 'Disable',
					'pgi-hover' => 'Enable',
				],
				'default' => 'pgi-hover-off',
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'cap_hover_opt',
			[
				'label' => __( 'Caption Hover Effect', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pgi-cap-hover-off' => 'Disable',
					'pgi-cap-hover' => 'Enable',
				],
				'default' => 'pgi-cap-hover-off',
				'label_block' => true,
				'condition' => [
					'cap_po_opt' => 'pgi-cap-inside',
				],
			]
		);
		
		$this->add_control(
			'block_gap',
			[
				'label' => __( 'Block Gap', 'tank-plugin' ),
				'description' => __( 'Add space between portfolio items.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-gap-1' => 'Gap 1',
					'ttgr-gap-2' => 'Gap 2',
					'ttgr-gap-3' => 'Gap 3',
					'ttgr-gap-4' => 'Gap 4',
					'ttgr-gap-5' => 'Gap 5',
				],
				'default' => 'ttgr-gap-1',
				'label_block' => true,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_filter_nav_button',
			[
				'label' => __( 'Close/ Open Button', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'close_button_color',
			[
				'label' => __( 'Close/ Open', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ttgr-cat-trigger-wrap' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .ttgr-cat-trigger-wrap',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_filter_nav',
			[
				'label' => __( 'Filter Navigation', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filter_nav_item',
			[
				'label' => __( 'Filter Navigation Item', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.ttgr-cat-list > li > a' => 'color: {{VALUE}};',
					'.ttgr-cat-list .ttgr-cat-item::before' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_control(
			'filter_nav_hover_color',
			[
				'label' => __( 'Filter Navigation Item Hover/ Active', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.ttgr-cat-list > li > a:hover, .ttgr-cat-list > li > a:focus, .ttgr-cat-list > li > a.active' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_item_typography',
				'selector' => '.ttgr-cat-list > li > a, .ttgr-cat-item',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'port_item',
			[
				'label' => __( 'Post Items', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pgi-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} #portfolio-grid.pgi-cap-inside .pgi-image-is-light .pgi-title' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pgi-title',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Category Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pgi-category' => 'color: {{VALUE}};',
					'{{WRAPPER}} #portfolio-grid.pgi-cap-inside .pgi-image-is-light .pgi-category' => 'color: {{VALUE}};',
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
		//layout condition start
		$port_layout='';
		if( $settings['port_grid_layout'] == 'st2' ) {
		$port_layout=''.esc_attr($settings['port_grid_column']).' '.esc_attr($settings['port_grid_image_cropp']).' '.esc_attr($settings['port_grid_column_shifted']).'';
		}
		else if( $settings['port_grid_layout'] == 'st3' ) {
		$port_layout='ttgr-layout-creative-1';
		}
		else if( $settings['port_grid_layout'] == 'st4' ) {
		$port_layout='ttgr-layout-creative-2';
		}
		else if( $settings['port_grid_layout'] == 'st5' ) {
		$port_layout='ttgr-portrait '.esc_attr($settings['port_grid_column']).' '.esc_attr($settings['port_grid_column_shifted']).'';
		}
		else {
		$port_layout=''.esc_attr($settings['port_grid_column_modern']).'';
		}
		//layout condition start
		?>
		<div id="portfolio-grid" class="<?php echo esc_attr($settings['cap_po_opt']); ?> <?php echo esc_attr($settings['img_hover_opt']); ?> <?php echo esc_attr($settings['cap_hover_opt']); ?>">
		<div class="tt-grid <?php echo ($port_layout);?> <?php echo esc_attr($settings['block_gap']); ?>  ">
		
		<?php 
		//filter start
		if( $settings['enable_filter'] == 'st2' ) { ?>
		<?php 
		if(!get_post_meta(get_the_ID(), 'category', true)):
		$portfolio_category = get_terms('category', array('exclude' => $settings['port_filter_cat_exclude'], 'number'=>$settings['port_filter_cat_count']));
		if($portfolio_category):
		?>
		<!-- Begin tt-Ggrid top content 
		================================ -->
		<div class="tt-grid-top">
			<div class="tt-grid-categories">
				<div class="ttgr-cat-trigger-wrap <?php echo esc_attr($settings['enable_filter_position']); ?>">
					<a href="#portfolio-grid" class="ttgr-cat-trigger not-hide-cursor" data-offset="150">
						<div class="ttgr-cat-text">
							<span data-hover="Open"><?php echo esc_html($settings['text3']); ?></span>
						</div>
						<div class="ttgr-cat-icon">
							<span class="magnetic-item"><i class="fas fa-layer-group"></i></span>
						</div>
					</a>
				</div>
				<!-- End tt-Ggrid categories trigger -->
				<!-- Begin tt-Ggrid categories nav 
				=================================== -->
				<div class="ttgr-cat-nav">
					<div class="ttgr-cat-list-holder cursor-close">
						<div class="ttgr-cat-list-inner">
							<div class="ttgr-cat-list-content">
								<ul class="ttgr-cat-list tank-new-cat-list">
									<li class="ttgr-cat-close"><?php echo esc_html($settings['text2']); ?> <i class="fas fa-times"></i></li> <!-- For mobile devices! -->
									<li class="ttgr-cat-item"><a href="#" class="active"><?php echo esc_html($settings['text1']); ?></a></li>
									<?php foreach($portfolio_category as $portfolio_cat) { ?>
									<li class="ttgr-cat-item"><a href="#" data-filter=".<?php echo esc_attr($portfolio_cat->slug);?>"><?php echo esc_attr($portfolio_cat->name);?></a></li>
									<?php } ;?>
									</ul>
							</div> <!-- /.ttgr-cat-links-content -->
						</div> <!-- /.ttgr-cat-links-inner -->
					</div> <!-- /.ttgr-cat-links-holder -->
				</div>
				<!-- End tt-Ggrid categories nav -->
		</div>
		<!-- End tt-Ggrid categories/filter-->
		</div>
		<!-- End tt-Grid top content -->
		<?php 
		endif;
		endif;
		} ;
		//filter end
		?>
		<div class="tt-grid-items-wrap isotope-items-wrap">
		<?php
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new \WP_Query( array( 'post_type' => 'post','category_name'=> $settings['categoryname'], 'posts_per_page'=> $settings['postcount'], 'post_status' => 'publish', 'offset' => $settings['postoffset']) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'category');
		$tank_class = ""; 
		$tank_categories = ""; 
		if( $settings['cap_po_opt'] == 'pgi_cap_outside' ) {
			foreach ($tank_portfolio_category as $tank_item) {
			$tank_class.=esc_attr($tank_item->slug . ' ');
			$tank_categories.='<div class="pgi-category"><a href="'.get_category_link($tank_item->term_id).'">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</a></div>';
			}
		}
		else{
			foreach ($tank_portfolio_category as $tank_item) {
			$tank_class.=esc_attr($tank_item->slug . ' ');
			$tank_categories.='<div class="pgi-category">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</div>';
			}
		}
		if (has_post_thumbnail( $post->ID ) ):
		$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
		?>
		<div class="tt-grid-item hide-br isotope-item <?php echo esc_attr($tank_class);?>">
			<div class="ttgr-item-inner">
				<div class="portfolio-grid-item ">
					<a href="<?php the_permalink();?>" class="pgi-image-wrap" data-cursor="<?php echo do_shortcode($settings['text4']); ?>">
					<div class="pgi-image-holder cover-opacity-2">
					<div class="pgi-image-inner anim-zoomin">
					<figure class="pgi-image ttgr-height">
					<img src="<?php echo esc_url($tank_image[0]);?>" alt="<?php the_title();?>">
					</figure>
					
					</div>
					</div>
					</a>
					<div class="pgi-caption">
					<div class="pgi-caption-inner">
					
					<?php if( $settings['cap_po_opt'] == 'pgi_cap_outside' ) { ?>
						<h2 class="pgi-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
					<?php }
					else { ?>
						<h2 class="pgi-title"><?php the_title();?></h2>
					<?php } ;?>
					<div class="pgi-categories-wrap">
					<?php echo do_shortcode($tank_categories);?>
					</div>
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
		</div>
        <?php
		

	}

}