<?php
namespace TANKEL;

use TANKEL\Widgets\Sec_Title;
use TANKEL\Widgets\Tank_Text_Block;
use TANKEL\Widgets\Tank_Blockquote;
use TANKEL\Widgets\Tank_Image;
use TANKEL\Widgets\Tank_Pop_Image;
use TANKEL\Widgets\Tank_Accordion;
use TANKEL\Widgets\Tank_Testimonial;
use TANKEL\Widgets\Tank_Scroll_Text;
use TANKEL\Widgets\Tank_Form;
use TANKEL\Widgets\Tank_Button;
use TANKEL\Widgets\Tank_Social_Icons;
use TANKEL\Widgets\Tank_Informations;
use TANKEL\Widgets\Tank_Contact_Info;
use TANKEL\Widgets\Tank_Img_Carousel;
use TANKEL\Widgets\Tank_Client_Logo;
use TANKEL\Widgets\Tank_Portfolio_Grid;
use TANKEL\Widgets\Tank_Portfolio_List;
use TANKEL\Widgets\Tank_Portfolio_Interactive;
use TANKEL\Widgets\Tank_Portfolio_Slider;
use TANKEL\Widgets\Tank_Portfolio_Carousel;
use TANKEL\Widgets\Tank_Portfolio_Hover_Carousel;
use TANKEL\Widgets\Tank_Image_Gallery;
use TANKEL\Widgets\Tank_Post_Grid;
use TANKEL\Widgets\Tank_Post_List;
use TANKEL\Widgets\Tank_Post_Interactive;
use TANKEL\Widgets\Tank_Product_Carousel;
use TANKEL\Widgets\Tank_Product_Grid;

if( ! defined('ABSPATH') ) exit;

class TankCore{

    public function __construct() {
        $this->add_actions();
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'tank_after_register_scripts' ]);
	}


    public function add_actions() {
        add_action( 'elementor/init', [ $this, 'tank_elementor_helper_init' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_widget_styles' ] );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
        add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );
    }


    public function tank_elementor_helper_init() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'tank-addons',
            [
                'title'  => 'Tank Addons',
                'icon' => 'font'
            ],
            1
        );
		if (class_exists('WooCommerce')) {
		\Elementor\Plugin::instance()->elements_manager->add_category(
            'tank-woocommerce',
            [
                'title'  => 'Tank WooCommerce',
                'icon' => 'font'
            ],
            1
        );
		}
    }

    public function enqueue_widget_styles() {
        wp_register_style( 'elementor-css-img-gallery', TANK_URL . '/elementor-js/elementor-css-img-gallery.css', __FILE__  );
    }

	public function tank_after_register_scripts() {
        wp_register_script( 'elementor-img-lazy', TANK_URL . '/elementor-js/elementor-img-lazy.js', array('jquery'), null, true );
        wp_register_script( 'elementor-post-list-lazy', TANK_URL . '/elementor-js/elementor-post-list-lazy.js', array('jquery'), null, true );
        wp_register_script( 'elementor-lazy-interactive', TANK_URL . '/elementor-js/elementor-lazy-interactive.js', array('jquery'), null, true );
        wp_register_script( 'elementor-list-lazy', TANK_URL . '/elementor-js/elementor-list-lazy.js', array('jquery'), null, true );
        wp_register_script( 'elementor-scrolling-text', TANK_URL . '/elementor-js/elementor-scrolling-text.js', array('jquery'), null, true );
        wp_register_script( 'elementor-portfolio-scrolling-text', TANK_URL . '/elementor-js/elementor-portfolio-scrolling-text.js', array('jquery'), null, true );
		wp_register_script( 'elementor-post-scrolling-text', TANK_URL . '/elementor-js/elementor-post-scrolling-text.js', array('jquery'), null, true );
        wp_register_script( 'elementor-testimonial', TANK_URL . '/elementor-js/elementor-testimonial.js', array('jquery'), null, true );
        wp_register_script( 'elementor-img-carousel', TANK_URL . '/elementor-js/elementor-img-carousel.js', array('jquery'), null, true );
        wp_register_script( 'elementor-portfolio-grid', TANK_URL . '/elementor-js/elementor-portfolio-grid.js', array('jquery'), null, true );
        wp_register_script( 'elementor-img-grid', TANK_URL . '/elementor-js/elementor-img-grid.js', array('jquery'), null, true );
        wp_register_script( 'elementor-portfolio-slider', TANK_URL . '/elementor-js/elementor-portfolio-slider.js', array('jquery'), null, true );
        wp_register_script( 'elementor-portfolio-carousel', TANK_URL . '/elementor-js/elementor-portfolio-carousel.js', array('jquery'), null, true );
        wp_register_script( 'elementor-imgpop-lazy', TANK_URL . '/elementor-js/elementor-imgpop-lazy.js', array('jquery'), null, true );
        wp_register_script( 'elementor-post-grid', TANK_URL . '/elementor-js/elementor-post-grid.js', array('jquery'), null, true );
		wp_register_script( 'elementor-product-carousel', TANK_URL . '/elementor-js/elementor-product-carousel.js', array('jquery'), null, true );
		wp_register_script( 'elementor-shop-lazy', TANK_URL . '/elementor-js/elementor-shop-lazy.js', array('jquery'), null, true );
		wp_register_script( 'elementor-portfolio-car-hover', TANK_URL . '/elementor-js/elementor-portfolio-car-hover.js', array('jquery'), null, true );
		
	}

    public function on_widgets_registered() {
        $this->includes();
        $this->register_widget();
    }

    private function includes(){
        require __DIR__ . '/widgets/sec-title.php';
        require __DIR__ . '/widgets/tank-text-block.php';
        require __DIR__ . '/widgets/tank-blockquote.php';
        require __DIR__ . '/widgets/tank-image.php';
		require __DIR__ . '/widgets/tank-pop-image.php';
        require __DIR__ . '/widgets/tank-accordion.php';
        require __DIR__ . '/widgets/tank-testimonial.php';
        require __DIR__ . '/widgets/tank-scroll-text.php';
        require __DIR__ . '/widgets/tank-form.php';
        require __DIR__ . '/widgets/tank-button.php';
        require __DIR__ . '/widgets/tank-social-icons.php';
        require __DIR__ . '/widgets/tank-informations.php';
        require __DIR__ . '/widgets/tank-contact-info.php';
        require __DIR__ . '/widgets/tank-img-carousel.php';
        require __DIR__ . '/widgets/tank-client-logo.php';
        require __DIR__ . '/widgets/tank-portfolio-grid.php';
        require __DIR__ . '/widgets/tank-portfolio-list.php';
        require __DIR__ . '/widgets/tank-portfolio-interactive.php';
        require __DIR__ . '/widgets/tank-portfolio-slider.php';
        require __DIR__ . '/widgets/tank-portfolio-carousel.php';
        require __DIR__ . '/widgets/tank-portfolio-hover-carousel.php';
        require __DIR__ . '/widgets/tank-image-gallery.php';
        require __DIR__ . '/widgets/tank-post-grid.php';
        require __DIR__ . '/widgets/tank-post-list.php';
		require __DIR__ . '/widgets/tank-post-interactive.php';
		require __DIR__ . '/widgets/tank-product-carousel.php';
		require __DIR__ . '/widgets/tank-product-grid.php';
      }

    private function register_widget(){
        \Elementor\Plugin::instance()->widgets_manager->register( new Sec_Title() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Tank_Text_Block() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Tank_Blockquote() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Tank_Image() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Tank_Pop_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Scroll_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Social_Icons() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Informations() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Contact_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Img_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Client_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_Interactive() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Portfolio_Hover_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Image_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Post_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Post_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Post_Interactive() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Product_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Tank_Product_Grid() );
	}

}


new TankCore();
