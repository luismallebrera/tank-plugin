<?php
function unregister_widgets( $widgets_manager ) {
	$widgets_manager->unregister( 'sec-title' );
	$widgets_manager->unregister( 'tank-text-block' );
	$widgets_manager->unregister( 'tank-image' );
	$widgets_manager->unregister( 'tank-pop-image' );
	$widgets_manager->unregister( 'tank-accordion' );
	$widgets_manager->unregister( 'tank-testimonial' );
	$widgets_manager->unregister( 'tank-scroll-text' );
	$widgets_manager->unregister( 'tank-form' );
	$widgets_manager->unregister( 'tank-button' );
	$widgets_manager->unregister( 'tank-social-icons' );
	$widgets_manager->unregister( 'tank-informations' );
	$widgets_manager->unregister( 'tank-contact-info' );
	$widgets_manager->unregister( 'tank-img-carousel' );
	$widgets_manager->unregister( 'tank-client-logo' );
	$widgets_manager->unregister( 'tank-portfolio-grid' );
	$widgets_manager->unregister( 'tank-portfolio-list' );
	$widgets_manager->unregister( 'tank-portfolio-interactive' );
	$widgets_manager->unregister( 'tank-portfolio-slider' );
	$widgets_manager->unregister( 'tank-portfolio-carousel' );
	$widgets_manager->unregister( 'tank-image-gallery' );
	$widgets_manager->unregister( 'tank-post-grid' );
	$widgets_manager->unregister( 'tank-post-list' );
	$widgets_manager->unregister( 'tank-post-interactive' );
	$widgets_manager->unregister( 'tank-product-carousel' );
	$widgets_manager->unregister( 'tank-product-grid' );
	$widgets_manager->unregister( 'tank-portfolio-hover-carousel' );
	$widgets_manager->unregister( 'tank-blockquote' );
}