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
class Tank_Image_Gallery extends Widget_Base {

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
		return 'tank-image-gallery';
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
		return __( 'Tank Image & Video Gallery', 'tank-plugin' );
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
			'elementor-img-grid',
		];
	}
	public function get_style_depends() {
		return [ 'elementor-css-img-gallery' ];
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
				'label' => __( 'Gallery', 'tank-plugin' ),
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'gallery_type', [
				'label' => __( 'Gallery Type', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Image',
					'st2' => 'Video',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'image', [
				'label' => __( 'Image', 'tank-plugin' ),
				'description' => __( 'Upload Slide Image/ Video Poster Image', 'tank-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-1.jpg',
				],
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'img_parallax_opt', [
				'label' => __( 'Image Parallax Effect', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable image parallax effect.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'st1' => 'Disable',
					'st2' => 'Enable',
				],
				'default' => 'st1',
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'img_title', [
				'label' => __( 'Image Title', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'gallery_type' => 'st1',
				],
			]
		);
		$repeater->add_control(
			'img_caption', [
				'label' => __( 'Image Caption', 'tank-plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'gallery_type' => 'st1',
				],
			]
		);
		
		
		$repeater->add_control(
			'mp4_url', [
				'label' => __( 'MP4 Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x: https://yoursite.com/fashion-week.mp4 <br> Required.', 'tank-plugin' ),
				'condition' => [
					'gallery_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'webm_url', [
				'label' => __( 'WEBM Video URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'description' => __( 'e.x:  https://yoursite.com/fashion-week.wbem <br> Required.', 'tank-plugin' ),
				'condition' => [
					'gallery_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'popup_video_action',
			[
				'label' => __( 'Mouse Leave Action', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tt-gallery-video-wrap-pause' => 'Pause',
					'tt-gallery-video-wrap-stop' => 'Reset',
				],
				'default' => 'tt-gallery-video-wrap-pause',
				'label_block' => true,
				'condition' => [
					'gallery_type' => 'st2',
				],
			]
		);
		
		$repeater->add_control(
			'text1', [
				'label' => __( 'Play/ View', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'View',
				'label_block' => true,
				'description' => __( 'Translet Option.<br> e.x:View', 'tank-plugin' ),
			]
		);

		$this->add_control(
			'tankimagegallerys',
			[
				'label' => __( 'Image & Video Gallery', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => __('https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/misc-1.jpg', 'tank-plugin'),
					],
				],
			]
		);
		
		
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => __( 'Gallery Settings', 'tank-plugin' ),
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
					'ttgr-layouts-df' => '1 Column',
					'ttgr-layout-2' => '2 Column',
					'ttgr-layout-3' => '3 Column',
					'ttgr-layout-4' => '4 Column',
				],
				'default' => 'ttgr-layouts-df',
				'label_block' => true,
				'condition' =>  ['port_grid_layout' => ['st2', 'st5']],
			]
		);
		
		$this->add_control(
			'port_grid_column_mobile',
			[
				'label' => __( 'Responsive Column', 'tank-plugin' ),
				'description' => __( '', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttgr-layout-mobile-df' => 'Default',
					'ttgr-layout-mobile-df-2' => '2 Columns',
				],
				'default' => 'ttgr-layout-mobile-df',
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
					'ttgr-not-cropped' => 'Disable',
					'ttgr-cropped' => 'Enable',
				],
				'default' => 'ttgr-not-cropped',
				'label_block' => true,
				'condition' =>  ['port_grid_layout' => ['st2']],
			]
		);
		
		$this->add_control(
			'img_hover_opt',
			[
				'label' => __( 'Image Hover Effect', 'tank-plugin' ),
				'description' => __( 'Enable/ Disable image hover effect.<br> Behavior depends on block gap.', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ttga-hover-off' => 'Disable',
					'ttga-hover' => 'Enable',
				],
				'default' => 'ttga-hover-off',
				'label_block' => true,
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
			'section_popup_cpation',
			[
				'label' => __( 'Popup Content Title and Background', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_popup_sec_back_color',
			[
				'label' => __( 'Background Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html' => 'background-color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		
		$this->add_control(
			'section_popup_cpation_title_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html h4' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_popup_cpation_title_typography',
				'selector' => '.lg-sub-html h4',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_popup_cpation_con',
			[
				'label' => __( 'Popup Content Caption', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_popup_cpation_con_color',
			[
				'label' => __( 'Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.lg-sub-html p' => 'color: {{VALUE}};',
				],
				'default' =>'',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_popup_cpation_con_typography',
				'selector' => '.lg-sub-html p',
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
		if( $settings['port_grid_layout'] == 'st2' ) {
			$port_layout=''.esc_attr($settings['port_grid_column']).' '.esc_attr($settings['port_grid_image_cropp']).' '.esc_attr($settings['port_grid_column_shifted']).'';
		}
		else if( $settings['port_grid_layout'] == 'st3' ) {
			$port_layout='ttgr-layout-creative-1 ';
		}
		else if( $settings['port_grid_layout'] == 'st4' ) {
			$port_layout='ttgr-layout-creative-2 ';
		}
		else if( $settings['port_grid_layout'] == 'st5' ) {
			$port_layout='ttgr-portrait '.esc_attr($settings['port_grid_column']).' '.esc_attr($settings['port_grid_column_shifted']).' ';
		}
		else {
			$port_layout=''.esc_attr($settings['port_grid_column_modern']).' ';
		}
		?>
		<div class="tt-gallery <?php echo esc_attr($settings['img_hover_opt']); ?>">
			<div class="tt-grid <?php echo ($port_layout);?> <?php echo esc_attr($settings['block_gap']); ?> <?php echo esc_attr($settings['port_grid_column_mobile']); ?>">
				<div class="tt-grid-items-wrap isotope-items-wrap lightgallery">
				<?php foreach( $settings['tankimagegallerys'] as $tankimagegallery ) {?>
				<?php
				$img_parallax='';
				$img_zoomin='';
				if( $tankimagegallery['img_parallax_opt'] == 'st2' ) {
					$img_parallax='anim-image-parallax';
					$img_zoomin='';
				}
				else {
					$img_parallax='';
					$img_zoomin='anim-zoomin';
				}
				?>
					<?php if( $tankimagegallery['gallery_type'] == 'st2' ) { ?>
					<div class="tt-grid-item isotope-item">
					<div class="ttgr-item-inner">
					<a href="" class="tt-gallery-item lg-trigger" data-cursor="<?php echo do_shortcode($tankimagegallery['text1']); ?>" data-html="
							<video class='lg-video-object lg-html5' controls playsinline preload='auto'>
							<?php if ( $tankimagegallery['mp4_url'] ) { ?>
							<source src='<?php echo esc_url($tankimagegallery['mp4_url']); ?>' type='video/mp4'>
							<?php } ;?>
							<?php if ( $tankimagegallery['webm_url'] ) { ?>
							<source src='<?php echo esc_url($tankimagegallery['webm_url']); ?>' type='video/webm'>
							<?php } ;?>
							</video>">
					<div class="tt-gallery-item-inner">
					<figure class="tt-gallery-video-wrap <?php echo esc_attr($tankimagegallery['popup_video_action']); ?> ttgr-height <?php echo esc_attr($img_zoomin);?>'">
					<video class="tt-gallery-video <?php echo esc_attr($img_parallax);?>" loop muted playsinline preload="metadata" poster="<?php echo esc_url($tankimagegallery['image']['url']); ?>">
						<?php if ( $tankimagegallery['mp4_url'] ) { ?>
							<source src="<?php echo esc_url($tankimagegallery['mp4_url']); ?>" type="video/mp4">
						<?php } ;?>
						<?php if ( $tankimagegallery['webm_url'] ) { ?>
							<source src="<?php echo esc_url($tankimagegallery['webm_url']); ?>" type="video/webm">
						<?php } ;?>
					</video>
					</figure>
					</div>
					</a>
					</div>
					</div>
					<?php } else { ?>
					<div class="tt-grid-item isotope-item">
					<div class="ttgr-item-inner">
					<a data-src="<?php echo esc_url($tankimagegallery['image']['url']); ?>" class="tt-gallery-item lg-trigger" data-cursor="<?php echo do_shortcode($tankimagegallery['text1']); ?>" <?php if ( $tankimagegallery['img_title'] || $tankimagegallery['img_caption'] ) { ?>data-sub-html="<h4><?php echo esc_attr($tankimagegallery['img_title']); ?></h4><br><p><?php echo esc_attr($tankimagegallery['img_caption']); ?></p>"<?php } ;?>>
					<div class="tt-gallery-item-inner">
						<div class="tt-gallery-image-wrap <?php echo esc_attr($img_zoomin);?>">
							<figure class="tt-gallery-image ttgr-height">
								<img class="<?php echo esc_attr($img_parallax);?>" src="<?php echo esc_url($tankimagegallery['image']['url']); ?>" alt="<?php echo esc_attr($tankimagegallery['image']['alt']); ?>">
							</figure> <!-- /.tt-gallery-image -->
						</div> <!-- /.tt-gallery-image-wrap -->
					</div>
					</a>
					</div>
					</div>
					<?php } ;?>
				<?php } ;?>
				</div>
			</div>
		</div>
        <?php
		

	}

}