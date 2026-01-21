<?php
/*
Plugin Name: Tank Plugin
Plugin URI: http://webredox.net
Description: Declares a plugin that will create Page Settings, VC addons, Elementor Widgets & Custom Post Type.
Version: 4.4.8
Author: webRedox
Author URI: http://webredox.net
License: GPLv2
*/
define('TANK_VERSION', '4.4.8');
$tank_plugin_get_theme = wp_get_theme();
define('TANK_PLUGIN_PATH',		plugin_dir_path(__FILE__));
define('TANK_URL', plugins_url('', __FILE__));
// Define the tank_PLUGIN Folder
if( ! defined( 'TANK_FILE_' ) ) {
	define('TANK_FILE_', __FILE__ );
}
function tank_plugin_load() {
function tank_register_metabox_list() {
include (TANK_PLUGIN_PATH .'metaboxes.php');

}
include (TANK_PLUGIN_PATH .'meta-box-group.php');
include (TANK_PLUGIN_PATH .'meta-box-show-hide.php');
include (TANK_PLUGIN_PATH .'meta-box-tooltip.php');
include (TANK_PLUGIN_PATH .'meta-box-conditional-logic.php');
include (TANK_PLUGIN_PATH .'tank-post-order.php');
include (TANK_PLUGIN_PATH .'elmentor-widgets.php');
//include (TANK_PLUGIN_PATH .'text-limiter.php');
add_action('init', 'tank_register_metabox_list');
function tank_unregister_elementor() {
	include (TANK_PLUGIN_PATH .'elmentor-bn-widgets.php');
}
add_action('init', 'tank_unregister_elementor');

global $tank_options;

$tank_options = get_option('tank');
if( ! function_exists( 'portfolio_post_types' ) ) {
    function portfolio_post_types() {
		$tank_options = get_option('tank');
		//portfolio dt base
		if(!empty($tank_options['portfolio_main_base_opt'])) {
			if (class_exists('Tank_AfterSetupTheme')) {
			$tank_port_main_base = esc_html(Tank_AfterSetupTheme::return_thme_option('portfolio_main_base_opt',''));
			}
			else{$tank_port_main_base ='';}
		}
		else {
			$tank_port_main_base ='portfolio';
		};
        register_post_type(
            'portfolio',
            array(
                'labels' => array(
                    'name'          => __( 'Portfolios', 'portfolio' ),
                    'singular_name' => __( 'Portfolio', 'portfolio' ),
                    'add_new'       => __( 'Add New', 'portfolio' ),
                    'add_new_item'  => __( 'Add New Portfolio', 'portfolio' ),
                    'edit'          => __( 'Edit', 'portfolio' ),
                    'edit_item'     => __( 'Edit Portfolio', 'portfolio' ),
                    'new_item'      => __( 'New Portfolio', 'portfolio' ),
                    'view'          => __( 'View Portfolio', 'portfolio' ),
                    'view_item'     => __( 'View Portfolio', 'portfolio' ),
                    'search_items'  => __( 'Search Portfolio', 'portfolio' ),
                    'not_found'     => __( 'No Portfolio item found', 'portfolio' ),
                    'not_found_in_trash' => __( 'No portfolio item found in Trash', 'portfolio' ),
                    'parent'        => __( 'Parent Portfolio', 'portfolio' ),
                ),

                'description'       => __( 'Create a Portfolio.', 'portfolio' ),
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'          => true,
                'publicly_queryable'    => true,
				'capability_type' => 'post',
                'exclude_from_search'   => true,
                'menu_position'         => 6,
                'hierarchical'      => false,
                'query_var'         => true,
				'rewrite' => array(
                'slug' => $tank_port_main_base
				),
				'menu_icon' => 'dashicons-portfolio',
                'supports'  => array (
                    'title', //Text input field to create a post title.
                    'editor',
                    'thumbnail',

                )
            )
        );
//portfolio
if(!empty($tank_options['portfolio_category_base_opt'])) {
	if (class_exists('Tank_AfterSetupTheme')) {
	$tank_port_cat_base = esc_html(Tank_AfterSetupTheme::return_thme_option('portfolio_category_base_opt',''));
	}
	else {$tank_port_cat_base ='';}
}
else {
	$tank_port_cat_base ='portfolio_category';
};
register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => 'Portfolio Category', 'singular_name' => 'Portfolio Category', "rewrite" => array('slug' =>  $tank_port_cat_base,'with_front' => true), "query_var" => true, 'show_admin_column' => true, 'labels' => ['all_items' => __('All Categories', 'tank-plugin'),'edit_item' => __('Edit Category', 'tank-plugin'),'view_item' => __('View Category', 'tank-plugin'),'update_item' => __('Update Category', 'tank-plugin'),'add_new_item' => __('Add New Category', 'tank-plugin'),'new_item_name' => __('New Category Name', 'tank-plugin'),'search_items' => __('Search Categories', 'tank-plugin'),'popular_items' => __('Popular Categories', 'tank-plugin'),'separate_items_with_commas' => __('Separate Category with comma', 'tank-plugin'), 'choose_from_most_used' => __('Choose from most used Categories', 'tank-plugin'),'not_found' => __('No Categories found', 'tank-plugin'),]));
}
}

add_action( 'init', 'portfolio_post_types' ); // register post type

register_taxonomy_for_object_type('category', 'custom-type');



add_filter('widget_title', 'do_shortcode');
add_shortcode('span', 'wpse_shortcode_span');
function wpse_shortcode_span( $attr, $content ){ return '<span>'. $content . '</span>'; }
add_shortcode('br', 'wpse_shortcode_br');
function wpse_shortcode_br( $attr ){ return '<br>'; }
add_shortcode('br_sm', 'wpse_shortcode_br_sm');
function wpse_shortcode_br_sm( $attr ){ return '<br class="hide-from-sm">'; }
add_shortcode('strong', 'wpse_shortcode_strong');
function wpse_shortcode_strong( $attr, $content ){ return '<strong>'. $content . '</strong>'; }

function tank_social_media_icons( $tank_contactmethods ) {
    // Add social media

    $tank_contactmethods['twitter'] = 'Twitter';
    $tank_contactmethods['facebook'] = 'Facebook';
    $tank_contactmethods['instagram'] = 'Instagram';
    $tank_contactmethods['tumblr'] = 'Tumblr';
    $tank_contactmethods['pinterest'] = 'Pinterest';
    $tank_contactmethods['youtube'] = 'Youtube';

    return $tank_contactmethods;
}
add_filter('user_contactmethods','tank_social_media_icons',10,1);
/* ==========================================
   Add featured image column to admin panel post list page
========================================== */
add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
	$columns['img'] = 'Thumbnail';
	return $columns;
}

function manage_img_column($column_name, $post_id) {
	if( $column_name == 'img' ) {
		echo get_the_post_thumbnail( $post_id, array( 80, 60) ); return true; // 80, 60 is for image size.
	}
}

// Change columns order
add_filter('manage_posts_columns', 'column_order');
function column_order($columns) {
  $n_columns = array();
  $move = 'img'; // what to move
  $before = 'title'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}

/**
*
*
*
 * Allow shortcodes in widgets
 * @since v1.0
 */
add_filter('widget_text', 'do_shortcode');

if( !function_exists('symple_fix_shortcodes') ) {
	function symple_fix_shortcodes($content){
		$array = array (
			'<p>['		=> '[',
			']</p>'		=> ']',
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'symple_fix_shortcodes');
}

// image
if(! function_exists('tank_image_shortcode')){
	function tank_image_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'caption'=>'',
			'fixed_height'=>'tti-fixed-height',
			'image_parallax'=>'anim-image-parallax',
			'bottom_padding'=>'',
			'fixed_width'=>'width-100',
			'img_animation'=>'anim-fadeinup-off',
			), $atts) );
		if(is_numeric($image)) {
            $tank_image = wp_get_attachment_url( $image );
            $tank_title = get_the_title( $image );
        }else {
            $tank_image = $image;
            $tank_title = $image;
        }

		$html='';
		$dot="'";
		if(is_numeric($image)) {
		$html .= '<div class="tt-image '.esc_attr($img_animation).' '.esc_attr($fixed_height).' '.esc_attr($class).' '.esc_attr($bottom_padding).'">';
		$html .= '<figure class="'.esc_attr($fixed_width).'">';
		$html .= '<img class="'.esc_attr($image_parallax).' tt-lazy" src="'.TANK_THEME_URL.'/includes/img/low-qlt-thumb.jpg" data-src="'.esc_url($tank_image).'" alt="'.esc_attr($tank_title).'">';
		if($caption != ""){
		$html .= '<figcaption>'.esc_html($caption).'</figcaption>';
		}
		$html .= '</figure>';
		$html .= '</div>';
		}

		return $html;
	}
	add_shortcode('tank_image', 'tank_image_shortcode');
}

// popup image & video
if(! function_exists('tank_pop_image_shortcode')){
	function tank_pop_image_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'caption'=>'',
			'popup_type'=>'',
			'fixed_height'=>'tti-fixed-height',
			'image_parallax'=>'anim-image-parallax',
			'text1'=>'View',
			'image_overlay'=>'cover-opacity-0',
			'mp4_url'=>'',
			'webm_url'=>'',
			'bottom_padding'=>'',
			), $atts) );
		if(is_numeric($image)) {
            $tank_image = wp_get_attachment_url( $image );
            $tank_title = get_the_title( $image );
            $tank_caption = wp_get_attachment_caption( $image );
        }else {
            $tank_image = $image;
            $tank_title = $image;
            $tank_caption = $image;
        }

		$html='';
		$dot="'";
		if(is_numeric($image)) {
		$html .= '<div class="tt-image lightgallery '.esc_attr($fixed_height).' '.esc_attr($class).' '.esc_attr($bottom_padding).'">';
		if($popup_type == "st2"){
		$html .= '<a href="" class="lg-trigger" data-cursor="'.esc_attr($text1).'" data-html="
				<video class='.$dot.'lg-video-object lg-html5'.$dot.' controls playsinline preload='.$dot.'auto'.$dot.'>
				<source src='.$dot.''.esc_url($mp4_url).''.$dot.' type='.$dot.'video/mp4'.$dot.'>
				<source src='.$dot.''.esc_url($webm_url).''.$dot.' type='.$dot.'video/webm'.$dot.'>
				</video>">';
		}
		else {
		$html .= '<a href="'.esc_url($tank_image).'" class="lg-trigger" data-cursor="'.esc_attr($text1).'" data-sub-html="<h4>'.esc_attr($tank_title).'</h4><p>'.esc_attr($tank_caption).'</p>" >';
		}
		$html .= '<figure class=" '.esc_attr($image_overlay).'">';
		$html .= '<img class="'.esc_attr($image_parallax).' tt-lazy " src="'.TANK_THEME_URL.'/includes/img/low-qlt-thumb.jpg" data-src="'.esc_url($tank_image).'" alt="'.esc_attr($tank_title).'">';
		if($caption != ""){
		$html .= '<figcaption>'.do_shortcode($caption).'</figcaption>';
		}
		$html .= '</figure>';
		$html .= '<div class="align-center z-index-2 hide-to-mobile">
					<div class="tt-btn tt-btn-light tt-btn-round anim-fadeinup">
						<div data-hover="'.esc_attr($text1).'">'.esc_html($text1).'</div> <!-- Use short text only! -->
					</div>
				</div>';
		$html .= '</a>';
		$html .= '</div>';
		}

		return $html;
	}
	add_shortcode('tank_pop_image', 'tank_pop_image_shortcode');
}

// Portfolio grid
if(! function_exists('tank_portfolio_grid_shortcode')){
	function tank_portfolio_grid_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'10',
			'postoffset'=>'',
			'categoryname'=>'',
			'text1'=>'Show All',
			'text2'=>'Close',
			'text3'=>'Filter',
			'text4'=>'View<br>Project',
			'enable_filter'=>'',
			'postload'=>'6',
			'cap_po_opt'=>'pgi-cap-inside',
			'img_hover_opt'=>'pgi-hover-off',
			'cap_hover_opt'=>'pgi-cap-hover-off',
			'block_gap'=>'ttgr-gap-1',
			'port_grid_layout'=>'',
			'port_grid_column'=>'ttgr-layouts-1',
			'port_grid_image_cropp'=>'ttgr-not-cropped',
			'port_grid_column_modern'=>'ttgr-layout-1-2',
			'port_grid_column_shifted'=>'ttgr-shifted-off',
			'port_filter_cat_count'=>'',
			'port_filter_cat_exclude'=>'',
			'enable_filter_position'=>'ttgr-cat-fixed-off',
			), $atts) );


		$html='';
		$port_layout='';
		if($port_grid_layout == "st2"){
		$port_layout=''.esc_attr($port_grid_column).' '.esc_attr($port_grid_image_cropp).' '.esc_attr($port_grid_column_shifted).'';
		}
		else if($port_grid_layout == "st3"){
		$port_layout='ttgr-layout-creative-1';
		}
		else if($port_grid_layout == "st4"){
		$port_layout='ttgr-layout-creative-2';
		}
		else if($port_grid_layout == "st5"){
		$port_layout='ttgr-portrait '.esc_attr($port_grid_column).' '.esc_attr($port_grid_column_shifted).'';
		}
		else {
		$port_layout=''.esc_attr($port_grid_column_modern).'';
		}
		$tank_image='';
		$html .= '<div id="portfolio-grid" class="'.esc_attr($cap_po_opt).' '.esc_attr($img_hover_opt).' '.esc_attr($cap_hover_opt).'">';
		$html .= '<div class="tt-grid '.esc_attr($port_layout).' '.esc_attr($block_gap).'  ">';
		//filter start
		if($enable_filter == "st2"){
		if(!get_post_meta(get_the_ID(), 'portfolio_category', true)):
		$portfolio_category = get_terms('portfolio_category', array('exclude' => $port_filter_cat_exclude, 'number'=>$port_filter_cat_count));
		if($portfolio_category):
		$html .= '<div class="tt-grid-top">';
		$html .= '<div class="tt-grid-categories">';
		$html .= '<div class="ttgr-cat-trigger-wrap '.esc_attr($enable_filter_position).'">
					<a href="#portfolio-grid" class="ttgr-cat-trigger not-hide-cursor" data-offset="150">
						<div class="ttgr-cat-text">
							<span data-hover="Open">'.esc_html($text3).'</span>
						</div>
						<div class="ttgr-cat-icon">
							<span class="magnetic-item"><i class="fas fa-layer-group"></i></span>
						</div>
					</a>
				</div>';
		//main filter start
		$html .= '<div class="ttgr-cat-nav">';
		$html .= '<div class="ttgr-cat-list-holder cursor-close">';
		$html .= '<div class="ttgr-cat-list-inner">';
		$html .= '<div class="ttgr-cat-list-content">';
		$html .= '<ul class="ttgr-cat-list">';
		$html .= '<li class="ttgr-cat-close">'.esc_html($text2).' <i class="fas fa-times"></i></li> <!-- For mobile devices! -->';
		$html .= '<li class="ttgr-cat-item"><a href="#" class="active">'.esc_html($text1).'</a></li>';
		foreach($portfolio_category as $portfolio_cat) {
		$html .= '<li class="ttgr-cat-item"><a href="#" data-filter=".'.esc_attr($portfolio_cat->slug).'">'.esc_html($portfolio_cat->name).'</a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		//main filter end
		$html .= '</div>';
		$html .= '</div>';
		endif;
		endif;
		}
		//filter end
		$html .= '<div class="tt-grid-items-wrap isotope-items-wrap">';
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $categoryname, 'posts_per_page'=> $postcount, 'post_status' => 'publish', 'offset' => $postoffset) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');
		$tank_class = "";
		$tank_categories = "";
		if($cap_po_opt == "pgi_cap_outside"){
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
		$if_img_light ='';
		if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
		$if_img_light ='pgi-image-is-light';
		}
		//iso item
		$html .= '<div class="tt-grid-item hide-br isotope-item '.esc_attr($tank_class).'">';
		$html .= '<div class="ttgr-item-inner">';
		$html .= '<div class="portfolio-grid-item '.esc_attr($if_img_light).'">';
		$html .= '<a href="'.get_the_permalink().'" class="pgi-image-wrap" data-cursor="'.do_shortcode($text4).'">';
		$html .= '<div class="pgi-image-holder cover-opacity-2">';
		$html .= '<div class="pgi-image-inner anim-zoomin">';
		if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){
		$html .='<figure class="pgi-video-wrap ttgr-height">';
		$html .='<video class="pgi-video" loop muted preload="metadata" poster="'.esc_url($tank_image[0]).'">';
		if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) {
		$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true)).'" type="video/mp4">';
		}
		if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) {
		$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true)).'" type="video/webm">';
		}
		$html .='</video>';
		$html .='</figure>';
		}
		else {
		$html .= '<figure class="pgi-image ttgr-height">';
		$html .= '<img src="'.esc_url($tank_image[0]).'" alt="'.get_the_title().'">';
		$html .= '</figure>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</a>';
		$html .= '<div class="pgi-caption">';
		$html .= '<div class="pgi-caption-inner">';
		if($cap_po_opt == "pgi_cap_outside"){
			if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
			$html .= '<h2 class="pgi-title"><a href="'.get_the_permalink().'">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</a></h2>';
			}
			else {
			$html .= '<h2 class="pgi-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
			}
		}
		else {
			if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
			$html .= '<h2 class="pgi-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</h2>';
			}
			else {
			$html .= '<h2 class="pgi-title">'.get_the_title().'</h2>';
			}
		}
		$html .= '<div class="pgi-categories-wrap">';
		$html .= ''.do_shortcode($tank_categories).'';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		endif;
		endwhile;
		wp_reset_postdata();
		//iso item end
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}
	add_shortcode('tank_portfolio_grid', 'tank_portfolio_grid_shortcode');
}


// Portfolio list
if(! function_exists('tank_portfolio_list_shortcode')){
	function tank_portfolio_list_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'10',
			'postoffset'=>'',
			'categoryname'=>'',
			'port_list_layout'=>'',
			'text1'=>'View<br>Project',
			'post_serial'=>'',
			'img_hover_opt'=>'pli-hover-off',
			'port_grid_image_cropp'=>'pli-cropped',
			'port_list_alternative_layout'=>'pl-alter-off',
			'cap_font_size'=>'pli-info-df',
			'title_stroke'=>'pli-title-stroke-off',
			), $atts) );


		$html='';
		$port_layout='';
		$cover_opacity='';
		if($port_list_layout == "st2"){
		$port_layout='pl-compact hide-br';
		}
		else if($port_list_layout == "st3"){
		$port_layout='pli-info-overlay';
		$cover_opacity=' cover-opacity-2';
		}
		else {
		$port_layout='';
		}
		$tank_image='';
		$html .= '<div class="portfolio-list  '.esc_attr($port_layout).' '.esc_attr($port_list_alternative_layout).' '.esc_attr($port_grid_image_cropp).' '.esc_attr($img_hover_opt).' '.esc_attr($cap_font_size).' '.esc_attr($title_stroke).'">';
		//layout
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $categoryname, 'posts_per_page'=> $postcount, 'post_status' => 'publish', 'offset' => $postoffset) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');
		$tank_class = "";
		$tank_categories = "";

		if($port_list_layout == "st3"){
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
		if($port_list_layout == "st2"){
			$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tank_blog_image' );
		}
		else {
			$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
		}
		$if_img_light ='';
		if(get_post_meta($post->ID,'tank_port_cover_title_color_opt',true)=='st2'){
		$if_img_light ='pli-image-is-light';
		}
		$html .= '<div class="portfolio-list-item '.esc_attr($tank_class).' '.esc_attr($if_img_light).'">';
		$html .= '<div class="pli-inner">';
			$html .= '<div class="pli-image-col">';
			$html .= '<a href="'.get_the_permalink().'" class="pli-image-link" data-cursor="'.do_shortcode($text1).'">';
			$html .= '<div class="pli-image-holder">';
			if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){
			$html .= '<div class="pli-image '.esc_attr($cover_opacity).'">';
			$html .= '<figure class="pli-video-wrap anim-image-parallax">';
			$html .= '<video class="pli-video" loop muted preload="metadata" poster="'.esc_url($tank_image[0]).'">';
			if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true)).'" type="video/mp4">';
			}
			if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true)).'" type="video/webm">';
			}
			$html .= '</video>';
			$html .= '</figure>';
			$html .= '</div>';
			}
			else {
			$html .= '<figure class="pli-image '.esc_attr($cover_opacity).'">';
			$html .= '<img class="anim-image-parallax tt-lazy" src="'.TANK_THEME_URL.'/includes/img/low-qlt-thumb.jpg" data-src="'.esc_url($tank_image[0]).'" alt="'.get_the_title().'">';
			$html .= '</figure>';
			}
			$html .= '</div>';
			$html .= '<div class="pli-info-col pli-info-inner">';
			$html .= '<div class="pli-info">';
			if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
			$html .= '<h2 class="pli-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</h2>';
			}
			else {
			$html .= '<h2 class="pli-title">'.get_the_title().'</h2>';
			}
			$html .= '<div class="pli-categories-wrap">';
			$html .= ''.do_shortcode($tank_categories).'';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</a>';
			$html .= '</div>';
			$html .= '<div class="pli-info-col pli-info-outer">';
			$html .= '<div class="pli-info">';
			if($post_serial != "st2"){
			$html .= '<div class="pli-counter"></div>';
			}
			if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
			$html .= '<h2 class="pli-title"><a href="'.get_the_permalink().'">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</a></h2>';
			}
			else {
			$html .= '<h2 class="pli-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
			}
			$html .= '<div class="pli-categories-wrap">';
			$html .= ''.do_shortcode($tank_categories).'';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		endif;
		endwhile;
		wp_reset_postdata();
		$html .= '</div>';

		return $html;
	}
	add_shortcode('tank_portfolio_list', 'tank_portfolio_list_shortcode');
}

// Portfolio Interactive
if(! function_exists('tank_portfolio_interactive_shortcode')){
	function tank_portfolio_interactive_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'10',
			'postoffset'=>'',
			'categoryname'=>'',
			'port_list_layout'=>'pi-compact-off',
			'post_serial'=>'',
			'title_hover_opt'=>'pi-force-scroll',
			'bottom_border'=>'pi-borders',
			'title_stroke'=>'pi-stroke-off',
			'title_hover_speed_opt'=>'3',
			), $atts) );


		$html='';
		$html .= '<div class="portfolio-interactive '.esc_attr($port_list_layout).' '.esc_attr($bottom_border).' '.esc_attr($title_stroke).' '.esc_attr($title_hover_opt).'">';
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $categoryname, 'posts_per_page'=> $postcount, 'post_status' => 'publish', 'offset' => $postoffset) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');
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
		$html .= '<div class="portfolio-interactive-item anim-skewinup hide-br '.esc_attr($tank_class).'" data-scroll-speed="'.esc_attr($title_hover_speed_opt).'">';
		$html .= '<a href="'.get_the_permalink().'" class="pi-item-title-link">';
		if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
		$html .= '<h2 class="pi-item-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</h2>';
		$html .= '<div class="pi-item-hover-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</div>';
		}
		else {
		$html .= '<h2 class="pi-item-title">'.get_the_title().'</h2>';
		$html .= '<div class="pi-item-hover-title">'.get_the_title().'</div>';
		}
		$html .= '</a>';
		$html .= '<div class="pi-item-category-wrap">';
		$html .= ''.do_shortcode($tank_categories).'';
		$html .= '</div>';
		$html .= '<figure class="pi-item-image cover-opacity-2">';
		if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){
		$html .= '<video class="pi-item-video" loop muted preload="metadata" poster="'.esc_url($tank_image[0]).'">';
		if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true)).'" type="video/mp4">';
			}
			if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true)).'" type="video/webm">';
		}
		$html .= '</video>';
		}
		else {
		$html .= '<img src="'.esc_url($tank_image[0]).'" alt="'.get_the_title().'">';
		}
		$html .= '</figure>';
		$html .= '</div>';
		endif;
		endwhile;
		wp_reset_postdata();
		$html .= '</div>';
		if($post_serial == "st2"){
		$html .= '<style>.portfolio-interactive-item::before{display:none;}</style>';
		}

		return $html;
	}
	add_shortcode('tank_portfolio_interactive', 'tank_portfolio_interactive_shortcode');
}

// Portfolio full slider
if(! function_exists('tank_portfolio_fullscreen_shortcode')){
	function tank_portfolio_fullscreen_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'10',
			'postoffset'=>'',
			'categoryname'=>'',
			'text1'=>'View<br>Project',
			'title_stroke'=>'psc-stroke-off',
			'title_alignment_opt'=>'psc-center',
			'slider_autoplay'=>'',
			'slider_autoplay_speed'=>'5000',
			'slider_pagination'=>'fraction',
			'slider_speed'=>'1000',
			), $atts) );


		$html='';
		$data_autoplay='';
		if($slider_autoplay == "st2"){
		$data_autoplay='data-autoplay='.$slider_autoplay_speed.'';
		}
		$html .= '<div class="tt-portfolio-slider cursor-drag-mouse-down" '.esc_attr($data_autoplay).' data-speed="'.esc_attr($slider_speed).'" data-mousewheel="false" data-keyboard="true" data-simulate-touch="true" data-grab-cursor="true" data-pagination-type="'.esc_attr($slider_pagination).'" data-parallax-mouse-move="true">';
		$html .='<div class="swiper">';
		$html .='<div class="swiper-wrapper">';
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $categoryname, 'posts_per_page'=> $postcount, 'post_status' => 'publish', 'offset' => $postoffset) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');
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
		//item start
		$html .='<div class="swiper-slide '.esc_attr($if_img_light).' '.esc_attr($tank_class).'" data-url="'.get_the_permalink().'" data-title="'.get_the_title().'" data-category="'.esc_attr($tank_categories).'">';
		$html .='<div class="tt-portfolio-slider-item '.esc_attr($cover_opaity).'" data-swiper-parallax="50%">';
		if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){
		$html .='<video class="tt-bg-video" loop playsinline muted preload="metadata" poster="'.esc_url($tank_image[0]).'">';
		if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true)).'" type="video/mp4">';
			}
			if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true)).'" type="video/webm">';
		}
		$html .='</video>';
		}
		else {
		$html .='<img class="tt-psi-image swiper-lazy" src="'.TANK_THEME_URL.'/includes/img/low-qlt-thumb.jpg" data-src="'.esc_url($tank_image[0]).'" alt="'.get_the_title().'">';
		}
		$html .='</div>';
		$html .='</div>';
		endif;
		endwhile;
		wp_reset_postdata();
		$html .='</div>';
		$html .='</div>';



		$html .= '<div class="tt-portfolio-slider-caption '.esc_attr($title_stroke).' '.esc_attr($title_alignment_opt).'">
					<div class="tt-ps-caption-inner">
					<h2 class="tt-psc-elem tt-ps-caption-title"><a href="" data-cursor="'.do_shortcode($text1).'"></a></h2>
						<div class="tt-psc-elem tt-ps-caption-category"></div>
					</div> <!-- /.tt-ps-caption-inner -->
				</div>';
		$html .= '<div class="tt-portfolio-slider-navigation tt-swiper-nav">
					<div class="tt-ps-nav-prev">
						<div class="tt-ps-nav-arrow tt-ps-nav-arrow-prev magnetic-item"></div>
					</div>
					<div class="tt-ps-nav-next">
						<div class="tt-ps-nav-arrow tt-ps-nav-arrow-next magnetic-item"></div>
					</div>
					<div class="tt-ps-nav-pagination"></div>
				</div>';
		$html .= '</div>';
		wp_enqueue_script('tank-portfolio-slider');

		return $html;
	}
	add_shortcode('tank_portfolio_fullscreen', 'tank_portfolio_fullscreen_shortcode');
}

// Portfolio carousel
if(! function_exists('tank_portfolio_carousel_shortcode')){
	function tank_portfolio_carousel_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'10',
			'postoffset'=>'',
			'categoryname'=>'',
			'text1'=>'View<br>Project',
			'title_stroke'=>'pci-caption-stroke-off',
			'title_alignment_opt'=>'pci-caption-center',
			'slider_autoplay'=>'',
			'slider_autoplay_speed'=>'5000',
			'slider_pagination'=>'fraction',
			'img_hover_opt'=>'pci-hover-off',
			), $atts) );


		$html='';
		$data_autoplay='';
		$hide_br_opt='';
		if($slider_autoplay == "st2"){
		$data_autoplay='data-autoplay='.$slider_autoplay_speed.'';
		}
		if($title_alignment_opt == "pci-caption-center"){
		$hide_br_opt='hide-br';
		}
		$html .= '<div class="tt-portfolio-carousel '.esc_attr($title_alignment_opt).' '.esc_attr($title_stroke).' cursor-drag-mouse-down pc-scale-down '.esc_attr($img_hover_opt).' '.esc_attr($hide_br_opt).'" '.esc_attr($data_autoplay).'  data-simulate-touch="true" data-mousewheel="false" data-keyboard="true" data-grab-cursor="true" data-pagination-type="'.esc_attr($slider_pagination).'">';
		$html .='<div class="swiper">';
		$html .='<div class="swiper-wrapper">';
		global $post;
		$paged=(get_query_var('paged'))?get_query_var('paged'):1;
		$loop = new WP_Query( array( 'post_type' => 'portfolio','portfolio_category'=> $categoryname, 'posts_per_page'=> $postcount, 'post_status' => 'publish', 'offset' => $postoffset) );
		while ( $loop->have_posts() ) : $loop->the_post();
		$tank_portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');
		$tank_class = "";
		$tank_categories = "";
		foreach ($tank_portfolio_category as $tank_item) {
			$tank_class.=esc_attr($tank_item->slug . ' ');
			$tank_categories.='<div class="tt-pci-category">';
			$tank_categories.=esc_attr($tank_item->name . '  ');
			$tank_categories.='</div>';
		}
		if (has_post_thumbnail( $post->ID ) ):
		$tank_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
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
		$html .='<div class="swiper-slide">';
		$html .='<a href="'.get_the_permalink().'" class="tt-portfolio-carousel-item '.esc_attr($if_img_light).'" data-cursor="'.do_shortcode($text1).'">';
		$html .='<figure class="tt-pci-image-wrap '.esc_attr($cover_opaity).'">';
		if(get_post_meta($post->ID,'tank_port_list_cover',true)=='st2'){
		$html .='<video class="tt-pci-video" loop playsinline muted preload="metadata" poster="'.esc_url($tank_image[0]).'">';
		if (( get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_mp4_opt',true)).'" type="video/mp4">';
			}
			if (( get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true))) {
			$html .='<source src="'.esc_url(get_post_meta($post->ID,'tank_port_cover_video_path_webm_opt',true)).'" type="video/webm">';
		}
		$html .='</video>';
		}
		else {
		$html .='<img class="tt-pci-image swiper-lazy" src="'.TANK_THEME_URL.'/includes/img/low-qlt-thumb.jpg" data-src="'.esc_url($tank_image[0]).'" alt="'.get_the_title().'">';
		}
		$html .='</figure>';
		//capfront
		$html .='<div class="tt-pci-caption-front">';
		$html .='<div class="tt-pci-caption">';
		$html .='<div class="tt-pci-caption-inner">';
		if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
		$html .='<h2 class="tt-pci-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</h2>';
		}
		else {
		$html .='<h2 class="tt-pci-title">'.get_the_title().'</h2>';
		}
		$html .='<div class="tt-pci-categories">';
		$html .=''.do_shortcode($tank_categories).'';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';
		//caption back
		$html .='<div class="tt-pci-caption tt-pci-caption-back">';
		$html .='<div class="tt-pci-caption-inner">';
		if (( get_post_meta($post->ID,'tank_port_alternative_title_opt',true))) {
		$html .='<h2 class="tt-pci-title">'.do_shortcode(get_post_meta($post->ID,'tank_port_alternative_title_opt',true)).'</h2>';
		}
		else {
		$html .='<h2 class="tt-pci-title">'.get_the_title().'</h2>';
		}
		$html .='<div class="tt-pci-categories">';
		$html .=''.do_shortcode($tank_categories).'';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';
		//caption end
		$html .='</a>';
		$html .='</div>';
		endif;
		endwhile;
		wp_reset_postdata();
		$html .='</div>';
		$html .='</div>';

		$html .= '<div class="tt-pc-navigation tt-swiper-nav">
					<div class="tt-pc-nav-prev">
						<div class="tt-pc-arrow tt-pc-arrow-prev magnetic-item"></div>
					</div>
					<div class="tt-pc-nav-next">
						<div class="tt-pc-arrow tt-pc-arrow-next magnetic-item"></div>
					</div>
					<div class="tt-pc-pagination"></div>
				</div>';
		$html .= '</div>';
		wp_enqueue_script('tank-portfolio-carousel');

		return $html;
	}
	add_shortcode('tank_portfolio_carousel', 'tank_portfolio_carousel_shortcode');
}


// Enqueue scripts and styles
function tank_plugin_enqueue_scripts() {
	// Enqueue vendor libraries
	// Normalize CSS
	wp_enqueue_style('normalize', TANK_URL . '/vendor/normalize/normalize.min.css', array(), TANK_VERSION);

	// Font Awesome
	wp_enqueue_style('font-awesome', TANK_URL . '/vendor/fontawesome/css/fontawesome-all.min.css', array(), TANK_VERSION);

	// GSAP
	wp_enqueue_script('gsap', TANK_URL . '/vendor/gsap/gsap.min.js', array('jquery'), TANK_VERSION, true);
	wp_enqueue_script('gsap-scrolltrigger', TANK_URL . '/vendor/gsap/ScrollTrigger.min.js', array('gsap'), TANK_VERSION, true);
	wp_enqueue_script('gsap-scrolltoplugin', TANK_URL . '/vendor/gsap/ScrollToPlugin.min.js', array('gsap'), TANK_VERSION, true);

	// Swiper
	wp_enqueue_style('swiper', TANK_URL . '/vendor/swiper/css/swiper-bundle.min.css', array(), TANK_VERSION);
	wp_enqueue_script('swiper', TANK_URL . '/vendor/swiper/js/swiper-bundle.min.js', array('jquery'), TANK_VERSION, true);

	// Isotope
	wp_enqueue_script('imagesloaded', TANK_URL . '/vendor/isotope/imagesloaded.pkgd.min.js', array('jquery'), TANK_VERSION, true);
	wp_enqueue_script('isotope', TANK_URL . '/vendor/isotope/isotope.pkgd.min.js', array('jquery', 'imagesloaded'), TANK_VERSION, true);
	wp_enqueue_script('packery-mode', TANK_URL . '/vendor/isotope/packery-mode.pkgd.min.js', array('isotope'), TANK_VERSION, true);

	// lightGallery
	wp_enqueue_style('lightgallery', TANK_URL . '/vendor/lightgallery/css/lightgallery.min.css', array(), TANK_VERSION);
	wp_enqueue_script('lightgallery', TANK_URL . '/vendor/lightgallery/js/lightgallery-all.min.js', array('jquery'), TANK_VERSION, true);

	// Main theme assets
	wp_enqueue_style('tank-theme', TANK_URL . '/assets/theme.css', array('normalize', 'font-awesome', 'swiper', 'lightgallery'), TANK_VERSION);
	wp_enqueue_script('tank-theme', TANK_URL . '/assets/theme.js', array('jquery', 'gsap', 'gsap-scrolltrigger', 'gsap-scrolltoplugin', 'swiper', 'isotope', 'packery-mode', 'lightgallery'), TANK_VERSION, true);

	// Portfolio specific scripts (registered for use in shortcodes)
	wp_register_script('tank-portfolio-slider', TANK_URL . '/assets/theme.js', array('jquery', 'gsap', 'swiper'), TANK_VERSION, true);
	wp_register_script('tank-portfolio-carousel', TANK_URL . '/assets/theme.js', array('jquery', 'gsap', 'swiper'), TANK_VERSION, true);
}
add_action('wp_enqueue_scripts', 'tank_plugin_enqueue_scripts');

}
if ( in_array( $tank_plugin_get_theme->get( 'TextDomain' ), array( 'fugu-theme' ) ) ) {
add_action('plugins_loaded', 'tank_plugin_load');
}
else {
add_action( 'admin_notices', 'tank_plugin_admin_notice' );
function tank_plugin_admin_notice() {
?>
<div class="notice e-notice">
	<div class="e-notice__content">
		<h3><?php esc_html_e( '"Tank Plugin" plugin is not supported by this theme', 'tank-plugin' ); ?></h3>
		<p><?php esc_html_e( 'Please use this plugin with Tank theme, or deactivate it.', 'tank-plugin' ); ?></p>
	</div>
</div>
<?php
	}
}
