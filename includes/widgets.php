<?php
/**
 * Function for registering custom widget areas
 *
 * @link https://developer.wordpress.org/themes/functionality/widgets/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

/**
 * Register custom widget areas.
 *
 */

function glide_widgets_init() {

	// Widget area on about us page
	register_sidebar( array(
		'name'			=> __( 'Sidebar Widgets', 'basetheme_td' ),
		'id'			=> 'sidebar-widgets',
		'description'	=> __( 'These are widgets for the sidebar.', 'basetheme_td' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '<div class="clear"></div></div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>'
	) );

}

add_action( 'widgets_init', 'glide_widgets_init' );
