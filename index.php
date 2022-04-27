<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;


$basethemevar_pagetitle = (isset($fields['basethemevar_pagetitle'])) ? $fields['basethemevar_pagetitle'] : null;
if(!$basethemevar_pagetitle){
	$basethemevar_pagetitle = get_the_title();
}

?>
<section id="hero-content" class="hero-content">
<!-- Hero Start -->
<h1><?php echo $basethemevar_pagetitle; ?></h1>
<!-- Hero Start -->
</section>

<section id="page-content" class="page-content">
<?php while ( have_posts() ) : the_post();

	//Include specific template for the content.
	get_template_part( 'partials/content', 'page' );

endwhile; ?>

<div class="clear"></div>


<?php get_footer(); ?>
