<?php
/**
 * The template  displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;

// 404 Page - Advanced custom fields variables
$basethemevar_error_headline = (isset($option_fields['basethemevar_error_headline'])) ? $option_fields['basethemevar_error_headline'] : null;
$basethemevar_error_sub_headline = (isset($option_fields['basethemevar_error_sub_headline'])) ? $option_fields['basethemevar_error_sub_headline'] : null;

$basethemevar_error_text = (isset($option_fields['basethemevar_error_text'])) ? $option_fields['basethemevar_error_text'] : null;
$basethemevar_error_menu = (isset($option_fields['basethemevar_error_menu'])) ? $option_fields['basethemevar_error_menu'] : null;
$basethemevar_error_menu_bottom_text = (isset($option_fields['basethemevar_error_menu_bottom_text'])) ? $option_fields['basethemevar_error_menu_bottom_text'] : null;
$basethemevar_error_search = (isset($option_fields['basethemevar_error_search'])) ? $option_fields['basethemevar_error_search'] : null;

?> <section id="hero-content" class="hero-content">
	<!-- Hero Start -->
	<section class="m-section">
		<div class="banner-container center-align error-page-masthead">
			<div class="wrapper">
				<h1 class="heading"><?php echo $basethemevar_error_headline; ?></h1>
				<div class="banner-text">
					<p><?php echo $basethemevar_error_sub_headline; ?></p>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero Start -->
</section>
<section id="page-content" class="page-content">
	<!-- Page Content Start -->
	<div class="s-section">
		<div class="wrapper">
			<section class="error-404 not-found">
				<div class="page-content"> <?php if ( $basethemevar_error_text ) { ?> <?php echo $basethemevar_error_text; ?>
					<?php } ?> <?php if ( $basethemevar_error_menu ) { ?> <div class="error">
						<?php echo $basethemevar_error_menu; ?> </div> <?php } ?> <div class="clear"></div>
					<div class="form-404"> <?php if ( $basethemevar_error_menu_bottom_text ) { ?>
						<?php echo $basethemevar_error_menu_bottom_text; ?> <?php } ?>
						<?php if ( $basethemevar_error_search != 1 ) { ?> <?php get_search_form(); ?> <?php } ?> </div>
					<!--404-form-->
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			<div class="s-80"></div>
		</div>
	</div> <?php
get_footer();