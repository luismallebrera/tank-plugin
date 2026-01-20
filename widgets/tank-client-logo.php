<?php
namespace TANKEL\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Tank_Client_Logo extends Widget_Base {

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
		return 'tank-client-logo';
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
		return __( 'Tank Client Logo', 'tank-plugin' );
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
				'label' => __( 'Content', 'tank-plugin' ),
			]
		);
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'image', [
				'label' => __( 'Image', 'tank-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/client-1.png',
				],
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'image_alt_text', [
				'label' => __( 'Image Alt text', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'img' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		
		$repeater->add_control(
			'custom_url', [
				'label' => __( 'Custom URL', 'tank-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#' , 'tank-plugin' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'button_target', [
				'label' => __( 'Link Target', 'tank-plugin' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
						'_self' => 'Self',
						'_blank' => 'Blank',
						'_parent' => 'Parent',
						'_top' => 'Top',
					],
				'default' => '_self',
				'label_block' => true,
			]
		);
		$this->add_control(
			'tankclientslogos',
			[
				'label' => __( 'Tank Client Logos', 'tank-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => __('https://webredox.net/demo/wp/tank/wp-content/uploads/2021/08/client-1.png', 'tank-plugin'),
					],
					
				],
				
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_border',
			[
				'label' => __( 'Block Border', 'tank-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'section_block_border_color',
			[
				'label' => __( 'Border Color', 'tank-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tt-logo-wall > li' => 'border-color: {{VALUE}};',
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
		<!-- client-list -->
        <ul class="tt-logo-wall cl-col-44 anim-fadeinup">
		<?php if ( $settings['tankclientslogos'] ) { ?>
            
			<?php foreach( $settings['tankclientslogos'] as $tankclientslogo ) :?>
			<li><a href="<?php echo esc_url($tankclientslogo['custom_url']); ?>" class="cursor-alter" target="<?php echo esc_attr($tankclientslogo['button_target']); ?>" rel="noopener"><img src="<?php echo esc_url($tankclientslogo['image']['url']); ?>" alt="<?php echo esc_attr($tankclientslogo['image_alt_text']); ?>"></a></li>
            <?php endforeach; ?>
            
              <!-- client-list end-->
		<?php } ;?>
        </ul>     
		<?php
	}

}