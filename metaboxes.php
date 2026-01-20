<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'tank_';

global $meta_boxes;

$meta_boxes = array();

global $smof_data;


/* ----------------------------------------------------- */
// Page Sections Metaboxes
/* ----------------------------------------------------- */


/* ----------------------------------------------------- */
// Revolution Slider
/* ----------------------------------------------------- */

$array_choices      = array();
if(shortcode_exists("rev_slider"))  { 
	$new_slider       = new RevSlider();
	$tot_revsliders   = $new_slider->getArrSliders();
		 array_push($array_choices, 
              array('value' => '',
                'label' => __('Choose a Slider','tank-plugin'),
                 'src'   =>''
				 )
		  );  
	foreach ( $tot_revsliders as $rev_single ) {
		$alias   = $rev_single->getAlias();
		$title   = $rev_single->getTitle();
		array_push($array_choices, 
           array('value' => $alias,
             'label' =>$title,
             'src'   =>'')
		);
	}
}

/* Page Section Background Settings */

$grid_array = array('2 Columns','3 Columns','4 Columns');

$pagebg_type_array = array(
	'image' => 'Image',
	'gradient' => 'Gradient',
	'color' => 'Color'
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'main_page_type',
	'title' => 'Page Layout Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'portfolio.php', 'blog.php'),
	),
	'pages' => array( 'page', 'post', 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Container', 'tank' ),
			'id'   => $prefix . 'pagetype_container',
			'desc'  => __( 'Disable/ Enable Page Container.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'tank' ),
				'st2' => esc_attr__( 'Disable', 'tank' ),
			),
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => ' Disable page container, If you are using WPBakey Editor / Elementor Page Builder.',
                    'position' => 'top',
            ),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Container Max Width', 'tank' ),
			'id'   => $prefix . 'pagetype_conainer_width_opt',
			'desc'  => esc_attr__( 'Select Page Container Width.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'max-width-dt' => esc_attr__( 'Default', 'tank' ),
				'max-width-900' => esc_attr__( 'Max Width 900px', 'tank' ),
				'max-width-950' => esc_attr__( 'Max Width 950px', 'tank' ),
				'max-width-1000' => esc_attr__( 'Max Width 1000px', 'tank' ),
				'max-width-1200' => esc_attr__( 'Max Width 1200px', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'max-width-dt',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_pagetype_container', '!=', 'st1' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Default Padding', 'tank' ),
			'id'   => $prefix . 'pagetype_conainer_df_padding_opt',
			'desc'  => esc_attr__( 'Enable/ Disable default padding.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'tt-padding-enable' => esc_attr__( 'Enable', 'tank' ),
				'no-padding' => esc_attr__( 'Disable', 'tank' ),
				'no-padding-top' => esc_attr__( 'Disable Top Padding', 'tank' ),
				'no-padding-bottom' => esc_attr__( 'Disable Bottom Padding', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'tt-padding-enable',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_pagetype_container', '!=', 'st1' )
		),
		
		
	)
);

/* ----------------------------------------------------- */
/* blog page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'wrblogpagetemp',
	'title' => 'Blog Page Template Options',
	'show'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'blog.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Blog Page Type', 'tank' ),
			'id'   => $prefix . 'blog_pagetype',
			'desc'  => esc_attr__( 'Select Blog Page Type.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Interactive List', 'tank' ),
				'st2' => esc_attr__( 'Compact List', 'tank' ),
				'st3' => esc_attr__( 'Classic List', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Container Max Width', 'tank' ),
			'id'   => $prefix . 'blog_pagetype_conainer',
			'desc'  => esc_attr__( 'Select Blog Page Container Width.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'max-width-dt' => esc_attr__( 'Default', 'tank' ),
				'max-width-900' => esc_attr__( 'Max Width 900px', 'tank' ),
				'max-width-950' => esc_attr__( 'Max Width 950px', 'tank' ),
				'max-width-1000' => esc_attr__( 'Max Width 1000px', 'tank' ),
				'max-width-1200' => esc_attr__( 'Max Width 1200px', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'max-width-dt',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
				'name'       => esc_attr__( 'Number of posts to show', 'blps' ),
				'id'         => $prefix . 'blog-post-show',
				'desc'		=> '',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),	

			array(
			'name'		=> 'Include Category',
			'id'		=> $prefix . 'blog-post-cat',
			'desc'		=> 'Enter category name ex: web design, web development (Optional).',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		   ),
		   
		   array(
				'name'       => esc_attr__( 'Post Offset', 'blps' ),
				'id'         => $prefix . 'blog-post-offset',
				'desc'		=> 'Optional.',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'main_page_widget_type',
	'title' => 'Page Widgets Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'portfolio.php'),
	),
	'pages' => array( 'page', 'post', 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Widget Area', 'tank' ),
			'id'   => $prefix . 'enable_widget_area',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'tank' ),
				'st2' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Widget Style', 'tank' ),
			'id'   => $prefix . 'enable_widget_style',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Sliding Sidebar', 'tank' ),
				'st2' => esc_attr__( 'Classic Sidebar', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_enable_widget_area', '!=', 'st2' ),
			'tooltip' => array(
                'icon'     => 'help',
                'content'  => ' Classic sidebar not working if the page container disable.',
                'position' => 'top',
            ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Classic Sidebar Position', 'tank' ),
			'id'   => $prefix . 'classic_widget_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Right', 'tank' ),
				'st2' => esc_attr__( 'Left', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_enable_widget_style', '!=', 'st2' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Sliding Sidebar Position', 'tank' ),
			'id'   => $prefix . 'sliding_widget_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'tt-ss-left' => esc_attr__( 'Left', 'tank' ),
				'tt-ss-right' => esc_attr__( 'Right', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_enable_widget_style', '!=', 'st1' )
		),
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'main_page_header_type',
	'title' => 'Page Header & Footer Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'portfolio.php'),
	),
	'pages' => array( 'page', 'portfolio', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Header', 'tank' ),
			'id'   => $prefix . 'page_header_opt',
			'desc'  => __( 'Select Page Header Style.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Default', 'tank' ),
				'st2' => esc_attr__( 'Thumbnail Image', 'tank' ),
				'st3' => esc_attr__( 'Fullscreen Image/ Video', 'tank' ),
				'st4' => esc_attr__( 'Slider Revolution', 'tank' ),
				'st5' => esc_attr__( 'Hidden', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Featured Image Cropping', 'tank' ),
			'id'   => $prefix . 'page_header_feimg_crop_opt',
			'desc'  => __( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'tank' ),
				'st2' => esc_attr__( 'Disable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-image-cropped',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => ' Affected for Header style Default & Thumbnail Image.',
                    'position' => 'top',
            ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Header height', 'tank' ),
			'id'   => $prefix . 'page_header_height_opt',
			'desc'  => __( 'Select Page Header height.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-full-off' => esc_attr__( 'Default', 'tank' ),
				'ph-full' => esc_attr__( 'Full', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-full-off',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'visible' => array( 'tank_page_header_opt', '!=', 'st5' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Header Credit', 'tank' ),
			'id'   => $prefix . 'page_header_credit_opt',
			'desc'  => __( 'Enable/ Disable page header credit section.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'tank' ),
				'st2' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Credit Title',
			'id'		=> $prefix . 'page_header_credit_title',
			'desc'		=> 'Made with',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_credit_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Credit Icon',
			'id'		=> $prefix . 'page_header_credit_icon',
			'desc'		=> 'e.x: far fa-heart/ fas fa-heart <br>Use <a href="https://fontawesome.com/v5/cheatsheet" target="_blank">Fontawesome</a> Icon Class',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_credit_opt', '!=', 'st2' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Menu Style', 'tank' ),
			'id'   => $prefix . 'page_menu_st_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st0' => esc_attr__( 'Theme Options', 'tank' ),
				'st1' => esc_attr__( 'Hamburger Menu', 'tank' ),
				'st2' => esc_attr__( 'Classic Menu', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st0',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Menu Position', 'tank' ),
			'id'   => $prefix . 'page_menu_position_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Fixed', 'tank' ),
				'st2' => esc_attr__( 'Hide On Scroll', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'visible' => array( 'tank_page_menu_st_opt', '!=', 'st0' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Mobile Menu Position', 'tank' ),
			'id'   => $prefix . 'page_mob_menu_position_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Fixed', 'tank' ),
				'st2' => esc_attr__( 'Hide On Scroll', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'visible' => array( 'tank_page_menu_st_opt', '!=', 'st0' ),
			'tooltip' => array(
                'icon'     => 'help',
                'content'  => 'Not affected for logged in users.',
                'position' => 'top',
            ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Footer Style', 'tank' ),
			'id'   => $prefix . 'page_footer_st_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Default', 'tank' ),
				'st2' => esc_attr__( 'Absolute', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Custom URL',
			'id'		=> $prefix . 'page_footer_st_custom_url_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
			'hidden' => array( 'tank_page_footer_st_opt', '!=', 'st2' ),
			'tooltip' => array(
                'icon'     => 'help',
                'content'  => ' Working only in footer style Absolute',
                'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Custom URL Text',
			'id'		=> $prefix . 'page_footer_st_custom_text_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Get in Touch',
			'hidden' => array( 'tank_page_footer_st_opt', '!=', 'st2' ),
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => ' Working only in footer style Absolute',
                    'position' => 'top',
            ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Link Target', 'tank' ),
			'id'   => $prefix . 'page_footer_st_custom_target_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'_self' => esc_attr__( 'Self', 'tank' ),
				'_blank' => esc_attr__( 'Blank', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '_self',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
			'hidden' => array( 'tank_page_footer_st_opt', '!=', 'st2' ),
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => ' Working only in footer style Absolute',
                    'position' => 'top',
            ),
		),
		
	)
);

/* ----------------------------------------------------- */
/* header default
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'header_default_opt',
	'title' => 'Default Header Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#tank_page_header_opt'  => 'st1',
    ),
	),
	'pages' => array( 'page', 'portfolio', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'page_header_default_title',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'page_header_default_subtitle',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		
		array(
			'name'		=> 'Ghost Title',
			'id'		=> $prefix . 'page_header_default_ghosttitle',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		
		array(
			'name'		=> 'Scroll Down',
			'id'		=> $prefix . 'page_header_default_scroll',
			'desc'		=> 'Optional.<br> e.x: Scroll Down',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_height_opt', '!=', 'ph-full' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Logo, Menu &  Caption Mode', 'tank' ),
			'id'   => $prefix . 'page_header_default_cap_mode_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-bg-image-is-dark' => esc_attr__( 'Light', 'tank' ),
				'ph-bg-image-is-light' => esc_attr__( 'Dark', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-bg-image-is-dark',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Size', 'tank' ),
			'id'   => $prefix . 'page_header_default_cap_st_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-cap-df' => esc_attr__( 'Default', 'tank' ),
				'ph-cap-sm' => esc_attr__( 'SM', 'tank' ),
				'ph-cap-lg' => esc_attr__( 'LG', 'tank' ),
				'ph-cap-xlg' => esc_attr__( 'XLG', 'tank' ),
				'ph-cap-xxlg' => esc_attr__( 'XXLG', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-cap-df',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Alignment', 'tank' ),
			'id'   => $prefix . 'page_header_default_cap_alingment_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-center' => esc_attr__( 'Center', 'tank' ),
				'ph-left' => esc_attr__( 'Left', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-center',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Parallax Effeect', 'tank' ),
			'id'   => $prefix . 'page_header_default_cap_parallax_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-content-parallax' => esc_attr__( 'Enable', 'tank' ),
				'ph-content-parallax-none' => esc_attr__( 'Disable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-content-parallax',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Featured Image Overlay', 'tank' ),
			'id'   => $prefix . 'page_header_default_cap_overlay_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-image-cover-0' => esc_attr__( 'Default', 'tank' ),
				'ph-image-cover-0-5' => esc_attr__( 'Image cover 0.5', 'tank' ),
				'ph-image-cover-1' => esc_attr__( 'Image cover 1', 'tank' ),
				'ph-image-cover-1-5' => esc_attr__( 'Image cover 1.5', 'tank' ),
				'ph-image-cover-2' => esc_attr__( 'Image cover 2', 'tank' ),
				'ph-image-cover-2-5' => esc_attr__( 'Image cover 2.5', 'tank' ),
				'ph-image-cover-3' => esc_attr__( 'Image cover 3', 'tank' ),
				'ph-image-cover-3-5' => esc_attr__( 'Image cover 3.5', 'tank' ),
				'ph-image-cover-4' => esc_attr__( 'Image cover 4', 'tank' ),
				'ph-image-cover-4-5' => esc_attr__( 'Image cover 4.5', 'tank' ),
				'ph-image-cover-5' => esc_attr__( 'Image cover 5', 'tank' ),
				'ph-image-cover-5-5' => esc_attr__( 'Image cover 5.5', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-image-cover-0',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
	)
);

/* ----------------------------------------------------- */
/* header default
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'header_thumnbnail_opt',
	'title' => 'Thumbnail Image Header Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#tank_page_header_opt'  => 'st2',
    ),
	),
	'pages' => array( 'page', 'portfolio', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Shadow Title',
			'id'		=> $prefix . 'page_header_thumnbnail_title',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'page_header_thumnbnail_subtitle',
			'desc'		=> 'Optional.<br> HTML tag allaowed.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
		),
		
		array(
			'name'		=> 'Scroll Down',
			'id'		=> $prefix . 'page_header_thumnbnail_scroll',
			'desc'		=> 'Optional.<br> e.x: Scroll Down',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_height_opt', '!=', 'ph-full' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Logo, Menu &  Caption Mode', 'tank' ),
			'id'   => $prefix . 'page_header_thumbnail_cap_mode_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-bg-image-is-dark' => esc_attr__( 'Light', 'tank' ),
				'ph-bg-image-is-light' => esc_attr__( 'Dark', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-bg-image-is-dark',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Size', 'tank' ),
			'id'   => $prefix . 'page_header_thumnbnail_cap_st_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-cap-df' => esc_attr__( 'Default', 'tank' ),
				'ph-cap-sm' => esc_attr__( 'SM', 'tank' ),
				'ph-cap-lg' => esc_attr__( 'LG', 'tank' ),
				'ph-cap-xlg' => esc_attr__( 'XLG', 'tank' ),
				'ph-cap-xxlg' => esc_attr__( 'XXLG', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-cap-df',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Alignment', 'tank' ),
			'id'   => $prefix . 'page_header_thumnbnail_cap_alingment_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-left' => esc_attr__( 'Left', 'tank' ),
				'ph-center' => esc_attr__( 'Center', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-left',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
	)
);


/* ----------------------------------------------------- */
/* header default
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'header_fullscreen_image_opt',
	'title' => 'Fullscreen Image/ Video Header Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#tank_page_header_opt'  => 'st3',
    ),
	),
	'pages' => array( 'page', 'portfolio', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Header Type', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_header_type_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Background Image', 'tank' ),
				'st2' => esc_attr__( 'Background Video', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Background Image',
			'id'		=> $prefix . 'page_header_fullscreen_image_background',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Background Image',
			'hidden' => array( 'tank_page_header_fullscreen_image_header_type_opt', '!=', 'st1' )
		),
		
		array(
			'name'		=> 'MP4 Video URL',
			'id'		=> $prefix . 'page_header_fullscreen_image_mp4_video',
			'desc'		=> 'e.x:  https://yoursite.com/fashion-week.mp4 <br> Required.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_header_type_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'WEBM Video URL',
			'id'		=> $prefix . 'page_header_fullscreen_image_wbem_video',
			'desc'		=> 'e.x:  https://yoursite.com/fashion-week.wbem <br> Required.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_header_type_opt', '!=', 'st2' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Parallax Effeect', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_parallax_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-content-parallax-none' => esc_attr__( 'Disable', 'tank' ),
				'ph-content-parallax' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-content-parallax-none',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Logo, Menu &  Caption Mode', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_mode_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-bg-image-is-dark' => esc_attr__( 'Light', 'tank' ),
				'ph-bg-image-is-light' => esc_attr__( 'Dark', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-bg-image-is-dark',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Background Overlay', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_overlay_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-image-cover-0' => esc_attr__( 'Default', 'tank' ),
				'ph-image-cover-0-5' => esc_attr__( 'Image cover 0.5', 'tank' ),
				'ph-image-cover-1' => esc_attr__( 'Image cover 1', 'tank' ),
				'ph-image-cover-1-5' => esc_attr__( 'Image cover 1.5', 'tank' ),
				'ph-image-cover-2' => esc_attr__( 'Image cover 2', 'tank' ),
				'ph-image-cover-2-5' => esc_attr__( 'Image cover 2.5', 'tank' ),
				'ph-image-cover-3' => esc_attr__( 'Image cover 3', 'tank' ),
				'ph-image-cover-3-5' => esc_attr__( 'Image cover 3.5', 'tank' ),
				'ph-image-cover-4' => esc_attr__( 'Image cover 4', 'tank' ),
				'ph-image-cover-4-5' => esc_attr__( 'Image cover 4.5', 'tank' ),
				'ph-image-cover-5' => esc_attr__( 'Image cover 5', 'tank' ),
				'ph-image-cover-5-5' => esc_attr__( 'Image cover 5.5', 'tank' ),
				'ph-image-cover-6' => esc_attr__( 'Image cover 6', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-image-cover-0',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Background Shadow', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_shadow_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-image-shadow-none' => esc_attr__( 'Disable', 'tank' ),
				'ph-image-shadow' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-image-shadow-none',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		// enable page info
		array(
			'name'     => esc_attr__( 'Page Title Section', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_title_opt',
			'desc'  => esc_attr__( 'Enable/ Disable Page Title Section.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'tank' ),
				'st2' => esc_attr__( 'Disable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'page_header_fullscreen_image_title',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_title_opt', '!=', 'st1' )
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'page_header_fullscreen_image_subtitle',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_title_opt', '!=', 'st1' )
		),
		
		array(
			'name'		=> 'Tag Line',
			'id'		=> $prefix . 'page_header_fullscreen_image_tag',
			'desc'		=> 'Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_title_opt', '!=', 'st1' )
		),
		
		array(
			'name'		=> 'Scroll Down',
			'id'		=> $prefix . 'page_header_fullscreen_image_scroll',
			'desc'		=> 'Optional.<br> e.x: Scroll Down',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_height_opt', '!=', 'ph-full' )
		),
		
		// enable page info
		array(
			'name'     => esc_attr__( 'Page Information Section', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_info_main',
			'desc'  => esc_attr__( 'Enable/ Disable Page Information Section.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'tank' ),
				'st2' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
			//info
			array(
				'id'		=> $prefix . 'page_header_fullscreen_image_info_loop',
				'name'        => 'Page Information',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Page Information', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name' => 'Data Title',
						'id'		=> $prefix . 'page_header_fullscreen_image_info_loop_title',
						'type' => 'text',
						'desc'		=> 'e.x: Client',
					),
					
					array(
						'name' => 'Data Content',
						'id'		=> $prefix . 'page_header_fullscreen_image_info_loop_con',
						'type' => 'textarea',
						'desc'		=> 'e.x: Themetorium<br> HTML tag allaowed.',
					),
				),
				'hidden' => array( 'tank_page_header_fullscreen_image_info_main', '!=', 'st2' )
			),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Size', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_st_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-cap-df' => esc_attr__( 'Default', 'tank' ),
				'ph-cap-sm' => esc_attr__( 'SM', 'tank' ),
				'ph-cap-lg' => esc_attr__( 'LG', 'tank' ),
				'ph-cap-xlg' => esc_attr__( 'XLG', 'tank' ),
				'ph-cap-xxlg' => esc_attr__( 'XXLG', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-cap-df',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Caption Alignment', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_cap_alingment_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-left' => esc_attr__( 'Left', 'tank' ),
				'ph-center' => esc_attr__( 'Center', 'tank' ),
				'ph-inline' => esc_attr__( 'Inline', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-left',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// enable page info
		array(
			'name'     => esc_attr__( 'Social Share Option', 'tank' ),
			'id'   => $prefix . 'page_header_fullscreen_image_share_opt',
			'desc'  => esc_attr__( 'Enable/ Disable Social Share Option.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'tank' ),
				'st2' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Share',
			'id'		=> $prefix . 'page_header_fullscreen_image_share_t_text1_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_share_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Share this project with your friends',
			'id'		=> $prefix . 'page_header_fullscreen_image_share_t_text2_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_share_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Close',
			'id'		=> $prefix . 'page_header_fullscreen_image_share_t_text3_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_fullscreen_image_share_opt', '!=', 'st2' )
		),
	)
);

/* ----------------------------------------------------- */
/* header default
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'header_rev_opt',
	'title' => 'Slider Revolution Option',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#tank_page_header_opt'  => 'st4',
    ),
	),
	'pages' => array( 'page', 'portfolio', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		// get slider 
		array(
			'name'     => esc_attr__( 'Slider Revolution', 'tank-plugin' ),
			'id'   => $prefix . 'page_header_slider_shortcode',
			'desc'  => esc_attr__( 'Choose a Slider.', 'tank-plugin' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $array_choices,
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '',
			'placeholder' => esc_attr__( 'Select an Option', 'tank-plugin' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Parallax Effeect', 'tank' ),
			'id'   => $prefix . 'page_header_rev_image_cap_parallax_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-content-parallax-none' => esc_attr__( 'Disable', 'tank' ),
				'ph-content-parallax' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-content-parallax-none',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
	
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Logo, Menu &  Caption Mode', 'tank' ),
			'id'   => $prefix . 'page_header_rev_image_cap_mode_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-bg-image-is-dark' => esc_attr__( 'Light', 'tank' ),
				'ph-bg-image-is-light' => esc_attr__( 'Dark', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-bg-image-is-dark',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Scroll Down',
			'id'		=> $prefix . 'page_header_rev_image_scroll',
			'desc'		=> 'Optional.<br> e.x: Scroll Down',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Background Shadow', 'tank' ),
			'id'   => $prefix . 'page_header_rev_cap_shadow_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ph-image-shadow-none' => esc_attr__( 'Disable', 'tank' ),
				'ph-image-shadow' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'ph-image-shadow-none',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// enable page info
		array(
			'name'     => esc_attr__( 'Social Share Option', 'tank' ),
			'id'   => $prefix . 'page_header_rev_share_opt',
			'desc'  => esc_attr__( 'Enable/ Disable Social Share Option.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'tank' ),
				'st2' => esc_attr__( 'Enable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		array(
			'name'		=> 'Share',
			'id'		=> $prefix . 'page_header_rev_share_t_text1_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_rev_share_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Share this project with your friends',
			'id'		=> $prefix . 'page_header_rev_share_t_text2_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_rev_share_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Close',
			'id'		=> $prefix . 'page_header_rev_share_t_text3_opt',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'tank_page_header_rev_share_opt', '!=', 'st2' )
		),
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes page custom pagination
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'main_page_custom_pagination_opt',
	'title' => 'Custom Pagination Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'portfolio.php'),
	),
	'pages' => array( 'page', 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Hover Image',
			'id'		=> $prefix . 'custom_pagination_hover_opt',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Optional.',
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'custom_pagination_title_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Portfolio',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'custom_pagination_subtitle_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Selected Works',
		),
		
		array(
			'name'		=> 'Custom URL',
			'id'		=> $prefix . 'custom_pagination_url_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Link Target', 'tank' ),
			'id'   => $prefix . 'custom_pagination_target_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'_self' => esc_attr__( 'Self', 'tank' ),
				'_blank' => esc_attr__( 'Blank', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '_self',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
	)
);


/* ----------------------------------------------------- */
/* portfolio options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_meta_opt',
	'title' => 'Portfolio Options',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name' => 'Alternative Post Title',
			'id'		=> $prefix . 'port_alternative_title_opt',
			'type' => 'text',
			'desc'		=> 'e.x: Victorian Girls<br> Victorian[br_sm] Girls<br> Victorian[br] Girls',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Cover Type', 'tumar' ),
			'id'   => $prefix . 'port_list_cover',
			'desc'  => esc_attr__( 'Select Cover Style.', 'tumar' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Featured Image', 'tumar' ),
				'st2' => esc_attr__( 'MP4 Video', 'tumar' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tumar' ),
		),
		
		array(
			'name' => 'MP4 Video URL',
			'id'		=> $prefix . 'port_cover_video_path_mp4_opt',
			'type' => 'text',
			'desc'		=> 'e.x: https://yoursite.com/fashion-week.mp4',
			'hidden' => array( 'tank_port_list_cover', '!=', 'st2' )
		),
		
		array(
			'name' => 'WEBM Video URL',
			'id'		=> $prefix . 'port_cover_video_path_webm_opt',
			'type' => 'text',
			'desc'		=> 'e.x: https://yoursite.com/fashion-week.wbem',
			'hidden' => array( 'tank_port_list_cover', '!=', 'st2' )
		),
		
		array(
			'name' => 'Cover Description',
			'id'		=> $prefix . 'port_cover_description_opt',
			'type' => 'text',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'Only for Elementor portfolio grid style.',
            'position' => 'top',
			),
			//'limit'      => 7,
			//'limit_type' => 'word',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Title Color Style', 'tank' ),
			'id'   => $prefix . 'port_cover_title_color_opt',
			'desc'  => esc_attr__( 'It makes the caption visible better if you use light image.', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Light', 'tank' ),
				'st2' => esc_attr__( 'Dark', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Post Pagination', 'tank' ),
			'id'   => $prefix . 'port_pagination_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'tank' ),
				'st2' => esc_attr__( 'Disable', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes page custom pagination
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'port_page_custom_pagination_opt',
	'title' => 'Custom Pagination Options',
	'pages' => array( 'portfolio' ),
	'hide'   => array(
    // by metabox select
	'input_value'   => array(
    '#tank_port_pagination_opt' => 'st1',
    ),
	),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Hover Image',
			'id'		=> $prefix . 'port_custom_pagination_hover_opt',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Optional.',
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'port_custom_pagination_title_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Portfolio',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'port_custom_pagination_subtitle_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Selected Works',
		),
		
		array(
			'name'		=> 'Custom URL',
			'id'		=> $prefix . 'port_custom_pagination_url_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Link Target', 'tank' ),
			'id'   => $prefix . 'port_custom_pagination_target_opt',
			'desc'  => esc_attr__( '', 'tank' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'_self' => esc_attr__( 'Self', 'tank' ),
				'_blank' => esc_attr__( 'Blank', 'tank' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '_self',
			'placeholder' => esc_attr__( 'Select an Option', 'tank' ),
		),
		
	)
);


// Blog Post Metaboxes
/* ----------------------------------------------------- */


$meta_boxes[] = array(
	'id' => 'blogmeta-video',
	'title' => 'Post Format Video Option',
	'show'   => array(
    'post_format' => array( 'Video' ),
	),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> 'MP4 Video URL',
			'id'		=> $prefix . 'post_format_vid_mp4',
			'desc'		=> 'e.x:  https://yoursite.com/fashion-week.mp4 <br> Required.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),
		array(
			'name'		=> 'WEBM Video URL',
			'id'		=> $prefix . 'post_format_vid_webm',
			'desc'		=> 'e.x:  https://yoursite.com/fashion-week.wbem <br> Required.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
		),

		
	)
);


/* ----------------------------------------------------- */
/* galeery Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'shop_opt',
	'title' => 'Product Options',
	'pages' => array( 'product' ),
	'context' => 'normal',	

	'fields' => array(
		
				
		array(
		'name'		=> 'Product Hover Image',
		'id'		=> $prefix . 'product_hover_image',
		'clone'		=> false,
		'type'		=> 'image_advanced',
		'max_file_uploads' => '1',
		'desc'		=> '',
		),
		array(
			'name'		=> 'Additional Information',
			'id'		=> $prefix . 'pro_additional_info',
			'desc'		=> 'e.x: -16%',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'If sale price added.',
            'position' => 'top',
            ),
		),
		
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function tank_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'tank_register_meta_boxes' );