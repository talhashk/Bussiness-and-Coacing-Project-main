<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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




?>
<section id="hero-content" class="hero-content">
<!-- Hero Start -->
	<?php the_archive_title( ); ?>
<!-- Hero Start -->
</section>

<section id="page-content" class="page-content">
<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			// Include specific template for the content
			get_template_part( 'partials/content', 'archive-post' );
		}
		?>
		<div class="clear"></div>
		<?php
	}else {

		// If no content, include the "No posts found" template.
		get_template_part( 'partials/content', 'none' );
	}
	?>


<?php get_footer(); ?>
