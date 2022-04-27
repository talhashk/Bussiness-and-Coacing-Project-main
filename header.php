<?php
/**
 * The template for displaying website header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

// Global variables
global $option_fields;
global $pID;
global $fields;

$pID = get_the_ID();

if ( is_home() ) {
	$pID = get_option( 'page_for_posts' );
}

if ( is_404() || is_archive() || is_category() || is_search() ) {
	$pID = get_option( 'page_on_front' );
}

if (function_exists('get_fields') && function_exists('get_fields_escaped')) {
	$option_fields = get_fields_escaped( 'option' );
	$fields        = get_fields_escaped( $pID );
}
// Page Tags - Advanced custom fields variables
$tracking = (isset($option_fields['tracking_code'])) ? $option_fields['tracking_code'] : null;
$ccss = (isset($option_fields['custom_css'])) ? $option_fields['custom_css'] : null;
$hscripts = (isset($option_fields['head_scripts'])) ? $option_fields['head_scripts'] : null;
$bscripts = (isset($option_fields['body_scripts'])) ? $option_fields['body_scripts'] : null;

// Page variables - Advanced custom fields variables
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<?php
		// Add Head Scripts
		if ( $hscripts != '' ) {
			echo $hscripts;
		}
	?>

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/favicon-16x16.png">
	<link rel="icon" sizes="any" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/favicon.ico">
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/icon.svg">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri()) ?>/assets/img/pwa/site.webmanifest">

	<meta name="theme-color" content="#0047FE">

	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="Engageware">

	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#0047FE">
	<meta name="msapplication-TileColor" content="#0047FE">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="msapplication-TileImage" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/pwa/pwa-icon-144.png">

	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#0047FE">

	<?php
		// Tracking Code
		if ( $tracking != '' ) {
			echo $tracking;
		}

		// Custom CSS
		if ( $ccss != '' ) {
			echo '<style type="text/css">';
			echo $ccss;
			echo '</style>';
		}
	?>

	<?php wp_head(); ?>
<script>
	"serviceWorker" in navigator && window.addEventListener("load", function() {
    navigator.serviceWorker.register("/sw.js").then(function(e) {
        console.log("ServiceWorker registration successful with scope: ", e.scope)
    }, function(e) {
        console.log("ServiceWorker registration failed: ", e)
    })
});
</script>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<?php if ( $bscripts != '' ) { ?>
	<div style="display: none;">
		<?php echo $bscripts; ?>
	</div>
<?php } ?>

<header id="site-header" class="site-header">
<!-- Header Start -->

	<div class="header-wrapper">
		<div class="left-header">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Logo</a>
			</div>
		</div>

		<div class="right-header">
			<div class="nav-overlay">
				<div class="nav-container">
					<div class="nav-content">
						<div class="header-nav">
							<?php
								wp_nav_menu(array(
									'theme_location'   => 'header-nav',
									'fallback_cb'      => 'nav_fallback',
									'container'        => 'nav',
									'container_class'  => 'site-nav',
									'container_id'     => 'site-nav',
									'walker'           => new Walker_Header_Nav()
								));
							?>
						</div>
						<div class="header-btns">
						</div>
						<!-- /.header-btns -->
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="menu-btn">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- /.wrapper -->

<!-- Header End -->
</header>

<!-- Main Area Start -->
<main id="site-main" class="site-main">
